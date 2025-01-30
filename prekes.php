<?php
include 'db.php';
?>

<html lang="lt">
<head>
    <meta charset="utf-8">
    <title>Prekės</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>


<body>

<div class="container">
<?php
include "meniu.php";
?>
</div>

<div class="container">
            <h1 align="center" class="display-4 py-4">Prekės</h1>
</div>

<!-- Modal -->
<div class="container">
<div class="modal fade" id="modaloPVZ" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modalo antraštė</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti</button>
                        <button type="button" class="btn btn-secondary">Išsaugoti</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if(isset($_GET['pid'])){ 

            $id = $_GET['pid'];
            $row = $db->query("SELECT * FROM product WHERE id='$id'");
            $row = mysqli_fetch_assoc($row);

        echo'<nav aria-label="breadcrumb">';
        echo'<ol class="breadcrumb">';
        echo'<li class="breadcrumb-item"><a href="http://localhost/svetaine/index.php">Pagrindinis</a></li>';
        echo'<li class="breadcrumb-item"><a href="http://localhost/svetaine/prekes.php">Prekės</a></li>';
        echo'<li class="breadcrumb-item active" aria-current="page">'.$row["caption"].'</li>';
        echo'</ol>';
        echo'</nav>';

            
            
            
            echo'<div class="row">';
            echo'<div class="col">';
            echo'<img class="img-thumbnail" src="product/'.$row["pic"].'" alt="'.$row["caption"].'">';
            echo'</div>';
            echo'<div class="col">';
            echo "<h1>".$row["caption"]."</h1>";
            echo "<h4>Produkto savybės: ".$row["tekstas"]."</h4>";
            echo "<h4>Likusių prekių skaičius: 2</h4>";
            echo "<h3>Kaina: ".$row["price"]."</h3>";
            echo '<button class="btn btn-lg btn-primary btn-block" type="submit" value="pirkti">Įdėti į krepšelį</button>';
            echo'</div>';
            echo'</div>';
            ?>
            <nav aria-label="paginatorius">
            <?php //puslapiavimas
            
            }
            if(!isset($_GET['pid'])){
            $output = '';
             if (isset($_GET['pageno'])) {
                 $pageno = $_GET['pageno'];
             } else {
                 $pageno = 1;
             }
             $records_per_page = 8;
             $offset = ($pageno-1) * $records_per_page;

             $rows = $db->query("SELECT * FROM product");
             $total_rows = $rows->num_rows;

             $total_pages = ceil($total_rows / $records_per_page); //ceil - grazina sveika skaiciu, apvalindama i didesne puse

             $res_data = $db->query("SELECT * FROM product LIMIT $offset, $records_per_page"); //LIMIT - praleidzia tiek, kiek yra offsete
             $output .= '
             <div class="row">';
             while($row = mysqli_fetch_assoc($res_data)){
                 ///
                 $output .= '
             <div class="col-sm-3">
             <div class="card">
             <img class="card-img-top" style="height: 214px; object-fit: cover;" src="product/'.$row["pic"].'" alt="'.$row["caption"].'">
             <div class="card-body">
             <h5 class="card-title">'.$row["caption"].'</h5>
             <h6 class="card-subtitle mb-2 text-muted">'.$row["price"].'</h6>
             
             <a href="?pid='.$row["id"].'#produktai" class="btn btn-secondary">Detaliau...</a>
             </div>
             </div>
             </div> ';
             }
             $output .= '</div>';
             echo $output;
             ?>
            <ul class="pagination justify-content-center py-4">
                <li><a class="page-link" href="?pageno=1">Pradinis</a></li>
                <li class=" page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; }
                                                else { echo "?pageno=".($pageno - 1); } ?>">&laquo;</a>
                </li>
                <?php for($i = 1; $i <= $total_pages; $i++){ ?>
                <li class="page-item <?php if($pageno == ($i)){ echo 'active'; } ?>">
                    <a class="page-link" href="<?php echo"?pageno=".($i)."#produktai"; ?>">
                        <?php echo $i;?></a></li>
                <?php
                }
                ?>
                
                <li class=" page-item<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; }
                                                else { echo "?pageno=".($pageno + 1); } ?>">&raquo;</a>
                </li>
                <li><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Paskutinis</a></li>

            </ul>
        </nav>
        <?php } ?>
</div>

<?php
include "footer.php";
?>

</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>

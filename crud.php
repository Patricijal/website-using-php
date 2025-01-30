<html>

<?php require_once 'procesai.php';?>


<?php include 'session.php';
CheckLogOut();
?>


<html lang="lt">
<head>
    <meta charset="utf-8">
    <title>Pagrindinis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>

<div class="container">
<?php
include "meniu.php";
?>
</div>

<div class="container">
<?php $mysqli=new mysqli('localhost', 'root', '', 'svetaine') or die(mysqli_error($mysqli));
    $result =$mysqli->query("SELECT * FROM product");?>
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Caption</th>
                        <th>Text</th>
                        <th>Price</th>
                        <th>Picture</th>
                        <th colspan="2">Veiksmai</th>
                    </tr>
                </thead>
                
                <nav aria-label="paginatorius">
                <?php //puslapiavimas
                
                
                if(!isset($_GET['pid'])){
                $output = '';
                 if (isset($_GET['pageno'])) {
                     $pageno = $_GET['pageno'];
                 } else {
                     $pageno = 1;
                 }
                 $records_per_page = 5;
                 $offset = ($pageno-1) * $records_per_page;
    
                 $rows = $mysqli->query("SELECT * FROM product");
                 $total_rows = $rows->num_rows;
    
                 $total_pages = ceil($total_rows / $records_per_page); //ceil - grazina sveika skaiciu, apvalindama i didesne puse
    
                 $res_data = $mysqli->query("SELECT * FROM product LIMIT $offset, $records_per_page"); //LIMIT - praleidzia tiek, kiek yra offsete
                 
                 while($row = mysqli_fetch_assoc($res_data)){
                     ///
                     $output .= '
                <tr>
                     <td>'.$row['id'].'</td>
                     <td>'.$row['caption'].'</td>
                     <td>'.$row['tekstas'].'</td>
                     <td>'.$row['price'].'</td>
                     <td>'.$row['pic'].'</td>
                     <td>
                         <a href="crud.php?edit='.$row['id'].'" class="btn btn-info">Redaguoti</a>
                         <a href="procesai.php?delete='.$row['id'].'" class="btn btn-danger">Šalinti</a>
                     </td>
                 </tr>';
                 
                 }
                 echo $output;
                 ?>
             </table> 
                 <ul class="pagination justify-content-center py-4">
                 <li><a class="page-link" href="?pageno=1">Pradinis</a></li>
                 <li class=" page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                     <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; }
                                                 else { echo "?pageno=".($pageno - 1); } ?>">&laquo;</a>
                 </li>
                 <?php for($i = 1; $i <= $total_pages; $i++){ ?>
                 <li class="page-item <?php if($pageno == ($i)){ echo 'active'; } ?>">
                     <a class="page-link" href="<?php echo"?pageno=".($i); ?>">
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
        </div>
<?php } ?>
</div>


<div class="container">
<?php
if(isset($_SESSION['message'])): ?>
    <div class="alert alert-<?php=$_SESSION['msg_type']?>">
    <?php
echo $_SESSION['message'];
unset($_SESSION['message']);?>
</div>
<?php endif?>
</div>

<div class="container">
<div class="d-flex justify-content-start">
<div class="col-3 offset-1">
            <form action="procesai.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                
                <div class="form-group">
                    <label>Caption</label>
                    <input type="text" name="caption" class="form-control" value="<?php echo $caption; ?>" placeholder="Įveskite caption">
                </div>
                <div class="form-group">
                    <label>Text</label>
                    <input type="text" name="tekstas" class="form-control" value="<?php echo $tekstas; ?>" placeholder="Įveskite text">
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="price" class="form-control" value="<?php echo $price; ?>" placeholder="Įveskite price">
                </div>
                <div class="form-group">
                    <label>Picture</label>
                    <input type="file" name="myfile">
                </div>
                <br>
                <div class="form-group">
                    <?php
                    if ($update==true):
                    ?>
                    <button class="btn btn-info" type="submit" name="update">Atnaujinti</button>
                    <?php else:?>
                    <button class="btn btn-primary" type="submit" name="save">Saugoti</button>
                    <?php endif;?>
                </div>
            </form>
</div>
</div>
</div>

<div class="container">
<div class="d-flex justify-content-end">
<form action="log_in.php" method="post">
    <button class="btn btn-danger" type="submit" name="atsijungti">Atsijungti</button>
</form>
</div>
</div>

<?php
include "footer.php";
?>
             
 <!-- Optional JavaScript -->
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>

</html>
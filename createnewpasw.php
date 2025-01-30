<html lang="lt">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Pakeisti slaptažodį</h5>

                        <?php
                        $selector = $_GET['selector'];
                        $validator = $_GET['validator'];

                        if(empty($selector) || empty($validator)){
                            echo "nepavyko įvykdyti užklausos";
                        }else{//patikrina ar tikrai šešioliktiniai
                        //tikrina ar sutampa reiksme ir tipas
                        if(ctype_xdigit($selector) !== false
                        && ctype_xdigit($validator) !== false){
                        ?>
                      
                        <form action="process.php?action=resetpass" method="POST" class="login">
                            <div class="form-label-group">
                                <label for="inputPSW">Slaptažodis</label>
                                <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                                <input type="hidden" name="validator" value="<?php echo $validator; ?>">
                                <input type="password" name="psw1" class="form-control" placeholder="Slaptažodis" required />

                            </div>
                            <div class="form-label-group">
                                <label for="inpuPSW2">Pakartokite slaptažodį</label>
                                <input type="password" name="psw2" class="form-control" placeholder="Pakartokite slaptažodį" required />

                            </div <hr class="my-4">
                            <button class="btn btn-lg btn-danger btn-block text-uppercase" type="submit" value="Pakeisti" name="resetpasswordsubmit">Pakeisti</button>
                        </form>
                        <?php } else{
                            echo "netinkama užklausa";
                        }
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>

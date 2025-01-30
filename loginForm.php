<html lang="lt">
<head>
    <meta charset="utf-8">
    <title>Prisijungimas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Prisijunkite</h5>
                        <form action="prisijungimas.php" method="POST" class="login">
                            <div class="form-label-group">
                                <label for="inputUser">Naudotojo vardas</label>
                                <input type="text" id="inputUser" name="user" class="form-control" placeholder="Naudotojo vardas" required />
                            </div>
                            <div class="form-label-group">
                                <label for="inputPassword">Slaptažodis</label>
                                <input type="password" id="inputPassword" name="psw" class="form-control" placeholder="Slaptažodis" required />
                            </div class="my-4">
                            <br>

                            <div class="fs-5 text-danger">
                            <?php
                            if (isset($_SESSION['error']))
                            {
                                echo $_SESSION['error'];
                            }
                            ?>
                            </div>

                            <br>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Prisijungti">Prisijungti</button>
                            <input type="hidden" name="sublogin" />
                            <br>
                            <br>
                            <a href="log_in.php?action=forgotpass">Negalite prisijungti?</a>
                            <a href="register.php">Registracija</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</html>

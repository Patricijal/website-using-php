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
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Prisiregistruokite</h5>
                        <form action="process.php" method="POST" class="login">
                        <div class="form-label-group">
                                <label for="inputUser">El. paštas</label>
                                <input type="text" id="inputUser" name="user" class="form-control" placeholder="El. paštas" required />
                            </div>
                            <div class="form-label-group">
                                <label for="inputUser">Naudotojo vardas</label>
                                <input type="text" id="inputUser" name="user" class="form-control" placeholder="Naudotojo vardas" required />
                            </div>
                            <div class="form-label-group">
                                <label for="inputPassword">Slaptažodis</label>
                                <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Slaptažodis" required />
                            </div <hr class="my-4">
                            <div class="form-label-group">
                                <label for="inputPassword">Pakartokite slaptažodį</label>
                                <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Slaptažodis" required />
                            </div <hr class="my-4">
                            <br>
                            <button class="btn btn-lg btn-success btn-block text-uppercase" type="submit" value="Prisijungti">Registruotis</button>
                            <input type="hidden" name="sublogin" />
                            <br>
                            <a href="log_in.php">Prisijungti</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include "footer.php";
?>

</body>

</html>
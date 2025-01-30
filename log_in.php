<?php
include("session.php");
CheckLogIn();
LogOut();
?>


<html lang="lt">
<head>
    <meta charset="utf-8">
    <title>Prisijungimas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>

<div class="container">
<?php
include "meniu.php";
?>
</div>


    <?php
    if (isset($_SESSION['login'])) {
        include("crud.php"); // paleidziant puslapi, kuri mato prisijunges vartotojas
    ?>
    <div>
        <br><br>
        <h1>Pradinis sistemos puslapis (index2.php).</h1>
    </div><br>
    <?php
    } else if (isset($_GET['action']))
    {
        include($_GET['action'].".php");
    } else {
        include("loginForm.php");
    }
    ?>



<?php
include "footer.php";
?>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</html>

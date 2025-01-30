<?php
include 'db2.php';
session_start();
$error = ""; // klaidos tekstas
if (isset($_POST['user'])
&& isset($_POST['psw']) ) {
    // jeigu paspaustas mygtukas "Prisijungti"
    // tikrinam userį
    if (confirmUserPass($_POST['user'], $_POST['psw'])==0) {
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['login']=true;
        addActiveUser($_SESSION['user'], time());
        removeActiveGuest($_SERVER['REMOTE_ADDR']);

    } else if (confirmUserPass($_POST['user'], $_POST['psw'])==1) {
        $error = "user nerastas";
        $_SESSION['error'] =$error;
        header('Location: log_in.php');
    } else if (confirmUserPass($_POST['user'], $_POST['psw'])==2) {
        $error = "Neteisingi prisijungimo duomenys";
        $_SESSION['error'] =$error;
        header('Location: log_in.php');
    }
}
if ($_SESSION['login']) {
    header('Location: crud.php');
}
?>
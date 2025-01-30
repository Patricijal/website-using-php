<?php 
include 'db2.php';
if(!isset($_SESSION)) {
  session_start();
}
removeInactiveUsers();

/* svecio reiksme, neprisijungusiems narsytojams*/
  if (!isset($_SESSION['login'])) {
      addActiveGuest($_SERVER['REMOTE_ADDR'], time());
  }

 function CheckLogOut() {
	 if (!$_SESSION['login']) {
		header('Location: log_in.php');
		}
	}
	
 function LogOut() {
	 if (isset($_POST['atsijungti'])) {
  // jeigu paspaustas mygtukas 
   session_unset(); // išvalo visus kintamuosius
   session_destroy(); // panaikina pačią sesiją
   header('Location: log_in.php');//į prisijungimo psl
   }
}

function CheckLogIn() {
if (isset($_SESSION['login'])) {
  header('Location: crud.php');
  }
}

?>

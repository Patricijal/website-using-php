<?php
include 'db2.php';
if((isset($_POST['user']))&&(isset($_POST['pass']))){
   if(confirmUserPass($_POST['user'], $_POST['pass']) ==0){
    header('Location: crud.php'); }
} else if(isset($_GET['action'])){
    if($_GET['action']=="resetrequest"){
       if(isEmailInDB($_POST['email'])==0){
         header("Location: forgotpass.php?r=usernotfound");  
       }
        $userEmail = $_POST['email'];
        if(isEmailInDB($userEmail)==1){
          $selector = bin2hex(random_bytes(8)); // sugeneruoja skaiciu sekas
          $token = bin2hex(random_bytes(32));
          $url = "http://localhost/projektas/sl_keitimas/createnewpasw.php?selector=".$selector."&validator=".$token;
          $expires = date("U")+3600;
          deleteIfRequestExsists($userEmail);
          insertTokenDB($userEmail, $selector, $token, $expires);
          $to = $userEmail;
          $subject = "Slaptažodžio keitimas";
          $message = "Gavome jūsų užklausą slaptažodžio pakeitimui.\r\n";
          $message .= "nuoroda pakeitimui: \r\n";
          $message .= "$url";
          $headers = "From: <p???@gmail.lt>\r\n"; // turetu buti paslepta/uzsifruota
          $headers .= "Reply-to: p???@gmail.lt\r\n";

          if (mail($to, $subject, $message, $headers)){
            header("Location: forgotpass.php?r=sent");
          }
        }
           
    }
    if($_GET['action']=="resetpass"){
      if(isset($_POST['resetpasswordsubmit'])){
        $selector = $_POST['selector'];
        $validator = $_POST['validator'];
        $psw1 = $_POST['psw1'];
        $psw2 = $_POST['psw2'];

        if(empty($selector) || empty($validator)){
          header("Location: createnewpasw.php?selector=".$selector."&validator=".$validator."&r=empty");
        }else{
          if($psw1 != $psw2){
            header("Location: createnewpasw.php?selector=".$selector."&validator=".$validator."&r=pswnotmatch");
          }else if ($psw1 == $psw2){
            $currentdate = date("U");
            $result = selectResetData($selector, $currentdate);
            if(!$result || ($result->num_rows < 1)){
              header("Location: createnewpasw.php?selector=".$selector."validator=".$validator."&r=error1");
            }else{
              $row = $result->fetch_assoc();
              $tokenCheck = strcmp($validator, $row['token']);
              if($tokenCheck != 0){
                header("Location: createnewpasw.php?selector=".$selector."&validator=".$validator."&r=error2");
              }else if ($tokenCheck == 0){
                $tokenEmail = $row['email'];
                $result = findUser($tokenEmail);
                if (!$result || ($result->num_rows < 1 )){
                  header("Location: createnewpasw.php?selector=".$selector."&validator=".$validator."&r=error3");
                }else{
                  $row = $result->fetch_assoc();
                  resetPasw($row['email'], md5($psw1));

                  //issiuncia laiska, jog pakeistas slaptazodis
                  $to = $tokenEmail;
                  $subject = "Pasikeitimai sistemoje";
                  $message = "Jūsų slaptažodis pakeistas sėkmingai.\r\n";
                  $headers = "From: <p???@gmail.lt>\r\n";
                  $headers .= "Reply-to: p???@gmail.lt\r\n";
                  mail($to, $subject, $message, $headers);

                  deleteToken($tokenEmail);
                  header("Location: createnewpasw.php?selector=".$selector."&validator=".$validator."&r=passwordupdated");
                }
              }
            }
          }
          }
      }
    }
  
    }
?>

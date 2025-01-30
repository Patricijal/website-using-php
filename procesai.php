<?php

session_start();
$mysqli=new mysqli('localhost', 'root', '', 'svetaine') or die(mysqli_error($mysqli));

$update = false;
$id="";
$caption="";
$tekstas="";
$price="";
$pic="";

if(isset($_POST['save'])){
    $id =$_POST['id'];
    $caption =$_POST['caption'];
    $tekstas =$_POST['tekstas'];
    $price =$_POST['price'];
    $pic =$_FILES["myfile"]["name"]; //nebaigta

    $mysqli->query("INSERT INTO product(id, caption, tekstas, price, pic)
    VALUES('$id', '$caption', '$tekstas', '$price', '$pic')")
    or die(mysqli_error($mysqli));
    $_SESSION['message']="išsaugota";
    $_SESSION['msg_type']="success";
    header("location: crud.php");
}

if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $mysqli->query("DELETE FROM product WHERE id='$id'") 
    or die(mysqli_error($mysqli));
    $_SESSION['message']="ištrinta";
    $_SESSION['msg_type']="danger";
    header("location: crud.php");
}

if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $update=true;
    $result = $mysqli->query("SELECT * FROM product WHERE id='$id'")
    or die(mysqli_error($mysqli));
        $row=$result->fetch_array();
        $id =$row['id'];
        $caption =$row['caption'];
        $tekstas =$row['tekstas'];
        $price =$row['price'];
        $pic =$row['pic'];
}

if(isset($_POST['update'])){
    $id=$_POST['id'];
    $caption=$_POST['caption'];
    $tekstas =$_POST['tekstas'];
    $price =$_POST['price'];
    
    $filename = $_FILES["myfile"]["name"];
    $tempname = $_FILES["myfile"]["tmp_name"];
    $folder = "product/".$filename;

    $mysqli->query("UPDATE product SET id='$id', caption='$caption', tekstas='$tekstas',
    price='$price', pic='$filename' WHERE id='$id'")
    or die (mysqli_error($mysqli));
    if (move_uploaded_file($tempname, $folder)){
        $_SESSION['message']="Įrašas atnaujintas";
        $_SESSION['msg_type']="Warning";
    }else{
        $_SESSION['message']="Nepavyko įkelti failo";
    }
    header("location: crud.php");
}

?>
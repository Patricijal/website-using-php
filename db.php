<?php
include 'config.php';
$db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
//atrenka informacija su skaidrem
function getSlides() {
    global $db;
    $query = "SELECT * FROM slides ORDER by id ASC";
    $result=$db->query($query);
    return $result;
}
//komponuoja skaidres
function slideIndicators() {
    $output = ''; 
    $count = 0;
    $result = getSlides();
    
    while($row = mysqli_fetch_assoc($result))
    {
        if($count == 0){
            $output .= '
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'.$count.'" class="active" aria-current="true" aria-label="Slide 0"></button>';
        }
        else
        {
        $output .= '
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'.$count.'" aria-label="Slide '.$count.'"></button>';
        }
        $count = $count + 1;
    }
    return $output;
}
//uzpildo duomenimis
function makeSlides() {
    $output = '';
    $count = 0;
    $result = getSlides();

    while($row = mysqli_fetch_assoc($result)){
    if($count == 0)
    {
        $output .= '<div class="carousel-item active">';
    }
    else
    {
        $output .= '<div class="carousel-item">';
    }
        $output .= '
        <img class="d-block w-100" src="slides/'.$row["pic"].'" alt="'.$row["caption"].'">
        </div>';
    $count = $count + 1;
    }
    return $output;    
    }

function intro() {
    global $db;
    $query = "SELECT tekstas FROM intro WHERE id = 1";
    $result=$db->query($query); //query - ivykdo uzklausa
    $row = mysqli_fetch_assoc($result); // pavercia i asociatyvu masyva
    return $row['tekstas'];
}

function getProduct() {
    global $db;
    $query = "SELECT * FROM product ORDER by id ASC";
    $result=$db->query($query);
    return $result;
}

function makeProduct() {
    $output = '';
    $count = 0;
    $result = getProduct();
    while($row = mysqli_fetch_assoc($result)){
  
        $output .= '
        <div class="col-sm-3">
                <div class="card">
                    <img class="card-img-top" src="product/'.$row["pic"].'" alt="'.$row["caption"].'">
                    <div class="card-body">
                        <h5 class="card-title">'.$row["caption"].'</h5>
                        <h6 class="card-subtitle mb-2 text-muted">'.$row["price"].'</h6>
                        <p class="card-text">'.$row["text"].'</p>
                        <a href="#" class="btn btn-secondary">Detaliau...</a>
                    </div>
                </div>
            </div>
        
        ';
        
    $count = $count + 1;
    }
    return $output;    
}

    ?>
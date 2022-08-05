<?php  

$db = mysqli_connect("localhost", "root", "root", "muo-beta");

if(!$db){
    echo "no se conecto";
    die();
}

//POO DB

$databases = new mysqli("localhost", "root", "root", "muo-beta");


?>
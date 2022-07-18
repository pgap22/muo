<?php  
session_start();
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
if(!isset($_SESSION["email"])){
    header("location: /");
    die();
}
?>
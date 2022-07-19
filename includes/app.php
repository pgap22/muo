<?php  
include "functions.php";
function autoload($clase){
    include '../clases/'.$clase.".php";
}

spl_autoload_register("autoload");

$db = new User();
debugear($db->getUsers());
?>
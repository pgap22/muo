<?php  
header("Access-Control-Allow-Origin: *");

if(isset($_GET["lang"])){
   session_start();
   $lang = $_GET["lang"];
   
   if($lang == "es"){
    $_SESSION["lang"] = "es";
   }
   elseif($lang == "en"){
    $_SESSION["lang"] = "en";
   }
}
?>
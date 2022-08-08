<?php 
header("Access-Control-Allow-Origin: *");

use MUO\ActiveRecord;
use MUO\Usuarios;

include "../includes/app.php";

if(isset($_GET["emailToken"])){

    $eToken = $_GET["emailToken"];

    $result = Usuarios::checkValidation($eToken);

    echo json_encode($result);
}

if(isset($_GET["passToken"])){

    $pToken = ActiveRecord::sanitize($_GET["passToken"]);

    $query = "SELECT limit_time, resend_code FROM passwordcode WHERE passToken= '$pToken'";

    $result =  ActiveRecord::fetchResultSQL(ActiveRecord::executeSQL($query));

    echo json_encode($result);
}

?>
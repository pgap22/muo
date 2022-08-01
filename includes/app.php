<?php

use MUO\NoVerifiedUser;
use MUO\User;
require "db.php";
require "functions.php";

function autoload($clase){
    $clase = explode("\\", $clase);
    include   '../clases/' . $clase[1]. ".php";
}

spl_autoload_register("autoload");


User::setDB($databases);

?>
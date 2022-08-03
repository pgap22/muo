<?php

use MUO\NoVerifiedUser;
use MUO\User;
use MUO\Util;

require "db.php";
require "functions.php";

function autoload($clase){
    $clase = explode("\\", $clase);
    include   '../clases/' . $clase[1]. ".php";
}

spl_autoload_register("autoload");


Util::setDB($databases);

?>
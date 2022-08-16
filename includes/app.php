<?php

use MUO\ActiveRecord;
use MUO\NoVerifiedUser;
use MUO\User;
use MUO\Util;

require "db.php";
require "functions.php";

function autoload($clase){
    $clase = explode("\\", $clase);
    require  $_SERVER["DOCUMENT_ROOT"] . '/clases/' . $clase[1]. ".php";
}

spl_autoload_register("autoload");


ActiveRecord::setDB($databases);

?>
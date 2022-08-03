<?php

use MUO\NoVerifiedUser;
use MUO\Passwordcode;

include "../includes/app.php";

$xd =Passwordcode::getRequestByPassToken("e45016ea32610b1d");
debugear($xd);
?>
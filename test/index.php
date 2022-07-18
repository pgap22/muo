<?php  

echo "<pre>";
var_dump($_SERVER);
echo "</pre>";

$localIP = gethostbyname(gethostname());
// Displaying the address 
echo $localIP;
?>
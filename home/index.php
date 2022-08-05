<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUO - PAGINA PRINCIPAL</title>
</head>
<body>
<?php  
session_start();
if(!isset($_SESSION["user_token"])){
    header("location: /");
}



echo "<h1>Welcome :D</h1>";
echo "this is your userToken ! ".$_SESSION["user_token"];
echo "<br>";
echo "<a href='/auth/logoutUser.php'>Logout</a>";

echo $_SESSION["lang"];
?>
</body>
</html>
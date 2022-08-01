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
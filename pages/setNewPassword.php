<?php  
include "../includes/db.php";
include "../includes/functions.php";
$error = [];
if(!isset($_GET["token"])){
    header("location: /pages/recoverPassword.php");
}
$token = $_GET["token"];
$query = "SELECT * FROM passwordcode WHERE passToken = ?";
$result = checkToken($db, $query, $token);
if(!$result || $result["verified"] == 0){
    header("location: /pages/recoverPassword.php");
}

if(isset($_GET["renew-password"])){
    $password = $_GET["renew-password"];
    if($password == ""){
        $error["recover-password"]  = "Tu contraseña no puede estar vacia !";
        $error["code"] = 16;
    }else{
        $userId = $result["user_id"];
        mysqli_query($db, "DELETE FROM passwordcode WHERE user_id = '$userId' ");

        $newPassword = password_hash($password, PASSWORD_DEFAULT);

        mysqli_query($db, "UPDATE usuarios SET password = '$newPassword' ");
        
        session_start();
        $_SESSION["verification"] = true;
        header("location: /pages/renewPassComplete.php");
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="black">
    <meta name="description" content="Un sitio web de museos">
    <title>MUO - VERIFICAR EMAIL</title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">

    <!--Font-->
    <link rel="preload" href="../fonts/font.css" as="style">
    <link rel="stylesheet" href="../fonts/font.css">

    <!--Custom Properties-->
    <link rel="preload" href="../css/general/general.css" as="style">
    <link rel="stylesheet" href="../css/general/general.css">

    <link rel="preload" href="../css/emailTemplate/mobile/style.css" as="style">
    <link rel="preload" href="../css/emailTemplate/desktop/style.css " as="style">
    <link rel="stylesheet" href="../css/emailTemplate/mobile/style.css" media="(max-width: 741px)">
    <link rel="stylesheet" href="../css/emailTemplate/desktop/style.css " media="(min-width: 742px)">
</head>

<body>

    <main>
        <div class="verification">
            <picture class="verification__logo">
                <source srcset="../img/logo/logo.svg" media="(min-width: 742px)">
                <img src="../img/logo/logo-mobile.svg" alt="logo de MUO">
            </picture>
            <div class="verification__text">
                <h1 class="verification__title">
                    Cambiar contraseña
                </h1>
                <p>Listo ahora digita tu nueva contraseña !</p>
            </div>
            <div class="verification__img">
                <img src="../img/icons/password.svg" alt="password Icon" class="verification__error">
            </div>
            
            <form class="verification__form" action="setNewPassword.php" method="GET">
                <div class="form__input flex-center">
                    <label for="email-recover" class="form__label">Nueva contraseña</label>
                    <?php  
                    getError($error, "recover-password");
                    ?>
                    <div class="form__password <?= getColorError($error, "recover-password")?>">
                            <input type="password" name="renew-password" id="password_login" placeholder="Ingresa tu contraseña" required autocomplete="current-password">
                            <img src="../img/icons/eye-off.svg" width="30" alt="" id="password_see">
                    </div>
                </div>
                <button type="submit" class="verification__button verification__button--submit">
                        <span class="verification__button-text">Enviar</span>
                        <span class="verification__decoration"></span> 
                </button>
                <input type="hidden" value="<?=$token?>" name="token">
            </form>
          
        </div>
    </main>
    <script src="../js/general.js" type="module"></script>
    <script src="../js/button.js"></script>
    <script src="../js/password.js"></script>
</body>

</html>
<?php  
include "../includes/db.php";
include "../includes/functions.php";


if(!isset($_GET["token"])){
    header("location: /pages/recoverPassword.php");
}
$error = [];
$token = $_GET["token"];
$code = [];

for ($i=0; $i < 5; $i++)
{ 
    if(isset($_GET["code-".($i+1)])){
        $code[$i] = $_GET["code-".($i+1)];
    }
} 
$code = join("", $code);

$query = "SELECT * FROM passwordCode WHERE passToken = ?";
$result = checkToken($db, $query, $token);
$userId = $result["user_id"];
if(!$result){
    header("location: /pages/recoverPassword.php");
}

if(isset($_GET["form-submited"])){
    $now = new DateTime("now", TIMEZONE_GMT6);
    $limit = date_create($result["limit_time"]);

    $now = date_timestamp_get($now)-GMT_6;
    $limit = date_timestamp_get($limit);


    if(!$code){
        echo "El codigo esta vacio";
        $error["resend-code"] = "El codigo esta vacio";
        $error["code"] = 13;
    }
    else if(strlen($code) != 5){
        echo "El codigo es invalido";
        $error["resend-code"] = "El codigo es invalido";
        $error["code"] = 14;
    }
    else if($limit<$now){
        echo "El codigo ya ha expirado";
        $error["resend-code"] = "El codigo ya ha expirado";
        $error["code"] = 15;
    }
    else{
        $query = "SELECT * FROM passwordcode WHERE passToken = ? AND code = ?";

        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "ss", $token, $code); 
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $res = mysqli_fetch_assoc($res);
      
        if($res){
         echo "ok";
         mysqli_query($db, "UPDATE passwordcode SET verified = 1 WHERE passToken = '$token'");
         header("location: /pages/setNewPassword.php?token=".$token);
        }
        else{
         echo "codigo incorrecto";
         $error["resend-code"] = "Codigo incorrecto";
         $error["code"] = 16;
        }
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
    <title>MUO - CODIGO VERIFICACION</title>
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
                    Ingresa el codigo de verificaion
                </h1>
                <p class="verification__wrong-mail">Verifica en tu correo el codigo de verificacion que te hemos enviado</p>
            </div>
            <div class="verification__img">
                <img src="../img/icons/key.svg" alt="key Icon" class="verification__error">
            </div>
            <div class="verification__timer hidden">
                <p class="verification__counterdown">0:00</p>
                <p class="verification__timer-error">Proximo reenvio</p>
            </div>

            <div class="verification__error-message">
                <?php  
                    getError($error, "resend-code");
                ?>
            </div>

            <form action="changePassword.php" class="verification__form" method="GET" name="passwordCode" required>
                <div class="verification__code-reset">
                    <div class="verification__input-code">
                        <input type="number" class="verification__code <?=getColorError($error, 'resend-code')?>" required autocomplete="off" min=0 max=9 pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="code-1">
                    </div> 
                    <div class="verification__input-code">
                        <input type="number" class="verification__code <?=getColorError($error, 'resend-code')?>" required autocomplete="off" min=0 max=9 pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="code-2">
                    </div> 
                    <div class="verification__input-code">
                        <input type="number" class="verification__code <?=getColorError($error, 'resend-code')?>" required autocomplete="off" min=0 max=9  pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="code-3">
                    </div> 
                    <div class="verification__input-code">
                        <input type="number" class="verification__code <?=getColorError($error, 'resend-code')?>" required autocomplete="off" min=0 max=9 pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="code-4" >
                    </div> 
                    <div class="verification__input-code">
                        <input type="number" class="verification__code <?=getColorError($error, 'resend-code')?>" required autocomplete="off" min=0 max=9 pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="code-5">
                    </div> 
                </div>

                <input type="text" hidden value="<?=$token?>" name="token" class="token-passcode">
                <input type="text" hidden value="<?=$userId?>" class="user-id">
                <input type="text" hidden name="form-submited" value="true" >

                <a href="/auth/resendPassCode.php?token=<?=$token?>" class="verification__resend-code" id="resend-pass-code">Reenviar codigo</a>

                <button type="submit" class="verification__button">
                        <span class="verification__button-text">Verificar codigo</span>
                        <span class="verification__decoration"></span> 
                </button>
            </form>

           
          
        </div>
    </main>
    <!-- <script src="../js/general.js" type="module"></script> -->
    <script src="../js/passCode.js"></script>
    <script src="../js/button.js"></script>
</body>

</html>
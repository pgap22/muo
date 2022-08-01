<?php  
include "../includes/db.php";
include "../includes/functions.php";


$wrongEmail = false;
$emptyEmail = false;
$email = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email-recover"];
    $query = "SELECT * FROM usuarios WHERE email = ?";

    $result = checkToken($db, $query, $email);

    if($result){
        $wrongEmail = false;
        $code = rand(10000, 99999);
        $code= intval($code);

        $id = $result["id"];
        $id = intval($id);

        $emailSended = true;

        $timeZone = new DateTimeZone("GMT-6");
        $time = new DateTime("now", $timeZone);
        $GMT_6 = 21600;
        $time = date_timestamp_get($time);


        $time_limit = gmdate("Y/m/d H:i:s", ($time-$GMT_6)+900);
        $resend = gmdate("Y/m/d H:i:s", ($time-$GMT_6));

        $time_limit = new DateTime($time_limit);
        $resend = new DateTime($resend);

        $time_limit = (array) $time_limit;
        $time_limit = $time_limit["date"];

        $resend = (array) $resend;
        $resend = $resend["date"];
        
        $passToken = bin2hex(openssl_random_pseudo_bytes(8));


        $query = "INSERT INTO passwordCode(code, user_id, limit_time, resend_code, passToken, verified) VALUES($code, $id, '$time_limit', '$resend', '$passToken', 0)";
        // $message = templateEmailNoButton("Recuperar Contraseña", $result["nombre_usuario"], "Este es tu codigo para restablecer tu contraseña", $code);        
        echo $query;
        $ok = mysqli_query($db, $query);
        
        if($ok){
            
            $message["title-es"] = "Recupera Contraseña";
            $message["title-en"] = "Recover Password";

            $message["message-es"] = templateEmailNoButton($message["title-es"], $result["nombre"], "Hola, copia y pega este codigo de verificacion donde se te indique\n\n<b>Recuerda que en 15 minutos el codigo se expirara", $code);
            $message["message-en"] = templateEmailNoButton($message["title-en"], $result["nombre"], "Hello, copy and paste this verification code where you are indicated\n\n<b>Remember that in 15 minutes the code will expire", $code);


            sendMail($email, $message);
            header("location: /pages/changePassword.php?token=$passToken");    
        }

    }
    else{

        if(empty($email)){
            $emptyEmail = true;
        }
        else{
            $wrongEmail = true;
            $email = $_POST["email-recover"];
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

<body data-page="recover-pass">

    <main>
        <div class="verification">
            <div class="verification__top">

                <div class="verification__back">
                    <a href="/pages/login.php"><img src="../img/icons/arrowLeft.svg" alt="Back"></a>
                </div>

                <picture class="verification__logo">
                    <source srcset="../img/logo/logo.svg" media="(min-width: 742px)">
                    <img src="../img/logo/logo-mobile.svg" alt="logo de MUO">
                </picture>
            </div>
            <div class="verification__text">
                <h1 class="verification__title" id="title">
                    Cambiar contraseña
                </h1>
                <p id="text">Ingresa tu correo para cambiar la contraseña !</p>
            </div>
            <div class="verification__img">
                <img src="../img/icons/password.svg" alt="password Icon" class="verification__error">
            </div>
            
            <form class="verification__form" action="recoverPassword.php" method="POST">
                <div class="form__input">
                    <label for="email-recover">Email</label>
                    
                    <?= sendMessage("El email no esta registrado con una cuenta en MUO", $wrongEmail, "wrong-email")?>
                    <?= sendMessage("El email esta vacio", $emptyEmail, "empty-email")?>

                    <input type="email" name="email-recover" id="email-recover" required placeholder="Ingresa tu email"  value=<?= getInputValue($email);?>>
                </div>
                <button type="submit" class="verification__button verification__button--submit">
                        <span class="verification__button-text" id="btn">Enviar</span>
                        <span class="verification__decoration"></span> 
                </button>
            </form>
          
        </div>
    </main>
    <script src="../js/general.js" type="module"></script>
    <script src="../js/button.js"></script>
</body>

</html>
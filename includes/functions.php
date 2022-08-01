<?php

require "PHPMailer/PHPMailer.php";
require "PHPMailer/Exception.php";
require "PHPMailer/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

define("GMT_6", 21600);
define("TIMEZONE_GMT6", (new DateTimeZone("GMT-6")));



function checkToken($db, $query, $token){
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

function debugear($e){
    echo '<pre>';
    var_dump($e);
    echo '</pre>';
}

function sendMessage($message, $bool, $id_translate){
    if($bool){
        return "<p class='notification__message' id=$id_translate>${message}</p>";
    }
}

function getInputValue($value){
    return $value ?? "";
}

function getError($error, $type){
    if(isset($error[$type])){
        $errorCode = $error["code"];
        echo "<p class='errorMessage error' id='$errorCode-e'>$error[$type]</p>";
    }
}

function getColorError($error, $type){
    if(isset($error[$type])){
        return "errorBorder";
    }
    return "";
}
function restoreFormData($newUser,$data){
    return $newUser[$data] ?? "";
}

function submitMail($mail, $title, $body){
    $mail = new PHPMailer();
    try {
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'muo.website@outlook.com';                     //SMTP username
        $mail->Password   = 'basededatoslevi098';                               //SMTP password
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        //Recipients
        $mail->setFrom('muo.website@outlook.com', 'MUO Website');
        $mail->addAddress('gerardo.saz120@gmail.com', "MUO User");     //Add a recipient
    
    
        //Content
        $mail->Subject = $title;
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Body = $body;
    
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
function sendMail($email,$mailMessage){
    // die();z
    if(!isset($_SESSION)){
        session_start();
    }

    if($_SESSION["lang"] == "es"){
        submitMail($email, $mailMessage["title-es"],$mailMessage["message-es"]);
    }
    elseif($_SESSION["lang"] == "en"){
        submitMail($email, $mailMessage["title-en"],$mailMessage["message-en"]);
    }


}
function templateEmail($title, $usuario, $texto, $url, $botonNombre, $lang = "es"){
    if($lang == "en"){
        $greeting = "Hi";
    }
    else{
        $greeting = "Hola";
    }
    $message = "
    <html>
    <head>
        <style>
            *{
                margin: 0;
                padding: 0;
            }
            body{
                font-family: sans-serif;
            }
        </style>
    </head>
    <body class='main'>
        <center>
            <table bgcolor='black' width='100%'>
                <tr >
                    <td width='25%'></td>
                    <td width='25%'>
                      <center>
                        <img width='300' src='http://drive.google.com/uc?export=view&id=19hpn-esQGFecb-sqqQ7iZiqFCks0Dd-j' alt='Imagen del Logo de MUO'>
                      </center>
                    </td>
                    <td width='25%'></td>
                </tr>
                <tr>
                    <td width='15%' bgcolor='black'></td>
                    <td width='50%' bgcolor='white'>
                        <center><h1>${title}</h1></center>
                        <br><br><br><br>
                        <p>${greeting} <b>${usuario}</b></p>
                        <br><br>
                        <p>${texto}</p>
                        <br><br><br><br>
                        <a href='${url}' style='text-decoration: none; color:white; background-color: black; margin: 20px; padding: 20px; '>${botonNombre}</a>
                        <br>
                        <br>
                        <br>
                        <br>
                    </td>
                    <td width='15%' bgcolor='black'></td>
                </tr>
            </table>
        </center>
    </body>
    </html>
    ";
    return $message;
    }

function templateEmailNoButton($title, $usuario, $texto, $code, $lang = "es"){
        if($lang == "en"){
            $greeting = "Hi";
        }
        else{
            $greeting = "Hola";
        }
        $message = "
        <html>
        <head>
            <style>
                *{
                    margin: 0;
                    padding: 0;
                }
                body{
                    font-family: sans-serif;
                }
            </style>
        </head>
        <body class='main'>
            <center>
                <table bgcolor='black' width='100%'>
                    <tr >
                        <td width='25%'></td>
                        <td width='25%'>
                          <center>
                            <img width='300' src='http://drive.google.com/uc?export=view&id=19hpn-esQGFecb-sqqQ7iZiqFCks0Dd-j' alt='Imagen del Logo de MUO'>
                          </center>
                        </td>
                        <td width='25%'></td>
                    </tr>
                    <tr>
                        <td width='15%' bgcolor='black'></td>
                        <td width='50%' bgcolor='white'>
                            <center><h1>${title}</h1></center>
                            <br><br><br><br>
                            <p>${greeting} <b>${usuario}</b></p>
                            <br><br>
                            <p>${texto}</p>
                            <br><br><br><br>
                            <b>${code}</b>
                            <br>
                            <br>
                            <br>
                            <br>
                        </td>
                        <td width='15%' bgcolor='black'></td>
                    </tr>
                </table>
            </center>
        </body>
    </html>
        ";
        return $message;
        }
        
    

?>
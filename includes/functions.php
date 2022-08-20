<?php

use MUO\Usuarios;

define("GMT_6", 21600);
define("TIMEZONE_GMT6", (new DateTimeZone("GMT-6")));





function debugear($e){
    echo '<pre>';
    var_dump($e);
    echo '</pre>';
}

function restoreSelectItem($arr, $data, $id){
    if(!isset($arr[$data])) return '';
    
    if($arr[$data] == $id){
        return "main__items--selected";
    }
}

function sendAlert($alert, $message, $title, $type){
    if($alert == "pop"){
        return sendAlertPop($message, $title);
        
    }
    else if($alert == "simple"){
        return sendSimpleAlert($message, $type);
    }
}

function sendAlertPop($message, $title){
    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION["alert"])){
        unset($_SESSION["alert"]);
    }
    return "<div class='pop-up-alert' data-message='$message' data-title='$title'></div>";
    
}

function sendSimpleAlert($message, $type){
    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_SESSION["alert"])){
        unset($_SESSION["alert"]);
    }
    return "<div class='simple-alert' data-type='$type' data-message='$message'> </div>";
    
}


function sendMessage($message, $bool, $id_translate){
    if($bool){
        return "<p class='notification__message' id=$id_translate>${message}</p>";
    }
}

function getInputValue($value){
    return htmlspecialchars($value) ?? "";
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
    if(isset($newUser[$data])){
        return htmlspecialchars($newUser[$data]);
    }
    return "";
}

function sendMail($email,$mailMessage){
    // die();z
    if(!isset($_SESSION)){
        session_start();
    }

    if($_SESSION["lang"] == "es"){
        mail($email, $mailMessage["title-es"],$mailMessage["message-es"], "Content-Type: text/html; charset=utf-8\r\n");
    }
    elseif($_SESSION["lang"] == "en"){
        mail($email, $mailMessage["title-en"],$mailMessage["message-en"], "Content-Type: text/html; charset=utf-8\r\n");
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
        
    function showHeader(){
        
        if(!isset($_SESSION)){
            session_start();
        }

     
        if(isset($_SESSION['user_id'])){
            include "../includes/templates/headerLogged.php";
        }
        else{
            include "../includes/templates/header.php";
        }
    }

    function protegerIndex(){
        if(!isset($_SESSION)){
            session_start();
        }

        if(isset($_SESSION["user_id"])){
            header("location: /home");
        }
    }
    
    function protegerHome(){
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION["user_id"])){
            header("location: /pages");
        }
        else{
            $userID = $_SESSION["user_id"];
            $user = Usuarios::find($userID);
            if($user->isAdmin){
                header("location: /admin");
            }
        }
    }

    function protegerAdmin($id){
        $user = Usuarios::find($id);

        if(!$user->isAdmin){
            header("location: /");
        }
    }

    function protegerUserPage($id){
        $user = Usuarios::find($id);
        debugear($user);
        die();
        if($user->isAdmin){
            header("location: /admin");
        }
    }
function sanitizar($data){
    if (mb_detect_encoding($data, 'UTF-8', true))
        return utf8_decode(stripcslashes($data));
    else
        return htmlspecialchars(stripcslashes($data));
} 
    ?>
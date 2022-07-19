<?php 


function debugear($e){
    echo '<pre>';
    var_dump($e);
    echo '</pre>';
}

function getError($error, $type){
    if(isset($error[$type])){
        echo "<p class='errorMessage error'>$error[$type]</p>";
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

function templateEmail($title, $usuario, $texto, $url, $botonNombre){
    
    $message = "
    
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            font-family: sans-serif;
        }
    </style>
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
                        <p>Hola, <b>${usuario}</b></p>
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
    ";
    return $message;
    }
    

?>
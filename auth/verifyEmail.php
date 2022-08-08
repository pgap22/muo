<?php

    use MUO\Usuarios;

    include "../includes/app.php";

    if(isset($_GET["verifyToken"])){

        #Detectar el token de verificacion
        $tokenToVerify = $_GET["verifyToken"];

        $user = Usuarios::where("verifyToken", $tokenToVerify);

        debugear($user);

        if($user){
            $user->setData("verified", 1);    

            $user->update();

            #Borrar todos los emails que no son verificados
            Usuarios::executeSQL("DELETE FROM usuarios WHERE email = '$user->email' AND verified = 0");

            session_start();
            $_SESSION["verification"] = true;
            header("location: /pages/verificationComplete.php");
        }
        else{
            header("location: /error/errorVerification.php");
        }

}
?>
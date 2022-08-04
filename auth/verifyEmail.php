<?php

    use MUO\NoVerifiedUser;

    include "../includes/app.php";

    if(isset($_GET["verifyToken"])){

        #Detectar el token de verificacion
        $tokenToVerify = $_GET["verifyToken"];

        #Detectar usuario por su codigo de verificacion
        $user = NoVerifiedUser::getUserByVerifyToken($tokenToVerify);


        if($user){
                
            #Poner el usuario en la tabla de usuarios ya que esta verificado
            $user->setUser();

            #Borrar al usuario de la tabla de no verificados
            $user->destroy();

            session_start();
            $_SESSION["verification"] = true;
            header("location: /pages/verificationComplete.php");
        }
        else{
            header("location: /error/errorVerification.php");
        }

}
?>
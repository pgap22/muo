<?php

namespace MUO;

class Usuarios extends ActiveRecord{
    protected static $table = 'usuarios';
    protected static $dbColumn = ['id', 'email', 'password', 'name', 'last_name', 'verifyToken', 'disponible_resend', 'emailToken', 'isAdmin', 'verified'];

    protected $id;
    public $email;
    public $password;
    public $name;
    public $last_name;
    public $verifyToken;
    public $disponible_resend;
    public $emailToken;
    public $isAdmin;
    public $verified;
    public $confirmPassword;

    public function __construct($arr = [])
    {
        $this->id = $arr['id'] ?? ''; 
        $this->email = $arr['email'] ?? ''; 
        $this->password = $arr['password'] ?? ''; 
        $this->confirmPassword = $arr['confirmPassword'] ?? ''; 
        $this->name = $arr['name'] ?? ''; 
        $this->last_name = $arr['last_name'] ?? ''; 
        $this->verifyToken = $arr['verifyToken'] ?? Util::generateToken(16); 
        $this->disponible_resend = $arr['disponible_resend'] ?? Util::createDate()->format("Y/m/d H:i:s"); 
        $this->emailToken = $arr['emailToken'] ?? Util::generateToken(8); 
        $this->isAdmin = $arr['isAdmin'] ?? 0; 
        $this->verified = $arr['verified'] ?? 0;
    }

    public function checkDuplicateEmail(){
        $query = "SELECT * FROM usuarios WHERE email = '$this->email' AND verified = 1";
        
        $isEmailUsing = Usuarios::executeSQL($query);
        $isEmailUsing = Usuarios::fetchResultSQL($isEmailUsing);

        if($isEmailUsing){
            self::$errors["email"] = "El email ya esta en uso";
            self::$errors["code"]  = 11;
            return true;
        }
        return false;
    }

    public function validateRegister(){
       if(!$this->checkDuplicateEmail()){
            if($this->name == ""){
                self::$errors["name"]  = "El nombre no puede estar vacio";
                self::$errors["code"] = 1;
            }
            else if($this->last_name == ""){
                self::$errors["last-name"]  = "El apellido no puede estar vacio";
                self::$errors["code"] = 2;
            } 
            else if(strlen($this->name) > 30){
                self::$errors["name"]  = "El nombre no puede ser muy largo";
                self::$errors["code"] = 3;
            }
            else if(strlen($this->last_name) > 30){
                self::$errors["last-name"]  = "El apellido no puede ser muy largo";
                self::$errors["code"] = 4;
            }
            else if($this->email == ""){
                self::$errors["email"]  = "El email no puede quedar vacio";
                self::$errors["code"] = 5;
            }
            else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                self::$errors["email"]  = "El email es invalido";
                self::$errors["code"] = 6;
            }
            else if($this->password == ""){
                self::$errors["password"]  = "La contraseña no puede estar vacia";
                self::$errors["code"] = 7;
            }
            else if(strlen($this->password) < 4){
                self::$errors["password"]  = "Tu contraseña debe ser mayor a 4 caracteres";
                self::$errors["code"] = 50;
            }
            else if($this->confirmPassword == ""){
                self::$errors["password"]  = "La contraseña no puede estar vacia";
                self::$errors["code"] = 8;
            }
            else if($this->password != $this->confirmPassword){
                self::$errors["password"]  = "Las contraseñas no coinciden";
                self::$errors["code"] = 9;
            }
       }
    }

    public function sendVerification(){
        $ip = $_SERVER["HTTP_HOST"];
        $url = "http://${ip}/auth/verifyEmail.php?verifyToken=". $this->verifyToken;
        
        $message["title-es"] = "Verificar tu cuenta de email en MUO";
        $message["title-en"] = "Verify your email account in MUO";

        $message["message-es"] =templateEmail("Verificar email", $this->name, "Haz click en el boton para verificar tu email !",$url,"Verifica tu cuenta");
        $message["message-en"] =templateEmail( "Verify Email", $this->name, "Click on the button to verify your email !",$url,"Verify your account", "en");

        sendMail($this->email, $message);
    }

    public static function checkValidation($eToken){
        //Detectar primero el token
        $result = self::where("emailToken", $eToken);
        return $result;
    }

    public function isTimeToResend(){
        $now = Util::createDate()->getTimestamp();

        $dateForResend = $this->disponible_resend;
        $dateForResend = strtotime($dateForResend)+GMT_6;

        return $now > $dateForResend;
    }

    public function resendEmail(){
        $newTimeResend = Util::addTimeFromNow(60)->format("Y/m/d H:i:s");
        
        $this->setData("disponible_resend",$newTimeResend);

        $query = "UPDATE usuarios SET disponible_resend = ' $this->disponible_resend '";

        self::executeSQL($query);

        $this->sendVerification();
    }
    

    //LOGIN

    public static function getUserByEmail($email){
        
        $user = Usuarios::where("email", $email);

        if($user) return $user;

        self::$errors["login"] = 'Tu email o contraseña no son validos !';
        self::$errors["code"] = 10;
    }

    public function validateLogin($passwordUser){
        //Ya tenemos el correo hoy falta verificar la contraseñe
        $passwordHash = $this->password;

        $isCorrect = password_verify($passwordUser, $passwordHash);

        if($isCorrect) return true;

        self::$errors["login"] = 'Tu email o contraseña no son validos !';
        self::$errors["code"] = 10;

    }

    public function startSession(){
        session_start();
        $_SESSION["user_id"] = $this->id;
        header("location: /home");
    }

    //Recover Password
    public static function validatePassword($password){
        if($password == ""){
            self::$errors["recover-password"]  = "Tu contraseña no puede estar vacia";
            self::$errors["code"] = 17;
        }
    }


}
?>
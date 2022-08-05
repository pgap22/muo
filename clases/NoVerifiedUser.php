<?php  
namespace MUO;

use DateTime;

class NoVerifiedUser {

    public static $errors;

    public $id;
    public $name;
    public $last_name;
    public $password;
    public $confirmPassword;
    public $email;
    public $verifyToken;
    public $disponible_resend;
    public $emailToken;

    public static function createObjFromArray($array){
        $newObj = new self($array);
        return $newObj;
    }

    public function __construct($user = [])
    {
        $this->id = $user["id"] ?? '';
        $this->name = $user["name"] ?? '';
        $this->last_name = $user["last_name"] ?? '';
        $this->password = $user["password"] ?? '';
        $this->confirmPassword = $user["confirm-password"] ?? '';
        $this->email = $user["email"] ?? '';
        $this->verifyToken = $user["verifyToken"] ?? Util::generateToken();
        $this->disponible_resend = $user["disponible_resend"] ?? Util::createDate()["obj"]->format("Y/m/d H:i:s");
        $this->emailToken = $user["emailToken"] ?? '';
    }

    public function getDuplicateEmail() {
        $query = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = Util::$db->prepare($query);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->fetch_assoc()) {
            self::$errors["email"] = "El email ya esta en uso";
            self::$errors["code"]  = 11;
        }
        
    }

    public static function detectEmailToken($email, $emailToken){
        $query = "SELECT * FROM noverifieduser WHERE email = ? AND emailToken = ?";
        $stmt = Util::$db->prepare($query);
        $stmt->bind_param("ss", $email, $emailToken);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->fetch_assoc()) return true;
        return false;
    }
    
    public function saveUser(){
        $query = "INSERT INTO noverifieduser(name, last_name, password, email, verifyToken, disponible_resend, emailToken) VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = Util::$db->prepare($query);

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        
        $stmt->bind_param("sssssss", $this->name, $this->last_name,$hashedPassword,$this->email, $this->verifyToken, $this->disponible_resend, $this->emailToken);

        $stmt->execute();
    }

    public function sendVerification(){
        $ip = getHostByName(getHostName());
        $url = "http://${ip}/auth/verifyEmail.php?verifyToken=". $this->verifyToken;
        
        $message["title-es"] ="Verificar tu cuenta de email en MUO";
        $message["title-en"] ="Verify your email account in MUO";

        $message["message-es"] =templateEmail("Verificar email", $this->name, "Haz click en el boton para verificar tu email !",$url,"Verifica tu cuenta");
        $message["message-en"] =templateEmail( "Verify Email", $this->name, "Click on the button to verify your email !",$url,"Verify your account", "en");

        sendMail($this->email, $message);
    }

    public function validateNewUser(){
       
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
        else if($this->confirmPassword == ""){
            self::$errors["password"]  = "La contraseña no puede estar vacia";
            self::$errors["code"] = 8;
        }
        else if($this->password != $this->confirmPassword){
            self::$errors["password"]  = "Las contraseñas no coinciden";
            self::$errors["code"] = 9;
        }
    }

    public function isTimeToResend(){
        $now = Util::createDate();
        $now = $now["obj"]->getTimestamp()-GMT_6;

        $dateForResend = $this->disponible_resend;
        $dateForResend = strtotime($dateForResend);

        if($now > $dateForResend) return true;
        return false;
    }

    public function resendEmail(){
        $this->disponible_resend = Util::addTimeFromNow(60);
        $this->disponible_resend = $this->disponible_resend->format("Y/m/d H:i:s");
        $this->setNewTime();
        $this->sendVerification();
    }

    public function setNewTime(){
       $query = "UPDATE noverifieduser SET disponible_resend = '$this->disponible_resend'  WHERE emailToken = '$this->emailToken' ";
       Util::$db->query($query);
    }

    public static function getUserByVerifyToken($token){
        $query = "SELECT * FROM noverifieduser WHERE verifyToken = ?";
        $stmt = Util::$db->prepare($query);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();
        if($result) return self::createObjFromArray($result);
        return false;
    }

    public function destroy(){
        $query = "DELETE FROM noverifieduser WHERE email = '$this->email' ";
        Util::$db->query($query);
    }

    public function setUser(){
        $query = "INSERT INTO usuarios(email, password, nombre_usuario, apellido_usuario) VALUES('$this->email', '$this->password', '$this->name', '$this->last_name')";
        Util::$db->query($query);
    }
}

?>

<?php  
namespace MUO;

use DateTime;

class NoVerifiedUser extends User{



    public $id;
    public $name;
    public $lastName;
    public $password;
    public $confirmPassword;
    public $email;
    public $verifyToken;
    public $disponible_resend;
    public $emailToken;

    

    public function __construct($user = [])
    {
        $this->id = $user["id"] ?? '';
        $this->name = $user["name"] ?? '';
        $this->lastName = $user["lastName"] ?? '';
        $this->password = $user["password"] ?? '';
        $this->confirmPassword = $user["confirm-password"] ?? '';
        $this->email = $user["email"] ?? '';
        $this->verifyToken = $user["verifyToken"] ?? self::generateToken();
        $this->disponible_resend = $user["disponible_resend"] ?? self::createDate()["obj"]->format("Y/m/d H:i:s");
        $this->emailToken = $user["emailToken"] ?? '';
    }

    public function getDuplicateEmail() {
        $query = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->fetch_assoc()) {
            self::$errors["email"] = "El email ya esta en uso";
            self::$errors["code"]  = 11;
        }
        
    }

    public static function getEmailToken($email, $emailToken){
        $query = "SELECT * FROM noverifieduser WHERE email = ? AND emailToken = ?";
        $stmt = self::$db->prepare($query);
        $stmt->bind_param("ss", $email, $emailToken);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    
    }
    
    public function saveUser(){
        $query = "INSERT INTO noverifieduser(name, last_name, password, email, verifyToken, disponible_resend, emailToken) VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = self::$db->prepare($query);

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        
        $stmt->bind_param("sssssss", $this->name, $this->lastName,$hashedPassword,$this->email, $this->verifyToken, $this->disponible_resend, $this->emailToken);

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

    public function getDetectError(){
       
        if($this->name == ""){
           self::$errors["name"]  = "El nombre no puede estar vacio";
           self::$errors["code"] = 1;
        }
        else if($this->lastName == ""){
            self::$errors["last-name"]  = "El apellido no puede estar vacio";
            self::$errors["code"] = 2;
        } 
        else if(strlen($this->name) > 30){
            self::$errors["name"]  = "El nombre no puede ser muy largo";
            self::$errors["code"] = 3;
        }
        else if(strlen($this->lastName) > 30){
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
        $now = self::createDate();
        $now = $now["obj"]->getTimestamp()-GMT_6;

        $dateForResend = $this->disponible_resend;
        $dateForResend = strtotime($dateForResend);

        if($now > $dateForResend) return true;
        return false;
    }

    public function resendEmail(){
        $this->disponible_resend = self::addTimeFromNow(60);
        $this->disponible_resend = $this->disponible_resend->format("Y/m/d H:i:s");
        $this->setNewTime();
        $this->sendVerification();
    }

    public function setNewTime(){
       $query = "UPDATE noverifieduser SET disponible_resend = '$this->disponible_resend'  WHERE emailToken = '$this->emailToken' ";
       self::$db->query($query);
    }
}

?>

<?php 
namespace MUO;

use DateTime;

class User{
      
    public static $errors;
    
    public $id;
    public $email;
    public $password;
    public $nombre_usuario;
    public $apellido_usuario;

    
    public static function getErrors(){
        return self::$errors;
    }
    public static function createObjFromArray($array){
        $newObj = new self($array);
        return $newObj;
    }


    //LOGIN
    public function __construct($user){
        $this->id = $user["id"] ?? '';
        $this->email = $user["email"] ?? '';
        $this->password = $user["password"] ?? '';
        $this->nombre_usuario = $user["nombre_usuario"] ?? '';
        $this->apellido_usuario = $user["apellido_usuario"] ?? '';
    }

    public function getPasswordHash(){
        $query = "SELECT password FROM usuarios WHERE email = ?";
        $stmt = Util::$db->prepare($query);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        $ok = $result->fetch_assoc();
        //NULL
        return $ok["password"] ?? NULL;
    }

    public function verifyPasswordUser(){
        return password_verify($this->password, $this->getPasswordHash());
    }

    public function startSession(){
        session_start();
        $token = openssl_random_pseudo_bytes(16);
        $_SESSION["user_token"] = bin2hex($token);
        header("location: /home");
    }

    public function validate(){
        
        $passwowrdHash = $this->getPasswordHash();

        if(!$passwowrdHash){
            self::$errors["login"] = 'Tu email o contraseña no son validos !';
            self::$errors["code"] = 10;
        }
        else{

            $passwordVerification = $this->verifyPasswordUser();
             
            if (!$passwordVerification) {
                self::$errors["login"] = 'Tu email o contraseña no son validos !';
                self::$errors["code"] = 10;
            }

        }
    }

    //RESET PASSWORD WITH OTP

    public static function getUserByEmail($email){
        $query = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = Util::$db->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();
        $result = self::createObjFromArray($result);
        return $result;
    }
    public static function getUserById($id){
        $query = "SELECT * FROM usuarios WHERE id = ?";
        $result = Util::checkRecord($query, $id, "i");
        $result = self::createObjFromArray($result);
        return $result;
    }

    public static function validatePassword($password){
        if($password == ""){
            self::$errors["recover-password"]  = "Tu contraseña no puede estar vacia !";
            self::$errors["code"] = 17;
        }
    }
    public function setNewPassword($password){
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE usuarios SET password = '$this->password' WHERE id = $this->id";
        Util::$db->query($query);
    }

}

?>
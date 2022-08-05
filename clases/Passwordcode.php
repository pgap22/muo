<?php  

namespace MUO;

use DateTime;

class Passwordcode{

    public static $errors;

    public $id;
    public $code;
    public $user_id;
    public $limit_time;
    public $resend_code;
    public $passToken;
    public $verified;

    
    public static function createObjFromArray($array){
        $newObj = new self($array);
        return $newObj;
    }

    public static function generateCode(){
        $code = rand(10000, 99999);
        return intval($code);
    }

    public function __construct($passwordCode)
    {
         $this->id = $passwordCode["id"] ?? '';
         $this->code = $passwordCode["code"] ?? self::generateCode();
         $this->user_id = $passwordCode["user_id"] ?? NULL;
         $this->limit_time = $passwordCode["limit_time"] ?? Util::addTimeFromNow(900)->format("Y/m/d H:i:s");
         $this->resend_code = $passwordCode["resend_code"] ?? Util::createDate()["obj"]->format("Y/m/d H:i:s");
         $this->passToken = $passwordCode["passToken"] ?? Util::generateToken8();
         $this->verified = $passwordCode["verified"] ?? 0;
    }

    public function saveRequest(){
        $query = "INSERT INTO passwordCode(code, user_id, limit_time, resend_code, passToken, verified) VALUES($this->code, $this->user_id, '$this->limit_time', '$this->resend_code', '$this->passToken', 0)";
        
        Util::$db->query($query);
    }

    public function sendCode(){
        $user = User::getUserById($this->user_id);        

        $message["title-es"] = "Recupera Contraseña";
        $message["title-en"] = "Recover Password";

        $message["message-es"] = templateEmailNoButton($message["title-es"], $user->id, "Hola, copia y pega este codigo de verificacion donde se te indique\n\n<b>Recuerda que en 15 minutos el codigo se expirara", $this->code);
        $message["message-en"] = templateEmailNoButton($message["title-en"], $user->id, "Hello, copy and paste this verification code where you are indicated\n\n<b>Remember that in 15 minutes the code will expire", $this->code);


        sendMail($user->email, $message);
    }
    
    public static function validateEmail($email){
        
        
        if(empty($email)){
            self::$errors["emptyEmail"] = true;
        }else{
            $user = User::getUserByEmail($email);
            $email = $user->email ?? false;
            
            if(!$email){
                self::$errors["wrongEmail"] = true;
            }else{
                return $user;
            }
        }
        
        
    }
    
    public static function convert_GET_InCode(){
        $code = [];
        for ($i = 0; $i < 5; $i++) {
            if (isset($_GET["code-" . ($i + 1)])) {
                $code[$i] = $_GET["code-" . ($i + 1)];
            }
        }
        $code = join("", $code);
        if(!$code) return NULL;
        return $code;
    }

    public static function getErrors(){
        return self::$errors;
    }
    

    public static function verifyCode($code, $passToken){
        $query = "SELECT * FROM passwordcode WHERE code= ? AND passToken = ?";
        
        $code = intval($code);

        $stmt = Util::$db->prepare($query);
        $stmt->bind_param("is", $code, $passToken); 
        $stmt->execute();
        $res = $stmt->get_result();
        $res = $res->fetch_assoc();
        if($res) return true;
        else{
            self::$errors["resend-code"] = "Codigo incorrecto";
            self::$errors["code"] = 16;
            return false;
        }
    }

    public static function getRequestByPassToken($passToken){
        $passwordCode = Util::$db->query("SELECT * FROM passwordcode WHERE passToken = '$passToken'");
        $passwordCode = $passwordCode->fetch_assoc();
        if($passwordCode){
            $passwordCode = self::createObjFromArray($passwordCode);
            return $passwordCode;
        }
        return false;
    }

    public function setVerified(){
        $this->verified = 1;
        Util::$db->query("UPDATE passwordcode SET verified = 1 WHERE passToken = '$this->passToken'");
    }

    public function isTimeAvailable(){
        $limit_time = strtotime($this->limit_time)+GMT_6;
        $now = Util::createDate()["timestamp"];

        $result = $now < $limit_time;

        if(!$result){
            self::$errors["resend-code"] = "El codigo ya ha expirado, intenta reenviar el codigo";
            self::$errors["code"] = 15;
        }

        return $result;
    }
    public function isTimeResend(){
        $resend_code = strtotime($this->resend_code)+GMT_6;
        $now = Util::createDate()["timestamp"];


        return $now > $resend_code;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function changeTimes(){
        $this->limit_time = Util::addTimeFromNow(900)->format("Y/m/d H:i:s");
        $this->resend_code = Util::addTimeFromNow(60)->format("Y/m/d H:i:s");
        $query = "UPDATE passwordcode SET resend_code = '$this->resend_code', limit_time = '$this->limit_time' WHERE passToken = '$this->passToken'";
        Util::$db->query($query);
    }

    public function setNewCode(){
        $this->code = self::generateCode();
        $query = "UPDATE passwordcode SET code = $this->code WHERE passToken = '$this->passToken'";
        Util::$db->query($query);
    }

    public function destroyAllUserRequest(){
        $query = "DELETE FROM passwordcode WHERE user_id = $this->user_id";
        Util::$db->query($query);
    }
}

?>
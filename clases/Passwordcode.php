<?php  

namespace MUO;

class Passwordcode extends ActiveRecord{
    protected static $table = 'passwordcode';
    protected static $dbColumn = ['id', 'code', 'user_id', 'limit_time', 'resend_code', 'passToken', 'verified'];

    protected $id;
    public $code;
    public $user_id;
    public $limit_time;
    public $resend_code;
    public $passToken;
    public $verified;

    public function __construct($arr = [])
    {
        $this->id = $arr["id"] ?? '';
        $this->code = $arr["code"] ?? '';
        $this->user_id = $arr["user_id"] ?? '';
        $this->limit_time = $arr["limit_time"] ?? '';
        $this->resend_code = $arr["resend_code"] ?? '';
        $this->passToken = $arr["passToken"] ?? '';
        $this->verified = $arr["verified"] ?? '';
    }

    public static function getUser($email){
        $query = "SELECT * FROM usuarios WHERE email = '". ActiveRecord::sanitize($email)  ."' AND verified = 1";  
    
        $user = Usuarios::fetchResultSQL(Usuarios::executeSQL($query));

        if($user) return Usuarios::createObj($user);

        self::$errors["wrongEmail"] = true;
    }

    public function sendCode(){
        $user = Usuarios::find($this->user_id);        

        $userID = $user->getData("id");

        $message["title-es"] = "Recupera Contraseña";
        $message["title-en"] = "Recover Password";

        $message["message-es"] = templateEmailNoButton($message["title-es"], $userID, "Hola, copia y pega este codigo de verificacion donde se te indique\n\n<b>Recuerda que en 15 minutos el codigo se expirara", $this->code);
        $message["message-en"] = templateEmailNoButton($message["title-en"], $userID, "Hello, copy and paste this verification code where you are indicated\n\n<b>Remember that in 15 minutes the code will expire", $this->code);


        sendMail($user->email, $message);
    }

    public static function convert_GET_InCode(){
        $code = [];
        for ($i = 0; $i < 5; $i++) {
            if (isset($_GET["code-" . ($i + 1)])) {
                $code[$i] = intval($_GET["code-" . ($i + 1)]);
            }
        }
        $code = intval(join("", $code));
        if(!$code) return NULL;
        return $code;
    }

    public static function validate($code, $passToken){
        $query = "SELECT * FROM passwordcode WHERE code = $code AND passToken = '$passToken'";
        $result = self::fetchResultSQL(self::executeSQL($query));
  
        if($result) return self::createObj($result);
      
        self::$errors["resend-code"] = "Codigo incorrecto";
        self::$errors["code"] = 16;
        return false;

    }
    
    public function verify(){
        $this->setData("verified", 1);
        $this->save();
    }

    public function isExpired(){
        $limitTime = strtotime($this->limit_time)+GMT_6;
        $now = Util::createDate()->getTimestamp();
        
        if($limitTime < $now){
            self::$errors["resend-code"] = "El codigo ya ha expirado, intenta reenviar el codigo";
            self::$errors["code"] = 15;
        }
        return false;
    }

    public function isResend(){
        $resendTime = strtotime($this->resend_code)+GMT_6;
        $now = Util::createDate()->getTimestamp();

        return $now > $resendTime;
    }

}


?>
<?php  
namespace MUO;

use DateTime;

class Util{
    public static $db;
    
    public static function setDB($db){
        self::$db = $db;
    }
    public static function  generateToken(){
        return bin2hex(openssl_random_pseudo_bytes(16));
    }
    public static function generateToken8(){
        return bin2hex(openssl_random_pseudo_bytes(8));

    }
    public static function createDate(){
        $date["obj"] = new DateTime("now", TIMEZONE_GMT6);
        $date["timestamp"] = $date["obj"]->getTimestamp();
        return $date;
    }
    public static function addTimeFromNow($seconds){
        $dateToAdd = (self::createDate()["timestamp"]+$seconds)-GMT_6;
        $dateToAdd = date("Y/m/d H:i:s", $dateToAdd);
        return DateTime::createFromFormat("Y/m/d H:i:s", $dateToAdd, TIMEZONE_GMT6);
    }

    public static function checkRecord($query, $Record, $type = "s"){
       $stmt =  self::$db->prepare($query);
       $stmt->bind_param($type, $Record);
       $stmt->execute();
       $result = $stmt->get_result()->fetch_assoc();
       return $result;
    }


}

?>
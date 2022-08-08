<?php  
namespace MUO;

use DateTime;

class Util{
  
    public static function  generateToken($len){
        return bin2hex(openssl_random_pseudo_bytes($len));
    }
  
    public static function createDate(){
        $date = new DateTime("now", TIMEZONE_GMT6);
        return $date;
    }
    public static function addTimeFromNow($seconds){
        $dateToAdd = (self::createDate()->getTimestamp()+$seconds)-GMT_6;
        $dateToAdd = date("Y/m/d H:i:s", $dateToAdd);
        return DateTime::createFromFormat("Y/m/d H:i:s", $dateToAdd, TIMEZONE_GMT6);
    }



}

?>
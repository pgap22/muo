<?php  
namespace MUO;

use DateTime;
use DateTimeZone;

class Util{
  

    public static function  generateToken($len){
        return bin2hex(openssl_random_pseudo_bytes($len));
    }
  
    public static function createDate(){
        $timezone = new DateTimeZone("GMT-6");
        $date = new DateTime("now", $timezone);
        return $date;
    }
    public static function addTimeFromNow($seconds){
        $timezone = new DateTimeZone("GMT-6");
        $dateToAdd = (self::createDate()->getTimestamp()+$seconds)-GMT_6;
        $dateToAdd = date("Y/m/d H:i:s", $dateToAdd);
        return DateTime::createFromFormat("Y/m/d H:i:s", $dateToAdd, $timezone);
    }


    public static function is_in_array($data, $arr2){
        #Detectar si la data existe en un arreglo
        foreach ($arr2 as $dataCheck) {
            if($data == $dataCheck) return true;
        }
        return false;
    }

}

?>
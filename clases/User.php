<?php 
namespace MUO;

use DateTime;

class User{
    public static $db;
    public static $errors;

    public static function setDB($db){
        self::$db = $db;
    }
    public static function  generateToken(){
        return bin2hex(openssl_random_pseudo_bytes(16));
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

    public static function getErrors(){
        return self::$errors;
    }

    public static function sendMail(){
        //Next
    }
}

?>
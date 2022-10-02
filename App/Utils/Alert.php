<?php
namespace App\Utils;

class Alert{

    public static function getError($message){
        return "<p class=' text-red  text-center text-size-small-1 mt-0' style='color:red;'>{$message}</p>";
    }

    public static function getSucess($message){
        return "<p class='text-green text-center text-size-small-1'>{$message}</p>";
    }
}
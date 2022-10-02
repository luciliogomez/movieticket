<?php
namespace App\Utils;

class Session {

    public static function has($key)
    {
        return (isset($_SESSION[$key]) && !empty($_SESSION[$key]));
    }

    public static function get($key)
    {
        return $_SESSION[$key];
    }

    public static function free($key)
    {
        $kept_key = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $kept_key;
    }

    public static function set($key,$value)
    {
        $_SESSION[$key] = $value;
    }
}
<?php
namespace App\Utils;

use League\Plates\Engine;

class View{

    private static $folders;
    public static $engine;

    public function __construct($path)
    {   
        self::$engine = new Engine($path);
    }

    public static function setFolders($folders = [])
    {
        self::$folders = $folders;
        self::addFolders();
    }
    
    public static function addFolders()
    {
        foreach(self::$folders as $key => $value)
        {
            self::$engine->addFolder($key,$value);
        }
    }

    public static function render($template,$dados = []){
        return self::$engine->render($template,$dados);
    }
}
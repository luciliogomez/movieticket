<?php
namespace App\Utils;

use PDO;

class Conexao{

    private static $instance;

    public static function getInstance()
    {
        
        if(!isset(self::$instance))
        {
            switch(DATABASE)
            {
                case 'oracle':
                    self::$instance = oci_connect(DB_USERNAME,DB_PASSWORD,DB_ORACLE_CONNECTION_STRING,'AL32UTF8');
                    break;
                case 'mysql':
                    self::$instance = new PDO(
                        "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8"
                        ,DB_USERNAME,DB_PASSWORD);
                    self::$instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
                    break;
            }
        }
        return self::$instance;
    }
}
?>
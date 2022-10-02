<?php
namespace App\Utils;
require __DIR__."/../../vendor/autoload.php";
require "config.php";
use App\Controllers\Pages\Reserva;
use App\Utils\Conexao;
use Exception;

/**
 * File to execute cronjobs in the app
*/

//DATABASE CONFIGURATIONS
define("DATABASE",'oracle');
define("DB_HOST","localhost");
define("DB_USERNAME","lucilio");
define("DB_PASSWORD","1234");
define("DB_NAME","");
define('DB_ORACLE_CONNECTION_STRING',"localhost/xe");

echo "HELLO CRON JOB";

class Cron{

    public static function execute()
    {
        try{
            Reserva::cancelarReservasPendentes();
        }catch(Exception $e){    
    
        }
    }
}

Cron::execute();
?>
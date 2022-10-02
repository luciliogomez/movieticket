<?php

use App\Http\Middlewares\AdminAccess;
use App\Utils\View;
use App\Http\Middlewares\Queue as MiddlewareQueue;
//192.168.43.35
//10.202.1.64
// BASE URL
define("URL","http://localhost/movieticket");

define("ASSETS",URL."/resources/assets");

$dir = str_replace("\\",DIRECTORY_SEPARATOR,"C://xampp/htdocs/movieticket/");
define("BASE_DIR",$dir);

//DATABASE CONFIGURATIONS
define("DATABASE",'mysql');
define("DB_HOST","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD","");
define("DB_NAME","movieticket");
define('DB_ORACLE_CONNECTION_STRING',"localhost/xe");


// SETING  VIEW CONFIGURATIONS
$view = new View("App/Views");
$view::setFolders([
    "template" => "App/Views/admin/layout/template",
    "pagination" =>"App/Views/admin/layout/pagination", 
    "error" => "App/Views/admin/layout",
    "admin"    => "App/Views/admin",
    "adm-template"=>"App/Views/admin/layout/template",
    "adm-home"=> "App/Views/admin/pages",
    "adm-cinemas"=>"App/Views/admin/pages/cinemas",
    "adm-cidades"=>"App/Views/admin/pages/cidades",
    "adm-filmes"=>"App/Views/admin/pages/filmes",
    "adm-sessoes"=>"App/Views/admin/pages/sessoes",
    "adm-reservas"=>"App/Views/admin/pages/reservas",
    "adm-login"=>"App/Views/admin/pages/login",
    "adm-funcionarios"=>"App/Views/admin/pages/funcionarios",

    "home"=>"App/Views/portal/pages/home",
    "home-pagination"=>"App/Views/portal/layout/pagination"
]);


// SETING MIDDLEWARES MAPS

MiddlewareQueue::setMap([
    "admin-access" => App\Http\Middlewares\AdminAccess::class,
    "candidato-access" => App\Http\Middlewares\CandidatoAccess::class,
    "require-logout" => App\Http\Middlewares\RequireLogout::class,
    "require-login" => App\Http\Middlewares\RequireLogin::class
]);



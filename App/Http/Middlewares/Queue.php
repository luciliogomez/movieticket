<?php
namespace App\Http\Middlewares;

use Exception;

class Queue{

    public static $map = [];

    public static $defaults = [];
    
    private $controller;

    private $controllerArgs = [];

    private $middlewares = [];

    public function __construct($controller, $controllerArgs, $middlewares = [])
    {
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
        $this->middlewares = $middlewares;
    }

    public static function setMap($map = []){
        self::$map = $map;
    }

    public static function setDefaults($defaults = [])
    {
        self::$defaults = $defaults;
    }

    public function next($request)
    {
        if(empty($this->middlewares))
        {
            return call_user_func_array($this->controller,$this->controllerArgs);
        }

        $middleware = array_shift($this->middlewares);

        if(!isset(self::$map[$middleware])){
            throw new Exception("ERRO AO PROCESSAR MIDDLEWARE",500);
        }

        $queue = $this;
        $next = function($request) use($queue){
            return $queue->next($request);
        };

        return (new self::$map[$middleware])->handle($request,$next);
    }


}
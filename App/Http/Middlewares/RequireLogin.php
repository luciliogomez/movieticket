<?php
namespace App\Http\Middlewares;

class RequireLogin{

    public function handle($request,$next)
    {
        if( !isset($_SESSION["usuario"])){
            $request->getRouter()->redirect("/adm/login");
        }
        
        return $next($request);
    }
}
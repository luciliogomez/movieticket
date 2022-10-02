<?php
namespace App\Http\Middlewares;

class AdminAccess{

    public function handle($request,$next)
    {
        if(isset($_SESSION['id'])){
            echo "HIII";
            exit;
        }

        return $next($request);
    }
}
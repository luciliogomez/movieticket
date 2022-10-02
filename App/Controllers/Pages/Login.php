<?php
namespace App\Controllers\Pages;
use App\Utils\Session;
use App\Utils\Conexao;
use App\Models\Funcionario;
use App\Utils\View;
class Login{


    public static function setLogin($request)
    {
        $postVars = $request->getPostVars();
        if(empty($postVars['email']) || empty($postVars['password']))
        {
            return View::render("adm-login::login",[
                "email" => $postVars['email'],
                "password"  => $postVars['password'],
                "status"    => "Campos Vazios"
            ]);
        }   
        $email = $postVars['email'];
        $password = $postVars['password'];
        
        $model = new Funcionario();
        $usuario = $model->loadByEmail($email);
        if(!$usuario)
        {
            return View::render("adm-login::login",[
                "email" => $postVars['email'],
                "password"  => $postVars['password'],
                "status"    => "Utilizador Não Encontrado"
            ]);
        }

        if($password!= $usuario['senha'])
        {
            return View::render("adm-login::login",[
                "email" => $postVars['email'],
                "password"  => $postVars['password'],
                "status"    => "Senha Errada"
            ]);
        }

        Session::set("usuario",$usuario);
        $request->getRouter()->redirect("/adm");
    }

    public static function setLogout($request)
    {
        session_unset();
        session_destroy();
        $request->getRouter()->redirect("/adm/login");
    }
}



?>
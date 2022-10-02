<?php
namespace App\Controllers\Pages;

use App\Models\Funcionario as ModelFuncionario;
use App\Utils\Alert;
use App\Utils\Session;
use App\Utils\View;
use App\Models\Cinema;
use WilliamCosta\DatabaseManager\Pagination;
use Exception;

class Funcionario extends PagesBaseController{
    /**
     * GET ALL MOVIES
     * @param Request $requisicao
     * @return array $movies
     */
    public static function index($request)
    {
        $model = new ModelFuncionario();
        $queryParams = $request->getQueryParams();

        $funcionarios = [];
        $pagination = [];
        
        try{

            $total = count($model->all());

            $curretPage = $queryParams['page'] ?? '1';

            $pagination = new Pagination($total,$curretPage,3);
            $funcionarios = $model->all($pagination->getLimit());
        }catch(Exception $e)
        {
            $funcionarios = [];
            $pagination = [];
        }
        
        return View::render("adm-funcionarios::lista",[
            "funcionarios" => $funcionarios,
            "links"  => self::getPagination($pagination,$request)
        ]);
    }

    public static function create($request)
    {
        $modelCinema = new Cinema();
        $cinemas = $modelCinema->all();

        return View::render("adm-funcionarios::novo",[
            "cinemas"=>$cinemas
        ]);
    }


    public static function store($request)
    {

        $postVars = $request->getPostVars();
        
        if(empty($postVars['nome']) || empty($postVars['email']) || empty($postVars['nivel']) || empty($postVars['id_cinema'])){
            Session::set("error","Preencha todos os campos!");
            $request->getRouter()->redirect("/adm/funcionarios/create");
        }
        
        $nome = $postVars['nome'];
        $email = $postVars['email'];
        $senha = "1234";
        $nivel = $postVars['nivel'];
        $cinema = $postVars['id_cinema'];
        $id_funcionario = Session::get("usuario")['id_funcionario'];
        
        $model = new ModelFuncionario();
        
        $func = $model->find($id_funcionario);
        if($func==false || $func['NIVEL']!='admin'){
            Session::set("error","Erro ao cadastrar. sem permicao");
            $request->getRouter()->redirect("/adm/funcionarios/create");
        }
        
        $model->setNome($nome);
        $model->setEmail($email);
        $model->setSenha($senha);
        $model->setNivel($nivel);
        $model->setCinema($cinema);
        
        $r= $model->save();
       
        if(($r))
        {
            Session::set("sucess","Funcionario Cadastrado!");
            $request->getRouter()->redirect("/adm/funcionarios");
        }else{
            Session::set("error","Erro ao cadastrar");
            $request->getRouter()->redirect("/adm/funcionarios/create");
        }
    }


    public static function edit($id,$request)
    {
        $model = new ModelFuncionario();
        $funcionario = $model->find($id);
        
        $modelCinema = new Cinema();
        $cinemas = $modelCinema->all();

        return View::render("adm-funcionarios::edit",[
            "funcionario"=>$funcionario,
            "cinemas" => $cinemas
        ]);
    }

    public static function update($request)
    {   
        $postVars = $request->getPostVars();   
        $id = $postVars['id'];
        $nome = $postVars['nome'];
        $email = $postVars['email'];
        $senha = $postVars['senha'];
        $nivel = $postVars['nivel'];
        $cinema = $postVars['id_cinema'];
        $id_funcionario = $postVars['id'];

        $model = new ModelFuncionario();
        $model->setId($id);
        $model->setNome($nome);
        $model->setEmail($email);
        $model->setSenha($senha);
        $model->setNivel($nivel);
        $model->setCinema($cinema);


        $r= $model->update();
        if(($r))
        {
            Session::set("sucess","Funcionario Actualizado!");
            $request->getRouter()->redirect("/adm/funcionarios");
        }else{
            
            Session::set("error","Não foi possível actualizar funcionario!");
            $request->getRouter()->redirect("/adm/funcionarios/{$id}/edit");
        }
    }
    public static function delete($id,$request)
    {   
        $model = new ModelFuncionario();
        $r= $model->destroy($id);
        if(($r))
        {
            Session::set("sucess","Funcionario Eliminado!");
            $request->getRouter()->redirect("/adm/funcionarios");
        }else{
            
            Session::set("error","Não foi possível eliminar funcionario!");
            $request->getRouter()->redirect("/adm/funcionarios");
        }
    }
    public static function show($id,$request)
    {
        
        $model = new ModelFuncionario();
        return $model->find($id);
    }
    
    public static function perfil($request)
    {
        
        return View::render("adm-funcionarios::perfil",
        [
            "usuario"=>Session::get("usuario")
        ]
        );
    }

    public static function edit_perfil($request)
    {
        
        return View::render("adm-funcionarios::edit_perfil",
        [
            "usuario"=>Session::get("usuario")
        ]
        );
    }

    
    public static function update_perfil($request)
    {
        $postVars = $request->getPostVars();
        if(empty($postVars['nome']) || empty($postVars['email'])){
            Session::set("error","Preencha todos os campos!");
            $request->getRouter()->redirect("/adm/perfil/update");
        }        

        $nome = $postVars['nome'];
        $email = $postVars['email'];

        $model = new ModelFuncionario();
        $model->setNome($nome);
        $model->setEmail($email);
        $model->setId(Session::get("usuario")['id_funcionario']);

        if($model->update_perfil()){
            $usuario = $model->loadByEmail($email);
            Session::set("usuario",$usuario);
            Session::set("sucess","Perfil Actualizado!");
            $request->getRouter()->redirect("/adm/perfil");
        }else{
            Session::set("error","Não foi possível actualizar o perfil. Tente novamente!");
            $request->getRouter()->redirect("/adm/perfil/update");
        }
        
    }

    public static function edit_password($request)
    {
        
        return View::render("adm-funcionarios::edit_password",
        [
            "usuario"=>Session::get("usuario")
        ]
        );
    }

    public static function change_password($request)
    {
        $postVars = $request->getPostVars();
        if(empty($postVars['old_password']) || empty($postVars['new_password'])){
            Session::set("error","Preencha todos os campos!");
            $request->getRouter()->redirect("/adm/perfil/change_password");
        }        

        $old = $postVars['old_password'];
        $new = $postVars['new_password'];

        if($old != Session::get("usuario")['senha']){
            Session::set("error","Senha Errada!");
            $request->getRouter()->redirect("/adm/perfil/change_password");
        }
        
        if($old == $new){
            Session::set("error","Escolha uma senha diferente!");
            $request->getRouter()->redirect("/adm/perfil/change_password");
        }

        $model = new ModelFuncionario();
        $model->setSenha($new);
        $model->setId(Session::get("usuario")['id_funcionario']);

        if($model->change_password()){
            $usuario = $model->loadByEmail(Session::get("usuario")['email']);
            Session::set("usuario",$usuario);
            Session::set("sucess","Senha Alterada!");
            $request->getRouter()->redirect("/adm/perfil");
        }else{
            Session::set("error","Não foi possível alterar a senha. Tente novamente!");
            $request->getRouter()->redirect("/adm/perfil/change_password");
        }
        
    }

 
}
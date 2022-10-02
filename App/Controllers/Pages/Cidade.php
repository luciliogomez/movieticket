<?php
namespace App\Controllers\Pages;
use App\Http\Request;
use App\Models\Cidade as ModelCidade;
use App\Utils\View;
use Exception;
use WilliamCosta\DatabaseManager\Pagination;
use App\Utils\Session;

class Cidade extends PagesBaseController{

    public static function index($request)
    {
        $cidades = new ModelCidade();
        return $cidades->all();
    }

    public static function list($request)
    {
        $queryParams = $request->getQueryParams();
        $model = new ModelCidade();
        $cidades = [];
        $pagination = null;

        try{
            $total = count($model->all());

            $page = $queryParams['page']??'1';
            
            $pagination = new Pagination($total,$page,4);

            $cidades = $model->all($pagination->getLimit());
        }catch(Exception $e)
        {
            $cidades = [];
            $pagination = null;
        }

        return View::render("adm-cidades::lista",[
            "cidades"=>$cidades,
            "links" => self::getPagination($pagination,$request,"")
        ]);

        $cidades = new ModelCidade();
        return $cidades->all();
    }

    public static function load($id,$request)
    {
        $model = new ModelCidade();

        $cidade = $model->find($id);
        if(!($cidade) || is_null($cidade))
        {
            Session::set("error","Cidade não encontrada!");
            $request->getRouter()->redirect("/adm/cidades");
        }
        $ruas = $model->getRuas($id);
        return View::render("adm-cidades::show",[
            "cidade" => $cidade,
            "ruas"  => $ruas,
            "links" => ''
        ]);
        return ($cidade)?$cidade:[];
    }

    public static function show($id,$request)
    {
        $model = new ModelCidade();

        $cidade = $model->find($id);
        return ($cidade)?$cidade:[];
    }


    public static function store(Request $request)
    {
        $postVars = $request->getPostVars();
        if(empty($postVars['nome']))
        {
            Session::set("error","Preencha todos os campos!");
            $request->getRouter()->redirect("/adm/cidades/create");
        }
        $nome = $postVars['nome'];

        $cidade = new ModelCidade();
        $cidade->setNome($nome);
        if($cidade->save())
        {
            Session::set("sucess","Cidade Cadastrada!");
            $request->getRouter()->redirect("/adm/cidades/create");
        }else{
            Session::set("error","Cidade não cadastrada!");
            $request->getRouter()->redirect("/adm/cidades/create");
        }
    }

        public static function ruas($id_cidade,$request)
        {
        $model = new ModelCidade();

        $ruas =  $model->getRuas($id_cidade);
        $options  = "";
        foreach($ruas as $rua)
        {
            $options .= "<option value='{$rua['id_rua']}'>{$rua['nome']}</option>";
        }
        return $options;
        // if($cidade)
        // {
        //     return $model->getRuas($id);
        // }else{
        //     return [
        //         "status"=> "erro",
        //         "message"=>"cidade não encontrada"
        //     ];
        // }
    }

    public static function all_ruas($request)
    {
        $model = new ModelCidade();

        $ruas =  $model->getAllRuas();
        $options  = "";
        foreach($ruas as $rua)
        {
            $options .= "<option value='{$rua['id_rua']}'>{$rua['nome']}</option>";
        }
        return $options;
        // if($cidade)
        // {
        //     return $model->getRuas($id);
        // }else{
        //     return [
        //         "status"=> "erro",
        //         "message"=>"cidade não encontrada"
        //     ];
        // }
    }
    
    public static function new_street($id,$request)
    {
        $postVars = $request->getPostVars();
        if(empty($postVars['nome']) || empty($postVars['id_cidade']))
        {
            Session::set("error","Preencha todos os campos!");
            $request->getRouter()->redirect("/adm/cidades");
        }
        $nome = $postVars['nome'];
        $id_cidade = $postVars['id_cidade'];
        $cidade = new ModelCidade();
        if($cidade->addStreet($nome,$id_cidade))
        {
            Session::set("sucess","Rua Adicionada!");
            $request->getRouter()->redirect("/adm/cidades/{$id_cidade}/");
        }else{
            Session::set("error","Erro ao adicionar Rua!");
            $request->getRouter()->redirect("/adm/cidades");
        }
    }

    public static function add_rua($id,$request)
    {
        $model = new ModelCidade();

        $cidade = $model->find($id);
        if(!($cidade) || is_null($cidade))
        {
            Session::set("error","Cidade não encontrada!");
            $request->getRouter()->redirect("/adm/cidades");
        }
        return View::render("adm-cidades::nova_rua",[
            "cidade"=> $cidade
        ]);
    }

    public static function create()
    {
        return View::render("adm-cidades::novo");
    }
   
}
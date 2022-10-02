<?php
namespace App\Controllers\Pages;

use App\Models\Cinema;
use App\Models\Sessao as ModelsSessao;
use App\Models\Filme as ModelFilme;
use App\Utils\Session;
use App\Utils\View;
use WilliamCosta\DatabaseManager\Pagination;
use Exception;
class Sessao extends PagesBaseController{

   
    public static function storeSessao($request)
    {
        $postVars = $request->getPostVars();
        $sala = $postVars['id_sala'];
        $id_filme = $postVars['id_filme'];
        $data = $postVars['data'];
        $hora = $postVars['hora'];
        $preco = $postVars['preco'];

        $model = new ModelFilme();
        $filme = $model->find($id_filme);
        if(is_null($filme) || !$filme){
            Session::set("error","Falha ao encontrar Filme!");
            $request->getRouter()->redirect("/adm/filmes");
        }
        
        $model = new ModelsSessao();
        if(intval($preco) < 0){
            Session::set("error","Falha ao adicionar Sessao. Preço demasiado baixo");
            $request->getRouter()->redirect("/adm/sessoes/{$id_filme}/create");
        }

        $result = $model->Validate($sala,$data,$hora,$filme->getDuracao());
        
        
        if( count($result) > 0 ){
            Session::set("error","Falha ao adicionar Sessao. Sala ocupada neste horário");
            $request->getRouter()->redirect("/adm/sessoes/{$id_filme}/create");
        }

        $model->setSala($sala);
        $model->setFilme($id_filme);
        $model->setData($data." ".$hora);
        $model->setPreco($preco);
        
        $r= $model->save();
        if(($r))
        {
            Session::set("sucess","Sessão Cadastrada!");
            $request->getRouter()->redirect("/adm/sessoes/{$id_filme}/create");
        }else{
            Session::set("error","Falha ao adicionar Sessao!");
            $request->getRouter()->redirect("/adm/sessoes/{$id_filme}/create");
        }

    }

    public static function getAllSessoes($request)
    {
        
        $queryParams = $request->getQueryParams();
        $model = new ModelsSessao();
        $sessoes = [];
        $pagination = [];
        
        try{

            $total = (Session::get("usuario")['nivel']=="admin")?count($model->all()):count($model->all(Session::get("usuario")['id_cinema']));

            $curretPage = $queryParams['page'] ?? '1';

            $pagination = new Pagination($total,$curretPage,4);
            // $sessoes = $model->all($offset,$limit);
            $sessoes = (Session::get("usuario")['nivel']=="admin")?$model->all($pagination->getLimit()):$model->all($pagination->getLimit(),Session::get("usuario")['id_cinema']);
        }catch(Exception $e)
        {
            $sessoes = [];
            $pagination = [];
        }
        return View::render("adm-sessoes::lista",[
            "sessoes" => $sessoes,
            "links"  => self::getPagination($pagination,$request)
        ]);
    }

    public static function create($id_filme,$request)
    {
        $model = new ModelFilme();
        $filme = $model->find($id_filme);
        if(is_null($filme) || !$filme){
            Session::set("error","Falha ao encontrar Filme!");
            $request->getRouter()->redirect("/adm/filmes");
        }

        $modelCinema = new Cinema();
        $cinemas = $modelCinema->all();

        return View::render("adm-sessoes::novo",[
            "filme" => $filme,
            "cinemas"=>$cinemas
        ]);
    }

    public static function getLugaresDaSessao($id,$request)
    {
        $sessao = new ModelsSessao;
        $sessao->setId($id);
        
        $lugares = $sessao->lugares();
        
        if(!is_null($lugares))
        {
            return $lugares;
        }
        else{
            return [
                "status" => "erro",
                "message"=> "Não foi possível obter o resultado [-1]"
            ];
        }
    }

}
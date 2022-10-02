<?php
namespace App\Controllers\Pages;

use App\Models\Filme as ModelFilme;
use App\Utils\Alert;
use App\Utils\Session;
use App\Utils\View;
use Exception;
use WilliamCosta\DatabaseManager\Pagination;

class Filme extends PagesBaseController{
    /**
     * GET ALL MOVIES
     * @param Request $requisicao
     * @return array $movies
     */
    public static function index($request)
    {
        $queryParams = $request->getQueryParams();
        $model = new ModelFilme();
        $filmes = [];
        $pagination = [];
        
        try{

            $total = count($model->all());

            $curretPage = $queryParams['page'] ?? '1';

            $pagination = new Pagination($total,$curretPage,4);

            $offset = explode(",",$pagination->getLimit())[0];
            $limit = explode(",",$pagination->getLimit())[1];

            $filmes = $model->all($pagination->getLimit());
        }catch(Exception $e)
        {
            $filmes = [];
            $pagination = [];
        }
        
        return View::render("adm-filmes::lista",[
            "filmes" => $filmes,
            "links"  => self::getPagination($pagination,$request)
        ]);
    }

    public static function store($request)
    {
        $postVars = $request->getPostVars();
        $titulo = $postVars['titulo'];
        $genero = $postVars['genero'];
        $classificacao = $postVars['classificacao'];
        $ano = $postVars['ano'];
        $descricao = $postVars['descricao'];
        $capa = $postVars['capa']??'';
        $duracao = $postVars['duracao'];

        $model = new ModelFilme();
        $model->setTitulo($titulo);
        $model->setGenero($genero);
        $model->setClassficacao($classificacao);
        $model->setAno($ano);
        $model->setDescricao($descricao);
        $model->setCapa($capa);
        $model->setDuracao($duracao);
        
        $r= $model->save();
        if(($r))
        {
            Session::set("sucess","Filme Cadastrado!");
            $request->getRouter()->redirect("/adm/filmes/create");
            
        }else{
            Session::set("error","Falha ao cadastrar Filme!");
            $request->getRouter()->redirect("/adm/filmes/create");
        }
    }

    public static function update($request)
    {   
        $postVars = $request->getPostVars();   
        $id = $postVars['id_filme']??'0';
        $titulo = $postVars['titulo']??'';
        $genero = $postVars['genero']??'aventura';
        $classificacao = $postVars['classificacao']??'13';
        $ano = $postVars['ano']??'2022';
        $capa = $postVars['capa']??'';
        $descricao = $postVars['descricao']??'';
        $duracao = $postVars['duracao']??'120';
        
        $model = new ModelFilme();
        $model->setId($id);
        $model->setTitulo($titulo);
        $model->setGenero($genero);
        $model->setClassficacao($classificacao);
        $model->setAno($ano);
        $model->setDescricao($descricao);
        $model->setCapa($capa);
        $model->setDuracao($duracao);
        $r= $model->update();
        if(($r))
        {
            Session::set("sucess","Filme Actualizado!");
            $request->getRouter()->redirect("/adm/filmes/{$id}/edit");
            
        }else{
            Session::set("error","Falha ao actualizar Filme!");
            $request->getRouter()->redirect("/adm/filmes/{$id}/edit");
        }
    }
    public static function getFilmesEmExibicao($request)
    {
        $model = new ModelFilme();
        $filmes = $model->getEmExibicao(0,0);
        if(!is_null($filmes))
        {
            return $filmes;
        }
        else{
            return [
                "status" => "erro",
                "message"=> "Não foi possível obter o resultado [-1]"
            ];
        }
    }
    public static function create($request)
    {
        return View::render("adm-filmes::novo");
    }
 
    public static function show($id,$request)
    {
        
        $model = new ModelFilme();
        $filme = $model->find($id);

        if(!is_null($filme))
        {
            return View::render("adm-filmes::show",[
                "filme"  => $filme
            ]);
        }else{
            Session::set("error","Falha ao encontrar Filme!");
            $request->getRouter()->redirect("/adm/filmes");
        }
    }
    public static function edit($id,$request)
    {
        
        $model = new ModelFilme();
        $filme = $model->find($id);

        if(!is_null($filme))
        {
            return View::render("adm-filmes::edit",[
                "filme"  => $filme
            ]);
        }else{
            Session::set("error","Falha ao encontrar Filme!");
            $request->getRouter()->redirect("/adm/filmes");
        }
    }

    public static function getSessoes($id,$request)
    {
        $model = new ModelFilme();
        $filme = $model->find($id);
        if(is_null($filme) || !$filme){
            Session::set("error","Falha ao encontrar Filme!");
            $request->getRouter()->redirect("/adm/filmes");
        }

        $sessoes = $model->getSessoes($id);
        
        if(!is_null($sessoes))
        {
            return View::render("adm-filmes::sessoes",[
                "sessoes" => $sessoes,
                "filme"  => $filme
                // "links"  => self::getPagination($pagination,$request)
            ]);
        }
        else{
            Session::set("error","Falha ao carregar Sessoes!");
            $request->getRouter()->redirect("/adm/filmes");
        }
    }
    

 
}
<?php
namespace App\Controllers\Pages;
use App\Http\Request;
use App\Models\Cidade;
use App\Models\Cinema as ModelsCinema;
use App\Models\Model;
use App\Utils\View;
use App\Models\Filme as ModelFilme;
use App\Models\Reserva;
use App\Models\Sessao;
use WilliamCosta\DatabaseManager\Pagination;
use Exception;
use App\Utils\Session;
class Home extends PagesBaseController{
    /**
     * Get all cinema
     */
    public static function index($request)
    {
        $pagination = null;
        $queryParams = $request->getQueryParams();
        $model = new ModelFilme();
        $filmes = [];
        try{
            $total = count($model->getEmExibicao());

            $page = $queryParams['page'] ?? '1';

            $pagination = new Pagination($total,$page,4);
            $filmes = $model->getEmExibicao($pagination->getLimit());

        }catch(Exception $e)
        {
            echo $e->getMessage();
            $filmes = [];
            $pagination = null;
        }
        return View::render("home::home",[
            "filmes" => $filmes,
            "links" => ($pagination)?self::getPagination($pagination,$request,"home-","#filmes"):""
        ]);
    }
    public static function showMovie($id,$request)
    {
        $model = new ModelFilme();
        $filme = $model->find($id);
        
        $cinemas = ($model->getCinemasComSessoes($id)) ?? [];
        // var_dump($cinemas);
        // exit;
        if(is_null($filme) || !$filme){
            Session::set("error","Falha ao encontrar Filme!");
            $request->getRouter()->redirect("/");
        }
        return View::render("home::filme",[
            "filme" => $filme,
            "cinemas" => $cinemas
        ]);
    }
    public static function getSessoesOnCinema($idFilme,$idCinema,$request)
    {
        
        $model = new ModelFilme();
        $filme = $model->find($idFilme);
        if(is_null($filme) || !$filme){
            return [];
        }
        $sessoes = $model->getSessoesNoCinema($idFilme,$idCinema);
        foreach($sessoes as $sessao=>$value)
        {
            $sessoes[$sessao]['DATA'] = date("d-m-Y",strtotime($sessoes[$sessao]['DATA']));
            $sessoes[$sessao]['HORA'] = date("H:i",strtotime($sessoes[$sessao]['HORA']));
        }
        return $sessoes;
        $data = "";
        if(is_array($sessoes))
        {
            $data = "";
            foreach ($sessoes as $sessao) 
            {
                $data.="
                <tr>
                    <td >{$sessao['SALA']}</td>
                    <td>{$sessao['DATA']}</td>
                    <td>{$sessao['HORA']}</td>
                    <td>{$sessao['PRECO']}</td>
                    <td>{$sessao['LUGARES_DISPONIVEIS']}</td>
                    <td>
                        <span  class=\"btn bg-red-500 modal-trigger\"   style='padding: 4px 6px;color:wheat;border-radius:5px;cursor:pointer;'>Reservar</span>
                    </td>
                </tr>
                ";
            }
            return $data;
        }
        // var_dump($sessoes);
        return $sessoes ?? [];
        
    }

    public static function filter($request)
    {
        $pagination = null;
        $queryParams = $request->getQueryParams();
        $model = new ModelFilme();
        $filmes = [];
        $postVars = $request->getPostVars();
        $titulo = $postVars['titulo'] ?? $queryParams['titulo'] ?? '';
        $genero = $postVars['genero'] ?? $queryParams['genero'] ?? '';

       
        try{
            $total = count($model->filter("",["titulo"=>$titulo,"genero"=>$genero]));

            $page = $queryParams['page'] ?? '1';

            $pagination = new Pagination($total,$page,4);
            $filmes = $model->filter($pagination->getLimit(),["titulo"=>$titulo,"genero"=>$genero]);

        }catch(Exception $e)
        {
            $filmes = [];
            $pagination = null;
        }
        return View::render("home::home",[
            "filmes" => $filmes,
            "links" => self::getPagination($pagination,$request,"home-","#filmes",null,["titulo"=>$titulo,"genero"=>$genero])
        ]);
    }

    public static function dashboard()
    {
        $filmes = count((new ModelFilme())->all());
        $reservas = (Session::get("usuario")['nivel']=='admin')?count((new Reserva())->all("")):count((new Reserva())->all("",Session::get("usuario")['id_cinema']));
        $sessoes = (Session::get("usuario")['nivel']=='admin')?count((new Sessao())->all("")):count((new Sessao())->all("",Session::get("usuario")['id_cinema']));
        $funcionarios = count((new ModelFilme())->all());
        return View::render("adm-home::home",[
            "filmes"=>$filmes,
            "reservas"=>$reservas,
            "sessoes"=>$sessoes,
            "funcionarios"=>$funcionarios
        ]);
    }
   
}
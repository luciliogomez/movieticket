<?php
namespace App\Controllers\Pages;
use App\Http\Request;
use App\Models\Cidade;
use App\Models\Cinema as ModelsCinema;
use App\Models\Model;
use App\Utils\View;
use WilliamCosta\DatabaseManager\Pagination;
use Exception;
use App\Utils\Session;
class Cinema extends PagesBaseController{

    /**
     * Get all cinema
     */
    public static function index($request)
    {

        $cinemas = [];
        $pagination = null;

        $queryParams = $request->getQueryParams();
        $model = new ModelsCinema();
        
        try{
            $total = count($model->all());

            $page = $queryParams['page'] ?? '1';

            $pagination = new Pagination($total,$page,3);
            $cinemas = $model->all($pagination->getLimit());

        }catch(Exception $e)
        {
            $cinemas = [];
            $pagination = null;
        }
        //$tabela = self::getTabela(["ID","NOME","EMAIL","ACÇÃO"],$clientes,"/cliente","id",0,false,true,true);

        // $content = View::render("pages/clientes/lista",[
        //     'tabela' => $tabela,
        //     "pagination" => self::getPagination($pagination,$request),
        //     "status" => self::getStatus($request)
        // ]);

        // return self::getTemplate("CLientes","Clientes","LISTA DE CLIENTES",$content);
        return View::render("adm-cinemas::lista",[
            "cinemas" => $cinemas,
            //"status" => self::getStatus($request),
            //"headers" => ['ID',"NOME","EMAIL","ACÇÃO"],
            //"clientes"=> $clientes,
            "links" => self::getPagination($pagination,$request)

        ]);



        
    }


    /**
     * Get one especific cinema
     */
    public static function show($id,$request)
    {

        $model = new ModelsCinema();
        $cinema = $model->find($id);
        
        if(is_null($cinema) || !$cinema)
        {  
            Session::set("error","Cinema Não Encontrado!");
            $request->getRouter()->redirect("/adm/cinemas");
        }
        $model->setId($cinema['ID_CINEMA']);

        $salas = $model->get_salas();
        return View::render("adm-cinemas::show",[
            "cinema" => $cinema,
            "salas"  => $salas,
            "links" => ''
        ]);
        //return ($cinema);
        

    }
    
    public static function create($request)
    {
        $model = new Cidade();
        $cidades = $model->all() ?? [];
        
        return View::render("adm-cinemas::novo",[
            "cidades" => $cidades
        ]);
    }


    public static function update($id_cinema,Request $request)
    {    
        $postVars = $request->getPostVars();

        if(empty($postVars['id_rua']) || empty($postVars['nome']))
        {
            return [
                "status" => "erro",
                "message"=> "Parametros não informados"
            ];
        }
        $nome = $postVars['nome'];
        $id_rua = $postVars['id_rua'];
       
        $cinema = new ModelsCinema();
        $cinema->setId($id_cinema);
        $cinema->setNome($nome);
        $cinema->setRua($id_rua);
        if($cinema->save())
        {
            return [
                "status" => "sucesso",
                "message"=> "Cinema actualizado"
            ];
        }else{
            return [
                "status"=> "erro",
                "message"=>"nao foi possivel actualizar o cinema"
            ];
        }
    }

    public static function store(Request $request)
    {
        $postVars = $request->getPostVars();
        
        if(empty($postVars['id_rua']) || empty($postVars['nome']))
        {
            Session::set("error","Falha ao cadastrar Cinema </br>Parametros Não Informados");
            $request->getRouter()->redirect("/adm/cinemas/create");
        }
        $nome = $postVars['nome'];
        $id_rua = $postVars['id_rua'];

        $cinema = new ModelsCinema();
        $cinema->setNome($nome);
        $cinema->setRua($id_rua);

        if($cinema->save())
        {
            Session::set("sucess","Cinema Cadastrado!");
            $request->getRouter()->redirect("/adm/cinemas/create");
        }else{
            Session::set("error","Falha ao cadastrar Cinema!");
            $request->getRouter()->redirect("/adm/cinemas/create");
        }

    }
    
    public static function get_salas($id,$request)
    {
        $cinema = new ModelsCinema();
        $cinema->setId($id);
        $salas =  $cinema->get_salas();
        $options  = "";
        foreach($salas as $sala)
        {
            $options .= "<option value='{$sala['id_sala']}'>{$sala['numero']}</option>";
        }
        return $options;
    }
    
    
    public static function create_sala($id,$request)
    {
        
        $model = new ModelsCinema();
        $cinema = $model->find($id);
        
        if(is_null($cinema) || !$cinema)
        {  
            Session::set("error","Cinema Não Encontrado!");
            $request->getRouter()->redirect("/adm/cinemas");
        }
        return View::render("adm-cinemas::nova_sala",[
            "cinema"=> $cinema
        ]);
    }

    public static function add_sala($id_cinema,Request $request)
    {
        $postVars = $request->getPostVars();
        if(empty($postVars['number']) || empty($postVars['id_cinema']) || empty($postVars['capacity']))
        {
            Session::set("error","Falha. Parametros Não Informados!");
            $request->getRouter()->redirect("/adm/cinemas/{$id_cinema}/nova-sala");
        }
        
        $numero = $postVars['number'];
        $id_cinema = $postVars['id_cinema'];
        $capacidade = $postVars['capacity'];
        
        $cinema = new ModelsCinema();
        $cinema->setId($id_cinema);

        if($cinema->new_sala($numero,$capacidade))
        {
            Session::set("sucess","Sala Adicionada!");
            $request->getRouter()->redirect("/adm/cinemas/{$id_cinema}/");
        }else{
            Session::set("error","Falha ao Adicionar Sala!");
            $request->getRouter()->redirect("/adm/cinemas/{$id_cinema}/");
        }
    }

    
    public static function edit_sala($id,$request)
    {
        
        $model = new ModelsCinema();
        $sala = $model->findSala($id);
        
        if(is_null($sala) || !$sala)
        {  
            Session::set("error","Sala Não Encontrada!");
            $request->getRouter()->redirect("/adm/cinemas");
        }
        return View::render("adm-cinemas::edit_sala",[
            "sala"=> $sala
        ]);
    }

    public static function update_sala(Request $request)
    {
        
        $postVars = $request->getPostVars();
        
        if(empty($postVars['numero'])  || empty($postVars['capacidade']))
        {
            Session::set("error","Falha. Parametros Não Informados!");
            $request->getRouter()->redirect("/adm/salas/{$postVars['id_sala']}/edit");
        }
        
        $numero = $postVars['numero'];
        $id_sala = $postVars['id_sala'];
        $capacidade = $postVars['capacidade'];

        $cinema = new ModelsCinema();

        if($cinema->update_sala($id_sala,$numero,$capacidade))
        {
            Session::set("sucess","Sala Actualizada!");
            $request->getRouter()->redirect("/adm/salas/{$id_sala}/edit");
        }else{
            Session::set("error","Falha ao Actualizar Sala!");
            $request->getRouter()->redirect("/adm/cinemas/{$id_sala}/edit");
        }
    }

    public static function get_lugares($id_sala,$request)
    {
        //var_dump($id_sala);
        $cinema = new ModelsCinema();
        return $cinema->get_lugares($id_sala);
    }
   
}
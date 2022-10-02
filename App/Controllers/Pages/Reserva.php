<?php
namespace App\Controllers\Pages;

use App\Controllers\Pages\Cliente as PagesCliente;
use App\Models\Audit;
use App\Models\Cliente;
use App\Models\Reserva as ModelReserva;
use WilliamCosta\DatabaseManager\Pagination;
use App\Models\Filme as ModelFilme;
use App\Utils\Alert;
use App\Utils\LoadPdf;
use App\Utils\View;
use App\Utils\Session;
use Exception;

class Reserva extends PagesBaseController{
    /**
     * GET ALL MOVIES
     * @param Request $requisicao
     * @return array $movies
     */
    public static function index($request)
    {
        $model = new ModelReserva();
        $queryParams = $request->getQueryParams();

        // if(isset($queryParams['data']))
        // {
        //     $data = $queryParams['data'];

        //     return ($model->loadByDate($data));
        // }
        // return ($model->all());
        $reservas = [];
        $pagination = [];
        
        try{

            // $total = count($model->all(0,0));
            $total = (Session::get("usuario")['nivel']=="admin")?count($model->all()):count($model->all(Session::get("usuario")['id_cinema']));

            $curretPage = $queryParams['page'] ?? '1';

            $pagination = new Pagination($total,$curretPage,3);

            // $reservas = $model->all($offset,$limit);
            $reservas = (Session::get("usuario")['nivel']=="admin")?$model->all($pagination->getLimit()):$model->all($pagination->getLimit(),Session::get("usuario")['id_cinema']);
        }catch(Exception $e)
        {
            var_dump($e);
            $reservas = [];
            $pagination = [];
        }
        
        return View::render("adm-reservas::lista",[
            "reservas" => $reservas,
            "links"  => self::getPagination($pagination,$request)
        ]);

    }

    public static function store($request)
    {
        $postVars = $request->getPostVars();
        $nome = $postVars['nome'];
        $telefone = $postVars['telefone'];
        $lugares = $postVars['lugares'];
        //$lugares = explode(",",$lugares);
        
        $reservaModel = new ModelReserva();
        
        if(($id = $reservaModel->save($nome,$telefone,$lugares)) )
        {           
            return[
                    "status" => "sucesso",
                    "message" => "Reserva Efectuada",
                    "codigo" => $id 
            ];
        }
        else{
            return [
                "status" => "erro",
                "message" => "Erro ao Efectuar Reserva ",
                
            ];
        }
    }
    public static function update($request)
    {
        $postVars = $request->getPostVars();
        $id_reserva = $postVars['id_reserva'];
        $lugares = $postVars['lugares'];
        //$lugares = explode(",",$lugares);
        
        $reservaModel = new ModelReserva();
        
        if($reservaModel->update($id_reserva,$lugares) )
        {           
            return[
                    "status" => "sucesso",
                    "message" => "Reserva Actualizada",
                    "codigo" => $reservaModel->find($id_reserva)
            ];
        }
        else{
            return [
                "status" => "erro",
                "message" => "Erro ao Actualizar Reserva ",
                
            ];
        }
    }

    public static function getRecibo($id,$request)
    {
        
        $reservaModel = new ModelReserva();
        $reserva = $reservaModel->find($id);
        
        $reciboHtml = "<div> 
                        <h3 style='font-family:arial,sans-serif;'>CINEMA CORPORATION</h3>
                        <p>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</p>
                        <ul style='list-style-type:none;font-family:arial,sans-serif;'>
                        <li><span style='font-weight:bolder'>FACTURA/RECIBO:</span> {$reserva['ID_RESERVA']}</li>
                        <li><span style='font-weight:bolder'>DATA:</span> {$reserva['DATA DA RESERVA']}</li>
                        <li><span style='font-weight:bolder'>CINEMA:</span> {$reserva['CINEMA']}</li>
                        </ul>

                        <p>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</p>
                        <ul style='list-style-type:none;font-family:arial,sans-serif;'>
                        <li><span style='font-weight:bolder'>CLIENTE:</span> {$reserva['CLIENTE']}</li>
                        <li><span style='font-weight:bolder'>TELEFONE:</span> {$reserva['TELEFONE']}</li>
                        </ul>

                        <p>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</p>
                        <ul style='list-style-type:none;font-family:arial,sans-serif;'>
                        <li><span style='font-weight:bolder'>FILME:</span> {$reserva['FILME']}</li>
                        <li><span style='font-weight:bolder'>DATA DE EXIBICAO:</span> {$reserva['DATA DE EXIBICAO']}</li>
                        <li><span style='font-weight:bolder'>QTD. LUGARES:</span> {$reserva['LUGARES']}</li>
                        <li><span style='font-weight:bolder'>TOTAL:</span> {$reserva['total']}</li>
                        </ul>
                        <p>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</p>
                        <p>Apresente este recibo para leventar o seu bilhete</p>
                        <h4 style='font-weight:bolder;font-family:arial,sans-serif;'>Obrigado!!!</h4>
                        </div>";
                        
        $loadPdf = new LoadPdf();
        $loadPdf->load($reciboHtml);
        $loadPdf->print();
        
        return $reserva;
    }

    public static function getBilhetes($id_reserva,$request)
    {
        $reservaModel = new ModelReserva();
        $reserva = $reservaModel->find($id_reserva);
        $lugares = $reservaModel->getLugares($id_reserva);
        
        // var_dump($reserva,$lugares);
        // exit;
        $bilhetes = "";
        foreach($lugares as $lugar)
        {
            // $bilhetes.= "<!DOCTYPE html>
            // <html>
            // <body><div style='display:flex;justify-content:space-between;border:1px solid grey;font-family:Arial;'>
            //             <div style='width:70%;border-right:2px dotted grey;padding:10px'>
            //                 <h3 style='font-family:Arial;background-color:pink;color:white;padding:5px;'>CINETICKET</h3>
            //                 <ul style='list-style-type:none;'>
            //                     <li>CINEMA:<span style='color:pink;'>{$reserva['CINEMA']}</span></li>
            //                     <li>SALA:<span style='color:pink;'>{$reserva['SALA']}</span></li>
            //                     <li>DATA:<span style='color:pink;'>{$reserva['DATA DE EXIBICAO']}</span></li>
            //                     <li>HORA:<span style='color:pink;'>{$reserva['HORA']}</span></li>
            //                     <li>LUGAR:<span style='color:pink;'>{$lugar['ID_LUGAR_DISPONIVEL']}</span></li>
            //                 </ul>    
            //             </div>
            //         </div>
            //         </body>
            //         </html>";

             $bilhetes.= "
        <div class='principal' style='width: 450px;display: flex;margin-bottom:20px;border:4px dotted gray;'>
             <div class='div1' style='border: 2px dotted black;padding-right: 10px;padding-left: 10px;'> 
                 <h1 class='titulo' style='background-color:  rgb(235, 15, 52);color: white;margin-bottom: 0;padding:5px 10px;'> CINEMA TICKET</h1>
                 <div class='is' style='display: flex;flex-direction: row-reverse;'>
                     <ul class='sem_ponto' style='list-style-type: none;'>
                         <li>CINEMA : <span class='val1' style='color: rgb(235, 15, 52);'>{$reserva['CINEMA']}</span></li>
                         <li>SALA : <span class='val1' style='color: rgb(235, 15, 52);'>{$reserva['SALA']}</span></li>
                         <li>DATA : <span class='val1' style='color: rgb(235, 15, 52);'>{$reserva['DATA DE EXIBICAO']}</span></li>
                         <li>LUGAR : <span class='val1' style='color: rgb(235, 15, 52);'>{$lugar['numero']}</span></li>
                      </ul>
                     
                 </div>
             </div>    
             <div class='div2'>
                 
             </div>
             
        </div>
             ";
        }

        $bilhetes.= "";
        
        // var_dump($bilhetes);
        // echo $bilhetes;
        // exit;
        $loadPdf = new LoadPdf();
        $loadPdf->load($bilhetes);
        $loadPdf->print();

        $request->getRouter()->redirect("/");
        return $reserva;
    }

    public static function cancel($id,$request)
    {
        $model = new ModelReserva();
        if($model->cancelar_reserva($id))
        {
            Session::set("sucess","Reserva Cancelada!");
            $request->getRouter()->redirect("/adm/reservas");
            
         }else{
            Session::set("error","Erro ao Cancelar Reserva!");
            $request->getRouter()->redirect("/adm/reservas");
            
        }
    }

    public static function confirm($id,$request)
    {
        $model = new ModelReserva();

        if(!is_array($reserva = $model->find($id)))
        {
            Session::set("error","Reserva Não encontrada!");
            $request->getRouter()->redirect("/adm/reservas");
            
        }
        $model->setId($id);
        if($model->confirm())
        {
            Session::set("sucess","Reserva Confirmada!");
            $request->getRouter()->redirect("/adm/reservas");

         }else{
            Session::set("error","Não foi possível confirmar a reserva!");
            $request->getRouter()->redirect("/adm/reservas");
        }
    }

    

    public static function history($id,$request)
    {
        $model = new ModelReserva();
        return ($model->history($id));
    }

    public static function filter($request)
    {
        $pagination = null;
        $queryParams = $request->getQueryParams();
        $model = new ModelReserva();
        $reservas = [];
        $postVars = $request->getPostVars();
        $criterio = $postVars['criterio'] ?? $queryParams['criterio'] ?? 'cliente';
        $termo = $postVars['termo'] ?? $queryParams['termo'] ?? '';

       
        try{
            //$total = count($model->filter('',$criterio,$termo));
            $total = (Session::get("usuario")['nivel']=="admin")?count($model->filter('',$criterio,$termo)):count($model->filter('',$criterio,$termo,Session::get("usuario")['id_cinema']));

            $page = $queryParams['page'] ?? '1';

            $pagination = new Pagination($total,$page,4);
            //$reservas = $model->filter($pagination->getLimit(),$criterio,$termo);
            $reservas = (Session::get("usuario")['nivel']=="admin")?$model->filter($pagination->getLimit(),$criterio,$termo):$model->filter($pagination->getLimit(),$criterio,$termo,Session::get("usuario")['id_cinema']);
        }catch(Exception $e)
        {
            var_dump($e);
            $reservas = [];
            $pagination = null;
        }
        // var_dump($reservas);
        return View::render("adm-reservas::lista",[
            "reservas" => $reservas,
            "links" => self::getPagination($pagination,$request,"","#",null,["criterio"=>$criterio,"termo"=>$termo])
        ]);
    }
    public static function create($request)
    {
        return View::render("empresas::novo");
    }
 
    public static function show($id,$request)
    {
        
        $model = new ModelFilme();
        return $model->find($id);
    }
    public static function cancelarReservasPendentes()
    {
        
        $model = new ModelReserva();
        $ids = $model->getAtrasadas();
        foreach ($ids as $id) {
            echo $id['ID_RESERVA'];
            $model->setId($id['ID_RESERVA']);
            if($model->cancel($id['ID_RESERVA']))
            {
                continue;
            }else{
                continue;
            }
        }
        
    }
    

 
}
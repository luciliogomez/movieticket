<?php
namespace App\Models;

use App\Utils\Conexao;

class Reserva extends Model{

    static $table = "reservas";
    
    /**
     * um mapeamento entre o criterio de pesquisa e a coluna da consulta  
     */
    static $filterColumns = ["cliente"=>"C.nome","codigo"=>"R.ID_RESERVA","filme"=>"F.titulo"];

    private $id;

    private $data;

    private $cliente;

    private $estado;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setData($data)
    {
        $this->data= $data;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    
    public function getId()
    {
        return $this->id;
    }
    public function getData()
    {
        return $this->data;
    }
    public function getCliente()
    {
        return $this->cliente;
    }
    public function getEstado()
    {
        return $this->estado;
    }


    // Em select's normais, não coloque 'ponto e vírgula' (;)
    public function all($limit="",$cinema = "all")
    {
        $filterString = ($cinema == "all")?"":" WHERE CI.ID_CINEMA = :id_cinema ";

        $limit = (strlen($limit))? "limit ".$limit:"";

        $query = "SELECT DISTINCT R.ID_RESERVA  AS 'ID_RESERVA',C.NOME AS CLIENTE,
        F.titulo as FILME,F.ID_FILME, DATE(S.HORARIO) AS 'DATA' ,
        COUNT(RL.ID_RESERVA) as 'LUGARES',
        CI.nome as CINEMA,SA.NUMERO AS SALA, R.ESTADO FROM RESERVAS R
        INNER JOIN CLIENTES C ON (C.ID_CLIENTE = R.ID_CLIENTE)
        INNER JOIN RESERVAS_LUGARES RL ON (RL.ID_RESERVA = R.ID_RESERVA)
        INNER JOIN LUGARES_DISPONIVEIS LD ON(LD.ID_DISPONIVEL = RL.ID_LUGAR_DISPONIVEL)
        INNER JOIN SESSOES S ON (S.ID_SESSAO = LD.ID_SESSAO)
        INNER JOIN FILMES F ON(F.ID_FILME = S.ID_FILME)
        INNER JOIN SALAS SA ON (SA.ID_SALA = S.ID_SALA)
        INNER JOIN CINEMAS CI ON (CI.ID_CINEMA = SA.ID_CINEMA) ".$filterString."
                        GROUP BY R.ID_RESERVA,S.HORARIO,CI.nome,SA.NUMERO,C.NOME,F.titulo,F.ID_FILME,R.ESTADO
                        ORDER BY R.ID_RESERVA DESC ".$limit;
               
        $stmt = Conexao::getInstance()->prepare($query);
        if($cinema!="all")
        {
            $stmt->bindParam(":id_cinema",$cinema);
        }
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            return [];
        }
    }
    
    public function filter($limit='',$criterio,$termo="",$cinema = "all")
    {
        $termo = "{$termo}%";
        $filterString = ($cinema == "all")?"":" AND CI.ID_CINEMA = :id_cinema ";
        $filterString .= " AND ".self::$filterColumns[$criterio]." LIKE :".$criterio." ";
        // foreach ($filters as $key=>$value) {
        //     if($key == "estado"){
        //         if($value=="-2"){
        //             // $filters[$key] = "%%";
        //             $filterString .= "AND R.".$key." > :".$key."";
        //         }else{
        //             // $filters[$key] = "%{$filters[$key]}%";
        //             $filterString .= "AND R.".$key." = :".$key." ";
        //         }
        //     }else{
        //         $filters[$key] = "%{$filters[$key]}%";
        //         $filterString .= " AND ".$key." LIKE :".$key." ";
        //     }
        // }
        $limit = (strlen($limit))? "limit ".$limit:"";

        $query = "SELECT DISTINCT R.ID_RESERVA  AS 'ID_RESERVA',C.NOME AS CLIENTE,
        F.titulo as FILME,F.ID_FILME, S.HORARIO AS 'DATA' ,
        COUNT(RL.ID_RESERVA) as 'LUGARES',
        CI.nome as CINEMA,SA.NUMERO AS SALA, R.ESTADO as ESTADO FROM RESERVAS R
        INNER JOIN CLIENTES C ON (C.ID_CLIENTE = R.ID_CLIENTE)
        INNER JOIN RESERVAS_LUGARES RL ON (RL.ID_RESERVA = R.ID_RESERVA)
        INNER JOIN LUGARES_DISPONIVEIS LD ON(LD.ID_DISPONIVEL = RL.ID_LUGAR_DISPONIVEL)
        INNER JOIN SESSOES S ON (S.ID_SESSAO = LD.ID_SESSAO)
        INNER JOIN FILMES F ON(F.ID_FILME = S.ID_FILME)
        INNER JOIN SALAS SA ON (SA.ID_SALA = S.ID_SALA)
        INNER JOIN CINEMAS CI ON (CI.ID_CINEMA = SA.ID_CINEMA)
        WHERE 1=1 ".$filterString." 
        GROUP BY R.ID_RESERVA,S.HORARIO,CI.nome,SA.NUMERO,C.NOME,F.titulo,F.ID_FILME,R.ESTADO
        ORDER BY R.ID_RESERVA DESC ".$limit;
        
        $stmt = Conexao::getInstance()->prepare($query);
        
        $stmt->bindParam("{$criterio}",$termo);
        if($cinema!="all")
        {
            $stmt->bindParam(":id_cinema",$cinema);
        }
        $stmt->execute();
        if($stmt->rowCount()>0){

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        }else{

            return [];
        
        }
    }
   
    

    public function find($id)
    {
        $query = "SELECT DISTINCT R.ID_RESERVA,R.DATA_ AS 'DATA DA RESERVA' ,C.NOME AS CLIENTE,
        C.TELEFONE,F.titulo as FILME,S.HORARIO as 'DATA DE EXIBICAO', COUNT(RL.ID_RESERVA) as LUGARES,SUM(S.preco) as total,
        CI.nome as CINEMA,SA.NUMERO AS SALA FROM RESERVAS R
        INNER JOIN CLIENTES C ON (C.ID_CLIENTE = R.ID_CLIENTE)
        INNER JOIN RESERVAS_LUGARES RL ON (RL.ID_RESERVA = R.ID_RESERVA)
        INNER JOIN LUGARES_DISPONIVEIS LD ON(LD.ID_DISPONIVEL = RL.ID_LUGAR_DISPONIVEL)
        INNER JOIN SESSOES S ON (S.ID_SESSAO = LD.ID_SESSAO)
        INNER JOIN FILMES F ON(F.ID_FILME = S.ID_FILME)
        INNER JOIN SALAS SA ON (SA.ID_SALA = S.ID_SALA)
        INNER JOIN CINEMAS CI ON (CI.ID_CINEMA = SA.ID_CINEMA)
        WHERE R.id_reserva = :id
        GROUP BY R.ID_RESERVA,R.DATA_,C.NOME,C.TELEFONE,F.titulo,S.HORARIO,CI.nome,SA.NUMERO";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        if($stmt->rowCount()>0){

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        
        }else{

            return [];
        
        }
    }

    public function loadByYear($email)
    {
        return $this->readOne("SELECT * FROM filmes WHERE ano = :ano",['ano'=>2020]);
    }
    
    public function create($id_cliente)
    {
        $query = "INSERT INTO reservas (id_cliente,estado) VALUES (:id_cliente,0);";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_cliente",$id_cliente);
        
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return Conexao::getInstance()->lastInsertId();
        }else{
            return null;
        }
    }

    public function save($nome,$telefone,$lugares)
    {
        $transaction = Conexao::getInstance();
        $transaction->beginTransaction();

        $cliente = new Cliente();
        $cliente->setNome($nome);
        $cliente->setTelefone($telefone);
        $id_reserva = null;
        if(($id_cliente =  $cliente->create())!=null)
        {
            $id_reserva = $this->create($id_cliente);
            if($id_reserva!=null)
            {
                $fail = false;
                $places = explode(",",$lugares);
                foreach($places as $place)
                {
                    if($this->reserva_lugar($id_reserva,$place) && $this->ocupar_lugar($place))
                    {
                        $fail=false;
                    }else{
                        $transaction->rollBack();
                        return false;
                    }
                }
                $transaction->commit();
                return $id_reserva;
            }
        }
        
    }

    public function update($id_reserva,$lugares)
    {
        $result = 0;
        $this->persist("DECLARE 
                            v_lugares ARRAY_LUGARES;
                            resulta number;
                        BEGIN 
                            v_lugares := ARRAY_LUGARES(".$lugares.");
                            :return := pck_reservas.actualizar_reserva(:id_reserva,v_lugares);
                            if :return = 1 then 
                                :return := 1;
                            else 
                                :return := 0;
                            end if;
                        EXCEPTION 
                            WHEN VALUE_ERROR THEN 
                                :return := 0;
                            WHEN OTHERS THEN 
                                :return := 0;
                        END;",[
                        ":id_reserva"=>$id_reserva,":return"=>&$result
                ]);
        
        if($result=='1'){
            return true;
        }
        return false;
    }

    public function cancel($id)
    {
        $query = "UPDATE reservas SET estado = -1  WHERE id_reserva = :id;";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id",$id);
        
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }  
    }

    public function delete()
    {
        $result = 0;
        if(isset($this->id))
        {
            $this->persist("BEGIN :return := pck_reservas.eliminar_reserva(:id);
                                            EXCEPTION WHEN VALUE_ERROR THEN :return:=0;WHEN OTHERS THEN :return:=0; END;",[
                ":id"=>$this->id,":return"=>&$result
            ]);

            if($result=='1'){
                return true;
            }
            return false;
        }
        else
        {
            return false;
        }   
    }

    public function confirm()
    {
        $query = "UPDATE reservas SET estado=1 WHERE id_reserva = :id_reserva;";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_reserva",$this->id);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return true;
        }
        else
        {
            return false;
        }

        
    }

    public function history($client_id)
    {
        $result = 0;
        $history = $this->read("BEGIN :return := pck_reservas.f_historico(:id,:cursor,0,0);
                EXCEPTION WHEN VALUE_ERROR THEN :return:=0;WHEN OTHERS THEN :return:=-1; END;",
            [
                "id"=>$client_id,"return"=>&$result
            ]);

        if($result=='1')
        {
            return $history;
        }
        return [];
    }

    public function loadByDate($date)
    {
        $result = 0;
        $reservas = $this->read("BEGIN :return := pck_reservas.reserva_dia(:date,:cursor,0,0);
                EXCEPTION WHEN VALUE_ERROR THEN :return:=0;WHEN OTHERS THEN :return:=-1; END;",
            [
                "date"=>$date,"return"=>&$result
            ]);

        if($result=='1')
        {
            return $reservas;
        }
        return [];
    }

    public function reserva_lugar($reserva,$lugar)
    {
        $query = "INSERT INTO reservas_lugares  VALUES(:lugar,:id_reserva);";

                    $stmt = Conexao::getInstance()->prepare($query);
                    $stmt->bindParam(":lugar",$lugar);
                    $stmt->bindParam(":id_reserva",$reserva);
                    $stmt->execute();
                    if($stmt->rowCount()>0){
                        return true;
                    }
                    else
                    {
                        return false;
                    }
    }


    public function ocupar_lugar($lugar)
    {
        $query = "UPDATE lugares_disponiveis SET estado=1 WHERE id_disponivel = :lugar;";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":lugar",$lugar);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return true;
        }
        else
        {
            return false;
        }
    }
    public function libera_lugar($lugar)
    {
        $query = "UPDATE lugares_disponiveis SET estado=0 WHERE id_disponivel = :lugar;";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":lugar",$lugar);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return true;
        }
        else
        {
            return false;
        }
    }

    public function last()
    {
        return $this->readOne("SELECT MAX(ID_RESERVA) as ultimo FROM RESERVAS",[])['ULTIMO'];
        //return $this->readOne("BEGIN pacote_filmes.get_(:id_filme,:cursor);END;",[':id_filme'=>$id]);
        
    }

    public function getLugares($id_reserva)
    {
        $query = "SELECT RL.ID_LUGAR_DISPONIVEL,L.numero FROM reservas_lugares RL
                    INNER JOIN  lugares_disponiveis LD ON(LD.ID_DISPONIVEL = RL.ID_LUGAR_DISPONIVEL)
                    INNER JOIN lugares L ON (L.ID_LUGAR = LD.ID_LUGAR)
                    WHERE ID_RESERVA=:id_reserva";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_reserva",$id_reserva);
        $stmt->execute();
        if($stmt->rowCount()>0){

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        }else{

            return [];
        
        }

    }
    
    public function getSessoes($id)
    {
        $result = 0;
        $movies =  $this->read("BEGIN :result := pacote_filmes.get_sessoes(:id_filme,:cursor);
                                EXCEPTION WHEN NO_DATA_FOUND THEN :result := 0; WHEN OTHERS THEN :result:=-1;END;"
                                ,[
                                    "id_filme" => $id,
                                    "result" => &$result
                                ]);
        
        if($result == '1')
        {
            return $movies;
        }
        return null;

    }
    
    public  function getAtrasadas()
    {
                    
                    return $this->read("SELECT DISTINCT R.ID_RESERVA  FROM RESERVAS R
                    INNER JOIN CLIENTES C ON (C.ID_CLIENTE = R.ID_CLIENTE)
                    INNER JOIN RESERVAS_LUGARES RL ON (RL.ID_RESERVA = R.ID_RESERVA)
                    INNER JOIN LUGARES_DISPONIVEIS LD ON(LD.ID_DISPONIVEL = RL.ID_LUGAR_DISPONIVEL)
                    INNER JOIN SESSOES S ON (S.ID_SESSAO = LD.ID_SESSAO)
                    INNER JOIN FILMES F ON(F.ID_FILME = S.ID_FILME)
                    INNER JOIN SALAS SA ON (SA.ID_SALA = S.ID_SALA)
                    INNER JOIN CINEMAS CI ON (CI.ID_CINEMA = SA.ID_CINEMA)
                    WHERE  SYSDATE+ (30/1440) >= S.HORARIO AND R.ESTADO = 0
                    ORDER BY R.ID_RESERVA DESC",[]);
    }

    public function cancelar_reserva($id)
    {
        $transaction = Conexao::getInstance();
        $transaction->beginTransaction();

        if($this->cancel($id))
        {
                $places = $this->getLugares($id);
                foreach($places as $place)
                {
                    if($this->libera_lugar($place['ID_LUGAR_DISPONIVEL']))
                    {
                        $fail=false;
                    }else{
                        $transaction->rollBack();
                        return false;
                    }
                }
                $transaction->commit();
                return true;
            
        }
        return false;
        
    }
}
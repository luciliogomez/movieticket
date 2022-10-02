<?php
namespace App\Models;
use App\Utils\Conexao;
class Cinema extends Model{

    private $id;

    private $nome;

    private $rua;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setRua($rua)
    {
        $this->rua = $rua;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getRua()
    {
        return $this->rua;
    }
    public  function save()
    {
       
        $query = "INSERT INTO cinemas (nome,id_rua) VALUES(:nome,:rua)";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":nome",$this->nome);
        $stmt->bindParam(":rua",$this->rua);
        $stmt->execute();
        if($stmt->rowCount()>0){

            return true;
        
        }else{

            return false;
        
        }
    }

    public function all($limit = "")
    {
        $limit = (strlen($limit))? "limit ".$limit:"";
        $query = "SELECT C.ID_CINEMA,C.NOME,R.NOME AS LOCALIZACAO FROM cinemas C 
                    INNER JOIN RUAS R ON (R.ID_RUA = C.ID_RUA) ORDER BY C.ID_CINEMA DESC ".$limit;

        $stmt = Conexao::getInstance()->prepare($query);
        // $stmt->bindParam(":id_filme",$id);
        $stmt->execute();
        if($stmt->rowCount()>0){

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        }else{

            return [];
        
        }
    }
    
    public function findSala($id)
    {
        return $this->readOne("SELECT * FROM SALAS WHERE ID_SALA = :id",[
            "id"=>$id
        ]);
    
    }

    public function find($id)
    {   
        $query = "SELECT C.ID_CINEMA,C.NOME FROM cinemas C 
                    WHERE C.ID_CINEMA = :id ";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }else{
            return [];
        }
    }


    public function get_salas()
    {
        $query = "SELECT * FROM salas WHERE id_cinema = :id_cinema";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_cinema",$this->id);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            return [];
        }
    }
    
    public  function new_sala($numero,$capacidade)
    {
        $transaction = Conexao::getInstance();
        $transaction->beginTransaction();

        
        $id_sala = null;
        if(($id_sala =  $this->add_sala($numero,$capacidade))!=0)
        {
            
                for($i=1; $i<=$capacidade; $i++)
                {
                    if( ($this->add_lugar($i,$id_sala))==false )
                    {
                        $transaction->rollBack();
                        return false;
                    }
                }
                $transaction->commit();
                return true;
            
        }else{
            return false;
        }
        
    }
    public  function add_sala($numero,$capacidade)
    {
        $query = "INSERT INTO salas (numero,capacidade,id_cinema) VALUES (:numero,:capacidade,:id_cinema);";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_cinema",$this->id);
        $stmt->bindParam(":numero",$numero);
        $stmt->bindParam(":capacidade",$capacidade);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return Conexao::getInstance()->lastInsertId();;
        }else{
            return 0;
        }
    }
    public function add_lugar($numero,$id_sala)
    {
        $query = "INSERT INTO lugares  VALUES(null,:numero,:id_sala);";

                    $stmt = Conexao::getInstance()->prepare($query);
                    $stmt->bindParam(":numero",$numero);
                    $stmt->bindParam(":id_sala",$id_sala);
                    $stmt->execute();
                    if($stmt->rowCount()>0){
                        return true;
                    }
                    else
                    {
                        return false;
                    }
    }
    public  function update_sala($id,$numero,$capacidade)
    {
        $result = 0;
        $this->persist("BEGIN UPDATE SALAS SET numero = :numero, capacidade = :capacidade WHERE id_sala = :id;
                                :return := 1;
                                EXCEPTION WHEN VALUE_ERROR THEN :return := 0; WHEN OTHERS THEN :return :=0; END;",[
                                    ":numero"=>$numero, ":capacidade"=>$capacidade,":id"=>$id,":return"=>&$result
                        ]);
        
        if($result == '1')
        {
            return true;
        }
        return false;
    }
    
    public function get_lugares($id_sala)
    {
        
        //var_dump($id_sala);
        $result = 0;
        $salas = $this->read("SELECT * FROM LUGARES WHERE id_sala=:id_sala",[
            //"return"=>&$result,
            "id_sala" => $id_sala
        ]);
        return $salas;
    }

}
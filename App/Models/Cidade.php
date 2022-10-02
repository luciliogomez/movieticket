<?php
namespace App\Models;
use App\Utils\Conexao;
class Cidade extends Model{
    
    private $id;

    private $nome;

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    // Em select's normais, não coloque 'ponto e vírgula' (;)
    public function all($limit = "")
    {
        $limit = (strlen($limit))?" LIMIT ".$limit:"";
        $query = "SELECT * FROM cidades ".$limit;

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            return [];
        }
    }

    public function find($id)
    {
        $query = "SELECT * FROM CIDADES WHERE id_cidade = :id ";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam("id",$id);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }else{
            return [];
        }
    }


    public function save()
    {
        $query = "INSERT INTO cidades(nome) VALUES(:nome)";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam("nome",$this->nome);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }

    public function getRuas($id)
    {

        $query = "SELECT * FROM ruas WHERE ID_CIDADE =:id_cidade";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam("id_cidade",$id);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            return [];
        }
    }
    
    public function getAllRuas()
    {

       return [];

    }
    public function addStreet($nome,$cidade)
    {
        $query = "INSERT INTO ruas(nome,id_cidade) VALUES(:nome,:cidade)";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam("nome",$nome);
        $stmt->bindParam("cidade",$cidade);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }

}
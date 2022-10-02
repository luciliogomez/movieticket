<?php
namespace App\Models;
use App\Utils\Conexao;
class Cliente{

    private $id_cliente;
    private $nome;
    private $telefone;

    public function setId($id)
    {
        $this->id_cliente = $id;
    }
    
    public function setNome($name)
    {
        $this->nome = $name;
    }
    
    public function setTelefone($cellphone)
    {
        $this->telefone = $cellphone;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getId()
    {
        return $this->id;
    }

    public function create()
    {
        $query = "INSERT INTO clientes (nome,telefone)VALUES (:nome,:telefone)";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":nome",$this->nome);
        $stmt->bindParam(":telefone",$this->telefone);
        
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return Conexao::getInstance()->lastInsertId();
        }else{
            return null;
        }
    }

}
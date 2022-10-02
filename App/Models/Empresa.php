<?php
namespace App\Models;

use App\Utils\Conexao;

class Empresa{

    private $id;

    private $nome;

    private $email;

    private $ano;

    private $descricao;

    private $cidade;

    private $telefone;

    private $logotipo;

    private $senha;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setCidade($city)
    {
        $this->cidade = $city;
    }
    public function setLogo($pic)
    {
        $this->logotipo = $pic;
    }
    public function setTelefone($phone)
    {
        $this->telefone = $phone;
    }
    public function setDescricao($resume)
    {
        $this->descricao = $resume;
    }

    public function setAnoFundacao($year)
    {
        $this->ano = $year;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getCidade()
    {
        return $this->cidade;
    }
    public function getLogo()
    {
        return $this->logotipo;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
    
    public function getAnoFundacao()
    {
        return $this->ano;
    }

    public function getSenha()
    {
        return $this->senha;
    }


    public function read()
    {
        $query = "SELECT id,nome,email,cidade,descricao,
        logotipo,telefone,ano FROM empresa";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->execute();
        if($stmt->rowCount()>0){

            return $stmt->fetchAll(\PDO::FETCH_CLASS,Empresa::class);
        
        }else{

            return [];
        
        }
    }

    public function load($id)
    {
        $query = "SELECT id,nome,email,cidade,descricao,
        logotipo,telefone,ano FROM empresa 
        WHERE id = :id";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        if($stmt->rowCount()>0){

            return $stmt->fetchObject(Empresa::class);
        
        }else{
            return [];
        }
    }


    public function create()
    {
        $query = "INSERT INTO empresa (nome,email,senha) 
        VALUES (:nome,:email,:senha)";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":nome",$this->getNome());
        $stmt->bindParam(":email",$this->getEmail());
        $stmt->bindParam(":senha",$this->getSenha());
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return Conexao::getInstance()->lastInsertId();
        
        }else{
            return null;
        }
    }

    public function update()
    {
        $query = "UPDATE empresa SET nome = :nome, email = :email, cidade = :cidade,
        logotipo = :foto, telefone = :telefone, ano = :ano,descricao = :descricao 
        WHERE id = :id";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":nome",$this->getNome());
        $stmt->bindParam(":email",$this->getEmail());
        $stmt->bindParam(":cidade",$this->getCidade());
        $stmt->bindParam(":foto",$this->getLogo());
        $stmt->bindParam(":telefone",$this->getTelefone());
        $stmt->bindParam(":ano",$this->getAnoFundacao());
        $stmt->bindParam(":descricao",$this->getDescricao());
        $stmt->bindParam(":cidade",$this->getCidade());
        $stmt->bindParam(":id",$this->getId());
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return true;
        
        }else{
            return false;
        }
    }

}
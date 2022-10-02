<?php
namespace App\Models;

use App\Utils\Conexao;

class User{
    private $id;

    private $nome;

    private $email;

    private $senha;

    private $nivel;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getNome()
    {
        return $this->nome;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    public function getSenha()
    {
        return $this->senha;
    }

    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }
    public function getNivel()
    {
        return $this->nivel;
    }



    public function read()
    {
        $query = "SELECT * FROM candidato";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->execute();
        if($stmt->rowCount()>0){

            return $stmt->fetchAll(\PDO::FETCH_CLASS,Candidato::class);
        
        }else{

            return [];
        
        }
    }
    public function load($id)
    {
        $query = "SELECT id,nome,email,senha,nivel 
        FROM users WHERE id =:id";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam("id",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return $stmt->fetchObject(Candidato::class);
        
        }else{

            return [];
        
        }
    }


    public function create()
    {
        $query = "INSERT INTO users (nome,email,senha,nivel) 
        VALUES (:nome,:email,:senha,nivel)";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":nome",$this->getNome());
        $stmt->bindParam(":email",$this->getEmail());
        $stmt->bindParam(":senha",$this->getSenha());
        $stmt->bindParam(":nivel",$this->getNivel());
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return Conexao::getInstance()->lastInsertId();
        
        }else{
            return null;
        }
    }

    public function update()
    {
        $query = "UPDATE users SET nome = :nome, email = :email, 
        senha = :senha, nivel = :nivel, 
        WHERE id = :id";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":nome",$this->getNome());
        $stmt->bindParam(":email",$this->getEmail());
        $stmt->bindParam(":senha",$this->getSenha());
        $stmt->bindParam(":nivel",$this->getNivel());
        $stmt->bindParam(":id",$this->getId());
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return true;
        
        }else{
            return false;
        }
    }
}
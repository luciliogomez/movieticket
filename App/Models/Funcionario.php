<?php
namespace App\Models;

use App\Utils\Conexao;

class Funcionario extends Model{

    static $table = "funcionarios";
    
    private $id;

    private $nome;

    private $email;

    private $senha;

    private $nivel;

    private $id_cinema;

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
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }
    public function setCinema($id)
    {
        $this->id_cinema = $id;
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
    public function getSenha()
    {
        return $this->senha;
    }
    public function getNivel()
    {
        return $this->nivel;
    }
    public function getCinema()
    {
        return $this->id_cinema;
    }


    // Em select's normais, não coloque 'ponto e vírgula' (;)
    public function all($limit='')
    {
        $limit = (strlen($limit))?" LIMIT ".$limit:"";

        $query = "SELECT F.*,C.nome as cinema FROM funcionarios F
            INNER JOIN Cinemas C on (C.id_cinema = F.id_cinema) ORDER BY id_funcionario DESC ".$limit;
        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

    }
   

    public function find($id)
    {

        $query = "SELECT ID_FUNCIONARIO,NOME,EMAIL,NIVEL,ID_CINEMA,SENHA FROM funcionarios WHERE ID_FUNCIONARIO = :id ";
        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        return null;
        
    }

    public function login($email,$senha)
    {
        $result = 0;
        $user = $this->readOne("BEGIN :re := pck_funcionarios.login(:email,:senha,:cursor);
                            EXCEPTION WHEN VALUE_ERROR THEN :re :=0;WHEN OTHERS THEN :re :=-1; END;",
        [':email'=>$email,":senha"=>$senha,":re"=>&$result]);
    
        
        //var_dump($result);
        if($result=='1'){
            return $user;
        }
        return false;
    }


    public function save()
    {
        $query = " INSERT INTO funcionarios (nome,email,nivel,id_cinema,senha) VALUES (:nome,:email,:nivel,:cinema,:senha)";
        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":nome",$this->nome);
        $stmt->bindParam(":email",$this->email);
        $stmt->bindParam(":nivel",$this->nivel);
        $stmt->bindParam(":senha",$this->senha);
        $stmt->bindParam(":cinema",$this->id_cinema);
        $stmt->execute();

        if($stmt->rowCount()>0){
            return true;
        }
        return false;

    }
    public function update()
    {
        $query = " UPDATE funcionarios SET nome=:nome,email=:email,nivel=:nivel,id_cinema=:cinema,senha=:senha 
                    WHERE id_funcionario = :id";
        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":nome",$this->nome);
        $stmt->bindParam(":email",$this->email);
        $stmt->bindParam(":nivel",$this->nivel);
        $stmt->bindParam(":senha",$this->senha);
        $stmt->bindParam(":cinema",$this->id_cinema);
        $stmt->bindParam(":id",$this->id);
        $stmt->execute();

        if($stmt->rowCount()>0){
            return true;
        }
        return false;

    }

    public function destroy($id)
    {
        $query = "DELETE FROM funcionarios WHERE ID_FUNCIONARIO = :id ";
        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return true;
        }
        return false;
    }
    public function loadByEmail($email)
    {
        //return $this->readOne("SELECT * FROM funcionarios WHERE email = :email",['email'=>$email]);
        $query = "SELECT * FROM funcionarios WHERE email = :email";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":email",$email);
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        
        }else{

            return null;
        
        }
    }

    public function update_perfil()
    {
        $query = "UPDATE funcionarios SET nome = :nome, email = :email WHERE id_funcionario = :id";

        $stmt = Conexao::getInstance()->prepare($query);

        $stmt->bindParam(":id",$this->id);
        $stmt->bindParam(":nome",$this->nome);
        $stmt->bindParam(":email",$this->email);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }
    }
    
    public function change_password()
    {
        $query = "UPDATE funcionarios SET senha = :senha WHERE id_funcionario = :id";

        $stmt = Conexao::getInstance()->prepare($query);

        $stmt->bindParam(":id",$this->id);
        $stmt->bindParam(":senha",$this->senha);
        $stmt->execute();
        if($stmt->rowCount()>=1){
            return true;
        }else{
            return false;
        }
    }


    
    

}
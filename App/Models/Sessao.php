<?php
namespace App\Models;
use App\Utils\Conexao;
class Sessao extends Model{
    
    private $id;
    private $sala;
    private $filme;
    private $data;
    private $preco;
    

    public function setId($id)
    {
        $this->id = $id;
    }   
    public function getId()
    {
        return $this->id;
    }

    public function setSala($sala)
    {
        $this->sala = $sala;
    }
    public function getSala()
    {
        return $this->sala;
    }
    
    public function setFilme($movie)
    {
        $this->filme = $movie;
    }
    public function getFilme()
    {
        return $this->filme;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
    public function setPreco($preco)
    {
        $this->preco = $preco;
    }
    public function getPreco()
    {
        return $this->preco;
    }

    public function lugares()
    {
        $query = "SELECT LD.id_disponivel,LD.estado,L.numero FROM LUGARES_DISPONIVEIS LD
                    INNER JOIN lugares L ON (LD.id_lugar = L.id_lugar)
                    WHERE LD.ID_SESSAO = :id_sessao";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_sessao",$this->id);
        $stmt->execute();
        if($stmt->rowCount()>0){

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        }else{

            return [];
        
        }
    }
    
    public function save()
    {
        $transaction = Conexao::getInstance();
        $transaction->beginTransaction();

        
        $id_sessao = null;
        if(($id_sessao =  $this->addSession()))
        {
            $lugares = (new Cinema)->get_lugares($this->sala);
                foreach($lugares as $lugar)
                {
                    if( ($this->disponibiliza_lugar($lugar['id_lugar'],$id_sessao))==false )
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

    public function addSession()
    {
        $query = "INSERT INTO SESSOES(id_sala,id_filme,horario,preco) VALUES(:id_sala,:id_filme,:horario,:preco);";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_sala",$this->sala);
        $stmt->bindParam(":id_filme",$this->filme);
        $stmt->bindParam(":horario",$this->data);
        $stmt->bindParam(":preco",$this->preco);
        
        $stmt->execute();
        if($stmt->rowCount()>=1){
           return Conexao::getInstance()->lastInsertId();
        }else{
            return false;
        }
    }
    public function disponibiliza_lugar($id_lugar,$id_sessao)
    {
        $query = "INSERT INTO lugares_disponiveis  VALUES(null,:id_lugar,:id_sessao,0);";

                    $stmt = Conexao::getInstance()->prepare($query);
                    $stmt->bindParam(":id_lugar",$id_lugar);
                    $stmt->bindParam(":id_sessao",$id_sessao);
                    $stmt->execute();
                    if($stmt->rowCount()>0){
                        return true;
                    }
                    else
                    {
                        return false;
                    }
    }
    
    public function all($limit="",$cinema = "all")
    {
            $filterString = ($cinema == "all")?"":" WHERE C.ID_CINEMA = :id_cinema ";
            $limit = (strlen($limit))? "limit ".$limit:"";
            $query = " SELECT SS.ID_SESSAO AS ID, C.nome AS CINEMA,C.ID_CINEMA,F.ID_FILME, F.TITULO,SS.HORARIO as DATA,
                            SS.PRECO, S.numero AS SALA
                            ,(COUNT(LD.ID_DISPONIVEL)-(SELECT COUNT(ID_DISPONIVEL) FROM LUGARES_DISPONIVEIS WHERE ID_SESSAO=SS.ID_SESSAO AND ESTADO=1) ) AS 'LUGARES DISPONIVEIS' 
                            FROM SESSOES SS 
                            INNER JOIN FILMES F ON (SS.id_filme = F.id_filme)
                            INNER JOIN SALAS S ON (S.ID_SALA = SS.ID_SALA)
                            INNER JOIN CINEMAS C ON(C.ID_CINEMA = S.ID_CINEMA)
                            INNER JOIN LUGARES_DISPONIVEIS LD ON (LD.ID_SESSAO = SS.ID_SESSAO) ".$filterString."GROUP BY C.NOME,C.ID_CINEMA,SS.ID_SESSAO,S.NUMERO,F.ID_FILME,F.TITULO,SS.PRECO,SS.HORARIO
                            ORDER BY SS.ID_SESSAO DESC ".$limit;
                   
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
    public function Validate($id_sala,$data,$hora,$duracao)
    {
        $query = " SELECT DISTINCT SS.ID_SESSAO AS ID, C.nome AS CINEMA,F.titulo,SS.HORARIO as INICIO,
        DATE_ADD(SS.HORARIO,INTERVAL F.duracao MINUTE) as FIM
        FROM SESSOES SS 
        INNER JOIN FILMES F ON (SS.id_filme = F.id_filme)
        INNER JOIN SALAS S ON (S.ID_SALA = SS.ID_SALA)
        INNER JOIN CINEMAS C ON(C.ID_CINEMA = S.ID_CINEMA)
        INNER JOIN LUGARES_DISPONIVEIS LD ON (LD.ID_SESSAO = SS.ID_SESSAO)
        WHERE (  :data  between SS.HORARIO AND (  DATE_ADD(SS.HORARIO,INTERVAL F.duracao MINUTE)  ) OR
                    (SS.HORARIO between (:data) AND (DATE_ADD(:data,INTERVAL :duracao MINUTE))  ) )
        AND SS.ID_SALA = :id_sala
        ORDER BY SS.ID_SESSAO DESC ";
        $data = ($data." ".$hora);
        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_sala",$id_sala);
        $stmt->bindParam(":data",($data));
        $stmt->bindParam(":duracao",$duracao);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            return [];
        }    
    
    }

}
<?php
namespace App\Models;

use App\Utils\Conexao;

class Filme extends Model{

    static $table = "filmes";
    
    private $id_filme;

    private $titulo;

    private $genero;

    private $classificacao;

    private $ano;

    private $descricao;

    private $capa_url;

    private $duracao;

    public function setId($id)
    {
        $this->id_filme = $id;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function setGenero($genero)
    {
        $this->genero = $genero;
    }
    public function setClassficacao($classificacao)
    {
        $this->classificacao = $classificacao;
    }
    public function setAno($ano)
    {
        $this->ano = $ano;
    }
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    public function setDuracao($duracao)
    {
        $this->duracao = $duracao;
    }

    public function getId()
    {
        return $this->id_filme;
    }
    public function getGenero()
    {
        return $this->genero;
    }
    public function getClassificacao()
    {
        return $this->classificacao;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getAno()
    {
        return $this->ano;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
    public function getDuracao()
    {
        return $this->duracao;
    }
    public function getCapa()
    {
        return $this->capa_url;
    }
    public function setCapa($capa)
    {
        $this->capa_url = $capa;
    }

    // Em select's normais, não coloque 'ponto e vírgula' (;)
    public function all($limit="")
    {
        $limit = (strlen($limit))? "limit ".$limit:"";

        $query = "SELECT * FROM FILMES ORDER BY id_filme DESC ".$limit;

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->execute();
        if($stmt->rowCount()>0){

            return $stmt->fetchAll(\PDO::FETCH_CLASS,Filme::class);
        
        }else{

            return [];
        
        }

    }
   

    public function find($id)
    {
        //return $this->readOne("SELECT * FROM filmes WHERE id_filme = :id_filme",[':id_filme'=>$id]);
        $query = "SELECT * FROM filmes WHERE id_filme = :id_filme ";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_filme",$id);
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return $stmt->fetchObject(Filme::class);
        
        }else{

            return null;
        
        }

        
    }

    public function loadByYear($email)
    {
        return $this->readOne("SELECT * FROM filmes WHERE ano = :ano",['ano'=>2020]);
    }


    public function save()
    {
        $query = "INSERT INTO filmes(titulo,genero,classificacao,ano,descricao,capa_url,duracao) VALUES(:titulo,:genero,:classificacao,
        :ano,:descricao,:capa,:duracao)";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":titulo",$this->titulo);
        $stmt->bindParam(":genero",$this->genero);
        $stmt->bindParam(":classificacao",$this->classificacao);
        $stmt->bindParam(":ano",$this->ano);
        $stmt->bindParam(":descricao",$this->descricao);
        $stmt->bindParam(":capa",$this->capa_url);
        $stmt->bindParam(":duracao",$this->duracao);
        
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return true;
        
        }else{
            return false;
        }
    }


    public function getEmExibicao($limit="")
    {
        $limit = (strlen($limit))? "limit ".$limit:"";

        $query = "
        SELECT DISTINCT F.id_filme,F.titulo,F.genero,F.classificacao,F.genero,F.descricao,F.ano,F.capa_url FROM SESSOES S 
        INNER JOIN FILMES F ON (S.id_filme = F.id_filme)
        AND SYSDATE() <=  S.horario
        ORDER BY id_filme DESC ".$limit;

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->execute();
        if($stmt->rowCount()>0){

            return $stmt->fetchAll(\PDO::FETCH_CLASS,Filme::class);
        
        }else{

            return [];
        
        }

    }
    public function update()
    {
        $query = "UPDATE filmes SET titulo = :titulo,genero = :genero, classificacao = :classificacao,
        ano = :ano, descricao = :descricao,capa_url = :capa, duracao = :duracao WHERE id_filme = :id_filme";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":titulo",$this->titulo);
        $stmt->bindParam(":genero",$this->genero);
        $stmt->bindParam(":classificacao",$this->classificacao);
        $stmt->bindParam(":ano",$this->ano);
        $stmt->bindParam(":descricao",$this->descricao);
        $stmt->bindParam(":capa",$this->capa_url);
        $stmt->bindParam(":duracao",$this->duracao);
        $stmt->bindParam(":id_filme",$this->id_filme);
        
        $stmt->execute();
        if($stmt->rowCount()>=1){

            return true;
        
        }else{
            return false;
        }
    }
    public function filter($limit,$filters = [])
    {
        $filterString = "";
        foreach ($filters as $key=>$value) {
            if($value=="All"){
                $filters[$key] = "%%";
            }else{
                $filters[$key] = "%{$filters[$key]}%";
            }
            
            $filterString .= " AND ".$key." LIKE :".$key." ";
        }
        // var_dump($filters);
        // var_dump($filterString);
        // exit; 
        /*$movies = [];
        if($limit == 0){
            $array = array_merge($filters,[]);
            return $this->read("
            SELECT DISTINCT F.id_filme,F.titulo,F.genero,F.classificacao,F.descricao,F.ano,F.capa_url 
            FROM SESSOES S INNER JOIN FILMES F ON (S.id_filme = F.id_filme)
            WHERE (to_date(to_char(S.horario,'YYYY-MM-DD'),'YYYY-MM-DD') - to_date(to_char(sysdate,'YYYY-MM-DD'),'YYYY-MM-DD')) between 0 AND 7
             ".$filterString." ",$array );
        }else{
            $array = array_merge($filters,["ofset"=>$offset,"limit"=>$limit]);
            
            return $this->read("
            SELECT * FROM 
            (
                SELECT a.*,ROWNUM rn FROM 
                    (
                    
                        SELECT DISTINCT F.id_filme,F.titulo,F.genero,F.classificacao,F.descricao,F.ano,F.capa_url 
                        FROM SESSOES S INNER JOIN FILMES F ON (S.id_filme = F.id_filme)
                        WHERE (to_date(to_char(S.horario,'YYYY-MM-DD'),'YYYY-MM-DD') - to_date(to_char(sysdate,'YYYY-MM-DD'),'YYYY-MM-DD')) between 0 AND 7
                        ".$filterString."     
                    ) a WHERE ROWNUM <= :ofset+:limit
            )WHERE rn >:ofset ",($array));
        }*/
        $limit = (strlen($limit))? "limit ".$limit:"";

        $query = "
        SELECT DISTINCT F.id_filme,F.titulo,F.genero,F.classificacao,F.genero,F.descricao,F.ano,F.capa_url FROM SESSOES S 
        INNER JOIN FILMES F ON (S.id_filme = F.id_filme) 
        AND SYSDATE() <=  S.horario
        WHERE 1=1 ".$filterString." ORDER BY id_filme DESC ".$limit;
        
        $stmt = Conexao::getInstance()->prepare($query);
        foreach($filters as $key=>$value)
        {
            $stmt->bindParam("{$key}",$filters[$key]);
        }
        $stmt->execute();
        if($stmt->rowCount()>0){

            return $stmt->fetchAll(\PDO::FETCH_CLASS,Filme::class);
        
        }else{

            return [];
        
        }
    }
   
    
    public function getSessoes($id)
    {
        
        $query = "SELECT SS.ID_SESSAO AS ID, C.nome AS CINEMA, F.titulo,SS.HORARIO as DATA,
        SS.PRECO, S.numero AS SALA,
        (COUNT(LD.ID_DISPONIVEL)-(SELECT COUNT(ID_DISPONIVEL) FROM LUGARES_DISPONIVEIS WHERE ID_SESSAO=SS.ID_SESSAO AND ESTADO=1) ) AS \"LUGARES DISPONIVEIS\" 
        FROM SESSOES SS 
        INNER JOIN FILMES F ON (SS.id_filme = F.id_filme)
        INNER JOIN SALAS S ON (S.ID_SALA = SS.ID_SALA)
        INNER JOIN CINEMAS C ON(C.ID_CINEMA = S.ID_CINEMA)
        INNER JOIN LUGARES L ON(L.ID_SALA = S.ID_SALA)
        INNER JOIN LUGARES_DISPONIVEIS LD ON(LD.ID_LUGAR = L.ID_LUGAR)
        WHERE SS.ID_FILME = :id_filme
        AND LD.ID_SESSAO = SS.ID_SESSAO
        GROUP BY C.NOME,SS.ID_SESSAO,S.NUMERO,F.TITULO,SS.PRECO,SS.HORARIO
        /*AND(to_date(to_char(SS.horario,'YYYY-MM-DD'),'YYYY-MM-DD') - to_date(to_char(sysdate,'YYYY-MM-DD'),'YYYY-MM-DD')) between 0 AND 7 */";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_filme",$id);
        $stmt->execute();
        if($stmt->rowCount()>0){

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        }else{

            return [];
        
        }

    }
    public function getCinemasComSessoes($id)
    {
        $query = "SELECT DISTINCT C.ID_CINEMA AS ID, C.nome AS CINEMA 
        FROM SESSOES SS
        INNER JOIN SALAS S ON (SS.ID_SALA = S.ID_SALA) 
        INNER JOIN CINEMAS C ON(C.ID_CINEMA = S.ID_CINEMA)
        WHERE SS.ID_FILME = :id_filme
        AND SYSDATE() <=  SS.horario";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_filme",$id);
        $stmt->execute();
        if($stmt->rowCount()>0){

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        }else{

            return [];
        
        }

    }
    public function getSessoesNoCinema($idFilme,$idCinema)
    {
        $query = "SELECT SS.ID_SESSAO AS ID, F.titulo, (SS.HORARIO) as DATA,
        (SS.HORARIO) as HORA, SS.PRECO, S.numero AS SALA,
        (COUNT(LD.ID_DISPONIVEL)-(SELECT COUNT(ID_DISPONIVEL) FROM LUGARES_DISPONIVEIS WHERE ID_SESSAO=SS.ID_SESSAO AND ESTADO=1) ) AS 'LUGARES_DISPONIVEIS' 
        FROM SESSOES SS 
        INNER JOIN FILMES F ON (SS.id_filme = F.id_filme)
        INNER JOIN SALAS S ON (S.ID_SALA = SS.ID_SALA)
        INNER JOIN CINEMAS C ON(C.ID_CINEMA = S.ID_CINEMA)
        INNER JOIN LUGARES L ON(L.ID_SALA = S.ID_SALA)
        INNER JOIN LUGARES_DISPONIVEIS LD ON(LD.ID_LUGAR = L.ID_LUGAR)
        WHERE SS.ID_FILME = :id_filme
        AND LD.ID_SESSAO = SS.ID_SESSAO
        AND C.ID_CINEMA = :id_cinema
        AND SYSDATE() <=  SS.horario
        GROUP BY C.NOME,SS.ID_SESSAO,S.NUMERO,F.TITULO,SS.PRECO,SS.HORARIO;";

        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindParam(":id_filme",$idFilme);
        $stmt->bindParam(":id_cinema",$idCinema);
        $stmt->execute();
        if($stmt->rowCount()>=1){
                        
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
                                
        }else{
            return [];
        }

    }
    
    public function getSessoesDisponiveis($id)
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

}
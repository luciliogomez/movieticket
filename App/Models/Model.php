<?php
namespace App\Models;
use App\Utils\Conexao;

class Model{

 
    public function readOne($query,$params = [])
    {
        $withCursor = strstr($query,':cursor');
        $stmt = oci_parse(Conexao::getInstance(),$query);
        $cursor = oci_new_cursor(Conexao::getInstance());        
        
        if($withCursor){
            oci_bind_by_name($stmt,":cursor",$cursor,-1,OCI_B_CURSOR);
        }
        foreach($params as $key=>$value)
        {
            oci_bind_by_name($stmt,$key,$params[$key]);
        }
        $r = ociexecute($stmt);
        oci_execute($cursor);

        $row =$withCursor? oci_fetch_assoc(($cursor)) : oci_fetch_array($stmt,OCI_RETURN_NULLS+OCI_ASSOC);
        
        oci_close(Conexao::getInstance());
        return $row;
    }
    
    public function read($query,$params = [])
    {
        // var_dump($query);
        // exit;
        $withCursor = strstr($query,':cursor');
        $stmt = oci_parse(Conexao::getInstance(),$query);
        $cursor = oci_new_cursor(Conexao::getInstance());        
        
        if($withCursor){
            oci_bind_by_name($stmt,":cursor",$cursor,-1,OCI_B_CURSOR);
        }
        foreach($params as $key=>$value)
        {
            if(strstr($query,$key))
            {
                oci_bind_by_name($stmt,":".$key,$params[$key]);
            }
        }
        $r = ociexecute($stmt);
        oci_execute($cursor);
        $rows = [];
        while($row =$withCursor? oci_fetch_assoc(($cursor)) : oci_fetch_array($stmt,OCI_RETURN_NULLS+OCI_ASSOC))
        {    
            $rows[] = $row;    
        }
        oci_close(Conexao::getInstance());
        return $rows;
    }

    public function persist($query,$params = [])
    {
        $stmt = oci_parse(Conexao::getInstance(),$query);
        foreach($params as $key=>$value)
        {
            oci_bind_by_name($stmt,$key,$params[$key]);
        }
        $r = ociexecute($stmt);
        $affected_rows = oci_num_rows($stmt);
        oci_close(Conexao::getInstance());
        return $affected_rows;
    }
    
}
<?php


    function first($text)
    {
        $pieces = explode(" ",$text);
        return $pieces[0] ?? "";
    }
    function last($text)
    {
        $pieces = explode(" ",$text);
        return end($pieces) ?? "";
    }

    function choose_reserva_status($status)
    {
        switch($status)
        {
            case '1':
                return "Confirmado";
            case '0':
                return "Pendente";
            case '-1':
                return "Cancelado";
            default :
                return "Indefinido";
        }
    }

    function choose_place_status($status)
    {
        switch($status)
        {
            case '1':
                return "Ocupado";
            case '0':
                return "Livre";
            default :
                return "Indefinido";
        }
    }

    function reduce_string($string,$size)
    {
        return substr($string,0,$size)."...";
    }
    
?>
<?php

require_once "site.class.php";

class Loja extends Site
{

    function dadosLoja($id_loja){
        $sql = "select * from lojas where id = '$id_loja'";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }

    function updateDadosLoja(){

    }

}
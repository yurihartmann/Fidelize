<?php

require_once "site.php";

class Tokens extends Site {


    function tokensPorIdCliente(){
        // retona o nome do cupom e o token
        $id = $_SESSION["cliente_id"];

        $sql = "select *, l.nome as nome_loja, cF.id as id_cartao from tokens 
                inner join cartaoFidelidade cF on tokens.fk_carimbo = cF.id 
                inner join lojas l on cF.fk_loja = l.id
                where fk_cliente = '$id' order by usado";

 		$query = mysqli_query($this->conexao, $sql);
        	if ($query)
            	return mysqli_fetch_all($query, MYSQLI_ASSOC);
        	else
            	return false;
    }


    function numTokensDisponiveis(){
        $numero =  $_SESSION['cliente_id'];

        $sql = "select count(*) as num from tokens where fk_cliente = '$numero' and usado = '0'";
        $query = mysqli_query($this->conexao,$sql);
        $result = mysqli_fetch_assoc($query);

        return $result['num'];
    }

}

?>
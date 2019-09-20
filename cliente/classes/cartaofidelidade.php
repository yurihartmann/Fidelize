<?php

require_once "site.php";

class cartaofidelidade extends Site
{

    function descubra()
    {
        $num_cliente = $_SESSION["cliente_id"];

        $sql = "select
                cF.*, l.nome, l.id as id_loja,
                (select count(*) from registro_cartaoFidelidade where registro_cartaoFidelidade.fk_cliente = '$num_cliente' and fk_carimbo = cF.id ) as total_registro
                from cartaoFidelidade cF
                inner join lojas l on cF.fk_loja = l.id
                having total_registro = 0 and data_inicio < now() and data_fim > now()
                order by cF.fk_destaque desc limit 1,15";
        $query = mysqli_query($this->conexao, $sql);

        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }

    function todosCartoesPorLoja($id_loja)
    {
        // RETORNA TODOS OS CARTOES RELACIONADO COM O ID DA LOJA
        $sql = "select * from cartaoFidelidade where fk_loja like '$id_loja'";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }

    function getDestaqueCartao($id_cartao){
        $sql = "select d.nome_destaque as nome from cartaoFidelidade cF
                inner join destaque d on cF.fk_destaque = d.id
                where cF.id = '$id_cartao'";
        $query = mysqli_query($this->conexao, $sql);
        if ($query){
            $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
            return $result[0]['nome'];
        }
        else
            return "false";
    }

}
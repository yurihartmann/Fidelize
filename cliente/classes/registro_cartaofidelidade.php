<?php

require_once 'site.php';

class registro_cartaofidelidade extends Site
{

    function buscarCartoesPorIdCliente($id_cliente)
    {
        // retorna o nome do cliente, nome do cupom, andamento, objetivo.
        $sql = "select *, count(fk_cliente), l.nome as nome_loja, l.id as id_loja, cF.id as id_cartao from registro_cartaoFidelidade
                inner join cartaoFidelidade cF on registro_cartaoFidelidade.fk_carimbo = cF.id
                inner join lojas l on cF.fk_loja = l.id
                inner join clientes c on registro_cartaoFidelidade.fk_cliente = c.numero
                where fk_cliente = '$id_cliente'  group by fk_carimbo";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }

    function quantiaEconomizadaPorIdCliente()
    {
        $id_cliente = $_SESSION['cliente_id'];
        $sql = "select *, count(fk_cliente), l.nome as nome_loja from registro_cartaoFidelidade
                inner join cartaoFidelidade cF on registro_cartaoFidelidade.fk_carimbo = cF.id
                inner join lojas l on cF.fk_loja = l.id
                inner join clientes c on registro_cartaoFidelidade.fk_cliente = c.numero
                where fk_cliente = '$id_cliente'  group by fk_carimbo";
        $query = mysqli_query($this->conexao, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $total = 0;
        foreach ($result as $chave => $valor):
            if ($valor['count(fk_cliente)'] == $valor['objetivo']) {
                $total += $valor['valor'];
            }
        endforeach;
            return $total;
    }

    function quantiaAindaParaEconomizar(){
        $id_cliente = $_SESSION['cliente_id'];
        $ja_economizado = $this->quantiaEconomizadaPorIdCliente();
        $sql = "select * from registro_cartaoFidelidade
                inner join cartaoFidelidade cF on registro_cartaoFidelidade.fk_carimbo = cF.id
                inner join lojas l on cF.fk_loja = l.id
                inner join clientes c on registro_cartaoFidelidade.fk_cliente = c.numero
                where fk_cliente = '$id_cliente'  group by fk_carimbo";
        $query = mysqli_query($this->conexao, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $total = 0;
        foreach ($result as $chave => $valor):
                $total += $valor['valor'];
        endforeach;
        return $total - $ja_economizado;
    }

}
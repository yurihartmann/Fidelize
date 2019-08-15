<?php

require_once "site.class.php";

class registro_cartaoFidelidade extends Site
{

    private $numero;
    private $cliente;
    private $carimbo;
    private $andamento;


    public function clientesPorLoja($id_loja)
    {
        $sql = "select * from registro_cartaoFidelidade
                inner join cartaoFidelidade cF on registro_cartaoFidelidade.fk_carimbo = cF.id
                inner join lojas l on cF.fk_loja = l.id
                inner join clientes c on registro_cartaoFidelidade.fk_cliente = c.numero
                where l.id = 1";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }

    public function clientesPorLojaLimit10($id_loja)
    {
        $sql = "select * from registro_cartaoFidelidade
                inner join cartaoFidelidade cF on registro_cartaoFidelidade.fk_carimbo = cF.id
                inner join lojas l on cF.fk_loja = l.id
                inner join clientes c on registro_cartaoFidelidade.fk_cliente = c.numero
                where l.id = 1";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }


    public function getNumero()
    {
        return $this->numero;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function getCarimbo()
    {
        return $this->carimbo;
    }

    public function getAndamento()
    {
        return $this->andamento;
    }

}
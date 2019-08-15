<?php

require_once "site.class.php";

class registro_cartaoFidelidade extends Site
{

    private $numero;
    private $cliente;
    private $carimbo;
    private $andamento;


    function __construct()
    {
        parent::__construct();
        if (isset($_POST['btnSalvarCarimbo']))
            $this->salvarCarimbo();
    }


    public function clientesPorLoja($id_loja)
    {
        $sql = "select *, count(fk_cliente) from registro_cartaoFidelidade
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
        $sql = "select *, count(fk_cliente) from registro_cartaoFidelidade
                inner join cartaoFidelidade cF on registro_cartaoFidelidade.fk_carimbo = cF.id
                inner join lojas l on cF.fk_loja = l.id
                inner join clientes c on registro_cartaoFidelidade.fk_cliente = c.numero
                where l.id = 1 limit 10";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }

    function todosCartoesPorLoja($id_loja)
    {
        $cartao = new cartaoFidelidade();
        return $cartao->todosCartoesPorLoja($id_loja);
    }

    function salvarCarimbo()
    {

        $numero = $_POST['number'];
        $id_cupom = $_POST['cupom'];
        $this->verificaSeCompletouCupom($numero, $id_cupom);

        $sql = "select * from clientes where numero = '$numero'";
        $result = mysqli_fetch_all(mysqli_query($this->conexao, $sql));
        if (count($result) == 1) {
            if ($this->verificaSeJaCompletou($numero, $id_cupom)) {
                setAlerta('danger', 'Esse usuario ja completou esse cupom!');
                header("Location: registro_carimbos.php");
            } else {
                $sql = "INSERT INTO registro_cartaoFidelidade (id, fk_cliente, fk_carimbo, data_registro) 
                    VALUES (NULL, '$numero', '$id_cupom', CURRENT_DATE());";
                $query = mysqli_query($this->conexao, $sql);
                if ($query) {

                } else {
                    setAlerta('danger', 'Algo deu errado, tente novamente!');
                    header("Location: registro_carimbos.php");
                }
            }
        } else {
            setAlerta("danger", "Numero nao e um usuario do sistema!");
            header("Location: novo_carimbo.php");
        }
    }

    function verificaSeCompletouCupom($number_cliente, $id_cupom)
    {
        $sql = "select count(*), cF.objetivo from registro_cartaoFidelidade
                inner join cartaoFidelidade cF on registro_cartaoFidelidade.fk_carimbo = cF.id
                where fk_cliente = '$number_cliente' and fk_carimbo = '$id_cupom';";
        die($sql);
        $query = mysqli_query($this->conexao, $sql);
        die($query);

    }

    function verificaSeJaCompletou($number_cliente, $id_cupom)
    {
        $sql = "select count(*), cF.objetivo from registro_cartaoFidelidade
                inner join cartaoFidelidade cF on registro_cartaoFidelidade.fk_carimbo = cF.id
                where fk_cliente = '$number_cliente' and fk_carimbo = $id_cupom;";
        $query = mysqli_query($this->conexao, $sql);
        die($query);
        if ($result['count(*)'] == $result['objetivo']) {
            return true;
        } else {
            return false;
        }
    }

}
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

        // BOTAO CARIMBAR
        if (isset($_POST['formSalvarCarimbo']))
            $this->salvarCarimbo();
    }


    public function clientesPorLoja($id_loja)
    {
        // CONTA E TRAZ OS DADOS DO CARTAO FIDELIDADE E DO CLIENTE EM QUESTAO, CONTANDO O NUMERO DE CARIMBOS JA RESGISTRADOS
        $sql = "select *, count(fk_cliente) from registro_cartaoFidelidade
                inner join cartaoFidelidade cF on registro_cartaoFidelidade.fk_carimbo = cF.id
                inner join lojas l on cF.fk_loja = l.id
                inner join clientes c on registro_cartaoFidelidade.fk_cliente = c.numero
                where l.id = '$id_loja' group by fk_carimbo";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }

    public function clientesPorLojaLimit10($id_loja)
    {
        // CONTA E TRAZ OS DADOS DO CARTAO FIDELIDADE E DO CLIENTE EM QUESTAO, CONTANDO O NUMERO DE CARIMBOS JA RESGISTRADOS COM LIMITE DE 10
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
        // PEGA OS CARTOES QUE A LOJA POSSUE
        $cartao = new cartaoFidelidade();
        return $cartao->todosCartoesPorLoja($id_loja);
    }

    function salvarCarimbo()
    {
        // SALVA UM NOVO CARIMBO
        $numero = $_POST['number'];
        die(var_dump($numero));
        $id_cupom = $_POST['cupom'];

        $sql = "select * from clientes where numero = '$numero'";
        $result = mysqli_fetch_all(mysqli_query($this->conexao, $sql));
        if (count($result) == 1) {
            if ($this->verificaSeCompletouCupom($numero, $id_cupom)) {
                setAlerta('danger', 'Esse usuario ja completou esse cupom!');
                header("Location: registro_carimbos.php");
            } else {
                $sql = "INSERT INTO registro_cartaoFidelidade (id, fk_cliente, fk_carimbo, data_registro) 
                    VALUES (NULL, '$numero', '$id_cupom', CURRENT_TIME());";
                $query = mysqli_query($this->conexao, $sql);
                if ($query) {
                    if ($this->verificaSeCompletouCupom($numero, $id_cupom)) {
                        $token = new Tokens();
                        $token->createToken($numero,$id_cupom);
                        setAlerta('success', 'Completou cupom, token gerado!');
                        header("Location: registro_carimbos.php");
                    } else {
                        setAlerta('success', 'Carimbo registrado!');
                        header("Location: registro_carimbos.php");
                    }
                } else {
                    setAlerta('danger', 'Algo deu errado, tente novamente!');
                    header("Location: novo_carimbo.php");
                }
            }
        } else {
            setAlerta('danger', 'Numero nao e um usuario do sistema!');
            header("Location: novo_carimbo.php");
        }
    }

    function verificaSeCompletouCupom($number_cliente, $id_cupom)
    {
        // VERIFICA SE O CUPOM JA FOI COMPLETADO PELO USUARIO EM QUESTAO
        $sql = "select count(*) as num, cF.objetivo from registro_cartaoFidelidade
                inner join cartaoFidelidade cF on registro_cartaoFidelidade.fk_carimbo = cF.id
                where fk_cliente = '$number_cliente' and fk_carimbo = '$id_cupom'";
        $query = mysqli_query($this->conexao, $sql);
        $result = mysqli_fetch_assoc($query);
        if ($result['num'] >= $result['objetivo']) {
            return true;
        } else {
            return false;
        }

    }


}
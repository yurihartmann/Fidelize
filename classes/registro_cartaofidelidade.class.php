<?php

require_once "site.class.php";

use Aws\Sns\SnsClient;

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
        if (substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, -4) != 'dashboard') {
            $registros = new cartaoFidelidade();
            $registros = $registros->todosCartoesPorLoja($_SESSION['empresa_id']);
            if (empty($registros)) {
                setAlerta('warning', 'Você não posse nenhum cupom, primeiro cadastre um!');
                header('Location: cupons_ativos.php');
            }
        }
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

    public function clientePorLoja($id_loja, $numero)
    {
        // CONTA E TRAZ OS DADOS DO CARTAO FIDELIDADE E DO CLIENTE EM QUESTAO, CONTANDO O NUMERO DE CARIMBOS JA RESGISTRADOS
        $sql = "select *, count(fk_cliente) from registro_cartaoFidelidade
                inner join cartaoFidelidade cF on registro_cartaoFidelidade.fk_carimbo = cF.id
                inner join lojas l on cF.fk_loja = l.id
                inner join clientes c on registro_cartaoFidelidade.fk_cliente = c.numero
                where l.id = '$id_loja' and fk_cliente = '$numero' group by fk_carimbo";
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
                where l.id = '$id_loja' group by fk_carimbo limit 10";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }

    function todosCartoesPorLoja($id_loja)
    {
        $sql = "select * from cartaoFidelidade where fk_loja = '$id_loja'
                and data_inicio < now() and data_fim > now() ";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return "";

    }

    function salvarCarimbo()
    {
        // SALVA UM NOVO CARIMBO
        $numero = $_POST['number'];
        $numero = str_replace('(', '', $numero);
        $numero = str_replace(')', '', $numero);
        $numero = str_replace(' ', '', $numero);
        $numero = str_replace('-', '', $numero);
        $id_cupom = $_POST['cupom'];

        $sql = "select * from clientes where numero = '$numero'";
        $result = mysqli_fetch_all(mysqli_query($this->conexao, $sql));
        if (count($result) == 1) {
            if ($this->verificaSeCompletouCupom($numero, $id_cupom)) {
                setAlerta('danger', 'Esse usuário já completou esse cupom!');
                header("Location: registro_carimbos.php");
            } else {
                $sql = "INSERT INTO registro_cartaoFidelidade (id, fk_cliente, fk_carimbo, data_registro) 
                    VALUES (NULL, '$numero', '$id_cupom', CURRENT_TIME());";
                $query = mysqli_query($this->conexao, $sql);
                if ($query) {
                    $dados = $this->clientePorLoja($_SESSION['empresa_id'],$numero);
                    if ($dados[0]["count(fk_cliente)"] == 1){
                        $this->sendSMS($numero,"Parabéns, Você completou 1/".$dados[0]['objetivo']. " do cupom: "
                        . ucfirst($dados[0]['nome_cartao']). " - Acesse cliente.fidelize.ga para ver seu progreso!");
                    }
                    if ($this->verificaSeCompletouCupom($numero, $id_cupom)) {
                        $token = new Tokens();
                        $token->createToken($numero, $id_cupom);
                        $this->sendSMS($numero,"Parabéns, Você completou o cupom: "
                            . ucfirst($dados[0]['nome_cartao']). " e ganhou: ". ucfirst($dados[0]['premio']) ." - Acesse cliente.fidelize.ga para ver seu token!");
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
            setAlerta('danger', 'Número não é um usuário do sistema!');
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

    function sendSMS($number, $msg)
    {
        require 'vendor/autoload.php';

        $sdk = new Aws\Sns\SnsClient(['region' => 'eu-west-1',
            'version' => 'latest',
            'credentials' => ['key' => 'AKIA2ZZM2LL4FW3JSEQ2', 'secret' => '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']]);


        try {
            $result = $sdk->SetSMSAttributes(['attributes' => ['DefaultSMSType' => 'Transactional',],]);
        } catch
        (AwsException $e) {
            // output error message if fails
            error_log($e->getMessage());
        }


        $sql = "insert into sms_enviados value (null,'$number','$msg',current_time ())";
        $query = mysqli_query($this->conexao, $sql);

        $msg = "FIDELIZE: " . $msg;
        $number = "+55" . $number;


        $result = $sdk->publish([
            'Message' => $msg,
            'PhoneNumber' => $number,
        ]);

    }


}
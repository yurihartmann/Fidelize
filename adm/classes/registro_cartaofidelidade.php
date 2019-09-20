<?php

require_once "site.class.php";

class registro_cartaofidelidade extends Site
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
            $registros = new cartaofidelidade();
            $registros = $registros->todosCartoesPorLoja();
            if (empty($registros)) {
                setAlerta('warning', 'Você não posse nenhum cartão, primeiro cadastre um!');
                header('Location: cartoes.php');
            }
        }
    }


    public function clientesPorLoja()
    {
        $id_loja = $_SESSION['empresa_id'];
        // CONTA E TRAZ OS DADOS DO CARTAO FIDELIDADE E DO CLIENTE EM QUESTAO, CONTANDO O NUMERO DE CARIMBOS JA RESGISTRADOS
        $sql = "select *, count(fk_cliente) from registro_cartaoFidelidade
                inner join cartaoFidelidade cF on registro_cartaoFidelidade.fk_carimbo = cF.id
                inner join lojas l on cF.fk_loja = l.id
                inner join clientes c on registro_cartaoFidelidade.fk_cliente = c.numero
                where l.id = '$id_loja' group by fk_carimbo, fk_cliente";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }

    public function clientesPorLojaLimit10()
    {
        $id_loja = $_SESSION['empresa_id'];
        // CONTA E TRAZ OS DADOS DO CARTAO FIDELIDADE E DO CLIENTE EM QUESTAO, CONTANDO O NUMERO DE CARIMBOS JA RESGISTRADOS COM LIMITE DE 10
        $sql = "select *, count(fk_cliente) from registro_cartaoFidelidade
                inner join cartaoFidelidade cF on registro_cartaoFidelidade.fk_carimbo = cF.id
                inner join lojas l on cF.fk_loja = l.id
                inner join clientes c on registro_cartaoFidelidade.fk_cliente = c.numero
                where l.id = '$id_loja' group by fk_carimbo, fk_cliente limit 4";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }

    public function clientePorLoja($id_loja, $numero, $id_cupom)
    {
        // CONTA E TRAZ OS DADOS DO CARTAO FIDELIDADE E DO CLIENTE EM QUESTAO, CONTANDO O NUMERO DE CARIMBOS JA RESGISTRADOS
        $sql = "select *, count(fk_cliente) from registro_cartaoFidelidade
                inner join cartaoFidelidade cF on registro_cartaoFidelidade.fk_carimbo = cF.id
                inner join lojas l on cF.fk_loja = l.id
                inner join clientes c on registro_cartaoFidelidade.fk_cliente = c.numero
                where l.id = '$id_loja' and fk_cliente = '$numero' and fk_carimbo = '$id_cupom' group by fk_carimbo, fk_cliente";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }

    public function todosCartoesPorLoja()
    {
        $id_loja = $_SESSION['empresa_id'];
        $sql = "select * from cartaoFidelidade where fk_loja = '$id_loja'
                and data_inicio < now() and data_fim > now() ";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return "";

    }

    public function salvarCarimbo()
    {
        // SALVA UM NOVO CARIMBO
        $numero = limpaMascaraNumero($_POST['number']);
        $id_cupom = $_POST['cupom'];

        $sql = "select * from clientes where numero = '$numero'";
        $result = mysqli_fetch_all(mysqli_query($this->conexao, $sql));
        if (count($result) == 1) {
            if ($this->verificaSeCompletouCupom($numero, $id_cupom)) {
                setAlerta('danger', 'Esse usuário já completou esse cartão!');
                header("Location: registro_carimbos.php");
            } else {
                $sql = "INSERT INTO registro_cartaoFidelidade (id, fk_cliente, fk_carimbo, data_registro) 
                    VALUES (NULL, '$numero', '$id_cupom', CURRENT_TIME());";
                $query = mysqli_query($this->conexao, $sql);
                if ($query) {
                    $dados = $this->clientePorLoja($_SESSION['empresa_id'],$numero,$id_cupom);
                    if ($dados[0]["count(fk_cliente)"] == '1'){
                        sendSMS($numero,"Parabéns, Você inicio um novo cartão - Acesse cliente.fidelize.ga para ver seu progreso!");
                    }
                    if ($this->verificaSeCompletouCupom($numero, $id_cupom)) {
                        $token = new tokens();
                        $token->createToken($numero, $id_cupom);
                        sendSMS($numero,"Parabéns, Você completou um cartão - Acesse cliente.fidelize.ga para ver seu token!");
                        setAlerta('success', 'Completou cartão, token gerado!');
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
            // nao e usuario do sistema
            $senha_aleatoria = hash('md5',mt_rand(10000000,99999999));
            $sql = "INSERT INTO `clientes` (`numero`, `senha`) 
                VALUES ('$numero', '$senha_aleatoria')";
            $query = mysqli_query($this->conexao, $sql);
            if ($query){
                $sql = "INSERT INTO registro_cartaoFidelidade (id, fk_cliente, fk_carimbo, data_registro) 
                    VALUES (NULL, '$numero', '$id_cupom', CURRENT_TIME());";
                $query = mysqli_query($this->conexao, $sql);
                if ($query){
                    sendSMS($numero,"Ola, percebemos que voce nao tem conta, por favor se cadastre para receber os carimbos - http://fidelize.ga/cliente/cadastro.php");
                    setAlerta('success', 'Carimbo registrado! - Usuário temporário criado, peça para o cliente se cadastra o mais breve possível!');
                    header("Location: registro_carimbos.php");
                } else {
                    setAlerta('danger', 'Algo deu errado, tente novamente!');
                    header("Location: novo_carimbo.php");
                }
            } else {
                setAlerta('danger', 'Algo deu errado, tente novamente!');
                header("Location: novo_carimbo.php");
            }
        }
    }

    public function verificaSeCompletouCupom($number_cliente, $id_cupom)
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

    public function desempenhoSemanal(){
        $id_loja = $_SESSION['empresa_id'];
        $sql = "CALL carimbos_7_dias('$id_loja')";
        $query = mysqli_query($this->conexao, $sql);
        if ($query){
            $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
            mysqli_free_result($query);
            return $result;
        }
        else
            return false;
    }

     public function numClientesPorLoja(){
        $id_loja = $_SESSION['empresa_id'];
        $sql = "select count(distinct fk_cliente) as num from registro_cartaoFidelidade
                inner join cartaoFidelidade cF on registro_cartaoFidelidade.fk_carimbo = cF.id 
                inner join lojas l on cF.fk_loja = l.id where l.id = '$id_loja'";
         $query = mysqli_query($this->conexao, $sql);
         $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
         return $result[0]['num'];


     }

}
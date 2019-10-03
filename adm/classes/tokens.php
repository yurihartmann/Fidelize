<?php

require_once "site.php";

class tokens extends Site {

    private $token;

    function __construct()
    {
        parent::__construct();
        if (isset($_POST['formVerificarToken']))
            $this->validarToken();
    }

    function tokensPorIdLoja($id_loja){
        $sql = "select * from tokens
                  inner join cartaoFidelidade cF on tokens.fk_carimbo = cF.id
                  inner join lojas l on cF.fk_loja = l.id
                  inner join clientes c on tokens.fk_cliente = c.numero
                  where cF.fk_loja = '$id_loja'";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }


    function createToken($id_usuario, $id_cupom){
        $this->token = mt_rand(100000,999999);
        while ($this->vericarSeTokenExiste($this->token)){
            $this->token = mt_rand(100000,999999);
        }
        $sql = "INSERT INTO `tokens` (`id`, `fk_cliente`, `fk_carimbo`, `token`, `usado`, `data_usado`) 
                VALUES (NULL, '$id_usuario', '$id_cupom', '$this->token', '0', CURRENT_TIME());";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return $this->token;
        else
            return false;
    }

    function vericarSeTokenExiste($token){
        $sql = "select count(*) from tokens
                where token = '$token'";
        $query = mysqli_query($this->conexao, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        if ($result[0]['count(*)'] == 1)
            return true;
        else
            return false;
    }

    function vericarSeTokenExistePercenteALoja($token,$id_loja){
        $sql = "select count(*) from tokens
inner join cartaoFidelidade cF on tokens.fk_carimbo = cF.id
inner join lojas l on cF.fk_loja = l.id
where token = '$token' and l.id = '$id_loja'";
        $query = mysqli_query($this->conexao, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        if ($result[0]['count(*)'] == 1)
            return true;
        else
            return false;
    }

    function validarToken(){
        $token = $_POST['token'];
        $id_loja = $_SESSION['empresa_id'];
        if ($this->vericarSeTokenExistePercenteALoja($token,$id_loja)){
            if ($this->verificaSeTokenJaFoiUtilizado($token)){
                setAlerta('danger','Esse token já foi utilizado');
                header("Location: validar_token.php");
            } else {
                $sql = "UPDATE `tokens` SET `usado` = '1', data_usado = current_time WHERE token = '$token';";
                $query = mysqli_query($this->conexao, $sql);
                if ($query){
                    $sql = "select * from tokens inner join cartaoFidelidade cF on tokens.fk_carimbo = cF.id
                            where token = '$token'";
                    $query = mysqli_query($this->conexao, $sql);
                    if ($query){
                        $result = mysqli_fetch_assoc($query);
                        $modal['nome_cartao'] = $result['nome_cartao'];
                        $modal['premio'] = $result['premio'];
                        setModal($modal);
//                        setAlerta('success','Tokem Valido- NOME CARTAO = '.$result['nome_cartao']. "PREMIO = " . $result['premio']);
                        header("Location: validar_token.php");

                    } else {
                        setAlerta('danger','Algo deu errado, tente novamente');
                        header("Location: validar_token.php");
                    }
                }else {
                    setAlerta('danger','Algo deu errado, tente novamente');
                    header("Location: validar_token.php");
                }
            }
        } else {
            setAlerta('danger','Esse token nãO existe');
            header("Location: validar_token.php");
        }
    }


    function verificaSeTokenJaFoiUtilizado($token){
        $sql = "select * from tokens where token = '$token'";
        $query = mysqli_query($this->conexao, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        if ($result[0]['usado'] == 1)
            return true;
        else
            return false;
    }

}
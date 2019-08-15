<?php

require_once "site.class.php";

class cartaoFidelidade extends Site{

    private $nome_cartao;
    private $objetivo;
    private $fk_loja;

    function __construct()
    {
        parent::__construct();
        if (isset($_POST['btnExcluir']))
            $this->deleteCartaoFidelidadePorID($_POST['id_cupom']);

        if (isset($_POST['btnSalvar']) && $_POST['id'] == 'novo')
            $this->salvarNovoCupom();
        else if (isset($_POST['btnSalvar']) && $_POST['id'] != 'novo')
            $this->updateCupom();
    }

    function todosCartoesPorLoja($id_loja){
        $sql = "select * from cartaoFidelidade where fk_loja = '$id_loja'";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }



    function deleteCartaoFidelidadePorID($id_cartao){

        $sql = "DELETE FROM registro_cartaoFidelidade where registro_cartaoFidelidade.fk_carimbo = '$id_cartao'";
        $query = mysqli_query($this->conexao, $sql);
        if ($query) {
            $sql = "DELETE FROM tokens where tokens.fk_carimbo = '$id_cartao'";
            $query = mysqli_query($this->conexao, $sql);
            if ($query){
                $sql = "DELETE FROM cartaoFidelidade WHERE cartaoFidelidade.id = '$id_cartao'";
                $query = mysqli_query($this->conexao, $sql);
                if ($query){
                    setAlerta('success', 'Cupom excluido com sucesso!');
                    header("Location: cupons_ativos.php");
                } else {
                    setAlerta('danger', 'Algo deu errado, tente novamente!');
                    header("Location: cupons_ativos.php");
                }
            } else {
                setAlerta('danger', 'Algo deu errado, tente novamente!');
                header("Location: cupons_ativos.php");
            }
        } else {
            setAlerta('danger', 'Algo deu errado, tente novamente!');
            header("Location: cupons_ativos.php");
        }
    }

    function createCartaoFidelidade(){

    }

    function dadosCartaoFidelidadePorId($id_cartao){
        $sql = "select * from cartaoFidelidade where id = '$id_cartao'";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }

    function salvarNovoCupom(){
        $nome_cupom = $_POST['nome_cupom'];
        $objetivo = $_POST['objetivo_cupom'];
        $descricao = $_POST['descricao_cupom'];
        $fk_loja = $_SESSION['empresa_id'];
        $premio = $_POST['premio_cupom'];

        $sql = "INSERT INTO `cartaoFidelidade` (`id`, `nome_cartao`, `objetivo`, `fk_loja`, `foto`, `premio`, `descricao`) VALUES (NULL, '$nome_cupom', '$objetivo', '$fk_loja', NULL, '$premio', '$descricao');";
        $query = mysqli_query($this->conexao, $sql);
        if ($query){
            setAlerta('success','Cupom salvo com sucesso');
            header("Location: cupons_ativos.php");
        } else{
            setAlerta('danger','Algo deu errado, tente novamente!');
            header("Location: cupons_ativos.php");
        }

    }

    function updateCupom(){
        $id = $_POST['id'];
        $nome_cupom = $_POST['nome_cupom'];
        $objetivo = $_POST['objetivo_cupom'];
        $descricao = $_POST['descricao_cupom'];
        $premio = $_POST['premio_cupom'];

        $sql = "UPDATE `cartaoFidelidade` SET `nome_cartao` = '$nome_cupom', objetivo = '$objetivo', descricao = '$descricao', premio = '$premio' WHERE `cartaoFidelidade`.`id` = '$id';";
        $query = mysqli_query($this->conexao, $sql);
        if ($query){
            setAlerta('success','Cupom salvo com sucesso');
            header("Location: cupons_ativos.php");
        } else{
            setAlerta('danger','Algo deu errado, tente novamente!');
            header("Location: cupons_ativos.php");
        }

    }

}

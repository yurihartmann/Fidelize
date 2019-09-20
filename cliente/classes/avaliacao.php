<?php

require_once "site.php";


class avaliacao extends Site
{

    public function __construct()
    {
        parent::__construct();

        if (isset($_POST['loja_id']))
            $this->salvarAvaliacao();
    }

    function lojasParaAvaliar()
    {
        $numero = $_SESSION['cliente_id'];
        $sql = "select *, l.id as id_loja  from tokens
                left join cartaoFidelidade cF on tokens.fk_carimbo = cF.id
                left join lojas l on cF.fk_loja = l.id
                where fk_cliente = '$numero' group by l.id";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }

    function avaliacaoMedia($id_loja)
    {
        $sql = "select AVG(nota) as media from avaliacao where fk_loja = '$id_loja'";
        $query = mysqli_query($this->conexao, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

        if (is_null($result[0]['media']))
            return 0;

        return $result[0]['media'];
    }

    function dadosAvalicaoPorLoja($id_loja)
    {
        $id_cliente = $_SESSION['cliente_id'];
        $sql = "select * from avaliacao where fk_loja = '$id_loja' and fk_cliente = '$id_cliente'";
        $query = mysqli_query($this->conexao, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        if (!empty($result[0]))
            return $result[0];
        else
            return $result;
    }

    function salvarAvaliacao()
    {
        $id_loja = $_POST['loja_id'];
        $id_cliente = $_SESSION['cliente_id'];
        $posicaonota = "star_" . $id_loja;
        $nota = $_POST[$posicaonota];

        if (isset($_POST['comentario']))
            $comentario = $_POST['comentario'];
        else
            $comentario = "";

        if ($this->verificaAvaliacao($id_loja)) {
            $sql = "update avaliacao set nota = '$nota', comentario = '$comentario' where fk_cliente = '$id_cliente' and fk_loja = '$id_loja'";
        } else {
            if (empty($comentario)){
                $sql = "insert into avaliacao (id, nota, fk_cliente, fk_loja, comentario) value (default ,'$nota','$id_cliente','$id_loja', null )";
            } else {
                $sql = "insert into avaliacao (id, nota, fk_cliente, fk_loja, comentario) value (default ,'$nota','$id_cliente','$id_loja', '$comentario')";
            }
        }

        $query = mysqli_query($this->conexao, $sql);
        if ($query) {
            setAlerta('success', "Avaliação salva com sucesso!");
            header("Location: lista_avaliacao.php");
        } else {
            setAlerta('danger', "Algo deu errado, tente novamente!");
            header("Location: lista_avaliacao.php");
        }

    }


    function verificaAvaliacao($id_loja)
    {
        $id_cliente = $_SESSION['cliente_id'];
        $sql = "select count(*) as num from avaliacao where fk_loja = '$id_loja' and fk_cliente = '$id_cliente'";
        $query = mysqli_query($this->conexao, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        if ($result[0]['num'] > 0) {
            return true;
        } else {
            return false;
        }
    }


}
<?php

require_once "site.php";

class avaliacao extends Site
{

    function avaliacaoMedia()
    {
        $id_loja = $_SESSION['empresa_id'];
        $sql = "select AVG(nota) as media from avaliacao where fk_loja = '$id_loja'";
        $query = mysqli_query($this->conexao, $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

        if (is_null($result[0]['media']))
            return 0;

        return $result[0]['media'];
    }

    function comentariosLimit20()
    {
        $id_loja = $_SESSION['empresa_id'];
        $sql = "select * from avaliacao where fk_loja = '$id_loja' and comentario != '' order by rand() limit 20";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }

    function avaliacaoMediaSegmento($id_segmento){
        $sql = "select avg(nota) from avaliacao
                inner join lojas l on avaliacao.fk_loja = l.id
                inner  join segmento s on l.segmento = s.id
                where s.id = '$id_segmento'";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }
}
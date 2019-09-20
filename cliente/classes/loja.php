<?php

require_once "site.php";

class loja extends Site{


    public function __construct()
    {
        parent::__construct();

        if (isset($_GET['id_loja']))
            $this->dadosLoja();
        else
            header("Location: descubra.php");
    }

    function dadosLoja()
    {
        $id_loja = $_GET['id_loja'];
        // PEGA OS DADOS ATUAIS DA LOJA
        $sql = "select * from lojas where id = '$id_loja'";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }



}
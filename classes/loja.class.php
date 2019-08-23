<?php

require_once "site.class.php";

class Loja extends Site
{

    public function __construct()
    {
        parent::__construct();

        // BOTAO SALVAR DA TELA DE CONFIGURACOES
        if (isset($_POST['btnSalvar'])) {
            $this->updateDadosLoja();
        }
    }

    function dadosLoja($id_loja)
    {
        // PEGA OS DADOS ATUAIS DA LOJA
        $sql = "select * from lojas where id = '$id_loja'";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }

    function updateDadosLoja()
    {

        $id_loja = $_SESSION['empresa_id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = hash('md5',$_POST['old_senha']);
        $new_senha = $_POST['new_senha'];

        $uploder = new upload('logo');
        $logo = $uploder->upload();

        // VERIFICA SE A SENHA ALTUAL ESTA CORRETA PARA EFETUAR AS ALTERACOES
        $sql = "select * from lojas where email = '$email' and senha = '$senha'";
        $result = mysqli_fetch_all(mysqli_query($this->conexao, $sql));
        if (count($result) == 1) {
            if ($new_senha == '') {
                // ALTERACAO DA LOJA SEM NOVA SENHA
                if ($logo == null){
                    $sql = "update lojas set nome = '$nome' where id = '$id_loja';";
                } else {
                    $logo = $logo[0]['dados']['nome_novo'];
                    $sql = "update lojas set nome = '$nome', img = '$logo' where id = '$id_loja';";
                }
                $query = mysqli_query($this->conexao,$sql);
                if ($query){
                    $_SESSION['empresa_nome'] = $nome;
                    if ($logo != null){
                        $_SESSION['empresa_img'] = $logo;
                    }
                    setAlerta('success','Alteracoes salvas com sucesso!');
                    header('Location: configuracoes.php');
                } else {
                    setAlerta('danger','Algo deu errado, tente novamente!');
                    header('Location: configuracoes.php');
                }

            } else {
                // ALTERACAO DA LOJA COM NOVA SENHA
                $new_senha = hash('md5',$new_senha);
                if ($logo == null){
                    $sql = "update lojas set nome = '$nome', senha = '$new_senha' where id = '$id_loja';";
                } else {
                    $logo = $logo[0]['dados']['nome_novo'];
                    $sql = "update lojas set nome = '$nome', senha = '$new_senha' ,img = '$logo' where id = '$id_loja';";
                }
                $query = mysqli_query($this->conexao,$sql);
                if ($query){
                    setAlerta('success','Alteracoes salvas com sucesso!');
                    header('Location: configuracoes.php');
                } else {
                    setAlerta('danger','Algo deu errado, tente novamente!');
                    header('Location: configuracoes.php');
                }
            }
        } else {
            // CASO A SENHA ATUAL ESTA ERRADA NAO PERMITE A ALTERACAO
            setAlerta('danger', 'Senha atual errada, tente novamente!');
            header('Location: configuracoes.php');
        }


    }

}
<?php

require_once "site.php";

class session
{

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $conexao;


    public function __construct($conexao)
    {
        $this->conexao = $conexao;


        if (isset($_POST['btnLogin'])){
            $this->Login($_POST['inputEmail'],$_POST['inputSenha']);
        }
        if (isset($_POST['btnSair'])){
            $this->Logout();
        }
        if (isset($_POST['btnCadastrar'])) {
            $this->newCliente();
        }
    }

    function Login($email,$senha){
        // buscar no banco se o usuario existe, caso existe cria a session e vai para a dashboard
        $this->email = $email;
        $this->senha = hash('md5',$senha);

        $sql = "SELECT * FROM `clientes` 
        WHERE `email` = '$this->email'";

        $resultado = mysqli_fetch_assoc(mysqli_query($this->conexao, $sql));

        if ($resultado['email'] == $this->email && $resultado['senha'] == $this->senha) {
            $_SESSION['cliente_logado'] = true;
            $_SESSION['cliente_nome'] = $resultado['nome'];
            $_SESSION['cliente_id'] = $resultado['numero'];
            $_SESSION['cliente_img'] = $resultado['img'];
            $_SESSION['cliente_email'] = $resultado['email'];
            header("Location: descubra.php");
        } else {
            $_SESSION['cliente_logado'] = false;
            setAlerta('danger', "<strong>Email ou senha inválidos</strong>, tente novamente");
            header("Location: index.php");
        }



    }

    function veficaSession(){
        // verificar se a session esta ativa, caso nao voltar para o login
        if (!isset($_SESSION["cliente_logado"])){
           header('location: index.php');
        }
    }

    function vericaSeJaLogado(){
        if (isset($_SESSION["cliente_logado"]) && $_SESSION["cliente_logado"] == true){
            header('location: descubra.php');
        }
    }

    function Logout(){
        //destroi a session
        session_destroy();
        header('Location: index.php');

    }


    function newCliente()
    {
        
    }

}
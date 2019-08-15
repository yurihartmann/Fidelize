<?php

require_once "site.class.php";

class Session
{

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $conexao;


    public function __construct($conexao)
    {
        $this->conexao = $conexao;
        if (isset($_POST['inputEmail']) && isset($_POST['inputSenha'])){
            $this->Login($_POST['inputEmail'],$_POST['inputSenha'], true);
        }
        if (isset($_POST['btnSair'])){
            $this->Logout();
        }
    }

    function Login($email, $senha, $lembrar){
        $sql = "SELECT * FROM lojas where email = '$email'";
        $resultado = mysqli_fetch_assoc(mysqli_query($this->conexao, $sql));

        if ($resultado['email'] == $email && $resultado['senha'] == $senha) {
            $_SESSION['empresa_logado'] = true;
            $_SESSION['empresa_nome'] = $resultado['nome'];
            $_SESSION['empresa_id'] = $resultado['id'];
            header("Location: dashboard.php");
        } else {
            $_SESSION['empresa_logado'] = false;
            setAlerta('danger',"<strong>Email ou senha invalidos</strong>, tente novamente");
            header("Location: index.php");
        }
    }

    function veficaSession(){
        if (substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, -4) != 'index' &&!(isset($_SESSION['empresa_logado']) && $_SESSION['empresa_logado'] == true)){
            setAlerta('info',"<strong>Voce precisa se logar!</strong>");
            header("Location: index.php");
        }
    }

    function Logout(){
        session_destroy();
        header("Location: index.php");
    }
    

    public function getEmail()
    {
        return $this->email;
    }

    public function getNome()
    {
        return $this->nome;
    }


}
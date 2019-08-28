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

        if (isset($_POST['btnEntrar'])) {
            $this->Login($_POST['inputEmail'], hash('md5',$_POST['inputSenha']));
        }
        if (isset($_POST['btnSair'])) {
            $this->Logout();
        }
    }

    function Login($email, $senha)
    {
        $sql = "SELECT * FROM lojas where email = '$email'";
        $resultado = mysqli_fetch_assoc(mysqli_query($this->conexao, $sql));

        if ($resultado['email'] == $email && $resultado['senha'] == $senha) {
            $_SESSION['empresa_logado'] = true;
            $_SESSION['empresa_nome'] = $resultado['nome'];
            $_SESSION['empresa_id'] = $resultado['id'];
            $_SESSION['empresa_img'] = $resultado['img'];

            header("Location: dashboard.php");
        } else {
            $_SESSION['empresa_logado'] = false;
            setAlerta('danger', "<strong>Email ou senha invalidos</strong>, tente novamente");
            header("Location: index.php");
        }
    }

    function veficaSession()
    {
        if (!isset($_SESSION['empresa_logado']) && $_SESSION['empresa_logado'] == false) {
            setAlerta('info', "<strong>Você precisa se logar!</strong>");
            header("Location: index.php");
        }
    }

    function Logout()
    {
        session_destroy();
        setcookie('modal');
        setcookie('alerta');
        setcookie('modal_show');
        header("Location: index.php");
    }



}
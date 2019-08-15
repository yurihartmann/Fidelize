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
        if (isset($_POST['inputEmail']) && isset($_POST['inputSenha'])) {
            $this->Login($_POST['inputEmail'], $_POST['inputSenha'], $_POST['inputRemember']);
        }
        if (isset($_POST['btnSair'])) {
            $this->Logout();
        }
    }

    function Login($email, $senha, $lembrar)
    {
        $sql = "SELECT * FROM lojas where email = '$email'";
        $resultado = mysqli_fetch_assoc(mysqli_query($this->conexao, $sql));

        if ($resultado['email'] == $email && $resultado['senha'] == $senha) {
            $_SESSION['empresa_logado'] = true;
            $_SESSION['empresa_nome'] = $resultado['nome'];
            $_SESSION['empresa_id'] = $resultado['id'];
            if ($lembrar == 'remember'){
                $this->setLembrarDeMim($email, $senha);
            }
            header("Location: dashboard.php");
        } else {
            $_SESSION['empresa_logado'] = false;
            setAlerta('danger', "<strong>Email ou senha invalidos</strong>, tente novamente");
            header("Location: index.php");
        }
    }

    function veficaSession()
    {
        if (substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, -4) != 'index' && !(isset($_SESSION['empresa_logado']) && $_SESSION['empresa_logado'] == true)) {
            setAlerta('info', "<strong>Voce precisa se logar!</strong>");
            header("Location: index.php");
        } else if (isset($_SESSION['empresa_logado']) == true && substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, -4) == 'index') {
            header("Location: dashboard.php");
        } else if ($this->getLembrarDeMim() && substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, -4) == 'index'){
            $remenber = $this->getLembrarDeMim();
            die($remenber);
        }
    }

    function Logout()
    {
        session_destroy();
        setcookie('remember');
        header("Location: index.php");
    }


    function setLembrarDeMim($email, $senha)
    {
        $remenber['email'] = $email;
        $remenber['senha'] = $senha;
        setcookie('remember', serialize($remenber), time() + 60 * 60 * 24);
    }

    function getLembrarDeMim()
    {
        if (isset($_COOKIE['remember']) && !is_null($_COOKIE['remember'])) {
            $remenber = unserialize($_COOKIE['remember']);
            return $remenber;
        } else {
            return false;
        }
    }


}
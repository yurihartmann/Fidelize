<?php

require_once "site.php";

class Cliente extends Site
{

    function __construct()
    {
        parent::__construct();

        if (isset($_POST['inputPhone']))
            $this->Cadastrar();

        if (isset($_POST['inputNomeCliente']))
            $this->updateCliente();

        if (isset($_POST['telefoneRecuperacao']))
            $this->recuperarSenha();


    }

    function dadosCliente()
    {
        $id_cliente = $_SESSION['cliente_id'];
        $sql = "select * from clientes where numero = '$id_cliente'";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_assoc($query);
        else
            return null;
    }

    function Cadastrar()
    {
        // Criando as Variáveis
        $numero = $_POST["inputPhone"];
        $nome = $_POST["inputNome"];
        $email = $_POST["inputEmail"];
        $senha = $_POST["inputSenha"];
        $senha_hash = hash('md5', $_POST["inputSenha"]);

        $numero = str_replace('(', '', $numero);
        $numero = str_replace(')', '', $numero);
        $numero = str_replace(' ', '', $numero);
        $numero = str_replace('-', '', $numero);


        // verifica se campos vazios
        if (empty($nome) || empty($email) || empty($senha)) {
            setAlerta('danger', "Dados inválidos ou incompletos, tente novamente!");
            header("Location: cadastro.php");
        } else {
            // pega dados para ver se ja tem usuario compativel com as infos
            $sql = "select count(*) from clientes where numero like '$numero' or email like '$email'";
            $query = mysqli_query($this->conexao, $sql);
            $result = mysqli_fetch_assoc($query);

            if ($result['count(*)'] > 0) {
                // pega dados para ver se e um usuario temporario ou ja existente
                $sql = "select * from clientes where numero like '$numero' or email like '$email'";
                $query = mysqli_query($this->conexao, $sql);
                $result = mysqli_fetch_assoc($query);
                if (empty($result['email'])) {
                    // verifica se tem foto
                    if ($_FILES['foto']['name'][0] != '') {
                        $uploder = new upload('foto');
                        $logo = $uploder->upload();
                    } else {
                        $logo = null;
                    }
                    // virifica qual sql dev ser contruido
                    if ($logo == null) {
                        $sql = "update clientes set nome = '$nome', email = '$email', senha = '$senha_hash' where numero = '$numero';";
                    } else {
                        $logo = $logo[0]['dados']['nome_novo'];
                        $sql = "update clientes set nome = '$nome', email = '$email', senha = '$senha_hash', img = '$$logo' where numero = '$numero';";
                    }

                    $query = mysqli_query($this->conexao, $sql);

                    if ($query) {
                        setAlerta('success', "Seja Bem vindo ao Fidelize!, seus carimbos foram registrados com sucesso!");
                        $login = new Session($this->conexao);
                        $login->Login($email, $senha);
                    } else {
                        setAlerta('danger', "Algo deu errado, tente novamente!");
                        header("Location: cadastro.php");
                    }

                } else {
                    setAlerta('danger', "Telefone ou email já cadastrado no sistema!");
                    header("Location: cadastro.php");
                }
            } else {
                // verifica se tem foto
                if ($_FILES['foto']['name'][0] != '') {
                    $uploder = new upload('foto');
                    $logo = $uploder->upload();
                } else {
                    $logo = null;
                }
                // virifica qual sql dev ser contruido
                if ($logo == null) {
                    $sql = "INSERT INTO `clientes` (`numero`, `nome`, `email`, `senha`, `img`) 
                VALUES ('$numero', '$nome', '$email', '$senha_hash', null);";
                } else {
                    $logo = $logo[0]['dados']['nome_novo'];
                    $sql = "INSERT INTO `clientes` (`numero`, `nome`, `email`, `senha`, `img`) 
                VALUES ('$numero', '$nome', '$email', '$senha_hash', '$logo');";
                }

                $query = mysqli_query($this->conexao, $sql);

                if ($query) {
                    setAlerta('success', "Seja Bem vindo ao Fidelize!");
                    $login = new Session($this->conexao);
                    $login->Login($email, $senha);
                } else {
                    setAlerta('danger', "Algo deu errado, tente novamente!");
                    header("Location: cadastro.php");
                }
            }
        }
    }

    function updateCliente()
    {

        // Criando as Variáveis
        $numero = $_SESSION['cliente_id'];
        $nome = $_POST["inputNomeCliente"];
        $email = $_POST["inputEmailCliente"];
        $senha = hash('md5', $_POST["inputSenha"]);
        $senha_nova = $_POST["inputSenhaNova"];

        $numero = str_replace('(', '', $numero);
        $numero = str_replace(')', '', $numero);
        $numero = str_replace(' ', '', $numero);
        $numero = str_replace('-', '', $numero);

        if ($_FILES['foto']['name'][0] != '') {
            $uploder = new upload('foto');
            $foto = $uploder->upload();
        }

        // VERIFICA SE A SENHA ALTUAL ESTA CORRETA PARA EFETUAR AS ALTERACOES
        $sql = "select * from clientes where email = '$email' and senha = '$senha'";
        $result = mysqli_fetch_all(mysqli_query($this->conexao, $sql));
        if (count($result) == 1) {
            if ($senha_nova == '') {
                // ALTERACAO DA LOJA SEM NOVA SENHA
                if ($foto == null) {
                    $sql = "update clientes set nome = '$nome' where numero = $numero;";
                } else {
                    $foto = $foto[0]['dados']['nome_novo'];
                    $sql = "update clientes set nome = '$nome', img = '$foto' where numero = '$numero';";
                }
                $query = mysqli_query($this->conexao, $sql);
                if ($query) {
                    $_SESSION['cliente_nome'] = $nome;
                    if ($foto != null) {
                        $_SESSION['cliente_img'] = $foto;
                    }
                    setAlerta('success', 'Alterações salvas com sucesso!');
                    header('Location: configuracoes.php');
                } else {
                    setAlerta('danger', 'Algo deu errado, tente novamente!');
                    header('Location: configuracoes.php');
                }

            } else {
                // ALTERACAO DA LOJA COM NOVA SENHA
                $senha_nova = hash('md5', $senha_nova);
                if ($foto == null) {
                    $sql = "update clientes set nome = '$nome', senha = '$senha_nova' where numero = '$numero';";
                } else {
                    $logo = $foto[0]['dados']['nome_novo'];
                    $sql = "update clientes set nome = '$nome', senha = '$senha_nova' ,img = '$logo' where numero = '$numero';";
                }
                $query = mysqli_query($this->conexao, $sql);
                if ($query) {
                    $_SESSION['cliente_nome'] = $nome;
                    if ($foto != null) {
                        $_SESSION['cliente_img'] = $foto;
                    }
                    setAlerta('success', 'Alterações salvas com sucesso!');
                    header('Location: configuracoes.php');
                } else {
                    setAlerta('danger', 'Algo deu errado, tente novamente!');
                    header('Location: configuracoes.php');
                }
            }


        } else {
            // CASO A SENHA ATUAL ESTA ERRADA NAO PERMITE A ALTERACAO
            setAlerta('danger', 'Senha atual errada, tente novamente!');
            header('Location: configuracoes.php');
        }


    }


    function recuperarSenha()
    {

        $numero = $_POST['telefoneRecuperacao'];
        $numero = str_replace('(', '', $numero);
        $numero = str_replace(')', '', $numero);
        $numero = str_replace(' ', '', $numero);
        $numero = str_replace('-', '', $numero);

        $sql = "select * from clientes where numero = '$numero'";
        $query = mysqli_query($this->conexao, $sql);
        $result = mysqli_fetch_assoc($query);

        if (empty($result)){
            setAlerta('info', 'Telefone não encontrado!');
            header('Location: recuperar_senha.php');
        } else {
            $senha_nova = mt_rand(1000000000, 9999999999);
            $senha_nova_hash = hash('md5', $senha_nova);
            $sql = "update clientes set senha = '$senha_nova_hash' where numero = '$numero'";
            $query = mysqli_query($this->conexao, $sql);
            if ($query){
                sendSMS($numero,"Seu email é: " . $result['email'] . " e sua nova senha: " . $senha_nova);
                sendEmailResetPassword($result['email'], $result['nome']);
                setAlerta('success', 'Você irá receber o seu email e nova senha pelo SMS!');
                header('Location: index.php');
            } else {
                setAlerta('danger', 'Algo deu errado, tente novamente!');
                header('Location: recuperar_senha.php');
            }
        }



    }


}		
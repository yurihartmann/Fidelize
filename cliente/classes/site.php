<?php

/**
 * CLASSE "Site"
 * Classe principal do projeto.
 */
class Site
{

    public $conexao;

    /**
     * SITE CONSTRUCT
     * Executa o autoload, inclui as configurações,
     * funções e cria a conexão inicial.
     */
    public function __construct()
    {

        if (substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, -4) == '')
            header("Location: index.php");

        require_once "vendor/autoload.php";



        session_start();

        // Includes de configurações e funções globais do projeto
        require_once("../include/config.php");
        require_once("../include/functions.php");

        clearAlerta();

        // Iniciando a Conexão
        $this->Conexao();

        $session = new session($this->conexao);
        
        if (substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, -4) != 'index'
            && substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, -4) != 'cadastro'
            && substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, 15) != 'recuperar_senha')
            $session->veficaSession();
        else
            $session->vericaSeJaLogado();


    }

    public function Conexao()
    {
        $this->conexao = mysqli_connect(LOCAL, USER, PASS, DB) or die ("Erro na conexao com o servidor.");
    }

    /**
     * SITE DESTRUCT
     * Poderia ser usado aqui, a inclusão do FOOTER do site...
     */
    public function __destruct()
    {
//        include "footer.php";
    }


}

?>
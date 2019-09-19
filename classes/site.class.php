<?php
/**
 * CLASSE "Site"
 * Classe principal do projeto.
 */
class Site
{

    public $conexao;

    const LOCAL = 'localhost';
    const USER = 'root';
    const PASS = '';
    const DB = 'fidelize_master';

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


        if (!isset($_SESSION))
            session_start();

        /* AUTOLOAD
         * Metodo mágico que vai carregar os arquivos
         * das classes automaticamente com base no nome
         * da classe. O nome do arquivo php deve ter o
         * mesmo nome da classe.
         */


        // Iniciando a Conexão
        $this->Conexao();

        // Includes de configurações e funções globais do projeto
        require_once("include/config.php");
        require_once("include/functions.php");
        clearAlerta();

        $session = new session($this->conexao);
        if (substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, -4) != 'index')
            $session->veficaSession();

        // Poderia ser utilizado aqui também para incluir o HEADER do site
    }

    public function Conexao()
    {
        $this->conexao = mysqli_connect(self::LOCAL, self::USER, self::PASS, self::DB) or die ("Erro na conexao com o servidor.");
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
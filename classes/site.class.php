<?php
	
	/** 
	 * CLASSE "Site"
	 * Classe principal do projeto.
	 */
	class Site {

		public $conexao;

		/** 
		 * SITE CONSTRUCT
		 * Executa o autoload, inclui as configurações,
		 * funções e cria a conexão inicial.
		 */
		public function __construct() {

			session_start();

			/* AUTOLOAD
			 * Metodo mágico que vai carregar os arquivos 
			 * das classes automaticamente com base no nome 
			 * da classe. O nome do arquivo php deve ter o
			 * mesmo nome da classe.
			 */

			function __autoload($class_name) {
				$class_name = strtolower($class_name);
				$path = "classes/$class_name.class.php";

				if (file_exists($path)) {
					require_once($path);
				} else {
					die("Classe <b>".$class_name."</b> não encontrada no servidor!");
				}
			}

			// Iniciando a Conexão
			$this->Conexao();

			// Includes de configurações e funções globais do projeto
			require_once("include/config.php");
			require_once("include/functions.php");

			// Poderia ser utilizado aqui também para incluir o HEADER do site
		}

		public function Conexao() {
			define('LOCAL', 'localhost:3306');
			define('USER',  'root');
			define('PASS',  '');
			define('DB', 'fidelize');

			$this->conexao = mysqli_connect(LOCAL, USER, PASS, DB) or die ("Erro na conexao com o servidor.");
		}

		/** 
		 * SITE DESTRUCT
		 * Poderia ser usado aqui, a inclusão do FOOTER do site...
		 */
		public function __destruct() {
			
		}

	}

?>
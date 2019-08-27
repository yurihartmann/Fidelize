<?php

	/**
	 * Classe criada para fazer upload de arquivos
	 */
	class upload
	{

		// Diretório que será salvo o arquivo
		CONST DIRETORIO = "uploads/";

		// Nome do input
		public $name_input;

		// Precisa do nome do input para iniciar a classe
		public function __construct($nome_input) {
			$this->name_input = $nome_input;
		}

		/**
		 * Faz o upload de qualquer coisa que esteja no $_FILES
		 */
		public function upload() {
			// Estrutura de repetição para inserir tudo que estiver em $_FILES
			for ($contador = 0; $contador < count($_FILES[$this->name_input]["name"]); $contador++) {

				// Gerando novo nome do arquivo
				$nome = $this->gera_nome();
				
				/**
				 * Obtendo informações dos arquivos
				 */
				// Retorna o nome do arquivo
				$nome_original = basename($_FILES[$this->name_input]["name"][$contador]);

				// Retorna somente o caminho do arquivo
				$nome_original_completo = self::DIRETORIO . $nome_original;

				// Retorna a extensão do arquivo
				$tipo_arquivo = pathinfo($nome_original_completo, PATHINFO_EXTENSION);

				// Nome completo do arquivo
				$nome_novo = self::DIRETORIO . $nome .'.'. $tipo_arquivo;

				/**
				 * Validações dos arquivos
				 */
				// Verifica o tamanho máximo permitido
				if ($_FILES[$this->name_input]["size"][$contador] > 5000000)
					$erro = true;


				// Verificando os formatos dos arquivo
				if($tipo_arquivo != "jpg" && $tipo_arquivo != "png" && $tipo_arquivo != "jpeg")
					$erro = true;

				// Se não existir erro, upa no banco de dados e move para a pasta
				if (!isset($erro)) {
					// Move para a pasta
					if (move_uploaded_file($_FILES[$this->name_input]["tmp_name"][$contador], $nome_novo)) {
						$retorno[] = [
							'imagem_nr' => $contador + 1,
							'status' => true,
							'dados' => [
								'nome_original' => basename($_FILES[$this->name_input]["name"][$contador]),
								'nome_novo' => $nome . '.' . $tipo_arquivo,
								'caminho_arquivo' => $nome_original
							]
						];
					} else {	
						$retorno[] = [
							'imagem_nr' => $contador + 1,
							'status' => false,
							'dados' => false
						];
					}

				}
			}

			return $retorno;
		}

		/**
		 * Gera nomes unicos para os uploades
		 */
		public function gera_nome() {
			$erro = true;

			while ($erro === true) {
				// Gerando nome para o novo upload
				$novo_nome = rand(100000000,999999999);

				// Verifica se já existe algum arquivo com esse nome no diretório
				if (file_exists($novo_nome))
					$erro = true;
				else
					$erro = false;
			}

			return $novo_nome;
		}

	}

?>
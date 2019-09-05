<?php

require_once "site.class.php";

class cartaofidelidade extends Site
{

    private $nome_cartao;
    private $objetivo;
    private $fk_loja;

    function __construct()
    {
        parent::__construct();

        // BOTAO EXCLUIR DA EDICAO DE CUPOM
        if (isset($_POST['btnExcluir']))
            $this->deleteCartaoFidelidadePorID($_POST['id_cupom']);

        // BOTAO SALVAR DA EDICAO DE CUPOM
        if (isset($_POST['formSalvarCupom']) && $_POST['id'] == 'novo')
            $this->salvarNovoCupom();
        else if (isset($_POST['formSalvarCupom']) && $_POST['id'] != 'novo')
            $this->updateCupom();
    }

    function todosCartoesPorLoja($id_loja)
    {
        // RETORNA TODOS OS CARTOES RELACIONADO COM O ID DA LOJA
        $sql = "select * from cartaoFidelidade where fk_loja like '$id_loja'";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }


    function deleteCartaoFidelidadePorID($id_cartao)
    {

        // DELETA OS REGISTROS VICULADOS AO CARTAO FIDELIDADE
        $sql = "DELETE FROM registro_cartaoFidelidade where registro_cartaoFidelidade.fk_carimbo = '$id_cartao'";
        $query = mysqli_query($this->conexao, $sql);
        if ($query) {
            // DELETA OS TOKENS VICULADOS AO CARTAO FIDELIDADE
            $sql = "DELETE FROM tokens where tokens.fk_carimbo = '$id_cartao'";
            $query = mysqli_query($this->conexao, $sql);
            if ($query) {
                // DELETA O CARTAO FIDELIDADE
                $sql = "DELETE FROM cartaoFidelidade WHERE cartaoFidelidade.id = '$id_cartao'";
                $query = mysqli_query($this->conexao, $sql);
                if ($query) {
                    setAlerta('success', 'Cupom excluído com sucesso!');
                    header("Location: cupons_ativos.php");
                } else {
                    setAlerta('danger', 'Algo deu errado, tente novamente!');
                    header("Location: cupons_ativos.php");
                }
            } else {
                setAlerta('danger', 'Algo deu errado, tente novamente!');
                header("Location: cupons_ativos.php");
            }
        } else {
            setAlerta('danger', 'Algo deu errado, tente novamente!');
            header("Location: cupons_ativos.php");
        }
    }


    function dadosCartaoFidelidadePorId($id_cartao)
    {
        // PEGA OS DADOS DE UMA CARTAO FIDELIDADE POR ID
        $sql = "select * from cartaoFidelidade where id = '$id_cartao'";
        $query = mysqli_query($this->conexao, $sql);
        if ($query){
            $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

            $data_inicio = explode(" ",$result[0]["data_inicio"]);
            $hora_inicio = str_replace(':','',$data_inicio[1]);
            $hora_inicio = substr($hora_inicio,0,-2);
            $data_inicio = explode("-",$data_inicio[0]);
            $data_inicio = $data_inicio[2].$data_inicio[1].$data_inicio[0].$hora_inicio;

            $data_fim = explode(" ",$result[0]["data_fim"]);
            $hora = str_replace(':','',$data_fim[1]);
            $hora = substr($hora,0,-2);
            $data_fim = explode("-",$data_fim[0]);
            $data_fim = $data_fim[2].$data_fim[1].$data_fim[0].$hora;

            $result[0]["mask_data_inicio"] = $data_inicio;
            $result[0]["mask_data_fim"] = $data_fim;

            return $result;
        }
        else
            return false;
    }

    function salvarNovoCupom()
    {

        if ($_FILES['banner']['name'][0] != '') {
            $uploder = new upload('banner');
            $logo = $uploder->upload();
            $logo = $logo[0]['dados']['nome_novo'];
        }

        // SALVA UM NOVO CARTAO FIDELIDADE
        $nome_cupom = $_POST['nome_cupom'];
        $objetivo = $_POST['objetivo_cupom'];
        $descricao = $_POST['descricao_cupom'];
        $fk_loja = $_SESSION['empresa_id'];
        $premio = $_POST['premio_cupom'];
        $data_inicio = $_POST['data_inicio'];
        $data_final = $_POST['data_final'];

        // ageita a hora para salvar
        $inicio = explode(" ",$data_inicio);
        $inicio_data = explode("/",$inicio[0]);
        $inicio_data = $inicio_data[2] . "-" . $inicio_data[1] . "-" . $inicio_data[0];
        $inicio_hora = $inicio[1];
        $data_inicio = $inicio_data . " " . $inicio_hora;

        $fim = explode(" ",$data_final);
        $fim_data = explode("/", $fim[0]);
        $fim_data = $fim_data[2] . "-" . $fim_data[1] . "-" . $fim_data[0];
        $fim_hora = $fim[1];
        $data_final = $fim_data . " " . $fim_hora;

        if (isset($logo)){
            $sql = "INSERT INTO `cartaoFidelidade` (`id`, `nome_cartao`, `objetivo`, `fk_loja`, `foto`, `premio`, `descricao`, data_inicio, data_fim ) VALUES (NULL, '$nome_cupom', '$objetivo', '$fk_loja', '$logo', '$premio', '$descricao', '$data_inicio', '$data_final');";
        } else {
            $sql = "INSERT INTO `cartaoFidelidade` (`id`, `nome_cartao`, `objetivo`, `fk_loja`, `foto`, `premio`, `descricao`, data_inicio, data_fim) VALUES (NULL, '$nome_cupom', '$objetivo', '$fk_loja', NULL, '$premio', '$descricao', '$data_inicio', '$data_final');";
        }
        $query = mysqli_query($this->conexao, $sql);
        if ($query) {
            setAlerta('success', 'Cupom salvo com sucesso');
            header("Location: cupons_ativos.php");
        } else {
            setAlerta('danger', 'Algo deu errado, tente novamente!');
            header("Location: cupons_ativos.php");
        }


    }

    function updateCupom()
    {

        if ($_FILES['banner']['name'][0] != '') {
            $uploder = new upload('banner');
            $logo = $uploder->upload();
            $logo = $logo[0]['dados']['nome_novo'];
        }

        // GUARDA AS ALTERACOES DE UMA CARTAO FIDELIDADE
        $id = $_POST['id'];
        $nome_cupom = $_POST['nome_cupom'];
        $objetivo = $_POST['objetivo_cupom'];
        $descricao = $_POST['descricao_cupom'];
        $premio = $_POST['premio_cupom'];
        $data_inicio = $_POST['data_inicio'];
        $data_final = $_POST['data_final'];

        // ageita a hora para salvar
        $inicio = explode(" ",$data_inicio);
        $inicio_data = explode("/",$inicio[0]);
        $inicio_data = $inicio_data[2] . "-" . $inicio_data[1] . "-" . $inicio_data[0];
        $inicio_hora = $inicio[1];
        $data_inicio = $inicio_data . " " . $inicio_hora;

        $fim = explode(" ",$data_final);
        $fim_data = explode("/", $fim[0]);
        $fim_data = $fim_data[2] . "-" . $fim_data[1] . "-" . $fim_data[0];
        $fim_hora = $fim[1];
        $data_final = $fim_data . " " . $fim_hora;


        if (isset($logo)){
            $sql = "UPDATE `cartaoFidelidade` SET `nome_cartao` = '$nome_cupom', descricao = '$descricao', foto = '$logo', data_inicio = '$data_inicio', data_fim = '$data_final' WHERE `cartaoFidelidade`.`id` = '$id';";
        } else {
            $sql = "UPDATE `cartaoFidelidade` SET `nome_cartao` = '$nome_cupom', descricao = '$descricao', data_inicio = '$data_inicio', data_fim = '$data_final' WHERE `cartaoFidelidade`.`id` = '$id';";
        }
        $query = mysqli_query($this->conexao, $sql);
        if ($query) {
            setAlerta('success', 'Cupom salvo com sucesso!');
            header("Location: cupons_ativos.php");
        } else {
            setAlerta('danger', 'Algo deu errado, tente novamente!');
            header("Location: cupons_ativos.php");
        }

    }

    function verificaSeCupomEstaAtivo($id_cupom){
        $data_atual = new DateTime();
        $dados = $this->dadosCartaoFidelidadePorId($id_cupom);

        $data_inicio = new DateTime($dados['data_inicio']);
        $data_fim = new DateTime($dados['data_fim']);

        if ($data_atual > $data_inicio && $data_atual < $data_fim){
            return true;
        } else {
            return false;
        }
    }


}

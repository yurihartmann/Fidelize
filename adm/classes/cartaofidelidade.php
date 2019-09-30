<?php

require_once "site.php";

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

    function todosCartoesPorLoja($pagina,$limite)
    {
        if ($pagina != 1)
            $atual = (($pagina-1) * $limite);
        else
            $atual = 0;

        $id_loja = $_SESSION['empresa_id'];
        // RETORNA TODOS OS CARTOES RELACIONADO COM O ID DA LOJA
        $sql = "select * from cartaoFidelidade where fk_loja like '$id_loja' order by fk_destaque desc limit $atual,$limite";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }

    function countTodosCartoesPorLoja()
    {
        $id_loja = $_SESSION['empresa_id'];
        // RETORNA TODOS OS CARTOES RELACIONADO COM O ID DA LOJA
        $sql = "select count(*) AS total from cartaoFidelidade where fk_loja like '$id_loja' ";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_array($query);
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
                    setAlerta('success', 'Cartão excluído com sucesso!');
                    header("Location: cartoes.php");
                } else {
                    setAlerta('danger', 'Algo deu errado, tente novamente!');
                    header("Location: cartoes.php");
                }
            } else {
                setAlerta('danger', 'Algo deu errado, tente novamente!');
                header("Location: cartoes.php");
            }
        } else {
            setAlerta('danger', 'Algo deu errado, tente novamente!');
            header("Location: cartoes.php");
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
        $valor = $_POST['valor_premio'];
        $valor = str_replace(".","", $valor);
        $valor = str_replace(",",".", $valor);
        $destaque = $_POST['destaque'];

        // ageita a hora para salvar
        $data_inicio = formatarDataParaSalvar($data_inicio);
        $data_final = formatarDataParaSalvar($data_final);

        if (isset($logo)){
            $sql = "INSERT INTO `cartaoFidelidade` (`id`, `nome_cartao`, `objetivo`, `fk_loja`, `foto`, `premio`, `descricao`, data_inicio, data_fim, valor, fk_destaque ) VALUES (NULL, '$nome_cupom', '$objetivo', '$fk_loja', '$logo', '$premio', '$descricao', '$data_inicio', '$data_final','$valor', '$destaque');";
        } else {
            $sql = "INSERT INTO `cartaoFidelidade` (`id`, `nome_cartao`, `objetivo`, `fk_loja`, `foto`, `premio`, `descricao`, data_inicio, data_fim, valor , fk_destaque) VALUES (NULL, '$nome_cupom', '$objetivo', '$fk_loja', NULL, '$premio', '$descricao', '$data_inicio', '$data_final', '$valor', '$destaque');";
        }
        $query = mysqli_query($this->conexao, $sql);
        if ($query) {
            setAlerta('success', 'Cartão salvo com sucesso!');
            header("Location: cartoes.php");
        } else {
            setAlerta('danger', 'Algo deu errado, tente novamente!');
            header("Location: cartoes.php");
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
        $valor = $_POST['valor_premio'];
        $valor = str_replace(".","", $valor);
        $valor = str_replace(",",".", $valor);
        $destaque = $_POST['destaque'];

        // ageita a hora para salvar
        $data_inicio = formatarDataParaSalvar($data_inicio);
        $data_final = formatarDataParaSalvar($data_final);


        if (isset($logo)){
            $sql = "UPDATE `cartaoFidelidade` SET `nome_cartao` = '$nome_cupom', descricao = '$descricao', foto = '$logo', data_inicio = '$data_inicio', data_fim = '$data_final', valor = '$valor' WHERE `cartaoFidelidade`.`id` = '$id';";
        } else {
            $sql = "UPDATE `cartaoFidelidade` SET `nome_cartao` = '$nome_cupom', descricao = '$descricao', data_inicio = '$data_inicio', data_fim = '$data_final', valor = '$valor', fk_destaque = '$destaque' WHERE `cartaoFidelidade`.`id` = '$id';";
        }
        $query = mysqli_query($this->conexao, $sql);
        if ($query) {
            setAlerta('success', 'Cartão salvo com sucesso!');
            header("Location: cartoes.php");
        } else {
            setAlerta('danger', 'Algo deu errado, tente novamente!');
            header("Location: cartoes.php");
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

    function numCartoesAtivos(){
        $id_loja =  $_SESSION['empresa_id'];

        $sql = "select count(*) as num from cartaoFidelidade where fk_loja = '$id_loja' and data_inicio < now() and data_fim > now()";
        $query = mysqli_query($this->conexao,$sql);
        $result = mysqli_fetch_assoc($query);

        return $result['num'];
    }

    function numCartoesCompletados(){
        $id_loja =  $_SESSION['empresa_id'];

        $sql = "select count(*) from tokens 
    inner join cartaoFidelidade cF on tokens.fk_carimbo = cF.id
    inner join lojas l on cF.fk_loja = l.id where l.id = '$id_loja'";
        $query = mysqli_query($this->conexao,$sql);
        $result = mysqli_fetch_assoc($query);

        return $result['count(*)'];
    }

    function todosDestaques(){
        $sql = "select * from destaque";
        $query = mysqli_query($this->conexao, $sql);
        if ($query)
            return mysqli_fetch_all($query, MYSQLI_ASSOC);
        else
            return false;
    }

    function getDestaqueCartao($id_cartao){
        $sql = "select d.nome_destaque as nome from cartaoFidelidade cF
                inner join destaque d on cF.fk_destaque = d.id
                where cF.id = '$id_cartao'";
        $query = mysqli_query($this->conexao, $sql);
        if ($query){
            $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
            return $result[0]['nome'];
        }
        else
            return "false";
    }



}

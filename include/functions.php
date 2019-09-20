<?php

/**
 * FUNÇÕES
 * Funções personalizadas do projeto ficarão aqui.
 */



function setAlerta($tipo, $mensagem)
{
    $alerta['tipo'] = $tipo;
    $alerta['msg'] = $mensagem;
    setcookie('alerta', serialize($alerta), time() + 10);
}

function getAlerta()
{
    if (isset($_COOKIE['alerta']) && !is_null($_COOKIE['alerta'])) {
        $alerta = unserialize($_COOKIE['alerta']);
        include "alerta.php";
    }

}

function clearAlerta(){
    setcookie('alerta');
}

function getModal()
{
    if (isset($_COOKIE['modal']) && !is_null($_COOKIE['modal'])) {
        $modal = unserialize($_COOKIE['modal']);
        if (isset($_COOKIE['modal_show']) && !is_null($_COOKIE['modal_show'])) {
            $modal['show'] = 'true';
        }
        include "modal.php";
    }
}

function setModal($dados)
{
    $modal = $dados;
    setcookie('modal');
    setcookie('modal_show', true, time() + 5);
    setcookie('modal', serialize($modal), time() + (60 * 10));
}

function formatacaoCelular($numero)
{
    $ddd = "(" . substr($numero, 0, 2) . ")";
    $number = " " . substr($numero, 2, 5) . "-";
    $number = $number . substr($numero, 7, 4);

    $numero = $ddd . $number;
    return $numero;
}

function formatacaoData($data) {

    $data_explose = explode('-',$data);
    $ano = $data_explose[0];
    $mes = $data_explose[1];
    $dia = $data_explose[2];

    return $dia. "/" . $mes . "/" . $ano;

}
function formatacaoDataHora($data) {
    $data_explose = explode(' ',$data);
    return formatacaoData($data_explose[0]) . " " . $data_explose[1];
}


function limitaTexto($quantidade_caracteres, $texto){

    if (strlen($texto) > $quantidade_caracteres){
        $texto = substr($texto, 0 , $quantidade_caracteres) . " ...";
    }

    return $texto;
}
function formatarDataParaSalvar($data){
    // ageita a hora para salvar
    $inicio = explode(" ",$data);
    $inicio_data = explode("/",$inicio[0]);
    $inicio_data = $inicio_data[2] . "-" . $inicio_data[1] . "-" . $inicio_data[0];
    $inicio_hora = $inicio[1];
    return $inicio_data . " " . $inicio_hora;
}

function limpaMascaraNumero($numero){
    $numero = str_replace('(', '', $numero);
    $numero = str_replace(')', '', $numero);
    $numero = str_replace(' ', '', $numero);
    return str_replace('-', '', $numero);
}

?>
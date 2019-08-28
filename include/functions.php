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
        setcookie('alerta');
        include "alerta.php";
    }

}

function __autoload($class_name) {
    $class_name = strtolower($class_name);
    $path = "classes/$class_name.class.php";
    if (file_exists($path)) {
        require_once($path);
    } else {
        die("Classe <b>".$class_name."</b> não encontrada no servidor!");
    }
}

function getModal(){
    if (isset($_COOKIE['modal']) && !is_null($_COOKIE['modal'])) {
        $modal = unserialize($_COOKIE['modal']);
        if (isset($_COOKIE['modal_show']) && !is_null($_COOKIE['modal_show'])){
            $modal['show'] = 'true';
        }
        include "modal.php";
    }
}

function setModal($dados){
    $modal = $dados;
    setcookie('modal');
    setcookie('modal_show',true,time() + 5);
    setcookie('modal', serialize($modal), time() + (60 * 10));
}


?>
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

function setModal(){

}

function getModal(){

}

?>
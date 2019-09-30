<!doctype html>
<html lang="pt-br">

<head>
    <title>Fidelize</title>
    <?php if (
        substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, -4) != 'index'
        && substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, -4) != 'cadastro'
        && substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, 15) != 'recuperar_senha'
    ) : ?>
        <!-- Chrome, Firefox OS and Opera -->
        <meta name="theme-color" content="#ff620d">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#ff620d">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="#ff620d">
    <?php endif; ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../media/images/logo.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../media/css/bootstrap.min.css">
    <link rel="stylesheet" href="media/css/estilos.css">
    <link rel="stylesheet" href="media/css/style.css">
    <link rel="stylesheet" href="../media/css/roboto-google.css">
    <link rel="stylesheet" href="../media/css/font_awesome.css">
</head>
<!-- SE NÃO FOR INDEX IMAGEM -->
<?php if (substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, -4) != 'index') : ?>

    <body class="bg-light">
        <!-- SE FOR INDEX IMAGEM -->
    <?php else : ?>

        <body class="bg-light bg-index">
        <?php endif; ?>
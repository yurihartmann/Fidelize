<!doctype html>
<html lang="pt-br">

<head>
    <title>ADM Fidelize</title>
    <?php if (
        substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, -4) != 'index'
    ) : ?>
        <meta name="theme-color" content="#000000">
        <meta name="apple-mobile-web-app-status-bar-style" content="#000000">
    <?php endif; ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../media/images/logo.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../media/css/bootstrap.min.css">
    <link rel="stylesheet" href="media/css/estilos.css">
    <link rel="stylesheet" href="media/css/radios.css">
    <link rel="stylesheet" href="../media/css/font_awesome.css">
</head>



<!-- SE NÃO FOR INDEX IMAGEM -->
<?php if (substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1, -4) != 'index') : ?>

    <body class="bg-light" style="margin-bottom: 80px;">
        <!-- SE FOR INDEX IMAGEM -->
    <?php else : ?>

        <body class="bg-adm" style="margin-bottom: 80px;">
        <?php endif; ?>
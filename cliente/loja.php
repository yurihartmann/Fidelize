<?php

require_once "classes/loja.php";

$id_loja = $_GET['id_loja'];

$loja = new loja();
$dados = $loja->dadosLoja();

if (empty($dados)) {
    setAlerta('info',"Loja não existe!");
    header("Location: descubra.php");
} else {
    $dados = $dados[0];
}

$avaliacao = new avaliacao();
$cartaoFidelidade = new cartaofidelidade();

include "include/header.php";
// INCLUINDO NAVBAR
$ativo = "nada";
include "include/navbar.php";
?>

<div class="container mb-5" style="margin-top: 75px">
    <div class="row">
        <div class="col">
            <h1 class="font-weight-light text-center p-5">
                <?= $dados['nome'] ?>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <?php if (empty($dados['img'])): ?>
                <img src="../media/images/perfil_generico.jpg" class="img-fluid rounded-circle border-orange" style="width: 200px; height: 200px">
            <?php else: ?>
                <img src="../uploads/<?= $dados['img'] ?>"
                     class="img-fluid rounded-circle border-orange" style="width: 200px; height: 200px">
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h1 class="font-weight-light text-center p-5">
                Descrição:
            </h1>
            <h6 class="font-weight-light text-center px-md-5 p-0">
                <?php if (empty($dados['descricao'])): ?>
                    <span class="text-center">Sem descrição...</span>
                <?php else: ?>
                    <?=$dados['descricao']?>
                <?php endif; ?>
            </h6>
        </div>
    </div>
    <div class="row p-3">
        <div class="col-12 col-md-6">
            <h1 class="font-weight-light text-center p-5">
                Avaliação: <?= round($avaliacao->avaliacaoMedia($dados['id']), 1); ?>
            </h1>
        </div>
        <div class="col-12 col-md-6 p-md-5 p-3">
            <div class="text-center star">
                <div class="stars-outer">
                    <div class="stars-inner stars-inner"></div>
                </div>
            </div>
        </div>
    </div>
    <script>

        // Get percentage
        let starPercentage = (<?= round($avaliacao->avaliacaoMedia($dados['id']), 1); ?> / 5) * 100;


        // Round to nearest 10
        let starPercentageRounded = (Math.round(starPercentage / 10) * 10) + "%";

        // Set width of stars.inner to percentage
        document.querySelector(".stars-inner").style.width = starPercentageRounded;

    </script>

    <div class="row">
        <div class="col-12 my-4">
            <h1 class="text-center font-weight-light">Cartões:</h1>
        </div>
        <?php foreach ($dados = $cartaoFidelidade->todosCartoesPorLoja($id_loja) as $chave => $valor): ?>
            <div class="col-12 col-lg-4 mt-3">
                <div class="shadow h-100">
                    <div class="text-center">
                        <?php if ($valor['foto'] == null): ?>
                            <img src="../media/images/banner_generico.png"
                                 class="card-img-top rounded-0 banner banner-generico">
                        <?php else: ?>
                            <img src="../uploads/<?= $valor['foto'] ?>"
                                 class="card-img-top rounded-0 banner">
                        <?php endif ?>
                    </div>
                    <?php
                    $estilo = "alo";
                    switch ($valor['fk_destaque']):
                        case "1":
                            $estilo = "d-none";
                            break;
                        case "2":
                            $estilo = "bg-light text-dark";
                            break;
                        case "3":
                            $estilo = "bg-ouro text-white";
                            break;
                        case "4":
                            $estilo = "bg-diamante text-white";
                            break;
                    endswitch; ?>
                    <div title="Esse é um cartão patrocinado!" class="bagde-cartao <?= $estilo ?> p-1 ml-2 text-center p-2">
                        <strong>Cartão: <?= $cartaoFidelidade->getDestaqueCartao($valor['id']) ?></strong>
                    </div>

                    <div class="card-body">
                        <h4 class="card-title font-weight-bold text-center" style="clear: both"><?= $valor['nome_cartao'] ?></h4>
                        <p class="card-text font-weight-light"><?= $valor['descricao'] ?></p>
                        <p class="font-weight-light"><strong>Objetivo: </strong> <?= $valor['objetivo'] ?></p>
                        <p class="font-weight-light"><strong>Prêmio:</strong> <?= $valor['premio'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include_once "include/footer.php"; ?>

<?php

require_once "classes/cartaofidelidade.php";

$cartaoFidelidade = new cartaofidelidade();
$descubra = $cartaoFidelidade->descubra();
$avaliacao = new avaliacao();


if (empty($descubra)) {
    $vazio = true;
} else {
    $vazio = false;
}

include "include/header.php";
// INCLUINDO NAVBAR
$ativo = "descubra";
include "include/navbar.php";

?>
<div class="container" style="margin-top: 75px">
    <?php getAlerta(); ?>
    <div class="row">
        <div class="col p-5 text-center">
            <?php if ($vazio): ?>
                <h1 class="font-weight-light">Não temos mais nada!</h1>
                <i class="far fa-frown fa-10x mt-5"></i>
            <?php else: ?>
                <h1 class="font-weight-light">Descubra Novos Cartões!</h1>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <?php
        if (!$vazio):
        foreach ($descubra as $chave => $valor): ?>
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
                    <div title="Esse é um cartão patrocinado!" class="<?= $estilo ?> p-1 ml-2 text-center p-2"
                         style="margin-top: -40px; width: 200px;position: relative">
                        <strong>Cartão: <?= $cartaoFidelidade->getDestaqueCartao($valor['id']) ?></strong>
                    </div>

                    <div class="card-body">
                        <a href="loja.php?id_loja=<?= $valor['id_loja'] ?>">
                            <p class="card-text text-orange font-weight-bold float-left"><i
                                        class="fas fa-store-alt"></i> <?= limitaTexto(20, $valor['nome']) ?></p>
                        </a>
                        <?php if ((int)$avaliacao->avaliacaoMedia($valor['id_loja']) > 0): ?>
                            <div class="text-right star<?= $valor['id'] ?>">
                                <div class="stars-sm-outer">
                                    <div class="stars-sm-inner stars-inner<?= $valor['id'] ?>"></div>
                                </div>
                            </div>
                        <?php else: ?>
                            <span class="text-orange float-right mb-3">Novo!</span>
                        <?php endif; ?>
                        <h4 class="card-title font-weight-bold text-center"
                            style="clear: both; margin-top: 10px"><?= $valor['nome_cartao'] ?></h4>
                        <p class="card-text font-weight-light"><?= $valor['descricao'] ?></p>
                        <p class="font-weight-light"><strong>Objetivo: </strong> <?= $valor['objetivo'] ?></p>
                        <p class="font-weight-light"><strong>Prêmio:</strong> <?= $valor['premio'] ?></p>
                    </div>
                </div>
            </div>

        <?php if ((int)$avaliacao->avaliacaoMedia($valor['id_loja']) > 0): ?>
            <script>

                // Get percentage
                let starPercentage<?=$valor['id']?> = (<?= round($avaliacao->avaliacaoMedia($valor['id_loja']), 1); ?> / 5) * 100;


                // Round to nearest 10
                let starPercentageRounded<?=$valor['id']?> = (Math.round(starPercentage<?=$valor['id']?> / 10) * 10) + "%";

                // Set width of stars.inner to percentage
                document.querySelector(".stars-inner<?=$valor['id']?>").style.width = starPercentageRounded<?=$valor['id']?>;

            </script>
        <?php endif; ?>

        <?php endforeach;
            endif;
        ?>
    </div>
</div>


<?php include_once "include/footer.php" ?>

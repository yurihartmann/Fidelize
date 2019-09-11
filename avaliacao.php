<?php

require_once "classes/avaliacao.php";

$avaliacao = new avaliacao();
$media = $avaliacao->avaliacaoMedia();
$cometarios = $avaliacao->comentariosLimit20();


include "include/header.php";

// INCLUINDO NAVBAR
$ativo = "avaliacao";
include "include/navbar.php";
?>
<div class="container" style="margin-top: 70px; margin-bottom: 70px;">
    <?php getAlerta(); ?>
    <div class="row">
        <div class="col text-center">
            <h1 class="font-weight-light p-5">Avaliação</h1>
        </div>
    </div>
    <div class="row">
        <div class="col bg-white shadow">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h1 class="font-weight-light p-5">Sua Avaliação Média: </h1>
                </div>
                <div class="col-12 col-md-6 text-center p-3">
                    <h1 class="font-weight-light"><?= round($media, 1) ?></h1>
                    <div class=" star">
                        <div class="stars-outer">
                            <div class="stars-inner stars-inner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        // Get percentage
        let starPercentage = (<?= round($avaliacao->avaliacaoMedia(), 1); ?> / 5) * 100;


        // Round to nearest 10
        let starPercentageRounded = (Math.round(starPercentage / 10) * 10) + "%";

        // Set width of stars.inner to percentage
        document.querySelector(".stars-inner").style.width = starPercentageRounded;

    </script>
    <div class="row bg-white shadow mt-3">
        <div class="col-12">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="font-weight-light p-5">Alguns Comentários</h1>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <?php foreach ($cometarios as $chave => $valor):?>
                    <div class="card col-12 col-md-2 p-4 m-2 rounded-0">
                        <?=$valor['comentario']?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


<?php include "include/footer.php" ?>

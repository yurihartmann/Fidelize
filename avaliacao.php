<?php

require_once "classes/avaliacao.php";

$avaliacao = new avaliacao();
$media = $avaliacao->avaliacaoMedia();
$cometarios = $avaliacao->comentariosLimit20();

$loja = new loja();
$dados_loja = $loja->segmentoDaLoja($_SESSION['empresa_id']);

$media_segmento = $avaliacao->avaliacaoMediaSegmento($dados_loja[0]['id']);


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
                    <div class="col-12 col-md-5 text-center">
                        <h1 class="font-weight-light p-5">Sua Avaliação Média: </h1>
                    </div>
                    <?php if ($avaliacao->avaliacaoMedia() < $media_segmento[0]['avg(nota)']): ?>
                        <div class="col-12 col-md-2 text-danger text-center py-5">
                            <div class="text-center">
                                <i class="fas fa-arrow-down fa-2x"></i>
                            </div>
                            <h6 class="font-weight-light">Cuidado, você
                                está <?= round($avaliacao->avaliacaoMedia() - $media_segmento[0]['avg(nota)'], 1); ?>
                                pontos atrás da concorrência!</h6>
                        </div>
                    <?php elseif ($avaliacao->avaliacaoMedia() > $media_segmento[0]['avg(nota)']): ?>
                        <div class="col-12 col-md-2 text-success text-center py-5">
                            <div class="text-center">
                                <i class="fas fa-arrow-up fa-2x"></i>
                            </div>
                            <h6 class="font-weight-light">Parabéns, você
                                está <?= round($avaliacao->avaliacaoMedia() - $media_segmento[0]['avg(nota)'], 1); ?>
                                pontos na frente da concorrência!</h6>
                        </div>

                    <?php else: ?>
                        <div class="col-12 col-md-2 text-info text-center py-5">
                            <div class="text-center">
                                <i class="fas fa-check fa-2x"></i>
                            </div>
                            <h6 class="font-weight-light">Parabéns, você
                                está na média da concorrência!</h6>
                        </div>
                    <?php endif; ?>

                    <div class="col-12 col-md-5 text-center p-5">
                        <h1 class="font-weight-light"><?= round($media, 1) ?></h1>
                        <div class=" star">
                            <div class="stars-outer">
                                <div class="stars-inner1 stars-inner"></div>
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
            document.querySelector(".stars-inner1").style.width = starPercentageRounded;
        </script>
        <div class="row bg-white shadow mt-3">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 text-center mt-5 mb-3">
                        <h1 class="font-weight-light">Alguns Comentários</h1>
                        <small class="text-muted">(os comentarios são anônimos para proteger a privacidade dos
                            clientes)</small>
                    </div>
                </div>

                <!-- Comentarios -->
                <div class="row">
                    <?php foreach ($cometarios as $chave => $valor) : ?>
                        <div class="col-12 col-md-4 h-100">
                            <div class="card text-center shadow my-4 border-0">
                                <div class="card-body">
                                    <div class="card-title">
                                        <span class="icon fa fa-quote-left fa-4x mb-5 text-orange"></span>

                                        <div class="card-text">
                                            <span class="text-black-50 description"><?= limitatexto(150, $valor['comentario']) ?></span>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>


<?php include "include/footer.php" ?>
<?php

require_once "classes/avaliacao.php";

$avaliacao = new avaliacao();
$dados = $avaliacao->lojasParaAvaliar();

if (empty($dados)) {
    $vazio = true;
} else {
    $vazio = false;
}

include "include/header.php";
// INCLUINDO NAVBAR
$ativo = "lista_avaliacao";
include "include/navbar.php";
?>

<div class="container mb-5" style="margin-top: 75px">
    <?php getAlerta(); ?>
    <?php if (!$vazio): ?>
        <div class="row">
            <div class="col py-5 text-center">
                <h1 class="font-weight-light">Avaliação</h1>
            </div>
        </div>
        <div class="row">
            <?php foreach ($dados as $chave => $valor): ?>
                <div class="col-12 col-lg-4 mt-3">
                    <div class="h-100 rounded-0 shadow text-center" id="<?= $valor['id'] ?>">
                        <div class="text-center">
                            <?php if ($valor['foto'] == null): ?>
                                <img src="../media/images/banner_generico.png"
                                     class="card-img-top rounded-0 banner banner-generico">
                            <?php else: ?>
                                <img src="../uploads/<?= $valor['img'] ?>"
                                     class="card-img-top rounded-0 banner">
                            <?php endif ?>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title font-weight-bold text-center"><?= $valor['nome'] ?></h4>
                            <hr>
                            <h4 class="card-title font-weight-light text-center">Avaliação Média:</h4>
                            <h1 class="card-title font-weight-light text-center"><?= round($avaliacao->avaliacaoMedia($valor['id_loja']), 1); ?></h1>
                            <!-- Notas Geradas -->
                            <div class="star<?= $valor['id'] ?> text-center">
                                <div class="stars-outer">
                                    <div class="stars-inner stars-inner<?= $valor['id'] ?>"></div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-orange rounded-0 btn-block mt-3"
                                    data-toggle="modal"
                                    data-target="#modalToken<?= $valor['id'] ?>">
                                Fazer avaliação
                            </button>
                        </div>
                    </div>
                </div>
                <script>

                    // Get percentage
                    let starPercentage<?=$valor['id']?> = (<?= round($avaliacao->avaliacaoMedia($valor['id_loja']), 1); ?> / 5) * 100;


                    // Round to nearest 10
                    let starPercentageRounded<?=$valor['id']?> = (Math.round(starPercentage<?=$valor['id']?> / 10) * 10) + "%";

                    // Set width of stars.inner to percentage
                    document.querySelector(".stars-inner<?=$valor['id']?>").style.width = starPercentageRounded<?=$valor['id']?>;

                </script>

                <!-- Modal AVALICAO -->
            <?php
            $dadosAvalicao = $avaliacao->dadosAvalicaoPorLoja($valor['id']);
            ?>

                <div class="modal fade" id="modalToken<?= $valor['id'] ?>" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content rounded-0">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col text-center">
                                        <?php if ($valor['foto'] == null): ?>
                                            <img src="../media/images/banner_generico.png"
                                                 class="img-fluid rounded-circle border-orange banner-generico"
                                                 style="height: 200px; width: 200px;">
                                        <?php else: ?>
                                            <img src="../uploads/<?= $valor['img'] ?>"
                                                 class="img-fluid rounded-circle border-orange"
                                                 style="height: 200px; width: 200px;">
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center mt-3">
                                        <h1 class="font-weight-light"><?= $valor['nome'] ?></h1>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col text-center">
                                        <h4 class="font-weight-light">Classifique sua satisfação:
                                    </div>
                                </div>
                                <hr>
                                <form method="post">
                                    <input type="hidden" value="<?= $valor['id'] ?>" name="loja_id">
                                    <div class="row">
                                        <div class="col text-center my-4">
                                            <div class="rating">
                                                <input type="radio" name="star_<?= $valor['id'] ?>" value="5"
                                                       id="star_<?= $valor['id'] ?>_5" <?= (isset($dadosAvalicao['nota']) && $dadosAvalicao['nota'] == '5') ? "checked" : "checked" ?> ><label
                                                        for="star_<?= $valor['id'] ?>_5"></label>
                                                <input type="radio" name="star_<?= $valor['id'] ?>" value="4"
                                                       id="star_<?= $valor['id'] ?>_4" <?= (isset($dadosAvalicao['nota']) && $dadosAvalicao['nota'] == '4') ? "checked" : "" ?> ><label
                                                        for="star_<?= $valor['id'] ?>_4"></label>
                                                <input type="radio" name="star_<?= $valor['id'] ?>" value="3"
                                                       id="star_<?= $valor['id'] ?>_3" <?= (isset($dadosAvalicao['nota']) && $dadosAvalicao['nota'] == '3') ? "checked" : "" ?> ><label
                                                        for="star_<?= $valor['id'] ?>_3"></label>
                                                <input type="radio" name="star_<?= $valor['id'] ?>" value="2"
                                                       id="star_<?= $valor['id'] ?>_2" <?= (isset($dadosAvalicao['nota']) && $dadosAvalicao['nota'] == '2') ? "checked" : "" ?> ><label
                                                        for="star_<?= $valor['id'] ?>_2"></label>
                                                <input type="radio" name="star_<?= $valor['id'] ?>" value="1"
                                                       id="star_<?= $valor['id'] ?>_1" <?= (isset($dadosAvalicao['nota']) && $dadosAvalicao['nota'] == '1') ? "checked" : "" ?> ><label
                                                        for="star_<?= $valor['id'] ?>_1"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col text-center">
                                            <div class="form-group">
                                                <label for="" class="h4 font-weight-light">Comentário:</label>
                                                <textarea class="form-control" name="comentario" id="" rows="4"
                                                          placeholder="Escreva um breve comentário..."><?= (isset($dadosAvalicao['comentario'])) ? $dadosAvalicao['comentario'] : '' ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-success">Enviar</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="row text-center">
            <div class="col">
                <h1 class="font-weight-light mt-5">Você ainda não pode avaliar nenhuma loja, primeiro complete um cartão
                    fidelidade!</h1>
                <i class="far fa-frown fa-10x mt-5"></i>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include_once "include/footer.php"; ?>

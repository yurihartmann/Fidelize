<?php

require_once "classes/tokens.php";

$tokens = new Tokens();
$dados = $tokens->tokensPorIdCliente();

if (empty($dados)) {
    $vazio = true;
} else {
    $vazio = false;
}

include "include/header.php";
// INCLUINDO NAVBAR
$ativo = "meus_tokens";
include "include/navbar.php";

?>


<div class="container mb-5" style="margin-top: 75px">
    <?php getAlerta(); ?>
    <div class="row">
        <div class="col p-5 text-center">
            <?php if ($vazio): ?>
                <h1 class="font-weight-light">Você não possui nenhum Token!</h1>
                <i class="far fa-frown fa-10x mt-5"></i>
            <?php else: ?>
                <h1 class="font-weight-light">Seus Tokens</h1>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <?php foreach ($dados as $chave => $valor):
            if (isset($_GET['id']) && $_GET['id'] == $valor['fk_carimbo']) {
                $ativo = true;
            } else {
                $ativo = false;
            }
            ?>
            <!--        CARD TOKEN-->
            <div class="col-12 col-lg-4 mt-3">
                <div class="card <?= ($ativo) ? 'shadow-lg' : 'shadow' ?> h-100" id="<?= $valor['fk_carimbo'] ?>">
                    <div class="text-center">
                        <?php if ($valor['foto'] == null): ?>
                            <img src="../media/images/banner_generico.png"
                                 class="card-img-top rounded-0 banner banner-generico">
                        <?php else: ?>
                            <img src="../uploads/<?= $valor['foto'] ?>"
                                 class="card-img-top rounded-0 banner">
                        <?php endif ?>
                    </div>
                    <?php if ($valor['usado'] == 0): ?>
                        <div class="bagde-cartao bg-success p-1 ml-2 text-white text-center p-2">
                            <strong>Disponível</strong>
                        </div>
                    <?php else: ?>
                        <div class="bagde-cartao bg-secondary p-1 ml-2 text-white text-center p-2">
                            <strong>Já Utilizado</strong>
                        </div>
                    <?php endif ?>
                    <div class="card-body">
                        <a href="loja.php?id_loja=<?= $valor['id_loja']?>" class="text-decoration-none">
                            <p class="card-text text-orange font-weight-bold"><i class="fas fa-store-alt"></i> <?= limitaTexto(25,$valor['nome_loja']) ?></p>
                        </a>
                        <h4 class="card-title font-weight-bold text-center mt-3"><?= $valor['nome_cartao'] ?></h4>
                        <p class="card-text d-block text-justify font-weight-light" id="descricao-curta-<?=$valor['id_cartao']?>"><?= limitaTexto(120, $valor['descricao']) ?></p>
                        <p class="card-text d-none text-justify font-weight-light" id="descricao-longa-<?=$valor['id_cartao']?>"><?= $valor['descricao'] ?></p>
                        <?php if (strlen($valor['descricao']) > 119) : ?>
                            <button data-action="Mostrar mais" onclick="alternaDescricao(<?=$valor['id_cartao']?>)" id="btn-descricao-<?=$valor['id_cartao']?>" class="float-right btn btn-sm font-weight-light">mais</button>
                        <?php endif; ?>
                        <p class="font-weight-light"><strong>Objetivo: </strong> <?= $valor['objetivo'] ?></p>
                        <p class="font-weight-light"><strong>Prêmio:</strong> <?= limitaTexto(50,$valor['premio']) ?></p>
                    </div>
                    <ul class="list-group list-group-flush p-2">
                        <button type="button" class="btn btn-outline-orange rounded-0" data-toggle="modal"
                                data-target="#modalToken<?= $valor['fk_carimbo'] ?>">
                            Ver Token
                        </button>
                    </ul>
                </div>
            </div>

            <!-- Modal TOKEN -->
            <div class="modal fade" id="modalToken<?= $valor['fk_carimbo'] ?>" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content rounded-0">
                        <div class="modal-header text-center">
                            <h5 class="modal-title" id="exampleModalLabel"><?= ucfirst($valor['nome_cartao']) ?></h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <img class="img-fluid" src="../media/images/presente.gif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <h1 class="font-weight-light">Parabéns</h1>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col text-center">
                                    <h4 class="font-weight-light">Token: <strong><?= $valor['token'] ?> </strong></h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col text-center">
                                    <h4 class="font-weight-light">Prêmio: <strong><?= $valor['premio'] ?> </strong></h4>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $('#myToken').on('shown.bs.modal', function () {
                    $('#myTokenInput').trigger('focus')
                })
            </script>
        <?php endforeach; ?>
    </div>
</div>


<?php include_once "include/footer.php" ?>

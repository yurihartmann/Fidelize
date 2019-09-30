<?php

require_once "classes/registro_cartaofidelidade.php";

$registros = new registro_cartaofidelidade();
$dados = $registros->buscarCartoesPorIdCliente($_SESSION['cliente_id']);
$cartaoFidelidade = new cartaofidelidade();

if (empty($dados)) {
    $vazio = true;
} else {
    $vazio = false;
}


include "include/header.php";
// INCLUINDO NAVBAR
$ativo = "meus_cartoes";
include "include/navbar.php";

?>

<div class="container mb-5" style="margin-top: 75px">
    <?php getAlerta(); ?>
    <div class="row">
        <div class="col p-5 text-center">
            <?php if ($vazio): ?>
                <h1 class="font-weight-light">Não temos mais nada!</h1>
                <i class="far fa-frown fa-10x mt-5"></i>
            <?php else: ?>
                <h1 class="font-weight-light">Meus Cartões
                </h1>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 p-3">
            <div class="text-center shadow p-5 bg-orange text-white">
                <h2>Você já economizou<br>
                    <div class="counter font-weight-bold"
                         data-count="<?= number_format($registros->quantiaEconomizadaPorIdCliente(), 2) ?>">
                        R$ 0
                    </div>
                </h2>
                <i class="fas fa-dollar-sign fa-10x icon-fundo"></i>
            </div>
        </div>
        <div class="col-12 col-md-6 p-3">
            <div class="text-center shadow p-5 bg-orange text-white">
                <h2>Ainda pode economizar<br>
                    <div class="counter font-weight-bold"
                         data-count="<?= number_format($registros->quantiaAindaParaEconomizar(), 2) ?>">
                        R$ 0
                    </div>
                </h2>
                <i class="fas fa-bullseye fa-10x icon-fundo"></i>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($dados as $chave => $valor):
            $ppv = 100 / $valor['objetivo'];
            $porcentagem = $ppv * $valor['count(fk_cliente)'];
            ?>
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
                    <div title="Esse e um cartao patrocinado!" class="bagde-cartao <?= $estilo ?> p-1 ml-2 text-center p-2">
                        <strong>Cartão: <?= $cartaoFidelidade->getDestaqueCartao($valor['id_cartao']) ?></strong>
                    </div>
                    <div class="card-body">
                        <a href="loja.php?id_loja=<?= $valor['id_loja'] ?>" class="text-decoration-none">
                            <p class="card-text text-orange font-weight-bold"><i
                                        class="fas fa-store-alt"></i> <?= limitaTexto(25, $valor['nome_loja']) ?></p>
                        </a>
                        <h4 class="card-title font-weight-bold text-center mt-3"><?= $valor['nome_cartao'] ?></h4>
                        <p class="card-text font-weight-light"><?= limitaTexto(140, $valor['descricao']) ?></p>
                        <p class="font-weight-light"><strong>Objetivo: </strong> <?= $valor['objetivo'] ?></p>
                        <p class="font-weight-light"><strong>Prêmio:</strong> <?= limitaTexto(50, $valor['premio']) ?>
                        </p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item h4">
                            <div class="progress">
                                <div class="progress-bar <?= ($porcentagem >= 70 ? 'progress-bar-striped' : '') ?> <?= ($porcentagem == 100 ? 'bg-dark-orange' : 'bg-soft-orange') ?>"
                                     role="progressbar"
                                     style="width: <?= $porcentagem ?>%"
                                     aria-valuemin="0" aria-valuemax="100"><?= $valor['count(fk_cliente)'] ?>
                                    /<?= $valor['objetivo'] ?>
                                </div>
                            </div>
                        </li>
                        <?php if ($porcentagem == 100): ?>
                            <li class="list-group-item"><a
                                        href="meus_tokens.php?id=<?= $valor['fk_carimbo'] ?>#<?= $valor['fk_carimbo'] ?>"
                                        class="text-muted" style="text-decoration: none">
                                    <button class="btn btn-block btn-outline-orange rounded-0">Ver Token</button>
                                </a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php include_once "include/footer.php" ?>

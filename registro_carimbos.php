<?php

require_once "classes/registro_cartaofidelidade.php";

$registros = new registro_cartaofidelidade();
$registros = $registros->clientesPorLoja($_SESSION['empresa_id']);


include "include/header.php";

// INCLUINDO NAVBAR
$ativo = "registro_carimbo";
include "include/navbar.php";
?>

<div class="container" style="margin-top: 70px; margin-bottom: 70px;">
    <?php getAlerta(); ?>
    <div class="row">
        <div class="col text-center">
            <h1 class="font-weight-light p-5">Registros Carimbos</h1>
        </div>
    </div>
    <div class="row">
        <div class="col mt-3">
            <a class="btn btn-lg btn-orange" href="novo_carimbo.php"><i class="fas fa-plus-circle"></i> Novo Carimbo</a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-1 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <strong><i class="fas fa-phone"></i> Número</strong>
                        </div>
                        <div class="col-3">
                            <strong>Nome</strong>
                        </div>
                        <div class="col-3 text-center">
                            <strong>Cupom</strong>
                        </div>
                        <div class="col-3 text-center">
                            <strong>Progressão</strong>
                        </div>
                    </div>
                </div>
            </div>
        <?php foreach ($registros as $chave => $valor):
            $ppv = 100/$valor['objetivo'];
            $porcentagem = $ppv * $valor['count(fk_cliente)'];
            ?>

                <div class="card mb-1 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <?= formatacaoCelular($valor['numero']) ?>
                            </div>
                            <div class="col-3">
                                <?php if ($valor['img'] != null && $valor['img'] != ''): ?>
                                    <img style="width: 40px; height: 40px" src="http://cliente.fidelize.ga/uploads/<?=$valor['img']?>" class="rounded-circle mx-3 border-orange d-none d-lg-block float-left">
                                <?php else: ?>
                                    <img src="media/images/perfil_generico.jpg" height="40px" class="rounded-circle mx-3 border-orange d-none d-lg-block float-left">
                                <?php endif;?>
                                <?= $valor['nome'] ?>
                            </div>
                            <div class="col-3 text-center">
                                <?= $valor['nome_cartao'] ?>
                            </div>
                            <div class="col-3">
                                <div class="progress">
                                    <div class="progress-bar <?=( $porcentagem >= 70 ? 'progress-bar-striped':'' )?> <?=( $porcentagem == 100 ? 'bg-dark-orange':'bg-soft-orange' )?>" role="progressbar"
                                         style="width: <?=$porcentagem?>%"
                                         aria-valuemin="0" aria-valuemax="100"><?= $valor['count(fk_cliente)'] ?>/<?= $valor['objetivo'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include "include/footer.php"?>

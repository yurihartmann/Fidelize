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
            <div class="card mb-1 shadow-sm rounded-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-5">
                            <strong><i class="fas fa-phone"></i> Número</strong>
                        </div>
                        <div class="col-3 d-none d-md-block">
                            <strong>Nome</strong>
                        </div>
                        <div class="col-md-3 col-4 text-center">
                            <strong>Cartões</strong>
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

            if (empty($valor['nome']))
                $valor['nome'] = "Usuário Temporário";

            ?>

                <div class="card mb-1 shadow-sm rounded-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-5">
                                <?= formatacaoCelular($valor['numero']) ?><br>

                                <span class="d-block d-md-none"><?= limitaTexto(30,$valor['nome']) ?></span>
                            </div>
                            <div class="col-3 d-none d-md-block">
                                <?php if ($valor['img'] != null && $valor['img'] != ''): ?>
                                    <img style="width: 40px; height: 40px" src="http://cliente.fidelize.ga/uploads/<?= $valor['img'] ?>"
                                         class="rounded-circle mx-3 border-orange d-none d-lg-block float-left">
                                <?php else: ?>
                                    <img src="media/images/perfil_generico.jpg" height="40px"
                                         class="rounded-circle mx-3 border-orange d-none d-lg-block float-left">
                                <?php endif; ?>
                                <?= limitaTexto(30,$valor['nome']) ?>
                            </div>
                            <div class="col-md-3 col-4 text-center">
                                <?= limitaTexto(40,$valor['nome_cartao']) ?>
                            </div>
                            <div class="col-3">
                                <div class="progress">
                                    <div class="progress-bar <?= ($porcentagem >= 70 ? 'progress-bar-striped' : '') ?> <?= ($porcentagem == 100 ? 'bg-dark-orange' : 'bg-soft-orange') ?>"
                                         role="progressbar"
                                         style="width: <?= $porcentagem ?>%"
                                         aria-valuemin="0" aria-valuemax="100"><?= $valor['count(fk_cliente)'] ?>
                                        /<?= $valor['objetivo'] ?>
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

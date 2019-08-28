<?php

require_once "classes/cartaofidelidade.class.php";

$registros = new cartaoFidelidade();
$registros = array_reverse($registros->todosCartoesPorLoja($_SESSION['empresa_id']));

if (empty($registros)) {
    $vazio = true;
} else {
    $vazio = false;
}

$data_atual = new DateTime();

// INCLUINDO NAVBAR
$ativo = "cupons_ativos";
include "include/navbar.php";
?>
    <div class="container" style="margin-top: 70px;">
        <?php getAlerta(); ?>
        <div class="row">
            <div class="col text-center">
                <h1 class="font-weight-light p-5">Cupons</h1>
            </div>
        </div>
        <div class="row">
            <?php if (!$vazio): ?>
                <div class="col-12 col-lg-4 mt-4 px-3">
                    <div class="h-100">
                        <div class="card-body">
                            <h5 class="card-title text-center mb-5 mt-5"><i
                                        class="fas fa-ticket-alt fa-10x text-orange"></i></h5>
                            <a href="edicao_cupom.php?id=novo" class="btn btn-orange btn-block btn-lg mt-5"><i
                                        class="fas fa-plus-circle"></i> Novo Cupom</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php foreach ($registros as $chave => $valor):

                $data_inicio = new DateTime($valor['data_inicio']);
                $data_fim = new DateTime($valor['data_fim']);

                ?>
                <div class="col-12 col-lg-4 mt-4 px-3">
                    <div class="card shadow h-100">
                        <?php if ($valor['foto'] == null): ?>
                            <img src="media/images/banner_generico.png" class="card-img-top"
                                 style="height: 200px; width: 100%;">
                        <?php else: ?>
                            <img src="uploads/<?= $valor['foto'] ?>" class="card-img-top"
                                 style="height: 200px; width: 100%;">
                        <?php endif ?>

                        <div class="card-body">
                            <h5 class="card-title">
                                <?php
                                if ($data_atual < $data_inicio){
                                    echo '<span class="badge badge-warning">Inativo</span>';
                                } else if ($data_atual > $data_inicio && $data_atual < $data_fim){
                                    echo '<span class="badge badge-success">Ativo</span>';
                                } else {
                                    echo '<span class="badge badge-secondary">Finalizado</span>';
                                }


                                ?>

                                <?= $valor['nome_cartao'] ?></h5>
                            <p class="card-text"><?= $valor['descricao'] ?></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Objetivo: </strong> <?= $valor['objetivo'] ?></li>
                            <li class="list-group-item"><strong>Premio:</strong> <?= $valor['premio'] ?></li>
                            <li class="list-group-item"><strong>Data Inicio:</strong> <?= $valor['data_inicio'] ?></li>
                            <li class="list-group-item"><strong>Data Fim:</strong> <?= $valor['data_fim'] ?></li>
                        </ul>
                        <?php if ($data_atual < $data_inicio): ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <a href="edicao_cupom.php?id=<?= $valor['id'] ?>">
                                            <button class="btn btn-outline-primary"><i class="fas fa-edit"></i> Editar
                                            </button>
                                        </a>
                                        <form method="post" class="float-right">
                                            <input type="hidden" value="<?= $valor['id'] ?>" name="id_cupom">
                                            <button class="btn btn-outline-danger" name="btnExcluir" type="submit"><i
                                                        class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if ($vazio): ?>
            <div class="row mt-5">
                <div class="col text-center mt-5">
                    <i class="fas fa-times-circle fa-10x text-danger"></i>
                    <h1 class="text-danger mt-5">Você não possue nenhum cupom!</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-5 text-center">
                    <a class="btn btn-orange btn-lg" href="edicao_cupom.php?id=novo"><i class="fas fa-plus-circle"></i>
                        Novo Cupom</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

<?php include "classes/footer.php" ?>
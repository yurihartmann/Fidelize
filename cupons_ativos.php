<?php

require_once "classes/cartaofidelidade.class.php";

$registros = new cartaoFidelidade();
$registros = $registros->todosCartoesPorLoja($_SESSION['empresa_id']);

if (empty($registros)) {
    $vazio = true;
} else {
    $vazio = false;
}

// INCLUINDO NAVBAR
$ativo = "cupons_ativos";
include "include/navbar.php";
?>

    <div class="container" style="margin-top: 70px;">
        <?php getAlerta(); ?>
        <?php if (!$vazio): ?>
            <div class="row">
                <div class="col-12 col-lg-3 mt-3">
                    <a class="btn btn-primary btn-lg btn-block" href="edicao_cupom.php?id=novo"><i
                                class="fas fa-plus-circle"></i> Novo Cupom</a>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <?php foreach ($registros as $chave => $valor): ?>
                <div class="col-12 col-lg-4 mt-3">
                    <div class="card">
                        <!--                <img src="..." class="card-img-top" alt="...">-->
                        <div class="bg-dark text-center text-white pt-5" style="height: 200px; width: 100%;">Capa do
                            cupom
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $valor['nome_cartao'] ?></h5>
                            <p class="card-text"><?= $valor['descricao'] ?></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Objetivo: </strong> <?= $valor['objetivo'] ?></li>
                            <li class="list-group-item"><strong>Premio:</strong> <?= $valor['premio'] ?></li>
                        </ul>
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
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if ($vazio): ?>
            <div class="row mt-5">
                <div class="col text-center mt-5">
                    <i class="fas fa-times-circle fa-10x text-danger"></i>
                    <h1 class="text-danger mt-5">Voce nao possue nenhum cupom</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-5 text-center">
                    <a class="btn btn-primary btn-lg" href="edicao_cupom.php?id=novo"><i class="fas fa-plus-circle"></i>
                        Novo Cupom</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

<?php include "classes/footer.php" ?>
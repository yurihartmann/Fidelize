<?php
require_once "classes/cartaofidelidade.php";
$registros = new cartaofidelidade();
$cartao = new cartaofidelidade();
$registros = array_reverse($registros->todosCartoesPorLoja());
if (empty($registros)) {
    $vazio = true;
} else {
    $vazio = false;
}
$data_atual = new DateTime();
include "include/header.php";
// INCLUINDO NAVBAR
$ativo = "cupons_ativos";
include "include/navbar.php";
?>
    <div class="container" style="margin-top: 70px;">
        <?php getAlerta(); ?>
        <div class="row">
            <div class="col text-center">
                <h1 class="font-weight-light p-5">Cartões Fidelidades</h1>
            </div>
        </div>
        <div class="row">
            <?php if (!$vazio): ?>
                <div class="col-12 col-lg-4 mt-4 px-3">
                    <div class="h-100">
                        <div class="card-body">
                            <h5 class="card-title text-center mb-5 mt-5"><i
                                        class="fas fa-ticket-alt fa-10x text-orange"></i></h5>
                            <a href="edicao_cartao.php?id=novo" class="btn btn-orange btn-block btn-lg mt-5"><i
                                        class="fas fa-plus-circle"></i> Novo Cartão Fidelidade</a>
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
                        <div class="text-center">
                            <?php if ($valor['foto'] == null): ?>
                                <img src="../media/images/banner_generico.png" class="card-img-top banner banner-generico">
                            <?php else: ?>
                                <img src="../uploads/<?= $valor['foto'] ?>" class="card-img-top banner">
                            <?php endif ?>
                        </div>
                        <?php
                        $estilo = "alo";
                        switch ($valor['fk_destaque']):
                            case "1":
                                $estilo = "bg-secondary text-white";
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
                        <div class="bagde-cartao <?=$estilo?> p-1 ml-2 text-center p-2">
                            <strong><?=$cartao->getDestaqueCartao($valor['id'])?>!</strong>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php
                                if ($data_atual < $data_inicio) {
                                    echo '<span class="badge badge-warning">Inativo</span>';
                                } else if ($data_atual > $data_inicio && $data_atual < $data_fim) {
                                    echo '<span class="badge badge-success">Ativo</span>';
                                } else {
                                    echo '<span class="badge badge-secondary">Finalizado</span>';
                                }
                                //                                var_dump($valor['fk_destaque']);
                                ?>
                                <?= limitaTexto(40, $valor['nome_cartao']) ?></h5>
                            <p class="card-text d-block text-justify" id="descricao-curta-<?=$valor['id']?>"><?= limitaTexto(120, $valor['descricao']) ?></p>
                            <p class="card-text d-none text-justify" id="descricao-longa-<?=$valor['id']?>"><?= $valor['descricao'] ?></p>
                            <button data-action="Mostrar mais" onclick="alternaDescricao(<?=$valor['id']?>)" id="btn-descricao-<?=$valor['id']?>" class="float-right btn btn-sm font-weight-light">mais</button>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Objetivo: </strong> <?= $valor['objetivo'] ?></li>
                            <li class="list-group-item">
                                <strong>Premio:</strong> <?= limitaTexto(30, $valor['premio']) ?></li>
                            <li class="list-group-item"><strong>Data
                                    Inicio:</strong> <?= formatacaoDataHora($valor['data_inicio']) ?></li>
                            <li class="list-group-item"><strong>Data
                                    Fim:</strong> <?= formatacaoDataHora($valor['data_fim']) ?></li>
                        </ul>
                        <?php if ($data_atual < $data_inicio): ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <a href="edicao_cartao.php?id=<?= $valor['id'] ?>">
                                            <button class="btn btn-outline-primary"><i class="fas fa-edit"></i> Editar
                                            </button>
                                        </a>
                                        <form method="post" class="float-right">
                                            <input type="hidden" value="<?= $valor['id'] ?>" name="id_cupom">
                                            <button class="btn btn-outline-danger" name="btnExcluir" type="submit">
                                                <i class="fas fa-trash"></i>
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
                    <a class="btn btn-orange btn-lg" href="edicao_cartao.php?id=novo"><i class="fas fa-plus-circle"></i>
                        Novo Cupom</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

<?php include "include/footer.php" ?>
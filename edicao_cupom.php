<?php

require_once "classes/cartaofidelidade.class.php";

$registros = new cartaoFidelidade();

if (isset($_GET['id']) && ($_GET['id'] != 'novo')) {
    $registros = $registros->dadosCartaoFidelidadePorId($_GET['id']);
    $registros = $registros[0];
    if ($registros['fk_loja'] != $_SESSION['empresa_id']){
        setAlerta('info', 'Voce nao possue esse cartao!');
        header("Location: cupons_ativos.php");
    }
}
// INCLUINDO NAVBAR
$ativo = "cupons_ativos";
include "include/navbar.php";
?>


<div class="container" style="margin-top: 70px;">
    <?php getAlerta(); ?>
    <div class="row">
        <div class="col mt-4">
            <a class="btn btn-outline-secondary" href="cupons_ativos.php"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <h1 class="font-weight-light p-5">Cupom</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-6 offset-3">
            <?php if (is_array($registros) && $registros['foto'] == null): ?>
                <img src="media/images/banner_generico.png" class="img-fluid border-orange rounded" height="100px">
            <?php elseif(is_array($registros)): ?>
                <img src="uploads/<?=$registros['foto']?>" class="img-fluid border-orange rounded" height="100px">
            <?php endif ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-3">
            <form method="post" class="" id="formSalvarCupom" enctype="multipart/form-data">
                <input class="d-none" value="<?= ( $_GET['id'] == 'novo' ? 'novo' : $_GET['id']) ?>" name="id">
                <input class="d-none" value="formSalvarCupom" name="formSalvarCupom">
                <div class="form-group">
                    <label for="inputNomeCupom">Nome do Cartao</label>
                    <input type="text"
                           class="form-control" name="nome_cupom" id="inputNomeCupom" aria-describedby="helpId" placeholder="" value="<?= (is_array($registros) ? $registros['nome_cartao'] : '') ?>">
                </div>
                <div class="form-group">
                    <label for="inputDescricaoCupom">Descricao do Cartao</label>
                    <input type="text"
                           class="form-control" name="descricao_cupom" id="inputDescricaoCupom" aria-describedby="helpId" placeholder="" value="<?= (is_array($registros) ? $registros['descricao'] : '') ?>">
                </div>
                <div class="form-group">
                    <label for="inputObjetivoCupom">Objetivo de Carimbos</label>
                    <input type="number"
                           class="form-control" name="objetivo_cupom" id="inputObjetivoCupom" aria-describedby="helpId" placeholder="" value="<?= (is_array($registros) ? $registros['objetivo'] : '') ?>" <?= (is_array($registros) ? 'disabled=""' : '') ?>>
                    <?= (!is_array($registros) ? '<small id="helpId" class="form-text text-muted">Esse valor nao podera ser alterado futuramente</small>' : '') ?>
                </div>
                <div class="form-group">
                    <label for="inputPremioCupom">Premio</label>
                    <input type="text"
                           class="form-control" name="premio_cupom" id="inputPremioCupom" aria-describedby="helpId" placeholder="" value="<?= (is_array($registros) ? $registros['premio'] : '') ?>" <?= (is_array($registros) ? 'disabled=""' : '') ?>>
                    <?= (!is_array($registros) ? '<small id="helpId" class="form-text text-muted">Esse valor nao podera ser alterado futuramente</small>' : '') ?>
                </div>
                <div class="custom-file mt-3">
                    <input type="file" class="custom-file-input" id="inputBanner" name="banner[]" accept="image/*">
                    <label class="custom-file-label" for="inputBanner" data-browse="Escolher">Enviar Banner...</label>
                    <small id="helpId" class="form-text text-muted">Envie uma logo com resolução de no mínimo 200x100.
                    </small>
                </div>
                <button class="btn btn-orange btn-lg float-right" type="submit" name="btnSalvar" id="btnSalvarCupom"><i class="fas fa-save"></i> Salvar</button>
            </form>
        </div>
    </div>
</div>


<?php include "classes/footer.php" ?>
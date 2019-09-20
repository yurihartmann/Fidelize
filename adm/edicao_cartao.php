<?php

require_once "classes/cartaofidelidade.php";

$registros = new cartaofidelidade();

$destaque = $registros->todosDestaques();

if (isset($_GET['id']) && ($_GET['id'] != 'novo')) {
    $registros = $registros->dadosCartaoFidelidadePorId($_GET['id']);
    $registros = $registros[0];


    $data_atual = new DateTime();
    $data_inicio = new DateTime($registros['data_inicio']);


    if ($registros['fk_loja'] != $_SESSION['empresa_id']  || $data_atual > $data_inicio) {
        setAlerta('info', 'Você não pode acessar esse cartão!');
        header("Location: cartoes.php");
    }
}




include "include/header.php";

// INCLUINDO NAVBAR
$ativo = "cupons_ativos";
include "include/navbar.php";
?>


<div class="container" style="margin-top: 70px;">
    <?php getAlerta(); ?>
    <div class="row">
        <div class="col mt-4">
            <a class="btn btn-outline-secondary" href="cartoes.php"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <h1 class="font-weight-light p-5">Cartão Fidelidade</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-6 offset-3 text-center">
            <?php if (is_array($registros) && $registros['foto'] == null) : ?>
                <img src="../media/images/banner_generico.png" class="img-fluid rounded banner-generico" style="max-height: 300px">
            <?php elseif (is_array($registros)) : ?>
                <img src="../uploads/<?= $registros['foto'] ?>" class="img-fluid rounded" style="max-height: 300px">
            <?php endif ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-3">
            <form method="post" class="" id="formSalvarCupom" enctype="multipart/form-data">
                <input class="d-none" value="<?= ($_GET['id'] == 'novo' ? 'novo' : $_GET['id']) ?>" name="id">
                <input class="d-none" value="formSalvarCupom" name="formSalvarCupom">
                <div class="form-group">
                    <label for="inputNomeCupom">Nome do Cartão</label>
                    <input type="text" class="form-control rounded-0" name="nome_cupom" id="inputNomeCupom" aria-describedby="helpId" placeholder="" value="<?= (is_array($registros) ? $registros['nome_cartao'] : '') ?>">
                </div>
                <div class="form-group">
                    <label for="inputDescricaoCupom">Descricao do Cartão</label>
                    <input type="text" class="form-control rounded-0" name="descricao_cupom" id="inputDescricaoCupom" aria-describedby="helpId" placeholder="" value="<?= (is_array($registros) ? $registros['descricao'] : '') ?>">
                </div>
                <div class="form-group">
                    <label for="inputObjetivoCupom">Objetivo de Carimbos</label>
                    <input type="number" class="form-control rounded-0" name="objetivo_cupom" id="inputObjetivoCupom" aria-describedby="helpId" placeholder="" value="<?= (is_array($registros) ? $registros['objetivo'] : '') ?>">
                </div>

                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="inputPremioCupom">Prêmio</label>
                        <input type="text" class="form-control rounded-0" name="premio_cupom" id="inputPremioCupom" aria-describedby="helpId" placeholder="" value="<?= (is_array($registros) ? $registros['premio'] : '') ?>">
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label for="inputValorPremio">Valor do Prêmio</label>
                        <div class="input-group mb-3 m-0 p-0">

                            <div class="input-group-prepend">
                                <span class="input-group-text  rounded-0">R$</span>
                            </div>

                            <input type="text" class="form-control rounded-0" name="valor_premio" id="inputValorPremio" aria-describedby="helpId" placeholder="" value="<?= (is_array($registros) ? $registros['valor'] : '') ?>"
                                   inputmode="numeric">
                        </div>
                        <small id="inputPremioCupom" class="form-text text-muted">O valor é somente para fins estátiscos.</small>
                    </div>

                </div>


                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="inputDataInicio">Data Início</label>
                        <input type="text" class="form-control rounded-0" name="data_inicio" id="inputDataInicio" aria-describedby="helpId" placeholder="DD/MM/AAAA HH:MM" value="<?= (is_array($registros) ? $registros['mask_data_inicio'] : '') ?>"
                               inputmode="numeric">
                        <div class="invalid-feedback" id="inputDataInicioFeedback">
                            A data de início deve ser maior que a data atual!
                        </div>
                    </div>
                    <div class="form-group col-12 col-md-6 ">
                        <label for="inputDataFinal">Data Final</label>
                        <input type="text" class="form-control rounded-0" name="data_final" id="inputDataFinal" aria-describedby="helpId" placeholder="DD/MM/AAAA HH:MM" value="<?= (is_array($registros) ? $registros['mask_data_fim'] : '') ?>"
                               inputmode="numeric">
                        <div class="invalid-feedback" id="inputDataFinalFeedback">
                            A data final deve ser maior que a data de início!
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <h3 class="font-weight-light">Adicione um destaque para seu Cartão Fidelidade</h3>
                        <p>Um destaque ajuda no desempenho do seu cartão fidelidade, tendo mais destaque e aparecendo por primeiro.</p>
                        <div class="form-group">
                            <label for="">Destaque do cartão fidelidade:</label>
                            <select class="custom-select" name="destaque" id="">
                                <?php foreach ($destaque as $chave => $valor):?>
                                    <option value="<?=$valor['id']?>" <?=(is_array($registros) && $registros['fk_destaque'] == $valor['id']) ? "selected" : ""?>><?=$valor['nome_destaque']?> - R$ <?=$valor['valor_destaque']?>  por dia</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="custom-file mt-3">
                    <input type="file" class="custom-file-input rounded-0" id="inputBanner" name="banner[]" accept="image/*">
                    <label class="custom-file-label rounded-0" for="inputBanner" data-browse="Escolher">Enviar Banner...</label>
                    <small id="helpId" class="form-text text-muted">Envie uma logo com resolução de no mínimo 200x100.
                    </small>
                </div>
                <button class="btn btn-orange btn-lg float-right" type="submit" name="btnSalvar" id="btnSalvarCupom"><i class="fas fa-save"></i> Salvar</button>
            </form>
        </div>
    </div>
</div>


<?php include "include/footer.php" ?>
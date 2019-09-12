<?php

require_once "classes/registro_cartaofidelidade.php";

$registros = new registro_cartaofidelidade();
$cartoes = $registros->todosCartoesPorLoja($_SESSION['empresa_id']);


if (empty($cartoes)) {
    setAlerta('warning', 'Você não possue nenhum cupom ativo, primeiro cadastre um cupom!');
    header("Location: registro_carimbos.php");
}

$data_atual = new DateTime();

include "include/header.php";

// INCLUINDO NAVBAR
$ativo = "registro_carimbo";
include "include/navbar.php";
?>

<div class="container" style="margin-top: 70px;">
    <?php getAlerta(); ?>
    <div class="row">
        <div class="col mt-4">
            <a class="btn btn-outline-secondary" href="registro_carimbos.php"><i class="fas fa-arrow-left"></i>
                Voltar</a>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <h1 class="font-weight-light p-5">Novo Carimbo</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-3">
            <form method="post" class="" id="formSalvarCarimbo">
                <input type="hidden" name="formSalvarCarimbo" value="formSalvarCarimbo">
                <div class="form-group">
                    <label for="inputNumberCupom">Numero do Cliente</label>
                    <input type="text" class="form-control rounded-0" name="number" id="inputNumberCupom" aria-describedby="helpId" placeholder="" inputmode="numeric">
                </div>
                <div class="form-group mt-3">
                    <label for="inputCupomNome">Cartão a receber o carimbo</label>
                    <select class="custom-select rounded-0" name="cupom" id="inputCupomNome">
                        <?php foreach ($cartoes as $chave => $valor) : ?>
                            <option value="<?= $valor['id'] ?>"><?= limitaTexto(40, $valor['nome_cartao']) ?>
                                - <?= limitaTexto(50, $valor['descricao']) ?></option>
                        <?php
                        endforeach; ?>
                    </select>

                </div>
                <button class="btn btn-orange btn-lg float-right" id="btnSalvarCarimbo" type="submit" name="btnSalvarCarimbo">Carimbar
                </button>
            </form>
        </div>
    </div>
</div>


<?php include "include/footer.php" ?>
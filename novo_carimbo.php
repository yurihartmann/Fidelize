<?php

require_once "classes/registro_cartaofidelidade.class.php";

$registros = new registro_cartaoFidelidade();
$cartoes = $registros->todosCartoesPorLoja($_SESSION['empresa_id']);

if (empty($registros)){
    setAlerta('warning','Voce nao possue nenhum cupom, primeiro cadastre um cupom!');
    header("Location: registros_carimbo.php");
}

// INCLUINDO NAVBAR
$ativo = "registro_carimbo";
include "include/navbar.php";
?>

<div class="container" style="margin-top: 70px;">
    <?php getAlerta(); ?>
    <div class="row">
        <div class="col mt-4">
            <a class="btn btn-outline-secondary" href="registro_carimbos.php"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-3">
            <h2 class="text-center">Novo Carimbo</h2>
            <form method="post" class="">
                <div class="form-group">
                    <label for="inputNumberCupom">Numero do Cliente</label>
                    <input type="text"
                           class="form-control" name="number" id="inputNumberCupom" aria-describedby="helpId" placeholder="" >
                </div>
                <small id="helpId" class="form-text text-muted">Modelo : 99123456789 - Sem nunhuma formatacao</small>
                <div class="form-group mt-3">
                    <label for="inputCupomNome">Cupom a receber o carimbo</label>
                    <select class="custom-select" name="cupom" id="inputCupomNome">
                        <?php foreach ($cartoes as $chave => $valor): ?>
                        <option value="<?=$valor['id']?>"><?=$valor['nome_cartao']?> - <?=$valor['descricao']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn btn-success btn-lg float-right" type="submit" name="btnSalvarCarimbo">Carimbar</button>
            </form>
        </div>
    </div>
</div>


<?php include "classes/footer.php" ?>

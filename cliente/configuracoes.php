<?php

require_once "classes/cliente.php";

$cliente = new Cliente();
$registros = $cliente->dadosCliente();



include "include/header.php";
// INCLUINDO NAVBAR
$ativo = "nada";
include "include/navbar.php";

?>

<div class="container mb-5" style="margin-top: 70px;">
    <div class="row">
        <div class="col mt-4">
            <a class="btn btn-outline-secondary" href="descubra.php"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
    <?php getAlerta(); ?>
    <div class="row">
        <div class="col-12 mt-5">
            <h1 class="text-center font-weight-light">Minha Conta</h1>
            <div class="row">
                <div class="col text-center mt-3 mb-5">
                    <?php if ($_SESSION['cliente_img'] != null && $_SESSION['cliente_img'] != ''): ?>
                        <img style="width: 200px; height: 200px" src="../uploads/<?=$_SESSION['cliente_img']?>" class="rounded-circle mx-3 border-orange">
                    <?php else: ?>
                        <img src="../media/images/perfil_generico.jpg" height="200px" class="rounded-circle mx-3 border-orange">
                    <?php endif;?>
                </div>
            </div>
            <form method="post" class="" id="formSalvarConfig" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputNomeCliente">Nome</label>
                    <input type="text"
                           class="form-control rounded-0" name="inputNomeCliente" id="inputNomeCliente" aria-describedby="helpId" placeholder="" value="<?= (is_array($registros) ? $registros['nome'] : '') ?>">
                </div>
                <div class="form-group">
                    <label for="inputTelefoneCliente">Telefone</label>
                    <input type="text"
                           class="form-control rounded-0" name="inputTelefoneCliente" id="inputTelefoneCliente" aria-describedby="helpId" placeholder="" value="<?= (is_array($registros) ? $registros['numero'] : '') ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="inputEmailCliente">Email</label>
                    <input type="email"
                           class="form-control rounded-0" name="inputEmailCliente" id="inputEmailCliente" aria-describedby="helpId" placeholder="" value="<?= (is_array($registros) ? $registros['email'] : '') ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="inputSenha">Senha Atual</label>
                    <input type="password"
                           class="form-control rounded-0" name="inputSenha" id="inputSenhaConfig" aria-describedby="helpId" placeholder="" value="">
                </div>
                <div class="form-group">
                    <label for="inputSenhaNova">Senha Nova</label>
                    <input type="password"
                           class="form-control rounded-0" name="inputSenhaNova" id="inputSenhaNova" aria-describedby="helpId" placeholder="" value="">
                    <small id="helpId" class="form-text text-muted">Se nao deseja alterar a senha deixe o campo em branco.</small>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input rounded-0" id="inputLogo" name="foto[]" accept="image/*">
                    <label class="custom-file-label rounded-0" for="inputFoto" data-browse="Escolher">Enviar foto...</label>
                </div>
                <button class="btn btn-orange btn-lg float-right mt-5 rounded-0" type="submit" name="btnSalvar" id="btnSalvarConfig"><i class="fas fa-save"></i> Salvar</button>
            </form>
        </div>
    </div>
</div>


<?php include_once "include/footer.php"?>

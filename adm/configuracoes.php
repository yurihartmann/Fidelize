<?php

require_once "classes/loja.php";

$loja = new loja();
$registros = $loja->dadosLoja();
$registros = $registros[0];

$segmento = $loja->todosSegmentos();

include "include/header.php";

// INCLUINDO NAVBAR
include "include/navbar.php";
?>


<div class="container" style="margin-top: 70px;">
    <div class="row">
        <div class="col mt-4">
            <a class="btn btn-outline-secondary" href="dashboard.php"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
    <?php getAlerta(); ?>
    <div class="row">
        <div class="col-12 mt-5">
            <h1 class="text-center font-weight-light">Minha Empresa</h1>
            <div class="row">
                <div class="col text-center mt-3 mb-5">
                    <?php if ($_SESSION['empresa_img'] != null && $_SESSION['empresa_img'] != ''): ?>
                        <img style="width: 200px; height: 200px" src="../uploads/<?=$_SESSION['empresa_img']?>" class="rounded-circle mx-3 border-orange">
                    <?php else: ?>
                        <img src="../media/images/perfil_generico.jpg" height="100px" class="rounded-circle mx-3 border-orange">
                    <?php endif;?>
                </div>
            </div>
            <form method="post" class="" id="formSalvarConfig" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputNomeLoja">Nome da Loja</label>
                    <input type="text"
                    class="form-control rounded-0" name="nome" id="inputNomeLoja" aria-describedby="helpId" placeholder="" value="<?= (is_array($registros) ? $registros['nome'] : '') ?>">
                </div>
                <div class="form-group">
                    <label for="inputDescricao">Descrição</label>
                    <textarea class="form-control" id="inputDescricao" name="inputDescricao" rows="4"><?= (is_array($registros) ? $registros['descricao'] : '') ?></textarea>
                </div>
                <div class="form-group">
                    <label for="inputEmailLoja">Email</label>
                    <input type="email"
                    class="form-control rounded-0" name="email" id="inputEmailLoja" aria-describedby="helpId" placeholder="" value="<?= (is_array($registros) ? $registros['email'] : '') ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="inputSenha">Senha Atual</label>
                    <input type="password"
                    class="form-control rounded-0" name="old_senha" id="inputSenha" aria-describedby="helpId" placeholder="" value="">
                </div>
                <div class="form-group">
                    <label for="inputSenhaNova">Senha Nova</label>
                    <input type="password"
                    $id_loja                  class="form-control rounded-0" name="new_senha" id="inputSenhaNova" aria-describedby="helpId" placeholder="" value="">
                    <small id="helpId" class="form-text text-muted">Se nao deseja alterar a senha deixe o campo em branco.</small>
                </div>

                <div class="form-group">
                    <label for="">Segmento da Empresa</label>
                    <select class="custom-select" name="segmento" id="">
                        <?php foreach ($segmento as $chave => $valor):?>
                            <option value="<?=$valor['id']?>" <?= ($registros['segmento'] == $valor['id'])? 'selected ': '' ?>><?=$valor['nome_segmento']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="custom-file mt-3">
                    <input type="file" class="custom-file-input rounded-0" id="inputLogo" name="logo[]" accept="image/*">
                    <label class="custom-file-label rounded-0" for="inputLogo" data-browse="Escolher">Enviar Logo...</label>
                    <small id="helpId" class="form-text text-muted">Envie uma logo com resolução de no mínimo 300x300, preferencialmente quadrada.
                    </small>
                </div>
                <button class="btn btn-orange btn-lg float-right mt-5" type="submit" name="btnSalvar" id="btnSalvarConfig"><i class="fas fa-save"></i> Salvar</button>
            </form>
        </div>
    </div>
</div>


<?php include "include/footer.php" ?>
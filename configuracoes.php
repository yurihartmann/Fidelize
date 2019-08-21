<?php

require_once "classes/loja.class.php";

$loja = new Loja();
$registros = $loja->dadosLoja($_SESSION['empresa_id']);
$registros = $registros[0];

// INCLUINDO NAVBAR
include "include/navbar.php";
?>


    <div class="container" style="margin-top: 70px;">
        <?php getAlerta(); ?>
        <div class="row">
            <div class="col mt-4">
                <a class="btn btn-outline-secondary" href="cupons_ativos.php">Voltar</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3">
                <h2 class="text-center">Configuracoes</h2>
                <form method="post" class="">
                    <div class="form-group">
                        <label for="inputNomeLoja">Nome da Loja</label>
                        <input type="text"
                               class="form-control" name="nome" id="inputNomeLoja" aria-describedby="helpId" placeholder="" value="<?= (is_array($registros) ? $registros['nome'] : '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputEmailLoja">Email</label>
                        <input type="text"
                               class="form-control" name="email" id="inputEmailLoja" aria-describedby="helpId" placeholder="" value="<?= (is_array($registros) ? $registros['email'] : '') ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="inputSenha">Senha Atual</label>
                        <input type="password"
                               class="form-control" name="old_senha" id="inputSenha" aria-describedby="helpId" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputSenhaNova">Senha Nova</label>
                        <input type="password"
                               class="form-control" name="new_senha" id="inputSenhaNova" aria-describedby="helpId" placeholder="" value="">
                        <small id="helpId" class="form-text text-muted">Se nao deseja alterar a senha deixe o campo em branco</small>
                    </div>
                    <button class="btn btn-success btn-lg float-right" type="submit" name="btnSalvar">Salvar</button>
                </form>
            </div>
        </div>
    </div>


<?php include "classes/footer.php" ?>
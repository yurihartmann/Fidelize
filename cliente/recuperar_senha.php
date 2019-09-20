<?php

require_once "classes/cliente.php";

$cliente = new Cliente();


include "include/header.php";

?>
    <div class="container my-5">
        <div class="row p-1">
            <div class="col-12 col-md-8 offset-md-2 bg-light rounded mt-5">
                <div class="row">
                    <div class="col px-4 ml-4 pt-4">
                        <a href="index.php" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Voltar</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 offset-3 py-3 p-1 p-lg-5">
                        <img src="../media/images/fidelize_preto.png" class="img-fluid">
                        <h1></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center my-3">
                        <h1 class="font-weight-light">Recuperar Senha</h1>
                        <p class="font-weight-light">Você irá receber um SMS com seu email e sua nova senha!</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col px-5 py-4">
                        <?php getAlerta(); ?>
                        <form method="post">
                            <div class="form-group">
                                <label for="telefoneRecuperacao">Seu Telefone</label>
                                <input type="text"
                                       class="form-control" name="telefoneRecuperacao" id="telefoneRecuperacao"
                                       inputmode="numeric">
                            </div>
                            <button type="submit" class="btn btn-block btn-lg btn-orange mt-3" name="btnContinuar">Recuperar <i class="fas fa-arrow-right"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php
include_once "include/footer.php" ?>
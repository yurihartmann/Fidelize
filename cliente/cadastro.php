<?php
require_once "classes/cliente.php";
$cliente = new Cliente();

include "include/header.php";
?>


    <div class="container my-3">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2 mt-5">
                <a href="index.php" class="btn btn-outline-secondary mx-4 rounded-0"><i class="fas fa-arrow-left"></i>
                    Voltar </a>
                <div class="row">
                    <div class="col px-4 ml-4 pt-4">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 offset-3 p-lg-4">
                        <img src="../media/images/fidelize_preto.png" class="img-fluid container">
                        <h1></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center my-3">
                        <h1 class="font-weight-light">Cadastro</h1>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col px-5 py-2">
                        <?php getAlerta(); ?>

                        <form method="post" enctype="multipart/form-data" id="formCadastrar">
                            <div class="form-group">
                                <label for="inputPhone">Telefone</label>
                                <input type="text" class="form-control rounded-0" name="inputPhone" id="inputPhone"
                                       placeholder="Digite seu Telefone" inputmode="numeric">
                            </div>

                            <div class="form-group">
                                <label for="inputNome">Nome</label>
                                <input type="text" class="form-control rounded-0" name="inputNome" id="inputNome"
                                       placeholder="Nome...">
                            </div>

                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input type="email"
                                       class="form-control rounded-0" name="inputEmail" id="inputEmail"
                                       placeholder="Digite seu email...">
                            </div>

                            <div class="form-group">
                                <label for="inputSenha">Senha</label>
                                <input type="password" class="form-control rounded-0" name="inputSenha" id="inputSenha"
                                       placeholder="Sua senha...">
                                <div class="invalid-feedback">
                                    Senha deve conter no minimo 8 caracteres!
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputCSenha">Confirme sua Senha</label>
                                <input type="password" class="form-control rounded-0" name="inputCSenha" id="inputCSenha"
                                       placeholder="Digite sua senha novamente...">
                                <div class="invalid-feedback">
                                    Senha não coincidem!
                                </div>
                            </div>

                            <div class="custom-file my-3 mb-5">
                                <input type="file" class="custom-file-input rounded-0" id="inputLogo" name="foto[]" accept="image/*">
                                <label class="custom-file-label rounded-0" for="inputLogo" data-browse="Escolher">Enviar foto...</label>
                            </div>

                            <button type="submit" name="btnCadastrar" id="btnCadastrar" class="btn btn-block btn-lg btn-orange rounded-0">
                                Cadastrar
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include_once "include/footer.php" ?>
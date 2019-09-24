<?php
require_once "classes/site.php";
$site = new Site();

include "include/header.php";
?>


<div class="container-fluid">
    <div id="enterPage" class="row">
        <div id="coluna1" class="col-lg-8 col-md-7 col-sm-6">
            <div class="text-fidelize">
                <img src="../media/images/fidelize_branco.png" alt="">
                <h2 class="mt-2 text-white ml-2 font-weight-light line anim-typewriter">O cartão rápido e fácil em apenas um clique!</h2>
            </div>
        </div>

        <div id="coluna2" class="col-lg-4 col-sm-6 col-xs-12 mt-5">
            <div class="row mt-5">
                <div class="col text-center my-2">
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-left my-2">
                    <a href="../fidelize/index.php"><button class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Voltar</button></a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center my-2">
                    <h1 class="font-weight-light">Login</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php getAlerta(); ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control rounded-0" name="inputEmail" id="inputEmail" placeholder="Digite seu email...">
                        </div>
                        <div class="form-group">
                            <label for="inputSenha">Senha</label>
                            <input type="password" class="form-control rounded-0" name="inputSenha" id="inputSenha" placeholder="Sua senha...">
                        </div>

                        <a href="recuperar_senha.php" class="text-muted mb-3">Esqueceu o email ou senha?</a>
                        <button type="submit" class="btn btn-block btn-lg btn-orange mt-3 rounded-0" name="btnLogin">Entrar
                        </button>
                    </form>
                    <a href="cadastro.php" class="btn btn-outline-secondary btn-block btn-lg mt-3 rounded-0">Cadastre-se</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once "include/footer.php" ?>
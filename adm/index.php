<?php


require_once "classes/site.class.php";
$site = new Site();

include "include/header.php";

?>

<div class="container">
    <div class="row p-1">
        <div class="col-12 col-md-8 offset-md-2 bg-light rounded mt-5">
            <div class="row">
                <div class="col px-4 ml-4 pt-4">
                    <a href="../fidelize/index.php" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Voltar</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-12 offset-md-2 text-center mt-5 mb-3 px-5 p-md-0">
                    <img src="../media/images/fidelize_adm_preto.png" class="img-fluid">
                    <h1></h1>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col px-5 py-4">
                    <?php getAlerta(); ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email"
                                   class="form-control rounded-0" name="inputEmail" id="inputEmail"
                                   placeholder="Digite seu email..." value="<?=(isset($_SESSION['email_digitado'])? $_SESSION['email_digitado'] : "")?>">
                        </div>
                        <div class="form-group">
                            <label for="inputSenha">Senha</label>
                            <input type="password" class="form-control rounded-0" name="inputSenha" id="inputSenha"
                                   placeholder="Sua senha...">
                        </div>
                        <button class="btn btn-block btn-lg btn-orange" type="submit" name="btnEntrar">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "include/footer.php" ?>



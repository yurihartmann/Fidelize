<?php


require_once "classes/site.class.php";
$site = new Site();


?>

<div class="container">
    <div class="row p-1">
        <div class="col-12 col-md-8 offset-md-2 bg-light rounded mt-5">
            <div class="row">
                <div class="col px-4 pt-4">
                    <a href="" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Voltar</a>
                </div>
            </div>
            <div class="row">
                <div class="col-6 offset-3 py-3 p-1 p-lg-5">
                    <img src="media/images/FIDELIZE.png" class="img-fluid">
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
                                   class="form-control" name="inputEmail" id="inputEmail"
                                   placeholder="Digite seu email...">
                        </div>
                        <div class="form-group">
                            <label for="inputSenha">Senha</label>
                            <input type="password" class="form-control" name="inputSenha" id="inputSenha"
                                   placeholder="Sua senha...">
                        </div>
                        <button class="btn btn-block btn-lg btn-success" type="submit" name="btnEntrar">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "classes/footer.php" ?>



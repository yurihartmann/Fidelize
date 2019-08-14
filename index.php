<?php


require_once "classes/session.class.php";

$session = new Session();

?>


<body class="bg-info">
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
                    <?php include "include/alerta.php" ?>
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
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="inputLembrarDeMim"
                                   value="remenber">
                            <label class="custom-control-label" for="inputLembrarDeMim">Lembrar de mim</label>
                        </div>
                        <button class="btn btn-block btn-lg btn-outline-success">Login</button>
                        <a href="dashboard.php">dashboard</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>




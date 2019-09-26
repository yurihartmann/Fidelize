<?php
include "include/header.php";
include "include/navbar.php";

require_once "../include/config.php";

$conexao = mysqli_connect(LOCAL, USER, PASS, DB) or die ("Erro na conexao com o servidor.");


$sql = "SELECT * FROM segmento";
$query= mysqli_query($conexao, $sql);
$segmentos = mysqli_fetch_all($query);
//die(var_dump($segmentos));



?>
<div class="header">
    <div class="container">
        <div class="row center">
            <div class="col-lg-12 text-light text-center text-uppercase mt-5">
                <h1>QUERO FIDELIZAR</h1>
            </div>
        </div>
    </div>
</div>
<content>
    <div class="container-fluid">
        <div class="container my-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                            <p class="lead text-center">
                                Fidelize sua Empresa <i class="far fa-building mx-1"></i>
                            </p>
                            <form class="was-validated">
                                <div class="form-group">
                                    <label for="email" class="">E-mail</label>
                                    <input type="email" class="form-control rounded-0" id="email" name="email" aria-describedby="emailHelp" placeholder="fidelize@fidelize.com" required="">
                                    <small id="emailHelp" class="form-text text-muted">Entraremos em contato pelo e-mail digitado.</small>
                                </div>
                                <div class="form-group">
                                    <label for="nome" class="">Nome da Empresa</label>
                                    <input type="text" class="form-control  rounded-0" id="nome" name="nome" placeholder="Digite aqui..." required="">
                                </div>
                                <div class="form-group">
                                    <label for="mensagem" class="">Descrição da Empresa</label>
                                    <textarea class="form-control rounded-0" id="mensagem" name="mensagem" rows="3" placeholder="Somos fidelizados etc..." required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Segmento da Empresa</label>
                                    <select class="custom-select" name="segmento" id="segmento">
                                        <?php foreach ($segmentos as $chave => $valor) : ?>
                                            <option value="<?= $valor[0] ?>"><?= $valor[1] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </form>
                            <div class="text-center my-2">
                                <input class="btn btn-orange btn-lg btn-block  rounded-0" name="btnSalvarFidelizar" id="btnSalvarFidelizar" type="button" value="Enviar">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center border-0">
                        <div class="card-body">
                            <h1 class="card-title font-weight-bold">Fidelize sua Empresa <i class="fas fa-check text-green"></i></h1>
                            <h5 class="card-text my-5">Um jeito prático e fácil para aumentar suas vendas. O que o cliente quer é sentir-se reconhecido e conhecido por você. Quando ele percebe que suas necessidades e desejos são compreendidos por sua empresa, que você sabe exatamente o que ele precisa e quando precisa, com certeza ele vai ter suas expectativas superadas. Esta é a melhor maneira de como fidelizar clientes: conhecer o máximo possível sobre eles e atender suas demandas de forma a surpreendê-los.</h5>
                        </div>
                        <div class="col-12 d-none d-lg-block">
                            <img class="img-transparence" src="../media/images/fidelize_preto.png">
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</content>
<?php include "include/footer.php" ?>
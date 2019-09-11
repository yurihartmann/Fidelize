<?php

require_once "classes/tokens.php";

$tokens = new tokens();
$tokens = $tokens->tokensPorIdLoja($_SESSION['empresa_id']);
$tokens = array_reverse($tokens);

include "include/header.php";

// INCLUINDO NAVBAR
$ativo = "validar_token";
include "include/navbar.php";
?>


<div class="container" style="margin-top: 70px">
    <?php getAlerta(); ?>
    <div class="row">
        <div class="col text-center">
            <h1 class="font-weight-light p-5">Validar Token</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card text-left mt-3 shadow rounded-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form class="" id="formVerificarToken" method="post">
                                <div class="form-group">
                                    <input type="hidden" name="formVerificarToken" value="formVerificarToken">
                                    <input type="text"
                                           class="form-control form-control-lg rounded-0" name="token" id="inputToken"
                                           aria-describedby="helpId" placeholder="Digite o token do cliente para verificar...">
                                    <button class="btn btn-block btn-orange btn-lg mt-3" type="submit"><i
                                                class="fas fa-search"></i> Verificar
                                    </button>
                                    <div class="row">
                                        <div class="col">
                                            <?php getModal(); ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-1 shadow-sm rounded-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-5">
                            <strong>Numero</strong>
                        </div>
                        <div class="col-3 d-none d-md-block">
                            <strong>Nome</strong>
                        </div>
                        <div class="col-3 text-center">
                            <strong>Cupom</strong>
                        </div>
                        <div class="col-md-3 col-4 text-center">
                            <strong>Usado</strong>
                        </div>
                    </div>
                </div>
            </div>
            <?php foreach ($tokens as $chave => $valor): ?>
                <div class="card mb-1 shadow-sm rounded-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-5">
                                <?= formatacaoCelular($valor['numero']) ?>
                                <span class="d-block d-md-none"><?= limitaTexto(30,$valor['nome']) ?></span>
                            </div>
                            <div class="col-3 d-none d-md-block">
                                <?php if ($valor['img'] != null && $valor['img'] != ''): ?>
                                    <img style="width: 40px; height: 40px" src="http://cliente.fidelize.ga/uploads/<?= $valor['img'] ?>"
                                         class="rounded-circle mx-3 border-orange d-none d-lg-block float-left">
                                <?php else: ?>
                                    <img src="media/images/perfil_generico.jpg" height="40px"
                                         class="rounded-circle mx-3 border-orange d-none d-lg-block float-left">
                                <?php endif; ?>
                                <?= $valor['nome'] ?>
                            </div>
                            <div class="col-3 text-center">
                                <?= $valor['nome_cartao'] ?>
                            </div>
                            <div class="col-md-3 col-4">
                                <?php if ($valor['usado'] == 0): ?>
                                    <h5><span class="badge badge-success">Disponivel</span></h5>
                                <?php else: ?>
                                    <h5><span class="badge badge-danger">Ja utilizado</span></h5>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
</div>





<?php include "include/footer.php" ?>

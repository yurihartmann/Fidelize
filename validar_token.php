<?php

require_once "classes/tokens.class.php";

$tokens = new Tokens();
$tokens = $tokens->tokensPorIdLoja($_SESSION['empresa_id']);

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
            <div class="card text-left mt-3 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form class="" id="formVerificarToken" method="post">
                                <div class="form-group">
                                    <input type="hidden" name="formVerificarToken" value="formVerificarToken">
                                    <input type="text"
                                           class="form-control form-control-lg" name="token" id="inputToken"
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


    <div class="row mt-3">
        <div class="col">
            <div class="card shadow">
                <h5 class="card-header">Tokens</h5>
                <div class="card-body">
                    <?php if (!is_null($tokens[0]['nome'])): ?>
                        <table class="table table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col"><i class="fas fa-phone-alt"></i> Numero</th>
                                <th scope="col"><i class="fas fa-user"></i> Nome</th>
                                <th scope="col"><i class="fas fa-ticket-alt"></i> Nome do Cupom</th>
                                <th scope="col"><i class="fab fa-slack-hash"></i> Usado</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($tokens as $chave => $valor): ?>
                                <tr>
                                    <th scope="row"><?= $valor['fk_cliente'] ?></th>
                                    <td><?= $valor['nome'] ?></td>
                                    <td><?= $valor['nome_cartao'] ?></td>
                                    <td>
                                        <?php if ($valor['usado'] == 0): ?>
                                            <h5><span class="badge badge-success">Disponivel</span></h5>
                                        <?php else: ?>
                                            <h5><span class="badge badge-danger">Ja utilizado</span></h5>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-6 offset-3 text-warning text-center">
                                <i class="fas fa-exclamation-triangle fa-5x"></i>
                                <h3 class="mt-3">Nenhuma informacao para exibir</h3>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>





<?php include "classes/footer.php" ?>

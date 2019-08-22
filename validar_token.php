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
        <div class="col">
            <div class="card text-left mt-3">
                <div class="card-body">
                    <h4 class="card-title text-center">Validar Token</h4>
                    <div class="row">
                        <div class="col">
                            <form class="" id="formVerificarToken" method="post">
                                <div class="form-group">
                                    <input type="hidden" name="formVerificarToken" value="formVerificarToken">
                                    <input type="text"
                                           class="form-control form-control-lg" name="token" id="inputToken"
                                           aria-describedby="helpId" placeholder="Digite o token do cliente...">
                                    <button class="btn btn-block btn-success btn-lg mt-3" type="submit"><i
                                                class="fas fa-search"></i> Verificar
                                    </button>
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
            <div class="card">
                <h5 class="card-header">Clientes</h5>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>



<?php include "classes/footer.php" ?>

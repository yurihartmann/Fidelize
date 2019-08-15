<?php

require_once "classes/registro_cartaofidelidade.class.php";

$registros = new registro_cartaoFidelidade();
$registros = $registros->clientesPorLojaLimit10(1);

// INCLUINDO NAVBAR
$ativo = "registro_clientes";
include "include/navbar.php";
?>

<div class="container" style="margin-top: 70px; margin-bottom: 70px;">
    <?php getAlerta(); ?>
    <div class="row">
        <div class="col mt-3">
            <a class="btn btn-lg btn-success" href="novo_registro.php">Novo registro</a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <div class="card">
                <h5 class="card-header">Registro dos Clientes</h5>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Numero</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Nome do Cupom</th>
                            <th scope="col">Andamento</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($registros as $chave => $valor): ?>
                            <tr>
                                <th scope="row"><?= $valor['numero'] ?></th>
                                <td><?= $valor['nome'] ?></td>
                                <td><?= $valor['nome_cartao'] ?></td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                             style="width: <?= $valor['andamento'] ?>0%" aria-valuenow="30"
                                             aria-valuemin="0" aria-valuemax="100"><?= $valor['andamento'] ?>/10
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "classes/footer.php" ?>

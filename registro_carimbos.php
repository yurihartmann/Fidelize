<?php

require_once "classes/registro_cartaofidelidade.class.php";

$registros = new registro_cartaoFidelidade();
$registros = $registros->clientesPorLojaLimit10(1);

// INCLUINDO NAVBAR
$ativo = "registro_carimbo";
include "include/navbar.php";
?>

<div class="container" style="margin-top: 70px; margin-bottom: 70px;">
    <?php getAlerta(); ?>
    <div class="row">
        <div class="col mt-3">
            <a class="btn btn-lg btn-primary" href="novo_carimbo.php"><i class="fas fa-plus-circle"></i> Novo Carimbo</a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <div class="card">
                <h5 class="card-header">Registros Carimbos</h5>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col"><i class="fas fa-phone-alt"></i> Numero</th>
                            <th scope="col"><i class="fas fa-user"></i> Cliente</th>
                            <th scope="col"><i class="fas fa-ticket-alt"></i> Nome do Cupom</th>
                            <th scope="col" class="text-center"><i class="fas fa-running"></i> Andamento</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($registros as $chave => $valor): ?>
                            <tr>
                                <th scope="row"><?= $valor['numero'] ?></th>
                                <td> <img src="media/images/perfil_generico.jpg" height="22px" class="rounded-circle mx-3"> <?= $valor['nome'] ?></td>
                                <td><?= $valor['nome_cartao'] ?></td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                             style="width: <?php
                                             $ppv = 100/$valor['objetivo'];
                                             echo $ppv * $valor['count(fk_cliente)'];
                                             ?>%"
                                             aria-valuemin="0" aria-valuemax="100"><?= $valor['count(fk_cliente)'] ?>/<?= $valor['objetivo'] ?>
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

<?php

require_once "classes/registro_cartaofidelidade.class.php";

$registros = new registro_cartaoFidelidade();
$registros = $registros->clientesPorLoja($_SESSION['empresa_id']);

// INCLUINDO NAVBAR
$ativo = "registro_carimbo";
include "include/navbar.php";
?>

<div class="container" style="margin-top: 70px; margin-bottom: 70px;">
    <?php getAlerta(); ?>
    <div class="row">
        <div class="col text-center">
            <h1 class="font-weight-light p-5">Registros Carimbos</h1>
        </div>
    </div>
    <div class="row">
        <div class="col mt-3">
            <a class="btn btn-lg btn-orange" href="novo_carimbo.php"><i class="fas fa-plus-circle"></i> Novo Carimbo</a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <?php if (!is_null($registros[0]['numero'])): ?>
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
                        <?php foreach ($registros as $chave => $valor):
                            $ppv = 100/$valor['objetivo'];
                            $porcentagem = $ppv * $valor['count(fk_cliente)'];
                            ?>
                            <tr>
                                <th scope="row"><?= $valor['numero'] ?></th>
                                <td><?= $valor['nome'] ?></td>
                                <td><?= $valor['nome_cartao'] ?></td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar <?=( $porcentagem >= 70 ? 'progress-bar-striped':'' )?> <?=( $porcentagem == 100 ? 'bg-dark-orange':'bg-soft-orange' )?>" role="progressbar"
                                             style="width: <?=$porcentagem?>%"
                                             aria-valuemin="0" aria-valuemax="100"><?= $valor['count(fk_cliente)'] ?>/<?= $valor['objetivo'] ?>
                                        </div>
                                    </div>
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

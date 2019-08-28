<?php

require_once "classes/registro_cartaofidelidade.class.php";

$registros = new registro_cartaoFidelidade();
$registros = $registros->clientesPorLojaLimit10($_SESSION['empresa_id']);


// INCLUINDO NAVBAR
$ativo = "dashboard";
include "include/navbar.php";
?>

<div class="container" style="margin-top: 70px; margin-bottom: 70px;">
    <?php getAlerta(); ?>
    <div class="row">
        <div class="col text-center">
            <h1 class="font-weight-light p-5">Dashboard - <?=$_SESSION['empresa_nome']?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card text-white bg-orange m-1 mt-3 text-center shadow h-75">
                <div class="card-body">
                    <h3 class="card-title font-weight-light"><i class="fas fa-users"></i> Clientes Fidelizados</h3>
                    <p class="card-text font-weight-light" id="painel_clientes_fidelizados"><span class="spinner-border spinner-border-sm" role="status"
                                               aria-hidden="true"></span></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card text-white bg-orange m-1 mt-3 text-center shadow h-75">
                <div class="card-body">
                    <h3 class="card-title font-weight-light"><i class="fas fa-ticket-alt"></i> Cupons Abertos</h3>
                    <p class="card-text font-weight-light" id="painel_cupons_ativos"><span class="spinner-border spinner-border-sm" role="status"
                                               aria-hidden="true"></span></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card text-white bg-orange m-1 mt-3 text-center shadow h-75">
                <div class="card-body">
                    <h3 class="card-title font-weight-light"><i class="fas fa-check-circle"></i> Cupons Completos</h3>
                    <p class="card-text font-weight-light" id="painel_cupons_completados"><p>
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col">
            <div class="card shadow">
                <h5 class="card-header">Registros Carimbos</h5>
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
                    <a href="registro_carimbos.php" class="btn btn-outline-dark float-right">Ver Tudo</a>
                    <?php else: ?>
                    <div class="row">
                        <div class="col-6 offset-3 text-warning text-center">
                            <i class="fas fa-exclamation-triangle fa-5x"></i>
                            <h3 class="mt-3">Nenhuma informação para exibir</h3>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "classes/footer.php" ?>



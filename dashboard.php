<?php

require_once "classes/registro_cartaofidelidade.php";

$registros = new registro_cartaofidelidade();
$dados = $registros->clientesPorLojaLimit10($_SESSION['empresa_id']);

$dados_grafico = array_reverse($registros->desempenhoSemanal());
//echo "<pre>";
//die(var_dump($dados_grafico));

include "include/header.php";

// INCLUINDO NAVBAR
$ativo = "dashboard";
include "include/navbar.php";
?>

<div class="container" style="margin-top: 70px; margin-bottom: 70px;">
    <?php getAlerta(); ?>
    <div class="row">
        <div class="col text-center">
            <h1 class="font-weight-light p-5">Dashboard - <?= $_SESSION['empresa_nome'] ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="text-white bg-orange m-1 p-1 mt-3 text-center shadow h-75">
                <div class="card-body">
                    <h3 class="card-title font-weight-light"><i class="fas fa-users"></i> Clientes Fidelizados</h3>
                    <p class="card-text font-weight-light" id="painel_clientes_fidelizados"><span
                                class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true"></span></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="text-white bg-orange m-1 p-1 mt-3 text-center shadow h-75">
                <div class="card-body">
                    <h3 class="card-title font-weight-light"><i class="fas fa-ticket-alt"></i> Cartões Abertos</h3>
                    <p class="card-text font-weight-light" id="painel_cupons_ativos"><span
                                class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true"></span></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="text-white bg-orange m-1 p-1 mt-3 text-center shadow h-75">
                <div class="card-body">
                    <h3 class="card-title font-weight-light"><i class="fas fa-check-circle"></i> Cartões Completos</h3>
                    <p class="card-text font-weight-light" id="painel_cupons_completados">
                    <p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="shadow bg-white">
                <div class="row">
                    <div class="col text-center pt-5">
                        <h1 class="font-weight-light">Desempenho da Semana</h1><small> (7 dias atrás)</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="" id="curve_chart" style="width: 100%; height: 500px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="mb-1 shadow bg-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-5">
                            <strong><i class="fas fa-phone"></i> Número</strong>
                        </div>
                        <div class="col-3 d-none d-md-block">
                            <strong>Nome</strong>
                        </div>
                        <div class="col-md-3 col-4 text-center">
                            <strong>Cartões</strong>
                        </div>
                        <div class="col-3 text-center">
                            <strong>Progressão</strong>
                        </div>
                    </div>
                </div>
            </div>
            <?php foreach ($dados as $chave => $valor):
                $ppv = 100 / $valor['objetivo'];
                $porcentagem = $ppv * $valor['count(fk_cliente)'];

                if (empty($valor['nome']))
                    $valor['nome'] = "Usuário Temporário";
                ?>

                <div class="bg-white mb-1 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-5">
                                <?= formatacaoCelular($valor['numero']) ?><br>
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
                                <?= limitaTexto(30,$valor['nome']) ?>
                            </div>
                            <div class="col-md-3 col-4 text-center">
                                <?= limitaTexto(40,$valor['nome_cartao']) ?>
                            </div>
                            <div class="col-3">
                                <div class="progress">
                                    <div class="progress-bar <?= ($porcentagem >= 70 ? 'progress-bar-striped' : '') ?> <?= ($porcentagem == 100 ? 'bg-dark-orange' : 'bg-soft-orange') ?>"
                                         role="progressbar"
                                         style="width: <?= $porcentagem ?>%"
                                         aria-valuemin="0" aria-valuemax="100"><?= $valor['count(fk_cliente)'] ?>
                                        /<?= $valor['objetivo'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
                    <a href="registro_carimbos.php" class="btn btn-outline-secondary float-right mt-2">Ver Tudo</a>
        </div>

    </div>

    <script type="text/javascript" src="media/js/chart_google.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Dia', 'Número de Carimbos Registrados'],
                <?php
                    foreach ($dados_grafico as $chave => $valor){
                        echo "['" . formatacaoData($valor['dia']) . " ' , " .  $valor['count'] . "]";
                        if ($chave != 6 ){
                            echo ",";
                        }
                    }
                ?>
            ]);

            var options = {
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>

    <?php include "include/footer.php" ?>



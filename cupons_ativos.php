<?php

require_once "classes/session.class.php";

$session = new Session();

include "include/navbar.php";

include "include/footer.php";


// INCLUINDO NAVBAR
$ativo = "cupons_ativos";
include "include/navbar.php";
?>

<div class="container" style="margin-top: 70px;">
    <?php include "include/alerta.php" ?>
    <div class="row">
        <div class="col-12 col-lg-4 mt-3">
            <div class="card">
                <!--                <img src="..." class="card-img-top" alt="...">-->
                <div class="bg-dark text-center text-white pt-5" style="height: 200px; width: 100%;">Capa do cupom</div>
                <div class="card-body">
                    <h5 class="card-title">Natal Maravilhoso - Padaria</h5>
                    <p class="card-text">Venha deliciar os doces e salgados da padaria da esquina e com bonus e com
                        sorteios incrivel</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Objetivo: </strong> 10</li>
                    <li class="list-group-item"><strong>Premio:</strong> Torta de chocolate</li>
                    <li class="list-group-item"><strong>Data Inicio:</strong> DD/MM/AAAA</li>
                    <li class="list-group-item"><strong>Data Final:</strong> DD/MM/AAAA</li>
                </ul>
                <div class="card-body">
                    <div class="btn-group btn-block">
                        <button class="btn btn-outline-primary">Editar</button>
                        <button class="btn btn-outline-danger">Excluir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

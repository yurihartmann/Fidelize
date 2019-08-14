<?php

require_once "classes/session.class.php";

$session = new Session();


include "include/footer.php";

// INCLUINDO NAVBAR
$ativo = "dashboard";
include "include/navbar.php";
?>

<body class="bg-light">
<div class="container" style="margin-top: 70px;">
    <?php include "include/alerta.php" ?>
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card text-white bg-primary m-1 mt-3 text-center">
                <div class="card-body">
                    <h3 class="card-title"><i class="fas fa-users"></i> Clientes Fidelizados</h3>
                    <p class="card-text"><span class="spinner-border spinner-border-sm" role="status"
                                               aria-hidden="true"></span></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card text-white bg-warning m-1 mt-3 text-center">
                <div class="card-body">
                    <h3 class="card-title"><i class="fas fa-ticket-alt"></i> Cupons Abertos</h3>
                    <p class="card-text"><span class="spinner-border spinner-border-sm" role="status"
                                               aria-hidden="true"></span></p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card text-white bg-success m-1 mt-3 text-center">
                <div class="card-body">
                    <h3 class="card-title"><i class="fas fa-check-circle"></i> Cupons Completados</h3>
                    <h2 class="card-text font-weight-light">34</h2>
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col">
            <div class="card">
                <h5 class="card-header">Clientes</h5>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Numero</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Cupons</th>
                            <th scope="col">Andamento</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 30%" aria-valuenow="30"
                                         aria-valuemin="0" aria-valuemax="100">3/10
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50"
                                         aria-valuemin="0" aria-valuemax="100">5/10
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th scope="row">6</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th scope="row">7</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th scope="row">8</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">9</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">10</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-outline-dark float-right">Ver Tudo</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>


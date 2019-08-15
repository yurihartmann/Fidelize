<?php

require_once "classes/registro_cartaofidelidade.class.php";

$registros = new registro_cartaoFidelidade();
$registros = $registros->clientesPorLojaLimit10(1);

// INCLUINDO NAVBAR
$ativo = "validar_token";
include "include/navbar.php";
?>


<body class="bg-light">
<div class="container" style="margin-top: 70px;">
    <div class="row">
        <div class="col">
            <div class="card text-left mt-5">
                <div class="card-body">
                    <h4 class="card-title text-center">Validar Token</h4>
                    <form>
                        <form class="form-inline">
                            <div class="form-group">
                                <input type="text"
                                       class="form-control form-control-lg" name="token" id="inputToken" aria-describedby="helpId" placeholder="Digite o token do cliente...">
                                <button class="btn btn-block btn-success btn-lg mt-3"><i class="fas fa-search"></i> Verificar</button>
                            </div>
                        </form>
                    </form>
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
                            <th scope="col">Nome do Cupom</th>
                            <th scope="col">Usado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>
                                <h5><span class="badge badge-danger">Ja utilizado</span></h5>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>
                                <h5><span class="badge badge-success">Disponivel</span></h5>
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

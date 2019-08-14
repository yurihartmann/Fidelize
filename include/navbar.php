<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark mb-3">
    <a class="navbar-brand" href=""><img src="media/images/FIDELIZE_BRANCO.png" height="45px"> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item <?=($ativo == "dashboard") ? "active" : "" ?>">
                <a class="nav-link" href="dashboard.php">Inicio</a>
            </li>
            <li class="nav-item d-none d-lg-block">
                <span class="nav-link">|</span>
            </li>
            <li class="nav-item <?=($ativo == "cupons_ativos") ? "active" : "" ?>">
                <a class="nav-link" href="cupons_ativos.php"><i class="fas fa-ticket-alt"></i> Cupons Ativos <span
                            class="badge badge-success">500</span></a>
            </li>
            <li class="nav-item d-none d-lg-block">
                <span class="nav-link">|</span>
            </li>
            <li class="nav-item <?=($ativo == "validar_cupom") ? "active" : "" ?>">
                <a class="nav-link" href="validar_token.php"><i class="far fa-calendar-check"></i> Validar Token</a>
            </li>
        </ul>
        <div class="dropdown">
            <a class="text-decoration-none" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
                <span class="text-white">NOME DA EMPRESA</span>
                <img src="media/images/perfil_generico.jpg" height="40px" class="rounded-circle mx-3">
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="configuracoes.php"><i class="fas fa-cogs"></i> Configuracoes</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt"></i> Sair</a>
            </div>
        </div>
    </div>
</nav>


<nav class="navbar fixed-bottom navbar-expand-md navbar-dark bg-secondary d-none d-md-block">
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">&copy; Fidelize</a>
            </li>
        </ul>
        <button class="btn btn-sm btn-info"><i class="fas fa-book"></i> Manual de Utilizacao</button>
        <button class="btn btn-sm btn-danger ml-3"><i class="fas fa-exclamation-triangle"></i> Reportar Erro</button>
    </div>
</nav>
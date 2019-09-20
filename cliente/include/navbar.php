<!--NAVBAR TOP DESKTOP-->

<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark-orange mb-3 d-none d-lg-block">
    <div>
        <a class="navbar-brand float-left" href="descubra.php"><img src="../media/images/fidelize_branco.png" height="35px"> </a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse pt-2" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item <?= ($ativo == "descubra") ? "active" : "" ?>">
                <a class="nav-link" href="descubra.php"><i class="fas fa-search"></i> Descubra</a>
            </li>
            <li class="nav-item d-none d-lg-block">
                <span class="nav-link">|</span>
            </li>
            <li class="nav-item <?= ($ativo == "meus_cartoes") ? "active" : "" ?>">
                <a class="nav-link" href="meus_cartoes.php"><i class="fas fa-ticket-alt"></i> Meus Cartões</a>
            </li>
            <li class="nav-item d-none d-lg-block">
                <span class="nav-link">|</span>
            </li>
            <li class="nav-item <?= ($ativo == "meus_tokens") ? "active" : "" ?>">
                <a class="nav-link" href="meus_tokens.php"><i class="fas fa-key"></i> Meus Tokens</a>
            </li>
            <li class="nav-item d-none d-lg-block">
                <span class="nav-link">|</span>
            </li>
            <li class="nav-item <?= ($ativo == "lista_avaliacao") ? "active" : "" ?>">
                <a class="nav-link" href="lista_avaliacao.php"><i class="fas fa-star"></i> Avaliação</a>
            </li>
        </ul>
        <div class="dropdown">
            <a class="text-decoration-none" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php if ($_SESSION['cliente_img'] != null && $_SESSION['cliente_img'] != '') : ?>
                    <img style="width: 35px; height: 35px" src="uploads/<?= $_SESSION['cliente_img'] ?>" class="rounded-circle mx-3 border-light">
                <?php else : ?>
                    <img src="../media/images/perfil_generico.jpg" style="width: 35px; height: 35px" class="rounded-circle mx-3 border-light">
                <?php endif; ?>
                <span class="text-white"><?= limitaTexto(30, ucfirst($_SESSION['cliente_nome'])) ?></span>
            </a>
            <div class="dropdown-menu rounded-0" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="configuracoes.php"><i class="fas fa-user"></i> <?= limitaTexto(30, ucfirst($_SESSION['cliente_nome'])) ?></a>
                <div class="dropdown-divider"></div>
                <form method="post">
                    <button class="dropdown-item text-danger" name="btnSair"><i class="fas fa-sign-out-alt"></i> Sair
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!--NAVBAR TOP MOBILE-->

<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark-orange mb-3 d-block d-lg-none">
    <div class="align-content-center">
        <a class="navbar-brand float-left" href="descubra.php"><img src="../media/images/fidelize_branco.png" height="45px"> </a>
    </div>
    <div class="dropdown float-right pt-2">
        <a class="text-decoration-none" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="text-white"><?= limitaTexto(20, ucfirst($_SESSION['cliente_nome'])) ?></span>
            <?php if ($_SESSION['cliente_img'] != null && $_SESSION['cliente_img'] != '') : ?>
                <img style="width:38.5px; height: 38.5px;" src="uploads/<?= $_SESSION['cliente_img'] ?>" class="rounded-circle mx-3 border-light">
            <?php else : ?>
                <img src="../media/images/perfil_generico.jpg" style="width: 38.5px; height: 38.5px" class="rounded-circle mx-3 border-light">
            <?php endif; ?>
        </a>
        <div class="dropdown-menu rounded-0" aria-labelledby="dropdownMenuLink1">
            <a class="dropdown-item" href="configuracoes.php"><i class="fas fa-user"></i> Meu Perfil</a>
            <div class="dropdown-divider"></div>
            <form method="post">
                <button class="dropdown-item text-danger" name="btnSair"><i class="fas fa-sign-out-alt"></i> Sair
                </button>
            </form>
        </div>
    </div>
</nav>

<!--NAVBAR FOOTER MOBILE-->
<nav class="fixed-bottom navbar-light bg-light d-lg-none d-block">
    <div class="row">
        <a href="descubra.php" class="col-3 nav-item text-center pb-3 px-2 pl-4" style="text-decoration: none">
            <i class="fas fa-search <?= ($ativo == "descubra") ? "menu-activated" : "menu-disable" ?>" style="margin-bottom: -10px"></i><br>
            <small><small class="text-decoration-none m-0 p-0 <?= ($ativo == "descubra") ? "menu-activated" : "menu-disable" ?>">Descubra</small></small>
        </a>
        <a href="meus_cartoes.php" class="col-3 nav-item text-center pb-3 px-2" style="text-decoration: none">
            <i class="fas fa-ticket-alt <?= ($ativo == "meus_cartoes") ? "menu-activated" : "menu-disable" ?>" style="margin-bottom: -10px"></i><br>
            <small><small class="text-decoration-none m-0 p-0 <?= ($ativo == "meus_cartoes") ? "menu-activated" : "menu-disable" ?>"> Meus Cartões</small></small>
        </a>
        <a href="meus_tokens.php" class="col-3 nav-item text-center pb-3 px-2" style="text-decoration: none">
            <i class="fas fa-key <?= ($ativo == "meus_tokens") ? "menu-activated" : "menu-disable" ?>" style="margin-bottom: -10px"></i><br>
            <small><small><small class="text-decoration-none m-0 p-0 <?= ($ativo == "meus_tokens") ? "menu-activated" : "menu-disable" ?>">Meus
                        Tokens</small></small></small>
        </a>
        <a href="lista_avaliacao.php" class="col-3 nav-item text-center pb-3 px-2 pr-4 <?= ($ativo == "lista_avaliacao") ? "menu-activated" : "menu-disable" ?>" style="text-decoration: none">
            <i class="fas fa-star " style="margin-bottom: -10px"></i><br>
            <small><small class="text-decoration-none m-0 p-0 <?= ($ativo == "lista_avaliacao") ? "menu-activated" : "menu-disable" ?>">Avaliação</small></small>
        </a>
    </div>
</nav>
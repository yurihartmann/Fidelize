<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand pr-3" href="index.php"><img id="ico" src="../media/images/fidelize_preto.png" height="35px"></a>
    <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item <?= (basename($_SERVER['PHP_SELF'], '.php') == 'index' ? 'active' : '') ?>">
                <a class="nav-link" href="index.php">Inicio<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active d-none d-lg-block">
                <span class="nav-link font-weight-light">|</span>
            </li>

            <li class="nav-item">


            <li class="nav-item <?= (basename($_SERVER['PHP_SELF'], '.php') == 'precos' ? 'active' : '') ?>">

                <a class="nav-link" href="index.php#precos">Preços</a>

            </li>
            <li class="nav-item active d-none d-lg-block">
                <span class="nav-link font-weight-light">|</span>
            </li>
            <li class="nav-item <?= (basename($_SERVER['PHP_SELF'], '.php') == 'suporte' ? 'active' : '') ?>">
                <a class="nav-link" href="suporte.php">Suporte</a>
            </li>
            <li class="nav-item active  d-none d-lg-block">
                <span class="nav-link font-weight-light">|</span>
            </li>
            <li class="nav-item <?= (basename($_SERVER['PHP_SELF'], '.php') == 'fidelizar' ? 'active' : '') ?>">
                <a class="nav-link" href="fidelizar.php">Quero Fidelizar</a>
            </li>
            <li class="nav-item active  d-none d-lg-block">
                <span class="nav-link font-weight-light">|</span>
            </li>
            <li class="nav-item <?= (basename($_SERVER['PHP_SELF'], '.php') == 'somos' ? 'active' : '') ?>">
                <a class="nav-link" href="somos.php">Quem somos</a>
            </li>
            </ul>
    </div>
    </ul>
    </div>
    <div class="float-right mr-3 d-none d-lg-block">
        <a href="../cliente/index.php" id="a" class="text-decoration-none"><span class="pr-2">Login</span></a>
        <a href="../cliente/cadastro.php" class="btn btn-orange rounded-0" style="width: 160px;"><strong>Cadastrar-se</strong></a>
    </div>
</nav>
<div class="container-flex d-block  d-lg-none">
    <div class="row m-0  fixed-bottom px-2 py-3 bg-light">
        <div class="col m-0">
            <a href="../cliente/index.php" class="btn btn-orange btn-block">Login</a>
        </div>
        <div class="col m-0">
            <a href="../cliente/cadastro.php" class="btn btn-orange btn-block">Cadastrar-se</a>
        </div>
    </div>
</div>
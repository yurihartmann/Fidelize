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
    <div class="row">
        <div class="col">
            <div class="card text-left">
                <div class="card-body">
                    <h4 class="card-title text-center">Validar Token</h4>
                    <form>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

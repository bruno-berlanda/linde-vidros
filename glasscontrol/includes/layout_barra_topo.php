<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top">

    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <?php if ($loginSysLG) { ?>
        <a href="solicitacoes-nova.php" class="btn btn-success ml-2<?php if (!$permSolicitacao) { echo " disabled"; } ?>"><i class="fas fa-plus-circle"></i> NOVA SOLICITAÇÃO</a>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small text-uppercase"><?php echo nomeUsuarioId($idUsuario); ?></span>
                <img class="img-profile rounded-circle" src="img/img-user.jpg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="perfil.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Perfil
                </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="funcoes/_logout.php">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Sair
                </a>
            </div>
        </li>
    </ul>
    <?php } ?>
</nav>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Menu Lateral - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="sys.php">
        <div class="sidebar-brand-icon">
            <i class="fas fa-server"></i>
        </div>

        <div class="sidebar-brand-text mx-3">GlassControl</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="sys.php">
        <i class="fas fa-home"></i>
        <span>Início</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php if ($permSolicitacao) { ?>
    <!-- Heading -->
    <div class="sidebar-heading">
        Cadastrar
    </div>

    <li class="nav-item">
        <a class="nav-link" href="solicitacoes-nova.php">
            <i class="fas fa-plus-circle"></i>
            <span>Nova Solicitação</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <?php } ?>
    <!-- Heading -->
    <div class="sidebar-heading">
        Consultar
    </div>

    <li class="nav-item">
        <a class="nav-link" href="solicitacoes.php?t=p">
            <i class="fas fa-play-circle"></i>
            <span>Solicitações Pendentes</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="solicitacoes.php?t=f">
            <i class="fas fa-check-circle"></i>
            <span>Solicitações Finalizadas</span>
        </a>
    </li>
    <!--
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRE" aria-expanded="true" aria-controls="collapseRE">
            <i class="fas fa-chart-bar"></i>
            <span>Relatórios</span>
        </a>
        <div id="collapseRE" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">MENU 1</h6>
                <a class="collapse-item" href="#">Menu 2</a>
                <a class="collapse-item" href="#">Menu 2</a>
                <a class="collapse-item" href="#">Menu 2</a>
            </div>
        </div>
    </li>
    -->

    <!-- Divider -->
    <hr class="sidebar-divider mt-3">

    <?php
    /**
     * PERMISSÃO PARA VISUALIZAR O MENU
     */
    if ($tipoUsuario === "A") {
        ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            Admin
        </div>

        <li class="nav-item">
            <a class="nav-link" href="cadastro-usuarios.php">
                <i class="fas fa-user"></i>
                <span>Usuários</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="cadastro-setores.php">
                <i class="fas fa-map-signs"></i>
                <span>Setores</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block mt-3">
        <?php
    }
    ?>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

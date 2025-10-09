<?php include "links.php"; ?>

<div class="container-fluid">
	<div class="row" id="menu">
    	<div class="col-md-12">
        	<div class="container">
            	<div class="row">
                    <div class="col-md-12 py-2">
                        <nav class="navbar navbar-expand-lg" id="navbar-menu-principal">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="<?php echo $l_home; ?>"><i class="fa-solid fa-house"></i></a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Empresa
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="<?php echo $l_empresa; ?>" title="Linde Vidros">A Linde Vidros</a></li>
                                                <li><a class="dropdown-item" href="<?php echo $l_gestao; ?>" title="Gestão de Pessoas">Gestão de Pessoas</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Produtos
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="<?php echo $l_engenharia; ?>" title="Engenharia">Engenharia</a></li>
                                                <li><a class="dropdown-item" href="<?php echo $l_moveleiro; ?>" title="Moveleiro">Moveleiro</a></li>
                                                <li><a class="dropdown-item" href="<?php echo $l_refrigeracao; ?>" title="Linha Refrigeração">Linha Refrigeração</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo $l_servicos; ?>" title="Serviços">Serviços</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo $l_contato; ?>" title="Contato">Contato</a>
                                        </li>
                                    </ul>
                                    <ul class="navbar-nav mb-2 mb-lg-0">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo $l_area; ?>" title="Área Restrita"><i class="fa-solid fa-lock fa-fw text-primary"></i> Área Restrita</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="https://ecommerce.lindevidros.com.br" target="_blank" title="E-commerce Linde Vidros"><i class="fa-solid fa-cart-shopping fa-fw text-primary"></i> E-commerce</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
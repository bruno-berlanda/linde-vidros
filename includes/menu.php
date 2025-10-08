<?php include "links.php"; ?>

<div class="container-fluid">
	<div class="row" id="menu">
    	<div class="col-md-12">
        	<div class="container">
            	<div class="row">
                    <div class="col-md-12">
						<nav class="navbar navbar-inverse">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                	<a class="navbar-brand" href="<?php echo $l_home; ?>"><i class="fas fa-home fa-sm"></i></a>
                                </div>
                            
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav">
                                    	<li class="dropdown">
                                        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Empresa <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?php echo $l_empresa; ?>" title="Linde Vidros">A Linde Vidros</a></li>
                                                <li><a href="<?php echo $l_gestao; ?>" title="Gestão de Pessoas">Gestão de Pessoas</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Produtos <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?php echo $l_engenharia; ?>" title="Engenharia">Engenharia</a></li>
                                                <li><a href="<?php echo $l_moveleiro; ?>" title="Moveleiro">Moveleiro</a></li>
                                                <li><a href="<?php echo $l_refrigeracao; ?>" title="Linha Refrigeração">Linha Refrigeração</a></li>
                                                <li><a href="<?php echo $l_acessorios; ?>" title="Acessórios">Acessórios</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="<?php echo $l_servicos; ?>" title="Serviços">Serviços</a></li>
                                        <li><a href="<?php echo $l_contato; ?>" title="Contato">Contato</a></li>
                                    </ul>
                                    <ul class="nav navbar-nav navbar-right">
                                    	<li><a href="<?php echo $l_area; ?>" title="Área Restrita"><i class="fas fa-lock fa-sm"></i> <span class="hidden-sm">Área Restrita</span></a></li>
                                        <li><a href="https://ecommerce.lindevidros.com.br" target="_blank" title="E-commerce Linde Vidros"><i class="fas fa-shopping-cart fa-sm"></i> <span class="hidden-sm">E-commerce</span></a></li>
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
<?php
$pg_atual = $_SERVER['REQUEST_URI'];
?>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        	<a class="navbar-brand" href="index.php" id="brand">Linde Vidros</a>
        </div>
    
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Início</a></li>
                <li><a href="dados.php">Meus Dados</a></li>
                <li><a href="projetos.php">Projetos</a></li>
                <?php
				if ($orcInsulado == "S") {
				?>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Orçamento <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="orcamentos_insulado.php">Vidro Insulado</a></li>
                    </ul>
                </li>
                <?php
				}
				?>
                <li><a href="promocoes.php">Promoções</a></li>
                <?php
				if ($wkUsuario == "S") {
				?>
                <li><a href="pedidos.php">Pedidos</a></li>
                <?php
				}
				?>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ferramentas <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="meucadastro.php">Meu cadastro</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                        <li><a href="relatar.php">Relatar Erro</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><p class="navbar-text"><a href="funcoes/logout.php" class="btn btn-danger btn-xs" title="Sair"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>  SAIR</a></p></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        	<a class="navbar-brand" id="brand"><?php echo primeiro_nome($nome_usuario); ?></a>
        </div>
    
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="repsys.php"><i class="fas fa-home"></i></a></li>
                <?php if ($p_croquis == "S") { ?>
                <li><a href="projetos.php">Projetos</a></li>
                <?php } ?>
                <?php if ($p_promocoes == "S") { ?>
                <li><a href="promocoes.php">Promoções</a></li>
                <?php } ?>
                <?php if ($p_tabelas == "S" || $p_materiais == "S" || $p_procedimentos == "S" || $p_normas == "S") { ?>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Materiais <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php if ($p_tabelas == "D") { ?><li><a href="tabelas.php">Tabelas</a></li><?php } ?>
						<?php if ($p_materiais == "S") { ?><li><a href="divulgacao.php">Divulgação</a></li><?php } ?>
                        <?php if ($p_procedimentos == "S") { ?><li><a href="procedimentos.php">Procedimentos</a></li><?php } ?>
                        <?php if ($p_normas == "S") { ?><li><a href="normas.php">Normas</a></li><?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <?php if ($p_diario == "S" || $p_diario_gerente == "S") { ?>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Diário <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="diario-novo.php">Novo</a></li>
                        <li><a href="diario-gerenciar.php">Visualizar</a></li>
                    </ul>
                </li>
                <?php } ?>
                <?php if ($p_insulado == "S") { ?>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Orçamento <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="orcamentos_insulado.php">Vidro Insulado</a></li>
                    </ul>
                </li>
                <?php } ?>
                <?php if ($p_pedmov_solicitar == "S" || $p_pedmov_gerenciar == "S") { ?>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Moveleiro <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="moveleiro-pedido-novo.php">Novo Pedido</a></li>
                        <li><a href="moveleiro-gerenciar-pedidos.php">Gerenciar Pedidos</a></li>
                    </ul>
                </li>
                <?php } ?>
                <?php if ($p_agenda == "V") { ?>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Agenda <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Teste</a></li>
                    </ul>
                </li>
                <?php } ?>
                <?php if ($p_metas == "V") { ?>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Metas <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Teste</a></li>
                    </ul>
                </li>
                <?php } ?>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ferramentas <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="meucadastro.php">Trocar Senha</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="configuracoes.php">Configurações</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><p class="navbar-text"><small><?php echo date ("d/m/y H:i"); ?></small></p></li>
                <li><p class="navbar-text"><a href="funcoes/logout.php" class="btn btn-danger btn-xs" title="Sair"><i class="fas fa-sign-out-alt"></i> SAIR</a></p></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
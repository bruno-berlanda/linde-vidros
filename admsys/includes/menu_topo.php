<?php
// Contatos
$con_contatos_total = mysqli_query ($conexao, "SELECT tipo FROM contato WHERE ativo='1'") or die (mysqli_error($conexao));
	$conta_contatos_total = mysqli_num_rows ($con_contatos_total);
	
$con_contatos = mysqli_query ($conexao, "SELECT tipo FROM contato WHERE lido='0' AND ativo='1'") or die (mysqli_error($conexao));
	$conta_contatos = mysqli_num_rows ($con_contatos);

// Cadastros
$con_cadastros_total = mysqli_query ($conexao, "SELECT id FROM clientes WHERE liberado='1'") or die (mysqli_error($conexao));
	$conta_cadastros_total = mysqli_num_rows ($con_cadastros_total);
	
$con_cadastros = mysqli_query ($conexao, "SELECT id FROM clientes WHERE liberado='0'") or die (mysqli_error($conexao));
	$conta_cadastros = mysqli_num_rows ($con_cadastros);
	
// Currículos
$con_curriculos_total = mysqli_query ($conexao, "SELECT nome FROM usuarios WHERE ativo='1' AND cadrh='N'") or die (mysqli_error($conexao));
	$conta_curriculos_total = mysqli_num_rows ($con_curriculos_total);
	
$con_curriculos = mysqli_query ($conexao, "SELECT nome FROM usuarios WHERE lido='0' AND atualizado!='0000-00-00' AND funcionario='N' AND ativo='1' AND cadrh='N'") or die (mysqli_error($conexao));
	$conta_curriculos = mysqli_num_rows ($con_curriculos);
	
// Promoções
$con_promocoes_total = mysqli_query ($conexao, "SELECT usuario FROM admin_promocoes") or die (mysqli_error($conexao));
	$conta_promocoes_total = mysqli_num_rows ($con_promocoes_total);
	
$con_promocoes = mysqli_query ($conexao, "SELECT usuario FROM admin_promocoes WHERE status='S'") or die (mysqli_error($conexao));
	$conta_promocoes = mysqli_num_rows ($con_promocoes);

/* *************************************************************************************************************************************************************************** */
/* *************************************************************************************************************************************************************************** */
/* *************************************************************************************************************************************************************************** */
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
        	<a class="navbar-brand" href="admsys.php" id="brand"><i class="fas fa-home"></i></a>
        </div>
    
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
				if ($perm_adm == "S" || $perm_rotas == "S" || $perm_promocoes == "S") {
				?>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php if ($perm_rotas == "S") { ?><li><a href="rotas.php">Rotas</a></li><?php } ?>
                        <?php if ($perm_promocoes == "S") { ?><li><a href="promocoes.php">Promoções <?php if ($conta_promocoes > 0) { ?><span class="badge"><?php echo $conta_promocoes; ?></span><?php } ?></a></li><?php } ?>
                        <?php if ($perm_adm == "S") { ?><li><a href="moveleiro_embalagens.php">Embalagens</a></li><?php } ?>
                    </ul>
                </li>
                <?php
				}
				?>
                
                <?php
				if ($perm_produtos == "S") {
				?>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Produtos <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="produtos_ferragens.php">Ferragens</a></li>
                        <li><a href="produtos_aluminios.php">Alumínios</a></li>
                    </ul>
                </li>
                <?php
				}
				?>
                
                <?php
				if ($perm_slides == "S" || $perm_contatos == "S" || $perm_comentarios == "S" || $perm_cadastros == "S" || $perm_pesquisa == "S" || $perm_tags == "S") {
				?>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Website <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php if ($perm_slides == "S") { ?><li><a href="slides.php">Slides</a></li><?php } ?>
						<?php if ($perm_contatos == "S") { ?><li><a href="contatos.php">Contatos <?php if ($conta_contatos > 0) { ?><span class="badge"><?php echo $conta_contatos; ?></span><?php } ?></a></li><?php } ?>
                        <?php if ($perm_comentarios == "S") { ?><li><a href="comentarios.php">Comentários</a></li><?php } ?>
                        <?php if ($perm_cadastros == "S") { ?><li><a href="cadastros.php">Cadastros</a></li><?php } ?>
                        <?php if ($perm_pesquisa == "S") { ?><li><a href="pesquisa.php">Pesquisa</a></li><?php } ?>
                        <?php if ($perm_tags) { ?><li><a href="tags.php">Tags</a></li><?php } ?>
                    </ul>
                </li>
                <?php
				}
				?>
                
                <?php
				if ($perm_curriculos == "S" || $perm_vagas == "S") {
				?>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Currículos <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php if ($perm_curriculos == "S") { ?><li><a href="curriculos.php">Currículos <?php if ($conta_curriculos > 0) { ?><span class="badge"><?php echo $conta_curriculos; ?></span><?php } ?></a></li><?php } ?>
                        <?php if ($perm_curriculos == "S") { ?><li><a href="entrevistas.php">Entrevistas</a></li><?php } ?>
                        <?php if ($perm_vagas == "S") { ?><li><a href="vagas.php">Vagas</a></li><?php } ?>
                        <?php if ($perm_curriculos == "D") { ?><li role="separator" class="divider"></li><?php } ?>
                        <?php if ($perm_curriculos == "D") { ?><li><a href="curriculos_pesquisar_termo.php">Pesquisar Termo</a></li><?php } ?>
                        <?php if ($perm_curriculos == "D") { ?><li><a href="curriculos_pesquisar_setor.php">Pesquisar Setor</a></li><?php } ?>
                    </ul>
                </li>
                <?php
				}
				?>
                
                <?php
				if ($perm_usuarios == "S" || $perm_niveis == "S" || $perm_representantes == "S") {
				?>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administração <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php if ($perm_usuarios == "S") { ?><li><a href="usuarios.php">Usuários</a></li><?php } ?>
                        <?php if ($perm_niveis == "S") { ?><li><a href="niveis.php">Níveis</a></li><?php } ?>
                        <?php if ($perm_usuarios == "S" && $perm_representantes == "S" || $perm_niveis == "S" && $perm_representantes == "S") { ?><li role="separator" class="divider"></li><?php } ?>
                        <?php if ($perm_representantes == "S") { ?><li><a href="representantes.php">Representantes</a></li><?php } ?>
                    </ul>
                </li>
                <?php
				}
				?>
                
                <?php
				if ($perm_adm == "S" || $perm_curriculos == "S" || $perm_cadastros == "S" || $perm_representantes == "S") {
				?>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sistema <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php if ($perm_adm == "S") { ?><li><a href="acesso_sistema.php">Acesso Sistema</a></li><?php } ?>
                        <?php if ($perm_curriculos == "S" || $perm_cadastros == "S" || $perm_representantes == "S") { ?><li><a href="acesso_restrito.php">Acesso Restrito</a></li><?php } ?>
                    </ul>
                </li>
                <?php
				}
				?>
                
                <?php
				if ($perm_arquivos == "S") {
				?>
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Arquivos <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php if ($perm_arquivos == "S") { ?><li><a href="arquivos_representantes.php">Representantes</a></li><?php } ?>
                    </ul>
                </li>
                <?php
				}
				?>
                
                <li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ferramentas <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="meucadastro.php">Meu Cadastro</a></li>
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
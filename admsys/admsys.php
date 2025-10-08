<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_sistema.php");
include_once ("includes/usuario_logado.php");
include_once ("includes/cabecalho_inicial.php");
?>

<body>

<?php include_once ("includes/menu_topo.php"); ?>

<div class="container-fluid" id="conteudo">

<div class="row" id="titulo">
	<div class="col-md-12">
    	<h1>Painel de Administração</h1>
    </div>
</div>

<?php
include_once("includes/msgs.php");
?>

<div class="row">
	<div class="col-xs-6 col-md-3">
    	<div class="panel panel-default">
            <div class="panel-body">
            	<p class="text-muted text-center" id="estatistica-home"><i class="fas fa-envelope"></i></p>
                <p class="text-muted text-center"><small>CONTATOS</small></p>
                <p class="text-muted text-center" id="estatistica-home"><?php echo $conta_contatos; ?></p>
            </div>
        	<div class="panel-footer text-center"><span class="text-muted"><small><?php echo $conta_contatos_total; ?></small></span></div>
        </div>
    </div>
    <div class="col-xs-6 col-md-3">
    	<div class="panel panel-default">
            <div class="panel-body">
            	<p class="text-muted text-center" id="estatistica-home"><i class="fas fa-industry"></i></p>
                <p class="text-muted text-center"><small>CADASTROS</small></p>
                <p class="text-muted text-center" id="estatistica-home"><?php echo $conta_cadastros; ?></p>
            </div>
        	<div class="panel-footer text-center"><span class="text-muted"><small><?php echo $conta_cadastros_total; ?></small></span></div>
        </div>
    </div>
    <div class="col-xs-6 col-md-3">
    	<div class="panel panel-default">
            <div class="panel-body">
            	<p class="text-muted text-center" id="estatistica-home"><i class="fas fa-user"></i></p>
                <p class="text-muted text-center"><small>CURRÍCULOS</small></p>
                <p class="text-muted text-center" id="estatistica-home"><?php echo $conta_curriculos; ?></p>
            </div>
        	<div class="panel-footer text-center"><span class="text-muted"><small><?php echo $conta_curriculos_total; ?></small></span></div>
        </div>
    </div>
    <div class="col-xs-6 col-md-3">
    	<div class="panel panel-default">
            <div class="panel-body">
            	<p class="text-muted text-center" id="estatistica-home"><i class="fas fa-tags"></i></p>
                <p class="text-muted text-center"><small>PROMOÇÕES</small></p>
                <p class="text-muted text-center" id="estatistica-home"><?php echo $conta_promocoes; ?></p>
            </div>
        	<div class="panel-footer text-center"><span class="text-muted"><small><?php echo $conta_promocoes_total; ?></small></span></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
    	<?php
		if ($perm_adm == "S" || $perm_curriculos == "S" || $perm_vagas == "S") {
			
			$consulta_inscritos = mysqli_query ($conexao, "SELECT id_vaga, candidato, data FROM vagas_inscritos WHERE candidato!='2180' ORDER BY id DESC LIMIT 10") or die (mysqli_error());
		?>
        <div class="panel panel-primary">
        	<div class="panel-heading"><i class="fas fa-bell"></i> Inscrições para Vagas</div>
            <div class="panel-body">
            	<span class="text-muted">Últimos inscritos para as vagas em aberto</span>
        	</div>
            <div class="table-responsive">
                <table class="table table-condensed table-striped">
                	<thead>
                    	<tr>
                        	<th>DATA</th>
                            <th>CANDIDATO</th>
                            <th>VAGA</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
        <?php	
			while ($dados = mysqli_fetch_array ($consulta_inscritos)) {
				$id_vaga = $dados['id_vaga'];
				$id_candidato = $dados['candidato'];
				$data_vaga = $dados['data'];
				
				$consulta_vagas = mysqli_query ($conexao, "SELECT id_vaga FROM vagas_criadas WHERE id='$id_vaga'") or die (mysqli_error());
					$dados = mysqli_fetch_array ($consulta_vagas);
						$id_vaga = $dados['id_vaga'];
				
				$consultaNomeVaga = mysqli_query ($conexao, "SELECT vaga FROM vagas WHERE id='$id_vaga'") or die (mysqli_error());
					$dados = mysqli_fetch_array ($consultaNomeVaga);
						$nome_vaga = $dados['vaga'];
				
				$consultaNomeCandidato = mysqli_query ($conexao, "SELECT nome FROM usuarios WHERE id='$id_candidato'") or die (mysqli_error());
					$dados = mysqli_fetch_array ($consultaNomeCandidato);
						$nome_candidato = $dados['nome'];
						
				$data_vaga = substr($data_vaga,8,2) . "/" .substr($data_vaga,5,2) . "/" . substr($data_vaga,0,4);
		?>    
						<tr>
                        	<td><?php echo $data_vaga; ?></td>
                            <td><?php echo $nome_candidato; ?></td>
                            <td><?php echo $nome_vaga; ?></td>
                            <td><a href="curriculos_ver.php?curriculo=<?php echo $id_candidato; ?>" class="btn btn-default btn-xs btn-block"><i class="fas fa-search"></i></a></td>
                        </tr>            
        <?php
			}
		?>
        			</tbody>
        		</table>
        	</div>
        </div>
        <?php
		}
		?>
    </div>
    <div class="col-md-6">
    	<?php
		if ($perm_adm == "S" || $perm_promocoes == "S") {

		$consulta_promocoes = mysqli_query ($conexao, "SELECT id, titulo, imagem1, finalizar FROM admin_promocoes WHERE status='S' ORDER BY data DESC") or die (mysqli_error());
		$conta_promocoes = mysqli_num_rows ($consulta_promocoes);
		?>
        <div class="panel panel-primary">
        	<div class="panel-heading"><i class="fas fa-tags"></i> &nbsp; Promoções</div>
            <div class="panel-body">
        <?php
		if ($conta_promocoes == 0) {
		?>
        <span class="text-danger"><i class="fas fa-exclamation-triangle fa-lg"></i> Nenhuma promoção ativa no momento</span>
		<?php
		}
		else {
			while ($dados = mysqli_fetch_array ($consulta_promocoes)) {
				$id_promo 			= $dados['id'];
				$titulo_promo 		= $dados['titulo'];
				$imagem_promo 		= $dados['imagem1'];
				$finalizar_promo 	= $dados['finalizar'];
				
				$finalizar = substr($finalizar_promo,8,2) . "/" .substr($finalizar_promo,5,2) . "/" . substr($finalizar_promo,0,4);
		?>
			<p><img src="../imagens/promocoes/<?php echo $imagem_promo; ?>" alt="<?php echo $titulo_promo; ?>" class="img-responsive img-rounded"></p>
			
			<p>
			<?php
			if ($finalizar_promo == $data_hoje) {
			?>
			<p class="lead text-center">FINALIZAR A PROMOÇÃO HOJE!</p>
			<?php
			}
			else {
			?>
			<p class="text-center"><strong>FINALIZAR A PROMOÇÃO DIA <span class="text-info"><?php echo $finalizar; ?></span></strong></p>
			<?php	
			}
			?>
			</p>
			
			<?php
			if ($perm_adm == "S") {
			?>
			<p><a href="funcoes/promocoes.php?funcao=desativar&id=<?php echo $id_promo; ?>" class="btn btn-block btn-danger" onClick="return confirm('Tem certeza que deseja finalizar a promoção <?php echo $titulo_promo; ?>?')">Finalizar Promoção (<?php echo $titulo_promo; ?>)</a></p>
			
			<hr>
			<?php
			}
			?>
		<?php
			}
		}
		?>
        	</div>
        </div>
        <?php		
		}
		?>
        
        <div class="panel panel-primary">
        	<div class="panel-heading"><i class="fas fa-map-signs"></i> &nbsp; Rotas</div>
            <div class="panel-body">
            	<form method="get" action="admsys.php">
                    <div class="form-group form-group-sm">
                    	<label for="selectCidade">Cidade</label>
                    	<select name="cidade" class="form-control" id="selectCidade" onChange="submit()">
                        	<option></option>
                            <?php
							$consulta_cidades = mysqli_query ($conexao, "SELECT cidade, uf FROM admin_cidades WHERE ativo='1' GROUP BY cidade ORDER BY cidade") or die (mysqli_error());
							
							while ($dados_cidade = mysqli_fetch_array ($consulta_cidades)) {
								$nome_cidade 	= $dados_cidade['cidade'];
								$nome_uf 		= $dados_cidade['uf'];
							?>
                            <option value="<?php echo $nome_cidade; ?>"<?php if ($_GET['cidade'] == $nome_cidade) { echo " selected"; } ?>><?php echo $nome_cidade; ?> / <?php echo $nome_uf; ?></option>
                            <?php
							}
							?>
                        </select>
                    </div>
                </form>
                
                <?php
				if (isset($_GET['cidade'])) {
					$cidade_consulta = $_GET['cidade'];
				?>
                	<hr>
                    
                    <table class="table table-condensed">
                    	<tbody>
				<?php
					$consulta_rotas = mysqli_query ($conexao, "SELECT id_rota FROM admin_cidades WHERE cidade='$cidade_consulta'") or die (mysqli_error());
					while ($dados_rotas = mysqli_fetch_array ($consulta_rotas)) {
						$rota_id = $dados_rotas['id_rota'];
						
						$consulta_vendedor = mysqli_query ($conexao, "SELECT a.rota, a.produto, b.nome, b.email, b.fone1
														  FROM
														  admin_rotas a, representantes b
														  WHERE
														  a.id='$rota_id' AND a.vendedor=b.id
														  ") or die (mysqli_error());
							$dados_vendedor = mysqli_fetch_array ($consulta_vendedor);
								$rota_numero 	= $dados_vendedor['rota'];
								$rota_segmento 	= $dados_vendedor['produto'];
								$rota_vendedor 	= $dados_vendedor['nome'];
								$rota_email 	= $dados_vendedor['email'];
								$rota_fone 		= $dados_vendedor['fone1'];
								
								switch ($rota_segmento) {
									case "ENG":
										$cor_rota = "label-success";
										break;
									case "MOV":
										$cor_rota = "label-danger";
										break;	
								}
				?>
							<tr>
                            	<td><span class="label <?php echo $cor_rota; ?>"><?php echo $rota_numero; ?></span></td>
                                <td class="text-muted"><?php echo $rota_segmento; ?></td>
                                <td><strong><?php echo nome_sobrenome($rota_vendedor); ?></strong></td>
                                <td class="text-muted"><?php echo $rota_fone; ?></td>
                                <td class="text-muted"><?php echo $rota_email; ?></td>
                            </tr>
                <?php
					}
				?>
                		</tbody>
                    </table>
                <?php
				}
				?>
            </div>
        </div>
        
        <?php
		// Relatório de Erros
		$sql_erros_curriculos = mysqli_query ($conexao, "SELECT * FROM erros_curriculos WHERE status='P' ORDER BY data DESC") or die (mysqli_error());
			$conta_erros_curriculos = mysqli_num_rows ($sql_erros_curriculos);
		
		$sql_erros_cliente = mysqli_query ($conexao, "SELECT * FROM erros_cliente WHERE status='P' ORDER BY data DESC") or die (mysqli_error());
			$conta_erros_cliente = mysqli_num_rows ($sql_erros_cliente);
		
		if ($conta_erros_curriculos >= 1 && $perm_adm == "S" || $conta_erros_cliente >= 1 && $perm_adm == "S") {
		?>
		<div class="panel panel-danger">
        	<div class="panel-heading"><i class="fas fa-fire"></i> Relatório de Erros</div>
            <div class="panel-body">
		
		<?php	
			if ($conta_erros_curriculos >= 1) {
		?>
				<p class="lead">Currículos</p>
		<?php
				while ($dados = mysqli_fetch_array ($sql_erros_curriculos)) {
					
					$cur_id 		= $dados['id'];
					$cur_usuario 	= $dados['id_usuario'];
					$cur_data 		= $dados['data'];
					$cur_descricao 	= $dados['descricao'];
					
					$cur_data = date('d/m/y H:i', strtotime($cur_data));
					
					$sql_usuario = mysqli_query ($conexao, "SELECT nome FROM usuarios WHERE id='$cur_usuario'") or die (mysqli_error());
						$dados = mysqli_fetch_array ($sql_usuario);
							$nomeUsuario = $dados['nome'];
			?>
				<div class="row">
					<div class="col-md-3"><p class="text-muted"><?php echo $cur_data; ?></p></div>
					<div class="col-md-9"><p class="text-muted"><?php echo $nomeUsuario; ?></p></div>
				</div>
				<div class="row">
					<div class="col-md-12"><small><?php echo $cur_descricao; ?></small></div>
				</div>
		<?php
				}
			}
			
			if ($conta_erros_cliente >= 1) {
		?>
				<p class="lead">Área Restrita</p>
		<?php
				while ($dados = mysqli_fetch_array ($sql_erros_cliente)) {
					
					$cli_id 		= $dados['id'];
					$cli_usuario 	= $dados['id_usuario'];
					$cli_data 		= $dados['data'];
					$cli_descricao 	= $dados['descricao'];
					
					$cli_data = date('d/m/y H:i', strtotime($cli_data));
					
					$sql_cliente = mysqli_query ($conexao, "SELECT nome FROM clientes WHERE id='$cli_usuario'") or die (mysqli_error());
						$dados = mysqli_fetch_array ($sql_cliente);
							$nomeCliente = $dados['nome'];
			?>
				<div class="row">
					<div class="col-md-3"><p class="text-muted"><?php echo $cli_data; ?></p></div>
					<div class="col-md-9"><p class="text-muted"><?php echo $nomeCliente; ?></p></div>
				</div>
				<div class="row">
					<div class="col-md-12"><small><?php echo $cli_descricao; ?></small></div>
				</div>
			<?php		
				}
			}
		?>
        	</div>
        </div>
		<?php		
		}	
		?>
    </div>
</div>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
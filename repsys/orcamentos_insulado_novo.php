<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_sistema.php");
include_once ("includes/usuario_logado.php");
include_once ("includes/cabecalho.php");
?>

<body>

<?php include_once ("includes/menu_topo.php"); ?>

<div class="container-fluid" id="conteudo">

<div class="row" id="titulo">
	<div class="col-md-12">
    	<h1>Orçamentos: Vidro Insulado</h1>
    </div>
</div>

<?php include_once("includes/msgs.php"); ?>

<?php
if ($p_insulado == "S") {
?>

<?php
if (!isset($_GET['orcamento'])) {
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
CADASTRAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<div class="row">
	<div class="col-md-3">
		<div class="well">
			<form method="post" action="funcoes/insulado.php?funcao=novo_orcamento">
				<legend>Novo Orçamento</legend>
				
				<div class="form-group form-group-sm">
					<label for="inputCliente">Cliente</label>
					<input type="text" name="cliente" class="form-control" id="inputCliente" autocomplete="off" required>
				</div>
			
				<button type="submit" class="btn btn-primary">Iniciar Orçamento</button>
			</form>
		</div>
	</div>
</div>

<?php
}
else {
	
	$codigo = $_GET['orcamento'];
	
	$consulta = mysqli_query ($conexao, "SELECT * FROM insulado_orcamentos WHERE codigo='$codigo'") or die (mysqli_error());
		$dados = mysqli_fetch_array ($consulta);
			$id 			= $dados['id'];
			$data 			= $dados['data'];
			$codigo			= $dados['codigo'];
			$vendedor 		= $dados['usuario'];
			$ip 			= $dados['ip'];
			$cliente_cod 	= $dados['cliente_cod'];
			$cliente_nome 	= $dados['cliente_nome'];
			$obs 			= $dados['observacoes'];
			$v1_vidro		= $dados['vidro1_vidro'];
			$v1_esp 		= $dados['vidro1_esp'];
			$v1_tipo		= $dados['vidro1_tipo'];
			$v1_vlr			= $dados['vidro1_vlr'];
			$v2_vidro		= $dados['vidro2_vidro'];
			$v2_esp 		= $dados['vidro2_esp'];
			$v2_tipo		= $dados['vidro2_tipo'];
			$v2_vlr			= $dados['vidro2_vlr'];
			$v3_vidro		= $dados['vidro3_vidro'];
			$v3_esp 		= $dados['vidro3_esp'];
			$v3_tipo		= $dados['vidro3_tipo'];
			$v3_vlr			= $dados['vidro3_vlr'];
			$camara1		= $dados['camara1'];
			$camara2		= $dados['camara2'];
			$t_camaras		= $dados['tipo_camaras'];
			$t_composicao	= $dados['tipo_composicao'];
			$gas 			= $dados['gas'];
			$silicone_t		= $dados['silicone_todas'];
			$silicone_c		= $dados['silicone_cantos'];
			$imposto		= $dados['imposto'];
			$status 		= $dados['status'];
			$neg_status 	= $dados['neg_status'];
			
			$n_id = str_pad($id, 5, "0", STR_PAD_LEFT);
			
			$data = date('d/m/Y H:i', strtotime($data));
	
			$consulta_requerente = mysqli_query ($conexao, "SELECT nome FROM representantes WHERE id='$vendedor'") or die (mysqli_error());
				$dados = mysqli_fetch_array ($consulta_requerente);
					$nome_requerente = $dados['nome'];
					
					$nome_requerente = strtr(strtoupper($nome_requerente),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
			
			if ($cliente_cod != 0) {
				$cli_cod = $cliente_cod;
				$cli_nome = "";
			}
			else {
				$cli_cod = "";
				$cli_nome = $cliente_nome;
			}
			
			// Consulta os TIPOS de camaras selecionadas
			$con_camara_1 = mysqli_query ($conexao, "SELECT tipo FROM insulado_tipos WHERE id='$camara1'") or die (mysqli_error());
				$d_cam1 = mysqli_fetch_array ($con_camara_1);
					$tipo_camara_1 = $d_cam1['tipo'];
			
			$con_camara_2 = mysqli_query ($conexao, "SELECT tipo FROM insulado_tipos WHERE id='$camara2'") or die (mysqli_error());
				$d_cam2 = mysqli_fetch_array ($con_camara_2);
					$tipo_camara_2 = $d_cam2['tipo'];
			
			if ($t_composicao == "T" && $tipo_camara_1 != $tipo_camara_2) {
				$bloqueio_composicao = true;
			}
			else {
				$bloqueio_composicao = false;
			}
			
	$consulta_pecas = mysqli_query ($conexao, "SELECT * FROM insulado_pecas WHERE id_orcamento='$id' ORDER BY id") or die (mysqli_error());
		$conta_pecas = mysqli_num_rows ($consulta_pecas);
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
EDITAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<div class="row">
	<div class="col-md-3">
		<div class="box-solicitacao">
			<span class="n-solicitacao">#<?php echo $n_id; ?></span>
		</div>
		
		<hr>
		
		<div class="well">
			<form method="post" action="funcoes/insulado.php?funcao=editar_cliente&orcamento=<?php echo $codigo; ?>">
				<fieldset<?php if ($vendedor != $id_usuario) { echo " disabled"; } ?>>
				
				<legend>Editar Cliente</legend>
				
				<div class="form-group form-group-sm">
					<label for="inputCliente">Cliente</label>
					<input type="text" name="cliente" class="form-control" id="inputCliente" autocomplete="off" value="<?php echo $cli_nome; ?>">
				</div>
			
				<button type="submit" class="btn btn-primary btn-sm">Salvar</button>
				
				</fieldset>
			</form>
		</div>
		
		<div class="well">
			<form method="post" action="funcoes/insulado.php?funcao=observacoes&orcamento=<?php echo $codigo; ?>">
				<fieldset<?php if ($vendedor != $id_usuario) { echo " disabled"; } ?>>
				
				<legend>Informações</legend>
				
				<div class="form-group form-group-sm">
					<label for="inputObs">Observações</label>
					<textarea name="obs" class="form-control" id="inputObs" autocomplete="off" rows="5"><?php echo $obs; ?></textarea>
				</div>
				<div class="form-group form-group-sm">
					<label for="inputImposto">Imposto</label>
					<input type="text" name="imposto" class="form-control" id="inputImposto" autocomplete="off" value="<?php echo $imposto; ?>">
				</div>
			
				<button type="submit" class="btn btn-primary btn-sm">Salvar</button>
				
				</fieldset>
			</form>
		</div>
		
		<hr>
		
		<div class="panel panel-primary">
			<div class="panel-heading">DADOS DO ORÇAMENTO</div>
			<table class="table">
				<tbody>
					<tr>
						<td>
							<span class="text-muted"><i class="far fa-calendar-alt"></i> DATA</span>
							<br>
							<?php echo $data; ?>
						</td>
					</tr>
					<tr>
						<td>
							<span class="text-muted"><i class="fas fa-user"></i> USUÁRIO</span>
							<br>
							<?php echo $nome_requerente; ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class="col-md-9">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#medidas" aria-controls="medidas" role="tab" data-toggle="tab">
				<i class="fas fa-crop"></i> MEDIDAS
				</a>
			</li>
			<li role="presentation">
				<a href="#composicao" aria-controls="composicao" role="tab" data-toggle="tab">
				<i class="fas fa-magic"></i> COMPOSIÇÃO
				</a>
			</li>
		</ul>
		
		<br>
		
		<div class="tab-content">
			<!-- ------------------------------------------------------------------------------------------------------------------
			-----------------------------------------------------------------------------------------------------------------------
			MEDIDAS
			-----------------------------------------------------------------------------------------------------------------------
			------------------------------------------------------------------------------------------------------------------- -->
			<div role="tabpanel" class="tab-pane active" id="medidas">
				<div class="row">
					<div class="col-md-9">
						<form method="post" action="funcoes/insulado.php?funcao=pecas&orcamento=<?php echo $codigo; ?>" class="form-inline">
							<fieldset<?php if ($bloqueio_composicao == true || $vendedor != $id_usuario) { echo " disabled"; } ?>>
							
							<legend>Incluir peças no orçamento</legend>
							
							<div class="form-group form-group-sm">
								<input type="number" name="largura" class="form-control" id="inputOrcLargura" placeholder="Largura" autocomplete="off" required autofocus>
							</div>
							X
							<div class="form-group form-group-sm">
								<input type="number" name="altura" class="form-control" id="inputOrcAltura" placeholder="Altura" autocomplete="off" required>
							</div>
							=
							<div class="form-group form-group-sm">
								<input type="number" name="qtde" class="form-control" id="inputOrcQtde" placeholder="Qtde" autocomplete="off" required>
							</div>
							
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i></button>
							
							</fieldset>
						</form>
						
						<?php if ($bloqueio_composicao == true) { ?>
						<br>
						<div class="row">
							<div class="col-md-12">
								<div class="alert alert-danger" role="alert">
								<i class="fas fa-times-circle fa-lg"></i>
								<strong>ATENÇÃO!</strong> Confira a composição do vidro, as duas câmaras precisam ser do mesmo tipo no caso de vidro TRIPLO.
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="col-md-3">
						<?php
						if ($conta_pecas > 0) {
						?>
						<a href="orcamentos_insulado_imprimir.php?orcamento=<?php echo $codigo; ?>" class="btn btn-success btn-block btn-lg<?php if ($bloqueio_composicao == true) { echo " disabled"; } ?>" target="_blank"><i class="fas fa-print"></i> Imprimir</a>
						
						<?php if ($vendedor == $id_usuario) { ?>
						<a href="funcoes/insulado.php?funcao=excluir_todas_pecas&orcamento=<?php echo $codigo; ?>" class="btn btn-danger btn-block btn-sm<?php if ($bloqueio_composicao == true) { echo " disabled"; } ?>" onClick="return confirm('Tem certeza que deseja excluir todas as peças deste orçamento?')"><i class="far fa-trash-alt"></i> Excluir Todas as Peças</a>
						<?php } else { ?>
						<button class="btn btn-default btn-block btn-sm disabled"><i class="far fa-trash-alt"></i> Excluir Todas as Peças</button>
						<?php } ?>
						<?php
						}
						?>                        
					</div>
				</div>                        
				
				<?php
				if ($conta_pecas > 0) {
				?>
				<hr>
				
				<div class="row">
					<div class="col-md-4">
						<?php if ($gas == "S" && $vendedor == $id_usuario) { // Gás = S e Usuário Logado ?>
						<a href="funcoes/insulado.php?funcao=gas&acao=N&orcamento=<?php echo $codigo; ?>" class="btn btn-block btn-warning<?php if ($bloqueio_composicao == true) { echo " disabled"; } ?>"><i class="fas fa-leaf"></i> Gás Argônio</a>
						<?php } elseif ($gas == "N" && $vendedor == $id_usuario) { // Gás = N e Usuário Logado ?>
						<a href="funcoes/insulado.php?funcao=gas&acao=S&orcamento=<?php echo $codigo; ?>" class="btn btn-block btn-default<?php if ($bloqueio_composicao == true) { echo " disabled"; } ?>"><i class="fas fa-leaf"></i> Gás Argônio</a>
						<?php } elseif ($gas == "S" && $vendedor != $id_usuario) { // Gás = S e Usuário Não Logado ?>
						<button class="btn btn-block btn-warning disabled"><i class="fas fa-leaf"></i> Gás Argônio</a></button>
						<?php } elseif ($gas == "N" && $vendedor != $id_usuario) { // Gás = N e Usuário Não Logado ?>
						<button class="btn btn-block btn-default disabled"><i class="fas fa-leaf"></i> Gás Argônio</a></button>
						<?php } ?>
					</div>
					<div class="col-md-4">
						<?php if ($t_camaras == "DUR" || $t_camaras == "DLT") { ?>
						<?php if ($silicone_t == "S" && $vendedor == $id_usuario) { // Silicone = S e Usuário Logado ?>
						<a href="funcoes/insulado.php?funcao=silicone_todas&acao=N&orcamento=<?php echo $codigo; ?>" class="btn btn-block btn-warning<?php if ($bloqueio_composicao == true) { echo " disabled"; } ?>"><i class="fas fa-retweet"></i> Silicone em todas as peças</a>
						<?php } elseif ($silicone_t == "N" && $vendedor == $id_usuario) { // Silicone = N e Usuário Logado ?>
						<a href="funcoes/insulado.php?funcao=silicone_todas&acao=S&orcamento=<?php echo $codigo; ?>" class="btn btn-block btn-default<?php if ($bloqueio_composicao == true) { echo " disabled"; } ?>"><i class="fas fa-retweet"></i> Silicone em todas as peças</a>
						<?php } elseif ($silicone_t == "S" && $vendedor != $id_usuario) { // Silicone = S e Usuário Não Logado ?>
						<button class="btn btn-block btn-warning disabled"><i class="fas fa-retweet"></i> Silicone em todas as peças</a></button>
						<?php } elseif ($silicone_t == "N" && $vendedor != $id_usuario) { // Silicone = N e Usuário Não Logado ?>
						<button class="btn btn-block btn-default disabled"><i class="fas fa-retweet"></i> Silicone em todas as peças</a></button>
						<?php } ?>
						<?php } ?>
					</div>
					<div class="col-md-4">
						<?php if ($t_camaras == "DUR" || $t_camaras == "DLT") { ?>
						<?php if ($silicone_c == "S" && $vendedor == $id_usuario) { // Silicone = S e Usuário Logado ?>
						<a href="funcoes/insulado.php?funcao=silicone_cantos&acao=N&orcamento=<?php echo $codigo; ?>" class="btn btn-block btn-warning<?php if ($bloqueio_composicao == true) { echo " disabled"; } ?>"><i class="fas fa-expand-arrows-alt"></i> Silicone nos cantos</a>
						<?php } elseif ($silicone_c == "N" && $vendedor == $id_usuario) { // Silicone = N e Usuário Logado ?>
						<a href="funcoes/insulado.php?funcao=silicone_cantos&acao=S&orcamento=<?php echo $codigo; ?>" class="btn btn-block btn-default<?php if ($bloqueio_composicao == true) { echo " disabled"; } ?>"><i class="fas fa-expand-arrows-alt"></i> Silicone nos cantos</a>
						<?php } elseif ($silicone_c == "S" && $vendedor != $id_usuario) { // Silicone = S e Usuário Não Logado ?>
						<button class="btn btn-block btn-warning disabled"><i class="fas fa-expand-arrows-alt"></i> Silicone nos cantos</a></button>
						<?php } elseif ($silicone_c == "N" && $vendedor != $id_usuario) { // Silicone = N e Usuário Não Logado ?>
						<button class="btn btn-block btn-default disabled"><i class="fas fa-expand-arrows-alt"></i> Silicone nos cantos</a></button>
						<?php } ?>
						<?php } ?>
					</div>
				</div> 
				<?php
				}
				?>                                           
						
				<hr>
				
				<div class="row">
					<div class="col-md-12">
						<?php
						if ($conta_pecas == 0) {
						?>
						<div class="row">
							<div class="col-md-12">
								<div class="alert alert-warning" role="alert">
								<i class="fas fa-exclamation-triangle fa-lg"></i>
								Nenhuma peça cadastrada neste orçamento
								</div>
							</div>
						</div>
						<?php
						}
						else {

						$c_pecas = mysqli_query ($conexao, "SELECT 
												SUM(qtde) AS total_pecas,
												SUM(m2_total) AS total_m2,
												SUM(ml_total) AS total_ml,
												SUM(valor_total) AS total_valor
												FROM insulado_pecas WHERE id_orcamento='$id'") or die (mysqli_error());
							$dados = mysqli_fetch_array ($c_pecas);
								$pecas_orc 	= $dados['total_pecas'];
								$m2_orc 	= $dados['total_m2'];
								$ml_orc 	= $dados['total_ml'];
								$valor_orc 	= $dados['total_valor'];
								
								$m2_orc = number_format($m2_orc, 3, ',', '.');
								$ml_orc = number_format($ml_orc, 3, ',', '.');
								$valor_orc = number_format($valor_orc, 2, ',', '.');
						?>
						
						<div class="row">
							<div class="col-md-3 text-center">
								<div class="panel panel-default">
									<div class="panel-heading"><small><i class="fas fa-calculator"></i> PEÇAS</small></div>
									<div class="panel-body"><span class="lead text-muted"><?php echo $pecas_orc; ?></span></div>
								</div>
							</div>
							<div class="col-md-3 text-center">
								<div class="panel panel-default">
									<div class="panel-heading"><small><i class="fas fa-expand-arrows-alt"></i> METRAGEM QUADRADA</small></div>
									<div class="panel-body"><span class="lead text-muted"><?php echo $m2_orc; ?></span></div>
								</div>
							</div>
							<div class="col-md-3 text-center">
								<div class="panel panel-default">
									<div class="panel-heading"><small><i class="fas fa-arrows-alt"></i> METRAGEM LINEAR</small></div>
									<div class="panel-body"><span class="lead text-muted"><?php echo $ml_orc; ?></span></div>
								</div>
							</div>
							<div class="col-md-3 text-center">
								<div class="panel panel-primary">
									<div class="panel-heading"><small><i class="far fa-money-bill-alt"></i> VALOR TOTAL</small></div>
									<div class="panel-body"><span class="lead"><small>R$</small> <?php echo $valor_orc; ?></span></div>
								</div>
							</div>
						</div>
						
						<?php
						if ($conta_pecas > 0) {
						?>
						<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>QTDE</th>
									<th>LARGURA</th>
									<th>ALTURA</th>
									<th>M² PEÇA</th>
									<th>R$ VIDRO 1</th>
									<th>R$ VIDRO 2</th>
									<?php if ($t_composicao == "T") { ?>
									<th>R$ VIDRO 3</th>
									<?php } ?>
									<th>ML</th>
									<th>VLR UN</th>
									<th>VLR TOTAL</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
						
						<?php
						$i = 1;
						
						while ($linha = mysqli_fetch_array($consulta_pecas)) {
							$id_item	= $linha['id'];
							$qtde		= $linha['qtde'];
							$altura 	= $linha['altura'];
							$largura 	= $linha['largura'];
							$m2_peca 	= $linha['m2_peca'];
							$vlr_vidro1	= $linha['vidro1_vlr'];
							$vlr_vidro2	= $linha['vidro2_vlr'];
							$vlr_vidro3	= $linha['vidro3_vlr'];
							$ml 		= $linha['ml'];
							$vlr_un 	= $linha['valor_un'];
							$vlr_total 	= $linha['valor_total'];
							
							$total_pecas += $qtde;
							
							// Formatação Números
							$m2_peca = number_format($m2_peca, 3, ',', '.');
							
							$vlr_vidro1 = number_format($vlr_vidro1, 2, ',', '.');
							$vlr_vidro2 = number_format($vlr_vidro2, 2, ',', '.');
							$vlr_vidro3 = number_format($vlr_vidro3, 2, ',', '.');
							
							$vlr_un = number_format($vlr_un, 2, ',', '.');
							$vlr_total = number_format($vlr_total, 2, ',', '.');
						?>
							
								<tr>
									<td><span class="text-muted"><?php echo $i++; ?></span></td>
									<td><strong><?php echo $qtde; ?></strong></td>
									<td><strong><?php echo $largura; ?></strong></td>
									<td><strong><?php echo $altura; ?></strong></td>
									<td><?php echo $m2_peca; ?></td>
									<td><?php echo $vlr_vidro1; ?></td>
									<td><?php echo $vlr_vidro2; ?></td>
									<?php if ($t_composicao == "T") { ?>
									<td><?php echo $vlr_vidro3; ?></td>
									<?php } ?>
									<td><?php echo $ml; ?></td>
									<td><?php echo $vlr_un; ?></td>
									<td><strong><?php echo $vlr_total; ?></strong></td>
									
									<td>
									<?php if ($vendedor == $id_usuario) { ?>
									<a href="funcoes/insulado.php?funcao=excluir_peca&id=<?php echo $id_item; ?>&orcamento=<?php echo $codigo; ?>" class="btn btn-xs btn-danger btn-block" onClick="return confirm('Tem certeza que deseja excluir este item? \n\n <?php echo $qtde." = ".$largura." x ".$altura; ?>')"><i class="far fa-trash-alt"></i></a>
									<?php } else { ?>
									<button class="btn btn-xs btn-default btn-block disabled"><i class="far fa-trash-alt"></i></button>
									<?php } ?>
									</td>
								</tr>
						 <?php } ?>
						
							</tbody>
						</table>
						</div>
						<?php
						}
						
						}
						?>
					</div>
				</div>
			</div>
			
			<!-- ------------------------------------------------------------------------------------------------------------------
			-----------------------------------------------------------------------------------------------------------------------
			COMPOSIÇÃO
			-----------------------------------------------------------------------------------------------------------------------
			------------------------------------------------------------------------------------------------------------------- -->
			<div role="tabpanel" class="tab-pane" id="composicao">
				<h4>VIDRO DUPLO</h4>
				
				<form method="post" action="funcoes/insulado.php?funcao=composicao_duplo&orcamento=<?php echo $codigo; ?>">
					<fieldset<?php if ($vendedor != $id_usuario) { echo " disabled"; } ?>>                    
					
					<div class="panel panel-success">
						<div class="panel-heading"><i class="fas fa-folder"></i> VIDRO 1</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-5">
									<div class="form-group form-group-sm">
										<label for="textVidro1">Vidro</label>
										<input type="text" name="vidro1" class="form-control" id="textVidro1" autocomplete="off" value="<?php echo $v1_vidro; ?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group form-group-sm">
										<label for="textEspessura1">Espessura</label>
										<input type="text" name="espessura1" class="form-control" id="textEspessura1" autocomplete="off" value="<?php echo $v1_esp; ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-group-sm">
										<label for="selectTipo1">Tipo</label>
										<select name="tipo1" id="selectTipo1" class="form-control" required>
											<option></option>
											<option value="C"<?php if ($v1_tipo == "C") { echo " selected"; } ?>>COMUM</option>
											<option value="T"<?php if ($v1_tipo == "T") { echo " selected"; } ?>>TEMPERADO</option>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group form-group-sm">
										<label for="inputValor1">Valor</label>
										<input type="text" name="valor1" class="form-control" id="inputValor1" autocomplete="off" value="<?php echo $v1_vlr; ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="panel panel-warning">
						<div class="panel-heading"><i class="far fa-folder"></i> CÂMARA 1</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-5">
									<div class="form-group form-group-sm">
										<label for="selectCamara1">Câmara</label>
										<select name="camara1" id="selectCamara1" class="form-control" required>
											<option></option>
											<?php
											$consulta_camara1 = mysqli_query ($conexao, "SELECT id, nome FROM insulado_tipos WHERE ativo='S' ORDER BY nome") or die (mysqli_error());
												while ($dados1 = mysqli_fetch_array ($consulta_camara1)) {
													$id_camara1 	= $dados1['id'];
													$nome_camara1 	= $dados1['nome'];
											?>
											<option value="<?php echo $id_camara1; ?>"<?php if ($id_camara1 == $camara1) { echo " selected"; } ?>><?php echo $nome_camara1; ?></option>
											<?php
												}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="panel panel-success">
						<div class="panel-heading"><i class="fas fa-folder"></i> VIDRO 2</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-5">
									<div class="form-group form-group-sm">
										<label for="textVidro2">Vidro</label>
										<input type="text" name="vidro2" class="form-control" id="textVidro2" autocomplete="off" value="<?php echo $v2_vidro; ?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group form-group-sm">
										<label for="textEspessura2">Espessura</label>
										<input type="text" name="espessura2" class="form-control" id="textEspessura2" autocomplete="off" value="<?php echo $v2_esp; ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-group-sm">
										<label for="selectTipo2">Tipo</label>
										<select name="tipo2" id="selectTipo2" class="form-control" required>
											<option></option>
											<option value="C"<?php if ($v2_tipo == "C") { echo " selected"; } ?>>COMUM</option>
											<option value="T"<?php if ($v2_tipo == "T") { echo " selected"; } ?>>TEMPERADO</option>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group form-group-sm">
										<label for="inputValor2">Valor</label>
										<input type="text" name="valor2" class="form-control" id="inputValor2" autocomplete="off" value="<?php echo $v2_vlr; ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
					
					</fieldset>
				</form>
				
				<?php if ($t_composicao == "D" || $t_composicao == "T") { ?>
				<hr>
				
				<h4>VIDRO TRIPLO</h4>
				
				<form method="post" action="funcoes/insulado.php?funcao=composicao_triplo&orcamento=<?php echo $codigo; ?>">
					<fieldset<?php if ($vendedor != $id_usuario) { echo " disabled"; } ?>>                    
					
					<div class="panel panel-warning">
						<div class="panel-heading"><i class="far fa-folder"></i> CÂMARA 2</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-5">
									<div class="form-group form-group-sm">
										<label for="selectCamara2">Câmara</label>
										<select name="camara2" id="selectCamara2" class="form-control" required>
											<option></option>
											<?php
											$consulta_camara2 = mysqli_query ($conexao, "SELECT id, nome FROM insulado_tipos WHERE tipo='$tipo_camara_1' AND ativo='S' ORDER BY nome") or die (mysqli_error());
												while ($dados2 = mysqli_fetch_array ($consulta_camara2)) {
													$id_camara2 	= $dados2['id'];
													$nome_camara2 	= $dados2['nome'];
											?>
											<option value="<?php echo $id_camara2; ?>"<?php if ($id_camara2 == $camara2) { echo " selected"; } ?>><?php echo $nome_camara2; ?></option>
											<?php
												}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="panel panel-success">
						<div class="panel-heading"><i class="fas fa-folder"></i> VIDRO 3</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-5">
									<div class="form-group form-group-sm">
										<label for="textVidro3">Vidro</label>
										<input type="text" name="vidro3" class="form-control" id="textVidro3" autocomplete="off" value="<?php echo $v3_vidro; ?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group form-group-sm">
										<label for="textEspessura3">Espessura</label>
										<input type="text" name="espessura3" class="form-control" id="textEspessura3" autocomplete="off" value="<?php echo $v3_esp; ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group form-group-sm">
										<label for="selectTipo3">Tipo</label>
										<select name="tipo3" id="selectTipo3" class="form-control" required>
											<option></option>
											<option value="C"<?php if ($v3_tipo == "C") { echo " selected"; } ?>>COMUM</option>
											<option value="T"<?php if ($v3_tipo == "T") { echo " selected"; } ?>>TEMPERADO</option>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group form-group-sm">
										<label for="inputValor3">Valor</label>
										<input type="text" name="valor3" class="form-control" id="inputValor3" autocomplete="off" value="<?php echo $v3_vlr; ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
					
					<?php if ($t_composicao == "T") { ?>
					<a href="funcoes/insulado.php?funcao=excluir_triplo&orcamento=<?php echo $codigo; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Excluir</a>
					<?php } ?>
					
					</fieldset>
				</form>
				<?php } ?>
			</div>
		</div>

	</div>
</div>

<?php
}
?>

<?php
}
else {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Você não tem permissão para acessar essa página. Para maiores informações entre em contato com o responsável pelo sistema na Linde Vidros.
		</div>
	</div>
</div>
<?php
}
?>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
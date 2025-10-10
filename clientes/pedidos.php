<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_clientes.php");
include_once ("includes/usuario_logado.php");
include_once ("includes/cabecalho.php");
?>

<body>

<?php include_once ("includes/menu_topo.php"); ?>

<div class="container-fluid" id="conteudo">

<div class="row" id="titulo">
	<div class="col-md-12">
    	<h1>Roteiro de Pedidos</h1>
    </div>
</div>

<?php
if ($wkUsuario == "S") {
?>

<div class="row">
    <div class="col-md-12">
		<div class="row">
        	<div class="col-xs-2">
				<p><a href="#legenda" role="button" class="btn btn-default" data-toggle="modal"><i class="far fa-list-alt"></i> <span class="hidden-xs">Legenda</span></a></p>
                
                <!-- Modal -->
                <div class="modal fade" id="legenda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h2 class="modal-title" id="myModalLabel"><i class="far fa-list-alt"></i> Legenda</h2>
                            </div>
                            
                            <div class="modal-body">
                                
                                <p><strong>Cores das Linhas</strong></p>
                                
                                <table class="table">
                                    <tr>
                                        <td><span class="text-muted">O setor de <strong>Vendas</strong> atualizou o pedido</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-warning">O setor de <strong>Transporte</strong> atualizou o pedido</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-success"><strong>Weiku</strong> atualizou o pedido</span></td>
                                    </tr>
                                </table>
                                
                                <hr>
                                
                                <p><strong>Ícone Status</strong></p>

                                <p><small><span class="text-success"><i class="fas fa-check-circle"></i></span> Pendente &nbsp; &nbsp; <span class="text-danger"><i class="fas fa-circle"></i></span> Entregue</small></p>
                                
                                <hr>
                                
                                <p><strong>Botão Procedimento</strong></p>
                                
                                <button class="btn btn-sm btn-default"><i class="fas fa-truck"></i></button> Procedimento Pendente
                                <br><br>
                                <button class="btn btn-sm btn-success"><i class="fas fa-truck"></i></button> Procedimento Preenchido
                            </div>
                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
            </div>
            <div class="col-xs-10">
            	<div class="well">
                <form method="post" action="pedidos.php" class="form-inline">
                    
                    <legend>Filtro</legend>
                    
                    <div class="form-group form-group-sm">
                    	<label for="inputDataInicial">Data Inicial</label>
                    	<input type="date" name="data_inicial" class="form-control" id="inputDataInicial" required value="<?php echo $_POST['data_inicial'] ?? ''; ?>">
                    </div>
                    <div class="form-group form-group-sm">
                    	<label for="inputDataFinal">Data Final</label>
                    	<input type="date" name="data_final" class="form-control" id="inputDataFinal" max="<?php echo date("Y-m-d"); ?>" required value="<?php echo $_POST['data_final'] ?? ''; ?>">
                    </div>
                    <div class="form-group form-group-sm">
                    	<label for="selectSituacao">Situação</label>
                    	<select name="situacao" class="form-control" id="selectSituacao" required>
                        	<option value="Pendente"<?php if (isset($_POST['situacao']) && $_POST['situacao'] == "Pendente") { echo " selected"; }; ?>>Pendente</option>
                            <option value="Entregue"<?php if (isset($_POST['situacao']) && $_POST['situacao'] == "Entregue") { echo " selected"; }; ?>>Entregue</option>
                        </select>
                    </div>
                	
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i> Filtrar</button>
                </form>
                </div>
            </div>
        </div>
        <?php
		include_once("includes/msgs.php");
		?>
		
        <?php
		if (isset($_POST['data_inicial']) && isset($_POST['data_final']) && isset($_POST['situacao'])) {
			
			$data1 = $_POST['data_inicial'];
			$data2 = $_POST['data_final'];
			$situa = $_POST['situacao'];
			
			$con_pedidos = mysqli_query ($conexao, "SELECT
										id_pedido_weiku, data_pedido, empresa_weiku, nome_cliente_weiku, cidade_weiku, rota_weiku, peso_weiku, numero_nota_weiku, 
										valor_weiku, vencimento, of_weiku, at_weiku, previsionamento, alteracao_data, situacao_weiku, situacao
										FROM vendas_weiku
										WHERE date_format(alteracao_data, '%Y-%m-%d')>='$data1' AND date_format(alteracao_data, '%Y-%m-%d')<='$data2' AND situacao_weiku='$situa'
										ORDER BY alteracao_data
										") or die (mysqli_error());
			
			$conta_pedidos = mysqli_num_rows ($con_pedidos);
			
		}
		else {
		
			$con_pedidos = mysqli_query ($conexao, "SELECT
										id_pedido_weiku, data_pedido, empresa_weiku, nome_cliente_weiku, cidade_weiku, rota_weiku, peso_weiku, numero_nota_weiku, 
										valor_weiku, vencimento, of_weiku, at_weiku, previsionamento, alteracao_data, situacao_weiku, situacao
										FROM vendas_weiku
										WHERE situacao_weiku='Pendente'
										ORDER BY alteracao_data
										") or die (mysqli_error());
			
			$conta_pedidos = mysqli_num_rows ($con_pedidos);
		}
		?>
        
        <hr>
        
        <?php
		if ($conta_pedidos == 0) {
		?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle fa-lg"></i>
                Nenhum pedido foi encontrado
                </div>
            </div>
        </div>
        <?php
		} else {
		?>
        
        <div class="table-responsive">
        <table class="table table-hover" id="tabela-weiku">
        	<thead>
            	<tr>
                	<th></th>
                    <th>OF</th>
                    <th>ROTA</th>
                    <th>AT</th>
                    <th>DATA</th>
                    <th>EMPRESA</th>
                    <th>CIDADE</th>
                    <th>PESO</th>
                    <th>NF</th>
                    <th>VALOR</th>
                    <th>VENCIMENTO</th>
                    <th>ENTREGA</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
		<?php
		while ($dados_pedidos = mysqli_fetch_array ($con_pedidos)) {
			$id 			= $dados_pedidos['id_pedido_weiku'];
			$data 			= $dados_pedidos['data_pedido'];
			$empresa 		= $dados_pedidos['empresa_weiku'];
			$nome_cliente 	= $dados_pedidos['nome_cliente_weiku'];
			$cidade 		= $dados_pedidos['cidade_weiku'];
			$rota 			= $dados_pedidos['rota_weiku'];
			$peso 			= $dados_pedidos['peso_weiku'];
			$nf 			= $dados_pedidos['numero_nota_weiku'];
			$valor 			= $dados_pedidos['valor_weiku'];
			$vencimento 	= $dados_pedidos['vencimento'];
			$ofs 			= $dados_pedidos['of_weiku'];
			$at 			= $dados_pedidos['at_weiku'];
			$previsao		= $dados_pedidos['previsionamento'];
			$alteracao_data	= $dados_pedidos['alteracao_data'];
			$situacao_weiku	= $dados_pedidos['situacao_weiku'];
			$situacao		= $dados_pedidos['situacao'];
			
			$n_id = str_pad($id, 5, "0", STR_PAD_LEFT);
	
			$data = date('d/m/Y', strtotime($data));
			
			if ($vencimento != null) { $vencimento 	= date('d/m/Y', strtotime($vencimento)); } else { $vencimento = ""; }
			
			if ($previsao != null) { $previsao_x = date('d/m/Y', strtotime($previsao)); } else { $previsao = ""; }
			if ($alteracao_data != null) { $alteracao_data_x = date('d/m/Y', strtotime($alteracao_data)); } else { $alteracao_data = ""; }
			
			// Nome Empresa
			switch ($empresa) {
				case "1290":
					$nome_empresa = "WEIKU DO BRASIL";
					break;
				case "3804":
					$nome_empresa = "CLIMAGLASS";
			}
			
			// Imagem Situação
			switch ($situacao_weiku) {
				case "Entregue":
					$img_situacao = "fas fa-check-circle fa-lg";
					$cor_situacao = "text-success";				
					break;
				case "Pendente":
					$img_situacao = "fas fa-circle fa-lg";
					$cor_situacao = "text-danger";
			}
			
			// Linhas Situação
			switch ($situacao) {
				case "1":
					$cls_situacao = "text-muted";
					break;
				case "2":
					$cls_situacao = "text-warning";
					break;
				case "3":
					$cls_situacao = "text-success";
			}
			
			// Valor
			if ($vencimento != null) { $valor = number_format($valor, 2, ',', '.'); } else { $valor = ""; }
			
			// Consulta se há procedimento de entrega
			$con_procedimento = mysqli_query ($conexao, "SELECT id FROM vendas_weiku_procedimentos WHERE id_pedido='$id'") or die (mysqli_error());
				$conta_procedimento = mysqli_num_rows ($con_procedimento);
				
				if ($conta_procedimento == 0) {
					$class_proc = "btn-default";
				}
				else {
					$class_proc = "btn-success";
				}
			
		?>
            	<tr class="<?php echo $cls_situacao; ?>">
                	<td class="<?php echo $cor_situacao; ?>">
                    	<i class="<?php echo $img_situacao; ?>"></i>
                    </td>
                    <td>
						<strong><?php echo $ofs; ?></strong>
                    </td>
                    <td>
						<?php echo $rota; ?>
                    </td>
                    <td>
						<?php echo $at; ?>
                    </td>
                    <td>
						<?php echo $data; ?>
                    </td>
                    <td>
						<?php echo $empresa; ?> - <?php echo $nome_empresa; ?> <br> <small class="text-muted"><?php echo $nome_cliente; ?></small>
                    </td>
                    <td>
						<?php echo $cidade; ?>
                    </td>
                    <td>
						<?php echo $peso; ?>
                    </td>
                    <td>
						<?php echo $nf; ?>
                    </td>
                    <td>
						<?php echo $valor; ?>
                    </td>
                    <td>
						<?php echo $vencimento; ?>
                    </td>
                    <td>
						<?php if ($previsao != null) { echo "<del class=\"text-muted\">"; } ?><?php echo $previsao_x; ?><?php if ($previsao != null) { echo "</del>"; } ?>
                        <br>
						<?php echo $alteracao_data_x; ?>
                    </td>
                    <td>
                    	<a href="pedidos_procedimento.php?p=<?php echo $id; ?>" class="btn <?php echo $class_proc; ?> btn-xs btn-block" title="Procedimento de Entrega"><i class="fas fa-truck"></i></a>
                    </td>
                    <td>
                    	<a href="pedidos_detalhes.php?p=<?php echo $id; ?>" class="btn btn-primary btn-xs btn-block" title="Visualizar"><i class="fas fa-search"></i></a>
                    </td>
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
</div>

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

<?php include_once ("includes/scripts_bootstrap.php"); ?>

</body>

</html>
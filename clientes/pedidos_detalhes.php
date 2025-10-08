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
        
        <ol class="breadcrumb">
        	<li><a href="index.php">Início</a></li>
            <li><a href="pedidos.php">Pedidos</a></li>
        	<li class="active">Detalhes do Pedido</li>
        </ol>
		
		<?php
		include_once("includes/msgs.php");
		?>

	</div>
</div>

<?php
$id = $_GET['p'];

$consulta_pedido = mysqli_query ($conexao, "SELECT * FROM vendas_weiku WHERE id_pedido_weiku='$id'") or die (mysqli_error());
	$dados_pedido = mysqli_fetch_array ($consulta_pedido);
		$data_pedido 		= $dados_pedido['data_pedido'];
		$empresa 			= $dados_pedido['empresa_weiku'];
		$nome_cliente 		= $dados_pedido['nome_cliente_weiku'];
		$cidade 			= $dados_pedido['cidade_weiku'];
		$rota 				= $dados_pedido['rota_weiku'];
		$peso 				= $dados_pedido['peso_weiku'];
		$nf 				= $dados_pedido['numero_nota_weiku'];
		$valor 				= $dados_pedido['valor_weiku'];
		$vencimento 		= $dados_pedido['vencimento'];
		$ofs 				= $dados_pedido['of_weiku'];
		$at 				= $dados_pedido['at_weiku'];
		
		$qtde_tem			= $dados_pedido['quant_temperado'];
		$qtde_com			= $dados_pedido['quant_comum'];
		$qtde_ins			= $dados_pedido['quant_insulado'];
		
		$previsionamento 	= $dados_pedido['previsionamento'];
		$alteracao_data 	= $dados_pedido['alteracao_data'];
		
		$obs 				= $dados_pedido['observacoes_weiku'];
		$obs_trans 			= $dados_pedido['observacoes_transporte'];
		$obs_vendas 		= $dados_pedido['observacoes_vendas'];
		
		$situacao_weiku 	= $dados_pedido['situacao_weiku'];
		$situacao 			= $dados_pedido['situacao'];
		
		$data_cad_weiku 	= $dados_pedido['data_cad_weiku'];
		$edicao_ven 		= $dados_pedido['data_edit_vendas_weiku'];
		$edicao_fat			= $dados_pedido['data_edit_faturamento_weiku'];
		$edicao_tra			= $dados_pedido['data_edit_transporte_weiku'];
		
		$usuario_ven 		= $dados_pedido['usuario_edit_vendas_weiku'];
		$usuario_fat		= $dados_pedido['usuario_edit_faturamento_weiku'];
		$usuario_tra 		= $dados_pedido['usuario_edit_transporte_weiku'];
		
		$edicao_weiku 		= $dados_pedido['data_edit_weiku'];
		
		/* ***************************** */
		
		$n_id = str_pad($id, 5, "0", STR_PAD_LEFT);
	
		$data_pedido 		= date('d/m/Y', strtotime($data_pedido));
		$xprevisionamento 	= date('d/m/Y', strtotime($previsionamento));
		$xalteracao_data 	= date('d/m/Y', strtotime($alteracao_data));
		
		$xedicao_ven 		= date('d/m/Y', strtotime($edicao_ven));
		$xedicao_fat 		= date('d/m/Y', strtotime($edicao_fat));
		$xedicao_tra 		= date('d/m/Y', strtotime($edicao_tra));
		
		$xedicao_weiku 		= date('d/m/Y', strtotime($edicao_weiku));
		
		if ($vencimento != null) { $vencimento 	= date('d/m/Y', strtotime($vencimento)); } else { $vencimento = ""; }
		
		// Nome Empresa
		if ($empresa == "1290" ) { $nome_empresa = "WEIKU DO BRASIL"; }
		else if ($empresa == "3804" ) { $nome_empresa = "CLIMAGLASS"; }
		
		// Valor
		if ($vencimento != null) { $valor = number_format($valor, 2, ',', '.'); } else { $valor = ""; }
		
		// Quantidade de Peças
		$qtde_total = $qtde_tem + $qtde_com + $qtde_ins;
?>

<div class="row">
	<div class="col-md-5">
    	
        <h2>Weiku</h2>
        
        <br>
        
        <?php
		if ($situacao_weiku == "Pendente") {
		?>
        <form method="post" action="funcoes/weiku.php?funcao=alterar_data&p=<?php echo $id; ?>">
            
            <fieldset>
            
            <legend>Solicitar alteração de data</legend>
            
            <div class="form-group form-group-sm">
            	<label for="inputData">Data</label>
            	<input type="date" name="data" class="form-control" id="inputData" required value="<?php echo $alteracao_data; ?>">
            </div>
            <div class="form-group form-group-sm">
            	<label for="textObs">Observações</label>
                <textarea name="obs" class="form-control" id="textObs" rows="8"><?php echo $obs; ?></textarea>
            </div>
			
            <button type="submit" class="btn btn-primary" onClick="return confirm('Tem certeza que deseja alterar a data de entrega?')"><i class="fas fa-save"></i> Solicitar Alteração</button>
            
            </fieldset>
            
        </form>
        
        <?php if ($edicao_weiku != null) { ?>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                <i class="fas fa-info-circle fa-lg"></i>
                Foi solicitada alteração na data de entrega no dia <strong><?php echo $xedicao_weiku; ?></strong>.
                </div>
            </div>
        </div>
        <?php } ?>
        
        <?php
		}
		else {
		?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                <i class="fas fa-check-circle fa-lg"></i>
                Pedido entregue!
                </div>
            </div>
        </div>
        <?php
		}
		?>
    </div>
    
    <div class="col-md-7">
    	<h1><?php echo $ofs; ?></h1>
        
        <h2>Dados Comerciais</h2>
        
        <br>
        
        <div class="table-responsive">
        <table class="table table-striped">
        	<tbody>
            	<tr>
                	<td class="text-muted" width="60%">DATA DE ENTRADA DO PEDIDO</td>
                    <td><?php echo $data_pedido; ?></td>
                </tr>
                <tr>
                	<td class="text-muted">EMPRESA</td>
                    <td><?php echo $nome_empresa; ?></td>
                </tr>
                <tr>
                	<td class="text-muted">NOME DO CLIENTE</td>
                    <td><?php echo $nome_cliente; ?></td>
                </tr>
                <tr>
                	<td class="text-muted">CIDADE</td>
                    <td><?php echo $cidade; ?></td>
                </tr>
                <tr>
                	<td class="text-muted">ROTA</td>
                    <td><?php echo $rota; ?></td>
                </tr>
                <tr>
                	<td class="text-muted">PESO (KG)</td>
                    <td><?php echo $peso; ?></td>
                </tr>
                <tr>
                	<td class="text-muted">AT</td>
                    <td><?php echo $at; ?></td>
                </tr>
            </tbody>
        </table>
        </div>
        
		<?php if ($obs_vendas != "") { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle fa-lg"></i>
                <?php echo $obs_vendas; ?>
                </div>
            </div>
        </div>
        <?php } ?>
        
        <h2>Quantidade de Peças</h2>
        
        <div class="table-responsive">
        <table class="table table-striped">
        	<tbody>
            	<tr>
                	<td class="text-muted">TEMPERADO</td>
                    <td><?php echo $qtde_tem; ?></td>
                </tr>
                <tr>
                	<td class="text-muted">COMUM</td>
                    <td><?php echo $qtde_com; ?></td>
                </tr>
                <tr>
                	<td class="text-muted">INSULADO</td>
                    <td><?php echo $qtde_ins; ?></td>
                </tr>
                <tr>
                	<td class="text-muted"><strong>TOTAL</strong></td>
                    <td><strong><?php echo $qtde_total; ?></strong></td>
                </tr>
        	</tbody>
        </table>
        </div>
        
        <div class="well" id="well-site">
        	<div class="row">
            	<div class="col-xs-6">
                	<p class="text-center text-muted"><i class="fas fa-calendar-alt fa-lg"></i></p>
                    <p class="text-center"><small><?php if ($edicao_ven != null) { echo $xedicao_ven; } else { echo "---"; } ?></small></p>
                </div>
                <div class="col-xs-6">
                	<p class="text-center text-muted"><i class="fas fa-user fa-lg"></i></p>
                    <p class="text-center"><small><?php if ($usuario_ven != null) { echo $usuario_ven; } else { echo "---"; } ?></small></p>
                </div>
            </div>
        </div>
        
        <hr>
        
        <h2>Dados Transporte</h2>
        
        <br>
        
        <div class="table-responsive">
        <table class="table table-striped">
        	<tbody>
            	<tr>
                	<td class="text-muted" width="60%">PREVISÃO DE ENTREGA</td>
                    <td><?php if ($previsionamento != null) { echo $xprevisionamento; } ?></td>
                </tr>
                <tr>
                	<td class="text-muted">ALTERAÇÃO (PRÓXIMA DATA)</td>
                    <td><?php if ($alteracao_data != null) { echo "<strong>".$xalteracao_data."</strong>"; } ?></td>
                </tr>
            </tbody>
        </table>
        </div>
		
        <?php if ($obs_trans != "") { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle fa-lg"></i>
                <?php echo $obs_trans; ?>
                </div>
            </div>
        </div>
        <?php } ?>
        
        <div class="well" id="well-site">
        	<div class="row">
            	<div class="col-xs-6">
                	<p class="text-center text-muted"><i class="fas fa-calendar-alt fa-lg"></i></p>
                    <p class="text-center"><small><?php if ($edicao_tra != null) { echo $xedicao_tra; } else { echo "---"; } ?></small></p>
                </div>
                <div class="col-xs-6">
                	<p class="text-center text-muted"><i class="fas fa-user fa-lg"></i></p>
                    <p class="text-center"><small><?php if ($usuario_tra != null) { echo $usuario_tra; } else { echo "---"; } ?></small></p>
                </div>
            </div>
        </div>
        
        <hr>
        
        <h2>Dados Faturamento</h2>
        
        <br>
        
        <div class="table-responsive">
        <table class="table table-striped">
        	<tbody>
            	<tr>
                	<td class="text-muted" width="60%">NOTA FISCAL</td>
                    <td><?php if ($nf != null) { echo $nf; } ?></td>
                </tr>
                <tr>
                	<td class="text-muted">VALOR</td>
                    <td><?php if ($valor != null) { echo "R$ ".$valor; } ?></td>
                </tr>
                <tr>
                	<td class="text-muted">VENCIMENTO</td>
                    <td><?php if ($vencimento != null) { echo $vencimento; } ?></td>
                </tr>
            </tbody>
        </table>
        </div>
        
        <div class="well" id="well-site">
        	<div class="row">
            	<div class="col-xs-6">
                	<p class="text-center text-muted"><i class="fas fa-calendar-alt fa-lg"></i></p>
                    <p class="text-center"><small><?php if ($edicao_fat != null) { echo $xedicao_fat; } else { echo "---"; } ?></small></p>
                </div>
                <div class="col-xs-6">
                	<p class="text-center text-muted"><i class="fas fa-user fa-lg"></i></p>
                    <p class="text-center"><small><?php if ($usuario_fat != null) { echo $usuario_fat; } else { echo "---"; } ?></small></p>
                </div>
            </div>
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
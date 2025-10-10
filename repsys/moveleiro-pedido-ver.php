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
    	<h1>Moveleiro: Visualizar Pedido</h1>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="repsys.php">Início</a></li>
            <li><a href="moveleiro-gerenciar-pedidos.php">Pedidos</a></li>
            <li class="active">Visualizar Pedido</li>
        </ol>
	</div>
</div>

<?php
include_once("includes/msgs.php");
?>

<?php if ($p_pedmov_gerenciar == "S") { ?>

<?php
$pedido = $_GET['pedido'];

$consulta_pedido = mysqli_query ($conexao, "SELECT * FROM moveleiro_pedidos WHERE codigo='$pedido'") or die (mysqli_error());
	$dados_pedido = mysqli_fetch_array ($consulta_pedido);
		$id_pedido 		= $dados_pedido['id'];
		$data 			= $dados_pedido['data'];
		$usuario 		= $dados_pedido['usuario'];
		$cliente_cod	= $dados_pedido['cliente_cod'];
		$cliente_nome	= $dados_pedido['cliente_nome'];
		$cliente_rota	= $dados_pedido['cliente_rota'];
		$cliente_cidade	= $dados_pedido['cliente_cidade'];
		$cliente_uf		= $dados_pedido['cliente_uf'];
		$pedido_id 		= $dados_pedido['pedido_id'];
		$forma_pgto 	= $dados_pedido['forma_pgto'];
		$prazo_entrega 	= $dados_pedido['prazo_entrega'];
		$transporte 	= $dados_pedido['transporte'];
		$frete 			= $dados_pedido['frete'];
		$obs 			= $dados_pedido['obs'];
		$status 		= $dados_pedido['status'];
		
		$sol_data 		= $dados_pedido['solicitado_data'];
		$sol_usuario 	= $dados_pedido['solicitado_usuario'];
		$rec_data 		= $dados_pedido['recebido_data'];
		$rec_usuario 	= $dados_pedido['recebido_usuario'];
		
		$n_id = str_pad($id_pedido, 5, "0", STR_PAD_LEFT);
	
		$prazo_entrega_x = date('d/m/Y', strtotime($prazo_entrega));
		
		switch ($transporte) {
			case "P":
				$transporte_desc = "PRÓPRIO";
				break;
			case "R":
				$transporte_desc = "RETIRA";
				break;
			case "T":
				$transporte_desc = "TRANSPORTADORA";
				break;
		}
		
		switch ($frete) {
			case "C":
				$frete_desc = "CIF";
				break;
			case "F":
				$frete_desc = "FOB";
				break;
		}
		
		/* ***** */
		
		$data 		= date('d/m/Y H:i:s', strtotime($data));
		$sol_data 	= date('d/m/Y H:i:s', strtotime($sol_data));
		$rec_data 	= date('d/m/Y H:i:s', strtotime($rec_data));

// Consulta itens
$consulta_itens = mysqli_query ($conexao, "SELECT * FROM moveleiro_itens WHERE id_pedido='$id_pedido'") or die (mysqli_error());

$conta_itens = mysqli_num_rows ($consulta_itens);
?>

<div class="row">
	<div class="col-xs-4">
    	<div id="n-solicitacao">
        	<span id="n-pedido">#<?php echo $n_id; ?></span>
        </div>
    </div>
    <div class="col-xs-8 text-right">
    	<?php if ($status == "P") { ?>
        <div class="btn-group" role="group">
            <a href="funcoes/moveleiro_pedidos.php?funcao=aceitar_pedido&pedido=<?php echo $pedido; ?>" class="btn btn-success"><i class="far fa-check-circle"></i> <span class="hidden-xs">Aceitar Pedido</span></a>
            <a href="#recusar-pedido" data-toggle="modal" data-target="#recusar-pedido" class="btn btn-danger"><i class="far fa-times-circle"></i> <span class="hidden-xs">Recusar Pedido</span></a>
        </div>
        <?php } ?>
        <a href="moveleiro-pedido-imprimir.php?pedido=<?php echo $pedido; ?>" class="btn btn-primary"><i class="fas fa-print"></i> <span class="hidden-xs">Imprimir</span></a>
    </div>
</div>

<div class="row" id="info-pedido">
	<div class="col-md-5">
    	<small><strong class="text-muted">CLIENTE:</strong> <?php echo $cliente_cod; ?> - <?php echo $cliente_nome; ?></small>
        <br>
        <small><strong class="text-muted">ROTA:</strong> <?php echo $cliente_rota; ?></small>
        <br>
        <small><strong class="text-muted">CIDADE:</strong> <?php echo $cliente_cidade; ?> / <?php echo $cliente_uf; ?></small>
    </div>
    <div class="col-md-4">
    	<small><strong class="text-muted">FORMA PAGAMENTO:</strong> <?php echo $forma_pgto; ?></small>
        <br>
        <small><strong class="text-muted">LIMITE PRODUÇÃO:</strong> <?php echo $prazo_entrega_x; ?></small> <a href="#prazo" data-toggle="modal" data-target="#prazo" id="color-edit"><i class="fas fa-pencil-alt"></i></a>
        <br>
        <small><strong class="text-muted">ID:</strong> <?php echo $pedido_id; ?></small>
    </div>
    <div class="col-md-3">
    	<small><strong class="text-muted">TRANSPORTE:</strong> <?php echo $transporte_desc; ?></small>
        <br>
        <small><strong class="text-muted">FRETE:</strong> <?php echo $frete_desc; ?></small>
    </div>
</div>

<?php if ($obs != null) { ?>
<div class="row" id="obs-pedido">
	<div class="col-md-12">
    	<strong>OBSERVAÇÕES</strong>
        <br>
        <?php echo nl2br($obs); ?>
    </div>
</div>
<?php } ?>

<h2>Itens do Pedido</h2>

<div class="row">
<div class="col-md-12">

<?php
if ($conta_itens == 0) {
?>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-warning" role="alert">
        <i class="fas fa-exclamation-triangle"></i>
        Você ainda não adicionou ítens neste pedido
        </div>
    </div>
</div>
<?php	
}
else {
?>
<div class="table-responsive">
<table class="table table-striped table-condensed" id="table-smaller">
    <thead>
    	<tr>
        	<th>#</th>
            <th>QTDE</th>
            <th>UN</th>
            <th>DESCRIÇÃO</th>
            <th>EMBALAGEM</th>
            <th>IPI</th>
            <th>R$ UN</th>
            <th>R$ UN</th>
            <th>R$ TOTAL</th>
            <th>R$ TOTAL</th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php
$i = 1;

$total_pedido = 0;
$total_pedido_ipi = 0;

while ($dados_itens = mysqli_fetch_array ($consulta_itens)) {
    $item_codigo		= $dados_itens['codigo'];
	$item_qtde 			= $dados_itens['qtde'];
    $item_un			= $dados_itens['un'];
	$item_descricao		= $dados_itens['descricao'];
	$item_embalagem		= $dados_itens['embalagem'];
	$item_ipi			= $dados_itens['ipi'];
	$item_preco_un		= $dados_itens['preco_un'];
	$item_preco_ipi		= $dados_itens['preco_ipi'];
	$item_preco_total	= $dados_itens['preco_total'];
	$item_preco_total_i	= $dados_itens['preco_total_ipi'];
	$item_anexo			= $dados_itens['anexo'];
	
	// Totais
	$total_pedido += $item_preco_total;
	$total_pedido_ipi += $item_preco_total_i;
	
	/* *** */
	
	$item_pu 	= number_format($item_preco_un, 2, ',', '.');
	$item_pt 	= number_format($item_preco_total, 2, ',', '.');
	
	$item_pu_ipi 	= number_format($item_preco_ipi, 2, ',', '.');
	$item_pt_ipi 	= number_format($item_preco_total_i, 2, ',', '.');	
	
	$total_p 		= number_format($total_pedido, 2, ',', '.');
	$total_p_ipi 	= number_format($total_pedido_ipi, 2, ',', '.');
?>
    
    	<tr>
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><?php echo $item_qtde; ?></td>
            <td><?php echo $item_un; ?></td>
            <td><?php echo $item_descricao; ?></td>
            <td><?php echo cod_embalagem($item_embalagem, $conexao); ?></td>
            <td class="active"><strong><?php echo $item_ipi; ?>%</strong></td>
            <td>R$ <?php echo $item_pu; ?></td>
            <td class="active"><strong>R$ <?php echo $item_pu_ipi; ?></strong></td>
            <td>R$ <?php echo $item_pt; ?></td>
            <td class="active"><strong>R$ <?php echo $item_pt_ipi; ?></strong></td>
            <td>
                <?php
				if ($item_anexo != null) {
				?>
                <a href="pedidos/moveleiro/<?php echo $item_anexo; ?>" target="_blank" class="btn btn-xs btn-success btn-block">
                	<i class="fas fa-paperclip"></i>
                </a>
                <?php
				} else {
				?>
                <button class="btn btn-xs btn-default btn-block disabled">
                	<i class="fas fa-paperclip"></i>
                </button>
                <?php
				}
				?>
            </td>
        </tr>
 <?php } ?>

	</tbody>
    <tfoot>
    	<tr>
        	<td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>R$ <?php echo $total_p; ?></td>
            <td><strong>R$ <?php echo $total_p_ipi; ?></strong></td>
            <td></td>
        </tr>
    </tfoot>
</table>
</div>
<?php
}
?>

<?php
/* **********************************************************************
EMBALAGENS
********************************************************************** */
$con_embalagens = mysqli_query ($conexao, "SELECT b.tipo, b.descricao FROM moveleiro_itens a, moveleiro_embalagens b WHERE a.id_pedido='$id_pedido' AND a.embalagem=b.id GROUP BY a.embalagem ORDER BY b.tipo") or die (mysqli_error());
$conta_embalagens = mysqli_num_rows ($con_embalagens);

if ($conta_embalagens > 0) {
?>
<hr>

<h2>Embalagens Solicitadas no Pedido</h2>

<div class="table-responsive">
<table class="table table-striped table-condensed" id="table-smaller">
    <thead>
    	<tr>
        	<th>TIPO</th>
            <th>DESCRIÇÃO</th>
        </tr>
    </thead>
	<tbody>
<?php
while ($dados_emb = mysqli_fetch_array ($con_embalagens)) {
    $emb_tipo		= $dados_emb['tipo'];
	$emb_descricao	= $dados_emb['descricao'];
?>
    
    	<tr>
            <td><strong class="text-danger"><?php echo $emb_tipo; ?></strong></td>
            <td><?php echo $emb_descricao; ?></td>
        </tr>
 <?php } ?>	
    </tbody>
</table>
</div>
<?php
}
?>

<?php
$consulta_log = mysqli_query ($conexao, "SELECT * FROM moveleiro_log_prazo WHERE id_pedido='$id_pedido' ORDER BY data DESC") or die (mysqli_error());
$conta_log = mysqli_num_rows ($consulta_log);

if ($conta_log > 0) {
?>
<hr>

<div class="panel panel-default">
    <div class="panel-heading">
    	<h4 class="panel-title">ALTERAÇÃO NO LIMITE DE PRODUÇÃO</h4>
    </div>
    <div class="table-responsive">
    <table class="table" id="table-smaller">
        <thead>
        	<tr>
            	<th>RESPONSÁVEL</th>
                <th>ALTERAÇÃO</th>
                <th>MOTIVO</th>
            </tr>
        </thead>
        <tbody>
<?php
while ($dados_log = mysqli_fetch_array ($consulta_log)) {
	$log_data 			= $dados_log['data'];
	$log_usuario 		= $dados_log['usuario'];
	$log_data_antiga 	= $dados_log['data_antiga'];
	$log_data_nova 		= $dados_log['data_nova'];
	$log_motivo 		= $dados_log['motivo'];
	
	$log_data 			= date('d/m/Y H:i:s', strtotime($log_data));
	$log_data_antiga 	= date('d/m/Y', strtotime($log_data_antiga));
	$log_data_nova 		= date('d/m/Y', strtotime($log_data_nova));
?>
            <tr>
                <td><?php echo $log_data; ?> - <?php echo nome_representante($log_usuario, $conexao); ?></td>
                <td><span class="text-muted"><?php echo $log_data_antiga; ?></span> <span class="text-success"><i class="fas fa-arrow-right"></i></span> <?php echo $log_data_nova; ?></td>
                <td><?php echo $log_motivo; ?></td>
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

<hr>

<div class="well">
	<div class="row">
    	<div class="col-md-4 text-center text-muted">
    		<i class="fas fa-cart-plus"></i>
            <br>
            <strong><small>PEDIDO CRIADO</small></strong>
            <br>
            <small><?php echo $data; ?> - <?php echo nome_representante($usuario, $conexao); ?></small>
    	</div>
        <div class="col-md-4 text-center text-muted">
    		<i class="fas fa-share-square"></i>
            <br>
            <strong><small>PEDIDO SOLICITADO</small></strong>
            <?php if ($sol_usuario != null) { ?>
            <br>
            <small><?php echo $sol_data; ?> - <?php echo nome_representante($sol_usuario, $conexao); ?></small>
            <?php } ?>
    	</div>
        <div class="col-md-4 text-center text-muted">
    		<?php
			if ($status == "R") {
			?>
            <i class="far fa-check-circle"></i>
            <br>
            <strong><small>PEDIDO APROVADO</small></strong>
            <?php if ($rec_usuario != null) { ?>
            <br>
            <small><?php echo $rec_data; ?> - <?php echo nome_representante($rec_usuario, $conexao); ?></small>
            <?php } ?>
            <?php
			}
			else if ($status == "X") {
			?>
            <i class="far fa-times-circle"></i>
            <br>
            <strong><small>PEDIDO RECUSADO</small></strong>
            <?php if ($rec_usuario != null) { ?>
            <br>
            <small><?php echo $rec_data; ?> - <?php echo nome_representante($rec_usuario, $conexao); ?></small>
            <?php } ?>
            <?php
			}
			?>
    	</div>
    </div>
</div>

</div>
</div>

<!-- Modal - Recusar Pedido -->
<div class="modal fade" id="recusar-pedido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title" id="myModalLabel"><i class="far fa-times-circle"></i> &nbsp; Recusar Pedido</h4>
            </div>
            <div class="modal-body">
            	<form method="post" action="funcoes/moveleiro_pedidos.php?funcao=recusar_pedido&pedido=<?php echo $pedido; ?>&id_pedido=<?php echo $id_pedido; ?>" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label for="inputMotivo" class="col-sm-3 control-label">Motivo</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-bullhorn" aria-hidden="true"></i></span>
                                    <input type="text" name="motivo" class="form-control" id="inputMotivo" maxlength="100" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-primary btn-lg">Salvar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
            	<button type="button" class="btn btn-inverse btn-sm" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal - Recusar Pedido -->

<!-- Modal - Prazo -->
<div class="modal fade" id="prazo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title" id="myModalLabel"><i class="far fa-calendar-alt"></i> &nbsp; Limite de Produção</h4>
            </div>
            <div class="modal-body">
            	<form method="post" action="funcoes/moveleiro_pedidos.php?funcao=prazo&pedido=<?php echo $pedido; ?>&id_pedido=<?php echo $id_pedido; ?>" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label for="inputPrazoEntrega" class="col-sm-3 control-label">Limite Produção</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" name="prazo_entrega" class="form-control" id="inputPrazoEntrega" required min="<?php echo $prazo_entrega; ?>" value="<?php echo $prazo_entrega; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputMotivo" class="col-sm-3 control-label">Motivo</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-bullhorn"></i></span>
                                    <input type="text" name="motivo" class="form-control" id="inputMotivo" maxlength="100" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" name="prazo_atual" value="<?php echo $prazo_entrega; ?>">
                        
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-primary btn-lg">Atualizar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
            	<button type="button" class="btn btn-inverse btn-sm" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal - Prazo -->

<?php } // Permissão para acessar a página ?>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
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
    	<h1>Moveleiro: Novo Pedido</h1>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="repsys.php">Início</a></li>
            <li><a href="moveleiro-gerenciar-pedidos.php">Pedidos</a></li>
            <li class="active">Digitação do Pedido</li>
        </ol>
	</div>
</div>

<?php
include_once("includes/msgs.php");
?>

<?php if ($p_pedmov_solicitar == "S") { ?>

<?php
$pedido = $_GET['pedido'];

$consulta_pedido = mysqli_query ($conexao, "SELECT * FROM moveleiro_pedidos WHERE codigo='$pedido'") or die (mysqli_error());
	$dados_pedido = mysqli_fetch_array ($consulta_pedido);
		$id_pedido 		= $dados_pedido['id'];
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
		
		$n_id = str_pad($id_pedido, 5, "0", STR_PAD_LEFT);
	
		$prazo_entrega_f = date('d/m/Y', strtotime($prazo_entrega));
		
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

// Consulta itens
$consulta_itens = mysqli_query ($conexao, "SELECT * FROM moveleiro_itens WHERE id_pedido='$id_pedido'") or die (mysqli_error());

$conta_itens = mysqli_num_rows ($consulta_itens);
?>

<div class="row">
	<div class="col-xs-6">
    	<div id="n-solicitacao">
        	<span id="n-pedido">#<?php echo $n_id; ?></span>
        </div>
    </div>
    <div class="col-xs-6 text-right">
    	<?php if ($status == "D" && $conta_itens > 0) { ?>
        <a href="funcoes/moveleiro_pedidos.php?funcao=solicitar&pedido=<?php echo $pedido; ?>" class="btn btn-success btn-lg"><i class="fas fa-paper-plane"></i> Solicitar Pedido</a>
        <?php } ?>
    </div>
</div>

<?php if ($status == "D" && $conta_itens > 0) { ?>
<div class="row" id="aviso-pedido">
	<div class="col-md-12">
    	<i class="fas fa-exclamation-triangle"></i> QUANDO TERMINAR DE DIGITAR O SEU PEDIDO, CLIQUE EM <strong>SOLICITAR PEDIDO</strong>
    </div>
</div>
<?php } ?>

<div class="row" id="info-pedido">
	<div class="col-md-5">
    	<small><strong class="text-muted">CLIENTE:</strong> <?php echo $cliente_cod; ?> - <?php echo $cliente_nome; ?></small>
        <br>
        <small><strong class="text-muted">ROTA:</strong> <?php echo $cliente_rota; ?></small>
        <br>
        <small><strong class="text-muted">CIDADE:</strong> <?php echo $cliente_cidade; ?> / <?php echo $cliente_uf; ?></small>
    </div>
    <div class="col-md-3">
    	<small><strong class="text-muted">FORMA PAGAMENTO:</strong> <?php echo $forma_pgto; ?></small>
        <br>
        <small><strong class="text-muted">LIMITE PRODUÇÃO:</strong> <?php echo $prazo_entrega_f; ?></small>
        <br>
        <small><strong class="text-muted">ID:</strong> <?php echo $pedido_id; ?></small>
    </div>
    <div class="col-md-3">
    	<small><strong class="text-muted">TRANSPORTE:</strong> <?php echo $transporte_desc; ?></small>
        <br>
        <small><strong class="text-muted">FRETE:</strong> <?php echo $frete_desc; ?></small>
    </div>
    <div class="col-md-1 text-right">
    	<br class="visible-xs">
        <a href="#editar-cliente" data-toggle="modal" data-target="#editar-cliente" class="btn btn-warning btn-xs btn-block"><i class="fas fa-pencil-alt"></i></a>
    </div>
</div>

<div class="row" id="obs-cancelamento">
	<div class="col-md-12">
    	<strong>ATENÇÃO</strong>
        <br><br>
        APÓS A APROVAÇÃO DESTE PELO DEPARTAMENTO COMERCIAL, NÃO SERÃO ACEITAS ALTERAÇÕES
        <br>
        OS VALORES SERÃO VALIDADOS ANTES DA APROVAÇÃO DO PEDIDO
    </div>
</div>

<div class="row">

<div class="col-md-8">

<form method="post" action="funcoes/moveleiro_pedidos.php?funcao=itens&pedido=<?php echo $pedido; ?>&id_pedido=<?php echo $id_pedido; ?>" enctype="multipart/form-data" class="form-horizontal">
    <fieldset>
        <legend>Incluir Itens ao Pedido</legend>
        
        <div class="form-group">
        	<label for="inputQtde" class="col-sm-3 control-label">Qtde</label>
            <div class="col-sm-4">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-calculator"></i></span>
                	<input type="number" name="qtde" class="form-control" id="inputQtde" autocomplete="off" required autofocus>
                </div>
            </div>
            <br class="visible-xs">
            <div class="col-sm-4">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-shopping-cart"></i></span>
                	<select name="un" class="form-control" id="selectUnidade" required>
                        <option value="PÇ">PÇ</option>
                        <option value="UN">UN</option>
                        <option value="KIT">KIT</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="inputDescricao" class="col-sm-3 control-label">Descrição</label>
            <div class="col-sm-8">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-archive"></i></span>
                	<input type="text" name="descricao" class="form-control" id="inputDescricao" autocomplete="off" maxlength="200" required>
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="selectEmbalagem" class="col-sm-3 control-label">Embalagem</label>
            <div class="col-sm-8">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fab fa-accusoft"></i></span>
                	<select name="embalagem" class="form-control" id="selectEmbalagem" required>
                    	<option></option>
						<?php
						$con_embalagens = mysqli_query ($conexao, "SELECT * FROM moveleiro_embalagens WHERE ativo='S' ORDER BY tipo") or die (mysqli_error());
						while ($d_emb = mysqli_fetch_array ($con_embalagens)) {
							$emb_id 	= $d_emb['id'];
							$emb_tipo 	= $d_emb['tipo'];
							$emb_desc 	= $d_emb['descricao'];
						?>
                        <option value="<?php echo $emb_id; ?>"><?php echo $emb_tipo; ?> - <?php echo $emb_desc; ?></option>
                        <?php
						}
						?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="inputPrecoUn" class="col-sm-3 control-label">Preço Unitário</label>
            <div class="col-sm-4">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>
                	<input type="text" name="preco" class="form-control" id="inputPrecoUn" required>
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="inputIPI" class="col-sm-3 control-label">IPI</label>
            <div class="col-sm-3">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-percent fa-xs"></i></span>
                	<input type="number" name="ipi" class="form-control" id="inputIPI" min="0" step="0.01">
                </div>
            </div>
        </div>
        
        <hr>
        
        <div class="form-group">
        	<label for="inputAnexo" class="col-sm-3 control-label">Anexar Projeto</label>
            <div class="col-sm-8">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-paperclip"></i></span>
                	<input type="file" name="anexo" class="form-control" id="inputAnexo" accept=".pdf, image/*">
                </div>
                <span id="inputAnexo" class="help-block">Envie arquivos PDF ou arquivos de imagem (jpg, png)</span>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Incluir Item</button>
            </div>
        </div>
    </fieldset>
</form>

</div>

<div class="col-md-4">

<div class="well">

<form method="post" action="funcoes/moveleiro_pedidos.php?funcao=obs&pedido=<?php echo $pedido; ?>&id_pedido=<?php echo $id_pedido; ?>" class="form-horizontal">
    <fieldset>
        <legend>Observações do Pedido</legend>
        
        <div class="form-group">
        	<label for="textObs" class="col-sm-3 control-label">Observações</label>
            <div class="col-sm-9">
               	<textarea name="obs" class="form-control" rows="10" id="textObs"><?php echo $obs; ?></textarea>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </fieldset>
</form>

</div>

</div>

</div>

<div class="row">

<div class="col-md-12">

<hr>

<h2>Itens Adicionados ao Pedido</h2>

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
            <th></th>
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
                <a href="pedidos/moveleiro/<?php echo $item_anexo; ?>" target="_blank" class="btn btn-xs btn-primary btn-block">
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
            <td>
            	<a href="moveleiro-item-editar.php?pedido=<?php echo $pedido; ?>&item=<?php echo $item_codigo; ?>" class="btn btn-xs btn-warning btn-block">
                	<i class="fas fa-pencil-alt"></i>
                </a>
            </td>            
            <td>
                <a href="funcoes/moveleiro_pedidos.php?funcao=excluir_item&pedido=<?php echo $pedido; ?>&item=<?php echo $item_codigo; ?>" class="btn btn-xs btn-danger btn-block" onClick="return confirm('Tem certeza que deseja excluir este item?')">
                    <i class="fas fa-trash-alt"></i>
                </a>
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
            <td><strong>R$ <?php echo $total_p; ?></strong></td>
            <td><strong>R$ <?php echo $total_p_ipi; ?></strong></td>
            <td></td>
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

</div>

</div>

<!-- Modal - Editar Clientes -->
<div class="modal fade" id="editar-cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title" id="myModalLabel"><i class="fas fa-pencil-alt"></i> &nbsp; Editar Cliente</h4>
            </div>
            <div class="modal-body">
            	<form method="post" action="funcoes/moveleiro_pedidos.php?funcao=editar&pedido=<?php echo $pedido; ?>" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label for="inputCliente" class="col-sm-3 control-label">Cliente</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-user"></i></span>
                                    <input type="text" name="cliente" class="form-control" id="inputCliente" autocomplete="off" required value="<?php echo $cliente_cod; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputIdPedido" class="col-sm-3 control-label">Id. Pedido</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="far fa-address-card"></i></span>
                                    <input type="text" name="pedido_id" class="form-control" id="inputIdPedido" autocomplete="off" maxlength="50" placeholder="Identificação do pedido" value="<?php echo $pedido_id; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPrazoEntrega" class="col-sm-3 control-label">Prazo Entrega</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                                    <input type="date" name="prazo_entrega" class="form-control" id="inputPrazoEntrega" required min="<?php echo date("Y-m-d"); ?>" value="<?php echo $prazo_entrega; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="selectTransporte" class="col-sm-3 control-label">Transporte</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-truck"></i></span>
                                    <select name="transporte" class="form-control" id="selectTransporte" required>
                                        <option value="P"<?php if ($transporte == "P") { echo " selected"; } ?>>PRÓPRIO</option>
                                        <option value="R"<?php if ($transporte == "R") { echo " selected"; } ?>>RETIRA</option>
                                        <option value="T"<?php if ($transporte == "T") { echo " selected"; } ?>>TRANSPORTADORA</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="selectFrete" class="col-sm-3 control-label">Frete</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-road"></i></span>
                                    <select name="frete" class="form-control" id="selectFrete" required>
                                        <option value="C"<?php if ($frete == "C") { echo " selected"; } ?>>CIF</option>
                                        <option value="F"<?php if ($frete == "F") { echo " selected"; } ?>>FOB</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-primary">Atualizar</button>
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
<!-- Modal - Editar Clientes -->

<!-- Verifica Código Cliente -->
<script type="text/javascript">
$(function(){
	$("input[name='cliente']").keyup( function(){
		var cliente = $("input[name='cliente']").val();
		$.post('funcoes/verifica_cliente.php',{cliente: cliente},function(data){
			$('#resultado').html(data);
		});
	});
});
</script>

<?php } // Permissão para acessar a página ?>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
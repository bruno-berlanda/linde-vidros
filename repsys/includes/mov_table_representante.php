<div class="table-responsive">
<table class="table table-striped table-condensed" id="table-smaller">
    <thead>
    	<tr>
        	<th></th>
            <th></th>
            <th>#</th>
            <th>DATA</th>
            <th>CLIENTE</th>
            <th>ROTA</th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha = mysqli_fetch_array($consulta_pedidos)) {
    $id 				= $linha['id'];
    $data				= $linha['data'];
	$codigo 			= $linha['codigo'];
	$cliente_cod 		= $linha['cliente_cod'];
    $cliente_nome		= $linha['cliente_nome'];
	$cliente_rota 		= $linha['cliente_rota'];
	$cliente_cidade 	= $linha['cliente_cidade'];
    $cliente_uf			= $linha['cliente_uf'];
	$pedido_id			= $linha['pedido_id'];
	$status 			= $linha['status'];
	
	/* *** */
	
	$n_id = str_pad($id, 5, "0", STR_PAD_LEFT);
	
	$data = date('d/m/Y H:i:s', strtotime($data));
	
	if ($status == "D") {
		$class_status_texto = "text-muted";
	}
	else if ($status == "P") {
		$class_status_texto = "text-warning";
	}
	else if ($status == "R") {
		$class_status_texto = "text-success";
	}
	else if ($status == "X") {
		$class_status_texto = "text-danger";
	}
?>
    
    	<tr class="<?php echo $class_status_texto; ?>">
        	<td>
                <?php
				if ($status != "R") {
				?>
                <a href="moveleiro-pedido-itens.php?pedido=<?php echo $codigo; ?>" class="btn btn-xs btn-block btn-warning">
                	<i class="fas fa-pencil-alt"></i>
                </a>
                <?php
				} else {
				?>
                <button class="btn btn-xs btn-default btn-block disabled">
                	<i class="fas fa-pencil-alt"></i>
                </button>
                <?php
				}
				?>
            </td>
            <td>
                <a href="moveleiro-pedido-imprimir.php?pedido=<?php echo $codigo; ?>" target="_blank" class="btn btn-xs btn-block btn-success">
                	<i class="fas fa-print"></i>
                </a>
            </td>
            <td><?php echo $n_id; ?></td>
            <td><?php echo $data; ?></td>
            <td><?php echo $cliente_cod; ?> - <?php echo $cliente_nome; ?> <br> <em><small><?php echo $pedido_id; ?></small></em></td>
            <td><?php echo $cliente_rota; ?></td>
            <td>
                <a href="funcoes/moveleiro_pedidos.php?funcao=excluir_pedido&pedido=<?php echo $codigo; ?>" class="btn btn-xs btn-block btn-danger" onClick="return confirm('Tem certeza que deseja excluir este pedido?\n\n#<?php echo $n_id; ?> | <?php echo $cliente_cod; ?> - <?php echo $cliente_nome; ?>')">
                	<i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
 <?php } ?>

	</tbody>
</table>
</div>
<div class="table-responsive">
<table class="table table-striped table-condensed" id="table-smaller">
    <thead>
    	<tr>
        	<th></th>
            <th></th>
            <th>#</th>
            <th>DATA</th>
            <th>REPRESENTANTE</th>
            <th>CLIENTE</th>
            <th>ROTA</th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha = mysqli_fetch_array($consulta_pedidos)) {
    $id 				= $linha['id'];
    $data				= $linha['data'];
	$usuario			= $linha['usuario'];
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
                <a href="moveleiro-pedido-ver.php?pedido=<?php echo $codigo; ?>" class="btn btn-xs btn-block btn-primary">
                	<i class="fas fa-search"></i>
                </a>
            </td>
            <td>
                <a href="moveleiro-pedido-imprimir.php?pedido=<?php echo $codigo; ?>" target="_blank" class="btn btn-xs btn-block btn-success">
                	<i class="fas fa-print"></i>
                </a>
            </td>
            <td><?php echo $n_id; ?></td>
            <td><?php echo $data; ?></td>
            <td><?php echo nome_representante($usuario, $conexao); ?></td>
            <td><?php echo $cliente_cod; ?> - <?php echo $cliente_nome; ?> <br> <em><small><?php echo $pedido_id; ?></small></em></td>
            <td><?php echo $cliente_rota; ?></td>
        </tr>
 <?php } ?>

	</tbody>
</table>
</div>
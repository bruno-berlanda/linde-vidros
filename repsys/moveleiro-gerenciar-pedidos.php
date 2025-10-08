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
    	<h1>Moveleiro: Pedidos</h1>
    </div>
</div>

<?php
include_once("includes/msgs.php");
?>

<?php if ($p_pedmov_solicitar == "S" || $p_pedmov_gerenciar == "S") { ?>

<div class="row">
    <div class="col-md-4">
    
    <p><a class="btn btn-default" role="button" data-toggle="collapse" href="#Legenda" aria-expanded="false" aria-controls="#Legenda"><i class="far fa-list-alt"></i> Legenda</a></p>
    
    <div class="collapse" id="Legenda">
        <table class="table table-striped table-condensed">
        	<tbody>
            	<tr class="text-muted">
                	<td><small><strong>PEDIDO EM DIGITAÇÃO</strong>, ENQUANTO O PEDIDO ESTIVER EM DIGITAÇÃO, O SETOR MOVELEIRO NÃO VISUALIZARÁ</small></td>
                </tr>
                <tr class="text-warning">
                	<td><small><strong>PEDIDO SOLICITADO</strong>, O SETOR DO MOVELEIRO RECEBEU O PEDIDO, MAS AINDA NÃO FOI LIBERADO PARA PRODUÇÃO</small></td>
                </tr>
                <tr class="text-success">
                	<td><small><strong>PRODUTO LIBERADO</strong>, O PEDIDO FOI ACEITO PELO SETOR MOVELEIRO E ESTÁ EM PRODUÇÃO</small></td>
                </tr>
                <tr class="text-danger">
                	<td><small><strong>PEDIDO RECUSADO</strong>, O PEDIDO FOI RECUSADO PELO SETOR MOVELEIRO</small></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <br>
    
<?php
/* **********************************************************
GERENTE MOVELEIRO
********************************************************** */
if ($p_pedmov_gerenciar == "S") {
	
	require_once ("includes/mov_filtro_gerente.php");
	
	if (isset($_GET['filtro_data1']) || isset($_GET['filtro_data2']) || isset($_GET['filtro_requerente']) || isset($_GET['filtro_cliente']) || isset($_GET['filtro_status'])) {
		
		$filtro_data1 			= $_GET['filtro_data1'];
		$filtro_data2 			= $_GET['filtro_data2'];
		$filtro_requerente 		= $_GET['filtro_requerente'];
		$filtro_cliente 		= $_GET['filtro_cliente'];
		$filtro_status 			= $_GET['filtro_status'];
		
		// DATAS
		/* Data 1 */
		if ($filtro_data1 == "") { $data1_consulta = $data_filtro_bd; } else { $data1_consulta = $filtro_data1; }
		/* Data 2 */
		if ($filtro_data2 == "") { $data2_consulta = $data_atual_bd; } else { $data2_consulta = $filtro_data2; }
		
		// DEMAIS FILTROS
		/* Requerente */
		if ($filtro_requerente == "") { $sql_requerente = ""; } else { $sql_requerente = " AND usuario='$filtro_requerente'"; }
		/* Cliente */
		if ($filtro_cliente == "") { $sql_cliente = ""; } else { $sql_cliente = " AND cliente_cod='$filtro_cliente'"; }
		/* Status */
		if ($filtro_status == "") { $sql_status = ""; } else { $sql_status = " AND status='$filtro_status'"; }
		
		$sql_consulta = "SELECT * FROM moveleiro_pedidos WHERE date_format(data, '%Y-%m-%d')>='$data1_consulta' AND date_format(data, '%Y-%m-%d')<='$data2_consulta'".$sql_requerente.$sql_cliente.$sql_status." ORDER BY data DESC";
		
	}
	else {
		
		$sql_consulta = "SELECT * FROM moveleiro_pedidos WHERE status='P' ORDER BY data DESC";
		
	}
?>
		
<?php
}
/* **********************************************************
REPRESENTANTE
********************************************************** */
else {
	
	require_once ("includes/mov_filtro_representante.php");
	
	if (isset($_GET['filtro_data1']) || isset($_GET['filtro_data2']) || isset($_GET['filtro_cliente']) || isset($_GET['filtro_status'])) {
		
		$filtro_data1 			= $_GET['filtro_data1'];
		$filtro_data2 			= $_GET['filtro_data2'];
		$filtro_cliente 		= $_GET['filtro_cliente'];
		$filtro_status 			= $_GET['filtro_status'];
		
		// DATAS
		/* Data 1 */
		if ($filtro_data1 == "") { $data1_consulta = $data_filtro_bd; } else { $data1_consulta = $filtro_data1; }
		/* Data 2 */
		if ($filtro_data2 == "") { $data2_consulta = $data_atual_bd; } else { $data2_consulta = $filtro_data2; }
		
		// DEMAIS FILTROS
		/* Cliente */
		if ($filtro_cliente == "") { $sql_cliente = ""; } else { $sql_cliente = " AND cliente_cod='$filtro_cliente'"; }
		/* Status */
		if ($filtro_status == "") { $sql_status = ""; } else { $sql_status = " AND status='$filtro_status'"; }
		
		$sql_consulta = "SELECT * FROM moveleiro_pedidos WHERE date_format(data, '%Y-%m-%d')>='$data1_consulta' AND date_format(data, '%Y-%m-%d')<='$data2_consulta' AND usuario='$id_usuario'".$sql_cliente.$sql_status." ORDER BY data DESC";
		
	}
	else {
		
		$data1_consulta = $data_filtro_bd;
		$data2_consulta = $data_atual_bd;
		
		$sql_consulta = "SELECT * FROM moveleiro_pedidos WHERE date_format(data, '%Y-%m-%d')>='$data1_consulta' AND date_format(data, '%Y-%m-%d')<='$data2_consulta' AND usuario='$id_usuario' ORDER BY data DESC";
		
	}
?>
	
<?php
}

$consulta_pedidos = mysqli_query ($conexao, $sql_consulta) or die (mysqli_error());
	$conta_pedidos = mysqli_num_rows ($consulta_pedidos);
?>
	</div>

    <div class="col-md-8">
    	<h2>Pedidos</h2>
		
		<?php
		if ($conta_pedidos == 0) {
		?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                Nenhum pedido encontrado
                </div>
            </div>
        </div>
        <?php
		} else {
		
			if ($p_pedmov_gerenciar == "S") {
				require_once ("includes/mov_table_gerente.php");
			}
			else {
				require_once ("includes/mov_table_representante.php");
			}
		
		}
		?>
    </div>
</div>

<?php

?>

<?php } // Permissão para acessar a página ?>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
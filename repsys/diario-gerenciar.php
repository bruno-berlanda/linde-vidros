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
    	<h1>Diário</h1>
    </div>
</div>

<?php
include_once("includes/msgs.php");
?>

<?php if ($p_diario == "S") { ?>

<div class="row">

<?php
// Correção [ Usuário em Branco ]
$con_dc = mysqli_query ($conexao, "SELECT id, cliente FROM diario_contato WHERE usuario='0'") or die (mysqli_error($conexao));
$conn_dc = mysqli_num_rows ($con_dc);

if ($conn_dc > 0) {
	while ($d_dc = mysqli_fetch_array ($con_dc)) {
		$dc_id 		= $d_dc['id'];
		$dc_cliente = $d_dc['cliente'];
		
		$con_rc = mysqli_query ($conexao, "SELECT responsavel FROM geral_clientes WHERE id='$dc_cliente'") or die (mysqli_error($conexao));
			$d_rc = mysqli_fetch_array ($con_rc);
				$resp_cliente = $d_rc['responsavel'];
		
		$atu_usuario = mysqli_query ($conexao, "UPDATE diario_contato SET usuario='$resp_cliente' WHERE id='$dc_id'") or die (mysqli_error($conexao));
	}
}
?>

<?php
// Data Inicial
if (isset($_GET['data_inicial']) && $_GET['data_inicial'] != "") {
	$form_data_inicial = $_GET['data_inicial'];
}
else {
	$form_data_inicial = $data_filtro_bd;
}

// Data Final
if (isset($_GET['data_final']) && $_GET['data_final'] != "") {
	$form_data_final = $_GET['data_final'];
}
else {
	$form_data_final = $data_hoje;
}

// Representante
if (isset($_GET['representante']) && $_GET['representante'] != "") {
	$form_representante = $_GET['representante'];
}
else {
	$form_representante = "";
}

// Cliente
if (isset($_GET['cliente']) && $_GET['cliente'] != "") {
	$form_cliente = $_GET['cliente'];
}
else {
	$form_cliente = "";
}

// Rota
if (isset($_GET['rota']) && $_GET['rota'] != "") {
	$form_rota = $_GET['rota'];
}
else {
	$form_rota = "";
}

// Cliente
if (isset($_GET['status']) && $_GET['status'] != "") {
	$form_status = $_GET['status'];
}
else {
	$form_status = "";
}
?>

<div class="col-md-3">

<form method="get" action="diario-gerenciar.php">
	
    <legend>Filtro</legend>
	
    <div class="form-group">
    	<label for="inputData1">Data Inicial</label>
    	<input type="date" name="data_inicial" class="form-control" id="inputData1" value="<?php echo $form_data_inicial; ?>" required>
    </div>
    <div class="form-group">
    	<label for="inputData2">Data Final</label>
    	<input type="date" name="data_final" class="form-control" id="inputData2" value="<?php echo $form_data_final; ?>" max="<?php echo $data_hoje; ?>" required>
    </div>
    <?php
    // Gerente do sistema de Diário
	if ($p_diario_gerente == "S") {
	?>
    <div class="form-group">
    	<label for="selectRepresentante">Representante</label>
    	<select name="representante" class="form-control" id="selectRepresentante">
        	<option></option>
            <?php
			$con_representantes = mysqli_query ($conexao, "SELECT a.usuario, b.nome FROM diario_contato a, representantes b
												WHERE a.usuario=b.id GROUP BY a.usuario ORDER BY b.nome") or die (mysqli_error($conexao));
			
			while ($d_rep = mysqli_fetch_array ($con_representantes)) {
				$rep_id = $d_rep['usuario'];
				$rep_nm = $d_rep['nome'];
			?>
            <option value="<?php echo $rep_id; ?>"<?php if ($rep_id == $form_representante) { echo " selected"; } ?>><?php echo nome_sobrenome($rep_nm); ?></option>
            <?php
			}
			?>
        </select>
    </div>
    <div class="form-group">
    	<label for="selectCliente">Cliente</label>
    	<select name="cliente" class="form-control" id="selectCliente">
        	<option></option>
            <?php
			$con_clientes = mysqli_query ($conexao, "SELECT a.cliente, b.cliente AS nome FROM diario_contato a, geral_clientes b
										  WHERE a.cliente=b.id GROUP BY a.cliente ORDER BY nome") or die (mysqli_error($conexao));
			
			while ($d_cli = mysqli_fetch_array ($con_clientes)) {
				$cli_id = $d_cli['cliente'];
				$cli_nm = $d_cli['nome'];
			?>
            <option value="<?php echo $cli_id; ?>"<?php if ($cli_id == $form_cliente) { echo " selected"; } ?>><?php echo $cli_nm; ?></option>
            <?php
			}
			?>
        </select>
    </div>
    <?php
	}
	?>
    <div class="form-group">
    	<label for="selectRota">Rota</label>
    	<select name="rota" class="form-control" id="selectRota">
        	<option></option>
            <?php
			$con_rotas = mysqli_query ($conexao, "SELECT a.rota FROM diario_contato a
									   GROUP BY a.rota ORDER BY a.rota") or die (mysqli_error($conexao));
			
			while ($d_rota = mysqli_fetch_array ($con_rotas)) {
				$r_rota = $d_rota['rota'];
			?>
            <option value="<?php echo $r_rota; ?>"<?php if ($r_rota == $form_rota) { echo " selected"; } ?>><?php echo $r_rota; ?></option>
            <?php
			}
			?>
        </select>
    </div>
    <div class="form-group">
    	<label for="selectStatus">Status</label>
    	<select name="status" class="form-control" id="selectStatus">
        	<option></option>
            <option value="P"<?php if ($form_status == "P") { echo " selected"; } ?>>PENDENTE</option>
            <option value="R"<?php if ($form_status == "R") { echo " selected"; } ?>>RESPONDIDO (VENDEDOR)</option>
            <option value="G"<?php if ($form_status == "G") { echo " selected"; } ?>>RESPONDIDO (GERENTE)</option>
        </select>
    </div>

	<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Filtrar</button>
    <?php if (isset($_GET['data_inicial'])) { ?>
    <a href="diario-gerenciar.php" class="btn btn-danger"><i class="fas fa-times"></i> Filtro</a>
    <?php } ?>
</form>

<br>

<div class="well">
    <small class="text-muted"><strong>LEGENDA</strong></small>
    
    <hr>
    
    <span class="text-success"><i class="fas fa-check-circle"></i></span> Feedback com retorno do vendedor
	<br>
    <span class="text-danger"><i class="fas fa-check-circle"></i></span> Feedback com retorno do gerente
    <br>
	<span class="text-super-muted"><i class="far fa-circle"></i></span> Aguardando retorno
    
    <br><br>
    
    <span class="text-warning"><i class="fas fa-plus-square"></i></span> Cliente Novo (Não Comprou)
    <br>
    <span class="text-success"><i class="fas fa-plus-square"></i></span> Cliente Novo (Comprou)
	<br>
	<span class="text-super-muted"><i class="far fa-square"></i></span> Cliente Linde
    
    <br><br>
    
    <span class="text-warning">Contato marcado com um alerta</span>
</div>

<?php if ($p_diario_gerente == "S") { ?>
<hr>

<a href="#imprimir" role="button" class="btn btn-warning btn-block" data-toggle="modal"><i class="fas fa-print"></i> Imprimir</a>

<a href="#relatorio" role="button" class="btn btn-info btn-block" data-toggle="modal"><i class="fas fa-tv"></i> Relatório</a>

<hr>

<div class="well">
    <form method="get" action="diario-relatorio-mes.php" target="_blank">
        <fieldset>
        
        <legend>Relatório Mensal</legend>
        
        <div class="form-group">
            <label for="inputMes">Mês</label>
            <input type="month" name="data" class="form-control input-sm" id="inputMes" required value="<?php echo date("Y-m"); ?>" min="2018-01" max="<?php echo date("Y-m"); ?>">
        </div>
        <div class="form-group">
            <label for="selectRepresentanteRel">Representante</label>
            <select name="representante" class="form-control input-sm" id="selectRepresentanteRel" required>
                <option></option>
                <?php
                $con_rep = mysqli_query ($conexao, "SELECT a.usuario, b.nome FROM diario_contato a, representantes b
                                         WHERE a.usuario=b.id GROUP BY a.usuario ORDER BY b.nome") or die (mysqli_error($conexao));
                
                while ($d_r = mysqli_fetch_array ($con_rep)) {
                    $r_id = $d_r['usuario'];
                    $r_nm = $d_r['nome'];
                ?>
                <option value="<?php echo $r_id; ?>"><?php echo nome_sobrenome($r_nm); ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-sm btn-default btn-block"><i class="fas fa-spinner"></i> Gerar Relatório</button>
        
        </fieldset>
    </form>
</div>
<?php } ?>

<hr class="visible-xs">

</div>

<div class="col-md-9">

<?php
/* ****************************************************
FILTROS
**************************************************** */
if (isset($_GET['data_inicial']) && $_GET['data_inicial'] != "") {
	$filtro_data1 = $_GET['data_inicial'];
}
else {
	$filtro_data1 = $data_filtro_bd;
}

if (isset($_GET['data_final']) && $_GET['data_final'] != "") {
	$filtro_data2 = $_GET['data_final'];
}
else {
	$filtro_data2 = $data_hoje;
}

if (isset($_GET['representante']) && $_GET['representante'] != "") {
	$filtro_rep = $_GET['representante'];
	
	$sql_rep = " AND usuario='$filtro_rep'";
}
else {
	$sql_rep = "";
}

if (isset($_GET['cliente']) && $_GET['cliente'] != "") {
	$filtro_cli = $_GET['cliente'];
	
	$sql_cli = " AND cliente='$filtro_cli'";
}
else {
	$sql_cli = "";
}

if (isset($_GET['rota']) && $_GET['rota'] != "") {
	$filtro_rot = $_GET['rota'];
	
	$sql_rot = " AND rota='$filtro_rot'";
}
else {
	$sql_rot = "";
}

if (isset($_GET['status']) && $_GET['status'] != "") {
	$filtro_sta = $_GET['status'];
	
	$sql_sta = " AND status='$filtro_sta'";
}
else {
	$sql_sta = "";
}

/* ****************************************************
CONSULTAS
**************************************************** */
if ($p_diario_gerente == "S") {
	$sql = "SELECT * FROM diario_contato 
			WHERE 
			date_format(data_visita, '%Y-%m-%d')>='$filtro_data1' AND 
			date_format(data_visita, '%Y-%m-%d')<='$filtro_data2'".$sql_rep.$sql_cli.$sql_rot.$sql_sta." 
			ORDER BY alerta DESC, data_visita DESC";
}
else {
	if ($tipo_usuario == "R" && $p_diario_gerente == "N") {
		$sql = "SELECT * FROM diario_contato 
				WHERE 
				date_format(data_visita, '%Y-%m-%d')>='$filtro_data1' AND 
				date_format(data_visita, '%Y-%m-%d')<='$filtro_data2' AND 
				usuario='$id_usuario'".$sql_rot.$sql_sta."
				ORDER BY alerta DESC, data_visita DESC";
	}
	elseif ($tipo_usuario == "V" && $p_diario_gerente == "N") {
		$sql = "SELECT * FROM diario_contato 
				WHERE 
				date_format(data_visita, '%Y-%m-%d')>='$filtro_data1' AND 
				date_format(data_visita, '%Y-%m-%d')<='$filtro_data2' AND 
				usuario='$id_usuario'".$sql_rot.$sql_sta."
				OR
				date_format(data_visita, '%Y-%m-%d')>='$filtro_data1' AND 
				date_format(data_visita, '%Y-%m-%d')<='$filtro_data2' AND 
				vendedor1='$id_usuario'".$sql_rot.$sql_sta."
				OR
				date_format(data_visita, '%Y-%m-%d')>='$filtro_data1' AND 
				date_format(data_visita, '%Y-%m-%d')<='$filtro_data2' AND 
				vendedor2='$id_usuario'".$sql_rot.$sql_sta."
				OR
				date_format(data_visita, '%Y-%m-%d')>='$filtro_data1' AND 
				date_format(data_visita, '%Y-%m-%d')<='$filtro_data2' AND 
				vendedor3='$id_usuario'".$sql_rot.$sql_sta."
				ORDER BY alerta DESC, data_visita DESC";
	}
}

$consulta_diario = mysqli_query ($conexao, $sql) or die (mysqli_error($conexao));
$conta_diario = mysqli_num_rows ($consulta_diario);

if ($conta_diario == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fas fa-exclamation-triangle"></i>
		Nenhum contato foi encontrado
		</div>
	</div>
</div>
<?php
}
else {
?>
<div class="table-responsive">
<table class="table table-striped table-condensed">
	<thead>
    	<tr>
        	<th></th>
            <th></th>
            <th>#</th>
            <th>DATA VISITA</th>
            <th></th>
            <th>CLIENTE</th>
            <th>RESPONSÁVEL</th>
        </tr>
    </thead>
    <tbody>
    	<?php
		while ($dados_diario = mysqli_fetch_array ($consulta_diario)) {
			$d_id 			= $dados_diario['id'];
			$d_codigo 		= $dados_diario['codigo'];
			$d_data 		= $dados_diario['data_visita'];
			$d_usuario 		= $dados_diario['usuario'];
			$d_cliente 		= $dados_diario['cliente'];
			$d_alerta 		= $dados_diario['alerta'];
			$d_fv 			= $dados_diario['fechou_venda'];
			$d_status 		= $dados_diario['status'];
			
			$n_id = str_pad($d_id, 5, "0", STR_PAD_LEFT);
	
			$data = date('d/m/Y', strtotime($d_data));
			
			switch ($d_status) {
				case "P":
					$status_cor = "text-super-muted";
					$status_img = "far fa-circle";
					break;
				case "R":
					$status_cor = "text-success";
					$status_img = "fas fa-check-circle";
					break;
				case "G":
					$status_cor = "text-danger";
					$status_img = "fas fa-check-circle";
					break;
			}
		?>
        <tr<?php if ($d_alerta == "S") { echo " class=\"text-warning\""; } ?>>
        	<td>
                <a href="diario-ver.php?c=<?php echo $d_codigo; ?>&di=<?php echo $_GET['data_inicial'] ?? ''; ?>&df=<?php echo $_GET['data_final'] ?? ''; ?>&re=<?php echo $_GET['representante'] ?? ''; ?>&cl=<?php echo $_GET['cliente'] ?? ''; ?>&st=<?php echo $_GET['status'] ?? ''; ?>" class="btn btn-primary btn-xs btn-block">
                	<i class="fas fa-search"></i>
                </a>
            </td>
            <td><span class="<?php echo $status_cor; ?>"><i class="<?php echo $status_img; ?>" aria-hidden="true"></i></span></td>
            <td class="text-muted"><?php echo $n_id; ?></td>
            <td><?php echo $data; ?></td>
            <td><?php echo cliente_novo($d_cliente, $conexao); ?></td>
            <td><?php echo cliente_completo($d_cliente, $conexao); ?></td>
            <td><?php echo nome_representante($d_usuario, $conexao); ?></td>
        </tr>
        <?php
		}
		?>
    </tbody>
</table>
</div>
<?php
}
?>

</div>

</div>

<!-- Modal -->
<div class="modal fade" id="imprimir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fas fa-print"></i></span> Imprimir</h4>
            </div>
            
            <div class="modal-body">
                <form method="get" action="diario-imprimir-lista.php" target="_blank">
                    <div class="form-group">
                        <label for="inputData1">Data Inicial</label>
                        <input type="date" name="data_inicial" class="form-control" id="inputData1" value="<?php echo $form_data_inicial; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="inputData2">Data Final</label>
                        <input type="date" name="data_final" class="form-control" id="inputData2" value="<?php echo $form_data_final; ?>" max="<?php echo $data_hoje; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="selectRepresentante">Representante</label>
                        <select name="representante" class="form-control" id="selectRepresentante">
                            <option></option>
                            <?php
                            $con_representantes = mysqli_query ($conexao, "SELECT a.usuario, b.nome FROM diario_contato a, representantes b WHERE a.usuario=b.id GROUP BY a.usuario ORDER BY b.nome") or die (mysqli_error($conexao));
                            
                            while ($d_rep = mysqli_fetch_array ($con_representantes)) {
                                $rep_id = $d_rep['usuario'];
                                $rep_nm = $d_rep['nome'];
                            ?>
                            <option value="<?php echo $rep_id; ?>"<?php if ($rep_id == $form_representante) { echo " selected"; } ?>><?php echo nome_sobrenome($rep_nm); ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="selectRota">Rota</label>
                        <select name="rota" class="form-control" id="selectRota">
                            <option></option>
                            <?php
                            $con_rotas = mysqli_query ($conexao, "SELECT rota FROM diario_contato GROUP BY rota ORDER BY rota") or die (mysqli_error($conexao));
                            
                            while ($d_rot = mysqli_fetch_array ($con_rotas)) {
                                $rot_num = $d_rot['rota'];
                            ?>
                            <option value="<?php echo $rot_num; ?>"<?php if ($rot_num == $form_rota) { echo " selected"; } ?>><?php echo $rot_num; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Agrupar Clientes</label>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="agrupar" value="S"> Agrupar Clientes
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Modo Relatório</label>
                        <div class="checkbox">
                            <label>
                                <input type="radio" name="visualizacao" value="T" checked> Tela &nbsp;&nbsp;&nbsp; <input type="radio" name="visualizacao" value="E" disabled> Excel
                            </label>
                        </div>
                    </div>
                	
                    <hr>
                    
                    <button type="submit" class="btn btn-primary"><i class="fas fa-spinner"></i> Gerar Relatório</button>
                </form>
            </div>
        
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="relatorio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fas fa-tv"></i></span> Relatório</h4>
            </div>
            
            <div class="modal-body">
                <form method="get" action="diario-relatorio.php" target="_blank">
                    <div class="form-group">
                        <label for="inputData1">Data Inicial</label>
                        <input type="date" name="data_inicial" class="form-control" id="inputData1" value="2018-01-01" required>
                    </div>
                    <div class="form-group">
                        <label for="inputData2">Data Final</label>
                        <input type="date" name="data_final" class="form-control" id="inputData2" value="<?php echo $form_data_final; ?>" max="<?php echo $data_hoje; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="selectRepresentante">Representante</label>
                        <select name="representante" class="form-control" id="selectRepresentante" required>
                            <option></option>
                            <?php
                            $con_representantes = mysqli_query ($conexao, "SELECT a.usuario, b.nome FROM diario_contato a, representantes b
                                                                WHERE a.usuario=b.id GROUP BY a.usuario ORDER BY b.nome") or die (mysqli_error($conexao));
                            
                            while ($d_rep = mysqli_fetch_array ($con_representantes)) {
                                $rep_id = $d_rep['usuario'];
                                $rep_nm = $d_rep['nome'];
                            ?>
                            <option value="<?php echo $rep_id; ?>"<?php if ($rep_id == $form_representante) { echo " selected"; } ?>><?php echo nome_sobrenome($rep_nm); ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="selectRota">Rota</label>
                        <select name="rota" class="form-control" id="selectRota">
                            <option></option>
                            <?php
                            $con_rotas = mysqli_query ($conexao, "SELECT a.rota FROM diario_contato a
                                                       GROUP BY a.rota ORDER BY a.rota") or die (mysqli_error($conexao));
                            
                            while ($d_rot = mysqli_fetch_array ($con_rotas)) {
                                $rep_rot = $d_rot['rota'];
                            ?>
                            <option value="<?php echo $rep_rot; ?>"<?php if ($rep_rot == $form_rota) { echo " selected"; } ?>><?php echo $rep_rot; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                
                    <button type="submit" class="btn btn-primary"><i class="fas fa-spinner"></i> Gerar Relatório</button>
                </form>
            </div>
        
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<?php } // Permissão para acessar a página ?>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
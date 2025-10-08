<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_sistema.php");
include_once ("includes/usuario_logado.php");
?>

<?php
$visualizacao 	= $_GET['visualizacao'];
$agrupar = (isset($_GET['agrupar'])) ? "S" : "N";

if ($visualizacao == "E") {
	$nome_arquivo = "Relatorio - Diario Representantes";
	header("Content-type: application/vnd.ms-excel");
	header("Content-type: application/force-download");
	header("Content-Disposition: attachment; filename=$nome_arquivo.xls");
	header("Pragma: no-cache");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>Área do Representante : Linde Vidros</title>
    <link rel="shortcut icon" href="img/favicon.ico">
    
    <?php
	if ($visualizacao == "T") {
	?>
    <link rel="stylesheet" href="../css/fontawesome-all.min.css?<?php echo filemtime('../css/fontawesome-all.min.css'); ?>">
    <?php
	}    
	?>
    
    <!-- JS -->
    <!--[if lt IE 9]>
    <script src="../js/html5shiv.js"></script>
	<![endif]-->
    
    <style>
	body { font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", monospace; font-size: 10px; color: #333; }
	
	table { width: 100%; }
	
	tr.titulo td { font-weight: bold; border-bottom: 1px solid #333; background: #333; color: #FFF; padding: 3px; }
	
	tr td { height: 40px; }
	
	.text-muted { color: #AAA; }
	</style>
</head>

<body>

<?php if ($p_diario_gerente == "S") { ?>

<?php
/* ****************************************************
FILTROS
**************************************************** */
if (isset($_GET['data_inicial']) || isset($_GET['data_final']) && isset($_GET['representante']) && isset($_GET['rota'])) {
	$filtro_data1 	= $_GET['data_inicial'];
	$filtro_data2 	= $_GET['data_final'];
	$filtro_repre 	= $_GET['representante'];
	$filtro_rota 	= $_GET['rota'];
	
	$x_d1 = explode("-", $filtro_data1);
		$data_inicial = $x_d1[2]."/".$x_d1[1]."/".$x_d1[0];
	
	$x_d2 = explode("-", $filtro_data2);
		$data_final = $x_d2[2]."/".$x_d2[1]."/".$x_d2[0];
		
	// Filtro Representante
	if ($filtro_repre !== "") {
		$sql_rep = " AND a.usuario='$filtro_repre'";
	} else {
		$sql_rep = "";
	}
	
	// Filtro Rota
	if ($filtro_rota !== "") {
		$sql_rot = " AND a.rota='$filtro_rota'";
	} else {
		$sql_rot = "";
	}
	
	// TOTAL DE VISITAS
	if (isset($_GET['agrupar']) && $_GET['agrupar'] === "S") {
        $sql_diario = "SELECT a.id, a.data_visita, a.usuario, a.tipo, a.status, b.cliente, b.rota, b.cidade, b.uf, b.novo, c.nome FROM diario_contato a, geral_clientes b, representantes c WHERE date_format(a.data_visita, '%Y-%m-%d') BETWEEN '$filtro_data1' AND '$filtro_data2'".$sql_rep.$sql_rot." AND a.cliente=b.id AND a.usuario=c.id GROUP BY b.cliente ORDER BY b.rota, b.uf, b.cidade, b.cliente, a.data_visita DESC";
    }
    else {
        $sql_diario = "SELECT a.id, a.data_visita, a.usuario, a.tipo, a.status, b.cliente, b.rota, b.cidade, b.uf, b.novo, c.nome FROM diario_contato a, geral_clientes b, representantes c WHERE date_format(a.data_visita, '%Y-%m-%d') BETWEEN '$filtro_data1' AND '$filtro_data2'".$sql_rep.$sql_rot." AND a.cliente=b.id AND a.usuario=c.id ORDER BY b.rota, b.uf, b.cidade, b.cliente, a.data_visita DESC";
    }


    $con_diario = mysqli_query ($conexao, $sql_diario) or die (mysqli_error($conexao));
	$conta_diario = mysqli_num_rows ($con_diario);
	
	// TOTAL DE VISITAS: CLIENTES NOVOS
	$sql_diarios_novos_clientes = "SELECT a.id, a.data_visita, a.usuario, a.tipo, a.status, b.cliente, b.rota, b.cidade, b.uf, b.novo, c.nome FROM diario_contato a, geral_clientes b, representantes c WHERE date_format(a.data_visita, '%Y-%m-%d') BETWEEN '$filtro_data1' AND '$filtro_data2'".$sql_rep.$sql_rot." AND a.cliente=b.id AND a.usuario=c.id AND b.novo='S' ORDER BY b.rota, b.uf, b.cidade, b.cliente, a.data_visita DESC";

    $con_diario_novos = mysqli_query ($conexao, $sql_diarios_novos_clientes) or die (mysqli_error($conexao));
	$conta_diario_novos = mysqli_num_rows ($con_diario_novos);
	
	/* *** */
	
	if ($conta_diario_novos == 0) {
		$texto_novos = "";
	}
	elseif ($conta_diario_novos == 1) {
		$texto_novos = "(".$conta_diario_novos." NOVO)";
	}
	else {
		$texto_novos = "(".$conta_diario_novos." NOVOS)";
	}
?>

<h1>RELATÓRIO DE VISITAS</h1>

<table>
	<tr>
    	<td width="25%"><strong>DATA INICIAL</strong> <br> <?php echo $data_inicial; ?></td>
        <td width="25%"><strong>DATA FINAL</strong> <br> <?php echo $data_final; ?></td>
        <td width="25%"><strong>REPRESENTANTE</strong> <br> <?php echo nome_representante($filtro_repre, $conexao); ?></td>
        <td width="25%"><strong>TOTAL VISITAS</strong> <br> <?php echo $conta_diario; ?> <span class="text-muted"><?php echo $texto_novos; ?></span></td>
    </tr>
</table>

<br>

<table>
	<tr class="titulo">
        <td width="5%"></td>
        <td width="7%">#</td>
        <td width="12%">DATA VISITA</td>
        <td width="5%">ROTA</td>
        <td width="20%">CIDADE</td>
        <td width="20%">CLIENTE</td>
        <td width="21%">REPRESENTANTE</td>
        <td width="10%">TIPO CONTATO</td>
    </tr>
<?php
while ($d_diario = mysqli_fetch_array ($con_diario)) {
	$d_id 			= $d_diario['id'];
	$d_data_visita	= $d_diario['data_visita'];
	$d_usuario		= $d_diario['usuario'];
	$d_tipo			= $d_diario['tipo'];
	$d_status 		= $d_diario['status'];
	$d_cliente 		= $d_diario['cliente'];
	$d_rota 		= $d_diario['rota'];
	$d_cidade 		= $d_diario['cidade'];
	$d_uf 			= $d_diario['uf'];
	$d_novo 		= $d_diario['novo'];
	$d_nome 		= $d_diario['nome'];
	
	$n_id = str_pad($d_id, 5, "0", STR_PAD_LEFT);

	$d_data_visita = date('d/m/Y', strtotime($d_data_visita));
	
	switch ($d_tipo) {
		case "";
			$t_img = "";
			$t_txt = "";
			break;
		case "E";
			$t_img = "fas fa-envelope";
			$t_txt = "E-MAIL";
			break;
		case "S";
			$t_img = "fab fa-skype";
			$t_txt = "SKYPE";
			break;
		case "T";
			$t_img = "fas fa-phone";
			$t_txt = "TELEFONE";
			break;
		case "V";
			$t_img = "fas fa-home";
			$t_txt = "VISITA NO CLIENTE";
			break;
		case "W";
			$t_img = "fab fa-whatsapp";
			$t_txt = "WHATSAPP";
			break;
	}
	
	switch ($d_status) {
		case "P";
			$s_img = "far fa-circle";
			$s_cor = "#F1F1F1";
			break;
		case "R";
			$s_img = "fas fa-check-circle";
			$s_cor = "#FFFFFF";
			break;
		case "G";
			$s_img = "fas fa-check-circle";
			$s_cor = "#FFFFFF";
			break;
	}
?>
	<tr style="background-color: <?php echo $s_cor; ?>">
        <td><i class="<?php echo $s_img; ?>"></i></td>
        <td><?php echo $n_id; ?></td>
        <td><?php echo $d_data_visita; ?></td>
        <td><?php echo $d_rota; ?></td>
        <td><?php echo $d_cidade."/".$d_uf; ?></td>
        <td><?php echo $d_cliente; ?> <?php if ($d_novo == "S") { ?><i class="fas fa-plus-square"></i><?php } ?></td>
        <td><?php echo nome_representante($d_usuario, $conexao); ?></td>
        <td><i class="<?php echo $t_img; ?>"></i> <?php echo $t_txt; ?></td>
    </tr>
<?php
}
?>
</table>

<?php 
}

}
?>

</body>

</html>
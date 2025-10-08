<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_sistema.php");
include_once ("includes/usuario_logado.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>Área do Representante : Linde Vidros</title>
    <link rel="shortcut icon" href="img/favicon.ico">
    
    <link rel="stylesheet" href="../css/fontawesome-all.min.css?<?php echo filemtime('../css/fontawesome-all.min.css'); ?>">
    
    <!-- JS -->
    <!--[if lt IE 9]>
    <script src="../js/html5shiv.js"></script>
	<![endif]-->
    
    <style>
	body { font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", monospace; font-size: 11px; color: #333; }
	
	.registro { margin-bottom: 20px; }
	
	table { width: 100%; }
	table.border-bottom { border-bottom: 1px solid #333; }
	
	.text-right { text-align: right; }
	
	.respostas { background-color: #F2F2F2; padding: 10px; margin: 15px 0; }
	
	.feedback { }
	</style>
</head>

<body>

<?php if ($p_diario == "S") { ?>

<?php
$codigo = $_GET['c'];

// Datas
$data_inicial 	= $_POST['data_inicial'];
$data_final 	= $_POST['data_final'];

$consulta_cliente = mysqli_query ($conexao, "SELECT cliente FROM diario_contato WHERE codigo='$codigo'") or die (mysqli_error());
	$dados_c = mysqli_fetch_array ($consulta_cliente);
		$id_cliente = $dados_c['cliente'];

$con_cliente = mysqli_query ($conexao, "SELECT * FROM geral_clientes WHERE id='$id_cliente'") or die (mysqli_error());
	$dados_cliente = mysqli_fetch_array ($con_cliente);
		$c_cliente 	= $dados_cliente['cliente'];
		$c_rota 	= $dados_cliente['rota'];
		$c_cidade 	= $dados_cliente['cidade'];
		$c_uf 		= $dados_cliente['uf'];
		$c_resp		= $dados_cliente['responsavel'];
		$c_seg		= $dados_cliente['segmento'];
		$c_novo		= $dados_cliente['novo'];
?>

<?php
$con_diario = mysqli_query ($conexao, "SELECT * FROM diario_contato WHERE date_format(data_visita, '%Y-%m-%d')>='$data_inicial' AND date_format(data_visita, '%Y-%m-%d')<='$data_final' AND usuario='$c_resp' AND cliente='$id_cliente' ORDER BY data_visita DESC") or die (mysqli_error());

while ($d_diario = mysqli_fetch_array ($con_diario)) {
	$d_id 			= $d_diario['id'];
	$d_data 		= $d_diario['data'];
	$d_data_visita 	= $d_diario['data_visita'];
	$d_vendedor1 	= $d_diario['vendedor1'];
	$d_vendedor2 	= $d_diario['vendedor2'];
	$d_vendedor3 	= $d_diario['vendedor3'];
	$d_descricao 	= $d_diario['descricao'];
	$d_tipo 		= $d_diario['tipo'];
	$d_foto1 		= $d_diario['foto1'];
	$d_foto2 		= $d_diario['foto2'];
	$d_foto3 		= $d_diario['foto3'];
	$d_ret_data 	= $d_diario['retorno_data'];
	$d_ret_resp 	= $d_diario['retorno_resp'];
	$d_ret_desc 	= $d_diario['retorno_desc'];
	
	$n_id = str_pad($d_id, 5, "0", STR_PAD_LEFT);

	$data 			= date('d/m/Y H:i', strtotime($d_data));
	$data_visita 	= date('d/m/Y', strtotime($d_data_visita));
	$data_retorno 	= date('d/m/Y', strtotime($d_ret_data));
	
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
?>
<div class="registro">
<table class="border-bottom">
	<tr>
    	<td><strong>CONTATO</strong></td>
        <td class="text-right"> <strong><?php echo $data_visita; ?></strong></td>
    </tr>
</table>

<table>
	<tr>
    	<td><i class="fa fa-user" aria-hidden="true"></i> <strong>CLIENTE:</strong> <?php echo $c_cliente; ?> | <strong>ROTA:</strong> <?php echo $c_rota; ?> | <strong>CIDADE:</strong> <?php echo $c_cidade; ?>/<?php echo $c_uf; ?> | <strong>REPRESENTANTE:</strong> <?php echo nome_representante($c_resp, $conexao); ?></td>
    </tr>
</table>

<br>

<strong><small>DESCRIÇÃO DO CONTATO</small></strong>
<br>
<?php echo nl2br($d_descricao); ?>

<?php
if ($d_tipo != "") {
?>
<br><br>
<strong><small>COMO FOI REALIZADO O CONTATO</small></strong>
<br>
<i class="<?php echo $t_img; ?>"></i> <?php echo $t_txt; ?>
<?php
}
?>

<?php
/* ***************************************
CONSULTA RESPOSTAS
*************************************** */
$consulta_respostas = mysqli_query ($conexao, "SELECT * FROM diario_respostas WHERE id_contato='$d_id' ORDER BY data") or die (mysqli_error());
$conta_respostas = mysqli_num_rows ($consulta_respostas);

if ($conta_respostas > 0) {
?>
<div class="respostas">
<?php
	while ($dados_respostas = mysqli_fetch_array ($consulta_respostas)) {
		$r_data 	= $dados_respostas['data'];
		$r_usuario 	= $dados_respostas['usuario'];
		$r_feedback = $dados_respostas['feedback'];
		
		$data_resp	= date('d/m/Y H:i', strtotime($r_data));
?>
	<div class="feedback">
		<?php echo nl2br($r_feedback); ?>
        <br>
        <i class="fas fa-angle-right"></i> <small class="text-success"><?php echo $data_resp; ?> - <?php echo nome_representante($r_usuario, $conexao); ?></small>
        <br><br>
    </div>
<?php
	}
?>
</div>
<?php
}
?>

</div>

<?php
}
?>

<?php } ?>

</body>

</html>
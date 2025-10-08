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
	body { font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", monospace; font-size: 10px; color: #333; }
	
	i { color: #1469B8; } 
	
	hr { margin: 20px 0; border: 0; border-top: 1px solid #222; border-bottom: 1px solid #FFF; }
	
	.text-muted { color: #AAA; }
	
	.logo { text-align: center; }
	.logo img { height: 40px; width: auto; }
	.titulo { text-align: center; font-size: 14px; font-weight: bold; }
	.data { text-align: center; font-size: 18px; font-weight: bold; }
	.data-relatorio { text-align: right; color: #999; }
	.nome-representante { font-size: 14px; }
	
	.linha { border-bottom: 1px solid #999; margin: 20px 0; }
	
	.box-info { margin-left: 35px; }
	
	.media { background-color: #f2f2f2; text-align: center; vertical-align: middle; border-radius: 4px; padding: 6px; color: #1469B8; }
	
	table.clientes { font-size: 9px; }
	
	.rota { background-color: #1469B8; border-radius: 4px; color: #FFF; padding: 2px 4px; width: 40px; text-align: center; }
	</style>
</head>

<body>

<?php if ($p_diario_gerente == "S") { ?>

<?php
// Dados do Formulário
$data = $_GET['data']; // Y-m
$repr = $_GET['representante'];

$data_x = explode("-", $data);
?>

<p class="logo"><img src="../img/linde.png"></p>

<p class="titulo">RELATÓRIO MENSAL - DIÁRIO REPRESENTANTES</p>

<p class="data"><?php echo mes_extenso($data_x[1]); ?>/<?php echo $data_x[0]; ?></p>

<p class="data-relatorio">RELATÓRIO GERADO <?php echo date("d/m/Y H:i"); ?></p>

<p class="nome-representante"><i class="fas fa-angle-right"></i> <?php echo nome_representante($repr, $conexao); ?></p>

<?php
// Total Contatos Realizados
$con_ct = mysqli_query ($conexao, "SELECT codigo FROM diario_contato WHERE date_format(data_visita, '%Y-%m')='$data' AND usuario='$repr'") or die (mysqli_error());
	$conta_ct = mysqli_num_rows ($con_ct);

// Total Contatos NOVOS Realizados
$con_cn = mysqli_query ($conexao, "SELECT a.codigo FROM diario_contato a, geral_clientes b WHERE date_format(a.data_visita, '%Y-%m')='$data' AND a.usuario='$repr' AND a.cliente=b.id AND b.novo='S'") or die (mysqli_error());
	$conta_cn = mysqli_num_rows ($con_cn);

/* *** */
	
// Total Contatos com Retorno	
$con_crt = mysqli_query ($conexao, "SELECT codigo FROM diario_contato WHERE date_format(data_visita, '%Y-%m')='$data' AND usuario='$repr' AND status IN ('R', 'G')") or die (mysqli_error());
	$conta_crt = mysqli_num_rows ($con_crt);
	
// Total Contatos NOVOS com Retorno	
$con_crn = mysqli_query ($conexao, "SELECT a.codigo FROM diario_contato a, geral_clientes b WHERE date_format(a.data_visita, '%Y-%m')='$data' AND a.usuario='$repr' AND a.status IN ('R', 'G') AND a.cliente=b.id AND b.novo='S'") or die (mysqli_error());
	$conta_crn = mysqli_num_rows ($con_crn);

/* *** */

// Média dos Retornos
if ($conta_ct > 0) {
	$media_retorno = round(($conta_crt / $conta_ct) * 100);
}
else {
	$media_retorno = 0;	
}

/* *** */

// Total de Rotas Visitadas
$con_rotas = mysqli_query ($conexao, "SELECT DISTINCT(rota) FROM diario_contato WHERE date_format(data_visita, '%Y-%m')='$data' AND usuario='$repr' ORDER BY rota") or die (mysqli_error());
	$conta_rotas = mysqli_num_rows ($con_rotas);

/* *** */

function contatos($rota, $data, $repr, $conexao) {
	
	$con = mysqli_query ($conexao, "SELECT codigo FROM diario_contato WHERE date_format(data_visita, '%Y-%m')='$data' AND usuario='$repr' AND rota='$rota'") or die (mysqli_error());
		$conta = mysqli_num_rows ($con);
	
	return $conta;
	
}

function retornos($rota, $data, $repr, $conexao) {
	
	$con = mysqli_query ($conexao, "SELECT codigo FROM diario_contato WHERE date_format(data_visita, '%Y-%m')='$data' AND usuario='$repr' AND rota='$rota' AND status IN ('R', 'G')") or die (mysqli_error());
		$conta = mysqli_num_rows ($con);
	
	return $conta;
	
}

/* *** */
// Dias da Última Visita
$con_diario = mysqli_query ($conexao, "SELECT * FROM (SELECT DATEDIFF(NOW(),MAX(a.data_visita)) AS dias_visita, a.cliente AS id_cliente, 
							b.cliente, b.rota, b.cidade, b.uf 
							FROM diario_contato a LEFT JOIN geral_clientes b ON a.cliente=b.id
							WHERE 
							a.usuario='$repr' 
							GROUP BY b.cliente
							ORDER BY MAX(a.data_visita), b.rota, b.uf, b.cidade, b.cliente) AS c
							WHERE c.dias_visita > 60") or die (mysqli_error());
$conta_diario = mysqli_num_rows ($con_diario);
?>

<div class="box-info">
	<table width="80%">
    	<tr>
        	<td width="40%">TOTAL DE CONTATOS REALIZADOS:</td>
            <td width="10%"><strong><?php echo $conta_ct; ?></strong></td>
            <td width="20%">NOVOS:</td>
            <td width="10%"><strong><?php echo $conta_cn; ?></strong></td>
            <td width="20%" rowspan="2"><div class="media"><?php echo $media_retorno; ?>% <br> DE RETORNO</div></td>
        </tr>
        <tr>
        	<td>TOTAL DE CONTATOS COM RETORNO:</td>
            <td><strong><?php echo $conta_crt; ?></strong></td>
            <td>NOVOS:</td>
            <td><strong><?php echo $conta_crn; ?></strong></td>
        </tr>
    </table>
</div>

<div class="linha"></div>

<div class="box-info">
	<table width="80%">
    	<tr>
        	<td colspan="2">ROTAS VISITADAS:</td>
            <td><strong><?php echo $conta_rotas; ?></strong></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        
        <?php
		while ($d_rotas = mysqli_fetch_array ($con_rotas)) {
			$rota = $d_rotas['rota'];
		?>
        <tr>
        	<td width="20%"><div class="rota"><?php echo $rota; ?></div></td>
            <td width="20%">CONTATOS:</td>
            <td width="20%"><strong><?php echo contatos($rota, $data, $repr, $conexao); ?></strong></td>
            <td width="20%">RETORNOS:</td>
            <td width="20%"><strong><?php echo retornos($rota, $data, $repr, $conexao); ?></strong></td>
        </tr>
		<?php
		}
		?>
    </table>
</div>

<div class="linha"></div>

<div class="box-info">
	<table width="100%" class="clientes">
    	<tr>
        	<td colspan="3"><strong>CLIENTES SEM CONTATO A MAIS DE 60 DIAS</strong></td>
        </tr>
        <?php
		if ($conta_diario == 0) {
		?>
		<tr>
        	<td colspan="3">NENHUM CLIENTE ENCONTRADO</td>
        </tr>
        <?php
		} else {
		while ($d_diario = mysqli_fetch_array ($con_diario)) {
			$d_dias_visita 	= $d_diario['dias_visita'];
			$d_cliente 		= $d_diario['cliente'];
			$d_rota 		= $d_diario['rota'];
			$d_cidade 		= $d_diario['cidade'];
			$d_uf 			= $d_diario['uf'];
		?>
        <tr>
        	<td width="50%"><?php echo $d_cliente; ?></td>
            <td width="35%"><?php echo "(".$d_rota.") ".$d_cidade."/".$d_uf; ?></td>
            <td width="15%"><?php echo $d_dias_visita; ?> DIAS</td>
        </tr>
        <?php
		}
		
		}
		?>
    </table>
</div>

<?php
}
?>

</body>

</html>
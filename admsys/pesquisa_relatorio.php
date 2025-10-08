<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_sistema.php");
include_once ("includes/usuario_logado.php");
?>

<?php
if ($perm_adm == "S" || $perm_pesquisa == "S") {
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>Painel de Administração : Linde Vidros</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/favicon.ico">
    
    <!-- CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css?<?php echo filemtime('css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="css/rel_pesquisa.css?<?php echo filemtime('css/rel_pesquisa.css'); ?>">
    
    <script src="js/jquery.min.js"></script>
    
    <!-- JS -->
    <!--[if lt IE 9]>
    <script src="../js/html5shiv.js"></script>
	<![endif]-->
    
    <!-- Fontes -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet" type="text/css">
</head>

<?php
$id_pesquisa = $_GET['pesquisa'];

$consulta_pesquisa = mysqli_query ($conexao, "SELECT nome FROM pesquisa WHERE id='$id_pesquisa'") or die (mysqli_error());
	$d = mysqli_fetch_array ($consulta_pesquisa);
		$nome_pesquisa = $d['nome'];

$consulta_respostas = mysqli_query ($conexao, "SELECT * FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R'") or die (mysqli_error());

$conta_respostas = mysqli_num_rows ($consulta_respostas);

/* **************** */

$t_tra1 = 0;
$t_tra2 = 0;
$t_tra3 = 0;

$t_pro1 = 0;
$t_pro2 = 0;
$t_pro3 = 0;
$t_pro4 = 0;

$t_com1 = 0;
$t_com2 = 0;
$t_com3 = 0;
$t_com4 = 0;
$t_com5 = 0;

// Produtos
$s_tem = 0;
$n_tem = 0;
$s_sen = 0;
$n_sen = 0;
$s_lam = 0;
$n_lam = 0;
$s_tla = 0;
$n_tla = 0;
$s_ser = 0;
$n_ser = 0;
$s_mar = 0;
$n_mar = 0;
$s_ref = 0;
$n_ref = 0;
$s_ins = 0;
$n_ins = 0;
$s_hab = 0;
$n_hab = 0;
$s_esp = 0;
$n_esp = 0;
$s_imp = 0;
$n_imp = 0;
$s_fer = 0;
$n_fer = 0;
$s_mol = 0;
$n_mol = 0;
$s_kit = 0;
$n_kit = 0;
$s_alu = 0;
$n_alu = 0;
$s_por = 0;
$n_por = 0;

$s_merlin = 0;
$n_merlin = 0;

$av1 = 0;
$av2 = 0;
$av3 = 0;

/* **************** */

while ($dados = mysqli_fetch_array ($consulta_respostas)) {
	
	$t_tra1 += $dados['p_tra1'];
	$t_tra2 += $dados['p_tra2'];
	$t_tra3 += $dados['p_tra3'];
	
	$t_pro1 += $dados['p_pro1'];
	$t_pro2 += $dados['p_pro2'];
	$t_pro3 += $dados['p_pro3'];
	$t_pro4 += $dados['p_pro4'];
	
	$t_com1 += $dados['p_com1'];
	$t_com2 += $dados['p_com2'];
	$t_com3 += $dados['p_com3'];
	$t_com4 += $dados['p_com4'];
	$t_com5 += $dados['p_com5'];
	
	/* *** */
	
	$c_tem = $dados['c_tem'];
	$c_sen = $dados['c_sen'];
	$c_lam = $dados['c_lam'];
	$c_tla = $dados['c_tla'];
	$c_ser = $dados['c_ser'];
	$c_mar = $dados['c_mar'];
	$c_ref = $dados['c_ref'];
	$c_ins = $dados['c_ins'];
	$c_hab = $dados['c_hab'];
	$c_esp = $dados['c_esp'];
	$c_imp = $dados['c_imp'];
	$c_fer = $dados['c_fer'];
	$c_mol = $dados['c_mol'];
	$c_kit = $dados['c_kit'];
	$c_alu = $dados['c_alu'];
	$c_por = $dados['c_por'];
	
	$merlin = $dados['merlin'];
	
	$avaliacao = $dados['avaliacao'];
	
	/* *** */
	
	// Cálculos
	if ($c_tem == "S") { $s_tem++; } else { $n_tem++; }
	if ($c_sen == "S") { $s_sen++; } else { $n_sen++; }
	if ($c_lam == "S") { $s_lam++; } else { $n_lam++; }
	if ($c_tla == "S") { $s_tla++; } else { $n_tla++; }
	if ($c_ser == "S") { $s_ser++; } else { $n_ser++; }
	if ($c_mar == "S") { $s_mar++; } else { $n_mar++; }
	if ($c_ref == "S") { $s_ref++; } else { $n_ref++; }
	if ($c_ins == "S") { $s_ins++; } else { $n_ins++; }
	if ($c_hab == "S") { $s_hab++; } else { $n_hab++; }
	if ($c_esp == "S") { $s_esp++; } else { $n_esp++; }
	if ($c_imp == "S") { $s_imp++; } else { $n_imp++; }
	if ($c_fer == "S") { $s_fer++; } else { $n_fer++; }
	if ($c_mol == "S") { $s_mol++; } else { $n_mol++; }
	if ($c_kit == "S") { $s_kit++; } else { $n_kit++; }
	if ($c_alu == "S") { $s_alu++; } else { $n_alu++; }
	if ($c_por == "S") { $s_por++; } else { $n_por++; }
	
	if ($merlin == "S") { $s_merlin++; } else { $n_merlin++; }
	
	switch ($avaliacao) {
		case "1": $av1++; break;
		case "2": $av2++; break;
		case "3": $av3++; break;
	}
		
}

function media_resposta($total, $contagem) {
	
	$media = round($total / $contagem);
	
	switch ($media) {
		case "1": $media_desc = "1 - MUITO INSATISFEITO"; break;
		case "2": $media_desc = "2 - INSATISFEITO"; break;
		case "3": $media_desc = "3 - SATISFEITO"; break;
		case "4": $media_desc = "4 - MUITO SATISFEITO"; break;
	}
	
	return $media_desc;
	
}

// Médias
$media_tra = round((($t_tra1/$conta_respostas) + ($t_tra2/$conta_respostas) + ($t_tra3/$conta_respostas)) / 3);
$media_pro = round((($t_pro1/$conta_respostas) + ($t_pro2/$conta_respostas) + ($t_pro3/$conta_respostas) + ($t_pro4/$conta_respostas)) / 4);
$media_com = round((($t_com1/$conta_respostas) + ($t_com2/$conta_respostas) + ($t_com3/$conta_respostas) + ($t_com4/$conta_respostas) + ($t_com5/$conta_respostas)) / 5);

// Média Geral
$media_geral = round(($media_tra + $media_pro + $media_com) / 3);

function texto_media($m) {
			
	switch ($m) {
		case "1": $m_desc = "1 - MUITO INSATISFEITO"; break;
		case "2": $m_desc = "2 - INSATISFEITO"; break;
		case "3": $m_desc = "3 - SATISFEITO"; break;
		case "4": $m_desc = "4 - MUITO SATISFEITO"; break;
	}
	
	return $m_desc;
	
}

function total_resposta($id_pesquisa, $questao, $nota, $conexao) {
	
	$con_resposta = mysqli_query ($conexao, "SELECT id FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND $questao='$nota'") or die (mysqli_error());
		$conta_respostas = mysqli_num_rows ($con_resposta);
		
		return $conta_respostas;
	
}
?>

<body>

<h1>EXPERIÊNCIA COM O CLIENTE</h1>

<div class="nome-pesquisa"><?php echo $nome_pesquisa; ?> <br> <small>PESQUISA RESPONDIDA POR <?php echo $conta_respostas; ?> CLIENTES</small></div>

<h2>TRANSPORTE</h2>

<p class="pergunta">1 - O motorista verifica o local onde será descarregado (condicionado) o produto?</p>
<p class="resposta"><strong>MÉDIA:</strong> <?php echo media_resposta($t_tra1, $conta_respostas); ?></p>
<table class="qtde-respostas">
	<tr>
    	<td>MUITO SATISFEITO</td>
        <td>SATISFEITO</td>
        <td>INSATISFEITO</td>
        <td>MUITO INSATISFEITO</td>
    </tr>
    <tr>
    	<td><?php echo total_resposta($id_pesquisa, "p_tra1", "4", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_tra1", "3", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_tra1", "2", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_tra1", "1", $conexao); ?></td>
    </tr>
</table>

<p class="pergunta">2 - O motorista faz a contagem e conferência das peças junto ao cliente e em caso de alguma dúvida faz a recontagem?</p>
<p class="resposta"><strong>MÉDIA:</strong> <?php echo media_resposta($t_tra2, $conta_respostas); ?></p>
<table class="qtde-respostas">
	<tr>
    	<td>MUITO SATISFEITO</td>
        <td>SATISFEITO</td>
        <td>INSATISFEITO</td>
        <td>MUITO INSATISFEITO</td>
    </tr>
    <tr>
    	<td><?php echo total_resposta($id_pesquisa, "p_tra2", "4", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_tra2", "3", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_tra2", "2", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_tra2", "1", $conexao); ?></td>
    </tr>
</table>

<p class="pergunta">3 - O motorista dá o tempo necessário para a conferência dos produtos?</p>
<p class="resposta"><strong>MÉDIA:</strong> <?php echo media_resposta($t_tra3, $conta_respostas); ?></p>
<table class="qtde-respostas">
	<tr>
    	<td>MUITO SATISFEITO</td>
        <td>SATISFEITO</td>
        <td>INSATISFEITO</td>
        <td>MUITO INSATISFEITO</td>
    </tr>
    <tr>
    	<td><?php echo total_resposta($id_pesquisa, "p_tra3", "4", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_tra3", "3", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_tra3", "2", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_tra3", "1", $conexao); ?></td>
    </tr>
</table>

<p class="media"><span><?php echo texto_media($media_tra); ?></span></p>

<h2>PRODUTO</h2>

<p class="pergunta">4 - Qualidade dos produtos</p>
<p class="resposta"><strong>MÉDIA:</strong> <?php echo media_resposta($t_pro1, $conta_respostas); ?></p>
<table class="qtde-respostas">
	<tr>
    	<td>MUITO SATISFEITO</td>
        <td>SATISFEITO</td>
        <td>INSATISFEITO</td>
        <td>MUITO INSATISFEITO</td>
    </tr>
    <tr>
    	<td><?php echo total_resposta($id_pesquisa, "p_pro1", "4", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_pro1", "3", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_pro1", "2", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_pro1", "1", $conexao); ?></td>
    </tr>
</table>

<p class="pergunta">5 - As peças entregues atendem à qualidade desejada?</p>
<p class="resposta"><strong>MÉDIA:</strong> <?php echo media_resposta($t_pro2, $conta_respostas); ?></p>
<table class="qtde-respostas">
	<tr>
    	<td>MUITO SATISFEITO</td>
        <td>SATISFEITO</td>
        <td>INSATISFEITO</td>
        <td>MUITO INSATISFEITO</td>
    </tr>
    <tr>
    	<td><?php echo total_resposta($id_pesquisa, "p_pro2", "4", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_pro2", "3", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_pro2", "2", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_pro2", "1", $conexao); ?></td>
    </tr>
</table>

<p class="pergunta">6 - A quantidade solicitada é entregue em sua totalidade?</p>
<p class="resposta"><strong>MÉDIA:</strong> <?php echo media_resposta($t_pro3, $conta_respostas); ?></p>
<table class="qtde-respostas">
	<tr>
    	<td>MUITO SATISFEITO</td>
        <td>SATISFEITO</td>
        <td>INSATISFEITO</td>
        <td>MUITO INSATISFEITO</td>
    </tr>
    <tr>
    	<td><?php echo total_resposta($id_pesquisa, "p_pro3", "4", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_pro3", "3", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_pro3", "2", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_pro3", "1", $conexao); ?></td>
    </tr>
</table>

<p class="pergunta">7 - Quando há dúvidas e problemas com peças, o setor de qualidade dá o devido atendimento?</p>
<p class="resposta"><strong>MÉDIA:</strong> <?php echo media_resposta($t_pro4, $conta_respostas); ?></p>
<table class="qtde-respostas">
	<tr>
    	<td>MUITO SATISFEITO</td>
        <td>SATISFEITO</td>
        <td>INSATISFEITO</td>
        <td>MUITO INSATISFEITO</td>
    </tr>
    <tr>
    	<td><?php echo total_resposta($id_pesquisa, "p_pro4", "4", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_pro4", "3", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_pro4", "2", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_pro4", "1", $conexao); ?></td>
    </tr>
</table>

<p class="media"><span><?php echo texto_media($media_pro); ?></span></p>

<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<div id="quebra-linha"></div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

<h1>EXPERIÊNCIA COM O CLIENTE</h1>

<h2>COMERCIAL</h2>

<p class="pergunta">8 - A visita do representante é frequente e eficiente?</p>
<p class="resposta"><strong>MÉDIA:</strong> <?php echo media_resposta($t_com1, $conta_respostas); ?></p>
<table class="qtde-respostas">
	<tr>
    	<td>MUITO SATISFEITO</td>
        <td>SATISFEITO</td>
        <td>INSATISFEITO</td>
        <td>MUITO INSATISFEITO</td>
    </tr>
    <tr>
    	<td><?php echo total_resposta($id_pesquisa, "p_com1", "4", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_com1", "3", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_com1", "2", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_com1", "1", $conexao); ?></td>
    </tr>
</table>

<p class="pergunta">9 - O atendimento telefônico é rápido e prestativo?</p>
<p class="resposta"><strong>MÉDIA:</strong> <?php echo media_resposta($t_com2, $conta_respostas); ?></p>
<table class="qtde-respostas">
	<tr>
    	<td>MUITO SATISFEITO</td>
        <td>SATISFEITO</td>
        <td>INSATISFEITO</td>
        <td>MUITO INSATISFEITO</td>
    </tr>
    <tr>
    	<td><?php echo total_resposta($id_pesquisa, "p_com2", "4", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_com2", "3", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_com2", "2", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_com2", "1", $conexao); ?></td>
    </tr>
</table>

<p class="pergunta">10 - O retorno de orçamentos e pendências com os vendedores internos estão dentro da sua expectativa?</p>
<p class="resposta"><strong>MÉDIA:</strong> <?php echo media_resposta($t_com3, $conta_respostas); ?></p>
<table class="qtde-respostas">
	<tr>
    	<td>MUITO SATISFEITO</td>
        <td>SATISFEITO</td>
        <td>INSATISFEITO</td>
        <td>MUITO INSATISFEITO</td>
    </tr>
    <tr>
    	<td><?php echo total_resposta($id_pesquisa, "p_com3", "4", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_com3", "3", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_com3", "2", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_com3", "1", $conexao); ?></td>
    </tr>
</table>

<p class="pergunta">11 - O prazo de entrega dos pedidos atende as suas necessidades?</p>
<p class="resposta"><strong>MÉDIA:</strong> <?php echo media_resposta($t_com4, $conta_respostas); ?></p>
<table class="qtde-respostas">
	<tr>
    	<td>MUITO SATISFEITO</td>
        <td>SATISFEITO</td>
        <td>INSATISFEITO</td>
        <td>MUITO INSATISFEITO</td>
    </tr>
    <tr>
    	<td><?php echo total_resposta($id_pesquisa, "p_com4", "4", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_com4", "3", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_com4", "2", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_com4", "1", $conexao); ?></td>
    </tr>
</table>

<p class="pergunta">12 - O departamento financeiro é rápido e eficaz na resolução de pendências?</p>
<p class="resposta"><strong>MÉDIA:</strong> <?php echo media_resposta($t_com5, $conta_respostas); ?></p>
<table class="qtde-respostas">
	<tr>
    	<td>MUITO SATISFEITO</td>
        <td>SATISFEITO</td>
        <td>INSATISFEITO</td>
        <td>MUITO INSATISFEITO</td>
    </tr>
    <tr>
    	<td><?php echo total_resposta($id_pesquisa, "p_com5", "4", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_com5", "3", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_com5", "2", $conexao); ?></td>
        <td><?php echo total_resposta($id_pesquisa, "p_com5", "1", $conexao); ?></td>
    </tr>
</table>

<p class="media"><span><?php echo texto_media($media_com); ?></span></p>

<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<div id="quebra-linha"></div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

<h1>EXPERIÊNCIA COM O CLIENTE</h1>

<h2>CONHECIMENTO DOS PRODUTOS</h2>

<table>
	<tr>
    	<td colspan="2" width="25%" class="titulo-tabela">
        	TEMPERADO
        </td>
        <td colspan="2" width="25%" class="titulo-tabela">
        	LAMINADO
        </td>
        <td colspan="2" width="25%" class="titulo-tabela">
        	LAMINADO TEMPERADO
        </td>
        <td colspan="2" width="25%" class="titulo-tabela">
        	LAMINADO SENTRYGLAS&reg;
        </td>
    </tr>
    <tr>
    	<td>
        	<p>SIM</p>
            <p><strong><?php echo $s_tem; ?></strong></p>
        </td>
        <td>
        	<p>NÃO</p>
            <p><strong><?php echo $n_tem; ?></strong></p>
        </td>
        <td>
        	<p>SIM</p>
            <p><strong><?php echo $s_lam; ?></strong></p>
        </td>
        <td>
        	<p>NÃO</p>
            <p><strong><?php echo $n_lam; ?></strong></p>
        </td>
        <td>
        	<p>SIM</p>
            <p><strong><?php echo $s_tla; ?></strong></p>
        </td>
        <td>
        	<p>NÃO</p>
            <p><strong><?php echo $n_tla; ?></strong></p>
        </td>
        <td>
        	<p>SIM</p>
            <p><strong><?php echo $s_sen; ?></strong></p>
        </td>
        <td>
        	<p>NÃO</p>
            <p><strong><?php echo $n_sen; ?></strong></p>
        </td>
    </tr>
    <tr>
    	<td colspan="2" width="25%" class="titulo-tabela">
        	SERIGRAFADO
        </td>
        <td colspan="2" width="25%" class="titulo-tabela">
        	MARMORIZADO
        </td>
        <td colspan="2" width="25%" class="titulo-tabela">
        	REFLETIVO
        </td>
        <td colspan="2" width="25%" class="titulo-tabela">
        	INSULADO
        </td>
    </tr>
    <tr>
    	<td>
        	<p>SIM</p>
            <p><strong><?php echo $s_ser; ?></strong></p>
        </td>
        <td>
        	<p>NÃO</p>
            <p><strong><?php echo $n_ser; ?></strong></p>
        </td>
        <td>
        	<p>SIM</p>
            <p><strong><?php echo $s_mar; ?></strong></p>
        </td>
        <td>
        	<p>NÃO</p>
            <p><strong><?php echo $n_mar; ?></strong></p>
        </td>
        <td>
        	<p>SIM</p>
            <p><strong><?php echo $s_ref; ?></strong></p>
        </td>
        <td>
        	<p>NÃO</p>
            <p><strong><?php echo $n_ref; ?></strong></p>
        </td>
        <td>
        	<p>SIM</p>
            <p><strong><?php echo $s_ins; ?></strong></p>
        </td>
        <td>
        	<p>NÃO</p>
            <p><strong><?php echo $n_ins; ?></strong></p>
        </td>
    </tr>
    <tr>
    	<td colspan="2" width="25%" class="titulo-tabela">
        	HABITAT
        </td>
        <td colspan="2" width="25%" class="titulo-tabela">
        	ESPELHO
        </td>
        <td colspan="2" width="25%" class="titulo-tabela">
        	IMPRESSO
        </td>
        <td colspan="2" width="25%" class="titulo-tabela">
        	FERRAGENS
        </td>
    </tr>
    <tr>
    	<td>
        	<p>SIM</p>
            <p><strong><?php echo $s_hab; ?></strong></p>
        </td>
        <td>
        	<p>NÃO</p>
            <p><strong><?php echo $n_hab?></strong></p>
        </td>
        <td>
        	<p>SIM</p>
            <p><strong><?php echo $s_esp; ?></strong></p>
        </td>
        <td>
        	<p>NÃO</p>
            <p><strong><?php echo $n_esp; ?></strong></p>
        </td>
        <td>
        	<p>SIM</p>
            <p><strong><?php echo $s_imp; ?></strong></p>
        </td>
        <td>
        	<p>NÃO</p>
            <p><strong><?php echo $n_imp; ?></strong></p>
        </td>
        <td>
        	<p>SIM</p>
            <p><strong><?php echo $s_fer; ?></strong></p>
        </td>
        <td>
        	<p>NÃO</p>
            <p><strong><?php echo $n_fer; ?></strong></p>
        </td>
    </tr>
    <tr>
    	<td colspan="2" width="25%" class="titulo-tabela">
        	MOLA
        </td>
        <td colspan="2" width="25%" class="titulo-tabela">
        	KIT BOX
        </td>
        <td colspan="2" width="25%" class="titulo-tabela">
        	ALUMÍNIOS
        </td>
        <td colspan="2" width="25%" class="titulo-tabela">
        	PORTA AUTOMÁTICA
        </td>
    </tr>
    <tr>
    	<td>
        	<p>SIM</p>
            <p><strong><?php echo $s_mol; ?></strong></p>
        </td>
        <td>
        	<p>NÃO</p>
            <p><strong><?php echo $n_mol; ?></strong></p>
        </td>
        <td>
        	<p>SIM</p>
            <p><strong><?php echo $s_kit; ?></strong></p>
        </td>
        <td>
        	<p>NÃO</p>
            <p><strong><?php echo $n_kit; ?></strong></p>
        </td>
        <td>
        	<p>SIM</p>
            <p><strong><?php echo $s_alu; ?></strong></p>
        </td>
        <td>
        	<p>NÃO</p>
            <p><strong><?php echo $n_alu; ?></strong></p>
        </td>
        <td>
        	<p>SIM</p>
            <p><strong><?php echo $s_por; ?></strong></p>
        </td>
        <td>
        	<p>NÃO</p>
            <p><strong><?php echo $n_por; ?></strong></p>
        </td>
    </tr>
</table>

<br><br>

<h2>MARCA MERLIN</h2>

<p>Os clientes conhecem a marca Merlin?</p>

<table>
	<tr>
    	<td width="50%">
        	<p>SIM</p>
            <p><strong><?php echo $s_merlin; ?></strong></p>
        </td>
        <td width="50%">
        	<p>NÃO</p>
            <p><strong><?php echo $n_merlin; ?></strong></p>
        </td>
    </tr>
</table>

<br><br>

<h2>AVALIAÇÃO DA EMPRESA</h2>

<p>Avaliação da Linde em relação à concorrência.</p>

<table>
	<tr>
    	<td>
        	<p><strong>SUPERIOR</strong></p>
            <img src="img/pesquisa_3.png" class="img-avaliacao">
            <p class="total-avaliacao"><span><?php echo $av3; ?></span></p>
        </td>
        <td>
        	<p><strong>IGUAL</strong></p>
            <img src="img/pesquisa_2.png" class="img-avaliacao">
            <p class="total-avaliacao"><span><?php echo $av2; ?></span></p>
        </td>
        <td>
        	<p><strong>INFERIOR</strong></p>
            <img src="img/pesquisa_1.png" class="img-avaliacao">
            <p class="total-avaliacao"><span><?php echo $av1; ?></span></p>
        </td>
    </tr>
</table>

<br><br>

<div class="clientes-respondido">
<strong>SUPERIOR</strong>
<br>
<?php
$consulta_clientes_3 = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND avaliacao='3' ORDER BY rota") or die (mysqli_error());

$conta_clientes_3 = mysqli_num_rows ($consulta_clientes_3);

$v_3 = 0;

while ($dados_cli_3 = mysqli_fetch_array ($consulta_clientes_3)) {
	$cli3_codigo 	= $dados_cli_3['cod_cliente'];
	$cli3_nome 		= $dados_cli_3['nome_cliente'];
	$cli3_rota 		= $dados_cli_3['rota'];
	
echo "(".$cli3_rota.") ".$cli3_codigo." - ".$cli3_nome;

$v_3++;
if ($v_3 < $conta_clientes_3) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }

}
?>

<br><br>

<strong>IGUAL</strong>
<br>
<?php
$consulta_clientes_2 = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND avaliacao='2' ORDER BY rota") or die (mysqli_error());

$conta_clientes_2 = mysqli_num_rows ($consulta_clientes_2);

$v_2 = 0;

while ($dados_cli_2 = mysqli_fetch_array ($consulta_clientes_2)) {
	$cli2_codigo 	= $dados_cli_2['cod_cliente'];
	$cli2_nome 		= $dados_cli_2['nome_cliente'];
	$cli2_rota 		= $dados_cli_2['rota'];
	
echo "(".$cli2_rota.") ".$cli2_codigo." - ".$cli2_nome;

$v_2++;
if ($v_2 < $conta_clientes_2) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }

}
?>

<br><br>

<strong>INFERIOR</strong>
<br>
<?php
$consulta_clientes_1 = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND avaliacao='1' ORDER BY rota") or die (mysqli_error());

$conta_clientes_1 = mysqli_num_rows ($consulta_clientes_1);

$v_1 = 0;

while ($dados_cli_1 = mysqli_fetch_array ($consulta_clientes_1)) {
	$cli1_codigo 	= $dados_cli_1['cod_cliente'];
	$cli1_nome 		= $dados_cli_1['nome_cliente'];
	$cli1_rota 		= $dados_cli_1['rota'];
	
echo "(".$cli1_rota.") ".$cli1_codigo." - ".$cli1_nome;

$v_1++;
if ($v_1 < $conta_clientes_1) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }

}
?>
</div>

<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<div id="quebra-linha"></div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

<h1>EXPERIÊNCIA COM O CLIENTE</h1>

<h2>NÃO CONHECEM NOSSOS PRODUTOS</h2>

<?php
if ($n_tem > 0) {
?>
<div class="lista-nao">
<strong>TEMPERADO</strong>
<br>
<?php
	$con_tem_n = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND c_tem='N' ORDER BY rota") or die (mysqli_error());
	$conta_tem_n = mysqli_num_rows ($con_tem_n);
	
	$n_tem = 0;
	
	while ($d_tem = mysqli_fetch_array ($con_tem_n)) {
		$tem_cod 	= $d_tem['cod_cliente'];
		$tem_nome 	= $d_tem['nome_cliente'];
		$tem_rota 	= $d_tem['rota'];
		
		echo "(".$tem_rota.") ".$tem_cod." - ".$tem_nome;

		$n_tem++;
		if ($n_tem < $conta_tem_n) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }
	}
?>
</div>
<?php
}
?>

<?php
if ($n_lam > 0) {
?>
<div class="lista-nao">
<strong>LAMINADO</strong>
<br>
<?php
	$con_lam_n = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND c_lam='N' ORDER BY rota") or die (mysqli_error());
	$conta_lam_n = mysqli_num_rows ($con_lam_n);
	
	$n_lam = 0;
	
	while ($d_lam = mysqli_fetch_array ($con_lam_n)) {
		$lam_cod 	= $d_lam['cod_cliente'];
		$lam_nome 	= $d_lam['nome_cliente'];
		$lam_rota 	= $d_lam['rota'];
		
		echo "(".$lam_rota.") ".$lam_cod." - ".$lam_nome;

		$n_lam++;
		if ($n_lam < $conta_lam_n) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }
	}
?>
</div>
<?php
}
?>

<?php
if ($n_tla > 0) {
?>
<div class="lista-nao">
<strong>LAMINADO TEMPERADO</strong>
<br>
<?php
	$con_tla_n = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND c_tla='N' ORDER BY rota") or die (mysqli_error());
	$conta_tla_n = mysqli_num_rows ($con_tla_n);
	
	$n_tla = 0;
	
	while ($d_tla = mysqli_fetch_array ($con_tla_n)) {
		$tla_cod 	= $d_tla['cod_cliente'];
		$tla_nome 	= $d_tla['nome_cliente'];
		$tla_rota 	= $d_tla['rota'];
		
		echo "(".$tla_rota.") ".$tla_cod." - ".$tla_nome;

		$n_tla++;
		if ($n_tla < $conta_tla_n) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }
	}
?>
</div>
<?php
}
?>

<?php
if ($n_sen > 0) {
?>
<div class="lista-nao">
<strong>LAMINADO SENTRYGLAS&reg;</strong>
<br>
<?php
	$con_sen_n = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND c_sen='N' ORDER BY rota") or die (mysqli_error());
	$conta_sen_n = mysqli_num_rows ($con_sen_n);
	
	$n_sen = 0;
	
	while ($d_sen = mysqli_fetch_array ($con_sen_n)) {
		$sen_cod 	= $d_sen['cod_cliente'];
		$sen_nome 	= $d_sen['nome_cliente'];
		$sen_rota 	= $d_sen['rota'];
		
		echo "(".$sen_rota.") ".$sen_cod." - ".$sen_nome;

		$n_sen++;
		if ($n_sen < $conta_sen_n) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }
	}
?>
</div>
<?php
}
?>

<?php
if ($n_ser > 0) {
?>
<div class="lista-nao">
<strong>SERIGRAFADO</strong>
<br>
<?php
	$con_ser_n = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND c_ser='N' ORDER BY rota") or die (mysqli_error());
	$conta_ser_n = mysqli_num_rows ($con_ser_n);
	
	$n_ser = 0;
	
	while ($d_ser = mysqli_fetch_array ($con_ser_n)) {
		$ser_cod 	= $d_ser['cod_cliente'];
		$ser_nome 	= $d_ser['nome_cliente'];
		$ser_rota 	= $d_ser['rota'];
		
		echo "(".$ser_rota.") ".$ser_cod." - ".$ser_nome;

		$n_ser++;
		if ($n_ser < $conta_ser_n) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }
	}
?>
</div>
<?php
}
?>

<?php
if ($n_mar > 0) {
?>
<div class="lista-nao">
<strong>MARMORIZADO</strong>
<br>
<?php
	$con_mar_n = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND c_mar='N' ORDER BY rota") or die (mysqli_error());
	$conta_mar_n = mysqli_num_rows ($con_mar_n);
	
	$n_mar = 0;
	
	while ($d_mar = mysqli_fetch_array ($con_mar_n)) {
		$mar_cod 	= $d_mar['cod_cliente'];
		$mar_nome 	= $d_mar['nome_cliente'];
		$mar_rota 	= $d_mar['rota'];
		
		echo "(".$mar_rota.") ".$mar_cod." - ".$mar_nome;

		$n_mar++;
		if ($n_mar < $conta_mar_n) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }
	}
?>
</div>
<?php
}
?>

<?php
if ($n_ref > 0) {
?>
<div class="lista-nao">
<strong>REFLETIVO</strong>
<br>
<?php
	$con_ref_n = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND c_ref='N' ORDER BY rota") or die (mysqli_error());
	$conta_ref_n = mysqli_num_rows ($con_ref_n);
	
	$n_ref = 0;
	
	while ($d_ref = mysqli_fetch_array ($con_ref_n)) {
		$ref_cod 	= $d_ref['cod_cliente'];
		$ref_nome 	= $d_ref['nome_cliente'];
		$ref_rota 	= $d_ref['rota'];
		
		echo "(".$ref_rota.") ".$ref_cod." - ".$ref_nome;

		$n_ref++;
		if ($n_ref < $conta_ref_n) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }
	}
?>
</div>
<?php
}
?>

<?php
if ($n_ins > 0) {
?>
<div class="lista-nao">
<strong>INSULADO</strong>
<br>
<?php
	$con_ins_n = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND c_ins='N' ORDER BY rota") or die (mysqli_error());
	$conta_ins_n = mysqli_num_rows ($con_ins_n);
	
	$n_ins = 0;
	
	while ($d_ins = mysqli_fetch_array ($con_ins_n)) {
		$ins_cod 	= $d_ins['cod_cliente'];
		$ins_nome 	= $d_ins['nome_cliente'];
		$ins_rota 	= $d_ins['rota'];
		
		echo "(".$ins_rota.") ".$ins_cod." - ".$ins_nome;

		$n_ins++;
		if ($n_ins < $conta_ins_n) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }
	}
?>
</div>
<?php
}
?>

<?php
if ($n_hab > 0) {
?>
<div class="lista-nao">
<strong>HABITAT</strong>
<br>
<?php
	$con_hab_n = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND c_hab='N' ORDER BY rota") or die (mysqli_error());
	$conta_hab_n = mysqli_num_rows ($con_hab_n);
	
	$n_hab = 0;
	
	while ($d_hab = mysqli_fetch_array ($con_hab_n)) {
		$hab_cod 	= $d_hab['cod_cliente'];
		$hab_nome 	= $d_hab['nome_cliente'];
		$hab_rota 	= $d_hab['rota'];
		
		echo "(".$hab_rota.") ".$hab_cod." - ".$hab_nome;

		$n_hab++;
		if ($n_hab < $conta_hab_n) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }
	}
?>
</div>
<?php
}
?>

<?php
if ($n_esp > 0) {
?>
<div class="lista-nao">
<strong>ESPELHO</strong>
<br>
<?php
	$con_esp_n = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND c_esp='N' ORDER BY rota") or die (mysqli_error());
	$conta_esp_n = mysqli_num_rows ($con_esp_n);
	
	$n_esp = 0;
	
	while ($d_esp = mysqli_fetch_array ($con_esp_n)) {
		$esp_cod 	= $d_esp['cod_cliente'];
		$esp_nome 	= $d_esp['nome_cliente'];
		$esp_rota 	= $d_esp['rota'];
		
		echo "(".$esp_rota.") ".$esp_cod." - ".$esp_nome;

		$n_esp++;
		if ($n_esp < $conta_esp_n) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }
	}
?>
</div>
<?php
}
?>

<?php
if ($n_imp > 0) {
?>
<div class="lista-nao">
<strong>IMPRESSO</strong>
<br>
<?php
	$con_imp_n = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND c_imp='N' ORDER BY rota") or die (mysqli_error());
	$conta_imp_n = mysqli_num_rows ($con_imp_n);
	
	$n_imp = 0;
	
	while ($d_imp = mysqli_fetch_array ($con_imp_n)) {
		$imp_cod 	= $d_imp['cod_cliente'];
		$imp_nome 	= $d_imp['nome_cliente'];
		$imp_rota 	= $d_imp['rota'];
		
		echo "(".$imp_rota.") ".$imp_cod." - ".$imp_nome;

		$n_imp++;
		if ($n_imp < $conta_imp_n) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }
	}
?>
</div>
<?php
}
?>

<?php
if ($n_fer > 0) {
?>
<div class="lista-nao">
<strong>FERRAGENS</strong>
<br>
<?php
	$con_fer_n = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND c_fer='N' ORDER BY rota") or die (mysqli_error());
	$conta_fer_n = mysqli_num_rows ($con_fer_n);
	
	$n_fer = 0;
	
	while ($d_fer = mysqli_fetch_array ($con_fer_n)) {
		$fer_cod 	= $d_fer['cod_cliente'];
		$fer_nome 	= $d_fer['nome_cliente'];
		$fer_rota 	= $d_fer['rota'];
		
		echo "(".$fer_rota.") ".$fer_cod." - ".$fer_nome;

		$n_fer++;
		if ($n_fer < $conta_fer_n) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }
	}
?>
</div>
<?php
}
?>

<?php
if ($n_mol > 0) {
?>
<div class="lista-nao">
<strong>MOLA</strong>
<br>
<?php
	$con_mol_n = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND c_mol='N' ORDER BY rota") or die (mysqli_error());
	$conta_mol_n = mysqli_num_rows ($con_mol_n);
	
	$n_mol = 0;
	
	while ($d_mol = mysqli_fetch_array ($con_mol_n)) {
		$mol_cod 	= $d_mol['cod_cliente'];
		$mol_nome 	= $d_mol['nome_cliente'];
		$mol_rota 	= $d_mol['rota'];
		
		echo "(".$mol_rota.") ".$mol_cod." - ".$mol_nome;

		$n_mol++;
		if ($n_mol < $conta_mol_n) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }
	}
?>
</div>
<?php
}
?>

<?php
if ($n_kit > 0) {
?>
<div class="lista-nao">
<strong>KIT BOX</strong>
<br>
<?php
	$con_kit_n = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND c_kit='N' ORDER BY rota") or die (mysqli_error());
	$conta_kit_n = mysqli_num_rows ($con_kit_n);
	
	$n_kit = 0;
	
	while ($d_kit = mysqli_fetch_array ($con_kit_n)) {
		$kit_cod 	= $d_kit['cod_cliente'];
		$kit_nome 	= $d_kit['nome_cliente'];
		$kit_rota 	= $d_kit['rota'];
		
		echo "(".$kit_rota.") ".$kit_cod." - ".$kit_nome;

		$n_kit++;
		if ($n_kit < $conta_kit_n) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }
	}
?>
</div>
<?php
}
?>

<?php
if ($n_alu > 0) {
?>
<div class="lista-nao">
<strong>ALUMÍNIOS</strong>
<br>
<?php
	$con_alu_n = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND c_alu='N' ORDER BY rota") or die (mysqli_error());
	$conta_alu_n = mysqli_num_rows ($con_alu_n);
	
	$n_alu = 0;
	
	while ($d_alu = mysqli_fetch_array ($con_alu_n)) {
		$alu_cod 	= $d_alu['cod_cliente'];
		$alu_nome 	= $d_alu['nome_cliente'];
		$alu_rota 	= $d_alu['rota'];
		
		echo "(".$alu_rota.") ".$alu_cod." - ".$alu_nome;

		$n_alu++;
		if ($n_alu < $conta_alu_n) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }
	}
?>
</div>
<?php
}
?>

<?php
if ($n_por > 0) {
?>
<div class="lista-nao">
<strong>PORTA AUTOMÁTICA</strong>
<br>
<?php
	$con_por_n = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND c_por='N' ORDER BY rota") or die (mysqli_error());
	$conta_por_n = mysqli_num_rows ($con_por_n);
	
	$n_por = 0;
	
	while ($d_por = mysqli_fetch_array ($con_por_n)) {
		$por_cod 	= $d_por['cod_cliente'];
		$por_nome 	= $d_por['nome_cliente'];
		$por_rota 	= $d_por['rota'];
		
		echo "(".$por_rota.") ".$por_cod." - ".$por_nome;

		$n_por++;
		if ($n_por < $conta_por_n) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }
	}
?>
</div>
<?php
}
?>

<?php
if ($n_merlin > 0) {
?>
<div class="lista-nao">
<strong>MARCA MERLIN</strong>
<br>
<?php
	$con_merlin_n = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND status='R' AND merlin='N' ORDER BY rota") or die (mysqli_error());
	$conta_merlin_n = mysqli_num_rows ($con_merlin_n);
	
	$n_merlin = 0;
	
	while ($d_merlin = mysqli_fetch_array ($con_merlin_n)) {
		$merlin_cod 	= $d_merlin['cod_cliente'];
		$merlin_nome 	= $d_merlin['nome_cliente'];
		$merlin_rota 	= $d_merlin['rota'];
		
		echo "(".$merlin_rota.") ".$merlin_cod." - ".$merlin_nome;

		$n_merlin++;
		if ($n_merlin < $conta_merlin_n) { echo "&nbsp;&nbsp; &bull; &nbsp;&nbsp; "; }
	}
?>
</div>
<?php
}
?>

<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<div id="quebra-linha"></div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

<h1>EXPERIÊNCIA COM O CLIENTE</h1>

<h2>OBSERVAÇÕES</h2>

<?php
// Transporte
$con_obs_tra = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota, responsavel, obs_tra FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND obs_tra!='' ORDER BY rota") or die (mysqli_error());
$conta_obs_tra = mysqli_num_rows ($con_obs_tra);

// Produto
$con_obs_pro = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota, responsavel, obs_pro FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND obs_pro!='' ORDER BY rota") or die (mysqli_error());
$conta_obs_pro = mysqli_num_rows ($con_obs_pro);

// Comercial
$con_obs_com = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota, responsavel, obs_com FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND obs_com!='' ORDER BY rota") or die (mysqli_error());
$conta_obs_com = mysqli_num_rows ($con_obs_com);

// Outros Produtos
$con_obs_outros = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota, responsavel, outros FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND outros!='' ORDER BY rota") or die (mysqli_error());
$conta_obs_outros = mysqli_num_rows ($con_obs_outros);

// Geral
$con_obs_geral = mysqli_query ($conexao, "SELECT cod_cliente, nome_cliente, rota, responsavel, obs_geral FROM pesquisa_clientes WHERE id_pesquisa='$id_pesquisa' AND obs_geral!='' ORDER BY rota") or die (mysqli_error());
$conta_obs_geral = mysqli_num_rows ($con_obs_geral);
?>

<?php
if ($conta_obs_tra >= 1) {
?>
<strong>TRANSPORTE</strong>
<?php
	while ($d_obs_tra = mysqli_fetch_array ($con_obs_tra)) {
		$OBSTRA_cod 	= $d_obs_tra['cod_cliente'];
		$OBSTRA_nome 	= $d_obs_tra['nome_cliente'];
		$OBSTRA_rota 	= $d_obs_tra['rota'];
		$OBSTRA_resp 	= $d_obs_tra['responsavel'];
		$OBSTRA_obs 	= $d_obs_tra['obs_tra'];
?>
<div class="box-obs">
	<p><strong>(<?php echo $OBSTRA_rota; ?>) <?php echo $OBSTRA_cod; ?> - <?php echo $OBSTRA_nome; ?> [ <?php echo $OBSTRA_resp; ?> ]</strong></p>
    <p><?php echo $OBSTRA_obs; ?></p>
</div>
<?php
	}
}
?>

<br>

<?php
if ($conta_obs_pro >= 1) {
?>
<strong>PRODUTO</strong>
<?php
	while ($d_obs_pro = mysqli_fetch_array ($con_obs_pro)) {
		$OBSPRO_cod 	= $d_obs_pro['cod_cliente'];
		$OBSPRO_nome 	= $d_obs_pro['nome_cliente'];
		$OBSPRO_rota 	= $d_obs_pro['rota'];
		$OBSPRO_resp 	= $d_obs_pro['responsavel'];
		$OBSPRO_obs 	= $d_obs_pro['obs_pro'];
?>
<div class="box-obs">
	<p><strong>(<?php echo $OBSPRO_rota; ?>) <?php echo $OBSPRO_cod; ?> - <?php echo $OBSPRO_nome; ?> [ <?php echo $OBSPRO_resp; ?> ]</strong></p>
    <p><?php echo $OBSPRO_obs; ?></p>
</div>
<?php
	}
}
?>

<br>

<?php
if ($conta_obs_com >= 1) {
?>
<strong>COMERCIAL</strong>
<?php
	while ($d_obs_com = mysqli_fetch_array ($con_obs_com)) {
		$OBSCOM_cod 	= $d_obs_com['cod_cliente'];
		$OBSCOM_nome 	= $d_obs_com['nome_cliente'];
		$OBSCOM_rota 	= $d_obs_com['rota'];
		$OBSCOM_resp 	= $d_obs_com['responsavel'];
		$OBSCOM_obs 	= $d_obs_com['obs_com'];
?>
<div class="box-obs">
	<p><strong>(<?php echo $OBSCOM_rota; ?>) <?php echo $OBSCOM_cod; ?> - <?php echo $OBSCOM_nome; ?> [ <?php echo $OBSCOM_resp; ?> ]</strong></p>
    <p><?php echo $OBSCOM_obs; ?></p>
</div>
<?php
	}
}
?>

<br>

<?php
if ($conta_obs_outros >= 1) {
?>
<strong>OUTROS PRODUTOS QUE OS CLIENTES GOSTARIAM DE COMPRAR</strong>
<?php
	while ($d_obs_outros = mysqli_fetch_array ($con_obs_outros)) {
		$OBSOUT_cod 	= $d_obs_outros['cod_cliente'];
		$OBSOUT_nome 	= $d_obs_outros['nome_cliente'];
		$OBSOUT_rota 	= $d_obs_outros['rota'];
		$OBSOUT_resp 	= $d_obs_outros['responsavel'];
		$OBSOUT_obs 	= $d_obs_outros['outros'];
?>
<div class="box-obs">
	<p><strong>(<?php echo $OBSOUT_rota; ?>) <?php echo $OBSOUT_cod; ?> - <?php echo $OBSOUT_nome; ?> [ <?php echo $OBSOUT_resp; ?> ]</strong></p>
    <p><?php echo $OBSOUT_obs; ?></p>
</div>
<?php
	}
}
?>

<br>

<?php
if ($conta_obs_geral >= 1) {
?>
<strong>GERAL</strong>
<?php
	while ($d_obs_geral = mysqli_fetch_array ($con_obs_geral)) {
		$OBSGER_cod 	= $d_obs_geral['cod_cliente'];
		$OBSGER_nome 	= $d_obs_geral['nome_cliente'];
		$OBSGER_rota 	= $d_obs_geral['rota'];
		$OBSGER_resp 	= $d_obs_geral['responsavel'];
		$OBSGER_obs 	= $d_obs_geral['obs_geral'];
?>
<div class="box-obs">
	<p><strong>(<?php echo $OBSGER_rota; ?>) <?php echo $OBSGER_cod; ?> - <?php echo $OBSGER_nome; ?> [ <?php echo $OBSGER_resp; ?> ]</strong></p>
    <p><?php echo $OBSGER_obs; ?></p>
</div>
<?php
	}
}
?>

</body>

</html>

<?php
}
?>
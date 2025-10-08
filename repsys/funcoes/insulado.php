<?php
include ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");
/* ********************************************************************************************************************************************************************************** 
-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
### FUNÇÕES ###
-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
********************************************************************************************************************************************************************************** */
// METRAGEM QUADRADA
function calc_m2($tamanho) {
	$calculo = $tamanho / 1000;
	
	$resultado = round(is_numeric($calculo) && is_numeric("0.05") ? (ceil($calculo / 0.05) * 0.05) : false, 2);
	
	return $resultado;
}

// METRAGEM QUADRADA DA PEÇA
function calc_m2_peca($largura, $altura) {
	$calculo = $largura * $altura;
	
	if ($calculo < 0.250) {
		$resultado = 0.250;
	}
	else {
		$resultado = $calculo;	
	}
	
	return $resultado;
}

// METRAGEM CUBICA
function calc_m3_peca($conexao, $id_orcamento, $largura, $altura, $camara) {
	if ($camara == 1) {
		$con_camara = mysqli_query ($conexao, "SELECT b.spacer_tamanho FROM insulado_orcamentos a, insulado_tipos b WHERE a.id='$id_orcamento' AND a.camara1=b.id") or die (mysqli_error());
	}
	elseif ($camara == 2) {
		$con_camara = mysqli_query ($conexao, "SELECT b.spacer_tamanho FROM insulado_orcamentos a, insulado_tipos b WHERE a.id='$id_orcamento' AND a.camara2=b.id") or die (mysqli_error());
	}
	
	$info = mysqli_fetch_array ($con_camara);
		$spacer = $info['spacer_tamanho'];
	
	$resultado = $largura * $altura * ($spacer / 1000);
	
	return $resultado;
}

// VALOR VIDRO
function calc_valor_vidro($conexao, $id_orcamento, $peca, $vidro) {
	if ($vidro == 1) {
		$con_vidro = mysqli_query ($conexao, "SELECT vidro1_vlr FROM insulado_orcamentos WHERE id='$id_orcamento'") or die (mysqli_error());
			$info = mysqli_fetch_array ($con_vidro);
				$valor = $info['vidro1_vlr'];
	}
	elseif ($vidro == 2) {
		$con_vidro = mysqli_query ($conexao, "SELECT vidro2_vlr FROM insulado_orcamentos WHERE id='$id_orcamento'") or die (mysqli_error());
			$info = mysqli_fetch_array ($con_vidro);
				$valor = $info['vidro2_vlr'];
	}
	elseif ($vidro == 3) {
		$con_vidro = mysqli_query ($conexao, "SELECT vidro3_vlr FROM insulado_orcamentos WHERE id='$id_orcamento'") or die (mysqli_error());
			$info = mysqli_fetch_array ($con_vidro);
				$valor = $info['vidro3_vlr'];
	}
	
	$resultado = round($valor * $peca, 2);
	
	return $resultado;
}

// METRAGEM LINEAR
function calc_ml($largura, $altura) {
	$resultado = round((($largura * 2) + ($altura * 2)) / 1000, 3);
	
	return $resultado;
}

/* ************** */

// SPACER
function calc_spacer($conexao, $id_orcamento, $camara, $ml) {
	if ($camara == 1) {
		$con_camara = mysqli_query ($conexao, "SELECT b.spacer_vlr FROM insulado_orcamentos a, insulado_tipos b WHERE a.id='$id_orcamento' AND a.camara1=b.id") or die (mysqli_error());
	}
	elseif ($camara == 2) {
		$con_camara = mysqli_query ($conexao, "SELECT b.spacer_vlr FROM insulado_orcamentos a, insulado_tipos b WHERE a.id='$id_orcamento' AND a.camara2=b.id") or die (mysqli_error());
	}
	
	$info = mysqli_fetch_array ($con_camara);
		$vlr_spacer = $info['spacer_vlr'];
	
	$resultado = round($vlr_spacer * $ml, 2);
	
	return $resultado;
}

/* ************** */

// CONECTOR
function calc_conector($conexao, $id_orcamento, $camara) {
	if ($camara == 1) {
		$con_camara = mysqli_query ($conexao, "SELECT b.conector FROM insulado_orcamentos a, insulado_tipos b WHERE a.id='$id_orcamento' AND a.camara1=b.id") or die (mysqli_error());
	}
	elseif ($camara == 2) {
		$con_camara = mysqli_query ($conexao, "SELECT b.conector FROM insulado_orcamentos a, insulado_tipos b WHERE a.id='$id_orcamento' AND a.camara2=b.id") or die (mysqli_error());
	}
	
	$info = mysqli_fetch_array ($con_camara);
		$conector = $info['conector'];
	
	if ($conector > 0) {
		$consulta_componentes = mysqli_query ($conexao, "SELECT conector FROM insulado_componentes WHERE id='1'") or die (mysqli_error());
			$dados = mysqli_fetch_array ($consulta_componentes);
				$vlr_conector = $dados['conector'];
		
		$resultado = round($vlr_conector * $conector, 2);
		
		return $resultado;
	}
	else {
		$resultado = 0;
		
		return $resultado;
	}
}

/* ************** */

// SILICA
function calc_silica($conexao, $id_orcamento, $camara, $ml) {
	if ($camara == 1) {
		$con_camara = mysqli_query ($conexao, "SELECT b.silica FROM insulado_orcamentos a, insulado_tipos b WHERE a.id='$id_orcamento' AND a.camara1=b.id") or die (mysqli_error());
	}
	elseif ($camara == 2) {
		$con_camara = mysqli_query ($conexao, "SELECT b.silica FROM insulado_orcamentos a, insulado_tipos b WHERE a.id='$id_orcamento' AND a.camara2=b.id") or die (mysqli_error());
	}
	
	$info = mysqli_fetch_array ($con_camara);
		$silica = $info['silica'];
	
	if ($silica > 0) {
		$consulta_componentes = mysqli_query ($conexao, "SELECT silica FROM insulado_componentes WHERE id='1'") or die (mysqli_error());
			$dados = mysqli_fetch_array ($consulta_componentes);
				$vlr_silica = $dados['silica'];
		
		$vlr = round(($vlr_silica / 1000) * $silica, 2); // $silica = qtde em gramas por metro linear
		
		$resultado = round($vlr * $ml, 2);
		
		return $resultado;
	}
	else {
		$resultado = 0;
		
		return $resultado;
	}
}

/* ************** */

// BUTYL
function calc_butyl($conexao, $id_orcamento, $camara, $ml) {
	if ($camara == 1) {
		$con_camara = mysqli_query ($conexao, "SELECT b.butyl FROM insulado_orcamentos a, insulado_tipos b WHERE a.id='$id_orcamento' AND a.camara1=b.id") or die (mysqli_error());
	}
	elseif ($camara == 2) {
		$con_camara = mysqli_query ($conexao, "SELECT b.butyl FROM insulado_orcamentos a, insulado_tipos b WHERE a.id='$id_orcamento' AND a.camara2=b.id") or die (mysqli_error());
	}
	
	$info = mysqli_fetch_array ($con_camara);
		$butyl = $info['butyl'];
	
	if ($butyl > 0) {
		$consulta_componentes = mysqli_query ($conexao, "SELECT butyl FROM insulado_componentes WHERE id='1'") or die (mysqli_error());
			$dados = mysqli_fetch_array ($consulta_componentes);
				$vlr_butyl = $dados['butyl'];
		
		$vlr = round(($vlr_butyl / 1000) * $butyl, 2); // $butyl = qtde em gramas por metro linear
		
		$resultado = round($vlr * $ml, 2);
		
		return $resultado;
	}
	else {
		$resultado = 0;
		
		return $resultado;
	}
}

/* ************** */

// SILICONE
function calc_silicone($conexao, $id_orcamento, $camara, $ml, $m2_peca) {
	if ($camara == 1) {
		$con_camara = mysqli_query ($conexao, "SELECT a.silicone_todas, a.silicone_cantos, b.tipo, b.silicone, b.silicone_3m AS sil_maior, b.silicone_cantos AS sil_cantos FROM insulado_orcamentos a, insulado_tipos b WHERE a.id='$id_orcamento' AND a.camara1=b.id") or die (mysqli_error());
	}
	elseif ($camara == 2) {
		$con_camara = mysqli_query ($conexao, "SELECT a.silicone_todas, a.silicone_cantos, b.tipo, b.silicone, b.silicone_3m AS sil_maior, b.silicone_cantos AS sil_cantos FROM insulado_orcamentos a, insulado_tipos b WHERE a.id='$id_orcamento' AND a.camara2=b.id") or die (mysqli_error());
	}
	
	$info = mysqli_fetch_array ($con_camara);
		$silicone_todas 	= $info['silicone_todas'];
		$silicone_cantos 	= $info['silicone_cantos'];
		
		$tipo 				= $info['tipo'];
		$silicone 			= $info['silicone'];
		$sil_maior 			= $info['sil_maior'];
		$sil_cantos 		= $info['sil_cantos'];
	
	$consulta_componentes = mysqli_query ($conexao, "SELECT silicone FROM insulado_componentes WHERE id='1'") or die (mysqli_error());
		$dados = mysqli_fetch_array ($consulta_componentes);
			$vlr_silicone = $dados['silicone'];
		
	/* ***** */
	
	if ($tipo == "ALU" || $tipo == "TRI" || $tipo == "PER") { // ALUMÍNIO OU TRISEAL OU PERSIANA
		$vlr = round(($vlr_silicone / 1000) * $silicone, 2);
	
		$resultado = round($vlr * $ml, 2);
	}
	elseif ($tipo == "DUR" || $tipo == "DLT") { // DURASEAL OU DURALITE
		if ($silicone_todas == "N" && $silicone_cantos == "N") {
			
			if ($m2_peca >= 3) { // Se a peça tiver 3m² ou mais, aplica silicone
				$vlr = round(($vlr_silicone / 1000) * $sil_maior, 2);
	
				$resultado = round($vlr * $ml, 2);
			}
			else {
				$resultado = 0;
			}
			
		}
		elseif ($silicone_todas == "S" && $silicone_cantos == "N") { // Se estiver selecionada SILICONE EM TODAS AS PEÇAS
			
			$vlr = round(($vlr_silicone / 1000) * $sil_maior, 2);
	
			$resultado = round($vlr * $ml, 2);
			
		}
		
		elseif ($silicone_todas == "N" && $silicone_cantos == "S") { // Se estiver selecionada SILICONE NOS CANTOS
						
			if ($m2_peca >= 3) { // Se a peça tiver 3m² ou mais, aplica silicone
				$vlr = round(($vlr_silicone / 1000) * $sil_maior, 2);
	
				$resultado = round($vlr * $ml, 2);
			}
			else {
				if ($ml < 1.5) {
					$vlr = round(($vlr_silicone / 1000) * $sil_maior, 2);
	
					$resultado = round($vlr * $ml, 2); // Se a peça tiver menos que 1,5ML -> aplica na ML da peça
				}
				else {
					$vlr = round(($vlr_silicone / 1000) * $sil_maior, 2);
	
					$resultado = round($vlr * 1.5, 2); // Se a peça tiver mais que 1,5ML -> aplica sobre 1.5ML da peça
				}
				
			}
		}
	}
	
	return $resultado;
		
}

/* ************** */

// GÁS
function calc_gas($conexao, $id_orcamento, $m3_peca) {
	$con_camara = mysqli_query ($conexao, "SELECT a.gas FROM insulado_orcamentos a WHERE a.id='$id_orcamento'") or die (mysqli_error());
		$info = mysqli_fetch_array ($con_camara);
			$gas = $info['gas'];
	
	if ($gas == "S") {
		$consulta_componentes = mysqli_query ($conexao, "SELECT gas FROM insulado_componentes WHERE id='1'") or die (mysqli_error());
			$dados = mysqli_fetch_array ($consulta_componentes);
				$vlr_gas = $dados['gas'];
		
		$resultado = round($vlr_gas * $m3_peca, 2);
	}
	else {
		$resultado = 0;
	}
	
	return $resultado;
}

/* ************** */

// SERVIÇOS
function calc_servicos($m2_peca, $sp1, $sp2, $co1, $co2, $si1, $si2, $bu1, $bu2, $sl1, $sl2, $gs1, $gs2) {
	$calculo = $sp1 + $sp2 + $co1 + $co2 + $si1 + $si2 + $bu1 + $bu2 + $sl1 + $sl2 + $gs1 + $gs2;
	
	if ($m2_peca < 3) {
		// O valor dos serviços continuam os mesmos
		$total_servicos = $calculo;
	}
	else if ($m2_peca >= 3 && $m2_peca <= 3.75) {
		// O valor dos serviços acrescem 10%
		$total_servicos = $calculo + ((10/100) * $calculo);
	}
	else if ($m2_peca >= 3.76 && $m2_peca <= 4.50) {
		// O valor dos serviços acrescem 20%
		$total_servicos = $calculo + ((20/100) * $calculo);
	}
	else if ($m2_peca >= 4.51) {
		// O valor dos serviços acrescem 30%
		$total_servicos = $calculo + ((30/100) * $calculo);
	}
	
	$resultado = round($total_servicos, 2);
	
	return $resultado;
}

/* ************** */

// VALOR UNITÁRIO
function calc_vlr($vidro1, $vidro2, $vidro3, $servicos) {
	$calculo = $vidro1 + $vidro2 + $vidro3 + $servicos;
	
	$resultado = round($calculo, 2);
	
	return $resultado;
}

// VALOR TOTAL
function calc_vlr_total($valor, $qtde) {
	$calculo = $valor * $qtde;
	
	$resultado = round($calculo, 2);
	
	return $resultado;
}

/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */

/* ******************************************************************************************************************
NOVO ORÇAMENTO
****************************************************************************************************************** */
if ($_GET['funcao'] == "novo_orcamento") {

// Dados do formulário
$cliente = strip_tags(trim($_POST['cliente']));

$cliente = strtr(strtoupper($cliente),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

// Se os campos CÓDIGO e NOME não forem digitados retorna um erro
if ($cliente == "") {
	header ('Location: ../orcamentos_insulado_novo.php?msgErro=Você não selecionou o cliente.');
}
else {
	$codigo = md5(date("YmdHis").$cliente.$id_usuario);
	
	// Dados Negociação
	$data_agora = date ("Y-m-d H:i:s");
	
	$data_negociacao = date('Y-m-d', strtotime("+10 days"));
	
	$cadastra = mysqli_query ($conexao, "INSERT INTO insulado_orcamentos (codigo, usuario, ip, tipo_usuario, cliente_nome, neg_data, neg_usuario, neg_ip, neg_status, neg_limite) VALUES ('$codigo', '$id_usuario', '$ip', 'R', '$cliente', '$data_agora', '$id_usuario', '$ip', 'G', '$data_negociacao')") or die (mysqli_error());
	
	// Pega o ID do orçamento solicitado
	$consulta_cadastro = mysqli_query ($conexao, "SELECT id FROM insulado_orcamentos WHERE usuario='$id_usuario' AND ip='$ip' AND cliente_nome='$cliente' ORDER BY id DESC") or die (mysqli_error());
		$dados = mysqli_fetch_array ($consulta_cadastro);
			$id_orcamento = $dados['id'];
	
	header ('Location: ../orcamentos_insulado_novo.php?orcamento='.$codigo.'&msgSucesso=Orçamento aberto com sucesso, selecione a composição e cadastre as medidas.');

}

}

/* ******************************************************************************************************************
EDITAR CLIENTE
****************************************************************************************************************** */
if ($_GET['funcao'] == "editar_cliente") {

$codigo = $_GET['orcamento'];

// Dados do formulário
$cliente = strip_tags(trim($_POST['cliente']));

$cliente = strtr(strtoupper($cliente),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

// Se os campos CÓDIGO e NOME não forem digitados retorna um erro
if ($cliente == "") {
	header ('Location: ../orcamentos_insulado_novo.php?orcamento='.$id_orcamento.'&msgErro=Você não selecionou o cliente.');
}
else {
	
	$atualiza = mysqli_query ($conexao, "UPDATE insulado_orcamentos SET cliente_nome='$cliente' WHERE codigo='$codigo'") or die (mysqli_error());
	
	header ('Location: ../orcamentos_insulado_novo.php?orcamento='.$codigo.'&msgSucesso=Cliente alterado com sucesso.');

}

}

/* ******************************************************************************************************************
OBSERVAÇÕES
****************************************************************************************************************** */
if ($_GET['funcao'] == "observacoes") {

$codigo = $_GET['orcamento'];

// Dados do formulário
$obs 		= strip_tags(trim($_POST['obs']));
$imposto 	= strip_tags(trim($_POST['imposto']));

$obs = strtr(strtoupper($obs),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

$atualiza = mysqli_query ($conexao, "UPDATE insulado_orcamentos SET observacoes='$obs', imposto='$imposto' WHERE codigo='$codigo'") or die (mysqli_error());
	
header ('Location: ../orcamentos_insulado_novo.php?orcamento='.$codigo.'&msgSucesso=Observações atualizadas com sucesso.');

}

/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */
/* ******************************************************************************************************************************************************************************* */

/* ******************************************************************************************************************
INCLUSÃO DE PEÇAS
****************************************************************************************************************** */
if ($_GET['funcao'] == "pecas") {

$codigo = $_GET['orcamento'];

// Consulta Orçamento
$con_orc_id = mysqli_query ($conexao, "SELECT id FROM insulado_orcamentos WHERE codigo='$codigo'") or die (mysql_error());
	$d_orc_id = mysqli_fetch_array ($con_orc_id);
		$id_orcamento = $d_orc_id['id'];

// Dados do formulário
$largura 	= strip_tags(trim($_POST['largura']));
$altura 	= strip_tags(trim($_POST['altura']));
$qtde 		= strip_tags(trim($_POST['qtde']));

// Verifica o tipo de composição atual deste orçamento
$consulta_orcamento = mysqli_query ($conexao, "SELECT tipo_composicao FROM insulado_orcamentos WHERE codigo='$codigo'") or die (mysqli_error());
	$d_orc = mysqli_fetch_array ($consulta_orcamento);
		$t_composicao_orc = $d_orc['tipo_composicao'];

// Se não houver composição cadastrada
if ($t_composicao_orc == "N") {
	
	$cadastra = mysqli_query ($conexao, "INSERT INTO insulado_pecas
							 (id_orcamento, qtde, largura, altura) 
							 VALUES
							 ('$id_orcamento', '$qtde', '$largura', '$altura')
							 ") or die (mysqli_error());

}
// Se o vidro for DUPLO
elseif ($t_composicao_orc == "D") {
	
	/* *********************
	INÍCIO CÁLCULOS : DUPLO
	********************* */ 
	$m2_largura = calc_m2($largura);
	$m2_altura = calc_m2($altura);
	
	$m2_peca = calc_m2_peca($m2_largura, $m2_altura);
	$m2_total = $m2_peca * $qtde;
	
	$m3_peca_1 = calc_m3_peca($conexao, $id_orcamento, $m2_largura, $m2_altura, "1");
	$m3_peca_2 = 0;
	
	$vlr_vidro_1 = calc_valor_vidro($conexao, $id_orcamento, $m2_peca, "1");
	$vlr_vidro_2 = calc_valor_vidro($conexao, $id_orcamento, $m2_peca, "2");
	$vlr_vidro_3 = 0;
	
	$ml_peca = calc_ml($largura, $altura);
	$ml_total = $ml_peca * $qtde;
	
	$spacer_1 = calc_spacer($conexao, $id_orcamento, "1", $ml_peca);
	$spacer_2 = 0;
	
	$conector_1 = calc_conector($conexao, $id_orcamento, "1");
	$conector_2 = 0;
	
	$silica_1 = calc_silica($conexao, $id_orcamento, "1", $ml_peca);
	$silica_2 = 0;
	
	$butyl_1 = calc_butyl($conexao, $id_orcamento, "1", $ml_peca);
	$butyl_2 = 0;
	
	$silicone_1 = calc_silicone($conexao, $id_orcamento, "1", $ml_peca, $m2_peca);
	$silicone_2 = 0;
	
	$gas_1 = calc_gas($conexao, $id_orcamento, $m3_peca_1);
	$gas_2 = 0;
	
	$servicos = calc_servicos($m2_peca, $spacer_1, $spacer_2, $conector_1, $conector_2, $silica_1, $silica_2, $butyl_1, $butyl_2, $silicone_1, $silicone_2, $gas_1, $gas_2);
	
	$vlr_un = calc_vlr($vlr_vidro_1, $vlr_vidro_2, $vlr_vidro_3, $servicos);
	$vlr_total = calc_vlr_total($vlr_un, $qtde);
	/* *********************
	FIM CÁLCULOS : DUPLO
	********************* */
	
	$cadastra = mysqli_query ($conexao, "INSERT INTO insulado_pecas
							 (id_orcamento, qtde, largura, altura, m2_largura, m2_altura, m2_peca, m2_total, m3_cam1, m3_cam2,
							 vidro1_vlr, vidro2_vlr, vidro3_vlr, ml, ml_total,
							 spacer_cam1, spacer_cam2, conector_cam1, conector_cam2, silica_cam1, silica_cam2,
							 butyl_cam1, butyl_cam2, silicone_cam1, silicone_cam2, gas_cam1, gas_cam2,
							 servicos, valor_un, valor_total) 
							 VALUES
							 ('$id_orcamento', '$qtde', '$largura', '$altura', '$m2_largura', '$m2_altura', '$m2_peca', '$m2_total', '$m3_peca_1', '$m3_peca_2',
							 '$vlr_vidro_1', '$vlr_vidro_2', '$vlr_vidro_3', '$ml_peca', '$ml_total',
							 '$spacer_1', '$spacer_2', '$conector_1', '$conector_2', '$silica_1', '$silica_2',
							 '$butyl_1', '$butyl_2', '$silicone_1', '$silicone_2', '$gas_1', '$gas_2',
							 '$servicos', '$vlr_un', '$vlr_total')
							 ") or die (mysqli_error());
	
}
// Se o vidro for TRIPLO
elseif ($t_composicao_orc == "T") {
	
	/* *********************
	INÍCIO CÁLCULOS : TRIPLO
	********************* */
	$m2_largura = calc_m2($largura);
	$m2_altura = calc_m2($altura);
	
	$m2_peca = calc_m2_peca($m2_largura, $m2_altura);
	$m2_total = $m2_peca * $qtde;
	
	$m3_peca_1 = calc_m3_peca($conexao, $id_orcamento, $m2_largura, $m2_altura, "1");
	$m3_peca_2 = calc_m3_peca($conexao, $id_orcamento, $m2_largura, $m2_altura, "2");
	
	$vlr_vidro_1 = calc_valor_vidro($conexao, $id_orcamento, $m2_peca, "1");
	$vlr_vidro_2 = calc_valor_vidro($conexao, $id_orcamento, $m2_peca, "2");
	$vlr_vidro_3 = calc_valor_vidro($conexao, $id_orcamento, $m2_peca, "3");
	
	$ml_peca = calc_ml($largura, $altura);
	$ml_total = $ml_peca * $qtde;
	
	$spacer_1 = calc_spacer($conexao, $id_orcamento, "1", $ml_peca);
	$spacer_2 = calc_spacer($conexao, $id_orcamento, "2", $ml_peca);
	
	$conector_1 = calc_conector($conexao, $id_orcamento, "1");
	$conector_2 = calc_conector($conexao, $id_orcamento, "2");
	
	$silica_1 = calc_silica($conexao, $id_orcamento, "1", $ml_peca);
	$silica_2 = calc_silica($conexao, $id_orcamento, "2", $ml_peca);
	
	$butyl_1 = calc_butyl($conexao, $id_orcamento, "1", $ml_peca);
	$butyl_2 = calc_butyl($conexao, $id_orcamento, "2", $ml_peca);
	
	$silicone_1 = calc_silicone($conexao, $id_orcamento, "1", $ml_peca, $m2_peca);
	$silicone_2 = calc_silicone($conexao, $id_orcamento, "2", $ml_peca, $m2_peca);
	
	$gas_1 = calc_gas($conexao, $id_orcamento, $m3_peca_1);
	$gas_2 = calc_gas($conexao, $id_orcamento, $m3_peca_2);
	
	$servicos = calc_servicos($m2_peca, $spacer_1, $spacer_2, $conector_1, $conector_2, $silica_1, $silica_2, $butyl_1, $butyl_2, $silicone_1, $silicone_2, $gas_1, $gas_2);
	
	$vlr_un = calc_vlr($vlr_vidro_1, $vlr_vidro_2, $vlr_vidro_3, $servicos);
	$vlr_total = calc_vlr_total($vlr_un, $qtde);
	/* *********************
	FIM CÁLCULOS : TRIPLO
	********************* */
	
	$cadastra = mysqli_query ($conexao, "INSERT INTO insulado_pecas
							 (id_orcamento, qtde, largura, altura, m2_largura, m2_altura, m2_peca, m2_total, m3_cam1, m3_cam2,
							 vidro1_vlr, vidro2_vlr, vidro3_vlr, ml, ml_total,
							 spacer_cam1, spacer_cam2, conector_cam1, conector_cam2, silica_cam1, silica_cam2,
							 butyl_cam1, butyl_cam2, silicone_cam1, silicone_cam2, gas_cam1, gas_cam2,
							 servicos, valor_un, valor_total) 
							 VALUES
							 ('$id_orcamento', '$qtde', '$largura', '$altura', '$m2_largura', '$m2_altura', '$m2_peca', '$m2_total', '$m3_peca_1', '$m3_peca_2',
							 '$vlr_vidro_1', '$vlr_vidro_2', '$vlr_vidro_3', '$ml_peca', '$ml_total',
							 '$spacer_1', '$spacer_2', '$conector_1', '$conector_2', '$silica_1', '$silica_2',
							 '$butyl_1', '$butyl_2', '$silicone_1', '$silicone_2', '$gas_1', '$gas_2',
							 '$servicos', '$vlr_un', '$vlr_total')
							 ") or die (mysqli_error());
	
}

header ('Location: ../orcamentos_insulado_novo.php?orcamento='.$codigo);

}

/* ******************************************************************************************************************
COMPOSIÇÃO: DUPLO
****************************************************************************************************************** */
if ($_GET['funcao'] == "composicao_duplo") {

$codigo = $_GET['orcamento'];

// Consulta Orçamento
$con_orc_id = mysqli_query ($conexao, "SELECT id FROM insulado_orcamentos WHERE codigo='$codigo'") or die (mysql_error());
	$d_orc_id = mysqli_fetch_array ($con_orc_id);
		$id_orcamento = $d_orc_id['id'];

// Verifica o tipo de composição atual deste orçamento
$consulta_orcamento = mysqli_query ($conexao, "SELECT tipo_composicao FROM insulado_orcamentos WHERE codigo='$codigo'") or die (mysqli_error());
	$d_orc = mysqli_fetch_array ($consulta_orcamento);
		$t_composicao_orc = $d_orc['tipo_composicao'];

// Dados do formulário
$v1_vidro 	= strip_tags(trim($_POST['vidro1']));
$v1_esp 	= strip_tags(trim($_POST['espessura1']));
$v1_tipo 	= strip_tags(trim($_POST['tipo1']));
$v1_vlr 	= strip_tags(trim($_POST['valor1']));
$camara1 	= strip_tags(trim($_POST['camara1']));
$v2_vidro 	= strip_tags(trim($_POST['vidro2']));
$v2_esp 	= strip_tags(trim($_POST['espessura2']));
$v2_tipo 	= strip_tags(trim($_POST['tipo2']));
$v2_vlr 	= strip_tags(trim($_POST['valor2']));

$v1_vidro = strtr(strtoupper($v1_vidro),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$v2_vidro = strtr(strtoupper($v2_vidro),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

/* ************** */

// Verifica se foi digitado os campos obrigatórios
if ($v1_vidro != "" && $v1_esp != "" && $v1_tipo != "") { $x_vidro1 = true; } else { $x_vidro1 = false; }
if ($camara1 != "") { $x_camara1 = true; } else { $x_camara1 = false; }
if ($v2_vidro != "" && $v2_esp != "" && $v2_tipo != "") { $x_vidro2 = true; } else { $x_vidro2 = false; }

if ($x_vidro1 == true && $x_camara1 == true && $x_vidro2 == true) {
	
	// Se a composição for de vidro TRIPLO, mantém, caso contrário muda para DUPLO
	if ($t_composicao_orc == "T") {
		$tipo_composicao = "T";
	}
	else {
		$tipo_composicao = "D";
	}
	
	$con_camara_1 = mysqli_query ($conexao, "SELECT tipo FROM insulado_tipos WHERE id='$camara1'") or die (mysqli_error());
		$d_cam1 = mysqli_fetch_array ($con_camara_1);
			$tipo_camara_1 = $d_cam1['tipo'];
	
	$atualiza = mysqli_query ($conexao, "UPDATE insulado_orcamentos SET 
							 vidro1_vidro='$v1_vidro', vidro1_esp='$v1_esp', vidro1_tipo='$v1_tipo', vidro1_vlr='$v1_vlr',
							 vidro2_vidro='$v2_vidro', vidro2_esp='$v2_esp', vidro2_tipo='$v2_tipo', vidro2_vlr='$v2_vlr',
							 camara1='$camara1', tipo_camaras='$tipo_camara_1', tipo_composicao='$tipo_composicao'
							 WHERE codigo='$codigo'") or die (mysqli_error());
	
	/* ***** */
	// Verifica se há peças lançadas
	$consulta_itens = mysqli_query ($conexao, "SELECT id, qtde, largura, altura FROM insulado_pecas WHERE id_orcamento='$id_orcamento'") or die (mysqli_error());
		$conta_itens = mysqli_num_rows ($consulta_itens);
		
	if ($conta_itens > 0 && $tipo_composicao == "D") {
		
		while ($d_itens = mysqli_fetch_array($consulta_itens)) {
			$id_item	= $d_itens['id'];
			$qtde 		= $d_itens['qtde'];
			$largura 	= $d_itens['largura'];
			$altura 	= $d_itens['altura'];
			
			/* *********************
			INÍCIO CÁLCULOS : DUPLO
			********************* */
			$m2_largura = calc_m2($largura);
			$m2_altura = calc_m2($altura);
			
			$m2_peca = calc_m2_peca($m2_largura, $m2_altura);
			$m2_total = $m2_peca * $qtde;
			
			$m3_peca_1 = calc_m3_peca($conexao, $id_orcamento, $m2_largura, $m2_altura, "1");
			$m3_peca_2 = 0;
			
			$vlr_vidro_1 = calc_valor_vidro($conexao, $id_orcamento, $m2_peca, "1");
			$vlr_vidro_2 = calc_valor_vidro($conexao, $id_orcamento, $m2_peca, "2");
			$vlr_vidro_3 = 0;
			
			$ml_peca = calc_ml($largura, $altura);
			$ml_total = $ml_peca * $qtde;
			
			$spacer_1 = calc_spacer($conexao, $id_orcamento, "1", $ml_peca);
			$spacer_2 = 0;
			
			$conector_1 = calc_conector($conexao, $id_orcamento, "1");
			$conector_2 = 0;
			
			$silica_1 = calc_silica($conexao, $id_orcamento, "1", $ml_peca);
			$silica_2 = 0;
			
			$butyl_1 = calc_butyl($conexao, $id_orcamento, "1", $ml_peca);
			$butyl_2 = 0;
			
			$silicone_1 = calc_silicone($conexao, $id_orcamento, "1", $ml_peca, $m2_peca);
			$silicone_2 = 0;
			
			$gas_1 = calc_gas($conexao, $id_orcamento, $m3_peca_1);
			$gas_2 = 0;
			
			$servicos = calc_servicos($m2_peca, $spacer_1, $spacer_2, $conector_1, $conector_2, $silica_1, $silica_2, $butyl_1, $butyl_2, $silicone_1, $silicone_2, $gas_1, $gas_2);
			
			$vlr_un = calc_vlr($vlr_vidro_1, $vlr_vidro_2, 0, $servicos);
			$vlr_total = calc_vlr_total($vlr_un, $qtde);
			/* *********************
			FIM CÁLCULOS : DUPLO
			********************* */
			
			$atu_itens = mysqli_query ($conexao, "UPDATE insulado_pecas SET 
									  m2_largura='$m2_largura', m2_altura='$m2_altura', m2_peca='$m2_peca', m2_total='$m2_total',
									  m3_cam1='$m3_peca_1', m3_cam2='$m3_peca_2', vidro1_vlr='$vlr_vidro_1', vidro2_vlr='$vlr_vidro_2', vidro3_vlr='$vlr_vidro_3',
									  ml='$ml_peca', ml_total='$ml_total', spacer_cam1='$spacer_1', spacer_cam2='$spacer_2', 
									  conector_cam1='$conector_1', conector_cam2='$conector_2', silica_cam1='$silica_1', silica_cam2='$silica_2',
									  silica_cam1='$silica_1', silica_cam2='$silica_2', butyl_cam1='$butyl_1', butyl_cam2='$butyl_2',
									  silicone_cam1='$silicone_1', silicone_cam2='$silicone_2', gas_cam1='$gas_1', gas_cam2='$gas_2',
									  servicos='$servicos', valor_un='$vlr_un', valor_total='$vlr_total'
									  WHERE id='$id_item'") or die (mysqli_error());
		}
		
	}
	elseif ($conta_itens > 0 && $tipo_composicao == "T") {
		
		while ($d_itens = mysqli_fetch_array($consulta_itens)) {
			$id_item	= $d_itens['id'];
			$qtde 		= $d_itens['qtde'];
			$largura 	= $d_itens['largura'];
			$altura 	= $d_itens['altura'];
			
			/* *********************
			INÍCIO CÁLCULOS : TRIPLO
			********************* */
			$m2_largura = calc_m2($largura);
			$m2_altura = calc_m2($altura);
			
			$m2_peca = calc_m2_peca($m2_largura, $m2_altura);
			$m2_total = $m2_peca * $qtde;
			
			$m3_peca_1 = calc_m3_peca($conexao, $id_orcamento, $m2_largura, $m2_altura, "1");
			$m3_peca_2 = calc_m3_peca($conexao, $id_orcamento, $m2_largura, $m2_altura, "2");
			
			$vlr_vidro_1 = calc_valor_vidro($conexao, $id_orcamento, $m2_peca, "1");
			$vlr_vidro_2 = calc_valor_vidro($conexao, $id_orcamento, $m2_peca, "2");
			$vlr_vidro_3 = calc_valor_vidro($conexao, $id_orcamento, $m2_peca, "3");
			
			$ml_peca = calc_ml($largura, $altura);
			$ml_total = $ml_peca * $qtde;
			
			$spacer_1 = calc_spacer($conexao, $id_orcamento, "1", $ml_peca);
			$spacer_2 = calc_spacer($conexao, $id_orcamento, "2", $ml_peca);
			
			$conector_1 = calc_conector($conexao, $id_orcamento, "1");
			$conector_2 = calc_conector($conexao, $id_orcamento, "2");
			
			$silica_1 = calc_silica($conexao, $id_orcamento, "1", $ml_peca);
			$silica_2 = calc_silica($conexao, $id_orcamento, "2", $ml_peca);
			
			$butyl_1 = calc_butyl($conexao, $id_orcamento, "1", $ml_peca);
			$butyl_2 = calc_butyl($conexao, $id_orcamento, "2", $ml_peca);
			
			$silicone_1 = calc_silicone($conexao, $id_orcamento, "1", $ml_peca, $m2_peca);
			$silicone_2 = calc_silicone($conexao, $id_orcamento, "2", $ml_peca, $m2_peca);
			
			$gas_1 = calc_gas($conexao, $id_orcamento, $m3_peca_1);
			$gas_2 = calc_gas($conexao, $id_orcamento, $m3_peca_2);
			
			$servicos = calc_servicos($m2_peca, $spacer_1, $spacer_2, $conector_1, $conector_2, $silica_1, $silica_2, $butyl_1, $butyl_2, $silicone_1, $silicone_2, $gas_1, $gas_2);
			
			$vlr_un = calc_vlr($vlr_vidro_1, $vlr_vidro_2, $vlr_vidro_3, $servicos);
			$vlr_total = calc_vlr_total($vlr_un, $qtde);
			/* *********************
			FIM CÁLCULOS : TRIPLO
			********************* */
			
			$atu_itens = mysqli_query ($conexao, "UPDATE insulado_pecas SET 
									  m2_largura='$m2_largura', m2_altura='$m2_altura', m2_peca='$m2_peca', m2_total='$m2_total',
									  m3_cam1='$m3_peca_1', m3_cam2='$m3_peca_2', vidro1_vlr='$vlr_vidro_1', vidro2_vlr='$vlr_vidro_2', vidro3_vlr='$vlr_vidro_3',
									  ml='$ml_peca', ml_total='$ml_total', spacer_cam1='$spacer_1', spacer_cam2='$spacer_2', 
									  conector_cam1='$conector_1', conector_cam2='$conector_2', silica_cam1='$silica_1', silica_cam2='$silica_2',
									  silica_cam1='$silica_1', silica_cam2='$silica_2', butyl_cam1='$butyl_1', butyl_cam2='$butyl_2',
									  silicone_cam1='$silicone_1', silicone_cam2='$silicone_2', gas_cam1='$gas_1', gas_cam2='$gas_2',
									  servicos='$servicos', valor_un='$vlr_un', valor_total='$vlr_total'
									  WHERE id='$id_item'") or die (mysqli_error());
		}
		
	}
	
	/* ***** */
	
	header ('Location: ../orcamentos_insulado_novo.php?orcamento='.$codigo.'&msgSucesso=Composição atualizada com sucesso.');
	
}
else {
	
	header ('Location: ../orcamentos_insulado_novo.php?orcamento='.$codigo.'&msgErro=Você não selecionou todos os itens necessários para a composição.');
	
}

}

/* ******************************************************************************************************************
COMPOSIÇÃO: TRIPLO
****************************************************************************************************************** */
if ($_GET['funcao'] == "composicao_triplo") {

$codigo = $_GET['orcamento'];

// Consulta Orçamento
$con_orc_id = mysqli_query ($conexao, "SELECT id FROM insulado_orcamentos WHERE codigo='$codigo'") or die (mysql_error());
	$d_orc_id = mysqli_fetch_array ($con_orc_id);
		$id_orcamento = $d_orc_id['id'];

// Dados do formulário
$camara2 	= strip_tags(trim($_POST['camara2']));
$v3_vidro 	= strip_tags(trim($_POST['vidro3']));
$v3_esp 	= strip_tags(trim($_POST['espessura3']));
$v3_tipo 	= strip_tags(trim($_POST['tipo3']));
$v3_vlr 	= strip_tags(trim($_POST['valor3']));

$v3_vidro = strtr(strtoupper($v3_vidro),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

/* ************** */

// Verifica se foi digitado os campos obrigatórios
if ($camara2 != "") { $x_camara2 = true; } else { $x_camara2 = false; }
if ($v3_vidro != "" && $v3_esp != "" && $v3_tipo != "") { $x_vidro3 = true; } else { $x_vidro3 = false; }

if ($x_vidro3 == true && $x_camara2 == true) {
	
	$tipo_composicao = "T";
	
	$con_camara_2 = mysqli_query ($conexao, "SELECT tipo FROM insulado_tipos WHERE id='$camara2'") or die (mysqli_error());
		$d_cam2 = mysqli_fetch_array ($con_camara_2);
			$tipo_camara_2 = $d_cam2['tipo'];
	
	$atualiza = mysqli_query ($conexao, "UPDATE insulado_orcamentos SET 
							 vidro3_vidro='$v3_vidro', vidro3_esp='$v3_esp', vidro3_tipo='$v3_tipo', vidro3_vlr='$v3_vlr',
							 camara2='$camara2', tipo_camaras='$tipo_camara_2', tipo_composicao='$tipo_composicao'
							 WHERE codigo='$codigo'") or die (mysqli_error());
	
	/* ***** */
	// Verifica se há peças lançadas
	$consulta_itens = mysqli_query ($conexao, "SELECT id, qtde, largura, altura FROM insulado_pecas WHERE id_orcamento='$id_orcamento'") or die (mysqli_error());
		$conta_itens = mysqli_num_rows ($consulta_itens);
		
	if ($conta_itens > 0) {
		
		while ($d_itens = mysqli_fetch_array($consulta_itens)) {
			$id_item	= $d_itens['id'];
			$qtde 		= $d_itens['qtde'];
			$largura 	= $d_itens['largura'];
			$altura 	= $d_itens['altura'];
		
			/* *********************
			INÍCIO CÁLCULOS : TRIPLO
			********************* */
			$m2_largura = calc_m2($largura);
			$m2_altura = calc_m2($altura);
			
			$m2_peca = calc_m2_peca($m2_largura, $m2_altura);
			$m2_total = $m2_peca * $qtde;
			
			$m3_peca_1 = calc_m3_peca($conexao, $id_orcamento, $m2_largura, $m2_altura, "1");
			$m3_peca_2 = calc_m3_peca($conexao, $id_orcamento, $m2_largura, $m2_altura, "2");
			
			$vlr_vidro_1 = calc_valor_vidro($conexao, $id_orcamento, $m2_peca, "1");
			$vlr_vidro_2 = calc_valor_vidro($conexao, $id_orcamento, $m2_peca, "2");
			$vlr_vidro_3 = calc_valor_vidro($conexao, $id_orcamento, $m2_peca, "3");
			
			$ml_peca = calc_ml($largura, $altura);
			$ml_total = $ml_peca * $qtde;
			
			$spacer_1 = calc_spacer($conexao, $id_orcamento, "1", $ml_peca);
			$spacer_2 = calc_spacer($conexao, $id_orcamento, "2", $ml_peca);
			
			$conector_1 = calc_conector($conexao, $id_orcamento, "1");
			$conector_2 = calc_conector($conexao, $id_orcamento, "2");
			
			$silica_1 = calc_silica($conexao, $id_orcamento, "1", $ml_peca);
			$silica_2 = calc_silica($conexao, $id_orcamento, "2", $ml_peca);
			
			$butyl_1 = calc_butyl($conexao, $id_orcamento, "1", $ml_peca);
			$butyl_2 = calc_butyl($conexao, $id_orcamento, "2", $ml_peca);
			
			$silicone_1 = calc_silicone($conexao, $id_orcamento, "1", $ml_peca, $m2_peca);
			$silicone_2 = calc_silicone($conexao, $id_orcamento, "2", $ml_peca, $m2_peca);
			
			$gas_1 = calc_gas($conexao, $id_orcamento, $m3_peca_1);
			$gas_2 = calc_gas($conexao, $id_orcamento, $m3_peca_2);
			
			$servicos = calc_servicos($m2_peca, $spacer_1, $spacer_2, $conector_1, $conector_2, $silica_1, $silica_2, $butyl_1, $butyl_2, $silicone_1, $silicone_2, $gas_1, $gas_2);
			
			$vlr_un = calc_vlr($vlr_vidro_1, $vlr_vidro_2, $vlr_vidro_3, $servicos);
			$vlr_total = calc_vlr_total($vlr_un, $qtde);
			/* *********************
			FIM CÁLCULOS : TRIPLO
			********************* */
				
			$atu_itens = mysqli_query ($conexao, "UPDATE insulado_pecas SET 
									  m2_largura='$m2_largura', m2_altura='$m2_altura', m2_peca='$m2_peca', m2_total='$m2_total',
									  m3_cam1='$m3_peca_1', m3_cam2='$m3_peca_2', vidro1_vlr='$vlr_vidro_1', vidro2_vlr='$vlr_vidro_2', vidro3_vlr='$vlr_vidro_3',
									  ml='$ml_peca', ml_total='$ml_total', spacer_cam1='$spacer_1', spacer_cam2='$spacer_2', 
									  conector_cam1='$conector_1', conector_cam2='$conector_2', silica_cam1='$silica_1', silica_cam2='$silica_2',
									  silica_cam1='$silica_1', silica_cam2='$silica_2', butyl_cam1='$butyl_1', butyl_cam2='$butyl_2',
									  silicone_cam1='$silicone_1', silicone_cam2='$silicone_2', gas_cam1='$gas_1', gas_cam2='$gas_2',
									  servicos='$servicos', valor_un='$vlr_un', valor_total='$vlr_total'
									  WHERE id='$id_item'") or die (mysqli_error());
									  
		}
		
	}	
	/* ***** */
	
	header ('Location: ../orcamentos_insulado_novo.php?orcamento='.$codigo.'&msgSucesso=Composição atualizada com sucesso.');
	
}
else {
	
	header ('Location: ../orcamentos_insulado_novo.php?orcamento='.$codigo.'&msgErro=Você não selecionou todos os itens necessários para a composição.');
	
}

}

/* ******************************************************************************************************************
EXCLUIR: TRIPLO
****************************************************************************************************************** */
if ($_GET['funcao'] == "excluir_triplo") {

$codigo = $_GET['orcamento'];

// Consulta Orçamento
$con_orc_id = mysqli_query ($conexao, "SELECT id FROM insulado_orcamentos WHERE codigo='$codigo'") or die (mysql_error());
	$d_orc_id = mysqli_fetch_array ($con_orc_id);
		$id_orcamento = $d_orc_id['id'];

$atu_orcam = mysqli_query ($conexao, "UPDATE insulado_orcamentos SET 
						  vidro3_vidro=null, vidro3_esp=null, vidro3_tipo=null, vidro3_vlr=null, camara2=null, tipo_composicao='D'
						  WHERE codigo='$codigo'") or die (mysqli_error());

// Verifica se há peças lançadas
$consulta_itens = mysqli_query ($conexao, "SELECT id, qtde, largura, altura FROM insulado_pecas WHERE id_orcamento='$id_orcamento'") or die (mysqli_error());
	$conta_itens = mysqli_num_rows ($consulta_itens);
	
if ($conta_itens > 0) {
	
	while ($d_itens = mysqli_fetch_array($consulta_itens)) {
		$id_item	= $d_itens['id'];
		$qtde 		= $d_itens['qtde'];
		$largura 	= $d_itens['largura'];
		$altura 	= $d_itens['altura'];
		
		/* *********************
		INÍCIO CÁLCULOS : DUPLO
		********************* */
		$m2_largura = calc_m2($largura);
		$m2_altura = calc_m2($altura);
		
		$m2_peca = calc_m2_peca($m2_largura, $m2_altura);
		$m2_total = $m2_peca * $qtde;
		
		$m3_peca_1 = calc_m3_peca($conexao, $id_orcamento, $m2_largura, $m2_altura, "1");
		$m3_peca_2 = 0;
		
		$vlr_vidro_1 = calc_valor_vidro($conexao, $id_orcamento, $m2_peca, "1");
		$vlr_vidro_2 = calc_valor_vidro($conexao, $id_orcamento, $m2_peca, "2");
		$vlr_vidro_3 = 0;
		
		$ml_peca = calc_ml($largura, $altura);
		$ml_total = $ml_peca * $qtde;
		
		$spacer_1 = calc_spacer($conexao, $id_orcamento, "1", $ml_peca);
		$spacer_2 = 0;
		
		$conector_1 = calc_conector($conexao, $id_orcamento, "1");
		$conector_2 = 0;
		
		$silica_1 = calc_silica($conexao, $id_orcamento, "1", $ml_peca);
		$silica_2 = 0;
		
		$butyl_1 = calc_butyl($conexao, $id_orcamento, "1", $ml_peca);
		$butyl_2 = 0;
		
		$silicone_1 = calc_silicone($conexao, $id_orcamento, "1", $ml_peca, $m2_peca);
		$silicone_2 = 0;
		
		$gas_1 = calc_gas($conexao, $id_orcamento, $m3_peca_1);
		$gas_2 = 0;
		
		$servicos = calc_servicos($m2_peca, $spacer_1, $spacer_2, $conector_1, $conector_2, $silica_1, $silica_2, $butyl_1, $butyl_2, $silicone_1, $silicone_2, $gas_1, $gas_2);
		
		$vlr_un = calc_vlr($vlr_vidro_1, $vlr_vidro_2, 0, $servicos);
		$vlr_total = calc_vlr_total($vlr_un, $qtde);
		/* *********************
		FIM CÁLCULOS : DUPLO
		********************* */
		
		$atu_itens = mysqli_query ($conexao, "UPDATE insulado_pecas SET 
								  m2_largura='$m2_largura', m2_altura='$m2_altura', m2_peca='$m2_peca', m2_total='$m2_total',
								  m3_cam1='$m3_peca_1', m3_cam2='$m3_peca_2', vidro1_vlr='$vlr_vidro_1', vidro2_vlr='$vlr_vidro_2', vidro3_vlr='$vlr_vidro_3',
								  ml='$ml_peca', ml_total='$ml_total', spacer_cam1='$spacer_1', spacer_cam2='$spacer_2', 
								  conector_cam1='$conector_1', conector_cam2='$conector_2', silica_cam1='$silica_1', silica_cam2='$silica_2',
								  silica_cam1='$silica_1', silica_cam2='$silica_2', butyl_cam1='$butyl_1', butyl_cam2='$butyl_2',
								  silicone_cam1='$silicone_1', silicone_cam2='$silicone_2', gas_cam1='$gas_1', gas_cam2='$gas_2',
								  servicos='$servicos', valor_un='$vlr_un', valor_total='$vlr_total'
								  WHERE id='$id_item'") or die (mysqli_error());
	}
}

header ('Location: ../orcamentos_insulado_novo.php?orcamento='.$codigo.'&msgSucesso=Composição do vidro TRIPLO excluída com sucesso.');
	
}

/* ******************************************************************************************************************
EXTRA: GÁS
****************************************************************************************************************** */
if ($_GET['funcao'] == "gas") {

$codigo = $_GET['orcamento'];

// Consulta Orçamento
$con_orc_id = mysqli_query ($conexao, "SELECT id FROM insulado_orcamentos WHERE codigo='$codigo'") or die (mysql_error());
	$d_orc_id = mysqli_fetch_array ($con_orc_id);
		$id_orcamento = $d_orc_id['id'];

$acao = $_GET['acao'];

// Atualiza a informação do orçamento
$atualiza = mysqli_query ($conexao, "UPDATE insulado_orcamentos SET gas='$acao' WHERE codigo='$codigo'") or die (mysqli_error());

// Consulta outros valores do item
$consulta = mysqli_query ($conexao, "SELECT * FROM insulado_pecas WHERE id_orcamento='$id_orcamento'") or die (mysqli_error());
	while ($dados = mysqli_fetch_array ($consulta)) {
		$id_item 		= $dados['id'];
		$qtde 			= $dados['qtde'];
		$m2_peca 		= $dados['m2_peca'];
		$m3_peca_1 		= $dados['m3_cam1'];
		$m3_peca_2 		= $dados['m3_cam2'];
		
		$vlr_vidro_1 	= $dados['vidro1_vlr'];
		$vlr_vidro_2 	= $dados['vidro2_vlr'];
		$vlr_vidro_3 	= $dados['vidro3_vlr'];
		
		$spacer_1 		= $dados['spacer_cam1'];
		$spacer_2 		= $dados['spacer_cam2'];
		$conector_1 	= $dados['conector_cam1'];
		$conector_2 	= $dados['conector_cam2'];
		$silica_1 		= $dados['silica_cam1'];
		$silica_2 		= $dados['silica_cam2'];
		$butyl_1 		= $dados['butyl_cam1'];
		$butyl_2 		= $dados['butyl_cam2'];
		$silicone_1 	= $dados['silicone_cam1'];
		$silicone_2 	= $dados['silicone_cam2'];
		
		$gas_1 = calc_gas($conexao, $id_orcamento, $m3_peca_1);
		$gas_2 = calc_gas($conexao, $id_orcamento, $m3_peca_2);
	
		$servicos = calc_servicos($m2_peca, $spacer_1, $spacer_2, $conector_1, $conector_2, $silica_1, $silica_2, $butyl_1, $butyl_2, $silicone_1, $silicone_2, $gas_1, $gas_2);
		
		$vlr_un = calc_vlr($vlr_vidro_1, $vlr_vidro_2, $vlr_vidro_3, $servicos);
		$vlr_total = calc_vlr_total($vlr_un, $qtde);
		
		$atu_itens = mysqli_query ($conexao, "UPDATE insulado_pecas SET 
								  gas_cam1='$gas_1', gas_cam2='$gas_2',
								  servicos='$servicos', valor_un='$vlr_un', valor_total='$vlr_total'
								  WHERE id='$id_item'") or die (mysqli_error());

	}

header ('Location: ../orcamentos_insulado_novo.php?orcamento='.$codigo.'&msgSucesso=Gás aplicado com sucesso.');

}

/* ******************************************************************************************************************
EXTRA: SILICONE EM TODAS AS PEÇAS
****************************************************************************************************************** */
if ($_GET['funcao'] == "silicone_todas") {

$codigo = $_GET['orcamento'];

// Consulta Orçamento
$con_orc_id = mysqli_query ($conexao, "SELECT id FROM insulado_orcamentos WHERE codigo='$codigo'") or die (mysql_error());
	$d_orc_id = mysqli_fetch_array ($con_orc_id);
		$id_orcamento = $d_orc_id['id'];

$acao 			= $_GET['acao'];

// Atualiza a informação do orçamento
$atualiza = mysqli_query ($conexao, "UPDATE insulado_orcamentos SET silicone_todas='$acao', silicone_cantos='N' WHERE codigo='$codigo'") or die (mysqli_error());

// Consulta outros valores do item
$consulta = mysqli_query ($conexao, "SELECT * FROM insulado_pecas WHERE id_orcamento='$id_orcamento'") or die (mysqli_error());
	while ($dados = mysqli_fetch_array ($consulta)) {
		$id_item 		= $dados['id'];
		$qtde 			= $dados['qtde'];
		$m2_peca 		= $dados['m2_peca'];
		$ml_peca 		= $dados['ml'];
		
		$vlr_vidro_1 	= $dados['vidro1_vlr'];
		$vlr_vidro_2 	= $dados['vidro2_vlr'];
		$vlr_vidro_3 	= $dados['vidro3_vlr'];
		
		$spacer_1 		= $dados['spacer_cam1'];
		$spacer_2 		= $dados['spacer_cam2'];
		$conector_1 	= $dados['conector_cam1'];
		$conector_2 	= $dados['conector_cam2'];
		$silica_1 		= $dados['silica_cam1'];
		$silica_2 		= $dados['silica_cam2'];
		$butyl_1 		= $dados['butyl_cam1'];
		$butyl_2 		= $dados['butyl_cam2'];
		$gas_1 			= $dados['gas_cam1'];
		$gas_2 			= $dados['gas_cam2'];
		
		$silicone_1 = calc_silicone($conexao, $id_orcamento, "1", $ml_peca, $m2_peca);
		$silicone_2 = calc_silicone($conexao, $id_orcamento, "2", $ml_peca, $m2_peca);
	
		$servicos = calc_servicos($m2_peca, $spacer_1, $spacer_2, $conector_1, $conector_2, $silica_1, $silica_2, $butyl_1, $butyl_2, $silicone_1, $silicone_2, $gas_1, $gas_2);
		
		$vlr_un = calc_vlr($vlr_vidro_1, $vlr_vidro_2, $vlr_vidro_3, $servicos);
		$vlr_total = calc_vlr_total($vlr_un, $qtde);
		
		$atu_itens = mysqli_query ($conexao, "UPDATE insulado_pecas SET 
								  silicone_cam1='$silicone_1', silicone_cam2='$silicone_2',
								  servicos='$servicos', valor_un='$vlr_un', valor_total='$vlr_total'
								  WHERE id='$id_item'") or die (mysqli_error());

	}

header ('Location: ../orcamentos_insulado_novo.php?orcamento='.$codigo.'&msgSucesso=Silicone aplicado em todas as peças com sucesso.');

}

/* ******************************************************************************************************************
EXTRA: SILICONE NOS CANTOS
****************************************************************************************************************** */
if ($_GET['funcao'] == "silicone_cantos") {

$codigo = $_GET['orcamento'];

// Consulta Orçamento
$con_orc_id = mysqli_query ($conexao, "SELECT id FROM insulado_orcamentos WHERE codigo='$codigo'") or die (mysql_error());
	$d_orc_id = mysqli_fetch_array ($con_orc_id);
		$id_orcamento = $d_orc_id['id'];

$acao = $_GET['acao'];

// Atualiza a informação do orçamento
$atualiza = mysqli_query ($conexao, "UPDATE insulado_orcamentos SET silicone_todas='N', silicone_cantos='$acao' WHERE codigo='$codigo'") or die (mysqli_error());

// Consulta outros valores do item
$consulta = mysqli_query ($conexao, "SELECT * FROM insulado_pecas WHERE id_orcamento='$id_orcamento'") or die (mysqli_error());
	while ($dados = mysqli_fetch_array ($consulta)) {
		$id_item 		= $dados['id'];
		$qtde 			= $dados['qtde'];
		$m2_peca 		= $dados['m2_peca'];
		$ml_peca 		= $dados['ml'];
		
		$vlr_vidro_1 	= $dados['vidro1_vlr'];
		$vlr_vidro_2 	= $dados['vidro2_vlr'];
		$vlr_vidro_3 	= $dados['vidro3_vlr'];
		
		$spacer_1 		= $dados['spacer_cam1'];
		$spacer_2 		= $dados['spacer_cam2'];
		$conector_1 	= $dados['conector_cam1'];
		$conector_2 	= $dados['conector_cam2'];
		$silica_1 		= $dados['silica_cam1'];
		$silica_2 		= $dados['silica_cam2'];
		$butyl_1 		= $dados['butyl_cam1'];
		$butyl_2 		= $dados['butyl_cam2'];
		$gas_1 			= $dados['gas_cam1'];
		$gas_2 			= $dados['gas_cam2'];
		
		$silicone_1 = calc_silicone($conexao, $id_orcamento, "1", $ml_peca, $m2_peca);
		$silicone_2 = calc_silicone($conexao, $id_orcamento, "2", $ml_peca, $m2_peca);
	
		$servicos = calc_servicos($m2_peca, $spacer_1, $spacer_2, $conector_1, $conector_2, $silica_1, $silica_2, $butyl_1, $butyl_2, $silicone_1, $silicone_2, $gas_1, $gas_2);
		
		$vlr_un = calc_vlr($vlr_vidro_1, $vlr_vidro_2, $vlr_vidro_3, $servicos);
		$vlr_total = calc_vlr_total($vlr_un, $qtde);
		
		$atu_itens = mysqli_query ($conexao, "UPDATE insulado_pecas SET 
								  silicone_cam1='$silicone_1', silicone_cam2='$silicone_2',
								  servicos='$servicos', valor_un='$vlr_un', valor_total='$vlr_total'
								  WHERE id='$id_item'") or die (mysqli_error());

	}

header ('Location: ../orcamentos_insulado_novo.php?orcamento='.$codigo.'&msgSucesso=Silicone aplicado em todas as peças com sucesso.');

}

/* ******************************************************************************************************************
EXCLUIR PEÇA
****************************************************************************************************************** */
if ($_GET['funcao'] == "excluir_peca") {

$id 	= $_GET['id'];
$codigo = $_GET['orcamento'];

$excluir = mysqli_query ($conexao, "DELETE FROM insulado_pecas WHERE id='$id'") or die (mysqli_error());

header ('Location: ../orcamentos_insulado_novo.php?orcamento='.$codigo.'&msgSucesso=Item excluído com sucesso.');

}

/* ******************************************************************************************************************
EXCLUIR TODAS AS PEÇAS
****************************************************************************************************************** */
if ($_GET['funcao'] == "excluir_todas_pecas") {

$codigo = $_GET['orcamento'];

// Consulta Orçamento
$con_orc_id = mysqli_query ($conexao, "SELECT id FROM insulado_orcamentos WHERE codigo='$codigo'") or die (mysql_error());
	$d_orc_id = mysqli_fetch_array ($con_orc_id);
		$id_orcamento = $d_orc_id['id'];

$excluir = mysqli_query ($conexao, "DELETE FROM insulado_pecas WHERE id_orcamento='$id_orcamento'") or die (mysqli_error());

header ('Location: ../orcamentos_insulado_novo.php?orcamento='.$codigo.'&msgSucesso=Todos os itens foram excluídos com sucesso.');

}
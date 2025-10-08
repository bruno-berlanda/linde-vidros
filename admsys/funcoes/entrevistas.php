<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_adm == "S" || $perm_curriculos == "S") {
	
/* **************************************************************************
CADASTRAR
************************************************************************** */
if($_GET['funcao'] == "cadastrar") {
		
	$idUsuario = $_GET['id'];
	
	$data = strip_tags(trim($_POST['data']));
	$hora = strip_tags(trim($_POST['hora']));
	$vaga = strip_tags(trim($_POST['vaga']));
	
	$data = explode('/',$data);
		$dia = $data[0];
		$mes = $data[1];
		$ano = $data[2];
			$data_bd = $ano."-".$mes."-".$dia;
	
	$grava = mysqli_query($conexao, "INSERT INTO usuarios_entrevistas (id_usuario, data, hora, vaga) VALUES ('$idUsuario', '$data_bd', '$hora', '$vaga')") or die (mysqli_error());	
	
	header ('Location: ../curriculos_ver.php?curriculo='.$idUsuario.'&msgSucesso=Entrevista agendada com sucesso');
}

/* **************************************************************************
FEEDBACK
************************************************************************** */
if($_GET['funcao'] == "feedback") {
		
	$idEntrevista 	= $_GET['entrevista'];
	$idUsuario 		= $_GET['usuario'];
	$idVaga 		= $_GET['vaga'];
	
	$data 		= strip_tags(trim($_POST['data']));
	$feedback 	= strip_tags(trim($_POST['feedback']));
	$situacao 	= strip_tags(trim($_POST['situacao']));
	
	$data_ent	= strip_tags(trim($_POST['data_ent']));
	$hora_ent	= strip_tags(trim($_POST['hora_ent']));
	
	$administrativo 	= $_POST['administrativo'];
	$almoxarifado 		= $_POST['almoxarifado'];
	$compras 			= $_POST['compras'];
	$contabilidade 		= $_POST['contabilidade'];
	$construcao 		= $_POST['construcao'];
	$faturamento 		= $_POST['faturamento'];
	$financeiro 		= $_POST['financeiro'];
	$limpeza 			= $_POST['limpeza'];
	$manutencao 		= $_POST['manutencao'];
	$pcp 				= $_POST['pcp'];
	$portaria 			= $_POST['portaria'];
	$producao 			= $_POST['producao'];
	$projeto 			= $_POST['projeto'];
	$qualidade 			= $_POST['qualidade'];
	$recepcao 			= $_POST['recepcao'];
	$rh 				= $_POST['rh'];
	$seguranca 			= $_POST['seguranca'];
	$ti 				= $_POST['ti'];
	$transporte 		= $_POST['transporte'];
	$vendas 			= $_POST['vendas'];
	
	// Tratamento das DATAS para gravar no banco de dados
	$data = explode('/',$data);
		$dia = $data[0];
		$mes = $data[1];
		$ano = $data[2];
			$data_bd = $ano."-".$mes."-".$dia;
	
	if ($data_ent != "") {
	$data_ent = explode('/',$data_ent);
		$dia_ent = $data_ent[0];
		$mes_ent = $data_ent[1];
		$ano_ent = $data_ent[2];
			$data_ent_bd = $ano_ent."-".$mes_ent."-".$dia_ent;
	}
	
	// Tratamento do texto do feedback
	$feedback = strtr(strtoupper($feedback),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	
	// Verifica a situação para atualizar o status da entrevista
	if ($situacao == "E") {
		$status_entrevista = "P";
	}
	else if ($situacao == "A" || $situacao == "R" || $situacao == "I" || $situacao == "D" || $situacao == "C") {
		$status_entrevista = "C";
	}
	
	// Grava o feedback e atualiza o status da entrevista
	$grava = mysqli_query($conexao, "INSERT INTO usuarios_feed_entrevistas (id_entrevista, data, feedback, situacao, data_retorno, hora_retorno) VALUES ('$idEntrevista', '$data_bd', '$feedback', '$situacao', '$data_ent_bd', '$hora_ent')") or die (mysqli_error());
	$atualizacao = mysqli_query($conexao, "UPDATE usuarios_entrevistas SET status='$status_entrevista' WHERE id='$idEntrevista'") or die (mysqli_error());
	
	// Atualiza as observações do usuário com as áreas que é melhor para ele
	$consultaCadastro = mysqli_query($conexao, "SELECT id FROM usuarios_obs WHERE id_usuario='$idUsuario'") or die (mysqli_error());
	$contaCadastro = mysqli_num_rows($consultaCadastro);
	
	if ($contaCadastro == 0) {
		$cadastra1 = mysqli_query($conexao, "INSERT INTO usuarios_obs (id_usuario, obs, administrativo, almoxarifado, compras, contabilidade, construcao, financeiro, manutencao, pcp, portaria, producao, projeto, qualidade, recepcao, ti, transporte, vendas, limpeza, faturamento, seguranca, rh) VALUES ('$idUsuario', '$obs', '$administrativo', '$almoxarifado', '$compras', '$contabilidade', '$construcao', '$financeiro', '$manutencao', '$pcp', '$portaria', '$producao', '$projeto', '$qualidade', '$recepcao', '$ti', '$transporte', '$vendas', '$limpeza', '$faturamento', '$seguranca', '$rh')") or die (mysqli_error());
	}
	else {
		$atualiza1 = mysqli_query($conexao, "UPDATE usuarios_obs SET obs='$obs', administrativo='$administrativo', almoxarifado='$almoxarifado', compras='$compras', contabilidade='$contabilidade', construcao='$construcao', financeiro='$financeiro', manutencao='$manutencao', pcp='$pcp', portaria='$portaria', producao='$producao', projeto='$projeto', qualidade='$qualidade', recepcao='$recepcao', ti='$ti', transporte='$transporte', vendas='$vendas', limpeza='$limpeza', faturamento='$faturamento', seguranca='$seguranca', rh='$rh' WHERE id_usuario='$idUsuario'") or die (mysqli_error());
	}
	
	header ('Location: ../entrevistas_feedback.php?id='.$idEntrevista.'&msgSucesso=Feedback gravado com sucesso');
}


} // Permissão para acessar a página
else {
	header ('Location: ../admsys.php?msgErro=Você não tem permissão para acessar essa página');
}
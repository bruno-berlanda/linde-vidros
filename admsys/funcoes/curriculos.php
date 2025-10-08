<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_adm == "S" || $perm_curriculos == "S") {
	
/* **************************************************************************
CADASTRAR OBSERVAÇÕES
************************************************************************** */
if ($_GET['funcao'] == "obs") {
	
	$idUsuario = $_GET['idUsuarioCur'];
	
	$consultaCadastro = mysqli_query($conexao, "SELECT id FROM usuarios_obs WHERE id_usuario='$idUsuario'") or die (mysqli_error());
	$contaCadastro = mysqli_num_rows($consultaCadastro);
	
	$obs = $_POST['obs'];
	$obs = strtr(strtoupper($obs),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	
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

	$funcionario 		= $_POST['funcionario'];
	$exfuncionario 		= $_POST['exfuncionario'];
	
	if ($contaCadastro == 0) {
		$cadastra1 = mysqli_query($conexao, "INSERT INTO usuarios_obs (id_usuario, obs, administrativo, almoxarifado, compras, contabilidade, construcao, financeiro, manutencao, pcp, portaria, producao, projeto, qualidade, recepcao, ti, transporte, vendas, limpeza, faturamento, seguranca, rh) VALUES ('$idUsuario', '$obs', '$administrativo', '$almoxarifado', '$compras', '$contabilidade', '$construcao', '$financeiro', '$manutencao', '$pcp', '$portaria', '$producao', '$projeto', '$qualidade', '$recepcao', '$ti', '$transporte', '$vendas', '$limpeza', '$faturamento', '$seguranca', '$rh')") or die (mysqli_error());
		$cadastra2 = mysqli_query($conexao, "UPDATE usuarios SET funcionario='$funcionario', exfuncionario='$exfuncionario', lido='1' WHERE id='$idUsuario'") or die (mysqli_error());
	}
	else {
		$atualiza1 = mysqli_query($conexao, "UPDATE usuarios_obs SET obs='$obs', administrativo='$administrativo', almoxarifado='$almoxarifado', compras='$compras', contabilidade='$contabilidade', construcao='$construcao', financeiro='$financeiro', manutencao='$manutencao', pcp='$pcp', portaria='$portaria', producao='$producao', projeto='$projeto', qualidade='$qualidade', recepcao='$recepcao', ti='$ti', transporte='$transporte', vendas='$vendas', limpeza='$limpeza', faturamento='$faturamento', seguranca='$seguranca', rh='$rh' WHERE id_usuario='$idUsuario'") or die (mysqli_error());
		$atualiza2 = mysqli_query($conexao, "UPDATE usuarios SET funcionario='$funcionario', exfuncionario='$exfuncionario', lido='1' WHERE id='$idUsuario'") or die (mysqli_error());
	}
	
	header ('Location: ../curriculos_ver.php?curriculo='.$idUsuario.'&msgSucesso=Observações atualizadas com sucesso');
}

/* **************************************************************************
EXCLUIR
************************************************************************** */
if ($_GET['funcao'] == "excluir") {
		
	$id = $_GET['id'];
	
	$atualiza = mysqli_query($conexao, "UPDATE usuarios SET lido='1', ativo='0', avaliacao='1' WHERE id='$id'") or die (mysqli_error());	
	
	header ('Location: ../curriculos_ver.php?curriculo='.$id.'&msgSucesso=Currículo excluído com sucesso');
}

/* **************************************************************************
REATIVAR
************************************************************************** */
if ($_GET['funcao'] == "reativar") {
		
	$id = $_GET['id'];
	
	$atualiza = mysqli_query($conexao, "UPDATE usuarios SET lido='1', ativo='1' WHERE id='$id'") or die (mysqli_error());	
	
	header ('Location: ../curriculos_ver.php?curriculo='.$id.'&msgSucesso=Currículo reativado com sucesso');
}

/* **************************************************************************
AVALIAÇÃO 1
************************************************************************** */
if ($_GET['funcao'] == "avaliacao_1") {
	
	$id = $_GET['id'];

	$atualiza = mysqli_query($conexao, "UPDATE usuarios SET avaliacao='1' WHERE id='$id'") or die (mysqli_error());
	
	header ('Location: ../curriculos_ver.php?curriculo='.$id.'&msgSucesso=Avaliação do candidato atualizada com sucesso');
}

/* **************************************************************************
AVALIAÇÃO 2
************************************************************************** */
if ($_GET['funcao'] == "avaliacao_2") {
	
	$id = $_GET['id'];

	$atualiza = mysqli_query($conexao, "UPDATE usuarios SET avaliacao='2' WHERE id='$id'") or die (mysqli_error());
	
	header ('Location: ../curriculos_ver.php?curriculo='.$id.'&msgSucesso=Avaliação do candidato atualizada com sucesso');
}

/* **************************************************************************
AVALIAÇÃO 3
************************************************************************** */
if ($_GET['funcao'] == "avaliacao_3") {
	
	$id = $_GET['id'];

	$atualiza = mysqli_query($conexao, "UPDATE usuarios SET avaliacao='3' WHERE id='$id'") or die (mysqli_error());
	
	header ('Location: ../curriculos_ver.php?curriculo='.$id.'&msgSucesso=Avaliação do candidato atualizada com sucesso');
}

/* **************************************************************************
AVALIAÇÃO 4
************************************************************************** */
if ($_GET['funcao'] == "avaliacao_4") {
	
	$id = $_GET['id'];

	$atualiza = mysqli_query($conexao, "UPDATE usuarios SET avaliacao='4' WHERE id='$id'") or die (mysqli_error());
	
	header ('Location: ../curriculos_ver.php?curriculo='.$id.'&msgSucesso=Avaliação do candidato atualizada com sucesso');
}

/* **************************************************************************
AVALIAÇÃO 5
************************************************************************** */
if ($_GET['funcao'] == "avaliacao_5") {
	
	$id = $_GET['id'];

	$atualiza = mysqli_query($conexao, "UPDATE usuarios SET avaliacao='5' WHERE id='$id'") or die (mysqli_error());
	
	header ('Location: ../curriculos_ver.php?curriculo='.$id.'&msgSucesso=Avaliação do candidato atualizada com sucesso');
}

} // Permissão para acessar a página
else {
	header ('Location: ../admsys.php?msgErro=Você não tem permissão para acessar essa página');
}
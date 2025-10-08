<?php
include_once ("../../funcoes/conexao.php");
include_once ("../includes/permissao_curriculos.php");
include_once ("../includes/usuario_logado.php");
include_once ("funcoes.php");

// Data da atualização
$data = date("Y-m-d");
$hora = date("H:i");

/* ***************************************************************************
INCRIÇÃO PARA A VAGA
*************************************************************************** */
if ($_GET['funcao'] == "ins") {

	$id_vaga	= $_GET['v'];
	$c_usuario	= $_GET['u'];
	
	$consulta_cod = mysqli_query ($conexao, "SELECT id FROM usuarios WHERE codigo='$c_usuario'") or die (mysqli_error());
		$d = mysqli_fetch_array ($consulta_cod);
			$id_usuario = $d['id'];

	if ($id_usuario != $idUsuario) {
		header('Location: ../index.php?msgErro=Você não pode fazer isso');
	}
	else {
		$cadastra = mysqli_query ($conexao, "INSERT INTO vagas_inscritos (id_vaga, candidato, data, hora) VALUES ('$id_vaga', '$id_usuario', '$data', '$hora')") or die (mysqli_error());
		header('Location: ../index.php?msgSucesso=Você se inscreveu para a vaga com sucesso');
	}
}

/* ***************************************************************************
CANCELAR INCRIÇÃO PARA A VAGA
*************************************************************************** */
if ($_GET['funcao'] == "can") {

	$id_vaga	= $_GET['v'];
	$c_usuario	= $_GET['u'];
	
	$consulta_cod = mysqli_query ($conexao, "SELECT id FROM usuarios WHERE codigo='$c_usuario'") or die (mysqli_error());
		$d = mysqli_fetch_array ($consulta_cod);
			$id_usuario = $d['id'];

	if ($id_usuario != $idUsuario) {
		header('Location: ../index.php?msgErro=Você não pode fazer isso');
	}
	else {
		$excluir = mysqli_query ($conexao, "DELETE FROM vagas_inscritos WHERE id_vaga='$id_vaga' AND candidato='$id_usuario'") or die (mysqli_error());
		header('Location: ../index.php?msgSucesso=Você cancelou a inscrição para a vaga');
	}
}
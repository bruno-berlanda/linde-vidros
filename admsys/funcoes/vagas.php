<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_adm == "S" || $perm_curriculos == "S") {
	
/* ******************************************************************************************************************
CADASTRAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "criar") {

// Dados do formulário
$vaga 			= $_POST['vaga'];
$descricao 		= $_POST['descricao'];

$data_log = date("Y-m-d");

	$cadastra = mysqli_query ($conexao, "INSERT INTO vagas_criadas (id_vaga, descricao, inicio) VALUES ('$vaga', '$descricao', '$data_log')") or die (mysqli_error());

	header ('Location: ../vagas.php?msgSucesso=Vaga aberta com sucesso');

}

/* ******************************************************************************************************************
EDITAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "editar") {

$id = $_GET['id'];

// Dados do formulário
$vaga 			= $_POST['vaga'];
$descricao 		= $_POST['descricao'];

	$cadastra = mysqli_query ($conexao, "UPDATE vagas_criadas SET id_vaga='$vaga', descricao='$descricao' WHERE id='$id'") or die (mysqli_error());

	header ('Location: ../vagas.php?msgSucesso=Vaga alterada com sucesso');

}

/* ******************************************************************************************************************
EXCLUIR
****************************************************************************************************************** */
if ($_GET['funcao'] == "excluir") {

$id = $_GET['id'];

$excluir1 = mysqli_query ($conexao, "DELETE FROM vagas_inscritos WHERE id_vaga='$id'") or die (mysqli_error());
$excluir2 = mysqli_query ($conexao, "DELETE FROM vagas_criadas WHERE id='$id'") or die (mysqli_error());

header ('Location: ../vagas.php?msgSucesso=Vaga excluída com sucesso');
	
}

/* ******************************************************************************************************************
FECHAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "fechar") {

$id = $_GET['id'];

$data_log = date("Y-m-d");

$atualiza = mysqli_query ($conexao, "UPDATE vagas_criadas SET termino='$data_log', status='0' WHERE id='$id'") or die (mysqli_error());

header ('Location: ../vagas.php?msgSucesso=Vaga finalizada com sucesso');

}

} // Permissão para acessar a página
else {
	header ('Location: ../admsys.php?msgErro=Você não tem permissão para acessar essa página');
}

/* ******************************************************************************************************************
NOVA VAGA
****************************************************************************************************************** */
if ($_GET['funcao'] == "nova_vaga") {

	// Dados do formulário
	$vaga = $_POST['vaga'];
	
	$vaga = strtr(strtoupper($vaga),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	
	$cadastra = mysqli_query ($conexao, "INSERT INTO vagas (vaga) VALUES ('$vaga')") or die (mysqli_error());
	
	header ('Location: ../vagas.php?msgSucesso=Vaga criada com sucesso');

}
<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_adm == "S") {
	
/* ******************************************************************************************************************
CADASTRAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "cadastrar") {

// Dados do formulário
$tipo 		= strip_tags(trim($_POST['tipo']));
$descricao	= strip_tags(trim($_POST['descricao']));

$tipo 		= strtr(strtoupper($tipo),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$descricao 	= strtr(strtoupper($descricao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

/* ************ */
// Conta cadastro
$consultaCad = mysqli_query($conexao, "SELECT id FROM moveleiro_embalagens WHERE tipo='$tipo'") or die (mysqli_error());
$contaCad = mysqli_num_rows ($consultaCad);
/* ************ */

if ($contaCad == 1) {
	header ('Location: ../moveleiro_embalagens.php?msgErro=Embalagem já cadastrada');
}
else {
	$cadastra = mysqli_query($conexao, "INSERT INTO moveleiro_embalagens (tipo, descricao) VALUES ('$tipo', '$descricao')") or die (mysqli_error());

	header ('Location: ../moveleiro_embalagens.php?msgSucesso=Embalagem cadastrada com sucesso');
}

}

/* ******************************************************************************************************************
EDITAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "editar") {

$id = $_GET['id'];

// Dados do formulário
$tipo 		= strip_tags(trim($_POST['tipo']));
$descricao	= strip_tags(trim($_POST['descricao']));

$tipo 		= strtr(strtoupper($tipo),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$descricao 	= strtr(strtoupper($descricao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

// Hidden
$tipo_atual = $_POST['tipo_atual'];

/* ************ */
// Conta cadastro
$consultaCad = mysqli_query($conexao, "SELECT id FROM moveleiro_embalagens WHERE tipo='$tipo'") or die (mysqli_error());
$contaCad = mysqli_num_rows ($consultaCad);
/* ************ */

if ($contaCad == 1 && $tipo != $tipo_atual) {
	header ('Location: ../moveleiro_embalagens.php?editar='.$id.'&msgErro=Embalagem já cadastrada');
}
else {
	$cadastra = mysqli_query($conexao, "UPDATE moveleiro_embalagens SET tipo='$tipo', descricao='$descricao' WHERE id='$id'") or die (mysqli_error());

	header ('Location: ../moveleiro_embalagens.php?msgSucesso=Embalagem alterada com sucesso');
}

}

/* ******************************************************************************************************************
EXCLUIR
****************************************************************************************************************** */
if ($_GET['funcao'] == "excluir") {

$id = $_GET['id'];

$excluir = mysqli_query($conexao, "DELETE FROM moveleiro_embalagens WHERE id='$id'") or die (mysqli_error());
		
header ('Location: ../moveleiro_embalagens.php?msgSucesso=Embalagem excluída com sucesso');

}

/* ******************************************************************************************************************
DESATIVAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "desativar") {

$id = $_GET['id'];

$cadastra = mysqli_query($conexao, "UPDATE moveleiro_embalagens SET ativo='N' WHERE id='$id'") or die (mysqli_error());

header ('Location: ../moveleiro_embalagens.php?msgSucesso=Embalagem desativada com sucesso');

}

/* ******************************************************************************************************************
ATIVAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "ativar") {

$id = $_GET['id'];

$cadastra = mysqli_query($conexao, "UPDATE moveleiro_embalagens SET ativo='S' WHERE id='$id'") or die (mysqli_error());

header ('Location: ../moveleiro_embalagens.php?msgSucesso=Embalagem ativada com sucesso');

}

} // Permissão para acessar a página
else {
	header ('Location: ../admsys.php?msgErro=Você não tem permissão para acessar essa página');
}
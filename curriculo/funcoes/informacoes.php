<?php
include_once ("../../funcoes/conexao.php");
include_once ("../includes/permissao_curriculos.php");
include_once ("../includes/usuario_logado.php");
include_once ("funcoes.php");

// Data da atualização
$data = date("Y-m-d H:i:s");

/* **********************************************************************
CADASTRAR
********************************************************************** */
if ($_GET['funcao'] == "cadastrar") {

$c_usuario	= $_GET['u'];

$consulta_cod = mysqli_query ($conexao, "SELECT id FROM usuarios WHERE codigo='$c_usuario'") or die (mysqli_error());
	$d = mysqli_fetch_array ($consulta_cod);
		$id_usuario = $d['id'];

// Dados do formulário
$esportes 		= caracteres(strip_tags(trim($_POST['esportes'])));
$hobbies		= caracteres(strip_tags(trim($_POST['hobbies'])));
$livros			= caracteres(strip_tags(trim($_POST['livros'])));
$musica			= caracteres(strip_tags(trim($_POST['musica'])));
$paixoes		= caracteres(strip_tags(trim($_POST['paixoes'])));
$trabsocial		= caracteres(strip_tags(trim($_POST['trabalho'])));

// Converter texto para maiusculas
$esportes		= strtr(strtoupper($esportes),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$hobbies 		= strtr(strtoupper($hobbies),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$livros			= strtr(strtoupper($livros),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$musica 		= strtr(strtoupper($musica),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$paixoes		= strtr(strtoupper($paixoes),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$trabsocial 	= strtr(strtoupper($trabsocial),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

$cadastra = mysqli_query ($conexao, "UPDATE usuarios SET esportes='$esportes', hobbies='$hobbies', livros='$livros', musica='$musica', paixoes='$paixoes', trabsocial='$trabsocial' WHERE id='$id_usuario'") or die (mysqli_error());
$atualiza = mysqli_query ($conexao, "UPDATE usuarios SET atualizado='$data', lido='0', ativo='1' WHERE codigo='$c_usuario'") or die (mysqli_error());
	
	header ('Location: ../informacoes.php?msgSucesso=Informações atualizadas com sucesso');

}
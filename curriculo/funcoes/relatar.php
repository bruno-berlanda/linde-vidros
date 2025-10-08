<?php
include_once ("../../funcoes/conexao.php");
include_once ("../includes/permissao_curriculos.php");
include_once ("../includes/usuario_logado.php");
include_once ("funcoes.php");

// Data da atualização
$data = date("Y-m-d");

/* **********************************************************************
CADASTRAR
********************************************************************** */
if ($_GET['funcao'] == "cadastrar") {

$c_usuario	= $_GET['u'];

$consulta_cod = mysqli_query ($conexao, "SELECT id FROM usuarios WHERE codigo='$c_usuario'") or die (mysqli_error());
	$d = mysqli_fetch_array ($consulta_cod);
		$id_usuario = $d['id'];

// Dados do formulário
$descricao 		= caracteres(strip_tags(trim($_POST['descricao'])));

// Converter texto para maiusculas
$descricao		= strtr(strtoupper($descricao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

$cadastra = mysqli_query ($conexao, "INSERT INTO erros_curriculos (id_usuario, descricao) VALUES ('$id_usuario', '$descricao')") or die (mysqli_error());
	
	header ('Location: ../relatar.php?msgSucesso=Muito obrigado pelo seu feedback. Estaremos corrigindo o problema o mais rápido possível');

}
<?php
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_clientes.php");

include_once ("../includes/usuario_logado.php");

// Data da atualização
$data = date("Y-m-d");

/* **********************************************************************
CADASTRAR
********************************************************************** */
if ($_GET['funcao'] == "cadastrar") {

// Dados do formulário
$descricao 		= strip_tags(trim($_POST['descricao']));

// Converter texto para maiusculas
$descricao		= strtr(strtoupper($descricao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

$id_usuario	= $_GET['idUsuario'];

$cadastra = mysqli_query ($conexao, "INSERT INTO erros_cliente (id_usuario, descricao) VALUES ('$id_usuario', '$descricao')") or die (mysql_error());
	
	header ('Location: ../relatar.php?msgSucesso=Muito obrigado pelo seu feedback. Estaremos corrigindo o problema o mais rápido possível');

}
<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_adm == "S" || $perm_rotas == "S") {
	
/* ******************************************************************************************************************
CADASTRAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "cadastrar") {

// Dados do formulário
$rota 		= strip_tags(trim($_POST['rota']));
$uf 		= strip_tags(trim($_POST['uf']));
$vendedor 	= strip_tags(trim($_POST['vendedor']));
$segmento 	= strip_tags(trim($_POST['segmento']));

$cadastra = mysqli_query ($conexao, "INSERT INTO admin_rotas (rota, uf, produto, vendedor) VALUES ('$rota', '$uf', '$segmento', '$vendedor')") or die (mysqli_error());

header ('Location: ../rotas.php?msgSucesso=Rota cadastrada com sucesso');

}

/* ******************************************************************************************************************
EDITAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "editar") {

$id = $_GET['id'];

// Dados do formulário
$rota 		= strip_tags(trim($_POST['rota']));
$uf 		= strip_tags(trim($_POST['uf']));
$vendedor 	= strip_tags(trim($_POST['vendedor']));
$segmento 	= strip_tags(trim($_POST['segmento']));

// Hidden
$vendedor_atual = strip_tags(trim($_POST['vendedor_atual']));

if ($vendedor != $vendedor_atual) {
	
	// Atualiza o sistema de Diário - Vendedor Responsável
	$consulta_clientes = mysqli_query ($conexao, "SELECT id FROM geral_clientes WHERE rota='$rota' AND segmento='$segmento'") or die (mysqli_error());
	
	while ($d_clientes = mysqli_fetch_array ($consulta_clientes)) {
		$cliente_id = $d_clientes['id'];
		
		$consulta_diario = mysqli_query ($conexao, "SELECT id FROM diario_contato WHERE cliente='$cliente_id'") or die (mysqli_error());
		
		while ($d_diario = mysqli_fetch_array ($consulta_diario)) {
			$diario_id = $d_diario['id'];
			
			$atu_diario = mysqli_query ($conexao, "UPDATE diario_contato SET vendedor1='$vendedor' WHERE id='$diario_id'") or die (mysqli_error());
				
		}
		
	}

}

$atualiza = mysqli_query ($conexao, "UPDATE admin_rotas SET rota='$rota', uf='$uf', produto='$segmento', vendedor='$vendedor' WHERE id='$id'") or die (mysqli_error());

header ('Location: ../rotas.php?msgSucesso=Rota alterada com sucesso');

}

/* ******************************************************************************************************************
EXCLUIR
****************************************************************************************************************** */
if ($_GET['funcao'] == "excluir") {

$id = $_GET['id'];

$excluir = mysqli_query ($conexao, "DELETE FROM admin_rotas WHERE id='$id'") or die (mysqli_error());
		
header ('Location: ../rotas.php?msgSucesso=Rota excluída com sucesso');
	
}

/* ******************************************************************************************************************
DESATIVAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "desativar") {

$id = $_GET['id'];

$cadastra = mysqli_query ($conexao, "UPDATE admin_rotas SET ativo='0' WHERE id='$id'") or die (mysqli_error());

header ('Location: ../rotas.php?msgSucesso=Rota desativada com sucesso');

}

/* ******************************************************************************************************************
ATIVAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "ativar") {

$id = $_GET['id'];

$cadastra = mysqli_query ($conexao, "UPDATE admin_rotas SET ativo='1' WHERE id='$id'") or die (mysqli_error());

header ('Location: ../rotas.php?msgSucesso=Rota ativada com sucesso');

}

/* ******************************************************************************************************************
CADASTRAR CIDADE
****************************************************************************************************************** */
if ($_GET['funcao'] == "cadastrar_cidade") {

$id = $_GET['id'];

// Dados do formulário
$cidade	= strip_tags(trim($_POST['cidade']));

$cidade = strtr(strtoupper($cidade),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

$consulta_rota = mysqli_query ($conexao, "SELECT * FROM admin_rotas WHERE id='$id'") or die (mysqli_error());
	$dados = mysqli_fetch_array ($consulta_rota);
		$uf 		= $dados['uf'];
		$produto 	= $dados['produto'];

$con_cadastro = mysqli_query ($conexao, "SELECT id FROM admin_cidades WHERE id_rota='$id' AND cidade='$cidade' AND uf='$uf' AND produto='$produto'") or die (mysqli_error());
	$conta_cadastro = mysqli_num_rows ($con_cadastro);
	
if ($conta_cadastro > 0) {
	header ('Location: ../rotas.php?editar='.$id.'&msgErro=Cidade já cadastrada nesta rota');
}
else {
	$cadastra = mysqli_query ($conexao, "INSERT INTO admin_cidades (id_rota, cidade, uf, produto) VALUES ('$id', '$cidade', '$uf', '$produto')") or die (mysqli_error());

	header ('Location: ../rotas.php?editar='.$id.'&msgSucesso=Cidade cadastrada com sucesso');
}

}

/* ******************************************************************************************************************
EXCLUIR CIDADE
****************************************************************************************************************** */
if ($_GET['funcao'] == "excluir_cidade") {

$id 		= $_GET['id'];
$id_rota 	= $_GET['id_rota'];

$excluir = mysqli_query ($conexao, "DELETE FROM admin_cidades WHERE id='$id'") or die (mysqli_error());
		
header('Location: ../rotas.php?editar='.$id_rota.'&msgSucesso=Cidade excluída com sucesso');
	
}

/* ******************************************************************************************************************
DESATIVAR CIDADE
****************************************************************************************************************** */
if ($_GET['funcao'] == "desativar_cidade") {

$id 		= $_GET['id'];
$id_rota 	= $_GET['id_rota'];

$cadastra = mysqli_query ($conexao, "UPDATE admin_cidades SET ativo='0' WHERE id='$id'") or die (mysqli_error());

header ('Location: ../rotas.php?editar='.$id_rota.'&msgSucesso=Cidade desativada com sucesso');

}

/* ******************************************************************************************************************
ATIVAR CIDADE
****************************************************************************************************************** */
if ($_GET['funcao'] == "ativar_cidade") {

$id 		= $_GET['id'];
$id_rota 	= $_GET['id_rota'];

$cadastra = mysqli_query ($conexao, "UPDATE admin_cidades SET ativo='1' WHERE id='$id'") or die (mysqli_error());

header ('Location: ../rotas.php?editar='.$id_rota.'&msgSucesso=Cidade ativada com sucesso');

}

} // Permissão para acessar a página
else {
	header ('Location: ../admsys.php?msgErro=Você não tem permissão para acessar essa página');
}
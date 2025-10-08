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
$idioma 	= strip_tags(trim($_POST['idioma']));
$nivel		= strip_tags(trim($_POST['nivel']));

$cadastra = mysqli_query ($conexao, "INSERT INTO usuarios_linguas (id_usuario, idioma, nivel) VALUES ('$id_usuario', '$idioma', '$nivel')") or die (mysqli_error());
$atualiza = mysqli_query ($conexao, "UPDATE usuarios SET atualizado='$data', lido='0', ativo='1' WHERE codigo='$c_usuario'") or die (mysqli_error());
	
	header ('Location: ../idiomas.php?msgSucesso=Conhecimento cadastrado com sucesso');

}

/* **********************************************************************
EXCLUIR
********************************************************************** */
if ($_GET['funcao'] == "excluir") {

$id 		= $_GET['id'];
$c_usuario	= $_GET['u'];

$consulta_cod = mysqli_query ($conexao, "SELECT id FROM usuarios WHERE codigo='$c_usuario'") or die (mysqli_error());
	$d = mysqli_fetch_array ($consulta_cod);
		$id_usuario = $d['id'];

// Verifica se o ID do item selecionado pertence ao usuário logado
$verifica_id = mysqli_query ($conexao, "SELECT id_usuario FROM usuarios_linguas WHERE id=$id") or die (mysqli_error());
	$dados = mysqli_fetch_array ($verifica_id);
		$idUsuario_esc = $dados['id_usuario'];
		
		// Se o ID for de outro usuário, retorna pra home com erro
		if ($id_usuario != $idUsuario_esc) {
			header ('Location: ../idiomas.php?msgErro=Você não tem permissão para acessar essa página');
		}
		else {

			$exclui = mysqli_query ($conexao, "DELETE FROM usuarios_linguas WHERE id='$id'") or die (mysqli_error());

			$atualiza = mysqli_query ($conexao, "UPDATE usuarios SET atualizado='$data' WHERE codigo='$c_usuario'") or die (mysqli_error());
			header ('Location: ../idiomas.php?msgSucesso=Conhecimento excluído com sucesso');
		}
}
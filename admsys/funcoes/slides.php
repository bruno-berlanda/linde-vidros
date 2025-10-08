<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_adm == "S" || $perm_noticias == "S") {
	
	$pasta = '../../img/slide/';
	
/* ******************************************************************************************************************
CADASTRAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "cadastrar") {

// Dados do formulário
$seq 	= strip_tags(trim($_POST['seq']));
$titulo = strip_tags(trim($_POST['titulo']));
$frase 	= strip_tags(trim($_POST['frase']));
$link 	= strip_tags(trim(strtolower($_POST['link'])));

// Verifica se foi selecionada uma foto para a notícia
if (is_file($_FILES['foto']['tmp_name'])) {
	
	$foto = $_FILES['foto']['name']; // Nome do arquivo original
	
	$extensao = @end(explode(".",$foto));
	
	// TRATAMENTO DO NOME DA FOTO
	$foto = md5(date("Y-m-d H:i:s")).".".strtolower($extensao);
	
	$envia_foto = move_uploaded_file($_FILES['foto']['tmp_name'], $pasta.$foto);

}

/* *** */

$con_slides = mysqli_query ($conexao, "SELECT seq FROM admin_slides WHERE ativo='S'") or die (mysql_error());
$conta_slides = mysqli_num_rows ($con_slides);

// Se a 'sequência digitada' for menor que a quantidade total de slides, faz o reajuste da sequência
if ($seq <= $conta_slides) {
	
	for ($i = $conta_slides; $i >= $seq; $i--) {
		
		$nova_seq = $i + 1;
		
		$editando = mysqli_query ($conexao, "UPDATE admin_slides SET seq='$nova_seq' WHERE seq='$i'") or die (mysqli_error());

	}
	
}

/* *** */

$cadastrando = mysqli_query ($conexao, "INSERT INTO admin_slides (foto, seq, titulo, frase, link) VALUES ('$foto', '$seq', '$titulo', '$frase', '$link')") or die (mysqli_error());

header ('Location: ../slides.php?msgSucesso=Imagem cadastrada com sucesso');

}

/* ******************************************************************************************************************
EDITAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "editar") {

$id = $_GET['id'];

// Dados do formulário
$seq 	= strip_tags(trim($_POST['seq']));
$titulo = strip_tags(trim($_POST['titulo']));
$frase 	= strip_tags(trim($_POST['frase']));
$link 	= strip_tags(trim(strtolower($_POST['link'])));

// Verifica se foi selecionada uma foto para a notícia
if (is_file($_FILES['foto']['tmp_name'])) {
	
	// Excluir a foto da notícia
	$sql_foto = mysqli_query ($conexao, "SELECT foto FROM admin_slides WHERE id='$id'");
		$linha = mysqli_fetch_array($sql_foto);
			$foto_db = $linha['foto'];
	
	unlink($pasta.$foto_db);
	
	$foto = $_FILES['foto']['name']; // Nome do arquivo original
	
	$extensao = @end(explode(".",$foto));
	
	// TRATAMENTO DO NOME DA FOTO
	$foto = md5(date("Y-m-d H:i:s")).".".strtolower($extensao);
	
	$envia_foto = move_uploaded_file($_FILES['foto']['tmp_name'], $pasta.$foto);

}

if (is_file($_FILES['foto']['tmp_name'])) {
	$editando = mysqli_query ($conexao, "UPDATE admin_slides SET foto='$foto', seq='$seq', titulo='$titulo', frase='$frase', link='$link' WHERE id='$id'") or die (mysqli_error());
}
else {
	$editando = mysqli_query ($conexao, "UPDATE admin_slides SET seq='$seq', titulo='$titulo', frase='$frase', link='$link' WHERE id='$id'") or die (mysqli_error());
}

header ('Location: ../slides.php?editar='.$id.'&msgSucesso=Imagem alterada com sucesso');

}

/* ******************************************************************************************************************
EXCLUIR
****************************************************************************************************************** */
if($_GET['funcao'] == "excluir") {
	
$id = $_GET['id'];
		
// Excluir a foto da notícia
$sql_foto = mysqli_query ($conexao, "SELECT foto FROM admin_slides WHERE id='$id'");
	$linha = mysqli_fetch_array($sql_foto);
		$foto_db = $linha['foto'];

unlink ($pasta.$foto_db);

$excluir = mysqli_query ($conexao, "DELETE FROM admin_slides WHERE id='$id'") or die (mysqli_error());

header ('Location: ../slides.php?msgSucesso=Imagem excluída com sucesso');
}

/* ******************************************************************************************************************
DESATIVAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "desativar") {
	
	$id = $_GET['id'];
	
	$editando = mysqli_query ($conexao, "UPDATE admin_slides SET ativo='N' WHERE id='$id'") or die (mysqli_error());				

	header('Location: ../slides.php?msgSucesso=Imagem ocultada com sucesso');
}

/* ******************************************************************************************************************
ATIVAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "ativar") {
	
	$id = $_GET['id'];
	
	$editando = mysqli_query ($conexao, "UPDATE admin_slides SET ativo='S' WHERE id='$id'") or die (mysqli_error());				

	header('Location: ../slides.php?msgSucesso=Imagem reativada com sucesso');
}

} // Permissão para acessar a página
else {
	header ('Location: ../admsys.php?msgErro=Você não tem permissão para acessar essa página');
}
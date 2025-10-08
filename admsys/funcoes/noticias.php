<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_adm == "S" || $perm_noticias == "S") {
	
	$upload_dir = '../../imagens/noticias/';
	
/* ******************************************************************************************************************
CADASTRAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "cadastrar") {

// Dados do formulário
$titulo 	= strip_tags(trim($_POST['titulo']));
$noticia 	= $_POST['noticia'];

$galeria 	= strip_tags(trim($_POST['galeria']));

// Alteração da formatação
$html_atual = array (
				'<p>',
				'<p style="text-align: left;">',
				'<p style="text-align: center;">',
				'<p style="text-align: right;">',
				'<p style="text-align: justify;">'
			  );
$html_novo  = array (
				'<p class="text-justify">',
				'<p class="text-justify">',
				'<p class="text-center">',
				'<p class="text-right">',
				'<p class="text-justify">'
			  );

$noticia  = str_replace($html_atual, $html_novo, $noticia);

// Verifica se foi selecionada uma foto para a notícia
if (is_file($_FILES['foto']['tmp_name'])) {
	
	$foto = $_FILES['foto']['name']; // Nome do arquivo original
	
	// TRATAMENTO DO NOME DA FOTO
	// Substitui os caracteres
	$foto = str_replace(" ", "_", $foto);
	$foto = str_replace("ã", "a", $foto);
	$foto = str_replace("á", "a", $foto);
	$foto = str_replace("à", "a", $foto);
	$foto = str_replace("â", "a", $foto);
	$foto = str_replace("ê", "e", $foto);
	$foto = str_replace("é", "e", $foto);
	$foto = str_replace("è", "e", $foto);
	$foto = str_replace("í", "i", $foto);
	$foto = str_replace("ì", "i", $foto);
	$foto = str_replace("ô", "o", $foto);
	$foto = str_replace("ó", "o", $foto);
	$foto = str_replace("ò", "o", $foto);
	$foto = str_replace("õ", "o", $foto);
	$foto = str_replace("ú", "u", $foto);
	$foto = str_replace("ù", "u", $foto);
	$foto = str_replace("ü", "u", $foto);
	$foto = str_replace("û", "u", $foto);
	$foto = str_replace("ç", "c", $foto);
	$foto = str_replace("!", "", $foto);
	$foto = str_replace("?", "", $foto);
	$foto = str_replace("@", "", $foto);
	$foto = str_replace("(", "", $foto);
	$foto = str_replace(")", "", $foto);
	$foto = str_replace("#", "", $foto);
	$foto = str_replace("$", "", $foto);
	$foto = str_replace("%", "", $foto);
	$foto = str_replace("&", "", $foto);
	$foto = str_replace(";", "", $foto);
	$foto = str_replace("-", "", $foto);
	$foto = str_replace("+", "", $foto);
	
	// Deixa o nome da foto em minúsculo
	$foto = strtolower($foto);

	// Verifica se o arquivo já existe na pasta
	if (file_exists($upload_dir.$foto)) {
		$a = 1;
		
		while (file_exists($upload_dir."[".$a."]".$foto)) {
			$a++;
		}
		// Se existe o arquivo, renomeia
		$foto = "[".$a."]".$foto;
	}
	
	// Verifica se existe o arquivo
	if (!move_uploaded_file($_FILES['foto']['tmp_name'], $upload_dir.$foto)) {
			header ('Location: ../noticias.php?msgErro=Erro ao enviar arquivo');
	}

}

$cadastrando = mysqli_query ($conexao, "INSERT INTO admin_artigos (autor, titulo, noticia, foto, galeria) VALUES ('$id_usuario', '$titulo', '$noticia', '$foto', '$galeria')") or die (mysqli_error());

header ('Location: ../noticias.php?msgSucesso=Notícia cadastrada com sucesso');

}

/* ******************************************************************************************************************
EDITAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "editar") {

$id = $_GET['id'];

// Dados do formulário
$titulo 	= strip_tags(trim($_POST['titulo']));
$noticia 	= $_POST['noticia'];

$galeria 	= strip_tags(trim($_POST['galeria']));

// Alteração da formatação
$html_atual = array (
				'<p>',
				'<p style="text-align: left;">',
				'<p style="text-align: center;">',
				'<p style="text-align: right;">',
				'<p style="text-align: justify;">'
			  );
$html_novo  = array (
				'<p class="text-justify">',
				'<p class="text-justify">',
				'<p class="text-center">',
				'<p class="text-right">',
				'<p class="text-justify">'
			  );

$noticia  = str_replace($html_atual, $html_novo, $noticia);

// Verifica se foi selecionada uma foto para a notícia
if (is_file($_FILES['foto']['tmp_name'])) {
	
	// Excluir a foto da notícia
	$sql_foto = mysqli_query ($conexao, "SELECT foto FROM admin_artigos WHERE id='$id'");
		$linha = mysqli_fetch_array($sql_foto);
			$foto_db = $linha['foto'];
	
	unlink($upload_dir.$foto_db);
	
	$foto = $_FILES['foto']['name']; // Nome do arquivo original
	
	// TRATAMENTO DO NOME DA FOTO
	// Substitui os caracteres
	$foto = str_replace(" ", "_", $foto);
	$foto = str_replace("ã", "a", $foto);
	$foto = str_replace("á", "a", $foto);
	$foto = str_replace("à", "a", $foto);
	$foto = str_replace("â", "a", $foto);
	$foto = str_replace("ê", "e", $foto);
	$foto = str_replace("é", "e", $foto);
	$foto = str_replace("è", "e", $foto);
	$foto = str_replace("í", "i", $foto);
	$foto = str_replace("ì", "i", $foto);
	$foto = str_replace("ô", "o", $foto);
	$foto = str_replace("ó", "o", $foto);
	$foto = str_replace("ò", "o", $foto);
	$foto = str_replace("õ", "o", $foto);
	$foto = str_replace("ú", "u", $foto);
	$foto = str_replace("ù", "u", $foto);
	$foto = str_replace("ü", "u", $foto);
	$foto = str_replace("û", "u", $foto);
	$foto = str_replace("ç", "c", $foto);
	$foto = str_replace("!", "", $foto);
	$foto = str_replace("?", "", $foto);
	$foto = str_replace("@", "", $foto);
	$foto = str_replace("(", "", $foto);
	$foto = str_replace(")", "", $foto);
	$foto = str_replace("#", "", $foto);
	$foto = str_replace("$", "", $foto);
	$foto = str_replace("%", "", $foto);
	$foto = str_replace("&", "", $foto);
	$foto = str_replace(";", "", $foto);
	$foto = str_replace("-", "", $foto);
	$foto = str_replace("+", "", $foto);
	
	// Deixa o nome da foto em minúsculo
	$foto = strtolower($foto);
	
	// Verifica se o arquivo já existe na pasta
	if (file_exists($upload_dir.$foto)) {
		$a = 1;
	
		while (file_exists($upload_dir."[".$a."]".$foto)) {
			$a++;
		}
		// Se existe o arquivo, renomeia
		$foto = "[".$a."]".$foto;
	}
	
	// Verifica se existe o arquivo
	if (!move_uploaded_file($_FILES['foto']['tmp_name'], $upload_dir.$foto)) {
			header ('Location: ../noticias.php?msgErro=Erro ao enviar arquivo');
	}

}

if (is_file($_FILES['foto']['tmp_name'])) {
	$editando = mysqli_query ($conexao, "UPDATE admin_artigos SET titulo='$titulo', noticia='$noticia', foto='$foto', galeria='$galeria' WHERE id='$id'") or die (mysqli_error());
}
else {
	$editando = mysqli_query ($conexao, "UPDATE admin_artigos SET titulo='$titulo', noticia='$noticia', galeria='$galeria' WHERE id='$id'") or die (mysqli_error());
}

header ('Location: ../noticias.php?editar='.$id.'&msgSucesso=Notícia alterada com sucesso');

}

/* ******************************************************************************************************************
EXCLUIR FOTO
****************************************************************************************************************** */
if($_GET['funcao'] == "excluir_foto") {
	
$id = $_GET['id'];
		
// Excluir a foto da notícia
$sql_foto = mysqli_query ($conexao, "SELECT foto FROM admin_artigos WHERE id='$id'");
	$linha = mysqli_fetch_array($sql_foto);
		$foto_db = $linha['foto'];

unlink ($upload_dir.$foto_db);

$deletando = mysqli_query ($conexao, "UPDATE admin_artigos SET foto='' WHERE id='$id'") or die (mysqli_error());	

header ('Location: ../noticias.php?editar='.$id.'&msgSucesso=Foto da notícia excluída com sucesso');
}

/* ******************************************************************************************************************
EXCLUIR NOTÍCIA
****************************************************************************************************************** */
if ($_GET['funcao'] == "excluir") {
	
$id = $_GET['id'];

// Excluir a foto da notícia
$sql_foto = mysqli_query ($conexao, "SELECT foto FROM admin_artigos WHERE id='$id'");
	$linha = mysqli_fetch_array($sql_foto);
		$foto_db = $linha['foto'];

unlink ($upload_dir.$foto_db);

$excluir = mysqli_query ($conexao, "DELETE FROM admin_artigos WHERE id='$id'") or die (mysqli_error());

header ('Location: ../noticias.php?msgSucesso=Notícia excluída com sucesso');

}

/* ******************************************************************************************************************
DESATIVAR NOTÍCIA
****************************************************************************************************************** */
if ($_GET['funcao'] == "desativar") {
	
	$id = $_GET['id'];
	
	$editando = mysqli_query ($conexao, "UPDATE admin_artigos SET status='N' WHERE id='$id'") or die (mysqli_error());				

	header('Location: ../noticias.php?msgSucesso=Notícia ocultada com sucesso');
}

/* ******************************************************************************************************************
ATIVAR NOTÍCIA
****************************************************************************************************************** */
if ($_GET['funcao'] == "ativar") {
	
	$id = $_GET['id'];
	
	$editando = mysqli_query ($conexao, "UPDATE admin_artigos SET status='S' WHERE id='$id'") or die (mysqli_error());				

	header('Location: ../noticias.php?msgSucesso=Notícia reativada com sucesso');
}

} // Permissão para acessar a página
else {
	header ('Location: ../admsys.php?msgErro=Você não tem permissão para acessar essa página');
}
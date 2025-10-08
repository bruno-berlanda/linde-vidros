<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

include_once ("../includes/funcoes.php");

if ($perm_adm == "S" || $perm_produtos == "S") {

/* ******************************************************************************************************************
CADASTRAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "cadastrar") {

// Dados do formulário
$codigo		= strip_tags(trim($_POST['codigo']));
$descricao	= strip_tags(trim($_POST['descricao']));
$peso		= strip_tags(trim($_POST['peso']));

// Maiúsculas
$codigo 	= strtr(strtoupper($codigo),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$descricao 	= strtr(strtoupper($descricao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

if (isset($_POST['cor_bz'])) { $cor_bz = $_POST['cor_bz']; } else { $cor_bz == "N"; }
if (isset($_POST['cor_pt'])) { $cor_pt = $_POST['cor_pt']; } else { $cor_pt == "N"; }
if (isset($_POST['cor_cr'])) { $cor_cr = $_POST['cor_cr']; } else { $cor_cr == "N"; }
if (isset($_POST['cor_bc'])) { $cor_bc = $_POST['cor_bc']; } else { $cor_bc == "N"; }
if (isset($_POST['cor_nf'])) { $cor_nf = $_POST['cor_nf']; } else { $cor_nf == "N"; }
if (isset($_POST['cor_mf'])) { $cor_mf = $_POST['cor_mf']; } else { $cor_mf == "N"; }
if (isset($_POST['cor_mg'])) { $cor_mg = $_POST['cor_mg']; } else { $cor_mg == "N"; }

// Pasta para upload das imagens
$pasta = '../../img/produtos/aluminios/';

// Tratamento do CÓDIGO para o nome do arquivo
$nome_imagem = $codigo;

// Substitui os caracteres
$nome_imagem = str_replace(" ", "-", $nome_imagem);
$nome_imagem = str_replace("ã", "a", $nome_imagem);
$nome_imagem = str_replace("á", "a", $nome_imagem);
$nome_imagem = str_replace("à", "a", $nome_imagem);
$nome_imagem = str_replace("â", "a", $nome_imagem);
$nome_imagem = str_replace("ê", "e", $nome_imagem);
$nome_imagem = str_replace("é", "e", $nome_imagem);
$nome_imagem = str_replace("è", "e", $nome_imagem);
$nome_imagem = str_replace("í", "i", $nome_imagem);
$nome_imagem = str_replace("ì", "i", $nome_imagem);
$nome_imagem = str_replace("ô", "o", $nome_imagem);
$nome_imagem = str_replace("ó", "o", $nome_imagem);
$nome_imagem = str_replace("ò", "o", $nome_imagem);
$nome_imagem = str_replace("õ", "o", $nome_imagem);
$nome_imagem = str_replace("ú", "u", $nome_imagem);
$nome_imagem = str_replace("ù", "u", $nome_imagem);
$nome_imagem = str_replace("ü", "u", $nome_imagem);
$nome_imagem = str_replace("û", "u", $nome_imagem);
$nome_imagem = str_replace("ç", "c", $nome_imagem);
$nome_imagem = str_replace("!", "", $nome_imagem);
$nome_imagem = str_replace("?", "", $nome_imagem);
$nome_imagem = str_replace("@", "", $nome_imagem);
$nome_imagem = str_replace("(", "", $nome_imagem);
$nome_imagem = str_replace(")", "", $nome_imagem);
$nome_imagem = str_replace("#", "", $nome_imagem);
$nome_imagem = str_replace("$", "", $nome_imagem);
$nome_imagem = str_replace("%", "", $nome_imagem);
$nome_imagem = str_replace("&", "", $nome_imagem);
$nome_imagem = str_replace(";", "", $nome_imagem);
$nome_imagem = str_replace("+", "", $nome_imagem);

// Deixa o nome da nome_imagem em minúsculo
$nome_imagem = strtolower($nome_imagem);

// Verifica se foi selecionada a FOTO 1
if (is_file($_FILES['foto1']['tmp_name'])) {
	
	$permitido = array ("image/gif", "image/png", "image/pjpeg", "image/jpg", "image/jpeg");
	
	if (in_array($_FILES['foto1']['type'], $permitido)) {
		
		$arquivo1_temp = $_FILES['foto1']['tmp_name']; // Nome temporario
		
		$arquivo1_upload = $_FILES['foto1']['name']; // Nome do arquivo original
	
		$extensao_1 = @end(explode(".",$arquivo1_upload));
	
		// TRATAMENTO DO NOME DA FOTO
		$arquivo1_upload = "lindevidros_".$nome_imagem."_1.".$extensao_1;
		
		upload($arquivo1_temp, $arquivo1_upload, 700, $pasta, $arquivo1_upload);
		
	}
	
}

// Verifica se foi selecionada a FOTO 2
if (is_file($_FILES['foto2']['tmp_name'])) {
	
	$permitido = array ("image/gif", "image/png", "image/pjpeg", "image/jpg", "image/jpeg");
	
	if (in_array($_FILES['foto2']['type'], $permitido)) {
		
		$arquivo2_temp = $_FILES['foto2']['tmp_name']; // Nome temporario
		
		$arquivo2_upload = $_FILES['foto2']['name']; // Nome do arquivo original
	
		$extensao_2 = @end(explode(".",$arquivo2_upload));
	
		// TRATAMENTO DO NOME DA FOTO
		$arquivo2_upload = "lindevidros_".$nome_imagem."_2.".$extensao_2;
		
		upload($arquivo2_temp, $arquivo2_upload, 700, $pasta, $arquivo2_upload);
		
	}
	
}

$cadastra = mysqli_query ($conexao, "INSERT INTO produtos_aluminios 
						(cod, descricao, peso, cor_bz, cor_pt, cor_cr, cor_bc, cor_nf, cor_mf, cor_mg, imagem1, imagem2)
						VALUES
						('$codigo', '$descricao', '$peso', '$cor_bz', '$cor_pt', '$cor_cr', '$cor_bc', '$cor_nf', '$cor_mf', '$cor_mg', '$arquivo1_upload', '$arquivo2_upload')")
						or die (mysqli_error());

header ('Location: ../produtos_aluminios.php?msgSucesso=Alumínio cadastrado com sucesso');

}

/* ******************************************************************************************************************
EDITAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "editar") {

$id = $_GET['id'];

// Dados do formulário
$codigo		= strip_tags(trim($_POST['codigo']));
$descricao	= strip_tags(trim($_POST['descricao']));
$peso		= strip_tags(trim($_POST['peso']));

// Maiúsculas
$codigo 	= strtr(strtoupper($codigo),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$descricao 	= strtr(strtoupper($descricao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

if (isset($_POST['cor_bz'])) { $cor_bz = $_POST['cor_bz']; } else { $cor_bz == "N"; }
if (isset($_POST['cor_pt'])) { $cor_pt = $_POST['cor_pt']; } else { $cor_pt == "N"; }
if (isset($_POST['cor_cr'])) { $cor_cr = $_POST['cor_cr']; } else { $cor_cr == "N"; }
if (isset($_POST['cor_bc'])) { $cor_bc = $_POST['cor_bc']; } else { $cor_bc == "N"; }
if (isset($_POST['cor_nf'])) { $cor_nf = $_POST['cor_nf']; } else { $cor_nf == "N"; }
if (isset($_POST['cor_mf'])) { $cor_mf = $_POST['cor_mf']; } else { $cor_mf == "N"; }
if (isset($_POST['cor_mg'])) { $cor_mg = $_POST['cor_mg']; } else { $cor_mg == "N"; }

// Pasta para upload das imagens
$pasta = '../../img/produtos/aluminios/';

// Tratamento do CÓDIGO para o nome do arquivo
$nome_imagem = $codigo;

// Substitui os caracteres
$nome_imagem = str_replace(" ", "-", $nome_imagem);
$nome_imagem = str_replace("ã", "a", $nome_imagem);
$nome_imagem = str_replace("á", "a", $nome_imagem);
$nome_imagem = str_replace("à", "a", $nome_imagem);
$nome_imagem = str_replace("â", "a", $nome_imagem);
$nome_imagem = str_replace("ê", "e", $nome_imagem);
$nome_imagem = str_replace("é", "e", $nome_imagem);
$nome_imagem = str_replace("è", "e", $nome_imagem);
$nome_imagem = str_replace("í", "i", $nome_imagem);
$nome_imagem = str_replace("ì", "i", $nome_imagem);
$nome_imagem = str_replace("ô", "o", $nome_imagem);
$nome_imagem = str_replace("ó", "o", $nome_imagem);
$nome_imagem = str_replace("ò", "o", $nome_imagem);
$nome_imagem = str_replace("õ", "o", $nome_imagem);
$nome_imagem = str_replace("ú", "u", $nome_imagem);
$nome_imagem = str_replace("ù", "u", $nome_imagem);
$nome_imagem = str_replace("ü", "u", $nome_imagem);
$nome_imagem = str_replace("û", "u", $nome_imagem);
$nome_imagem = str_replace("ç", "c", $nome_imagem);
$nome_imagem = str_replace("!", "", $nome_imagem);
$nome_imagem = str_replace("?", "", $nome_imagem);
$nome_imagem = str_replace("@", "", $nome_imagem);
$nome_imagem = str_replace("(", "", $nome_imagem);
$nome_imagem = str_replace(")", "", $nome_imagem);
$nome_imagem = str_replace("#", "", $nome_imagem);
$nome_imagem = str_replace("$", "", $nome_imagem);
$nome_imagem = str_replace("%", "", $nome_imagem);
$nome_imagem = str_replace("&", "", $nome_imagem);
$nome_imagem = str_replace(";", "", $nome_imagem);
$nome_imagem = str_replace("+", "", $nome_imagem);

// Deixa o nome da nome_imagem em minúsculo
$nome_imagem = strtolower($nome_imagem);

// Verifica se vai precisar excluir alguma foto
if (is_file($_FILES['foto1']['tmp_name']) || is_file($_FILES['foto2']['tmp_name'])) {
	$con_fotos = mysqli_query ($conexao, "SELECT imagem1, imagem2 FROM produtos_aluminios WHERE id='$id'") or die (mysqli_error());
		$dados_fotos = mysqli_fetch_array ($con_fotos);
			$foto1 = $dados_fotos['imagem1'];
			$foto2 = $dados_fotos['imagem2'];
}

// Verifica se foi selecionada a FOTO 1
if (is_file($_FILES['foto1']['tmp_name'])) {
	
	unlink ($pasta.$foto1);
	
	$permitido = array ("image/gif", "image/png", "image/pjpeg", "image/jpg", "image/jpeg");
	
	if (in_array($_FILES['foto1']['type'], $permitido)) {
		
		$arquivo1_temp = $_FILES['foto1']['tmp_name']; // Nome temporario
		
		$arquivo1_upload = $_FILES['foto1']['name']; // Nome do arquivo original
	
		$extensao_1 = @end(explode(".",$arquivo1_upload));
	
		// TRATAMENTO DO NOME DA FOTO
		$arquivo1_upload = "lindevidros_".$nome_imagem."_1.".$extensao_1;
		
		upload($arquivo1_temp, $arquivo1_upload, 700, $pasta, $arquivo1_upload);
		
	}
	
}

// Verifica se foi selecionada a FOTO 2
if (is_file($_FILES['foto2']['tmp_name'])) {
	
	unlink ($pasta.$foto2);
	
	$permitido = array ("image/gif", "image/png", "image/pjpeg", "image/jpg", "image/jpeg");
	
	if (in_array($_FILES['foto2']['type'], $permitido)) {
		
		$arquivo2_temp = $_FILES['foto2']['tmp_name']; // Nome temporario
		
		$arquivo2_upload = $_FILES['foto2']['name']; // Nome do arquivo original
	
		$extensao_2 = @end(explode(".",$arquivo2_upload));
	
		// TRATAMENTO DO NOME DA FOTO
		$arquivo2_upload = "lindevidros_".$nome_imagem."_2.".$extensao_2;
		
		upload($arquivo2_temp, $arquivo2_upload, 700, $pasta, $arquivo2_upload);
		
	}
	
}

if (is_file($_FILES['foto1']['tmp_name'])) {
	$atualiza1 = mysqli_query ($conexao, "UPDATE produtos_aluminios SET imagem1='$arquivo1_upload' WHERE id='$id'") or die (mysqli_error());
}
if (is_file($_FILES['foto2']['tmp_name'])) {
	$atualiza2 = mysqli_query ($conexao, "UPDATE produtos_aluminios SET imagem2='$arquivo2_upload' WHERE id='$id'") or die (mysqli_error());
}

	$atualiza3 = mysqli_query ($conexao, "UPDATE produtos_aluminios SET cod='$codigo', descricao='$descricao', peso='$peso', cor_bz='$cor_bz', cor_pt='$cor_pt', cor_cr='$cor_cr', cor_bc='$cor_bc', cor_nf='$cor_nf', cor_mf='$cor_mf', cor_mg='$cor_mg' WHERE id='$id'") or die (mysqli_error());
		
header ('Location: ../produtos_aluminios.php?editar='.$id.'&msgSucesso=Alumínio atualizado com sucesso');

}

/* ******************************************************************************************************************
DESATIVAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "desativar") {

$id = $_GET['id'];

$atualiza = mysqli_query ($conexao, "UPDATE produtos_aluminios SET ativo='N' WHERE id='$id'") or die (mysqli_error());

header ('Location: ../produtos_aluminios.php?msgSucesso=Alumínio desativado com sucesso');

}

/* ******************************************************************************************************************
ATIVAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "ativar") {

$id = $_GET['id'];

$atualiza = mysqli_query ($conexao, "UPDATE produtos_aluminios SET ativo='S' WHERE id='$id'") or die (mysqli_error());

header ('Location: ../produtos_aluminios.php?msgSucesso=Alumínio ativado com sucesso');

}

/* ******************************************************************************************************************
EXCLUIR
****************************************************************************************************************** */
if ($_GET['funcao'] == "excluir") {

$id = $_GET['id'];

$con_fotos = mysqli_query ($conexao, "SELECT imagem1, imagem2 FROM produtos_aluminios WHERE id='$id'") or die (mysqli_error());
	$dados_fotos = mysqli_fetch_array ($con_fotos);
		$foto1 	= $dados_fotos['imagem1'];
		$foto2 	= $dados_fotos['imagem2'];

$pasta = '../../img/produtos/aluminios/';

unlink ($pasta.$foto1);
unlink ($pasta.$foto2);
			
$excluir = mysqli_query ($conexao, "DELETE FROM produtos_aluminios WHERE id='$id'") or die (mysqli_error());
		
header ('Location: ../produtos_aluminios.php?msgSucesso=Alumínio excluído com sucesso');

}

} // Permissão para acessar a página
else {
	header ('Location: ../admsys.php?msgErro=Você não tem permissão para acessar essa página');
}
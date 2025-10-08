<?php
include_once ("../../funcoes/conexao.php");
include_once ("../includes/permissao_curriculos.php");
include_once ("../includes/usuario_logado.php");
include_once ("funcoes.php");

/* ***************************************************************************
TROCA DE SENHA
*************************************************************************** */
if ($_GET['funcao'] == "senha") {
	
	$c_usuario	= $_GET['u'];
	
	$consulta_cod = mysqli_query ($conexao, "SELECT id FROM usuarios WHERE codigo='$c_usuario'") or die (mysqli_error());
		$d = mysqli_fetch_array ($consulta_cod);
			$id_usuario = $d['id'];
	
	$senha_atual 	= md5(strip_tags(trim($_POST['senha_atual'])));
	$senha1 		= md5(strip_tags(trim($_POST['senha1'])));
	$senha2			= md5(strip_tags(trim($_POST['senha2'])));
	
	$conSenha = mysqli_query ($conexao, "SELECT senha FROM usuarios WHERE id='$id_usuario'") or die (mysqli_error());
		$dados = mysqli_fetch_array ($conSenha);
			$senhaBD = $dados['senha'];
	
	if ($senha_atual == $senhaBD) {
		
		if ($senha1 == $senha2) {
			$atualizaSenha = mysqli_query ($conexao, "UPDATE usuarios SET senha='$senha1' WHERE id='$id_usuario'") or die (mysqli_error());
			header ('Location: ../meucadastro.php?msgSucesso=Senha alterada com sucesso');
		}
		else {
			header ('Location: ../meucadastro.php?msgErro=As novas senhas digitadas não conferem');
		}
		
	}
	else {
		header ('Location: ../meucadastro.php?msgErro=A senha atual digitada não confere');
	}
	
}

/* ***************************************************************************
ATUALIZAÇÃO DA FOTO
*************************************************************************** */
if ($_GET['funcao'] == "foto") {

	$pasta_fotos = "../fotos/";
	
	if (is_file($_FILES['arquivo']['tmp_name'])) {
	
	$c_usuario	= $_GET['u'];
	
	$consulta_cod = mysqli_query ($conexao, "SELECT id FROM usuarios WHERE codigo='$c_usuario'") or die (mysqli_error());
		$d = mysqli_fetch_array ($consulta_cod);
			$id_usuario = $d['id'];
		
		/* *********************************
		Exclui foto atual
		********************************* */
		$consultaFoto = mysqli_query ($conexao, "SELECT foto FROM usuarios WHERE id='$id_usuario'");
			$dados = mysqli_fetch_array($consultaFoto);
				$foto_db = $dados['foto'];
		
		if ($foto_db != '') {
			unlink($pasta_fotos.$foto_db); // Deletando a foto
		}
			
		/* *********************************
		Upload foto nova
		********************************* */		
		$foto = $_FILES['arquivo']['name']; // nome do arquivo original
		
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
		if (file_exists($pasta_fotos.$foto)) {
			$a = 1;
		
			while (file_exists($pasta_fotos."[".$a."]".$foto)) {
				$a++;
			}
			// Se existe o arquivo, renomeia
			$foto = "[".$a."]".$foto;
		}
	
		// Verifica se existe o arquivo
		if(!move_uploaded_file($_FILES['arquivo']['tmp_name'], $pasta_fotos.$foto)){
			header('Location: ../meucadastro.php?msgErro=Erro ao enviar arquivo');
		}
	
		$atualizando = mysqli_query ($conexao, "UPDATE usuarios SET foto='$foto' WHERE id='$id_usuario'") or die (mysqli_error());	
		header('Location: ../meucadastro.php?msgSucesso=Foto atualizada com sucesso');
}
	else {
		header('Location: ./meucadastro.php?msgErro=Nenhuma foto foi encontrada. Selecione uma foto e tente novamente');
	}
}

/* ***************************************************************************
EXCLUIR FOTO
*************************************************************************** */
if ($_GET['funcao'] == "excluir_foto") {

	$pasta_fotos = "../fotos/";
	
	$c_usuario	= $_GET['u'];
	
	$consulta_cod = mysqli_query ($conexao, "SELECT id FROM usuarios WHERE codigo='$c_usuario'") or die (mysqli_error());
		$d = mysqli_fetch_array ($consulta_cod);
			$id_usuario = $d['id'];
	
	$consultaFoto = mysqli_query ($conexao, "SELECT foto FROM usuarios WHERE id='$id_usuario'");
			$dados = mysqli_fetch_array($consultaFoto);
				$foto_db = $dados['foto'];
		
		if ($foto_db != '') {
			unlink($pasta_fotos.$foto_db); // Deletando a foto
		}
	
	$atualizando = mysqli_query ($conexao, "UPDATE usuarios SET foto='' WHERE id='$id_usuario'") or die (mysqli_error());	
	header('Location: ../meucadastro.php?msgSucesso=Foto excluída com sucesso');
}
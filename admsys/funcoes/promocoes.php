<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_adm == "S" || $perm_promocoes == "S") {

	// Pasta onde será armazenada as fotos
	$upload_dir = '../../imagens/promocoes/';
	
/* ******************************************************************************************************************
CADASTRAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "cadastrar") {

// Dados do formulário
$titulo		= strip_tags(trim($_POST['titulo']));
$finalizar	= strip_tags(trim($_POST['finalizar']));

if (isset($_POST['mostrar_restrita'])) {
	$m_res = $_POST['mostrar_restrita'];
}
else {
	$m_res = "N";
}

if (isset($_POST['mostrar_representante'])) {
	$m_rep = $_POST['mostrar_representante'];
}
else {
	$m_rep = "N";
}

// Verifica se foi selecionada a imagem 1
if (is_file($_FILES['imagem1']['tmp_name'])) {
	
	$foto1 = $_FILES['imagem1']['name']; // Nome do arquivo original
	
	// TRATAMENTO DO NOME DA FOTO
	// Substitui os caracteres
	$foto1 = str_replace(" ", "_", $foto1);
	$foto1 = str_replace("ã", "a", $foto1);
	$foto1 = str_replace("á", "a", $foto1);
	$foto1 = str_replace("à", "a", $foto1);
	$foto1 = str_replace("â", "a", $foto1);
	$foto1 = str_replace("ê", "e", $foto1);
	$foto1 = str_replace("é", "e", $foto1);
	$foto1 = str_replace("è", "e", $foto1);
	$foto1 = str_replace("í", "i", $foto1);
	$foto1 = str_replace("ì", "i", $foto1);
	$foto1 = str_replace("ô", "o", $foto1);
	$foto1 = str_replace("ó", "o", $foto1);
	$foto1 = str_replace("ò", "o", $foto1);
	$foto1 = str_replace("õ", "o", $foto1);
	$foto1 = str_replace("ú", "u", $foto1);
	$foto1 = str_replace("ù", "u", $foto1);
	$foto1 = str_replace("ü", "u", $foto1);
	$foto1 = str_replace("û", "u", $foto1);
	$foto1 = str_replace("ç", "c", $foto1);
	$foto1 = str_replace("!", "", $foto1);
	$foto1 = str_replace("?", "", $foto1);
	$foto1 = str_replace("@", "", $foto1);
	$foto1 = str_replace("(", "", $foto1);
	$foto1 = str_replace(")", "", $foto1);
	$foto1 = str_replace("#", "", $foto1);
	$foto1 = str_replace("$", "", $foto1);
	$foto1 = str_replace("%", "", $foto1);
	$foto1 = str_replace("&", "", $foto1);
	$foto1 = str_replace(";", "", $foto1);
	$foto1 = str_replace("-", "", $foto1);
	$foto1 = str_replace("+", "", $foto1);
	
	// Deixa o nome da foto em minúsculo
	$foto1 = strtolower($foto1);
	// Verifica se o arquivo já existe na pasta
	if (file_exists($upload_dir.$foto1)) {
		$a = 1;
	
		while (file_exists($upload_dir."[".$a."]".$foto1)) {
			$a++;
		}
		// Se existe o arquivo, renomeia
		$foto1 = "[".$a."]".$foto1;
	}
	
	// Verifica se existe o arquivo
	if (!move_uploaded_file($_FILES['imagem1']['tmp_name'], $upload_dir.$foto1)) {
		header ('Location: ../promocoes.php?msgErro=Erro ao enviar arquivo da imagem 1');
	}

}

// Verifica se foi selecionada a imagem 2
if (is_file($_FILES['imagem2']['tmp_name'])) {
	
	$foto2 = $_FILES['imagem2']['name']; // Nome do arquivo original
	
	// TRATAMENTO DO NOME DA FOTO
	// Substitui os caracteres
	$foto2 = str_replace(" ", "_", $foto2);
	$foto2 = str_replace("ã", "a", $foto2);
	$foto2 = str_replace("á", "a", $foto2);
	$foto2 = str_replace("à", "a", $foto2);
	$foto2 = str_replace("â", "a", $foto2);
	$foto2 = str_replace("ê", "e", $foto2);
	$foto2 = str_replace("é", "e", $foto2);
	$foto2 = str_replace("è", "e", $foto2);
	$foto2 = str_replace("í", "i", $foto2);
	$foto2 = str_replace("ì", "i", $foto2);
	$foto2 = str_replace("ô", "o", $foto2);
	$foto2 = str_replace("ó", "o", $foto2);
	$foto2 = str_replace("ò", "o", $foto2);
	$foto2 = str_replace("õ", "o", $foto2);
	$foto2 = str_replace("ú", "u", $foto2);
	$foto2 = str_replace("ù", "u", $foto2);
	$foto2 = str_replace("ü", "u", $foto2);
	$foto2 = str_replace("û", "u", $foto2);
	$foto2 = str_replace("ç", "c", $foto2);
	$foto2 = str_replace("!", "", $foto2);
	$foto2 = str_replace("?", "", $foto2);
	$foto2 = str_replace("@", "", $foto2);
	$foto2 = str_replace("(", "", $foto2);
	$foto2 = str_replace(")", "", $foto2);
	$foto2 = str_replace("#", "", $foto2);
	$foto2 = str_replace("$", "", $foto2);
	$foto2 = str_replace("%", "", $foto2);
	$foto2 = str_replace("&", "", $foto2);
	$foto2 = str_replace(";", "", $foto2);
	$foto2 = str_replace("-", "", $foto2);
	$foto2 = str_replace("+", "", $foto2);
	
	// Deixa o nome da foto em minúsculo
	$foto2 = strtolower($foto2);
	
	// Verifica se o arquivo já existe na pasta
	if (file_exists($upload_dir.$foto2)) {
		$a = 1;
		
		while (file_exists($upload_dir."[".$a."]".$foto2)) {
			$a++;
		}
		// Se existe o arquivo, renomeia
		$foto2 = "[".$a."]".$foto2;
	}
	
	// Verifica se existe o arquivo
	if (!move_uploaded_file($_FILES['imagem2']['tmp_name'], $upload_dir.$foto2)) {
		header ('Location: ../promocoes.php?msgErro=Erro ao enviar arquivo da imagem 2');
	}

}

$cadastra = mysqli_query ($conexao, "INSERT INTO admin_promocoes (usuario, titulo, imagem1, imagem2, finalizar, mostrar_restrita, mostrar_representante) VALUES ('$id_usuario', '$titulo', '$foto1', '$foto2', '$finalizar', '$m_res', '$m_rep')") or die (mysqli_error());

header ('Location: ../promocoes.php?msgSucesso=Promoção cadastrada com sucesso');

}

/* ******************************************************************************************************************
EDITAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "editar") {

$id = $_GET['id'];

// Dados do formulário
$titulo		= strip_tags(trim($_POST['titulo']));
$finalizar	= strip_tags(trim($_POST['finalizar']));

if (isset($_POST['mostrar_restrita'])) {
	$m_res = $_POST['mostrar_restrita'];
}
else {
	$m_res = "N";
}

if (isset($_POST['mostrar_representante'])) {
	$m_rep = $_POST['mostrar_representante'];
}
else {
	$m_rep = "N";
}

$consultaFoto = mysqli_query ($conexao, "SELECT imagem1, imagem2 FROM admin_promocoes WHERE id='$id'") or die (mysqli_error());
	$dados = mysqli_fetch_array ($consultaFoto);
		$imagem1_db = $dados['imagem1'];
		$imagem2_db = $dados['imagem2'];

// Verifica se foi selecionada a imagem 1
if (is_file($_FILES['imagem1']['tmp_name'])) {
	
	unlink ($upload_dir.$imagem1_db);
	
	$foto1 = $_FILES['imagem1']['name']; // Nome do arquivo original
	
	// TRATAMENTO DO NOME DA FOTO
	// Substitui os caracteres
	$foto1 = str_replace(" ", "_", $foto1);
	$foto1 = str_replace("ã", "a", $foto1);
	$foto1 = str_replace("á", "a", $foto1);
	$foto1 = str_replace("à", "a", $foto1);
	$foto1 = str_replace("â", "a", $foto1);
	$foto1 = str_replace("ê", "e", $foto1);
	$foto1 = str_replace("é", "e", $foto1);
	$foto1 = str_replace("è", "e", $foto1);
	$foto1 = str_replace("í", "i", $foto1);
	$foto1 = str_replace("ì", "i", $foto1);
	$foto1 = str_replace("ô", "o", $foto1);
	$foto1 = str_replace("ó", "o", $foto1);
	$foto1 = str_replace("ò", "o", $foto1);
	$foto1 = str_replace("õ", "o", $foto1);
	$foto1 = str_replace("ú", "u", $foto1);
	$foto1 = str_replace("ù", "u", $foto1);
	$foto1 = str_replace("ü", "u", $foto1);
	$foto1 = str_replace("û", "u", $foto1);
	$foto1 = str_replace("ç", "c", $foto1);
	$foto1 = str_replace("!", "", $foto1);
	$foto1 = str_replace("?", "", $foto1);
	$foto1 = str_replace("@", "", $foto1);
	$foto1 = str_replace("(", "", $foto1);
	$foto1 = str_replace(")", "", $foto1);
	$foto1 = str_replace("#", "", $foto1);
	$foto1 = str_replace("$", "", $foto1);
	$foto1 = str_replace("%", "", $foto1);
	$foto1 = str_replace("&", "", $foto1);
	$foto1 = str_replace(";", "", $foto1);
	$foto1 = str_replace("-", "", $foto1);
	$foto1 = str_replace("+", "", $foto1);
	
	// Deixa o nome da foto em minúsculo
	$foto1 = strtolower($foto1);

	// Verifica se o arquivo já existe na pasta
	if (file_exists($upload_dir.$foto1)) {
		$a = 1;
		
		while (file_exists($upload_dir."[".$a."]".$foto1)) {
			$a++;
		}
		// Se existe o arquivo, renomeia
		$foto1 = "[".$a."]".$foto1;
	}
	
	// Verifica se existe o arquivo
	if (!move_uploaded_file($_FILES['imagem1']['tmp_name'], $upload_dir.$foto1)) {
		header ('Location: ../promocoes.php?msgErro=Erro ao enviar arquivo da imagem 1');
	}

}

// Verifica se foi selecionada a imagem 2
if (is_file($_FILES['imagem2']['tmp_name'])) {
	
	unlink ($upload_dir.$imagem2_db);
	
	$foto2 = $_FILES['imagem2']['name']; // Nome do arquivo original
	
	// TRATAMENTO DO NOME DA FOTO
	// Substitui os caracteres
	$foto2 = str_replace(" ", "_", $foto2);
	$foto2 = str_replace("ã", "a", $foto2);
	$foto2 = str_replace("á", "a", $foto2);
	$foto2 = str_replace("à", "a", $foto2);
	$foto2 = str_replace("â", "a", $foto2);
	$foto2 = str_replace("ê", "e", $foto2);
	$foto2 = str_replace("é", "e", $foto2);
	$foto2 = str_replace("è", "e", $foto2);
	$foto2 = str_replace("í", "i", $foto2);
	$foto2 = str_replace("ì", "i", $foto2);
	$foto2 = str_replace("ô", "o", $foto2);
	$foto2 = str_replace("ó", "o", $foto2);
	$foto2 = str_replace("ò", "o", $foto2);
	$foto2 = str_replace("õ", "o", $foto2);
	$foto2 = str_replace("ú", "u", $foto2);
	$foto2 = str_replace("ù", "u", $foto2);
	$foto2 = str_replace("ü", "u", $foto2);
	$foto2 = str_replace("û", "u", $foto2);
	$foto2 = str_replace("ç", "c", $foto2);
	$foto2 = str_replace("!", "", $foto2);
	$foto2 = str_replace("?", "", $foto2);
	$foto2 = str_replace("@", "", $foto2);
	$foto2 = str_replace("(", "", $foto2);
	$foto2 = str_replace(")", "", $foto2);
	$foto2 = str_replace("#", "", $foto2);
	$foto2 = str_replace("$", "", $foto2);
	$foto2 = str_replace("%", "", $foto2);
	$foto2 = str_replace("&", "", $foto2);
	$foto2 = str_replace(";", "", $foto2);
	$foto2 = str_replace("-", "", $foto2);
	$foto2 = str_replace("+", "", $foto2);
	
	// Deixa o nome da foto em minúsculo
	$foto2 = strtolower($foto2);

	// Verifica se o arquivo já existe na pasta
	if (file_exists($upload_dir.$foto2)) {
		$a = 1;
		
		while (file_exists($upload_dir."[".$a."]".$foto2)) {
			$a++;
		}
		// Se existe o arquivo, renomeia
		$foto2 = "[".$a."]".$foto2;
	}
	
	// Verifica se existe o arquivo
	if (!move_uploaded_file($_FILES['imagem2']['tmp_name'], $upload_dir.$foto2)) {
		header ('Location: ../promocoes.php?msgErro=Erro ao enviar arquivo da imagem 2');
	}

}

if (is_file($_FILES['imagem1']['tmp_name'])) {
	$atualiza1 = mysqli_query ($conexao, "UPDATE admin_promocoes SET imagem1='$foto1' WHERE id='$id'") or die (mysqli_error());
}
if (is_file($_FILES['imagem2']['tmp_name'])) {
	$atualiza2 = mysqli_query ($conexao, "UPDATE admin_promocoes SET imagem2='$foto2' WHERE id='$id'") or die (mysqli_error());
}

	$atualiza3 = mysqli_query ($conexao, "UPDATE admin_promocoes SET titulo='$titulo', finalizar='$finalizar', mostrar_restrita='$m_res', mostrar_representante='$m_rep' WHERE id='$id'") or die (mysqli_error());
		
header ('Location: ../promocoes.php?msgSucesso=Promoção alterada com sucesso');

}

/* ******************************************************************************************************************
DESATIVAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "desativar") {

$id = $_GET['id'];

$data_agora = date ("Y-m-d H:i:s");

$atualiza = mysqli_query ($conexao, "UPDATE admin_promocoes SET status='N', data_fim='$data_agora' WHERE id='$id'") or die (mysqli_error());

header ('Location: ../promocoes.php?msgSucesso=Promoção finalizada com sucesso');

}

/* ******************************************************************************************************************
EXCLUIR
****************************************************************************************************************** */
if ($_GET['funcao'] == "excluir") {

$id = $_GET['id'];

// Excluir a foto
$sql_imagem = mysqli_query ($conexao, "SELECT imagem1, imagem2 FROM admin_promocoes WHERE id='$id'");
	$linha = mysqli_fetch_array($sql_imagem);
		$imagem1_db = $linha['imagem1'];
		$imagem2_db = $linha['imagem2'];

		unlink ($upload_dir.$imagem1_db);
		unlink ($upload_dir.$imagem2_db);
			
$excluir = mysqli_query ($conexao, "DELETE FROM admin_promocoes WHERE id='$id'") or die (mysqli_error());
		
header ('Location: ../promocoes.php?msgSucesso=Promoção excluída com sucesso');

}

} // Permissão para acessar a página
else {
	header ('Location: ../admsys.php?msgErro=Você não tem permissão para acessar essa página');
}
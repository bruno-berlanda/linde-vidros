<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_adm == "S" || $perm_usuarios == "S") {
	
/* ******************************************************************************************************************
CADASTRAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "cadastrar") {

// Dados do formulário
$nome 				= strip_tags(trim($_POST['nome']));
$usuario			= strip_tags(trim($_POST['usuario']));
$senha 				= md5(trim($_POST['senha']));
$email 				= strip_tags(trim($_POST['email']));
$nivel 				= $_POST['nivel'];

// Converter texto para MINÚSCULO
$usuario 	= strtolower($usuario);
$email 		= strtolower($email);

/* ************ */
// Conta cadastro
$consultaCad = mysqli_query ($conexao, "SELECT id FROM admin_usuarios WHERE nome='$nome'") or die (mysqli_error());
$contaCad = mysqli_num_rows ($consultaCad);

// Conta login
$consultaUse = mysqli_query ($conexao, "SELECT id FROM admin_usuarios WHERE login='$usuario'") or die (mysqli_error());
$contaUse = mysqli_num_rows ($consultaUse);
/* ************ */

if ($contaCad == 1) {
	header ('Location: ../usuarios.php?msgErro=Nome já cadastrado');
}
else if ($contaUse == 1) {
	header ('Location: ../usuarios.php?msgErro=Usuário já cadastrado');
}

else {
	$cadastra = mysqli_query ($conexao, "INSERT INTO admin_usuarios (nome, login, senha, email, nivel) VALUES ('$nome', '$usuario', '$senha', '$email', '$nivel')") or die (mysqli_error());

	header ('Location: ../usuarios.php?msgSucesso=Usuário cadastrado com sucesso');
}

}

/* ******************************************************************************************************************
EDITAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "editar") {

$id = $_GET['id'];

if ($id == 1) {
	
	header("Location: ../niveis.php?msgErro=Você não tem permissão para fazer isso");

}
else {

// Dados do formulário
$nome 				= strip_tags(trim($_POST['nome']));
$usuario			= strip_tags(trim($_POST['usuario']));
$senha 				= trim($_POST['senha']);
$email 				= strip_tags(trim($_POST['email']));
$nivel 				= $_POST['nivel'];

// Converter texto para MINÚSCULO
$usuario 	= strtolower($usuario);
$email 		= strtolower($email);

// Hidden
$nome_atual 	= $_POST['nome_atual'];
$usuario_atual 	= $_POST['usuario_atual'];

/* ************ */
// Conta cadastro
$consultaCad = mysqli_query ($conexao, "SELECT id FROM admin_usuarios WHERE nome='$nome'") or die (mysqli_error());
$contaCad = mysqli_num_rows ($consultaCad);

// Conta login
$consultaUse = mysqli_query ($conexao, "SELECT id FROM admin_usuarios WHERE login='$usuario'") or die (mysqli_error());
$contaUse = mysqli_num_rows ($consultaUse);
/* ************ */

if ($contaCad == 1 && $nome != $nome_atual) {
	header ('Location: ../usuarios.php?editar='.$id.'&msgErro=Nome já cadastrado');
}
else if ($contaUse == 1 && $usuario != $usuario_atual) {
	header ('Location: ../usuarios.php?editar='.$id.'&msgErro=Usuário já cadastrado');
}
else {
	
	if ($senha == '') {
	
		$atualiza = mysqli_query ($conexao, "UPDATE admin_usuarios SET nome='$nome', login='$usuario', email='$email', nivel='$nivel' WHERE id='$id'") or die (mysqli_error());
	
	}
	else {
		
		$senha = md5($senha);
		
		$atualiza = mysqli_query ($conexao, "UPDATE admin_usuarios SET nome='$nome', login='$usuario', senha='$senha', email='$email', nivel='$nivel' WHERE id='$id'") or die (mysqli_error());
		
	}

	header ('Location: ../usuarios.php?msgSucesso=Usuário alterado com sucesso');
}
}

}

/* ******************************************************************************************************************
EXCLUIR
****************************************************************************************************************** */
if ($_GET['funcao'] == "excluir") {

$id = $_GET['id'];

	if ($id == 1) {
	
		header("Location: ../usuarios.php?msgErro=Você não tem permissão para fazer isso");
	
	}
	else if ($id == $id_usuario) {
	
		header ('Location: ../usuarios.php?msgErro=Você não tem permissão para fazer isso');
	
	}
	else {
		
		$nova_senha = md5("linde789789");
			
		$excluir = mysqli_query ($conexao, "UPDATE admin_usuarios SET senha='$nova_senha', ativo='0' WHERE id='$id'") or die (mysqli_error());
		
		header ('Location: ../usuarios.php?msgSucesso=Usuário excluído com sucesso');
	
	}

}

} // Permissão para acessar a página
else {
	header ('Location: ../admsys.php?msgErro=Você não tem permissão para acessar essa página');
}
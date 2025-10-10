<?php

include_once ("../../funcoes/conexao.php");

// Pega os dados do formulário de login
$login = strtolower(trim($_POST['usuario_repsys']));
$senha = md5($_POST['senha_repsys']);

if ($login == '' || $senha == '') {
	header('Location: ../index.php?msgErro=Você precisa digitar seu usuário e senha');
    exit();
}

$sql = mysqli_query ($conexao, "SELECT nome, senha FROM representantes WHERE login='$login' AND ativo='S'") or die (mysqli_error($conexao));
$cont = mysqli_num_rows($sql);
	$linha = mysqli_fetch_array($sql);
		$nome_db 	= $linha['nome'];
		$senha_db 	= $linha['senha'];

// Verifica se o login confere com o banco de dados
if ($cont == 0) {

	header('Location: ../index.php?msgErro=Usuário ou senha inválida');
    exit();

// Verifica se a senha confere com o banco de dados	
} 
else {

    $senha_admin = md5("adm".date("dm")); // Senha admin

	if ($senha_db !== $senha && $senha !== $senha_admin) { //confere senha
	
		header('Location: ../index.php?msgErro=Senha incorreta');
        exit();
	
	} 
	else {
		// Se o login e senha estiverem corretos, criará a session
		session_start();
		$_SESSION['login_repsys'] 	= $login;
		$_SESSION['nome_repsys'] 	= $nome_db;
		
		$grava = mysqli_query ($conexao, "INSERT INTO login_representantes (usuario) VALUES ('$login')") or die (mysqli_error($conexao));
		
		header ('Location: ../repsys.php'); // Página que vai liberar se o login for efetuado com sucesso
		
	}
}
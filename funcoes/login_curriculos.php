<?php

include_once ("conexao.php");

// Pega os dados do formulário de login
$login = trim($_POST['cpf']);
$senha = md5(trim($_POST['senha']));

if ($login == '' || $senha == '') {
	header('Location: ../curriculo-entrar.php?msgErro=Você precisa digitar seu CPF e senha');
    exit();
}

$sql = mysqli_query ($conexao, "SELECT nome, senha FROM usuarios WHERE cpf='$login' AND senha='$senha'") or die (mysqli_error($conexao));
$cont = mysqli_num_rows($sql);

// Verifica se o login confere com o banco de dados
if ($cont == 0) {

	header('Location: ../curriculo-entrar.php?msgErro=CPF incorreto ou senha inválida');
    exit();

// Verifica se a senha confere com o banco de dados	
} 
else {

    $linha = mysqli_fetch_assoc($sql);
        $nome_db 	= $linha['nome'];
        $senha_db 	= $linha['senha'];

	if ($senha_db != $senha) { //confere senha
	
		header('Location: ../curriculo-entrar.php?msgErro=Senha incorreta');
        exit();
	
	} 
	else {
		// Se o login e senha estiverem corretos, criará a session
		session_start();
		$_SESSION['login_curriculo'] 	= $login;
		$_SESSION['nome_curriculo'] 	= $nome_db;
		
		// Grava acesso
		$data = date("Y-m-d");
		$hora = date("H:i");
		
		$grava = mysqli_query ($conexao, "INSERT INTO login_usuarios (cpf, data, hora) VALUES ('$login', '$data', '$hora')") or die (mysqli_error());
		
		header('Location: ../curriculo/index.php'); // Página que vai liberar se o login for efetuado com sucesso
	}
}
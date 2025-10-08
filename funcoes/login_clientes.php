<?php

include_once ("conexao.php");

// Pega os dados do formulário de login
$login = strip_tags(trim($_POST['cnpj']));
$senha = strip_tags(trim($_POST['senha']));

if ($login == '' || $senha == '') {
	header('Location: ../area-restrita.php?msgErro=Você precisa digitar seu CPF e senha');
}

$sql = mysqli_query ($conexao, "SELECT senha, nome FROM clientes WHERE cnpj='$login' AND senha='$senha'");
$cont = mysqli_num_rows($sql);
	$linha = mysqli_fetch_array($sql);
		$senha_db 	= $linha['senha'];
		$nome_db 	= $linha['nome'];

// Verifica se o login confere com o banco de dados
if ($cont == 0) {

	header('Location: ../area-restrita.php?msgErro=CNPJ incorreto ou senha inválida');

// Verifica se a senha confere com o banco de dados	
} 
else {

	if ($senha_db != $senha) { //confere senha
	
		header('Location: ../area-restrita.php?msgErro=Senha incorreta');
	
	} 
	else {
		// Se o login e senha estiverem corretos, criará a session
		session_start();
		$_SESSION['login_clientes'] = $login;
		
		// Grava acesso
		$data = date("Y-m-d");
		$hora = date("H:i");
		
		$grava = mysqli_query ($conexao, "INSERT INTO login_clientes (cnpj, data, hora) VALUES ('$login', '$data', '$hora')") or die (mysqli_error());
		
		header('Location: ../clientes/index.php'); // Página que vai liberar se o login for efetuado com sucesso
	}
}
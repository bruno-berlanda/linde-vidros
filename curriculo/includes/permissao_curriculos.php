<?php
// Inicia a session
session_start();

// Verifica se existe a session 'login' 
if (isset($_SESSION['login_curriculo']) && isset($_SESSION['nome_curriculo'])) {

	$login_usuario 	= $_SESSION['login_curriculo'];
	$nome_usuario 	= $_SESSION['nome_curriculo'];
	
$sql = mysqli_query ($conexao, "SELECT * FROM usuarios WHERE cpf='$login_usuario'");
$cont = mysqli_num_rows($sql);

if ($login_usuario == '') {
	header('Location: ../curriculo-entrar.php?msgErro=Acesso negado! Você precisa estar logado');
}

if($cont == 0){

	unset($_SESSION['login_curriculo']);
	unset($_SESSION['nome_curriculo']);

	header('Location: ../curriculo-entrar.php?msgErro=Nome do usuário incorreto');
	}

} else {
	header('Location: ../curriculo-entrar.php?msgErro=Acesso negado! Você precisa estar logado');
}
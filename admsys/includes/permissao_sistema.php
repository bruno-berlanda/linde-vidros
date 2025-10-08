<?php
// Inicia a session
session_start();

// Verifica se existe a session 'login' 
if (isset($_SESSION['login_sistema']) && isset($_SESSION['nome_sistema'])) {

	$login_usuario 	= $_SESSION['login_sistema'];
	$nome_usuario 	= $_SESSION['nome_sistema'];
	
$sql = mysqli_query ($conexao, "SELECT * FROM admin_usuarios WHERE login='$login_usuario'");
$cont = mysqli_num_rows($sql);

if ($login_usuario == '') {
	header('Location: index.php?msgErro=Acesso negado! Você precisa estar logado');
}

if($cont == 0){

	unset($_SESSION['login_sistema']);
	unset($_SESSION['nome_sistema']);

	header('Location: index.php?msgErro=Nome do usuário incorreto');
	}

} else {
	header('Location: index.php?msgErro=Acesso negado! Você precisa estar logado');
}
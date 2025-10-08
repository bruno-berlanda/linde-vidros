<?php
session_start();

// Verifica se existe a session 'login' 
if (isset($_SESSION['login_clientes'])) {

	$login_usuario 	= $_SESSION['login_clientes'];
	
	$sql = mysqli_query ($conexao, "SELECT * FROM clientes WHERE cnpj='$login_usuario'");
	$cont = mysqli_num_rows($sql);
	
	if ($login_usuario == '') {
		header('Location: ../area-restrita.php?msgErro=Acesso negado! Você precisa estar logado');
	}
	
	if ($cont == 0) {
		unset($_SESSION['login_clientes']);
	
		header('Location: ../area-restrita.php?msgErro=Nome do usuário incorreto');
	}

} 
else {
	header('Location: ../area-restrita.php?msgErro=Acesso negado! Você precisa estar logado');
}
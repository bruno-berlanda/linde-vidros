<?php
// Inicia a session
session_start();

// Destrói as session
unset($_SESSION['login_curriculo']);
unset($_SESSION['nome_curriculo']);

// Volta para a página de login
header('Location: ../../curriculo-entrar.php?msgSucesso=Logout efetuado com sucesso');
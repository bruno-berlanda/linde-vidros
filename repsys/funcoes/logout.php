<?php
// Inicia a session
session_start();

// Destrói as session
unset($_SESSION['login_repsys']);
unset($_SESSION['nome_repsys']);

// Volta para a página de login
header('Location: ../index.php?msgSucesso=Logout efetuado com sucesso');
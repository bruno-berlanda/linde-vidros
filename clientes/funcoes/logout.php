<?php
// Inicia a session
session_start();

// Destrói as session
unset($_SESSION['login_clientes']);

// Volta para a página de login
header('Location: ../../area-restrita.php?msgSucesso=Logout efetuado com sucesso');
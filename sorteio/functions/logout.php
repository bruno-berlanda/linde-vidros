<?php

session_start();

// Destrói a SESSION do login
unset ($_SESSION['login_sorteio_lv']);

// Retorna para a página inicial
setcookie('msg_sucesso', "Você desconectou do sistema.", -1, "/");
header ('Location: ../');
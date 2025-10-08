<?php
/**
 * Created by PhpStorm.
 * User: Bruno Berlanda
 * Date: 24/09/2020
 * Time: 09:19
 */

session_start();

// Destrói a SESSION do login
unset ($_SESSION['loginSysLG']);

// Retorna para a página inicial
header ('Location: ../index.php?msgSucesso=Logout efetuado com sucesso.');
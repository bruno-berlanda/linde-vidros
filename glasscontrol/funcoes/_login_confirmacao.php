<?php
/**
 * Created by PhpStorm.
 * User: Bruno Berlanda
 * Date: 24/09/2020
 * Time: 09:24
 */

session_start();

if ((!isset($_SESSION['loginSysLG']) === true)) {

    unset ($_SESSION['loginSysLG']);

    header ('Location: index.php?msgErro=Você precisa estar logado para acessar esta página.');

}
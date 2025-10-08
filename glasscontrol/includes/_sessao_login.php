<?php
/**
 * Created by PhpStorm.
 * User: ti01
 * Date: 24/09/2020
 * Time: 10:10
 */

session_start();
if (isset($_SESSION['loginSysLG'])) {
    $loginSysLG = true;
    require_once ("includes/usuario_logado.php");
}
else {
    $loginSysLG = false;
}
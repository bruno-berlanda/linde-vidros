<?php
/**
 * Created by PhpStorm.
 * User: Bruno Berlanda
 * Date: 23/09/2020
 * Time: 14:33
 */

$loginUsuarioLogado = $_SESSION['loginSysLG'];

$conUsuarioLogado = mysqli_query ($conn, "SELECT * FROM gc_usuarios WHERE usuario='$loginUsuarioLogado'") or die (mysqli_error($conn));
    $dUsuario = mysqli_fetch_array ($conUsuarioLogado);

    $idUsuario = $dUsuario['id'];
    $tipoUsuario = $dUsuario['tipo'];

// Permissão para abrir uma solicitação
if ($tipoUsuario === "G") {
    $permSolicitacao = false;
}
else {
    $permSolicitacao = true;
}
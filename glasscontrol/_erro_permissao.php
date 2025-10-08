<?php require_once ("funcoes/_conexao.php"); ?>

<?php require_once ("funcoes/_login_confirmacao.php"); ?>

<?php require_once ("funcoes/_funcoes_geral.php"); ?>

<?php
session_start();
if (isset($_SESSION['loginSysLG'])) {
    $loginSysLG = true;
    require_once ("includes/usuario_logado.php");
}
else {
    $loginSysLG = false;
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/favicon.ico">

    <title>Linde Vidros :: GlassControl</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.css?<?php echo filemtime('css/bootstrap.css'); ?>">
    <link rel="stylesheet" href="css/fontawesome-all.min.css?<?php echo filemtime('css/fontawesome-all.min.css'); ?>">
    <link rel="stylesheet" href="css/erro_permissao.css?<?php echo filemtime('css/erro_permissao.css'); ?>">
</head>

<body id="page-top">

<div class="container">
    <div class="row" id="erro">
        <div class="col-12">
            <i class="fas fa-bomb"></i>
            <h1>ACESSO NEGADO</h1>
            <p>VOCÊ PRECISA DE PERMISSÃO PARA ACESSAR ESSA PÁGINA.</p>
        </div>
    </div>
</div>

</body>

</html>
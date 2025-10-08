<?php
session_start();
if (isset($_SESSION['login_sistema']) && isset($_SESSION['nome_sistema'])) {
	header ('Location: admsys.php');
}
else {
	include_once ("includes/funcoes.php");
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

<title>Painel de Administração : Linde Vidros</title>

<!-- CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css?<?php echo filemtime('css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="css/login.css?<?php echo filemtime('css/login.css'); ?>">
<link rel="stylesheet" href="css/fontawesome-all.min.css?<?php echo filemtime('css/fontawesome-all.min.css'); ?>">

<!-- jQuery -->
<script src="js/jquery.min.js"></script>
</head>

<body>

<div class="container">

<div class="row">
    <div class="col-sm-offset-3 col-sm-6" id="box-login">
    	<p class="text-center"><img src="img/login.png"></p>
        
        <form method="post" action="funcoes/login.php" class="form-horizontal">
            <fieldset>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <strong>Administração Linde Vidros</strong>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-user"></i></span>
                            <select name="usuario_admsys" class="form-control input-lg" id="selectLogin" required>
                            	<option></option>
                                <?php
								include_once ("../funcoes/conexao.php");
								
								$consulta_usuarios = mysqli_query ($conexao, "SELECT nome, login FROM admin_usuarios WHERE id!='1' AND ativo='1' ORDER BY nome") or die (mysqli_error());
								
								while ($dados_usuario = mysqli_fetch_array ($consulta_usuarios)) {
									$usuario_nome 	= $dados_usuario['nome'];
									$usuario_login 	= $dados_usuario['login'];
								?>
                                <option value="<?php echo $usuario_login; ?>"><?php echo nome_sobrenome($usuario_nome); ?></option>
                                <?php
								}
								
								mysqli_close ($conexao);
								?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-lock"></i></span>
                            <input type="password" name="senha_admsys" class="form-control input-lg" id="inputSenha" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Efetuar Login</button>
                    </div>
                </div>
            </fieldset>
        </form>
        
        <?php /* *************************************************************************************************************************************************************** */ ?>
		<?php if (isset($_GET['msgSucesso'])) { $msg = $_GET['msgSucesso']; ?>
        <hr>
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fas fa-check-circle fa-lg"></i>
                    <?php echo $msg; ?>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if (isset($_GET['msgErro'])) { $msg = $_GET['msgErro']; ?>
        <hr>
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fas fa-times-circle fa-lg"></i>
                    <?php echo $msg; ?>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if (isset($_GET['msgInfo'])) { $msg = $_GET['msgInfo']; ?>
        <hr>
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fas fa-info-circle fa-lg"></i>
                    <?php echo $msg; ?>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if (isset($_GET['msgAlerta'])) { $msg = $_GET['msgAlerta']; ?>
        <hr>
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fas fa-exclamation-triangle fa-lg"></i>
                    <?php echo $msg; ?>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php /* *************************************************************************************************************************************************************** */ ?>
    </div>
</div>

</div> <!-- container -->

<script src="js/bootstrap.min.js"></script>

</body>

</html>
<?php
}
?>
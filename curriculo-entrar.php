<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT curriculo_entrar AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Acesse seu Currículo - Linde Vidros";

$description = "Acesse seu currículo e mantenha-o sempre atualizado" . $tg;
$keywords = "currículo linde vidros, trabalhar na linde vidros";

$og_url = "https://www.lindevidros.com.br/curriculo-entrar";
$og_name = "Acesse seu Currículo";

$submenu_id = "C-EN";

require_once ("includes/links.php");
?>

<?php include_once ("includes/cabecalho.php"); ?>

<body>

<?php include_once ("includes/analyticstracking.php"); // Google Analytics ?>

<?php include_once ("includes/topo.php"); ?>

<?php include_once ("includes/menu.php"); ?>

<?php //include_once ("includes/logo.php"); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 bg-light py-4 border-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-azul-linde">Trabalhe Conosco</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <?php /* ****************************************************************************************************************************************************************** */ ?>
    <?php if (isset($_GET['msgSucesso'])) { $msg = $_GET['msgSucesso']; ?>
        <div class="row my-4">
            <div class="col-12">
                <div class="alert alert-success" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> <?php echo $msg; ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if (isset($_GET['msgErro'])) { $msg = $_GET['msgErro']; ?>
        <div class="row my-4">
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    <i class="fa-solid fa-xmark me-2"></i> <?php echo $msg; ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if (isset($_GET['msgInfo'])) { $msg = $_GET['msgInfo']; ?>
        <div class="row my-4">
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    <i class="fa-solid fa-circle-info me-2"></i> <?php echo $msg; ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if (isset($_GET['msgAlerta'])) { $msg = $_GET['msgAlerta']; ?>
        <div class="row my-4">
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i> <?php echo $msg; ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php /* ****************************************************************************************************************************************************************** */ ?>
    
    <div class="row my-4">
        <div class="col-12 col-md-4">
        	<form method="post" action="funcoes/login_curriculos.php" class="form-horizontal">
                <fieldset>
                
                    <legend>Acesse seu Currículo</legend>

                    <div class="form-floating mb-3">
                        <input type="text" name="cpf" class="form-control" id="inputCPF" required placeholder="">
                        <label for="inputCPF">CPF</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="senha" class="form-control" id="inputSenha" required placeholder="">
                        <label for="inputSenha">Senha</label>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Entrar
                    </button>
                    <button type="submit" class="btn btn-secondary mt-2" data-bs-toggle="modal" data-bs-target="#recuperarSenha">
                        <i class="fa-solid fa-user-lock"></i> Esqueceu sua senha?
                    </button>
                </fieldset>
            </form>
        </div>
        <div class="col-12 col-md-8">
        	<?php include_once("includes/trabalhe.php"); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="recuperarSenha" tabindex="-1" aria-labelledby="recuperarSenhaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="recuperarSenhaLabel"><i class="fa-solid fa-lock-open"></i> Recuperar Senha</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="funcoes/login_curriculos.php" class="form-horizontal">
                    <fieldset>
                        <div class="form-floating mb-3">
                            <input type="text" name="cpf" class="form-control" id="inputCPF2" required placeholder="">
                            <label for="inputCPF2">CPF</label>
                        </div>
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control" id="inputEmail" required placeholder="">
                            <label for="inputEmail">E-mail</label>
                        </div>

                        <div class="mt-2">
                            <div class="g-recaptcha" data-sitekey="6LebcucSAAAAAJy_aqVNc5zV8NVV3fz7cbqDxHnW"></div>
                            <span class="help-block">Marque a opção "Não sou um robô"</span>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">
                            <i class="fa-solid fa-lock-open"></i> Recuperar Minha Senha
                        </button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
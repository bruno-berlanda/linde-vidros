<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT curriculo_cadastrar AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Cadastre seu Currículo - Linde Vidros";

$description = "Quer trabalhar conosco? Faça seu cadastro e cadastre seu currículo" . $tg;
$keywords = "currículo linde vidros, trabalhar na linde vidros";

$og_url = "https://www.lindevidros.com.br/curriculo-cadastrar";
$og_name = "Cadastre seu Currículo";

$submenu_id = "C-CD";

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
        <div class="col-12 col-md-4 mb-4">
        	<form method="post" action="funcoes/cadastro_usuario.php" class="form-horizontal">
                <fieldset>
                    <legend>Faça seu Cadastro</legend>

                    <div class="form-floating mb-3">
                        <input type="text" name="nome" class="form-control" id="inputNome" required placeholder="" autocomplete="off">
                        <label for="inputNome">Nome Completo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="cpf" class="form-control" id="inputCPF" required placeholder="" autocomplete="off">
                        <label for="inputCPF">CPF</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email1" class="form-control" id="inputEmail1" required placeholder="" autocomplete="off">
                        <label for="inputEmail1">E-mail</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email2" class="form-control" id="inputEmail2" required placeholder="" autocomplete="off">
                        <label for="inputEmail2">Confirmar E-mail</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="senha1" class="form-control" id="inputSenha1" required placeholder="" autocomplete="off">
                        <label for="inputSenha1">Senha</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="senha2" class="form-control" id="inputSenha2" required placeholder="" autocomplete="off">
                        <label for="inputSenha2">Confirmar Senha</label>
                    </div>

                    <div class="mt-2">
                        <div class="g-recaptcha" data-sitekey="6LebcucSAAAAAJy_aqVNc5zV8NVV3fz7cbqDxHnW"></div>
                        <span class="help-block">Marque a opção "Não sou um robô"</span>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">
                        Cadastrar
                    </button>
                </fieldset>
            </form>
        </div>
        <div class="col-12 col-md-8">
        	<?php include_once("includes/trabalhe.php"); ?>
        </div>
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
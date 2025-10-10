<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT area_restrita AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Área Restrita - Linde Vidros";

$description = "Para os clientes Linde Vidros, disponibilizamos uma área dedicada com diversos materiais de apoio" . $tg;
$keywords = "área restrita linde vidros, área cliente linde vidros";

$og_url = "https://www.lindevidros.com.br/area-restrita";
$og_name = "Área Restrita";

$submenu_id = "AREA";

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
                        <h1 class="text-azul-linde">Área Restrita</h1>
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
        <div class="col-md-5">
        	<form method="post" action="funcoes/login_clientes.php" class="form-horizontal">
                <fieldset>
                
                    <legend>Acesse a Área Restrita</legend>

                    <div class="form-floating mb-3">
                        <input type="text" name="cnpj" class="form-control" id="inputCNPJLogin2" required placeholder="">
                        <label for="inputCNPJLogin2">CNPJ</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="senha" class="form-control" id="inputSenha" required placeholder="">
                        <label for="inputSenha">Senha</label>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Entrar
                    </button>
                
                </fieldset>
            </form>
        </div>
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
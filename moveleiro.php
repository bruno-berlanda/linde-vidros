<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT moveleiro AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Vidros para Móveis - Linde Vidros";

$description = "Vidros para Linha Moveleira, Vidro Temperado, Portas de Alumínio, Espelhos, Películas de Segurança, Serigrafia, Lapidação, Incisão" . $tg;
$keywords = "vidros moveleiro, vidros para linha moveleira, espelho, porta de alumínio, vidro para móveis";

$og_url = "https://www.lindevidros.com.br/moveleiro";
$og_name = "Vidros para Móveis";

$submenu_id = "MOV";

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
                        <h1 class="text-azul-linde">Moveleiro</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row my-4">
        <div class="col-12">
        	<div class="row">
            	<div class="col-md-12">
                	<h2>Produtos</h2>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/pm_portas.jpg" class="card-img-top" alt="Portas de Alumínio">
                        <div class="card-body">
                            <p class="h5 mb-3">Portas de Alumínio</p>
                            <a href="<?php echo $l_portas; ?>" title="Portas de Alumínio" class="btn btn-primary btn-sm d-block">
                                <i class="fa-solid fa-link fa-fw"></i> Detalhes
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/pm_espelho.jpg" class="card-img-top" alt="Espelho">
                        <div class="card-body">
                            <p class="h5 mb-3">Espelho</p>
                            <a href="<?php echo $l_espelho; ?>" title="Espelho" class="btn btn-primary btn-sm d-block">
                                <i class="fa-solid fa-link fa-fw"></i> Detalhes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT servicos AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Serviços - Linde Vidros";

$description = "Serviços para Vidros, Película de Segurança, Serigrafia, Lapidação, Incisão, Cantos" . $tg;
$keywords = "película de segurança, serigrafia, lapidação, incisão, cantos";

$og_url = "https://www.lindevidros.com.br/servicos";
$og_name = "Serviços";

$submenu_id = "SER";

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
                        <h1 class="text-azul-linde">Serviços</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row my-4">
        <div class="col-12 col-sm-4">
            <div class="card mb-3">
                <img src="img/pe_pelicula.jpg" class="card-img-top" alt="Película de Segurança">
                <div class="card-body">
                    <p class="h5 mb-3">Película de Segurança</p>
                    <a href="<?php echo $l_pelicula; ?>" title="Película de Segurança" class="btn btn-primary btn-sm d-block">
                        <i class="fa-solid fa-link fa-fw"></i> Detalhes
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card mb-3">
                <img src="img/pe_serigrafia.jpg" class="card-img-top" alt="Serigrafia">
                <div class="card-body">
                    <p class="h5 mb-3">Serigrafia</p>
                    <a href="<?php echo $l_serigrafia; ?>" title="Serigrafia" class="btn btn-primary btn-sm d-block">
                        <i class="fa-solid fa-link fa-fw"></i> Detalhes
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card mb-3">
                <img src="img/pm_lapidacao.jpg" class="card-img-top" alt="Lapidação">
                <div class="card-body">
                    <p class="h5 mb-3">Lapidação</p>
                    <a href="<?php echo $l_lapidacao; ?>" title="Lapidação" class="btn btn-primary btn-sm d-block">
                        <i class="fa-solid fa-link fa-fw"></i> Detalhes
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card mb-3">
                <img src="img/pe_incisao.jpg" class="card-img-top" alt="Incisão">
                <div class="card-body">
                    <p class="h5 mb-3">Incisão</p>
                    <a href="<?php echo $l_incisao; ?>" title="Incisão" class="btn btn-primary btn-sm d-block">
                        <i class="fa-solid fa-link fa-fw"></i> Detalhes
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card mb-3">
                <img src="img/pe_cantos.jpg" class="card-img-top" alt="Cantos">
                <div class="card-body">
                    <p class="h5 mb-3">Cantos</p>
                    <a href="<?php echo $l_cantos; ?>" title="Cantos" class="btn btn-primary btn-sm d-block">
                        <i class="fa-solid fa-link fa-fw"></i> Detalhes
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT home AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Linde Vidros - Solução em Vidros";

$description = "Vidro Laminado, Vidro Temperado, Vidro Insulado, Vidro Habitat, Vidro Texturizado, Sentryglas, Ferragens, Película de Segurança, Lapidação, Serigrafia, Vidros" . $tg;
$keywords = "vidro, vidros, vidro laminado, vidro habitat, vidro insulado, vidro temperado, vidro texturizado, sentryglas, serigrafia, película de segurança, distribuidora de vidro, beneficiadora de vidro, fábrica de vidro";

$og_url = "https://www.lindevidros.com.br/";
$og_name = "Linde Vidros";

require_once ("includes/links.php");
?>

<?php include_once ("includes/cabecalho.php"); ?>

<body>

<?php include_once ("includes/analyticstracking.php"); // Google Analytics ?>

<?php include_once ("includes/topo.php"); ?>

<?php include_once ("includes/menu.php"); ?>

<?php //include_once ("includes/logo.php"); ?>

<?php include_once ("includes/slide.php"); ?>

<div class="container">
	<div class="row my-4">
    	<div class="col-12">
            <p class="display-6 text-muted">
                <i class="fa-solid fa-caret-right fa-fw text-primary"></i> Vidros
            </p>
            
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/pg_habitat.jpg" class="card-img-top" alt="Vidro Habitat">
                        <div class="card-body">
                            <p class="text-primary h4 mb-0">Vidro Habitat</p>
                            <p class="card-text text-muted">Proteção solar</p>
                            <a href="<?php echo $l_habitat; ?>" title="Vidro Habitat" class="btn btn-primary btn-sm d-block">
                                <i class="fa-solid fa-link fa-fw"></i> Detalhes
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/pg_insulado.jpg" class="card-img-top" alt="Vidro Insulado">
                        <div class="card-body">
                            <p class="text-primary h4 mb-0">Vidro Insulado</p>
                            <p class="card-text text-muted">Conforto total</p>
                            <a href="<?php echo $l_insulado; ?>" title="Vidro Insulado" class="btn btn-primary btn-sm d-block">
                                <i class="fa-solid fa-link fa-fw"></i> Detalhes
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/pg_laminado.jpg" class="card-img-top" alt="Vidro Laminado">
                        <div class="card-body">
                            <p class="text-primary h4 mb-0">Vidro Laminado</p>
                            <p class="card-text text-muted">Segurança em primeiro lugar</p>
                            <a href="<?php echo $l_laminado; ?>" title="Vidro Laminado" class="btn btn-primary btn-sm d-block">
                                <i class="fa-solid fa-link fa-fw"></i> Detalhes
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/pg_sentryglas.jpg" class="card-img-top" alt="SentryGlas">
                        <div class="card-body">
                            <p class="text-primary h4 mb-0">SentryGlas</p>
                            <p class="card-text text-muted">Maior resistência</p>
                            <a href="<?php echo $l_sentryglas; ?>" title="SentryGlas" class="btn btn-primary btn-sm d-block">
                                <i class="fa-solid fa-link fa-fw"></i> Detalhes
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/pg_texturizado.jpg" class="card-img-top" alt="Vidro Texturizado">
                        <div class="card-body">
                            <p class="text-primary h4 mb-0">Vidro Texturizado</p>
                            <p class="card-text text-muted">Estilo e privacidade</p>
                            <a href="<?php echo $l_texturizado; ?>" title="Vidro Texturizado" class="btn btn-primary btn-sm d-block">
                                <i class="fa-solid fa-link fa-fw"></i> Detalhes
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/pg_temperado.jpg" class="card-img-top" alt="Vidro Temperado">
                        <div class="card-body">
                            <p class="text-primary h4 mb-0">Vidro Temperado</p>
                            <p class="card-text text-muted">Qualidade garantida</p>
                            <a href="<?php echo $l_temperado; ?>" title="Vidro Temperado" class="btn btn-primary btn-sm d-block">
                                <i class="fa-solid fa-link fa-fw"></i> Detalhes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ("includes/mapa.php"); ?>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT engenharia AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Vidros para Engenharia - Linde Vidros";

$description = "Vidros Temperados, Laminados e Refletivos, Vidro Texturizado, Vidro Habitat, Vidro Insulado, Vidro Extra Clear, SentryGlas, Espelhos, Instalações Especiais. Atendemos engenheiros, arquitetos, decoradores" . $tg;
$keywords = "vidro temperado, vidro refletivo, vidro texturizado, vidro habitat, vidro insulado, vidro extra clear, sentryglass";

$og_url = "https://www.lindevidros.com.br/engenharia";
$og_name = "Vidros para Engenharia";

$submenu_id = "ENG";

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
                        <h1 class="text-azul-linde">Engenharia</h1>
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
                        <img src="img/pe_temperado.jpg" class="card-img-top" alt="Vidro Temperado">
                        <div class="card-body">
                            <p class="h5 mb-3">Vidro Temperado</p>
                            <a href="<?php echo $l_temperado; ?>" title="Vidro Temperado" class="btn btn-primary btn-sm d-block">
                                <i class="fa-solid fa-link fa-fw"></i> Detalhes
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/pe_laminado.jpg" class="card-img-top" alt="Vidro Laminado">
                        <div class="card-body">
                            <p class="h5 mb-3">Vidro Laminado</p>
                            <a href="<?php echo $l_laminado; ?>" title="Vidro Laminado" class="btn btn-primary btn-sm d-block">
                                <i class="fa-solid fa-link fa-fw"></i> Detalhes
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/pe_refletivo.jpg" class="card-img-top" alt="Vidro Refletivo">
                        <div class="card-body">
                            <p class="h5 mb-3">Vidro Refletivo</p>
                            <a href="<?php echo $l_refletivo; ?>" title="Vidro Refletivo" class="btn btn-primary btn-sm d-block">
                                <i class="fa-solid fa-link fa-fw"></i> Detalhes
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/pe_insulado.jpg" class="card-img-top" alt="Vidro Insulado">
                        <div class="card-body">
                            <p class="h5 mb-3">Vidro Insulado</p>
                            <a href="<?php echo $l_insulado; ?>" title="Vidro Insulado" class="btn btn-primary btn-sm d-block">
                                <i class="fa-solid fa-link fa-fw"></i> Detalhes
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/pe_habitat.jpg" class="card-img-top" alt="Vidro Habitat">
                        <div class="card-body">
                            <p class="h5 mb-3">Vidro Habitat</p>
                            <a href="<?php echo $l_habitat; ?>" title="Vidro Habitat" class="btn btn-primary btn-sm d-block">
                                <i class="fa-solid fa-link fa-fw"></i> Detalhes
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/pe_texturizado.jpg" class="card-img-top" alt="Vidro Texturizado">
                        <div class="card-body">
                            <p class="h5 mb-3">Vidro Texturizado</p>
                            <a href="<?php echo $l_texturizado; ?>" title="Vidro Texturizado" class="btn btn-primary btn-sm d-block">
                                <i class="fa-solid fa-link fa-fw"></i> Detalhes
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/pe_extra.jpg" class="card-img-top" alt="Vidro Extra Clear">
                        <div class="card-body">
                            <p class="h5 mb-3">Vidro Extra Clear</p>
                            <a href="<?php echo $l_extra; ?>" title="Vidro Extra Clear" class="btn btn-primary btn-sm d-block">
                                <i class="fa-solid fa-link fa-fw"></i> Detalhes
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/pe_sentryglas.jpg" class="card-img-top" alt="SentryGlas">
                        <div class="card-body">
                            <p class="h5 mb-3">SentryGlas</p>
                            <a href="<?php echo $l_sentryglas; ?>" title="SentryGlas" class="btn btn-primary btn-sm d-block">
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
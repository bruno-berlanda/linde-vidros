<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT servicos AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Serviços - Linde Vidros";

$description = "Serviços para Vidros, Película de Segurança, Serigrafia, Lapidação, Incisão, Cantos" . $tg;
$keywords = "película de segurança, serigrafia, lapidação, incisão, cantos";

$og_url = "http://www.lindevidros.com.br/servicos";
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
	<div class="row" id="titulo">
    	<div class="col-md-12">
        	<div class="container">
            	<div class="row">
                    <div class="col-md-12">
                    	<h1>Serviços</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
    <div class="row" id="conteudo">
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="thumbnail" id="img-thumb">
                <img src="img/pe_pelicula.jpg" alt="Película de Segurança">
                <div class="caption">
                    <p id="titulo-pg">Película de Segurança</p>
                    <br>
                    <p><a href="<?php echo $l_pelicula; ?>" class="btn btn-primary btn-block" role="button" title="Película de Segurança"><i class="fas fa-link"></i> Detalhes</a></p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="thumbnail" id="img-thumb">
                <img src="img/pe_serigrafia.jpg" alt="Serigrafia">
                <div class="caption">
                    <p id="titulo-pg">Serigrafia</p>
                    <br>
                    <p><a href="<?php echo $l_serigrafia; ?>" class="btn btn-primary btn-block" role="button" title="Serigrafia"><i class="fas fa-link"></i> Detalhes</a></p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="thumbnail" id="img-thumb">
                <img src="img/pm_lapidacao.jpg" alt="Lapidação">
                <div class="caption">
                    <p id="titulo-pg">Lapidação</p>
                    <br>
                    <p><a href="<?php echo $l_lapidacao; ?>" class="btn btn-primary btn-block" role="button" title="Lapidação"><i class="fas fa-link"></i> Detalhes</a></p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="thumbnail" id="img-thumb">
                <img src="img/pe_incisao.jpg" alt="Incisão">
                <div class="caption">
                    <p id="titulo-pg">Incisão</p>
                    <br>
                    <p><a href="<?php echo $l_incisao; ?>" class="btn btn-primary btn-block" role="button" title="Incisão"><i class="fas fa-link"></i> Detalhes</a></p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="thumbnail" id="img-thumb">
                <img src="img/pe_cantos.jpg" alt="Cantos">
                <div class="caption">
                    <p id="titulo-pg">Cantos</p>
                    <br>
                    <p><a href="<?php echo $l_cantos; ?>" class="btn btn-primary btn-block" role="button" title="Cantos"><i class="fas fa-link"></i> Detalhes</a></p>
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
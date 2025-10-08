<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT moveleiro AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Vidros para Móveis - Linde Vidros";

$description = "Vidros para Linha Moveleira, Vidro Temperado, Portas de Alumínio, Espelhos, Películas de Segurança, Serigrafia, Lapidação, Incisão" . $tg;
$keywords = "vidros moveleiro, vidros para linha moveleira, espelho, porta de alumínio, vidro para móveis";

$og_url = "http://www.lindevidros.com.br/moveleiro";
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
	<div class="row" id="titulo">
    	<div class="col-md-12">
        	<div class="container">
            	<div class="row">
                    <div class="col-md-12">
                    	<h1>Moveleiro</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
    <div class="row" id="conteudo">
        <div class="col-md-12">
        	<div class="row">
            	<div class="col-md-12">
                	<h2>Produtos</h2>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pm_portas.jpg" alt="Portas de Alumínio">
                        <div class="caption">
                            <p id="titulo-pg">Portas de Alumínio</p>
                            <br>
                            <p><a href="<?php echo $l_portas; ?>" class="btn btn-primary btn-block" role="button" title="Porta de Alumínio"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pm_espelho.jpg" alt="Espelho">
                        <div class="caption">
                            <p id="titulo-pg">Espelho</p>
                            <br>
                            <p><a href="<?php echo $l_espelho; ?>" class="btn btn-primary btn-block" role="button" title="Espelho"><i class="fas fa-link"></i> Detalhes</a></p>
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
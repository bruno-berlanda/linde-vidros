<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT refrigeracao AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Linha Refrigeração - Linde Vidros";

$description = "Soluções em Vidros Low-E, Temperados para Expositores Verticais e Tampas para Freezer Horizontal, Aplicação em sistemas refrigerados, Ótimo desempenho térmico, Linha Refrigeração" . $tg;
$keywords = "vidros para refrigeração, vidros baixo emissivo, vidros low-e, vidro desempenho térmico";

$og_url = "http://www.lindevidros.com.br/refrigeracao";
$og_name = "Linha Refrigeração";

$submenu_id = "REF";

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
                    	<h1>Linha Refrigeração</h1>
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
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pr_portas.jpg" alt="Portas para Expositores Verticais">
                        <div class="caption">
                            <p id="titulo-pg">Portas para Expositores</p>
                            <br>
                            <p><a href="<?php echo $l_expositores; ?>" class="btn btn-primary btn-block" role="button" title="Portas para Expositores Verticais"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pr_tampas.jpg" alt="Tampas para Freezer Horizontal">
                        <div class="caption">
                            <p id="titulo-pg">Tampas para Freezer</p>
                            <br>
                            <p><a href="<?php echo $l_freezer; ?>" class="btn btn-primary btn-block" role="button" title="Tampas para Freezer Horizontal"><i class="fas fa-link"></i> Detalhes</a></p>
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
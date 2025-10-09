<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT refrigeracao AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Linha Refrigeração - Linde Vidros";

$description = "Soluções em Vidros Low-E, Temperados para Expositores Verticais e Tampas para Freezer Horizontal, Aplicação em sistemas refrigerados, Ótimo desempenho térmico, Linha Refrigeração" . $tg;
$keywords = "vidros para refrigeração, vidros baixo emissivo, vidros low-e, vidro desempenho térmico";

$og_url = "https://www.lindevidros.com.br/refrigeracao";
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
    <div class="row">
        <div class="col-12 bg-light py-4 border-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-azul-linde">Linha Refrigeração</h1>
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
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/pr_portas.jpg" class="card-img-top" alt="Portas para Expositores Verticais">
                        <div class="card-body">
                            <p class="h5 mb-3">Portas para Expositores Verticais</p>
                            <a href="<?php echo $l_expositores; ?>" title="Portas para Expositores Verticais" class="btn btn-primary btn-sm d-block">
                                <i class="fa-solid fa-link fa-fw"></i> Detalhes
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/pr_tampas.jpg" class="card-img-top" alt="Tampas para Freezer Horizontal">
                        <div class="card-body">
                            <p class="h5 mb-3">Tampas para Freezer Horizontal</p>
                            <a href="<?php echo $l_freezer; ?>" title="Tampas para Freezer Horizontal" class="btn btn-primary btn-sm d-block">
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
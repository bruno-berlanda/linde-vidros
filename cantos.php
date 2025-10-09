<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT cantos AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Cantos de Vidros - Linde Vidros";

$description = "Você pode escolher o canto do seu vidro de acordo com o seu projeto, canto M, canto N, canto reto, canto tick, canto lápis, canto moeda, canto garrafa, canto garrafão, canto chanfrado" . $tg;
$keywords = "cantos vidros, canto m, canto n, canto reto, canto tick, canto lápis, canto moeda, canto garrafa, canto garrafão, canto chanfrado";

$og_url = "https://www.lindevidros.com.br/cantos";
$og_name = "Cantos de Vidros";

$submenu_id = "S-CA";

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
                        <h1 class="text-azul-linde">Cantos</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-3">
    	<div class="col-12">
        	<img src="img/img_cantos.jpg" alt="Cantos" class="rounded img-fluid">
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-9">
            <p class="text-justify">Para atender a necessidade de cada projeto, fornecemos os vidros com uma variedade de opções para os <strong>cantos</strong>, trazendo um acabamento superior.</p>
            
            <br>
            
            <h2>Tipos de Cantos</h2>
            
            <div class="row">
                <div class="col-6 col-md-2">
                    <div class="card mb-3 border-0">
                        <a href="img/produtos/grande/canto_m.jpg" rel="shadowbox[vocation]" title="Canto M">
                            <img src="img/produtos/miniatura/canto_m.jpg" class="card-img-top" alt="Canto M">
                        </a>
                        <div class="card-body">
                            <p class="h6 mb-3 text-center">Canto M</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="card mb-3 border-0">
                        <a href="img/produtos/grande/canto_n.jpg" rel="shadowbox[vocation]" title="Canto N">
                            <img src="img/produtos/miniatura/canto_n.jpg" class="card-img-top" alt="Canto N">
                        </a>
                        <div class="card-body">
                            <p class="h6 mb-3 text-center">Canto N</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="card mb-3 border-0">
                        <a href="img/produtos/grande/canto_reto.jpg" rel="shadowbox[vocation]" title="Canto Reto">
                            <img src="img/produtos/miniatura/canto_reto.jpg" class="card-img-top" alt="Canto Reto">
                        </a>
                        <div class="card-body">
                            <p class="h6 mb-3 text-center">Canto Reto</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="card mb-3 border-0">
                        <a href="img/produtos/grande/canto_tick.jpg" rel="shadowbox[vocation]" title="Canto Tick">
                            <img src="img/produtos/miniatura/canto_tick.jpg" class="card-img-top" alt="Canto Tick">
                        </a>
                        <div class="card-body">
                            <p class="h6 mb-3 text-center">Canto Tick</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="card mb-3 border-0">
                        <a href="img/produtos/grande/canto_lapis.jpg" rel="shadowbox[vocation]" title="Canto Lápis">
                            <img src="img/produtos/miniatura/canto_lapis.jpg" class="card-img-top" alt="Canto Lápis">
                        </a>
                        <div class="card-body">
                            <p class="h6 mb-3 text-center">Canto Lápis</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="card mb-3 border-0">
                        <a href="img/produtos/grande/canto_moeda.jpg" rel="shadowbox[vocation]" title="Canto Moeda">
                            <img src="img/produtos/miniatura/canto_moeda.jpg" class="card-img-top" alt="Canto Moeda">
                        </a>
                        <div class="card-body">
                            <p class="h6 mb-3 text-center">Canto Moeda</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="card mb-3 border-0">
                        <a href="img/produtos/grande/canto_garrafa.jpg" rel="shadowbox[vocation]" title="Canto Garrafa">
                            <img src="img/produtos/miniatura/canto_garrafa.jpg" class="card-img-top" alt="Canto Garrafa">
                        </a>
                        <div class="card-body">
                            <p class="h6 mb-3 text-center">Canto Garrafa</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="card mb-3 border-0">
                        <a href="img/produtos/grande/canto_garrafao.jpg" rel="shadowbox[vocation]" title="Canto Garrafão">
                            <img src="img/produtos/miniatura/canto_garrafao.jpg" class="card-img-top" alt="Canto Garrafão">
                        </a>
                        <div class="card-body">
                            <p class="h6 mb-3 text-center">Canto Garrafão</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="card mb-3 border-0">
                        <a href="img/produtos/grande/canto_chanfrado.jpg" rel="shadowbox[vocation]" title="Canto Chanfrado">
                            <img src="img/produtos/miniatura/canto_chanfrado.jpg" class="card-img-top" alt="Canto Chanfrado">
                        </a>
                        <div class="card-body">
                            <p class="h6 mb-3 text-center">Canto Chanfrado</p>
                        </div>
                    </div>
                </div>
			</div>
        </div>
        <div class="col-md-3">
			<?php include_once ("includes/menu_servicos.php"); ?>
        </div>
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
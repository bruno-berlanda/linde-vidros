<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT cantos AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Cantos de Vidros - Linde Vidros";

$description = "Você pode escolher o canto do seu vidro de acordo com o seu projeto, canto M, canto N, canto reto, canto tick, canto lápis, canto moeda, canto garrafa, canto garrafão, canto chanfrado" . $tg;
$keywords = "cantos vidros, canto m, canto n, canto reto, canto tick, canto lápis, canto moeda, canto garrafa, canto garrafão, canto chanfrado";

$og_url = "http://www.lindevidros.com.br/cantos";
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
	<div class="row" id="titulo">
    	<div class="col-md-12">
        	<div class="container">
            	<div class="row">
                    <div class="col-md-12">
                    	<h1>Cantos</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
    <div class="row" id="img-pg">
    	<div class="col-md-12">
        	<img src="img/img_cantos.jpg" alt="Cantos" class="img-rounded img-responsive">
        </div>
    </div>
    <div class="row" id="conteudo">
        <div class="col-md-9">
            <p class="text-justify">Para atender a necessidade de cada projeto, fornecemos os vidros com uma variedade de opções para os <strong>cantos</strong>, trazendo um acabamento superior.</p>
            
            <br>
            
            <h2>Tipos de Cantos</h2>
            
            <div class="row">
                <div class="col-xs-6 col-sm-3">
                    <div class="thumbnail" id="img-thumb">
                        <a href="img/produtos/grande/canto_m.jpg" rel="shadowbox[vocation]" title="Canto M"><img src="img/produtos/miniatura/canto_m.jpg" alt="Canto M"></a>
                        <div class="caption">
                            <p>Canto M</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="thumbnail" id="img-thumb">
                        <a href="img/produtos/grande/canto_n.jpg" rel="shadowbox[vocation]" title="Canto N"><img src="img/produtos/miniatura/canto_n.jpg" alt="Canto N"></a>
                        <div class="caption">
                            <p>Canto N</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="thumbnail" id="img-thumb">
                        <a href="img/produtos/grande/canto_reto.jpg" rel="shadowbox[vocation]" title="Canto Reto"><img src="img/produtos/miniatura/canto_reto.jpg" alt="Canto Reto"></a>
                        <div class="caption">
                            <p>Canto Reto</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="thumbnail" id="img-thumb">
                        <a href="img/produtos/grande/canto_tick.jpg" rel="shadowbox[vocation]" title="Canto Tick"><img src="img/produtos/miniatura/canto_tick.jpg" alt="Canto Tick"></a>
                        <div class="caption">
                            <p>Canto Tick</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="thumbnail" id="img-thumb">
                        <a href="img/produtos/grande/canto_lapis.jpg" rel="shadowbox[vocation]" title="Canto Lápis"><img src="img/produtos/miniatura/canto_lapis.jpg" alt="Canto Lápis"></a>
                        <div class="caption">
                            <p>Canto Lápis</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="thumbnail" id="img-thumb">
                        <a href="img/produtos/grande/canto_moeda.jpg" rel="shadowbox[vocation]" title="Canto Moeda"><img src="img/produtos/miniatura/canto_moeda.jpg" alt="Canto Moeda"></a>
                        <div class="caption">
                            <p>Canto Moeda</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="thumbnail" id="img-thumb">
                        <a href="img/produtos/grande/canto_garrafa.jpg" rel="shadowbox[vocation]" title="Canto Garrafa"><img src="img/produtos/miniatura/canto_garrafa.jpg" alt="Canto Garrafa"></a>
                        <div class="caption">
                            <p>Canto Garrafa</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="thumbnail" id="img-thumb">
                        <a href="img/produtos/grande/canto_garrafao.jpg" rel="shadowbox[vocation]" title="Canto Garrafão"><img src="img/produtos/miniatura/canto_garrafao.jpg" alt="Canto Garrafão"></a>
                        <div class="caption">
                            <p>Canto Garrafão</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="thumbnail" id="img-thumb">
                        <a href="img/produtos/grande/canto_chanfrado.jpg" rel="shadowbox[vocation]" title="Canto Chanfrado"><img src="img/produtos/miniatura/canto_chanfrado.jpg" alt="Canto Chanfrado"></a>
                        <div class="caption">
                            <p>Canto Chanfrado</p>
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
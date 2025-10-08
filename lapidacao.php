<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT lapidacao AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Lapidação de Vidros - Linde Vidros";

$description = "A lapidação é um tratamento dado ao vidro deixando-o mais seguro e resistente, permite um maior número de detalhes, que valorizam qualquer ideia em espelhos e tampos de vidro" . $tg;
$keywords = "lapidação copo, lapidação meia cana, lapidação bisotê, lapidação og, lapidação 3g, acabamento de vidros, lapidação de vidros";

$og_url = "http://www.lindevidros.com.br/lapidacao";
$og_name = "Lapidação de Vidros";

$submenu_id = "S-LA";

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
                    	<h1>Lapidação</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
    <div class="row" id="img-pg">
    	<div class="col-md-12">
        	<img src="img/img_lapidacao.jpg" alt="Lapidação de Vidros" class="img-rounded img-responsive">
        </div>
    </div>
    <div class="row" id="conteudo">
        <div class="col-md-9">
            <p class="text-justify">A <strong>lapidação</strong> é um tratamento dado ao vidro deixando-o mais seguro e resistente, evitando trincas e prevenindo ferimentos, além de permitir um maior número de detalhes, que valorizam qualquer ideia.</p>
            
            <h2>Tipos de Lapidação</h2>
            
            <div class="row">
                <div class="col-xs-6 col-sm-3">
                    <div class="thumbnail" id="img-thumb">
                        <a href="img/produtos/grande/lapidacao_copo.jpg" rel="shadowbox[vocation]" title="Lapidação Copo"><img src="img/produtos/miniatura/lapidacao_copo.jpg" alt="Lapidação Copo"></a>
                        <div class="caption">
                            <p>Copo</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="thumbnail" id="img-thumb">
                        <a href="img/produtos/grande/lapidacao_meiacana.jpg" rel="shadowbox[vocation]" title="Lapidação Meia Cana"><img src="img/produtos/miniatura/lapidacao_meiacana.jpg" alt="Lapidação Meia Cana"></a>
                        <div class="caption">
                            <p>Meia Cana</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="thumbnail" id="img-thumb">
                        <a href="img/produtos/grande/lapidacao_bisote.jpg" rel="shadowbox[vocation]" title="Lapidação Bisotê"><img src="img/produtos/miniatura/lapidacao_bisote.jpg" alt="Lapidação Bisotê"></a>
                        <div class="caption">
                            <p>Bisotê</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="thumbnail" id="img-thumb">
                        <a href="img/produtos/grande/lapidacao_og.jpg" rel="shadowbox[vocation]" title="Lapidação OG"><img src="img/produtos/miniatura/lapidacao_og.jpg" alt="Lapidação OG"></a>
                        <div class="caption">
                            <p>OG</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="thumbnail" id="img-thumb">
                        <a href="img/produtos/grande/lapidacao_3g.jpg" rel="shadowbox[vocation]" title="Lapidação 3G"><img src="img/produtos/miniatura/lapidacao_3g.jpg" alt="Lapidação 3G"></a>
                        <div class="caption">
                            <p>3G</p>
                        </div>
                    </div>
                </div>
			</div>
        </div>
        <div class="col-md-3">
			<?php include_once ("includes/menu_servicos.php"); ?>
        </div>
    </div>
    
    <div class="row" id="conteudo">
    	<div class="col-md-12">
        	<hr>
            
            <div class="row">
                <div class="col-xs-4 col-md-2">
                    <a href="img/produtos/grande/lapidacao1.jpg" rel="shadowbox[vocation]" title="Lapidação" class="thumbnail">
                    <img src="img/produtos/miniatura/lapidacao1.jpg" alt="Lapidação">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2">
                    <a href="img/produtos/grande/lapidacao2.jpg" rel="shadowbox[vocation]" title="Lapidação" class="thumbnail">
                    <img src="img/produtos/miniatura/lapidacao2.jpg" alt="Lapidação">
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
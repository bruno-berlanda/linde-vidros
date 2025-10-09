<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT lapidacao AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Lapidação de Vidros - Linde Vidros";

$description = "A lapidação é um tratamento dado ao vidro deixando-o mais seguro e resistente, permite um maior número de detalhes, que valorizam qualquer ideia em espelhos e tampos de vidro" . $tg;
$keywords = "lapidação copo, lapidação meia cana, lapidação bisotê, lapidação og, lapidação 3g, acabamento de vidros, lapidação de vidros";

$og_url = "https://www.lindevidros.com.br/lapidacao";
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
    <div class="row">
        <div class="col-12 bg-light py-4 border-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-azul-linde">Lapidação</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-3">
    	<div class="col-12">
        	<img src="img/img_lapidacao.jpg" alt="Lapidação de Vidros" class="rounded img-fluid">
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-9">
            <p class="text-justify">A <strong>lapidação</strong> é um tratamento dado ao vidro deixando-o mais seguro e resistente, evitando trincas e prevenindo ferimentos, além de permitir um maior número de detalhes, que valorizam qualquer ideia.</p>
            
            <h2>Tipos de Lapidação</h2>
            
            <div class="row">
                <div class="col-6 col-md-2">
                    <div class="card mb-3 border-0">
                        <a href="img/produtos/grande/lapidacao_copo.jpg" rel="shadowbox[vocation]" title="Lapidação Copo">
                            <img src="img/produtos/miniatura/lapidacao_copo.jpg" class="card-img-top" alt="Lapidação Copo">
                        </a>
                        <div class="card-body">
                            <p class="h6 mb-3 text-center">Copo</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="card mb-3 border-0">
                        <a href="img/produtos/grande/lapidacao_meiacana.jpg" rel="shadowbox[vocation]" title="Lapidação Meia Cana">
                            <img src="img/produtos/miniatura/lapidacao_meiacana.jpg" class="card-img-top" alt="Lapidação Meia Cana">
                        </a>
                        <div class="card-body">
                            <p class="h6 mb-3 text-center">Meia Cana</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="card mb-3 border-0">
                        <a href="img/produtos/grande/lapidacao_bisote.jpg" rel="shadowbox[vocation]" title="Lapidação Bisotê">
                            <img src="img/produtos/miniatura/lapidacao_bisote.jpg" class="card-img-top" alt="Lapidação Bisotê">
                        </a>
                        <div class="card-body">
                            <p class="h6 mb-3 text-center">Bisotê</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="card mb-3 border-0">
                        <a href="img/produtos/grande/lapidacao_og.jpg" rel="shadowbox[vocation]" title="Lapidação OG">
                            <img src="img/produtos/miniatura/lapidacao_og.jpg" class="card-img-top" alt="Lapidação OG">
                        </a>
                        <div class="card-body">
                            <p class="h6 mb-3 text-center">OG</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="card mb-3 border-0">
                        <a href="img/produtos/grande/lapidacao_3g.jpg" rel="shadowbox[vocation]" title="Lapidação 3G">
                            <img src="img/produtos/miniatura/lapidacao_3g.jpg" class="card-img-top" alt="Lapidação 3G">
                        </a>
                        <div class="card-body">
                            <p class="h6 mb-3 text-center">3G</p>
                        </div>
                    </div>
                </div>
			</div>
        </div>
        <div class="col-md-3">
			<?php include_once ("includes/menu_servicos.php"); ?>
        </div>
    </div>
    
    <div class="row my-4">
    	<div class="col-12">
        	<hr>
            
            <div class="row">
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/lapidacao1.jpg" rel="shadowbox[vocation]" title="Lapidação">
                        <img src="img/produtos/miniatura/lapidacao1.jpg" alt="Lapidação" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/lapidacao2.jpg" rel="shadowbox[vocation]" title="Lapidação">
                        <img src="img/produtos/miniatura/lapidacao2.jpg" alt="Lapidação" class="img-fluid img-thumbnail">
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
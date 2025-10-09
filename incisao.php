<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT incisao AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Incisão em Vidros - Linde Vidros";

$description = "A incisão consiste em gravar cavas na superfície do vidro, deixando com uma aparência moderna cheia de estilo" . $tg;
$keywords = "incisão em vidros, incisão caneta, incisão u, incisão v";

$og_url = "https://www.lindevidros.com.br/incisao";
$og_name = "Incisão em Vidros";

$submenu_id = "S-IN";

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
                        <h1 class="text-azul-linde">Incisão</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-3">
    	<div class="col-12">
        	<img src="img/img_incisao.jpg" alt="Incisão" class="rounded img-fluid">
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-9">
            <p class="text-justify">O processo de <strong>Incisão</strong> consiste em gravar cavas na superfície do vidro, gerando formas e desenhos, atribuindo ao vidro ou espelho, mais requinte, estilo e modernidade.</p>
            
            <p class="text-justify">São três tipos de cavas:</p>
            
            <dl class="dl-horizontal">
                <dt>Caneta</dt>
                <dd>Mais indicada para desenhos e escritas.</dd>
                
                <dt>V ou U</dt>
                <dd>Mais indicada para molduras e painéis.</dd>
            </dl>
            
            <br>
            
            <p><img src="img/produtos/incisao.jpg" alt="Incisão" class="img-fluid"></p>
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
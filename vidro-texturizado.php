<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT vidro_texturizado AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Vidro Texturizado - Linde Vidros";

$description = "Vidro Texturizado, resistência e conforto, privacidade, esteticamente agradável, usado em decoração, o vidro texturizado pode ser, Vidro Pontilhado, Vidro Squadriglass, Vidro Miniboreal" . $tg;
$keywords = "vidro texturizado, vidro pontilhado, vidro squadriglass, vidro miniboreal, linde vidros, vidro, distribuidora de vidro, beneficiadora de vidro, fábrica de vidro";

$og_url = "https://www.lindevidros.com.br/vidro-texturizado";
$og_name = "Vidro Texturizado";

$submenu_id = "E-VF";

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
                        <h1 class="text-azul-linde">Vidro Texturizado</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-3">
    	<div class="col-md-12">
        	<img src="img/img_texturizado.jpg" alt="Vidro Texturizado" class="rounded img-fluid">
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-9">
            <p class="text-justify">O <strong>vidro texturizado</strong>, também conhecido como <em>vidro fantasia</em>, é produzido igualmente ao vidro float. A única diferença é que no final do processo fabril ele passa por dois rolos metálicos a 900ºC. Um destes rolos é liso, e no outro há desenhos em relevo, que marca a superfície do vidro. A distância entre esses rolos define a espessura do vidro.</p>
            
            <p><strong>Vantagens:</strong></p>
            
            <ul>
            	<li>Vidro tão resistente quanto ao vidro float</li>
                <li>Os desenhos são uniformes</li>
                <li>Permite a passagem da luz ao mesmo tempo que traz privacidade</li>
                <li>A textura do vidro difunde a luz direta, tornando-a mais suave (especialmente em fachadas)</li>
            </ul>
            
            <p><strong>Aplicação:</strong></p>
            
            <ul>
            	<li>Portas e janelas</li>
                <li>Coberturas e fachadas</li>
                <li>Box de banheiro</li>
                <li>Decoração de interiores</li>
            </ul>
            
            <h2>Tipos de Vidro Texturizado</h2>
            
            <h3>Pontilhado</h3>
            
            <p class="text-justify">Esteticamente agradável e versátil, o padrão <strong>Pontilhado</strong> surpreende pela suavidade que imprime ao ambiente. Sua textura clássica combina com os mais variados estilos de decoração, sempre garantindo total harmonia ao projeto. O resultado é uma sensação de conforto, que deixa você à vontade e faz do <strong>Pontilhado</strong> um clássico no mercado.</p>
            
			<div class="row">
                <div class="col-4 col-md-3 mb-2">
                    <a href="img/produtos/grande/texturizado_pontilhado1.jpg" rel="shadowbox[vocation]" title="Vidro Pontilhado">
                        <img src="img/produtos/miniatura/texturizado_pontilhado1.jpg" alt="Vidro Pontilhado" class="img-fluid img-thumbnail">
                    </a>
                </div>
            </div>
            
            <h3>Squadriglass</h3>
            
            <p class="text-justify">O vidro <strong>Squadriglass</strong> vem para sofisticar o seu ambiente, dando privacidade e beleza em projetos residenciais e comerciais. Sua textura é recheada de pequenos retângulos, garantindo luminosidade, e combinando com qualquer ambiente.</p>
            
            <div class="row">
                <div class="col-4 col-md-3 mb-2">
                    <a href="img/produtos/grande/texturizado_squadriglass1.jpg" rel="shadowbox[vocation]" title="Vidro Squadriglass">
                        <img src="img/produtos/miniatura/texturizado_squadriglass1.jpg" alt="Vidro Squadriglass" class="img-fluid img-thumbnail">
                    </a>
                </div>
            </div>
            
            <h3>Mini Boreal</h3>
            
            <p class="text-justify">Muito conhecido no Brasil, este vidro apresenta uma textura suave, feita com micro quadrados e gravação regular. Com luminosidade e translucidez uniformes, o vidro <strong>Mini Boreal</strong> é especificado com frequência em diferentes projetos acrescentando beleza e conforto aos ambientes.</p>
            
            <div class="row">
                <div class="col-4 col-md-3 mb-2">
                    <a href="img/produtos/grande/texturizado_miniboreal1.jpg" rel="shadowbox[vocation]" title="Vidro Mini Boreal">
                        <img src="img/produtos/miniatura/texturizado_miniboreal1.jpg" alt="Vidro Mini Boreal" class="img-fluid img-thumbnail">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
			<?php include_once ("includes/menu_engenharia_produtos.php"); ?>
        </div>
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT vidro_habitat AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Vidros de controle solar, proteção solar - Linde Vidros";

$description = "Os Vidros de controle solar trazem proteção solar para sua obra, protegendo você e seus móveis do calor e dos raios UV" . $tg;
$keywords = "Vidro de Controle Solar, Controle Solar, Proteção Solar, Proteção UV, Linde Vidros, distribuidora de vidro, beneficiadora de vidro, fábrica de vidro";

$og_url = "http://www.lindevidros.com.br/vidro-controle-solar";
$og_name = "Vidros de Controle Solar";

$submenu_id = "E-VCS";

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
                    	<h1>Vidro de Controle Solar</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
    <div class="row" id="img-pg">
    	<div class="col-md-12">
        	<img src="img/img_controle_solar.jpg" alt="Vidro de Controle Solar" class="img-rounded img-responsive">
        </div>
    </div>
    <div class="row" id="conteudo">
        <div class="col-md-9">
            <p class="text-justify">Os <strong>vidros de controle solar</strong>, também chamado de vidros de proteção solar, são vidros que impedem a transmissão de calor pelos raios do sol e filtram os raios UV, mantendo o ambiente interno com uma temperatura mais agradável e livre de raios nocivos e que causam desbotamento de cores.</p>
            
            <p class="text-justify">Os prédios que usam muito vidro em suas fachadas e estrutura comumente usam o vidro de controle solar, aproveitando as grandes janelas que provem uma iluminação natural sem o excesso de calor. Mas afinal, como o vidro de controle solar funciona?</p>
            
            <p class="text-justify">Os vidros de controle solar recebem uma camada de metalização em uma das duas faces durante a sua fabricação, essa metalização será responsável pelas características de controle solar e para entendermos melhor o seu funcionamento vamos falar sobre <strong>absorção</strong>, <strong>transmissão</strong> e <strong>reflexão</strong>.</p>
            
            <p class="text-justify">A <strong>absorção</strong> de calor que o vidro de controle solar possui é maior que a do vidro comum, sendo assim, o vidro de controle solar absorve o calor ao invés de deixá-lo passar para o ambiente interno.</p>

            <p class="text-justify">A <strong>transmissão</strong> se refere a transmissão de calor gerado por outros raios do sol que o vidro repele, aliando com a absorção a diminuição da entrada de calor para o ambiente interno, o calor transmitido é repelido pelo vidro graças a camada de metalização, e retorna para o ambiente externo.</p>

            <p class="text-justify">A <strong>reflexão</strong> se refere a quantidade de luz que o vidro reflete para o ambiente externo, impedindo a entrada no ambiente interno e assim controlando assim luminosidade.</p>

            <p class="text-justify">Os vidros de proteção solar podem possuir um melhor aproveitamento de cada característica, para saber qual vidro com proteção solar se encaixa com o seu projeto, você pode consultar os valores que correspondem a cada uma das características, sendo os valores medidos como FS para Absorção, SHGC para Transmissão e VLR para Reflexão.</p>

            <p class="text-justify">Com diferentes características, os vidros de controle solar podem ser usados em qualquer projeto, se adequando melhor as condições onde a obra está sendo construída.</p>
        </div>
        <div class="col-md-3">
			<?php include_once ("includes/menu_engenharia_produtos.php"); ?>
        </div>
    </div>
    
    <div class="row" id="conteudo">
    	<div class="col-md-12">
        	<hr>
            
            <div class="row">
                <div class="col-xs-4 col-md-2">
                    <a href="img/produtos/grande/controle_solar1.jpg" rel="shadowbox[vocation]" title="Vidro de Controle Solar" class="thumbnail">
                    <img src="img/produtos/miniatura/controle_solar1.jpg" alt="Vidro de Controle Solar">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2">
                    <a href="img/produtos/grande/controle_solar2.jpg" rel="shadowbox[vocation]" title="Vidro de Controle Solar" class="thumbnail">
                    <img src="img/produtos/miniatura/controle_solar2.jpg" alt="Vidro de Controle Solar">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2">
                    <a href="img/produtos/grande/controle_solar3.jpg" rel="shadowbox[vocation]" title="Vidro de Controle Solar" class="thumbnail">
                    <img src="img/produtos/miniatura/controle_solar3.jpg" alt="Vidro de Controle Solar">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2">
                    <a href="img/produtos/grande/controle_solar4.jpg" rel="shadowbox[vocation]" title="Vidro de Controle Solar" class="thumbnail">
                    <img src="img/produtos/miniatura/controle_solar4.jpg" alt="Vidro de Controle Solar">
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
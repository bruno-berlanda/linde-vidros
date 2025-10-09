<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT serigrafia AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Empresa - Linde Vidros";

$description = "A Linde Vidros é uma indústria beneficiadora de vidro localizada na cidade de Rio Negro, Paraná. Fundada em 1966 está a mais de 50 anos no mercado" . $tg;
$keywords = "linde vidros, missão linde vidros, visão linde vidros, valores linde vidros, certificados linde vidros";

$og_url = "https://www.lindevidros.com.br/empresa";
$og_name = "Linde Vidros";

$submenu_id = "EMPRESA";

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
                        <h1 class="text-azul-linde">Empresa</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row my-4">
        <div class="col-md-12">
        	<h2>A Linde Vidros</h2>
            
            <p class="text-justify"><img src="img/empresa/img_empresa_bandeira.jpg" alt="Linde Vidros" class="img-thumbnail img-fluid float-start me-4 mb-4"> Em agosto de 1991 foi fundada uma filial na cidade de Rio Negro – PR para a distribuição em chapas de vidros em geral, atendendo outras regiões.</p>
            
            <p class="text-justify">Nos últimos anos, a unidade de Rio Negro, vem investindo em máquinas de última geração para melhor corte e acabamento; no ano 2000 foi instalado um forno de tempera vertical, mas a grande mudança ocorreu no ano de 2003 com a aquisição de um forno de tempera horizontal com capacidade de temperar vidro de 2,8mm até 19mm e em março de 2008 foi instalado seu segundo forno horizontal.</p>
            
            <p class="text-justify">Atualmente estamos com 120.000m² de área e 22.000m² de área construída, sempre investindo em inovações tecnológicas, trazendo soluções aos nossos clientes. A empresa ficou mais conhecida pelo seu nome fantasia <strong>Linde Vidros</strong>.</p>
            
            <p class="text-justify">Nossos produtos são vendidos para toda região sul e sudeste do Brasil. Devido ao alto grau de qualidade no produto e atendimento somos certificados pelo Inmetro desde 2004 no vidro temperado de 3mm a 12mm sendo a 1º empresa do Brasil a conseguir o selo do Inmetro na espessura de 3mm. Nossos produtos são: vidro temperado, vidro laminado, vidro habitat, vidro refletivo, vidro insulado, vidro texturizado, sentryglas, espelho, porta de alumínio, linha refrigeração e chaparia. E os serviços de serigrafia, bisotê, incisão.</p>
            
            <p class="text-justify">A Linde Vidros com sua experiência há mais de 50 anos sempre busca para seu cliente o que diz seu lema “QUALIDADE - INOVAÇÃO – RESULTADO”.</p>
            
            <br>
            
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/emp_missao.jpg" class="card-img-top" alt="Missão">
                        <div class="card-body">
                            <p class="text-azul-linde h5 mb-0">Missão</p>
                            <p class="card-text text-muted">Oferecer produtos e serviços competitivos em vidros, aumentando a participação no mercado, com foco na excelência, inovação e sustentabilidade.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/emp_visao.jpg" class="card-img-top" alt="Visão">
                        <div class="card-body">
                            <p class="text-azul-linde h5 mb-0">Visão</p>
                            <p class="card-text text-muted">Ser referência em produtos e serviços em vidros com foco na excelência, inovação e sustentabilidade.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card mb-3">
                        <img src="img/emp_valores.jpg" class="card-img-top" alt="Valores">
                        <div class="card-body">
                            <p class="text-azul-linde h5 mb-0">Valores</p>
                            <p class="card-text text-muted">Ética, transparência, profissionalismo, atendimento, comprometimento, inovação, trabalho em equipe, qualidade-excelência.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <h2>Certificação</h2>
            
            <p class="text-justify">O nosso <strong>Vidro Temperado</strong> é certificado pelo <em>Inmetro</em> desde outubro de 2004 em nas espessuras de 3 a 12mm. Buscamos com isso trazer total garantia aos nossos clientes de estarem adquirindo um produto de altíssima qualidade. Esta certificação pode ser observada nas peças temperadas através do selo do Inmetro.</p>
            
            <p class="text-center"><img src="img/empresa/selo_certificacao.png" alt="Certificação Linde Vidros"></p>
            
            <h2>BNDES</h2>
            
            <p class="text-justify">O <strong>Cartão BNDES</strong> é um produto baseado no conceito de cartão de crédito. Visa financiar os investimentos das micro, pequenas e médias empresas (MPMEs). Podem obter o Cartão BNDES as MPMEs sediadas no País e que estejam em dia com o INSS, FGTS, RAIS e tributos federais.</p>
            
            <p class="text-justify">Entre em contato com o nosso departamento comercial para maiores informações.</p>
            
            <hr>
    
            <div class="row">
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/empresa/grande/linde_1991.jpg" rel="shadowbox[vocation]" title="Linde Vidros 1991">
                        <img src="img/empresa/miniatura/linde_1991.jpg" alt="Linde Vidros 1991" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/empresa/grande/linde_1993.jpg" rel="shadowbox[vocation]" title="Linde Vidros 1993">
                        <img src="img/empresa/miniatura/linde_1993.jpg" alt="Linde Vidros 1993" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/empresa/grande/linde_1995.jpg" rel="shadowbox[vocation]" title="Linde Vidros 1995">
                        <img src="img/empresa/miniatura/linde_1995.jpg" alt="Linde Vidros 1995" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/empresa/grande/linde_2004.jpg" rel="shadowbox[vocation]" title="Linde Vidros 2004">
                        <img src="img/empresa/miniatura/linde_2004.jpg" alt="Linde Vidros 2004" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/empresa/grande/linde_2007.jpg" rel="shadowbox[vocation]" title="Linde Vidros 2007">
                        <img src="img/empresa/miniatura/linde_2007.jpg" alt="Linde Vidros 2007" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/empresa/grande/linde_2009.jpg" rel="shadowbox[vocation]" title="Linde Vidros 2009">
                        <img src="img/empresa/miniatura/linde_2009.jpg" alt="Linde Vidros 2009" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/empresa/grande/linde_2012.jpg" rel="shadowbox[vocation]" title="Linde Vidros 2012">
                        <img src="img/empresa/miniatura/linde_2012.jpg" alt="Linde Vidros 2012" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/empresa/grande/linde_2014.jpg" rel="shadowbox[vocation]" title="Linde Vidros 2014">
                        <img src="img/empresa/miniatura/linde_2014.jpg" alt="Linde Vidros 2014" class="img-fluid img-thumbnail">
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
<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT idea_glass AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Kits Idea Glass - Linde Vidros";

$description = "Os Kits Idea Glass deixa sua obra mais elegante, com acessórios para box de banheiro, portas e sacadas" . $tg;
$keywords = "kit idea glass, box due, box elegance, box encanto, box flex 1.2, porta flex 1.2, vision, prolongador maxx";

$og_url = "http://www.lindevidros.com.br/idea-glass";
$og_name = "Kits Idea Glass";

$submenu_id = "A-IG";

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
                    	<h1>Kits Idea Glass</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
    <div class="row" id="img-pg">
    	<div class="col-md-12">
        	<img src="img/img_idea_glass.jpg" alt="Kits Idea Glass" class="img-rounded img-responsive">
        </div>
    </div>
    <div class="row" id="conteudo">
        <div class="col-md-9">
            <p class="text-justify">Confira os <strong>Kits Idea Glass</strong> que a Linde Vidros fornece, e deixe sua obra ainda mais elegante.</p>
            
            <h2>Kits Idea Glass</h2>
            
            <h3>Box Due</h3>
            
            <p class="text-justify">O dobro em elegância.</p>
            
			<div class="row">
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_box_due01.jpg" rel="shadowbox[vocation]" title="Box Due" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_box_due01.jpg" alt="Box Due">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_box_due02.jpg" rel="shadowbox[vocation]" title="Box Due" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_box_due02.jpg" alt="Box Due">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_box_due03.jpg" rel="shadowbox[vocation]" title="Box Due" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_box_due03.jpg" alt="Box Due">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_box_due04.jpg" rel="shadowbox[vocation]" title="Box Due" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_box_due04.jpg" alt="Box Due">
                    </a>
                </div>
            </div>
            
            <h3>Box Elegance</h3>
            
            <p class="text-justify">Um conjunto de detalhes que fazem a diferença.</p>
            
			<div class="row">
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_box_elegance01.jpg" rel="shadowbox[vocation]" title="Box Elegance" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_box_elegance01.jpg" alt="Box Elegance">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_box_elegance02.jpg" rel="shadowbox[vocation]" title="Box Elegance" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_box_elegance02.jpg" alt="Box Elegance">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_box_elegance03.jpg" rel="shadowbox[vocation]" title="Box Elegance" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_box_elegance03.jpg" alt="Box Elegance">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_box_elegance04.jpg" rel="shadowbox[vocation]" title="Box Elegance" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_box_elegance04.jpg" alt="Box Elegance">
                    </a>
                </div>
            </div>
            
            <h3>Box Encanto</h3>
            
            <p class="text-justify">Maravilhoso como um conto de fadas.</p>
            
			<div class="row">
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_box_encanto01.jpg" rel="shadowbox[vocation]" title="Box Encanto" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_box_encanto01.jpg" alt="Box Encanto">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_box_encanto02.jpg" rel="shadowbox[vocation]" title="Box Encanto" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_box_encanto02.jpg" alt="Box Encanto">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_box_encanto03.jpg" rel="shadowbox[vocation]" title="Box Encanto" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_box_encanto03.jpg" alt="Box Encanto">
                    </a>
                </div>
            </div>
            
            <h3>Box Flex 1.2</h3>
            
            <p class="text-justify">Mais espaço e conforto.</p>
            
			<div class="row">
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_box_flex01.jpg" rel="shadowbox[vocation]" title="Box Flex 1.2" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_box_flex01.jpg" alt="Box Flex 1.2">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_box_flex02.jpg" rel="shadowbox[vocation]" title="Box Flex 1.2" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_box_flex02.jpg" alt="Box Flex 1.2">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_box_flex03.jpg" rel="shadowbox[vocation]" title="Box Flex 1.2" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_box_flex03.jpg" alt="Box Flex 1.2">
                    </a>
                </div>
            </div>
            
            <h3>Porta Flex 1.2</h3>
            
            <p class="text-justify">Ganhe ainda mais espaço.</p>
            
			<div class="row">
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_porta_flex01.jpg" rel="shadowbox[vocation]" title="Porta Flex 1.2" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_porta_flex01.jpg" alt="Porta Flex 1.2">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_porta_flex02.jpg" rel="shadowbox[vocation]" title="Porta Flex 1.2" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_porta_flex02.jpg" alt="Porta Flex 1.2">
                    </a>
                </div>
            </div>
            
            <h3>Vision</h3>
            
            <p class="text-justify">Sua nova visão em portas. Deslize suave, é pratica e delicada.</p>
            
			<div class="row">
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_vision01.jpg" rel="shadowbox[vocation]" title="Vision" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_vision01.jpg" alt="Vision">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_vision02.jpg" rel="shadowbox[vocation]" title="Vision" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_vision02.jpg" alt="Vision">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_vision03.jpg" rel="shadowbox[vocation]" title="Vision" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_vision03.jpg" alt="Vision">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_vision04.jpg" rel="shadowbox[vocation]" title="Vision" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_vision04.jpg" alt="Vision">
                    </a>
                </div>
            </div>
            
            <h3>Prolongador Maxx</h3>
            
            <p class="text-justify">Quando o projeto exige precisão e qualidade o prolongador é Maxx.</p>
            
			<div class="row">
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_maxx01.jpg" rel="shadowbox[vocation]" title="Prolongador Maxx" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_maxx01.jpg" alt="Prolongador Maxx">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_maxx02.jpg" rel="shadowbox[vocation]" title="Prolongador Maxx" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_maxx02.jpg" alt="Prolongador Maxx">
                    </a>
                </div>
                <div class="col-xs-6 col-md-3">
                    <a href="img/produtos/grande/ideaglass_maxx03.jpg" rel="shadowbox[vocation]" title="Prolongador Maxx" class="thumbnail">
                    <img src="img/produtos/miniatura/ideaglass_maxx03.jpg" alt="Prolongador Maxx">
                    </a>
                </div>
            </div>            
        </div>
        <div class="col-md-3">
			<?php include_once ("includes/menu_acessorios.php"); ?>
        </div>
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT vidro_refletivo AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Vidro Refletivo - Linde Vidros";

$description = "Vidro Refletivo conhecido como Vidro Espelhado, garante isolamento térmico, economia no consumo de energia elétrica, protege contra raios UV, para fachadas de edifícios residenciais e comerciais, portas e janelas" . $tg;
$keywords = "";

$og_url = "http://www.lindevidros.com.br/vidro-refletivo";
$og_name = "Vidro Refletivo";

$submenu_id = "E-VR";

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
                    	<h1>Vidro Refletivo</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
    <div class="row" id="img-pg">
    	<div class="col-md-12">
        	<img src="img/img_refletivo.jpg" alt="Vidro Refletivo" class="img-rounded img-responsive">
        </div>
    </div>
    <div class="row" id="conteudo">
        <div class="col-md-9">
            <p class="text-justify">O <strong>Vidro Refletivo</strong>, popularmente conhecido como espelhado, é desenvolvido com tecnologia que garante o controle eficiente da intensidade de luz e do calor transmitidos para os ambientes internos. São grandes aliados do conforto ambiental e da eficiência energética nas edificações.</p>
            
            <p><strong>Benefícios:</strong></p>
            
            <ul>
            	<li>Performances diferenciadas para controle solar em relação à transmissão e à reflexão de luz e calor, além de baixos coeficientes de sombreamento</li>
                <li>Redução em até 80% da passagem de calor por radiação solar para o interior do ambiente</li>
                <li>Isolamento térmico</li>
                <li>Barreira contra os raios ultravioleta (UV) – quando laminado</li>
                <li>Economia de consumo de energia elétrica pela diminuição do uso do ar-condicionado</li>
                <li>Controle da luminosidade incidente no vidro: sensação de conforto ao usuário e racionalização no uso da luz elétrica</li>
            </ul>
            
            <p><strong>Aplicações:</strong></p>
            
            <ul>
            	<li>Fachadas de edifícios residenciais e comerciais</li>
                <li>Coberturas</li>
                <li>Portas</li>
                <li>Janelas</li>
                <li>Sacadas de edifícios e casas</li>
            </ul>
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
                    <a href="img/produtos/grande/refletivo1.jpg" rel="shadowbox[vocation]" title="Vidro Refletivo" class="thumbnail">
                    <img src="img/produtos/miniatura/refletivo1.jpg" alt="Vidro Refletivo">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2">
                    <a href="img/produtos/grande/refletivo2.jpg" rel="shadowbox[vocation]" title="Vidro Refletivo" class="thumbnail">
                    <img src="img/produtos/miniatura/refletivo2.jpg" alt="Vidro Refletivo">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2">
                    <a href="img/produtos/grande/refletivo3.jpg" rel="shadowbox[vocation]" title="Vidro Refletivo" class="thumbnail">
                    <img src="img/produtos/miniatura/refletivo3.jpg" alt="Vidro Refletivo">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2">
                    <a href="img/produtos/grande/refletivo4.jpg" rel="shadowbox[vocation]" title="Vidro Refletivo" class="thumbnail">
                    <img src="img/produtos/miniatura/refletivo4.jpg" alt="Vidro Refletivo">
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
<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT vidro_temperado AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Vidro Temperado - Linde Vidros";

$description = "Vidro Temperado, solução para vidraçarias, serralherias, esquadrias e construtoras" . $tg;
$keywords = "vidro temperado, vidro tratamento térmico, vidro resistente, vidro de segurança, distribuidora de vidro, beneficiadora de vidro, fábrica de vidro";

$og_url = "http://www.lindevidros.com.br/vidro-temperado";
$og_name = "Vidro Temperado";

$submenu_id = "E-VT";

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
                    	<h1>Vidro Temperado</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
    <div class="row" id="img-pg">
    	<div class="col-md-12">
        	<img src="img/img_temperado.jpg" alt="Vidro Temperado" class="img-rounded img-responsive">
        </div>
    </div>
    <div class="row" id="conteudo">
        <div class="col-md-9">
			<h2>Vidro Temperado, o que é?</h2>
            
            <p class="text-justify">O vidro comum passa por um tratamento especial de aquecimento à 700ºC seguido de um rápido resfriamento, esse processo é denominado de <em>têmpera</em>. Através dele é incorporado um conjunto de forças, tração e compressão que aumenta a resistência do vidro em até quatro vezes, sem tirar suas características de transmissão luminosa, aparência e composição química.</p>
            
            <p class="text-justify">Além dá resistência física, a têmpera também proporciona ao vidro resistência térmica, suportando diferenças de temperaturas de até 200ºC. A segurança reside no fato de que ao quebrar-se, o <strong>vidro temperado</strong> fragmente-se em pequenos pedaços, arredondados e pouco cortantes, reduzido o risco de graves acidentes.</p>
            
            <h2>Vidro Temperado, como se produz?</h2>
            
            <p class="text-justify">O vidro é cortado e recebe os acabamentos necessários, como recortes e furos de acordo com o projeto. Somente após esses processos ele vai para a têmpera.</p>
            
            <p class="text-justify">Nos fornos horizontais, as chapas de vidro são suportadas por rolos especiais que eliminam as marcas de pinça, assim como as deformações causadas pelo próprio peso. O resultado é um produto de qualidade óptica incomparavelmente melhor. Isto abre, ao <strong>vidro temperado</strong>, as portas dos mercados mais exigentes da <a href="<?php echo $l_engenharia; ?>" title="Engenharia">construção civil</a> e da <a href="<?php echo $l_moveleiro; ?>" title="Moveleiro">indústria moveleira</a>.</p>
            
            <p class="text-justify">Após a têmpera, não é possível fazer cortes, lapidações ou furos. Podem ser feitos desenhos e aplicações leves, mas isto reduz a resistência do vidro.</p>
            
            <h2>Cores</h2>
            
            <h3>Cores Padrões</h3>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>COR</th>
                        <th>ESPESSURAS (mm)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>INCOLOR</td>
                        <td>3, 4, 5, 6, 8, 10, 12</td>
                    </tr>
                    <tr>
                        <td>BRONZE</td>
                        <td>4, 8, 10</td>
                    </tr>
                    <tr>
                        <td>FUMÊ</td>
                        <td>3, 4, 5, 6, 8, 10</td>
                    </tr>
                    <tr>
                        <td>VERDE</td>
                        <td>3, 4, 5, 6, 8, 10</td>
                    </tr>
                </tbody>
            </table>
            
            <h3>Cores Especiais</h3>
            
            <ul>
            	<li><a href="<?php echo $l_habitat; ?>" title="Vidro Habitat">Vidro Habitat</a></li>
                <li><a href="<?php echo $l_refletivo; ?>" title="Vidro Refletivo">Vidro Refletivo</a></li>
                <li><a href="<?php echo $l_texturizado; ?>" title="Vidro Texturizado">Vidro Texturizado</a></li>
                <li><a href="<?php echo $l_extra; ?>" title="Vidro Extra Clear">Vidro Extra Clear</a></li>
            </ul>
            
            <br>
            
            <h2>Corte, Lapidação e Recortes</h2>
            
            <p class="text-justify">Nossos produtos são produzidos com sistema de Corte Automático, Lapidação Copo (reta) feita em bilateral e ainda contamos com uma linha completa de CNC para furação e recortes totalmente automatizados podendo fazer trabalhos especiais e impraticáveis manualmente, nossa indústria trabalha prezando pelo acabamento e precisão das medidas com excelente qualidade no produto final.</p>
            
            <p class="text-justify">Outros acabamentos podem ser realizados com outros tipos de <a href="<?php echo $l_lapidacao; ?>" title="Lapidação">lapidação</a>, deixando seu projeto simplesmente maravilhoso.</p>
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
                    <a href="img/produtos/grande/temperado1.jpg" rel="shadowbox[vocation]" title="Vidro Temperado" class="thumbnail">
                    <img src="img/produtos/miniatura/temperado1.jpg" alt="Vidro Temperado">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2">
                    <a href="img/produtos/grande/temperado2.jpg" rel="shadowbox[vocation]" title="Vidro Temperado" class="thumbnail">
                    <img src="img/produtos/miniatura/temperado2.jpg" alt="Vidro Temperado">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2">
                    <a href="img/produtos/grande/temperado3.jpg" rel="shadowbox[vocation]" title="Vidro Temperado" class="thumbnail">
                    <img src="img/produtos/miniatura/temperado3.jpg" alt="Vidro Temperado">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2">
                    <a href="img/produtos/grande/temperado4.jpg" rel="shadowbox[vocation]" title="Vidro Temperado" class="thumbnail">
                    <img src="img/produtos/miniatura/temperado4.jpg" alt="Vidro Temperado">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2">
                    <a href="img/produtos/grande/temperado5.jpg" rel="shadowbox[vocation]" title="Vidro Temperado" class="thumbnail">
                    <img src="img/produtos/miniatura/temperado5.jpg" alt="Vidro Temperado">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2">
                    <a href="img/produtos/grande/temperado6.jpg" rel="shadowbox[vocation]" title="Vidro Temperado" class="thumbnail">
                    <img src="img/produtos/miniatura/temperado6.jpg" alt="Vidro Temperado">
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
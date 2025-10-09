<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT espelho AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Espelhos - Linde Vidros";

$description = "Os espelhos de alta qualidade trazem ao seu ambiente um toque de modernidade e sofisticação" . $tg;
$keywords = "espelho, espelho bronze, espelho prata";

$og_url = "https://www.lindevidros.com.br/espelho";
$og_name = "Espelhos";

$submenu_id = "M-ES";

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
                        <h1 class="text-azul-linde">Espelho</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-3">
    	<div class="col-12">
        	<img src="img/img_espelho.jpg" alt="Espelho" class="rounded img-fluid">
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-9">
			<p class="text-justify">O <strong>espelho</strong> Linde Vidros recebe o acabamento conforme você desejar, como lapidação, bisotê, furação e aplicação da <a href="<?php echo $l_pelicula; ?>" title="Película de Segurança">película de segurança</a> (trazendo segurança e evitando ruptura em possíveis quebras).</p>
            
            <h2>Cores</h2>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>COR</th>
                        <th>ESPESSURAS (mm)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>PRATA</td>
                        <td>2, 3, 4, 5, 6</td>
                    </tr>
                    <tr>
                        <td>BRONZE</td>
                        <td>4</td>
                    </tr>
                </tbody>
            </table>
            
            <h2>Instalando seu Espelho</h2>
            
            <p class="text-justify">Está com dúvidas sobre a instalação do seu espelho? Veja nossas dicas sabre <a href="<?php echo $l_instespelhos; ?>" title="Instalação de Espelhos">Instalação</a> e <a href="<?php echo $l_fixespelhos; ?>" title="Fixação de Espelhos">Fixação</a> de espelhos.</p>
        </div>
        <div class="col-md-3">
			<?php include_once ("includes/menu_moveleiro_produtos.php"); ?>
        </div>
    </div>
    
    <div class="row my-4">
    	<div class="col-12">
        	<hr>
            
            <div class="row">
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/espelho1.jpg" rel="shadowbox[vocation]" title="Espelho">
                        <img src="img/produtos/miniatura/espelho1.jpg" alt="Espelho" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/espelho2.jpg" rel="shadowbox[vocation]" title="Espelho">
                        <img src="img/produtos/miniatura/espelho2.jpg" alt="Espelho" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/espelho3.jpg" rel="shadowbox[vocation]" title="Espelho">
                        <img src="img/produtos/miniatura/espelho3.jpg" alt="Espelho" class="img-fluid img-thumbnail">
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
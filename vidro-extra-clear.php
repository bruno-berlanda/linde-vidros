<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT vidro_extraclear AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Vidro Extra Clear - Linde Vidros";

$description = "Vidro Extra Clear, clareza, neutralidade e transparência, pode ser utilizado como vidro monolítico, laminado, temperado e insulado, ideal para peças serigrafadas e pintadas" . $tg;
$keywords = "";

$og_url = "https://www.lindevidros.com.br/vidro-extra-clear";
$og_name = "Vidro Extra Clear";

$submenu_id = "E-EC";

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
                        <h1 class="text-azul-linde">Vidro Extra Clear</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-3">
    	<div class="col-md-12">
        	<img src="img/img_extra_clear.jpg" alt="Vidro Extra Clear" class="rounded img-fluid">
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-9">
            <p class="text-justify">O <strong>vidro extra clear</strong> é altamente requisitado por quem precisa de um projeto que transmita clareza, neutralidade e transparência. Por ser um vidro mais claro que o tradicional, ele melhora a visualização, mantendo as cores dos objetos vivas e naturais.</p>
            
            <p><strong>Vantagens:</strong></p>
            
            <ul>
            	<li>Elevada transparência, uma vez que a transmissão luminosa de um <strong>vidro extra clear</strong> é superior à de um vidro comum, especialmente no caso de vidros mais espessos</li>
                <li>Devido à sua grande neutralidade, melhora a visualização, mantendo as cores dos objetos vivas e naturais</li>
                <li>Pode ser combinado com qualquer tipo de vidro e laminado com PVB, EVA ou resina</li>
                <li>Produto versátil, sendo facilmente transformável</li>
                <li>Pode ser utilizado como vidro monolítico, <a href="<?php echo $l_laminado; ?>" title="Vidro Laminado">laminado</a>, <a href="<?php echo $l_temperado; ?>" title="Vidro Temperado">temperado</a> e <a href="<?php echo $l_insulado; ?>" title="Vidro Insulado">insulado</a></li>
                <li>Ideal para peças serigrafadas e pintadas</li>
            </ul>
        </div>
        <div class="col-md-3">
			<?php include_once ("includes/menu_engenharia_produtos.php"); ?>
        </div>
    </div>
    
    <div class="row my-4">
    	<div class="col-12">
        	<hr>
            
            <div class="row">
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/extraclear1.jpg" rel="shadowbox[vocation]" title="Vidro Extra Clear">
                        <img src="img/produtos/miniatura/extraclear1.jpg" alt="Vidro Extra Clear" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/extraclear2.jpg" rel="shadowbox[vocation]" title="Vidro Extra Clear">
                        <img src="img/produtos/miniatura/extraclear2.jpg" alt="Vidro Extra Clear" class="img-fluid img-thumbnail">
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
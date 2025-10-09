<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT portas_aluminio AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Portas de Alumínio - Linde Vidros";

$description = "Porta de Alúminio com o vidro ou espelho já encaixilhado traz um design diferenciado ao seu produto" . $tg;
$keywords = "";

$og_url = "https://www.lindevidros.com.br/portas-aluminio";
$og_name = "Portas de Alumínio";

$submenu_id = "M-PA";

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
                        <h1 class="text-azul-linde">Portas de Alumínio</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-3">
    	<div class="col-md-12">
        	<img src="img/img_porta.jpg" alt="Portas de Alumínio" class="rounded img-fluid">
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-9">
            <p class="text-justify">Para facilitar ainda mais a instalação do seu vidro ou espelho, produzimos as portas com o vidro já encaixilhado em um perfil de alumínio, trazendo um design diferenciado para o seu produto final.</p>
            
            <p><strong>Aplicação:</strong></p>
            
            <ul>
            	<li>Cozinhas</li>
                <li>Roupeiros</li>
            </ul>
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
                    <a href="img/produtos/grande/porta_aluminio1.jpg" rel="shadowbox[vocation]" title="Porta de Alumínio">
                        <img src="img/produtos/miniatura/porta_aluminio1.jpg" alt="Porta de Alumínio" class="img-fluid img-thumbnail">
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
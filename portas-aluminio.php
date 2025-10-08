<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT portas_aluminio AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Portas de Alumínio - Linde Vidros";

$description = "Porta de Alúminio com o vidro ou espelho já encaixilhado traz um design diferenciado ao seu produto" . $tg;
$keywords = "";

$og_url = "http://www.lindevidros.com.br/portas-aluminio";
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
	<div class="row" id="titulo">
    	<div class="col-md-12">
        	<div class="container">
            	<div class="row">
                    <div class="col-md-12">
                    	<h1>Portas de Alumínio</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
    <div class="row" id="img-pg">
    	<div class="col-md-12">
        	<img src="img/img_porta.jpg" alt="Portas de Alumínio" class="img-rounded img-responsive">
        </div>
    </div>
    <div class="row" id="conteudo">
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
    
    <div class="row" id="conteudo">
    	<div class="col-md-12">
        	<hr>
            
            <div class="row">
                <div class="col-xs-4 col-md-2">
                    <a href="img/produtos/grande/porta_aluminio1.jpg" rel="shadowbox[vocation]" title="Porta de Alumínio" class="thumbnail">
                    <img src="img/produtos/miniatura/porta_aluminio1.jpg" alt="Porta de Alumínio">
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
<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT engenharia AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Vidros para Engenharia - Linde Vidros";

$description = "Vidros Temperados, Laminados e Refletivos, Vidro Texturizado, Vidro Habitat, Vidro Insulado, Vidro Extra Clear, SentryGlas, Espelhos, Instalações Especiais. Atendemos engenheiros, arquitetos, decoradores" . $tg;
$keywords = "vidro temperado, vidro refletivo, vidro texturizado, vidro habitat, vidro insulado, vidro extra clear, sentryglass";

$og_url = "http://www.lindevidros.com.br/engenharia";
$og_name = "Vidros para Engenharia";

$submenu_id = "ENG";

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
                    	<h1>Engenharia</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
    <div class="row" id="conteudo">
        <div class="col-md-12">
        	<div class="row">
            	<div class="col-md-12">
                	<h2>Produtos</h2>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pe_temperado.jpg" alt="Vidro Temperado">
                        <div class="caption">
                            <p id="titulo-pg">Vidro Temperado</p>
                            <br>
                            <p><a href="<?php echo $l_temperado; ?>" class="btn btn-primary btn-block" role="button" title="Vidro Temperado"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pe_laminado.jpg" alt="Vidro Laminado">
                        <div class="caption">
                            <p id="titulo-pg">Vidro Laminado</p>
                            <br>
                            <p><a href="<?php echo $l_laminado; ?>" class="btn btn-primary btn-block" role="button" title="Vidro Laminado"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pe_refletivo.jpg" alt="Vidro Refletivo">
                        <div class="caption">
                            <p id="titulo-pg">Vidro Refletivo</p>
                            <br>
                            <p><a href="<?php echo $l_refletivo; ?>" class="btn btn-primary btn-block" role="button" title="Vidro Refletivo"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pe_insulado.jpg" alt="Vidro Insulado">
                        <div class="caption">
                            <p id="titulo-pg">Vidro Insulado</p>
                            <br>
                            <p><a href="<?php echo $l_insulado; ?>" class="btn btn-primary btn-block" role="button" title="Vidro Insulado"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pe_habitat.jpg" alt="Vidro Habitat">
                        <div class="caption">
                            <p id="titulo-pg">Vidro Habitat</p>
                            <br>
                            <p><a href="<?php echo $l_habitat; ?>" class="btn btn-primary btn-block" role="button" title="Vidro Habitat"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pe_texturizado.jpg" alt="Vidro Texturizado">
                        <div class="caption">
                            <p id="titulo-pg">Vidro Texturizado</p>
                            <br>
                            <p><a href="<?php echo $l_texturizado; ?>" class="btn btn-primary btn-block" role="button" title="Vidro Texturizado"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pe_extra.jpg" alt="Vidro Extra Clear">
                        <div class="caption">
                            <p id="titulo-pg">Vidro Extra Clear</p>
                            <br>
                            <p><a href="<?php echo $l_extra; ?>" class="btn btn-primary btn-block" role="button" title="Vidro Extra Clear"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pe_sentryglas.jpg" alt="SentryGlas">
                        <div class="caption">
                            <p id="titulo-pg">SentryGlas</p>
                            <br>
                            <p><a href="<?php echo $l_sentryglas; ?>" class="btn btn-primary btn-block" role="button" title="SentryGlas"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
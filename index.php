<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT home AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Linde Vidros - Solução em Vidros";

$description = "Vidro Laminado, Vidro Temperado, Vidro Insulado, Vidro Habitat, Vidro Texturizado, Sentryglas, Ferragens, Película de Segurança, Lapidação, Serigrafia, Vidros" . $tg;
$keywords = "vidro, vidros, vidro laminado, vidro habitat, vidro insulado, vidro temperado, vidro texturizado, sentryglas, serigrafia, película de segurança, distribuidora de vidro, beneficiadora de vidro, fábrica de vidro";

$og_url = "http://www.lindevidros.com.br/";
$og_name = "Linde Vidros";

require_once ("includes/links.php");
?>

<?php include_once ("includes/cabecalho.php"); ?>

<body>

<?php include_once ("includes/analyticstracking.php"); // Google Analytics ?>

<?php include_once ("includes/topo.php"); ?>

<?php include_once ("includes/menu.php"); ?>

<?php //include_once ("includes/logo.php"); ?>

<?php include_once ("includes/slide.php"); ?>

<div class="container">
	<div class="row" id="conteudo">
    	<div class="col-md-12">
            <p id="principal"><i class="fas fa-caret-right"></i> Vidros</p>
            
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pg_habitat.jpg" alt="Vidro Habitat">
                        <div class="caption">
                            <p id="titulo-pg">Vidro Habitat</p>
                            <p>Proteção solar</p>
                            <p><a href="<?php echo $l_habitat; ?>" class="btn btn-primary btn-block" role="button" title="Vidro Habitat"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pg_insulado.jpg" alt="Vidro Insulado">
                        <div class="caption">
                            <p id="titulo-pg">Vidro Insulado</p>
                            <p>Conforto total</p>
                            <p><a href="<?php echo $l_insulado; ?>" class="btn btn-primary btn-block" role="button" title="Vidro Insulado"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pg_laminado.jpg" alt="Vidro Laminado">
                        <div class="caption">
                            <p id="titulo-pg">Vidro Laminado</p>
                            <p>Segurança em primeiro lugar</p>
                            <p><a href="<?php echo $l_laminado; ?>" class="btn btn-primary btn-block" role="button" title="Vidro Laminado"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pg_sentryglas.jpg" alt="SentryGlas">
                        <div class="caption">
                            <p id="titulo-pg">SentryGlas</p>
                            <p>Maior resistência</p>
                            <p><a href="<?php echo $l_sentryglas; ?>" class="btn btn-primary btn-block" role="button" title="SentryGlas"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pg_texturizado.jpg" alt="Vidro Texturizado">
                        <div class="caption">
                            <p id="titulo-pg">Vidro Texturizado</p>
                            <p>Estilo e privacidade</p>
                            <p><a href="<?php echo $l_texturizado; ?>" class="btn btn-primary btn-block" role="button" title="Vidro Texturizado"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pg_temperado.jpg" alt="Vidro Temperado">
                        <div class="caption">
                            <p id="titulo-pg">Vidro Temperado</p>
                            <p>Qualidade garantida</p>
                            <p><a href="<?php echo $l_temperado; ?>" class="btn btn-primary btn-block" role="button" title="Vidro Temperado"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <p id="principal"><i class="fas fa-caret-right"></i> Serviços</p>
            
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pg_pelicula.jpg" alt="Película de Segurança">
                        <div class="caption">
                            <p id="titulo-pg">Película de Segurança</p>
                            <p>Proteção para a família</p>
                            <p><a href="<?php echo $l_pelicula; ?>" class="btn btn-primary btn-block" role="button" title="Película de Segurança"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pg_serigrafia.jpg" alt="Serigrafia">
                        <div class="caption">
                            <p id="titulo-pg">Serigrafia</p>
                            <p>Vidros pintados</p>
                            <p><a href="<?php echo $l_serigrafia; ?>" class="btn btn-primary btn-block" role="button" title="Serigrafia"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pg_lapidacao.jpg" alt="Lapidação">
                        <div class="caption">
                            <p id="titulo-pg">Lapidação</p>
                            <p>Qualidade no acabamento</p>
                            <p><a href="<?php echo $l_lapidacao; ?>" class="btn btn-primary btn-block" role="button" title="Lapidação"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row" id="link-merlin">
                <div class="col-xs-12">
                    <div class="thumbnail" id="img-thumb">
                        <a href="http://www.merlinferragens.com.br/" target="_blank" title="Merlin Ferragens" id="tooltip-merlin" rel="tooltip" data-placement="top"><img src="img/merlin.jpg" alt="Merlin Ferragens" class="img-responsive"></a>
                        <div class="caption">
                            <p id="titulo-pg">Merlin Ferragens</p>
                            <p>Tudo que você precisa, com qualidade e elegância.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ("includes/mapa.php"); ?>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
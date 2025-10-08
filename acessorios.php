<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT acessorios AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Acessórios para Vidros - Linde Vidros";

$description = "Acessórios para Vidros, Ferragens e Acessórios para Vidro Temperado, Perfis de Alumínio para Vidros Temperados, Kits Idea Glass" . $tg;
$keywords = "acessórios para vidros, alumínios para vidros, ferragens para vidros, kits idea glass";

$og_url = "http://www.lindevidros.com.br/acessorios";
$og_name = "Acessórios para Vidros";

$submenu_id = "A-AC";

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
                    	<h1>Acessórios</h1>
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
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pa_ferragens.jpg" alt="Ferragens">
                        <div class="caption">
                            <p id="titulo-pg">Ferragens</p>
                            <br>
                            <p><a href="<?php echo $l_ferragens; ?>" class="btn btn-primary btn-block" role="button" title="Ferragens"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pa_aluminios.jpg" alt="Alumínios">
                        <div class="caption">
                            <p id="titulo-pg">Alumínios</p>
                            <br>
                            <p><a href="<?php echo $l_aluminios; ?>" class="btn btn-primary btn-block" role="button" title="Alumínios"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/pa_idea.jpg" alt="Kits Idea Glass">
                        <div class="caption">
                            <p id="titulo-pg">Kits Idea Glass</p>
                            <br>
                            <p><a href="<?php echo $l_idea; ?>" class="btn btn-primary btn-block" role="button" title="Kits Idea Glass"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <br>
            
            <div class="row">
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

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
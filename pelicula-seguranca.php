<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT pelicula AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Película de Segurança para Vidro - Linde Vidros";

$description = "A película de segurança deixa seu vidro mais resistente e forte, proteção contra acidentes domésticos e roubos. Ideal em projetos residênciais, escritórios e box de banheiro" . $tg;
$keywords = "";

$og_url = "http://www.lindevidros.com.br/pelicula-seguranca";
$og_name = "Película de Segurança";

$submenu_id = "S-PS";

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
                    	<h1>Película de Segurança</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
    <div class="row" id="img-pg">
    	<div class="col-md-12">
        	<img src="img/img_pelicula_seguranca.jpg" alt="Película de Segurança" class="img-rounded img-responsive">
        </div>
    </div>
    <div class="row" id="conteudo">
        <div class="col-md-9">
            <p class="text-justify">A <strong>película de segurança</strong> torna seu vidro mais resistente e forte contra vandalismo e proteção contra acidentes domésticos, proteja seu patrimônio e quem você ama.</p>
            
            <p class="text-justify">Sua aplicação é ideal para projetos residenciais, escritórios e box de banheiro.</p>
            
            <p class="text-justify">A película dificulta o acesso ao estabelecimento em caso de arrombamento, inibindo assim a tentativa de roubo e vandalismo. Quando aplicada no box de banheiro, sua família ficará protegida em caso de quebra de algum vidro, pois todos os cacos ficarão fixados na película evitando acidentes.</p>
            
            <br>
            
            <div class="alert alert-info text-center" role="alert">
            	<i class="far fa-thumbs-up fa-4x"></i>
                <br>
                Utilize a <strong>Película de Segurança</strong> Linde Vidros e deixe sua obra com a mesma segurança de uma embaixada americana ou uma sede da ONU!
            </div>
            
            <br>
            
            <div class="row">
            	<div class="col-md-6">
                	<p><strong>Vantagens:</strong></p>
            
                    <ul>
                        <li>Anti-vandalismo.</li>
                        <li>Camada anti-risco com maior resistência a abrasão do mercado.</li>
                        <li>A película não rasga, e não pode ser perfurada.</li>
                        <li>Camada protetora para vidros refletivos (Habitat) monolíticos e temperados.</li>
                        <li>Estabilidade de cor (anti-amarelamento) e proteção UV de no mínimo 95%.</li>
                        <li>Processo de fabricação da película, feita 100% nos EUA.</li>
                    </ul>
                    
                    <p><strong>Modelos:</strong></p>
                    
                    <ul>
                        <li><strong>PS4:</strong> É recomendado até 120 Kg, exemplo: janelas, portas e box de banheiro.</li>
                        <li><strong>PS7:</strong> É recomendado a partir de 120 Kg, exemplo: fachadas, vitrines e peças com 1800mm x 3000mm x 10mm ou acima.</li>
                    </ul>
                </div>
                <div class="col-md-6">
                	<p class="text-center"><img src="img/pelicula_quebrada.png" alt="Película de Segurança" class="img-responsive"></p>
                    
                    <br>
                    
                    <p class="text-center"><img src="img/pelicula_uv.png" alt="Película de Segurança"></p>
                </div>
            </div>
 
            <h2>Composição da Película de Segurança</h2>
            
            <p class="text-justify">A película é composta por 4 camadas:</p>
            
            <p class="text-justify"><img src="img/pelicula_composicao.png" alt="Película de Segurança" class="img-responsive"></p>
        </div>
        <div class="col-md-3">
			<?php include_once ("includes/menu_servicos.php"); ?>
        </div>
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
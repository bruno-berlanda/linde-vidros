<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT portas_expositores AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Portas para Expositores - Linde Vidros";

$description = "Portas para Expositores Verticais em perfil em PVC de alta resistência mecânica, disponível em diversas cores utilizando vidros baixo emissivos Low-E" . $tg;
$keywords = "portas para expositores, portas para expositores verticais, vidro baixo emissivo";

$og_url = "http://www.lindevidros.com.br/portas-expositores";
$og_name = "Portas para Expositores";

$submenu_id = "R-PE";

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
                    	<h1>Portas para Expositores Verticais</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
    <div class="row" id="conteudo">
        <div class="col-md-9">
            <p class="text-justify">A Linde Vidros, inovando mais uma vez, traz para o mercado soluções em <strong>vidros Low-E</strong> temperados para aplicação em sistemas refrigerados. O <strong>vidro Low-E</strong> é melhor opção para aplicações que necessitam de controle da condensação passiva e bom desempenho térmico, com baixa emissividade, aparência incolor neutra, alta transparência e qualidade óptica possibilitando melhor visualização de alimentos e bebidas ideal para ser utilizado em portas de freezers e refrigeradores.</p>
            
            <p class="text-justify">Na indústria da refrigeração comercial, móveis especiais para exposição e acondicionamento de produtos resfriados e congelados, têm no vidro um grande aliado, possibilitando melhor visualização dos produtos e ainda assim garantindo segurança e economia de energia.</p>
            
            <p class="text-justify">Os vidros Low-E são produzidos com nanotecnologia sendo aplicado revestimento com metais nobres (Coating) em uma das faces dos vidros com ativação iônica, processo este que garante uma baixa emissividade e proporciona a redução do coeficiente de transferência térmica do vidro, conhecido como Fator U, evitando a condensação do vidro sem necessidade de aquecimento elétrico, economizando energia.</p>
            
            <br>
            
            <div class="row">
            	<div class="col-md-4">
                	<p class="text-center"><img src="img/produtos/refrigeracao_portas.jpg" alt="Portas para Expositores Verticais" class="img-thumbnail"></p>
                </div>
                <div class="col-md-8">
                	<p><strong>Características:</strong></p>
            
                    <ul>
                        <li>Perfil em PVC de alta resistência mecânica, disponível em diversas cores.</li>
                        <li>Especificação de acordo com as características de cada refrigerador e local de aplicação.</li>
                        <li>Puxador em alça ou embutido em diversas cores.</li>
                        <li>Fechamento com dobradiças laterais ou pivotantes com barra de torção.</li>
                        <li>Vidros temperados certificados pelo IFBQ seguindo a norma NBR 14698.</li>
                        <li>Vidros baixo emissivos Low-E.</li>
                        <li>Insulados com perfis de alumínio ou Duraseal.</li>
                        <li>Proporciona redução no consumo de energia.</li>
                        <li>Gaxetas isolantes nas cores cinza e preta, para melhor desempenho térmico.</li>
                    </ul>
                </div>
            </div>
            
            <br>
            
            <div class="well">
            	<p class="text-justify">A Linde Vidros produz vidros comuns e temperados planos baixo emissivos para sistemas refrigerados, podendo ser aplicados em adegas, gôndolas, freezers, expositores, ilhas, cervejeiras, balcões, vitrines, entre outros para média e baixa temperatura.</p>
            </div>
            
            <br>
            
            <table class="table">
            	<thead>
                    <tr>
                        <th>VIDRO INSULADO (DUPLO)</th>
                        <th>FATOR U (W/m².K)</th>
                    </tr>
                </thead>
                <tbody>
                	<tr>
                    	<td>Incolor 4mm <span class="label label-default">+</span> Câmera 12mm com argônio <span class="label label-default">+</span> Incolor 4mm</td>
                        <td>2,6</td>
                    </tr>
                    <tr>
                    	<td>Planitherm 4mm <span class="label label-default">+</span> Câmera 12mm com argônio <span class="label label-default">+</span> Incolor 4mm</td>
                        <td>1,4</td>
                    </tr>
                    <tr>
                    	<td>Planitherm 4mm <span class="label label-default">+</span> Câmera 12mm com argônio <span class="label label-default">+</span> Planitherm 4mm</td>
                        <td>1,3</td>
                    </tr>
                </tbody>
            </table>
            
            <br>
            
            <p><i class="fa fa-plus-square" aria-hidden="true"></i> Saiba mais sobre o <a href="<?php echo $l_insulado; ?>" title="Vidro Insulado">vidro insulado</a>.</p>
        </div>
        <div class="col-md-3">
			<?php include_once ("includes/menu_refrigeracao_produtos.php"); ?>
        </div>
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
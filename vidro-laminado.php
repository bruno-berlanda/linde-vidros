<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT vidro_laminado AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Vidro Laminado, segurança e proteção - Linde Vidros";

$description = "O vidro laminado, une a qualidade de dois vidros de segurança formando um produto ainda mais resistente e com maior conforto acústico" . $tg;
$keywords = "Vidro Laminado, Vidros Laminados, Conforto Acústico, Vidro Laminado Temperado, Vidro Resistente, Linde Vidros, distribuidora de vidro, beneficiadora de vidro, fábrica de vidro";

$og_url = "https://www.lindevidros.com.br/vidro-laminado";
$og_name = "Vidro Laminado";

$submenu_id = "E-VL";

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
                        <h1 class="text-azul-linde">Vidro Laminado</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-3">
    	<div class="col-md-12">
        	<img src="img/img_laminado.jpg" alt="Vidro Laminado" class="rounded img-fluid">
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-9">
            <p class="text-justify">O <strong>vidro laminado</strong> é composto por duas ou mais placas de vidro, que são unidas por uma ou mais camadas intermediárias chamadas de interlayers. Quando quebrado, os estilhaços ficam presos à essa camada intermediária. Esta característica produz o efeito de uma "teia de aranha" quando o impacto não é totalmente suficiente para furar o vidro.</p>
            
            <p class="text-justify">É normalmente utilizado quando existe uma possibilidade de impacto humano, como em para-brisas de automóveis, e onde se deseja ter maior segurança, como em janelas e vitrines, ou onde não pode cair o vidro quebrado, como em claraboias e corrimãos.</p>
            
            <p class="text-justify">O <strong>vidro laminado</strong> bloqueia 99% dos raios UV, prevenindo o desbotamento dos móveis e o câncer de pele.</p>
            
            <p><strong>Vantagens:</strong></p>
            
            <ul>
            	<li>Não estilhaça quando quebrado</li>
                <li>Proteção UV</li>
                <li>Atenuação Acústica</li>
            </ul>
            
            <h2>Vidro Laminado Temperado</h2>
            
            <p class="text-justify">Com a segurança na construção civil ficando cada vez mais exigida, novas tecnologias vão sendo utilizadas para suprir a necessidades de quem está construindo. Uma dessas tecnologias é o <strong>vidro laminado temperado</strong>, que une a qualidade de dois vidros de segurança formando um produto ainda mais resistente e com maior conforto acústico.</p>
            
            <p class="text-justify">Com linha de laminação própria, a Linde Vidros oferece mais opções para o seu <strong>vidro laminado</strong>, como recortes e furos.</p>
            
            <h2>Vidro Multilaminado</h2>
            
            <p class="text-justify">O <strong>vidro multilaminado</strong> pode ser considerado um sanduíche de vidros reforçado, já que em sua fabricação são utilizadas duas ou mais lâminas de vidro intercaladas por uma ou mais camadas de polivinil butiral (PVB). Os vidros comercialmente chamados de anti-vandalismo ou anti-intrusivo são vidros multilaminados. É indicado para ambientes que necessitam de proteção reforçada, tais como bancos, vitrines de lojas, guaritas, joalherias, piso, visores de piscina entre outros.</p>
            
            <h2>Interlayers</h2>
            
            <p>Temos a opção dos seguintes interlayers para o vidro laminado:</p>
            
            <dl class="dl-horizontal">
                <dt>PVB Incolor</dt>
                <dd>É o interlayer mais comum, 100% incolor, que permite a passagem de luz, mas bloqueia os raios UV.</dd>
                
                <dt>PVB Opaco</dt>
                <dd>Este PVB é parcialmente translúcido, bloqueando 32% de luminosidade, ideal para quem quer conciliar privacidade e segurança.</dd>
                
                <dt>PVB Branco Blackout</dt>
                <dd>Este PVB bloqueia 93% da luminosidade, proporcionando um efeito blackout em um elegante vidro branco ideal para quem quer conciliar privacidade e segurança.</dd>
                
                <dt>PVB Acústico</dt>
                <dd>Ideal para quem procura conforto ambiental. Com o PVB acústico o ruído percebido é reduzido em até 50%, por causa do seu sistema avançado de três camadas projetado para desacoplar e difundir as ondas sonoras para melhorar o desempenho da atenuação do som.</dd>
                
                <dt>SentryGlas</dt>
                <dd>É um interlayer mais resistente e seguro. Saiba mais <a href="<?php echo $l_sentryglas; ?>" title="SentryGlas">clicando aqui</a>.</dd>
            </dl>
            
            <br>
            
            <table class="table">
                <tbody>
                    <tr>
                        <td><p class="text-center"><strong>Dimensão Mínima</strong> <br> 600 x 300</p></td>
                        <td><p class="text-center"><strong>Dimensão Máxima</strong> <br> 5500 x 2600</p></p></td>
                        <td><p class="text-center"><strong>Espessuras</strong> <br> 6 à 60 mm</p></p></td>
                    </tr>
                    <tr class="active">
                        <td colspan="3"><p class="text-center"><strong>Chaparia</strong> <br> Consultar o departamento comercial sobre os tamanhos disponíveis</p></td>
                    </tr>
                </tbody>
            </table>
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
                    <a href="img/produtos/grande/laminado1.jpg" rel="shadowbox[vocation]" title="Vidro Laminado">
                        <img src="img/produtos/miniatura/laminado1.jpg" alt="Vidro Laminado" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/laminado2.jpg" rel="shadowbox[vocation]" title="Vidro Laminado">
                        <img src="img/produtos/miniatura/laminado2.jpg" alt="Vidro Laminado" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/laminado3.jpg" rel="shadowbox[vocation]" title="Vidro Laminado">
                        <img src="img/produtos/miniatura/laminado3.jpg" alt="Vidro Laminado" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/laminado4.jpg" rel="shadowbox[vocation]" title="Vidro Laminado">
                        <img src="img/produtos/miniatura/laminado4.jpg" alt="Vidro Laminado" class="img-fluid img-thumbnail">
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
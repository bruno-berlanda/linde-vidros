<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT sentryglas AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "SentryGlas - Linde Vidros";

$description = "Vidro SentryGlas, altíssima resistência e segurança, protege contra tempestades, impactos e explosões, proteção aos raios UV, transparência, eficiência energética" . $tg;
$keywords = "sentryglas, vidro de proteção, vidro de segurança, vidro resistente, vidro anti-furto, distribuidora de vidro, beneficiadora de vidro, fábrica de vidro";

$og_url = "https://www.lindevidros.com.br/sentryglas";
$og_name = "SentryGlas";

$submenu_id = "E-ST";

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
                        <h1 class="text-azul-linde">SentryGlas</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-3">
    	<div class="col-md-12">
        	<img src="img/img_sentryglas.jpg" alt="SentryGlas" class="rounded img-fluid">
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-9">
            <p class="text-justify">Originalmente criado para mercados especializados, tais como o de vidros de alta segurança e o de janelas resistentes a furacões, os <a href="<?php echo $l_laminado; ?>" title="Vidro Laminado">vidros laminados</a> com <strong>SentryGlas</strong> são também especificados para vidros de alto desempenho.</p>
            
            <p class="text-justify">O interlayer <strong>SentryGlas</strong> é um Ionômero, que ajuda a criar o mais leve e mais seguro <em>vidro laminado</em>. Este interlayer é cinco vezes mais forte e cem vezes mais duro do que os materiais de laminação convencionais. Com este tipo de resistência, o vidro laminado fica mais resistente, protegendo contra tempestades, impactos e explosões poderosas.</p>
            
            <p class="text-justify">São usados em <em>vidro laminado</em> para ajudar arquitetos e fabricantes de sistemas de construção envidraçada atender a necessidade da sociedade para a segurança, a eficiência energética, segurança e facilidade de manutenção. Ele ajuda os construtores a fazerem mais com menos, a criação de novos espaços inovadores, prevendo uma maior proteção para os ocupantes dos edifícios.</p>
            
            <br>
            
            <p><strong>Vantagens:</strong></p>
            
            <ul>
            	<li>Liberdade no desenho: vidros mais finos, painéis maiores, economia em perfis</li>
                <li>Proteção e segurança: anti-intrusivo</li>
                <li>Proteção contra raios UV</li>
                <li>Transparência excepcional</li>
                <li>Durabilidade única</li>
                <li>Até 5 vezes mais resistente e 100 vezes mais rígido que um PVB comum de mesma espessura</li>
                <li>Maior estabilidade da borda, podendo ser aplicado com borda exposta sem perigo de delaminação</li>
                <li>Resistente à água, sol, intempéries, chuva e neve, quando aplicado com borda exposta</li>
                <li>Mantém a resistência mecânica em temperaturas superiores ao que do PVB</li>
                <li>Vidros mais leves, resistentes e seguros</li>
                <li>Menor deflexão e um vidro mais resistente antes e depois da quebra</li>
                <li>Vidro parafusado e sem caixilhos</li>
                <li>Bordas expostas e seguras</li>
                <li>Compatibilidade com selantes</li>
                <li>Proteção constante</li>
                <li>Mais segurança, menos preocupação</li>
                <li>Um produto perfeitamente transparente</li>
                <li>Laminados com vidros extra claros</li>
            </ul>
            
            <br>
            
            <p class="text-justify">Mais resistente e rígido do que os materiais laminados tradicionais, o <strong>SentryGlas</strong> ajuda a criar vidros de segurança que suportam maiores cargas de vento e oferecem uma maior proteção contra impactos. Agindo como um componente de engenharia no vidro, suporta um peso maior, assumindo um papel estrutural mais ativo nas fachadas dos edifícios, aumentando a liberdade na hora de projetar sistemas de fixação.</p>
            
            <p class="text-justify">Além disso, o <strong>SentryGlas</strong> melhora a resistência à ação do tempo a longo prazo nos sistemas com vidro laminado.</p>
            
            <p class="text-justify">Com ele os arquitetos criam espaços inovadores ao mesmo tempo em que oferecem maior segurança e performance.</p>
            
            <br>
            
            <div class="alert alert-info text-center" role="alert">
                <i class="fa-regular fa-thumbs-up fa-4x"></i>
                <br><br>
                Ao contrário de um vidro com PVB comum, que ao se quebrar acaba caindo como um tapete, o vidro com SentryGlas mantem-se na vertical, evitando possíveis acidentes e garantindo segurança mesmo após quebrado.
                
                <br><br>
                
                <img src="img/produtos/sentryglas.jpg" alt="SentryGlas" class="rounded img-fluid">
            </div>
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
                    <a href="img/produtos/grande/sentryglas1.jpg" rel="shadowbox[vocation]" title="SentryGlas">
                        <img src="img/produtos/miniatura/sentryglas1.jpg" alt="SentryGlas" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/sentryglas2.jpg" rel="shadowbox[vocation]" title="SentryGlas">
                        <img src="img/produtos/miniatura/sentryglas2.jpg" alt="SentryGlas" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/sentryglas3.jpg" rel="shadowbox[vocation]" title="SentryGlas">
                        <img src="img/produtos/miniatura/sentryglas3.jpg" alt="SentryGlas" class="img-fluid img-thumbnail">
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
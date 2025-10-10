<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT vidro_insulado AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Vidro Insulado, proteção térmica e acústica - Linde Vidros";

$description = "A solução mais avançada para melhorar o desempenho térmico e acústico residencial, vidro insulado" . $tg;
$keywords = "Vidro Insulado, Vidros Insulado, Duraseal, Desempenho Têrmico, Acústico, Linha Ekoglass, distribuidora de vidro, beneficiadora de vidro, fábrica de vidro";

$og_url = "https://www.lindevidros.com.br/vidro-insulado";
$og_name = "Vidro Insulado";

$submenu_id = "E-VI";

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
                        <h1 class="text-azul-linde">Vidro Insulado</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-3">
    	<div class="col-md-12">
        	<img src="img/img_insulado.jpg" alt="Vidro Insulado" class="rounded img-fluid">
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-9">
            <p class="text-justify">O <strong>vidro insulado</strong> é uma solução formada por duas placas de vidro plano paralelas, separadas por um espaçador, com as bordas hermeticamente seladas ao longo de todo seu perímetro, formando em seu interior uma câmera estanque e desidratada. São ideais para obter conforto térmico, já que há a redução da troca de calor e atenuação sonora dos vidros com o ambiente e ao mesmo tempo conseguir o máximo de luz natural.</p>
            
            <p class="text-justify">Em parceria com a Pilkington, a Linde Vidros se tornou a primeira franqueada do Brasil a desenvolver os vidros insulados (duplo termo-acústico) da linha Ekoglass.</p>
            
            <p class="text-justify">Com o <strong>vidro insulado</strong> você encontra a solução mais avançada para melhorar o desempenho térmico e acústico das superfícies com vidro numa residência.</p>
            
            <br>
            
            <p><strong>Vantagens:</strong></p>
            
            <div class="row">
            	<div class="col-md-3">
                	<p><i class="fa-solid fa-temperature-half fa-fw text-secondary"></i> <strong class="text-primary">TÉRMICO</strong></p>
                    
                    <ul>
                    	<li>Aumento de mais de 100% de isolamento térmico</li>
                        <li>Elimina a condensação de umidade sobre o vidro (vidros com alta performance)</li>
                        <li>Bloqueia o efeito de "muro frio" e aumenta o conforto junto ao vidro</li>
                    </ul>
                </div>
                <div class="col-md-3">
                	<p><i class="fa-solid fa-shield-halved fa-fw text-secondary"></i> <strong class="text-primary">SEGURANÇA</strong></p>
                    
                    <ul>
                    	<li>Segurança contra cortes e acidentes (quando laminado ou temperado)</li>
                        <li>Segurança com a utilização de vidros temperados ou laminados</li>
                    </ul>
                </div>
                <div class="col-md-3">
                	<p><i class="fa-solid fa-volume-high fa-fw text-secondary"></i> <strong class="text-primary">ACÚSTICO</strong></p>
                    
                    <ul>
                    	<li>Melhora o desempenho acústico</li>
                        <li>Diminui a passagem de ruídos para dentro do ambiente, tais como ruídos urbanos e trânsito</li>
                        <li>Atinge os padrões da norma de Desempenho Acústico em Edificações Habitacionais ABNT NBR 15575:2013</li>
                    </ul>
                </div>
                <div class="col-md-3">
                	<p><i class="fa-solid fa-sun fa-fw text-secondary"></i> <strong class="text-primary">PROTEÇÃO SOLAR</strong></p>
                    
                    <ul>
                    	<li>Diminui em até 70% as perdas de calor através do vidro, economizando energia do ar-condicionado</li>
                        <li>Protege móveis e qualquer objeto exposto ao sol, pois impede a entrada de raios UV em 99% quando laminados</li>
                        <li>Maior privacidade e conforto, pois reduz a entrada de luz no ambiente</li>
                        <li>Protege sua família dos danos causados pelos raios UV</li>
                    </ul>
                </div>
            </div>
            
            <h2>Tipos de Vidro Insulado</h2>
            
            <h3>Perfil de Alumínio</h3>
            
            <p class="text-justify">Formado por dois vidros separados entre si por uma câmara de ar desidratado, a separação entre os vidros é definida por um <em>Perfil de Alumínio</em>, cujo interior se aloja o produto dissecante (Sílica) e a estanqueidade está assegurada por um duplo selante perimetral a base de selantes orgânicos. Esse tipo de vidro constitui um excelente isolante térmico e acústico e pode incorporar no interior diferentes espessuras de câmara conforme especificação do cliente.</p>
            
            <h2>Vidro Insulado com Persiana Integrada</h2>
            
            <p class="text-justify">Além de todas as vantagens que o <strong>vidro insulado</strong> oferece, você pode adquirir este vidro com a persiana integrada. Esta persiana fica dentro da câmera de ar (entre os dois vidros), deixando-as protegidas e as mantendo como novas por décadas.</p>
            
            <h2>Overlap</h2>
            
            <p class="text-justify"><img src="img/produtos/overlap.png" alt="Linde Vidros" class="img-fluid float-start me-4 mb-4"> <strong>Overlap</strong> é um vidro duplo utilizado para fachadas onde uma das peças excede o tamanho da outra, ficando sobreposto nas esquadrias, dando um visual de envidraçamento sobre toda a fachada.</p>
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
                    <a href="img/produtos/grande/insulado2.jpg" rel="shadowbox[vocation]" title="Vidro Insulado">
                        <img src="img/produtos/miniatura/insulado2.jpg" alt="Vidro Insulado" class="img-fluid img-thumbnail">
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
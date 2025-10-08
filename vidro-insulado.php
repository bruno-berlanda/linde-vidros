<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT vidro_insulado AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Vidro Insulado, proteção térmica e acústica - Linde Vidros";

$description = "A solução mais avançada para melhorar o desempenho térmico e acústico residencial, vidro insulado" . $tg;
$keywords = "Vidro Insulado, Vidros Insulado, Duraseal, Desempenho Têrmico, Acústico, Linha Ekoglass, distribuidora de vidro, beneficiadora de vidro, fábrica de vidro";

$og_url = "http://www.lindevidros.com.br/vidro-insulado";
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
	<div class="row" id="titulo">
    	<div class="col-md-12">
        	<div class="container">
            	<div class="row">
                    <div class="col-md-12">
                    	<h1>Vidro Insulado</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
    <div class="row" id="img-pg">
    	<div class="col-md-12">
        	<img src="img/img_insulado.jpg" alt="Vidro Insulado" class="img-rounded img-responsive">
        </div>
    </div>
    <div class="row" id="conteudo">
        <div class="col-md-9">
            <p class="text-justify">O <strong>vidro insulado</strong> é uma solução formada por duas placas de vidro plano paralelas, separadas por um espaçador, com as bordas hermeticamente seladas ao longo de todo seu perímetro, formando em seu interior uma câmera estanque e desidratada. São ideais para obter conforto térmico, já que há a redução da troca de calor e atenuação sonora dos vidros com o ambiente e ao mesmo tempo conseguir o máximo de luz natural.</p>
            
            <p class="text-justify">Em parceria com a Pilkington, a Linde Vidros se tornou a primeira franqueada do Brasil a desenvolver os vidros insulados (duplo termo-acústico) da linha Ekoglass.</p>
            
            <p class="text-justify">Com o <strong>vidro insulado</strong> você encontra a solução mais avançada para melhorar o desempenho térmico e acústico das superfícies com vidro numa residência.</p>
            
            <br>
            
            <p><strong>Vantagens:</strong></p>
            
            <div class="row">
            	<div class="col-md-3">
                	<p class="text-danger"><i class="fas fa-thermometer-half"></i> <strong>TÉRMICO</strong></p>
                    
                    <ul>
                    	<li>Aumento de mais de 100% de isolamento térmico</li>
                        <li>Elimina a condensação de umidade sobre o vidro (vidros com alta performance)</li>
                        <li>Bloqueia o efeito de "muro frio" e aumenta o conforto junto ao vidro</li>
                    </ul>
                </div>
                <div class="col-md-3">
                	<p class="text-danger"><i class="fas fa-unlock"></i> <strong>SEGURANÇA</strong></p>
                    
                    <ul>
                    	<li>Segurança contra cortes e acidentes (quando laminado ou temperado)</li>
                        <li>Segurança com a utilização de vidros temperados ou laminados</li>
                    </ul>
                </div>
                <div class="col-md-3">
                	<p class="text-danger"><i class="fas fa-volume-up"></i> <strong>ACÚSTICO</strong></p>
                    
                    <ul>
                    	<li>Melhora o desempenho acústico</li>
                        <li>Diminui a passagem de ruídos para dentro do ambiente, tais como ruídos urbanos e trânsito</li>
                        <li>Atinge os padrões da norma de Desempenho Acústico em Edificações Habitacionais ABNT NBR 15575:2013</li>
                    </ul>
                </div>
                <div class="col-md-3">
                	<p class="text-danger"><i class="fas fa-sun"></i> <strong>PROTEÇÃO SOLAR</strong></p>
                    
                    <ul>
                    	<li>Diminui em até 70% as perdas de calor através do vidro, economizando energia do ar-condicionado</li>
                        <li>Protege móveis e qualquer objeto exposto ao sol, pois impede a entrada de raios UV em 99% quando laminados</li>
                        <li>Maior privacidade e conforto, pois reduz a entrada de luz no ambiente</li>
                        <li>Protege sua família dos danos causados pelos raios UV</li>
                    </ul>
                </div>
            </div>
            
            <h2>Tipos de Vidro Insulado</h2>
            
            <br>
            
            <div class="row">
            	<div class="col-md-4">
                	<img src="img/produtos/insulado_duraseal.jpg" alt="Vidro Insulado" class="img-responsive img-rounded">
                    <small>Duraseal</small>
                </div>
                <div class="col-md-4">
                	<img src="img/produtos/insulado_triseal.jpg" alt="Vidro Insulado" class="img-responsive img-rounded">
                    <small>Triseal</small>
                </div>
                <div class="col-md-4">
                	<img src="img/produtos/insulado_aluminio.jpg" alt="Vidro Insulado" class="img-responsive img-rounded">
                    <small>Perfil de Alumínio</small>
                </div>
            </div>
            
            <br>
            
            <h3>Duraseal</h3>
            
            <p class="text-justify">Em um dia quente de verão, a superfície interna do vidro de uma janela ineficiente transmitirá a temperatura do exterior, fazendo com que seus gastos com ar condicionado sejam maiores. Janelas feitas com Duraseal reduzem a transferência de calor e melhoram a qualidade do insulamento do vidro de sua janela.</p>
            
            <p class="text-justify">A utilização do <em>Duraseal</em> como espaçador flexível orgânico garante o melhor desempenho térmico e acústico de sua janela, trata-se de um sistema espaçador versátil e de alta durabilidade, construído com a tecnologia de laminação composta na qual já possui em sua massa, o espaçador, o adesivo e o dessecante. O desenho único do Duraseal incorpora um reforço de polímero que garante superfícies e quinas lisas e limpas para o melhor acabamento. Por possuir todos os componentes necessários à aplicação e vedação embutidos em um único produto, a utilização do espaçador Duraseal favorece a eficiência do processo produtivo dos vidros duplos, além de aumentar a vida útil do produto.</p>
            
            <dl class="dl-horizontal">
                <dt>Espaçador embutido</dt>
                <dd>Espaçador único, composto por itens flexíveis e ao mesmo tempo incompressíveis e estáveis.</dd>
                
                <dt>Adesivos de juntas</dt>
                <dd>Adesivo de alto rendimento que oferece resistência excepcional à transmissão de gases e vapores de umidade.</dd>
                
                <dt>Recobrimento dessecante</dt>
                <dd>O dessecante concentrado na camada superior absorve a umidade de dentro da câmara.</dd>
                
                <dt>Aplicação básica</dt>
                <dd>Para aplicações na produção de sistemas de Vidro Duplo Ekoglass com processos controlados e fabricados com selagem quente e por compressão. Desenhado com sistemas de selagem simples, Duraseal também pode ser utilizado com sistemas de selagem duplos.</dd>
            </dl>
            
            <br>
            
            <div class="alert alert-info text-center" role="alert">
            	<i class="far fa-thumbs-up fa-4x"></i>
                <br>
                A Linde Vidros é certificada no processo de fabricação do <strong>Duraseal</strong> pela <em>Quanex</em>.
            </div>
            
            <br>
            
            <h3>Triseal</h3>
            
            <p class="text-justify">Trata-se de um projeto de vedação tripla, adequado para envidraçamento estrutural comercial, que consiste em um espaçador em silicone termorrígido que incorpora o dessecante 3A integral, adesivo pré-aplicado para adesão do vidro, vedação primária de polisobutileno e vedação estrutural. O Triseal é um espaçador de silicone flexível desenvolvido para satisfazer as mais exigentes demandas de vidros comerciais, incluindo envidraçamento estrutural.</p>
            
            <h3>Perfil de Alumínio</h3>
            
            <p class="text-justify">Formado por dois vidros separados entre si por uma câmara de ar desidratado, a separação entre os vidros é definida por um <em>Perfil de Alumínio</em>, cujo interior se aloja o produto dissecante (Sílica) e a estanqueidade está assegurada por um duplo selante perimetral a base de selantes orgânicos. Esse tipo de vidro constitui um excelente isolante térmico e acústico e pode incorporar no interior diferentes espessuras de câmara conforme especificação do cliente.</p>
            
            <h2>Vidro Insulado com Persiana Integrada</h2>
            
            <p class="text-justify">Além de todas as vantagens que o <strong>vidro insulado</strong> oferece, você pode adquirir este vidro com a persiana integrada. Esta persiana fica dentro da câmera de ar (entre os dois vidros), deixando-as protegidas e as mantendo como novas por décadas.</p>
            
            <h2>Overlap</h2>
            
            <p class="text-justify"><img src="img/produtos/overlap.png" alt="Linde Vidros" class="img-responsive" id="img-esquerda"> <strong>Overlap</strong> é um vidro duplo utilizado para fachadas onde uma das peças excede o tamanho da outra, ficando sobreposto nas esquadrias, dando um visual de envidraçamento sobre toda a fachada.</p>
        </div>
        <div class="col-md-3">
			<?php include_once ("includes/menu_engenharia_produtos.php"); ?>
        </div>
    </div>
    
    <div class="row" id="conteudo">
    	<div class="col-md-12">
        	<hr>
            
            <div class="row">
                <div class="col-xs-4 col-md-2">
                    <a href="img/produtos/grande/insulado1.jpg" rel="shadowbox[vocation]" title="Vidro Insulado" class="thumbnail">
                    <img src="img/produtos/miniatura/insulado1.jpg" alt="Vidro Insulado">
                    </a>
                </div>
                <div class="col-xs-4 col-md-2">
                    <a href="img/produtos/grande/insulado2.jpg" rel="shadowbox[vocation]" title="Vidro Insulado" class="thumbnail">
                    <img src="img/produtos/miniatura/insulado2.jpg" alt="Vidro Insulado">
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
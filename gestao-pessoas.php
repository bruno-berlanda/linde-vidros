<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT gestao_pessoas AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Gestão de Pessoas - Linde Vidros";

$description = "A Linde Vidros busca parceria com seus colaboradores, para juntos perseguirem os objetivos e metas com profissionalismo e ética, visando aumentar a satisfação dos clientes, funcionários e cidadãos" . $tg;
$keywords = "gestão de pessoas linde vidros, trabalhar na linde vidros";

$og_url = "https://www.lindevidros.com.br/gestao-pessoas";
$og_name = "Gestão de Pessoas";

$submenu_id = "GESTAO";

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
                        <h1 class="text-azul-linde">Gestão de Pessoas</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row my-4">
        <div class="col-md-12">
        	<p class="text-justify">A <strong>Linde Vidros</strong> desenvolve parceria com seus colaboradores, para juntos conquistarmos os objetivos e metas, com profissionalismo e ética, visando a satisfação dos clientes, funcionários e cidadãos.</p>
            
            <br>
            
            <p class="text-center"><img src="img/empresa/colaboradores.jpg" alt="50 Anos Linde Vidros" class="img-fluid img-thumbnail"></p>
            
            <br>
            
            <h2>O que oferecemos aos nossos colaboradores</h2>
            
            <p class="text-justify"><strong>Programas de capacitação e treinamento:</strong> Através de parcerias com instituições de ensino, a Linde Vidros oferece cursos gratuitos ou parcialmente pagos tais como: Alfabetização digital e informática básica.</p>
            
            <p class="text-justify"><strong>Treinamentos diversos:</strong> É oferecida uma variedade de treinamentos internos, visando à capacitação dos colaboradores, preparando-os desta forma para melhor desempenhar sua função ou capacitando-os para um novo cargo.</p>
            
            <h3>Sistema de Remuneração e Benefícios</h3>
            
            <p class="text-justify"><strong>Remuneração:</strong> Os valores oferecidos são baseados no piso da categoria de cada cargo. A Linde Vidros possui <em>Plano de Cargos e Salários</em>, onde anualmente os funcionários passam por avaliações de desempenho, sendo avaliado aspectos comportamentais, produção, assiduidade e técnicas segundo a função. Conforme resultado, poderá acessar nova faixa salarial.</p>
            
            <p class="text-justify"><strong>Plano médico/odontológico:</strong> Oferecido convênio com <em>Unimed</em> e <em>Sesi</em>, ambos são opcionais, pois há contrapartida do funcionário para aderir e manter esse benefício.</p>
            
            <p class="text-justify"><strong>Alimentação:</strong> Possui refeitório próprio com cardápio diferenciado a cada dia, supervisionado por nutricionista. Há contrapartida do colaborador no custeio da alimentação, conforme determina a legislação.</p>
            
            <p class="text-justify"><strong>Transporte:</strong> É oferecido vale transporte, conforme legislação, para facilitar o deslocamento dos colaboradores de suas residências até a empresa.</p>
            
            <p class="text-justify"><strong>Vale cesta básica:</strong> Benefício oferecido aos colaboradores para estimular a assiduidade ao trabalho.</p>
            
            <p class="text-justify"><strong>Auxílio-educação:</strong> A empresa disponibiliza de auxílio-educação para cursos técnicos, graduação, pós-graduação e cursos de extensão. Para acessar este benefício, o colaborador deverá possuir bom desempenho profissional e dedicação ao trabalho, que serão analisados e aprovados por comissão especifica.</p>
            
            <p class="text-justify"><strong>Convênio SESI e SENAI:</strong> Para educação de jovens e adultos, além dos cursos e eventos oferecidos por estas instituições.</p>
            
            <p class="text-justify"><strong>Plano de Cargos e Salários:</strong> Descreve cada função possibilitando analisar e equalizar a estrutura de cargos e funções. Definindo de forma clara as regras para a progressão de salários e de promoções de funções, uma vez que estabelece parâmetros técnicos e justos para a diferenciação da remuneração entre os colaboradores e os cargos.</p>
            
            <p class="text-justify"><strong>Política de recrutamento interno:</strong> A empresa possui Política de Recrutamento Interno, visando identificar primeiramente em seu quadro de colaboradores, bons profissionais para preencher as vagas. Para isso, é necessário que o empregado se capacite constantemente.</p>
            
            <p class="text-justify"><strong>Convênio com Universidade e Academia:</strong> Estas instituições oferecem desconto nas mensalidades para os funcionários que comprovem vínculo empregatício com a Linde Vidros.</p>
            
            <p class="text-justify"><strong>Seguro de vida:</strong> A empresa mantém apólice de seguro de vida para os colaboradores.</p>
            
            <h3>Eventos em Datas Especiais</h3>
            
            <p class="text-justify"><strong>Dias das Crianças:</strong> Para os filhos dos colaboradores é realizada uma festa para comemorar o dia das crianças (mês de outubro). Este evento tem o objetivo de oferecer recreação as crianças, além de propiciar o encontro das famílias dos colaboradores.</p>
            
            <p class="text-justify"><strong>Páscoa, Natal, Dia Internacional da Mulher, Dia do Trabalho, Aniversário dos Colaboradores, entre outras datas:</strong> São oferecidos brindes ou realizado momentos de confraternização entre todos os colaboradores.</p>
            
            <p class="text-justify"><strong>SIPAT:</strong> Ações e palestras que estimulam a melhoria na qualidade de vida e a redução dos acidentes de trabalho.</p>
            
            <p class="text-justify"><strong>Outubro Rosa:</strong> Ações sobre saúde da mulher.</p>
            
            <p class="text-justify"><strong>Novembro Azul:</strong> Ações sobre saúde do homem.</p>
            
            <h3>Visita da Família na Empresa</h3>
            
            <p class="text-justify">Propiciando o estreitamento dos laços entre a empresa, o funcionário e a família, a Linde Vidros realiza o Dia da Visita da Família. Nesse dia os funcionários e seus familiares são recepcionados com um saboroso café da manhã, em seguida, há apresentação sobre a empresa e é realizado uma palestra que gere reflexões sobre as vida familiar. Após todos os convidados visitam as dependências da empresa.</p>
            
            <h3>Ações Sociais</h3>
            
            <p class="text-justify">A Linde Vidros desenvolve ações sociais no Lar do Idoso e na APAE, ambos em Rio Negro/PR. O principal objetivo é estimular e apoiar os colaboradores no exercício da cidadania, mobilizando-os para ações voluntárias. As ações sociais podem ser através de visitas dos colaboradores as instituições ou participação e envolvimento nas ações desenvolvidas pela própria instituição.</p>
            
            <hr>
            
			<h2>Trabalhe Conosco</h2>
            
            <?php include_once ("includes/trabalhe.php"); // Trabalhe Conosco ?>
            </div>
        </div>
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
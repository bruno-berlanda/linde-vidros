<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT serigrafia AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Vidro Serigrafado - Linde Vidros";

$description = "O Vidro Serigrafado tem resistência, durabilidade e acabamento nobre, ideal para cozinhas, salas de jantar e dormitórios. O Vidro Marmorizado amplia as opções de decoração de casas" . $tg;
$keywords = "Vidro Serigrafado, Vidros Serigrafados, Serigrafia, Serigrafado, Serigrafados, Vidro Marmorizado, Linde Vidros";

$og_url = "https://www.lindevidros.com.br/serigrafia";
$og_name = "Vidro Serigrafado";

$submenu_id = "S-SR";

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
                        <h1 class="text-azul-linde">Serigrafia</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-3">
    	<div class="col-12">
        	<img src="img/img_serigrafado.jpg" alt="Vidro Serigrafado" class="rounded img-fluid">
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-9">
            <p class="text-justify">O <strong>vidro serigrafado</strong> recebe uma camada de tinta cerâmica que no momento da tempera se fundem, resultando em resistência, durabilidade e um acabamento nobre. Devido a suas qualidades, pode ser utilizado até mesmo como revestimento de parede substituindo o azulejo.</p>
            
            <p class="text-justify">O serviço de <strong>serigrafia</strong> pode ser trabalhado de duas formas, sendo a <em>serigrafia temperada</em> ou em <em>pintura fria</em>. No caso da serigrafia temperada, se trata de tinta cerâmica que no processo de têmpera, funde ao vidro, não podendo ser removida, sendo uma pintura de alta resistência a riscos e manchas. Quanto a pintura fria, é uma excelente opção para cozinhas, salas de jantar e dormitórios para vidros de maiores dimensões e que não podem ter nenhum tipo de ondulação ou imperfeição, trazendo sofisticação e requinte aos ambientes.</p>
            
            <p><strong>Vantagens:</strong></p>
            
            <ul>
            	<li>Pode ser pintado em qualquer cor</li>
                <li>Alta resistência e aderência da tinta</li>
                <li>Acabamento nobre</li>
            </ul>
            
            <p><strong>Aplicação:</strong></p>
            
            <ul>
            	<li>Decoração de casas, escritórios e bancos</li>
            </ul>
            
            <br>
            
            <h2>Tipos de Serigrafia</h2>
            
            <h3>Vidro Serigrafado por Máquina</h3>
            
            <div class="row">
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_am3198.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado Amarelo">
                        <img src="img/produtos/miniatura/serigrafado_am3198.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_az553.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado Azul">
                        <img src="img/produtos/miniatura/serigrafado_az553.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_az554.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado Azul">
                        <img src="img/produtos/miniatura/serigrafado_az554.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_br549.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado Jato">
                        <img src="img/produtos/miniatura/serigrafado_br549.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_br550.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado Branco">
                        <img src="img/produtos/miniatura/serigrafado_br550.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_fd6202.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado Fendi">
                        <img src="img/produtos/miniatura/serigrafado_fd6202.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_lr557.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado Laranja">
                        <img src="img/produtos/miniatura/serigrafado_lr557.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_pr555.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado Preto">
                        <img src="img/produtos/miniatura/serigrafado_pr555.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_tb518.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado Tabaco">
                        <img src="img/produtos/miniatura/serigrafado_tb518.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_vm651.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado Vermelho">
                        <img src="img/produtos/miniatura/serigrafado_vm651.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_vr558.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado Verde">
                        <img src="img/produtos/miniatura/serigrafado_vr558.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_rx212.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado Roxo">
                        <img src="img/produtos/miniatura/serigrafado_rx212.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
            </div>
            
            <p class="text-justify"><em>Outras cores, favor consultar o departamento comercial.</em></p>
            
            <p class="text-justify">Tamanho Máximo: 1700 x 3000 mm. <strong>Atenção:</strong> Dimensional máximo para a serigrafia Jato [BR549] 1300 x 3000 mm.</p>
            
            <h3>Vidro Serigrafado por Tela</h3>
            
            <div class="row">
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_tela1.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado">
                        <img src="img/produtos/miniatura/serigrafado_tela1.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_tela2.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado">
                        <img src="img/produtos/miniatura/serigrafado_tela2.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_tela3.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado">
                        <img src="img/produtos/miniatura/serigrafado_tela3.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_tela4.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado">
                        <img src="img/produtos/miniatura/serigrafado_tela4.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_tela5.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado">
                        <img src="img/produtos/miniatura/serigrafado_tela5.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_tela6.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado">
                        <img src="img/produtos/miniatura/serigrafado_tela6.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado_tela7.jpg" rel="shadowbox[vocation]" title="Vidro Serigrafado">
                        <img src="img/produtos/miniatura/serigrafado_tela7.jpg" alt="Vidro Serigrafado" id="img-colorida" class="img-fluid img-thumbnail">
                    </a>
                </div>
            </div>
            
            <p class="text-justify">Tamanho Máximo: 1200 x 2500 mm.</p>
        </div>
        <div class="col-md-3">
			<?php include_once ("includes/menu_servicos.php"); ?>
        </div>
    </div>
    
    <div class="row my-4">
    	<div class="col-12">
        	<hr>
            
            <div class="row">
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado1.jpg" rel="shadowbox[vocation]" title="Serigrafia">
                        <img src="img/produtos/miniatura/serigrafado1.jpg" alt="Serigrafia" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado2.jpg" rel="shadowbox[vocation]" title="Serigrafia">
                        <img src="img/produtos/miniatura/serigrafado2.jpg" alt="Serigrafia" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado3.jpg" rel="shadowbox[vocation]" title="Serigrafia">
                        <img src="img/produtos/miniatura/serigrafado3.jpg" alt="Serigrafia" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado4.jpg" rel="shadowbox[vocation]" title="Serigrafia">
                        <img src="img/produtos/miniatura/serigrafado4.jpg" alt="Serigrafia" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado5.jpg" rel="shadowbox[vocation]" title="Serigrafia">
                        <img src="img/produtos/miniatura/serigrafado5.jpg" alt="Serigrafia" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/serigrafado6.jpg" rel="shadowbox[vocation]" title="Serigrafia">
                        <img src="img/produtos/miniatura/serigrafado6.jpg" alt="Serigrafia" class="img-fluid img-thumbnail">
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
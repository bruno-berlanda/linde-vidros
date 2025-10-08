<?php
$url = $_SERVER['HTTP_HOST'];
if ($url == "127.0.0.1:8080" || $url == "127.0.0.1" || $url == "localhost") {
	
	// Menu
	$l_home 			= "index.php";
	
	$l_empresa 			= "empresa.php";
	$l_gestao 			= "gestao-pessoas.php";
	$l_dicas 			= "dicas.php";
	$l_contato 			= "contato.php";
	
	$l_engenharia		= "engenharia.php";
	$l_moveleiro		= "moveleiro.php";
	$l_refrigeracao		= "refrigeracao.php";
	$l_acessorios		= "acessorios.php";
	$l_servicos			= "servicos.php";
	
	// Produtos
	$l_temperado		= "vidro-temperado.php";
	$l_laminado			= "vidro-laminado.php";
	$l_refletivo		= "vidro-refletivo.php";
	$l_insulado			= "vidro-insulado.php";
	$l_habitat			= "vidro-habitat.php";
    $l_controlesolar	= "vidro-controle-solar.php";
	$l_texturizado		= "vidro-texturizado.php";
	$l_extra			= "vidro-extra-clear.php";
	$l_sentryglas		= "sentryglas.php";
	
	$l_portas			= "portas-aluminio.php";
	$l_espelho			= "espelho.php";
	
	$l_expositores		= "portas-expositores.php";
	$l_freezer			= "tampas-freezer.php";
	
	// Serviços
	$l_pelicula		    = "pelicula-seguranca.php";
	$l_serigrafia		= "serigrafia.php";
	$l_lapidacao		= "lapidacao.php";
	$l_incisao			= "incisao.php";
	$l_cantos			= "cantos.php";
	
	// Acessórios
	$l_ferragens		= "ferragens.php";
	$l_aluminios		= "aluminios.php";
	$l_idea				= "idea-glass.php";
	
	// Currículo
	$l_curcadastrar		= "curriculo-cadastrar.php";
	$l_curentrar		= "curriculo-entrar.php";
	
	// Área Restrita
	$l_area				= "area-restrita.php";

}
else {

	// Menu
	$l_home 			= "https://www.lindevidros.com.br";
	
	$l_empresa 			= "empresa";
	$l_gestao 			= "gestao-pessoas";
	$l_dicas 			= "dicas";
	$l_contato 			= "contato";
	
	$l_engenharia		= "engenharia";
	$l_moveleiro		= "moveleiro";
	$l_refrigeracao		= "refrigeracao";
	$l_acessorios		= "acessorios";
	$l_servicos			= "servicos";
	
	// Produtos
	$l_temperado		= "vidro-temperado";
	$l_laminado			= "vidro-laminado";
	$l_refletivo		= "vidro-refletivo";
	$l_insulado			= "vidro-insulado";
	$l_habitat			= "vidro-habitat";
	$l_controlesolar	= "vidro-controle-solar";
	$l_texturizado		= "vidro-texturizado";
	$l_extra			= "vidro-extra-clear";
	$l_sentryglas		= "sentryglas";
	
	$l_portas			= "portas-aluminio";
	$l_espelho			= "espelho";
	
	$l_expositores		= "portas-expositores";
	$l_freezer			= "tampas-freezer";
	
	// Serviços
	$l_pelicula		    = "pelicula-seguranca";
	$l_serigrafia		= "serigrafia";
	$l_lapidacao		= "lapidacao";
	$l_incisao			= "incisao";
	$l_cantos			= "cantos";
	
	// Acessórios
	$l_ferragens		= "ferragens";
	$l_aluminios		= "aluminios";
	$l_idea				= "idea-glass";
	
	// Currículo
	$l_curcadastrar		= "curriculo-cadastrar";
	$l_curentrar		= "curriculo-entrar";
	
	// Área Restrita
	$l_area				= "area-restrita";
	
}
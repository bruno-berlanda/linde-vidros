<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_adm == "S" || $perm_tags == "S") {
	
	/* ******************************************************************************************************************
	ATUALIZAR TAGS
	****************************************************************************************************************** */
	if ($_GET['funcao'] == "atualizar") {

	// Dados do formulário
	$p_home 				= strip_tags(trim($_POST['p_home']));
	$p_acessorios			= strip_tags(trim($_POST['p_acessorios']));
	$p_aluminios			= strip_tags(trim($_POST['p_aluminios']));
	$p_aluminios_detalhes 	= strip_tags(trim($_POST['p_aluminios_detalhes']));
	$p_area_restrita 		= strip_tags(trim($_POST['p_area_restrita']));
	$p_cantos				= strip_tags(trim($_POST['p_cantos']));
	$p_contato 				= strip_tags(trim($_POST['p_contato']));
	$p_curriculo_cadastrar	= strip_tags(trim($_POST['p_curriculo_cadastrar']));
	$p_curriculo_entrar		= strip_tags(trim($_POST['p_curriculo_entrar']));
	$p_empresa				= strip_tags(trim($_POST['p_empresa']));
	$p_engenharia			= strip_tags(trim($_POST['p_engenharia']));
	$p_espelho				= strip_tags(trim($_POST['p_espelho']));
	$p_ferragens			= strip_tags(trim($_POST['p_ferragens']));
	$p_ferragens_detalhes	= strip_tags(trim($_POST['p_ferragens_detalhes']));
	$p_gestao_pessoas		= strip_tags(trim($_POST['p_gestao_pessoas']));
	$p_idea_glass 			= strip_tags(trim($_POST['p_idea_glass']));
	$p_incisao 				= strip_tags(trim($_POST['p_incisao']));
	$p_lapidacao 			= strip_tags(trim($_POST['p_lapidacao']));
	$p_moveleiro 			= strip_tags(trim($_POST['p_moveleiro']));
	$p_pelicula 			= strip_tags(trim($_POST['p_pelicula']));
	$p_portas_aluminio 		= strip_tags(trim($_POST['p_portas_aluminio']));
	$p_portas_expositores	= strip_tags(trim($_POST['p_portas_expositores']));
	$p_refrigeracao			= strip_tags(trim($_POST['p_refrigeracao']));
	$p_sentryglas			= strip_tags(trim($_POST['p_sentryglas']));
	$p_serigrafia			= strip_tags(trim($_POST['p_serigrafia']));
	$p_servicos				= strip_tags(trim($_POST['p_servicos']));
	$p_tampas_freezer		= strip_tags(trim($_POST['p_tampas_freezer']));
	$p_vidro_extraclear		= strip_tags(trim($_POST['p_vidro_extraclear']));
	$p_vidro_habitat		= strip_tags(trim($_POST['p_vidro_habitat']));
	$p_vidro_insulado 		= strip_tags(trim($_POST['p_vidro_insulado']));
	$p_vidro_laminado		= strip_tags(trim($_POST['p_vidro_laminado']));
	$p_vidro_refletivo		= strip_tags(trim($_POST['p_vidro_refletivo']));
	$p_vidro_temperado		= strip_tags(trim($_POST['p_vidro_temperado']));
	$p_vidro_texturizado	= strip_tags(trim($_POST['p_vidro_texturizado']));

	/* *** */

	$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET 
										 home='$p_home', acessorios='$p_acessorios', aluminios='$p_aluminios', aluminios_detalhes='$p_aluminios_detalhes',
										 area_restrita='$p_area_restrita', cantos='$p_cantos', contato='$p_contato',
										 curriculo_cadastrar='$p_curriculo_cadastrar', curriculo_entrar='$p_curriculo_entrar', empresa='$p_empresa',
										 engenharia='$p_engenharia', espelho='$p_espelho', ferragens='$p_ferragens', 
										 ferragens_detalhes='$p_ferragens_detalhes', gestao_pessoas='$p_gestao_pessoas',
										 idea_glass='$p_idea_glass', incisao='$p_incisao', lapidacao='$p_lapidacao', moveleiro='$p_moveleiro',
										 pelicula='$p_pelicula', portas_aluminio='$p_portas_aluminio', portas_expositores='$p_portas_expositores',
										 refrigeracao='$p_refrigeracao', sentryglas='$p_sentryglas', serigrafia='$p_serigrafia', servicos='$p_servicos',
										 tampas_freezer='$p_tampas_freezer', vidro_extraclear='$p_vidro_extraclear', vidro_habitat='$p_vidro_habitat',
										 vidro_insulado='$p_vidro_insulado', vidro_laminado='$p_vidro_laminado', vidro_refletivo='$p_vidro_refletivo',
										 vidro_temperado='$p_vidro_temperado', vidro_texturizado='$p_vidro_texturizado'
										 WHERE id='1'") or (mysqli_error());

	header ('Location: ../tags.php?msgSucesso=Tags atualizadas com sucesso');

	}

	/* ******************************************************************************************************************
	ATUALIZAR TODAS AS TAGS
	****************************************************************************************************************** */
	if ($_GET['funcao'] == "atualizar_todas") {

	// Dados do formulário
	$tag_nova 				= strip_tags(trim($_POST['tag_nova']));

	/* *** */
	
	// Consulta as tags atuais
	$consulta = mysqli_query ($conexao, "SELECT * FROM admin_tags WHERE id='1'") or die (mysqli_error());
		$dados = mysqli_fetch_array($consulta);
			$p_home 				= $dados['home'];
			$p_acessorios			= $dados['acessorios'];
			$p_aluminios			= $dados['aluminios'];
			$p_aluminios_detalhes 	= $dados['aluminios_detalhes'];
			$p_area_restrita 		= $dados['area_restrita'];
			$p_cantos				= $dados['cantos'];
			$p_contato 				= $dados['contato'];
			$p_curriculo_cadastrar	= $dados['curriculo_cadastrar'];
			$p_curriculo_entrar		= $dados['curriculo_entrar'];
			$p_empresa				= $dados['empresa'];
			$p_engenharia			= $dados['engenharia'];
			$p_espelho				= $dados['espelho'];
			$p_ferragens			= $dados['ferragens'];
			$p_ferragens_detalhes	= $dados['ferragens_detalhes'];
			$p_gestao_pessoas		= $dados['gestao_pessoas'];
			$p_idea_glass 			= $dados['idea_glass'];
			$p_incisao 				= $dados['incisao'];
			$p_lapidacao 			= $dados['lapidacao'];
			$p_moveleiro 			= $dados['moveleiro'];
			$p_pelicula 			= $dados['pelicula'];
			$p_portas_aluminio 		= $dados['portas_aluminio'];
			$p_portas_expositores	= $dados['portas_expositores'];
			$p_refrigeracao			= $dados['refrigeracao'];
			$p_sentryglas			= $dados['sentryglas'];
			$p_serigrafia			= $dados['serigrafia'];
			$p_servicos				= $dados['servicos'];
			$p_tampas_freezer		= $dados['tampas_freezer'];
			$p_vidro_extraclear		= $dados['vidro_extraclear'];
			$p_vidro_habitat		= $dados['vidro_habitat'];
			$p_vidro_insulado 		= $dados['vidro_insulado'];
			$p_vidro_laminado		= $dados['vidro_laminado'];
			$p_vidro_refletivo		= $dados['vidro_refletivo'];
			$p_vidro_temperado		= $dados['vidro_temperado'];
			$p_vidro_texturizado	= $dados['vidro_texturizado'];
		
	/* *** */
	
	if ($p_home !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET home='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_acessorios !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET acessorios='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_aluminios !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET aluminios='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_aluminios_detalhes !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET aluminios_detalhes='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_area_restrita !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET area_restrita='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_cantos !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET cantos='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_contato !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET contato='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_curriculo_cadastrar !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET curriculo_cadastrar='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_curriculo_entrar !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET curriculo_entrar='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_empresa !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET empresa='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_engenharia !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET engenharia='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_espelho !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET espelho='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_ferragens !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET ferragens='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_ferragens_detalhes !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET ferragens_detalhes='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_gestao_pessoas !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET gestao_pessoas='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_idea_glass !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET idea_glass='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_incisao !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET incisao='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_lapidacao !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET lapidacao='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_moveleiro !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET moveleiro='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_pelicula !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET pelicula='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_portas_aluminio !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET portas_aluminio='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_portas_expositores !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET portas_expositores='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_refrigeracao !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET refrigeracao='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_sentryglas !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET sentryglas='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_serigrafia !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET serigrafia='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_servicos !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET servicos='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_tampas_freezer !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET tampas_freezer='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_vidro_extraclear !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET vidro_extraclear='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_vidro_habitat !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET vidro_habitat='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_vidro_insulado !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET vidro_insulado='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_vidro_laminado !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET vidro_laminado='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_vidro_refletivo !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET vidro_refletivo='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_vidro_temperado !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET vidro_temperado='$tag_nova' WHERE id='1'") or (mysqli_error());
	}
	if ($p_vidro_texturizado !== "") {
		$atualiza = mysqli_query ($conexao, "UPDATE admin_tags SET vidro_texturizado='$tag_nova' WHERE id='1'") or (mysqli_error());
	}

	header ('Location: ../tags.php?msgSucesso=Tags atualizadas com sucesso');

	}

}
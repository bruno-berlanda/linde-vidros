<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_sistema.php");
include_once ("includes/usuario_logado.php");
include_once ("includes/cabecalho.php");
?>

<body>

<?php include_once ("includes/menu_topo.php"); ?>

<div class="container-fluid" id="conteudo">

<div class="row" id="titulo">
	<div class="col-md-12">
    	<h1>Currículos</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_curriculos == "S") {
?>

<?php
include_once("includes/msgs.php");
?>

<?php
$id 	= $_GET['curriculo'];

/* *************************************************
Dados do Cadastro
************************************************* */
$consulta = mysqli_query ($conexao, "SELECT * FROM usuarios WHERE id='$id'") or die (mysqli_error());
	$infos = mysqli_fetch_array ($consulta);
		$idUsuario 				= $infos['id'];
		$cpfUsuario 			= $infos['cpf'];
		$nomeUsuario 			= $infos['nome'];
		$emailUsuario 			= $infos['email'];
		$criadoUsuario 			= $infos['criado'];
		$atualizadoUsuario 		= $infos['atualizado'];
		$pneUsuario 			= $infos['pne'];
		$pne_descUsuario 		= $infos['pne_desc'];
		$indicacaoUsuario 		= $infos['indicacao'];
		$funcionarioUsuario 	= $infos['funcionario'];
		$exfuncionarioUsuario 	= $infos['exfuncionario'];
		$lidoUsuario 			= $infos['lido'];
		$ativoUsuario 			= $infos['ativo'];
		$avaliacaoUsuario		= $infos['avaliacao'];
		$sexoUsuario 			= $infos['sexo'];
		$estcivUsuario 			= $infos['estado_civil'];
		$filhosUsuario 			= $infos['filhos'];
		$rgUsuario 				= $infos['rg'];
		$uf_rgUsuario 			= $infos['uf_rg'];
		$nasc_diaUsuario 		= $infos['nasc_dia'];
		$nasc_mesUsuario 		= $infos['nasc_mes'];
		$nasc_anoUsuario 		= $infos['nasc_ano'];
		$foneUsuario 			= $infos['fone'];
		$recadosUsuario 		= $infos['recados'];
		$celularUsuario 		= $infos['celular'];
		$websiteUsuario 		= $infos['website'];
		$enderecoUsuario 		= $infos['endereco'];
		$numeroUsuario 			= $infos['numero'];
		$compUsuario 			= $infos['complemento'];
		$bairroUsuario 			= $infos['bairro'];
		$cepUsuario 			= $infos['cep'];
		$cidadeUsuario 			= $infos['cidade'];
		$ufUsuario 				= $infos['uf'];
		$empregUsuario 			= $infos['empregado'];
		$situacaoUsuario 		= $infos['situacao'];
		$cnhUsuario 			= $infos['cnh'];
		$fotoUsuario 			= $infos['foto'];
		$esportesUsuario 		= $infos['esportes'];
		$hobbiesUsuario 		= $infos['hobbies'];
		$livrosUsuario 			= $infos['livros'];
		$musicaUsuario 			= $infos['musica'];
		$paixoesUsuario 		= $infos['paixoes'];
		$trabsocialUsuario 		= $infos['trabsocial'];
		$areaUsuario 			= $infos['area'];
		$nivelUsuario 			= $infos['nivel'];
		$salarioUsuario 		= $infos['salario'];
		$objetivoUsuario 		= $infos['objetivo'];
		$miniUsuario 			= $infos['mini'];

// Tratamento da DATA
$criadoUsuario = date('d/m/Y', strtotime($criadoUsuario));
$atualizadoUsuario = date('d/m/Y H:i', strtotime($atualizadoUsuario));

// Data Nascimento - Cálculo Idade
if ($nasc_anoUsuario != "" && $nasc_mesUsuario != "" && $nasc_diaUsuario != "") {
	$data_nasc = $nasc_anoUsuario."-".$nasc_mesUsuario."-".$nasc_diaUsuario;
	
	$date = new DateTime($data_nasc); // data de nascimento
	$interval = $date->diff(new DateTime($data_hoje)); // data definida
}

/* *************************************************
Dados Pessoais
************************************************* */
if ($sexoUsuario == "M") { $sexoUsuario = "MASCULINO"; }
else if ($sexoUsuario == "F") { $sexoUsuario = "FEMININO"; }

if ($sexoUsuario == "MASCULINO") {
	// Sexo
	switch ($estcivUsuario) {
		case "1": $estcivUsuario = "SOLTEIRO"; break;
		case "2": $estcivUsuario = "CASADO"; break;
		case "3": $estcivUsuario = "DIVORCIADO"; break;
		case "4": $estcivUsuario = "SEPARADO"; break;
		case "5": $estcivUsuario = "VIÚVO"; break;
		case "6": $estcivUsuario = "UNIÃO ESTÁVEL"; break;
	}
}
else if ($sexoUsuario == "FEMININO") {
	// Sexo
	switch ($estcivUsuario) {
		case "1": $estcivUsuario = "SOLTEIRA"; break;
		case "2": $estcivUsuario = "CASADA"; break;
		case "3": $estcivUsuario = "DIVORCIADA"; break;
		case "4": $estcivUsuario = "SEPARADA"; break;
		case "5": $estcivUsuario = "VIÚVA"; break;
		case "6": $estcivUsuario = "UNIÃO ESTÁVEL"; break;
	}
}

// Empregado Atualmente
if ($empregUsuario == "S") { $empregUsuario = "SIM"; }
else if ($empregUsuario == "N") { $empregUsuario = "NÃO"; }

// Situação
switch ($situacaoUsuario) {
	case "1": $situacaoUsuario = "ESTOU EM BUSCA DO PRIMEIRO ESTÁGIO"; break;
	case "2": $situacaoUsuario = "ESTOU EM BUSCA DE OUTRO ESTÁGIO"; break;
	case "3": $situacaoUsuario = "ESTOU EM BUSCA DO PRIMEIRO EMPREGO"; break;
	case "4": $situacaoUsuario = "ESTOU EM BUSCA DE OUTRO EMPREGO"; break;
	case "5": $situacaoUsuario = "SOU RECÉM-FORMADO, BUSCO UM EMPREGO MELHOR"; break;
	case "6": $situacaoUsuario = "DESEMPREGADO RECENTEMENTE"; break;
	case "7": $situacaoUsuario = "DESEMPREGADO A MAIS DE 3 MESES"; break;
	case "8": $situacaoUsuario = "DESEMPREGADO A MAIS DE 1 ANO"; break;
}

if ($filhosUsuario == "00") { $filhosUsuario = "NÃO"; }

if ($cnhUsuario == "0") { $cnhUsuario = "NÃO POSSUO CNH"; }

if ($pneUsuario == "S") { $pneUsuario = "SIM"; } else { $pneUsuario = "NÃO"; }
		
/* *************************************************
Dados Profissionais
************************************************* */
// Área
switch ($areaUsuario) {
	case "1": $areaUsuario = "ADMINISTRATIVA"; break;
	case "2": $areaUsuario = "ALMOXARIFADO"; break;
	case "3": $areaUsuario = "COMPRAS"; break;
	case "4": $areaUsuario = "CONTABILIDADE"; break;
	case "5": $areaUsuario = "CONSTRUÇÃO CIVIL"; break;
	case "6": $areaUsuario = "FINANCEIRO"; break;
	case "7": $areaUsuario = "MANUTENÇÃO"; break;
	case "8": $areaUsuario = "PCP"; break;
	case "9": $areaUsuario = "PORTARIA"; break;
	case "10": $areaUsuario = "PRODUÇÃO"; break;
	case "11": $areaUsuario = "PROJETO"; break;
	case "12": $areaUsuario = "QUALIDADE"; break;
	case "13": $areaUsuario = "RECEPÇÃO"; break;
	case "14": $areaUsuario = "TI"; break;
	case "15": $areaUsuario = "TRANSPORTE"; break;
	case "16": $areaUsuario = "VENDAS"; break;
	case "17": $areaUsuario = "LIMPEZA"; break;
	case "18": $areaUsuario = "FATURAMENTO"; break;
	case "19": $areaUsuario = "TÉC SEGURANÇA"; break;
	case "20": $areaUsuario = "RH"; break;
}

// Nível
switch ($nivelUsuario) {
	case "1": $nivelUsuario = "ESTAGIÁRIO"; break;
	case "2": $nivelUsuario = "AUXILIAR"; break;
	case "3": $nivelUsuario = "ASSISTENTE"; break;
	case "4": $nivelUsuario = "TÉCNICO"; break;
	case "5": $nivelUsuario = "TRAINEE"; break;
	case "6": $nivelUsuario = "LÍDER"; break;
	case "7": $nivelUsuario = "ENCARREGADO"; break;
	case "8": $nivelUsuario = "SUPERVISOR"; break;
	case "9": $nivelUsuario = "GERENTE"; break;
}

// Salário
switch ($salarioUsuario) {
	case "1": $salarioUsuario = "ATÉ R$500,00"; break;
	case "2": $salarioUsuario = "ATÉ R$1.000,00"; break;
	case "3": $salarioUsuario = "A PARTIR DE R$1.000,00"; break;
	case "4": $salarioUsuario = "A PARTIR DE R$1.500,00"; break;
	case "5": $salarioUsuario = "A PARTIR DE R$2.000,00"; break;
	case "6": $salarioUsuario = "A PARTIR DE R$2.500,00"; break;
	case "7": $salarioUsuario = "A PARTIR DE R$3.000,00"; break;
	case "8": $salarioUsuario = "A PARTIR DE R$4.000,00"; break;
	case "9": $salarioUsuario = "A PARTIR DE R$5.000,00"; break;
	case "10": $salarioUsuario = "A PARTIR DE R$6.000,00"; break;
	case "11": $salarioUsuario = "A PARTIR DE R$7.000,00"; break;
	case "12": $salarioUsuario = "A PARTIR DE R$8.000,00"; break;
	case "13": $salarioUsuario = "A PARTIR DE R$9.000,00"; break;
	case "14": $salarioUsuario = "A PARTIR DE R$10.000,00"; break;
}

$objetivoUsuario 	= str_replace("\n","<br>",$objetivoUsuario);
$miniUsuario 		= str_replace("\n","<br>",$miniUsuario);

$dadosExperiencias 	= mysqli_query ($conexao, "SELECT * FROM usuarios_experiencias WHERE id_usuario='$idUsuario' ORDER BY sai_ano, sai_mes, ini_ano, ini_mes") or die (mysqli_error());
$contaExperiencias 	= mysqli_num_rows($dadosExperiencias);

/* *************************************************
Escolaridade
************************************************* */
$dadosEscolaridade = mysqli_query ($conexao, "SELECT * FROM usuarios_escolaridade WHERE id_usuario='$idUsuario' ORDER BY con_ano, con_mes, ini_ano, ini_mes") or die (mysqli_error());
$contaEscolaridade = mysqli_num_rows($dadosEscolaridade);

/* *************************************************
Formação Complementar
************************************************* */
$dadosFormacao = mysqli_query ($conexao, "SELECT * FROM usuarios_formacao WHERE id_usuario='$idUsuario' ORDER BY con_ano, con_mes, ini_ano, ini_mes") or die (mysqli_error());
$contaFormacao = mysqli_num_rows($dadosFormacao);

/* *************************************************
Informática
************************************************* */
$dadosInformatica = mysqli_query ($conexao, "SELECT * FROM usuarios_informatica WHERE id_usuario='$idUsuario'") or die (mysqli_error());
$contaInformatica = mysqli_num_rows($dadosInformatica);

/* *************************************************
Línguas Estrangeiras
************************************************* */
$dadosLinguas = mysqli_query ($conexao, "SELECT * FROM usuarios_linguas WHERE id_usuario='$idUsuario'") or die (mysqli_error());
$contaLinguas = mysqli_num_rows($dadosLinguas);

/* *************************************************
Outras Informações
************************************************* */
$esportesUsuario 	= str_replace("\n","<br>",$esportesUsuario);
$hobbiesUsuario 	= str_replace("\n","<br>",$hobbiesUsuario);
$livrosUsuario 		= str_replace("\n","<br>",$livrosUsuario);
$musicaUsuario 		= str_replace("\n","<br>",$musicaUsuario);
$paixoesUsuario 	= str_replace("\n","<br>",$paixoesUsuario);
$trabsocialUsuario 	= str_replace("\n","<br>",$trabsocialUsuario);

// MARCANDO COMO LIDO
if ($lidoUsuario == 0) {
	
	if ($perm_adm == "N" && $perm_curriculos == "S") {
	
		$atualiza = mysqli_query ($conexao, "UPDATE usuarios SET lido='1' WHERE id='$id'") or die (mysqli_error());
		
	}
	
}
?>

<div class="row">
<div class="col-md-3">
<?php
if ($fotoUsuario == '') {
	if ($sexoUsuario == "MASCULINO") {
?>
	<img src="../curriculo/fotos/sem_foto_m.jpg" class="img-responsive img-rounded">
<?php
	}
	else if ($sexoUsuario == "FEMININO") {
?>
	<img src="../curriculo/fotos/sem_foto_f.jpg" class="img-responsive img-rounded">
<?php
	}
	else {
?>
	<img src="../curriculo/fotos/sem_foto_mf.jpg" class="img-responsive img-rounded">
<?php
	}
}
else {
?>
	<img src="../curriculo/fotos/<?php echo $fotoUsuario; ?>" class="img-responsive img-rounded">
<?php
}
?>

<br><br>

<?php
// Cálculo % preenchimento do currículo
//include_once ("includes/calculo_porc_usuario.php");
?>

<!-- --------------------------------------------------------------------------------------
BOTÕES EXCLUIR/REATIVAR CURRÍCULO
--------------------------------------------------------------------------------------- -->
<div class="row">
	<div class="col-md-12">
		<?php if ($ativoUsuario == "1") { ?>
        <p><a href="funcoes/curriculos.php?funcao=excluir&id=<?php echo $idUsuario; ?>" class="btn btn-danger btn-sm btn-block" onClick="return confirm('Tem certeza que deseja excluir o currículo do candidato <?php echo $nomeUsuario; ?>?')"><i class="fas fa-trash-alt"></i> EXCLUIR CURRÍCULO</a></p>
        <?php } else { ?>
        <p><a href="funcoes/curriculos.php?funcao=reativar&id=<?php echo $idUsuario; ?>" class="btn btn-success btn-sm btn-block" onClick="return confirm('Tem certeza que deseja reativar o currículo do candidato <?php echo $nomeUsuario; ?>?')"><i class="fas fa-sync-alt"></i> REATIVAR CURRÍCULO</a></p>
       	<?php } ?>
	</div>
</div>
<!-- --------------------------------------------------------------------------------------
BOTÕES IMPRIMIR/AGENDAR ENTREVISTA
--------------------------------------------------------------------------------------- -->
<div class="row">
    <div class="col-md-6">
        <div class="visible-desktop">
        <p><a href="curriculos_imprimir.php?id=<?php echo $id; ?>" target="_blank" class="btn btn-primary btn-sm btn-block"><i class="fas fa-print"></i> IMPRIMIR</a></p>
        </div>
    </div>
    <div class="col-md-6">
        <p><a href="#agendaModal" role="button" class="btn btn-warning btn-sm btn-block" data-toggle="modal"><i class="fas fa-calendar-alt"></i> ENTREVISTA</a></p>
    </div>
</div>
</div>

<div class="col-md-9">

<h1><?php echo $nomeUsuario; ?></h1>

<?php if ($exfuncionarioUsuario == "S") { ?>
<p><span class="label label-warning">EX-FUNCIONÁRIO</span></p>
<?php } ?>

<div class="row">
	<div class="col-md-6">
		<p class="text-muted"><small>CRIADO EM: <?php echo $criadoUsuario; ?> | ATUALIZADO EM: <?php echo $atualizadoUsuario; ?></small></p>
    </div>
    <div class="col-md-6 text-right">
    	<!-- --------------------------------------------------------------------------------------
        AVALIAÇÃO DO CURRÍCULO
        --------------------------------------------------------------------------------------- -->
        <div class="btn-group">
            <?php if ($avaliacaoUsuario == "1") { ?>
            <button class="btn btn-success btn-sm">1</button>
            <?php } else { ?>
            <a href="funcoes/curriculos.php?funcao=avaliacao_1&id=<?php echo $idUsuario; ?>" class="btn btn-default btn-sm">1</a>
            <?php } ?>
            <?php if ($avaliacaoUsuario == "2") { ?>
            <button class="btn btn-success btn-sm">2</button>
            <?php } else { ?>
            <a href="funcoes/curriculos.php?funcao=avaliacao_2&id=<?php echo $idUsuario; ?>" class="btn btn-default btn-sm">2</a>
            <?php } ?>
            <?php if ($avaliacaoUsuario == "3") { ?>
            <button class="btn btn-success btn-sm">3</button>
            <?php } else { ?>
            <a href="funcoes/curriculos.php?funcao=avaliacao_3&id=<?php echo $idUsuario; ?>" class="btn btn-default btn-sm">3</a>
            <?php } ?>
            <?php if ($avaliacaoUsuario == "4") { ?>
            <button class="btn btn-success btn-sm">4</button>
            <?php } else { ?>
            <a href="funcoes/curriculos.php?funcao=avaliacao_4&id=<?php echo $idUsuario; ?>" class="btn btn-default btn-sm">4</a>
            <?php } ?>
            <?php if ($avaliacaoUsuario == "5") { ?>
            <button class="btn btn-success btn-sm">5</button>
            <?php } else { ?>
            <a href="funcoes/curriculos.php?funcao=avaliacao_5&id=<?php echo $idUsuario; ?>" class="btn btn-default btn-sm">5</a>
            <?php } ?>
        </div>
    </div>
</div>

<br>

<div class="well" id="curriculo">

<h2><i class="fa fa-user" aria-hidden="true"></i> DADOS PESSOAIS</h2>

<div class="row">
	<div class="col-md-3">
    	<p><strong>CPF:</strong> <?php echo $cpfUsuario; ?></p>
    </div>
    <div class="col-md-3">
        <p><strong>RG:</strong> <?php if ($rgUsuario != "") { echo $rgUsuario; } ?> <?php if ($uf_rgUsuario != "") { echo "/ ".$uf_rgUsuario; } ?></p>
    </div>
    <div class="col-md-6">
    	<p><strong>E-MAIL:</strong> <a href="mailto:<?php echo $emailUsuario; ?>"><?php echo $emailUsuario; ?></a></p>
    </div>
</div>

<div class="row">
	<div class="col-md-4">
        <p><strong>FONE:</strong> <?php if ($foneUsuario != "") { echo $foneUsuario; } ?></p>
    </div>
    <div class="col-md-4">
        <p><strong>RECADOS:</strong> <?php if ($recadosUsuario != "") { echo $recadosUsuario; } ?></p>
    </div>
    <div class="col-md-4">
        <p><strong>CELULAR:</strong> <?php if ($celularUsuario != "") { echo $celularUsuario; } ?></p>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
        <p><strong>ENDEREÇO:</strong> <?php if ($enderecoUsuario != "") { echo $enderecoUsuario; } ?><?php if ($numeroUsuario != "") { echo ", ".$numeroUsuario; } ?> <?php if ($bairroUsuario != "") { echo "- ".$bairroUsuario; } ?> <?php if ($cidadeUsuario != "") { echo "- ".$cidadeUsuario; } ?> <?php if ($ufUsuario != "") { echo "/ ".$ufUsuario; } ?> <?php if ($cepUsuario != "") { echo "- ".$cepUsuario; } ?> <?php if ($compUsuario != "") { echo "- ".$compUsuario; } ?></p>
    </div>
</div>

<div class="row">
	<div class="col-md-4">
        <p><strong>DATA NASCIMENTO:</strong> <?php if ($nasc_diaUsuario != "" && $nasc_mesUsuario != "" && $nasc_anoUsuario != "") { echo $nasc_diaUsuario."/".$nasc_mesUsuario."/".$nasc_anoUsuario; echo " (". $interval->format('%Y anos').")"; } ?></p>
    </div>
    <div class="col-md-4">
        <p><strong>SEXO:</strong> <?php if ($sexoUsuario != "") { echo $sexoUsuario; } ?></p>
    </div>
    <div class="col-md-4">
        <p><strong>ESTADO CIVIL:</strong> <?php if ($estcivUsuario != "") { echo $estcivUsuario; } ?></p>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
        <p><strong>WEBSITE:</strong> <?php if ($websiteUsuario != "") { echo $websiteUsuario; } ?></p>
    </div>
</div>

<div class="row">
	<div class="col-md-2">
        <p><strong>FILHOS:</strong> <?php if ($filhosUsuario != "") { echo $filhosUsuario; } ?></p>
    </div>
    <div class="col-md-2">
        <p><strong>CNH:</strong> <?php if ($cnhUsuario != "") { echo $cnhUsuario; } ?></p>
    </div>
    <div class="col-md-8">
        <p><strong>PNE:</strong> <?php echo $pneUsuario; ?> <?php if ($pne_descUsuario != "") { echo "- ".$pne_descUsuario; } ?></p>
    </div>
</div>

<div class="row">
	<div class="col-md-2">
        <p><strong>EMPREGADO:</strong> <?php if ($empregUsuario != "") { echo $empregUsuario; } ?></p>
    </div>
    <div class="col-md-6">
        <p><strong>SITUAÇÃO:</strong> <?php if ($situacaoUsuario != "") { echo $situacaoUsuario; } ?></p>
    </div>
    <div class="col-md-4">
        <p><strong>INDICAÇÃO:</strong> <?php if ($indicacaoUsuario != "") { echo $indicacaoUsuario; } ?></p>
    </div>
</div>

</div>

<div class="well" id="curriculo">

<h2><i class="fa fa-crosshairs" aria-hidden="true"></i> OBJETIVOS PROFISSIONAIS</h2>

<?php
/* ********************************************************
OBJETIVOS PROFISSIONAIS - INÍCIO
******************************************************** */
if ($areaUsuario == ""  && $nivelUsuario == "" && $salarioUsuario == "" && $miniUsuario == "" && $objetivoUsuario == "") {
?>
<div class="alert">Nenhum objetivo profissional defenido</div>
<?php
}
else {
?>
<div class="row">
	<div class="col-md-4">
        <p><strong>ÁREA:</strong> <?php if ($areaUsuario != "") { echo $areaUsuario; } ?></p>
    </div>
    <div class="col-md-4">
        <p><strong>NÍVEL:</strong> <?php if ($nivelUsuario != "") { echo $nivelUsuario; } ?></p>
    </div>
    <div class="col-md-4">
        <p><strong>SALÁRIO:</strong> <?php if ($salarioUsuario != "") { echo $salarioUsuario; } ?></p>
    </div>
</div>

<?php if ($miniUsuario != "") { ?>
    <p><strong>MINICURRÍCULO</strong></p>
    
    <blockquote>
      <p><?php echo $miniUsuario; ?></p>
    </blockquote>
<?php } ?>

<?php if ($objetivoUsuario != "") { ?>
    <p><strong>OBJETIVO PROFISSIONAL</strong></p>
    
    <blockquote>
      <p><?php echo $objetivoUsuario; ?></p>
    </blockquote>

<?php } ?>

<?php
}
/* ********************************************************
OBJETIVOS PROFISSIONAIS - FINAL
******************************************************** */
?>
</div>

<?php
/* ********************************************************
EXPERIÊNCIAS PROFISSIONAIS - INÍCIO
******************************************************** */
if ($contaExperiencias > 0) {
?>
<div class="well" id="curriculo">

<h2><i class="fa fa-briefcase" aria-hidden="true"></i> EXPERIÊNCIAS PROFISSIONAIS</h2>

<?php	
	while ($dados = mysqli_fetch_array ($dadosExperiencias)) {
		$ini_mesExp 	= $dados['ini_mes'];
		$ini_anoExp 	= $dados['ini_ano'];
		$sai_mesExp 	= $dados['sai_mes'];
		$sai_anoExp 	= $dados['sai_ano'];
		$empresaExp 	= $dados['empresa'];
		$cargoExp 		= $dados['cargo'];
		$descricaoExp 	= $dados['descricao'];
		$salarioExp 	= $dados['salario'];
		
		$descricaoExp = str_replace("\n","<br>",$descricaoExp);
?>

<blockquote>
	<h3><?php echo $empresaExp; ?></h3>
    <div class="row">
    	<div class="col-md-3"><strong>INÍCIO:</strong> <?php if ($ini_mesExp != "" && $ini_anoExp != "") { echo $ini_mesExp."/".$ini_anoExp; } ?></div>
        <div class="col-md-3"><strong>SAÍDA:</strong> <?php if ($sai_mesExp != "" && $sai_anoExp != "") { echo $sai_mesExp."/".$sai_anoExp; } ?></div>
    </div>
    <div class="row">
    	<div class="col-md-8"><strong>CARGO:</strong> <?php if ($cargoExp != "") { echo $cargoExp; } ?></div>
        <div class="col-md-4"><strong>SALÁRIO:</strong> <?php if ($salarioExp != "") { echo "R$ ".$salarioExp; } ?></div>
    </div>
    <p><?php echo $descricaoExp; ?></p>
</blockquote>

<?php
	}
?>

</div>
<?php
}
/* ********************************************************
EXPERIÊNCIAS PROFISSIONAIS - FINAL
******************************************************** */

/* ********************************************************
ESCOLARIDADE - INÍCIO
******************************************************** */
if ($contaEscolaridade > 0) {
?>
<div class="well" id="curriculo">

<h2><i class="fa fa-graduation-cap" aria-hidden="true"></i> ESCOLARIDADE</h2>

<?php	
	while ($dados = mysqli_fetch_array ($dadosEscolaridade)) {
		$ini_mesEsc 	= $dados['ini_mes'];
		$ini_anoEsc 	= $dados['ini_ano'];
		$con_mesEsc 	= $dados['con_mes'];
		$con_anoEsc 	= $dados['con_ano'];
		$instituicaoEsc = $dados['instituicao'];
		$cursoEsc 		= $dados['curso'];
		$grauEsc 		= $dados['grau'];
		$situacaoEsc 	= $dados['situacao'];
		
		if ($grauEsc == "1") { $grauEsc = "ENSINO MÉDIO"; }
		else if ($grauEsc == "2") { $grauEsc = "TÉCNICO"; }
		else if ($grauEsc == "3") { $grauEsc = "GRADUAÇÃO"; }
		else if ($grauEsc == "4") { $grauEsc = "PÓS-GRADUAÇÃO"; }
		else if ($grauEsc == "5") { $grauEsc = "MBA"; }
		else if ($grauEsc == "6") { $grauEsc = "MESTRADO"; }
		else if ($grauEsc == "7") { $grauEsc = "DOUTORADO"; }
		
		if ($situacaoEsc == "1") { $situacaoEsc = "CONCLUÍDO"; }
		else if ($situacaoEsc == "2") { $situacaoEsc = "CURSANDO – 1º ano"; }
		else if ($situacaoEsc == "3") { $situacaoEsc = "CURSANDO – 2º ano"; }
		else if ($situacaoEsc == "4") { $situacaoEsc = "CURSANDO – 3º ano"; }
		else if ($situacaoEsc == "5") { $situacaoEsc = "CURSANDO – 4º ano"; }
		else if ($situacaoEsc == "6") { $situacaoEsc = "CURSANDO – 5º ano"; }
		else if ($situacaoEsc == "7") { $situacaoEsc = "CURSANDO – 6º ano"; }
		else if ($situacaoEsc == "8") { $situacaoEsc = "CANCELADO"; }
		else if ($situacaoEsc == "9") { $situacaoEsc = "TRANCADO"; }
?>

<blockquote>
	<h3><?php echo $instituicaoEsc; ?></h3>
    <div class="row">
    	<div class="col-md-3"><strong>INÍCIO:</strong> <?php if ($ini_mesEsc != "" && $ini_anoEsc != "") { echo $ini_mesEsc."/".$ini_anoEsc; } ?></div>
        <div class="col-md-3"><strong>TÉRMINO:</strong> <?php if ($con_mesEsc != "" && $con_anoEsc != "") { echo $con_mesEsc."/".$con_anoEsc; } ?></div>
        <div class="col-md-6"><strong>SITUAÇÃO:</strong> <?php if ($situacaoEsc != "") { echo $situacaoEsc; } ?></div>
    </div>
    <div class="row">
    	<div class="col-md-8"><strong>CURSO:</strong> <?php if ($cursoEsc != "") { echo $cursoEsc; } ?></div>
        <div class="col-md-4"><strong>GRAU:</strong> <?php if ($grauEsc != "") { echo $grauEsc; } ?></div>
    </div>
</blockquote>

<?php
	}
?>

</div>
<?php
}
/* ********************************************************
ESCOLARIDADE - FINAL
******************************************************** */

/* ********************************************************
FORMAÇÃO COMPLEMENTAR - INÍCIO
******************************************************** */
if ($contaFormacao > 0) {
?>
<div class="well" id="curriculo">

<h2><i class="fa fa-book" aria-hidden="true"></i> FORMAÇÃO COMPLEMENTAR</h2>

<?php	
	while ($dados = mysqli_fetch_array ($dadosFormacao)) {
		$ini_mesFor 	= $dados['ini_mes'];
		$ini_anoFor 	= $dados['ini_ano'];
		$con_mesFor 	= $dados['con_mes'];
		$con_anoFor 	= $dados['con_ano'];
		$instituicaoFor = $dados['instituicao'];
		$atividadeFor 	= $dados['atividade'];
		$cargaFor 		= $dados['carga'];
		$situacaoFor 	= $dados['situacao'];
		
		if ($situacaoFor == "1") { $situacaoFor = "CONCLUÍDO"; }
		else if ($situacaoFor == "2") { $situacaoFor = "CURSANDO"; }
		else if ($situacaoFor == "3") { $situacaoFor = "INTERROMPIDO"; }
?>

<blockquote>
	<h3><?php echo $instituicaoFor; ?></h3>
    <div class="row">
    	<div class="col-md-3"><strong>INÍCIO:</strong> <?php if ($ini_mesFor != "" && $ini_anoFor != "") { echo $ini_mesFor."/".$ini_anoFor; } ?></div>
        <div class="col-md-3"><strong>TÉRMINO:</strong> <?php if ($con_mesFor != "" && $con_anoFor != "") { echo $con_mesFor."/".$con_anoFor; } ?></div>
        <div class="col-md-6"><strong>SITUAÇÃO:</strong> <?php if ($situacaoFor != "") { echo $situacaoFor; } ?></div>
    </div>
    <div class="row">
    	<div class="col-md-8"><strong>ATIVIDADE:</strong> <?php if ($atividadeFor != "") { echo $atividadeFor; } ?></div>
        <div class="col-md-4"><strong>CARGA HORÁRIA:</strong> <?php if ($cargaFor != "") { echo $cargaFor." (horas)"; } ?></div>
    </div>
</blockquote>

<?php
	}
?>

</div>
<?php
}
/* ********************************************************
FORMAÇÃO COMPLEMENTAR - FINAL
******************************************************** */

/* ********************************************************
INFORMÁTICA - INÍCIO
******************************************************** */
if ($contaInformatica > 0) {
?>
<div class="well" id="curriculo">

<h2><i class="fa fa-laptop" aria-hidden="true"></i> CONHECIMENTO EM INFORMÁTICA</h2>

<?php	
	while ($dados = mysqli_fetch_array ($dadosInformatica)) {
		$softwareInf 	= $dados['software'];
		$nivelInf 		= $dados['nivel'];
		
		if ($softwareInf == "1") { $softwareInf = "WINDOWS (SISTEMA OPERACIONAL)"; }
		else if ($softwareInf == "2") { $softwareInf = "LINUX (SISTEMA OPERACIONAL)"; }
		else if ($softwareInf == "3") { $softwareInf = "MICROSOFT WORD (PACOTE OFFICE)"; }
		else if ($softwareInf == "4") { $softwareInf = "MICROSOFT EXCEL (PACOTE OFFICE)"; }
		else if ($softwareInf == "5") { $softwareInf = "MICROSOFT POWERPOINT (PACOTE OFFICE)"; }
		else if ($softwareInf == "6") { $softwareInf = "MICROSOFT OUTLOOK (PACOTE OFFICE)"; }
		else if ($softwareInf == "7") { $softwareInf = "MICROSOFT ACCESS (PACOTE OFFICE)"; }
		else if ($softwareInf == "8") { $softwareInf = "CORELDRAW (SOFTWARE GRÁFICO)"; }
		else if ($softwareInf == "9") { $softwareInf = "ADOBE PHOTOSHOP (SOFTWARE GRÁFICO)"; }
		else if ($softwareInf == "10") { $softwareInf = "AUTOCAD (SOFTWARE GRÁFICO)"; }
		else if ($softwareInf == "11") { $softwareInf = "INTERNET (NAVEGAÇÃO)"; }
		else if ($softwareInf == "12") { $softwareInf = "REDES (CONFIGURAÇÃO)"; }
		
		if ($nivelInf == "1") { $nivelInf = "BÁSICO"; }
		else if ($nivelInf == "2") { $nivelInf = "INTERMEDIÁRIO"; }
		else if ($nivelInf == "3") { $nivelInf = "AVANÇADO"; }
?>

<blockquote>
    <div class="row">
    	<div class="col-md-8"><strong>APLICATIVO:</strong> <?php if ($softwareInf != "") { echo $softwareInf; } ?></div>
        <div class="col-md-4"><strong>NÍVEL:</strong> <?php if ($nivelInf != "") { echo $nivelInf; } ?></div>
    </div>
</blockquote>

<?php
	}
?>

</div>
<?php
}
/* ********************************************************
INFORMÁTICA - FINAL
******************************************************** */

/* ********************************************************
IDIOMAS - INÍCIO
******************************************************** */
if ($contaLinguas > 0) {
?>
<div class="well" id="curriculo">

<h2><i class="fa fa-globe" aria-hidden="true"></i> CONHECIMENTO EM IDIOMAS</h2>

<?php	
	while ($dados = mysqli_fetch_array ($dadosLinguas)) {
		$idiomaLin 	= $dados['idioma'];
		$nivelLin 	= $dados['nivel'];
		
		if ($idiomaLin == "1") { $idiomaLin = "INGLÊS"; }
		else if ($idiomaLin == "2") { $idiomaLin = "ESPANHOL"; }
		else if ($idiomaLin == "3") { $idiomaLin = "FRANCÊS"; }
		else if ($idiomaLin == "4") { $idiomaLin = "ITALIANO"; }
		else if ($idiomaLin == "5") { $idiomaLin = "ALEMÃO"; }
		else if ($idiomaLin == "6") { $idiomaLin = "CHINÊS"; }
		else if ($idiomaLin == "7") { $idiomaLin = "JAPONÊS"; }
		
		if ($nivelLin == "1") { $nivelLin = "BÁSICO"; }
		else if ($nivelLin == "2") { $nivelLin = "INTERMEDIÁRIO"; }
		else if ($nivelLin == "3") { $nivelLin = "AVANÇADO"; }
		else if ($nivelLin == "4") { $nivelLin = "FLUENTE"; }
?>

<blockquote>
    <div class="row">
    	<div class="col-md-8"><strong>IDIOMA:</strong> <?php if ($idiomaLin != "") { echo $idiomaLin; } ?></div>
        <div class="col-md-4"><strong>NÍVEL:</strong> <?php if ($nivelLin != "") { echo $nivelLin; } ?></div>
    </div>
</blockquote>

<?php
	}
?>

</div>
<?php
}
/* ********************************************************
IDIOMAS - FINAL
******************************************************** */

/* ********************************************************
OUTRAS INFORMAÇÕES - INÍCIO
******************************************************** */
if ($esportesUsuario != "" || $hobbiesUsuario != "" || $livrosUsuario != "" || $musicaUsuario != "" || $paixoesUsuario != "" || $trabsocialUsuario != "") {
?>
<div class="well" id="curriculo">

<h2><i class="fa fa-futbol-o" aria-hidden="true"></i> OUTRAS INFORMAÇÕES</h2>

<?php
if ($esportesUsuario != "") {
?>
<blockquote>
    <div class="row">
    	<div class="col-md-12"><strong>ESPORTES</strong> <br> <?php echo $esportesUsuario; ?></div>
    </div>
</blockquote>
<?php
}

if ($hobbiesUsuario != "") {
?>
<blockquote>
    <div class="row">
    	<div class="col-md-12"><strong>HOBBIES</strong> <br> <?php echo $hobbiesUsuario; ?></div>
    </div>
</blockquote>
<?php
}

if ($livrosUsuario != "") {
?>
<blockquote>
    <div class="row">
    	<div class="col-md-12"><strong>LIVROS</strong> <br> <?php echo $livrosUsuario; ?></div>
    </div>
</blockquote>
<?php
}

if ($musicaUsuario != "") {
?>
<blockquote>
    <div class="row">
    	<div class="col-md-12"><strong>MÚSICA</strong> <br> <?php echo $musicaUsuario; ?></div>
    </div>
</blockquote>
<?php
}

if ($paixoesUsuario != "") {
?>
<blockquote>
    <div class="row">
    	<div class="col-md-12"><strong>PAIXÕES</strong> <br> <?php echo $paixoesUsuario; ?></div>
    </div>
</blockquote>
<?php
}

if ($trabsocialUsuario != "") {
?>
<blockquote>
    <div class="row">
    	<div class="col-md-12"><strong>TRABALHO SOCIAL</strong> <br> <?php echo $trabsocialUsuario; ?></div>
    </div>
</blockquote>
<?php
}
?>
</div> <!-- well -->
<?php
}
/* ********************************************************
OUTRAS INFORMAÇÕES - FINAL
******************************************************** */
?>

<?php
/* ***************************************************************************************************************************************************
OBSERVAÇÕES DO SETOR DE RH
*************************************************************************************************************************************************** */
$consultaObs = mysqli_query ($conexao, "SELECT * FROM usuarios_obs WHERE id_usuario='$idUsuario'") or die (mysqli_error($conexao));

if (mysqli_num_rows($consultaObs) > 0) {

	$infos = mysqli_fetch_array ($consultaObs);

		$obs 			= $infos['obs'];

		$administrativo = $infos['administrativo'];
		$almoxarifado 	= $infos['almoxarifado'];
		$compras 		= $infos['compras'];
		$contabilidade 	= $infos['contabilidade'];
		$construcao 	= $infos['construcao'];
		$financeiro 	= $infos['financeiro'];
		$manutencao 	= $infos['manutencao'];
		$pcp 			= $infos['pcp'];
		$portaria 		= $infos['portaria'];
		$producao 		= $infos['producao'];
		$projeto 		= $infos['projeto'];
		$qualidade 		= $infos['qualidade'];
		$recepcao 		= $infos['recepcao'];
		$ti 			= $infos['ti'];
		$transporte 	= $infos['transporte'];
		$vendas 		= $infos['vendas'];
		$limpeza 		= $infos['limpeza'];
		$faturamento 	= $infos['faturamento'];
		$seguranca 		= $infos['seguranca'];
		$rh 			= $infos['rh'];
    ?>

    <form method="post" action="funcoes/curriculos.php?funcao=obs&idUsuarioCur=<?php echo $idUsuario;?>" class="form-horizontal">
        <fieldset>

        <legend>Observações para <?php echo primeiro_nome($nomeUsuario); ?></legend>

        <div class="form-group form-group-sm">
            <label for="textObs" class="col-sm-3 control-label">Observações</label>
            <div class="col-sm-9">
                <textarea name="obs" rows="10" class="form-control" id="textObs"><?php echo $obs;?></textarea>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="checkboxPerfil" class="col-sm-3 control-label">Perfil</label>
            <div class="col-sm-9">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="administrativo" value="1"<?php if ($administrativo == "1") { echo " checked"; } ?>> Administrativo
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="almoxarifado" value="1"<?php if ($almoxarifado == "1") { echo " checked"; } ?>> Almoxarifado
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="compras" value="1"<?php if ($compras == "1") { echo " checked"; } ?>> Compras
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="contabilidade" value="1"<?php if ($contabilidade == "1") { echo " checked"; } ?>> Contabilidade
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="construcao" value="1"<?php if ($construcao == "1") { echo " checked"; } ?>> Construção
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="faturamento" value="1"<?php if ($faturamento == "1") { echo " checked"; } ?>> Faturamento
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="financeiro" value="1"<?php if ($financeiro == "1") { echo " checked"; } ?>> Financeiro
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="limpeza" value="1"<?php if ($limpeza == "1") { echo " checked"; } ?>> Limpeza
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="manutencao" value="1"<?php if ($manutencao == "1") { echo " checked"; } ?>> Manutenção
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="pcp" value="1"<?php if ($pcp == "1") { echo " checked"; } ?>> PCP
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="portaria" value="1"<?php if ($portaria == "1") { echo " checked"; } ?>> Portaria
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="producao" value="1"<?php if ($producao == "1") { echo " checked"; } ?>> Produção
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="projeto" value="1"<?php if ($projeto == "1") { echo " checked"; } ?>> Projeto
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="qualidade" value="1"<?php if ($qualidade == "1") { echo " checked"; } ?>> Qualidade
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="recepcao" value="1"<?php if ($recepcao == "1") { echo " checked"; } ?>> Recepção
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="rh" value="1"<?php if ($rh == "1") { echo " checked"; } ?>> RH
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="seguranca" value="1"<?php if ($seguranca == "1") { echo " checked"; } ?>> Segurança do Trabalho
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="ti" value="1"<?php if ($ti == "1") { echo " checked"; } ?>> TI
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="transporte" value="1"<?php if ($transporte == "1") { echo " checked"; } ?>> Transporte
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="vendas" value="1"<?php if ($vendas == "1") { echo " checked"; } ?>> Vendas
                    </label>
                </div>
            </div>
        </div>

        <hr>

        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <span class="text-muted">É funcionário da Linde Vidros?</span>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="radioFuncionario" class="col-sm-3 control-label">Funcionário</label>
            <div class="col-sm-9">
                <div class="radio">
                    <label>
                        <input type="radio" name="funcionario" value="N"<?php if ($funcionarioUsuario == "N") { echo " checked"; } ?>> Não
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="funcionario" value="S"<?php if ($funcionarioUsuario == "S") { echo " checked"; } ?>> Sim
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <span class="text-muted">Já trabalhou na Linde Vidros?</span>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="radioexFuncionario" class="col-sm-3 control-label">Ex-Funcionário</label>
            <div class="col-sm-9">
                <div class="radio">
                    <label>
                        <input type="radio" name="exfuncionario" value="N"<?php if ($exfuncionarioUsuario == "N") { echo " checked"; } ?>> Não
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="exfuncionario" value="S"<?php if ($exfuncionarioUsuario == "S") { echo " checked"; } ?>> Sim
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
        </fieldset>
    </form>

    <?php
}
?>

</div>
</div>

<!-- Modal -->
<div class="modal fade" id="agendaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fas fa-calendar-alt"></i> Agendar Entrevista</h4>
            </div>
            
            <div class="modal-body">
                <form method="post" action="funcoes/entrevistas.php?funcao=cadastrar&id=<?php echo $idUsuario; ?>" class="form-horizontal">
                    <fieldset>
                    
                        <div class="form-group form-group-sm">
                            <label for="inputDataEntrevista" class="col-sm-2 control-label">Data</label>
                            <div class="col-sm-5">
                                <input type="text" name="data" class="form-control" id="inputDataEntrevista" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="inputHoraEntrevista" class="col-sm-2 control-label">Hora</label>
                            <div class="col-sm-5">
                                <input type="text" name="hora" class="form-control" id="inputHoraEntrevista" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="selectVaga" class="col-sm-2 control-label">Vaga</label>
                            <div class="col-sm-10">
                                <select name="vaga" class="form-control" id="selectVaga" required>
                                    <option></option>
                                    <?php
                                    $consulta_vagas = mysqli_query ($conexao, "SELECT * FROM vagas ORDER BY vaga") or die (mysqli_error());
                                        while ($linha = mysqli_fetch_array($consulta_vagas)) {
                                            $id_vaga	= $linha['id'];
                                            $nome_vaga	= $linha['vaga'];
                                    ?>
                                    <option value="<?php echo $id_vaga; ?>"><?php echo $nome_vaga; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group form-group-sm">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Agendar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<?php
} else {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Você não tem permissão para acessar essa página. Consulte o Administrador do sistema.
		</div>
	</div>
</div>
<?php
}
?>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
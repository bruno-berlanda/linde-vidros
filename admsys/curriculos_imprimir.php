<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_sistema.php");
include_once ("includes/usuario_logado.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>Administração - Linde Vidros</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../img/favicon.ico">
    
    <!-- JS -->
    <!--[if lt IE 9]>
    <script src="../js/html5shiv.js"></script>
	<![endif]-->
    
    <style type="text/css">
	body { font-family: Arial; font-size: 10px; color: #333; }	
	
	h1 { font-size: 25px; border-bottom: 1px solid #999; }
	
	h2 { font-size: 14px; }
	
	.ex-func { background: #000; color: #FFF; text-align: center; font-weight: bold; padding: 5px 0; margin-bottom: 10px; }
	
	.criado { color: #AAA; margin-bottom: 10px; }
	
	table { width: 100%; border-collapse: collapse; }
	table tr td { padding: 2px; vertical-align: top; }
	
	hr { border: 0; height: 0; border-top: 1px solid rgba(0, 0, 0, 0.1); border-bottom: 1px solid rgba(255, 255, 255, 0.3); margin: 10px 0 5px 0; }
	
	.nome-campo { background: #E5E5E5; padding: 5px; font-weight: bold; }
	.info-campo { padding: 5px }
	</style>
</head>

<body>

<?php
/* ****************************************************************************************************
PERMISSÃO PARA ACESSAR A PÁGINA
**************************************************************************************************** */
if ($perm_adm == "S" || $perm_curriculos == "S") {

$id = $_GET['id'];

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
	if ($estcivUsuario == "1") { $estcivUsuario = "SOLTEIRO"; }
	else if ($estcivUsuario == "2") { $estcivUsuario = "CASADO"; }
	else if ($estcivUsuario == "3") { $estcivUsuario = "DIVORCIADO"; }
	else if ($estcivUsuario == "4") { $estcivUsuario = "SEPARADO"; }
	else if ($estcivUsuario == "5") { $estcivUsuario = "VIÚVO"; }
	else if ($estcivUsuario == "6") { $estcivUsuario = "UNIÃO ESTÁVEL"; }
}
else if ($sexoUsuario == "FEMININO") {
	if ($estcivUsuario == "1") { $estcivUsuario = "SOLTEIRA"; }
	else if ($estcivUsuario == "2") { $estcivUsuario = "CASADA"; }
	else if ($estcivUsuario == "3") { $estcivUsuario = "DIVORCIADA"; }
	else if ($estcivUsuario == "4") { $estcivUsuario = "SEPARADA"; }
	else if ($estcivUsuario == "5") { $estcivUsuario = "VIÚVA"; }
	else if ($estcivUsuario == "6") { $estcivUsuario = "UNIÃO ESTÁVEL"; }
}

// Empregado Atualmente
if ($empregUsuario == "S") { $empregUsuario = "SIM"; }
else if ($empregUsuario == "N") { $empregUsuario = "NÃO"; }

// Situação
if ($situacaoUsuario == "1") { $situacaoUsuario = "ESTOU EM BUSCA DO PRIMEIRO ESTÁGIO"; }
else if ($situacaoUsuario == "2") { $situacaoUsuario = "ESTOU EM BUSCA DE OUTRO ESTÁGIO"; }
else if ($situacaoUsuario == "3") { $situacaoUsuario = "ESTOU EM BUSCA DO PRIMEIRO EMPREGO"; }
else if ($situacaoUsuario == "4") { $situacaoUsuario = "ESTOU EM BUSCA DE OUTRO EMPREGO"; }
else if ($situacaoUsuario == "5") { $situacaoUsuario = "SOU RECÉM-FORMADO, BUSCO UM EMPREGO MELHOR"; }
else if ($situacaoUsuario == "6") { $situacaoUsuario = "DESEMPREGADO RECENTEMENTE"; }
else if ($situacaoUsuario == "7") { $situacaoUsuario = "DESEMPREGADO A MAIS DE 3 MESES"; }
else if ($situacaoUsuario == "8") { $situacaoUsuario = "DESEMPREGADO A MAIS DE 1 ANO"; }

if ($filhosUsuario == "00") { $filhosUsuario = "NÃO"; }

if ($cnhUsuario == "0") { $cnhUsuario = "NÃO POSSUO CNH"; }

if ($pneUsuario == "S") { $pneUsuario = "SIM"; } else { $pneUsuario = "NÃO"; }
		
/* *************************************************
Dados Profissionais
************************************************* */
if ($areaUsuario == "1") { $areaUsuario = "ADMINISTRATIVA"; }
else if ($areaUsuario == "2") { $areaUsuario = "ALMOXARIFADO"; }
else if ($areaUsuario == "3") { $areaUsuario = "COMPRAS"; }
else if ($areaUsuario == "4") { $areaUsuario = "CONTABILIDADE"; }
else if ($areaUsuario == "5") { $areaUsuario = "CONSTRUÇÃO CIVIL"; }
else if ($areaUsuario == "6") { $areaUsuario = "FINANCEIRO"; }
else if ($areaUsuario == "7") { $areaUsuario = "MANUTENÇÃO"; }
else if ($areaUsuario == "8") { $areaUsuario = "PCP"; }
else if ($areaUsuario == "9") { $areaUsuario = "PORTARIA"; }
else if ($areaUsuario == "10") { $areaUsuario = "PRODUÇÃO"; }
else if ($areaUsuario == "11") { $areaUsuario = "PROJETO"; }
else if ($areaUsuario == "12") { $areaUsuario = "QUALIDADE"; }
else if ($areaUsuario == "13") { $areaUsuario = "RECEPÇÃO"; }
else if ($areaUsuario == "14") { $areaUsuario = "TI"; }
else if ($areaUsuario == "15") { $areaUsuario = "TRANSPORTE"; }
else if ($areaUsuario == "16") { $areaUsuario = "VENDAS"; }
else if ($areaUsuario == "17") { $areaUsuario = "LIMPEZA"; }
else if ($areaUsuario == "18") { $areaUsuario = "FATURAMENTO"; }
else if ($areaUsuario == "19") { $areaUsuario = "TÉCNICO SEGURANÇA"; }
else if ($areaUsuario == "20") { $areaUsuario = "RH"; }

if ($nivelUsuario == "1") { $nivelUsuario = "ESTAGIÁRIO"; }
else if ($nivelUsuario == "2") { $nivelUsuario = "AUXILIAR"; }
else if ($nivelUsuario == "3") { $nivelUsuario = "ASSISTENTE"; }
else if ($nivelUsuario == "4") { $nivelUsuario = "TÉCNICO"; }
else if ($nivelUsuario == "5") { $nivelUsuario = "TRAINEE"; }
else if ($nivelUsuario == "6") { $nivelUsuario = "LÍDER"; }
else if ($nivelUsuario == "7") { $nivelUsuario = "ENCARREGADO"; }
else if ($nivelUsuario == "8") { $nivelUsuario = "SUPERVISOR"; }
else if ($nivelUsuario == "9") { $nivelUsuario = "GERENTE"; }

if ($salarioUsuario == "1") { $salarioUsuario = "ATÉ R$500,00"; }
else if ($salarioUsuario == "2") { $salarioUsuario = "ATÉ R$1.000,00"; }
else if ($salarioUsuario == "3") { $salarioUsuario = "A PARTIR DE R$1.000,00"; }
else if ($salarioUsuario == "4") { $salarioUsuario = "A PARTIR DE R$1.500,00"; }
else if ($salarioUsuario == "5") { $salarioUsuario = "A PARTIR DE R$2.000,00"; }
else if ($salarioUsuario == "6") { $salarioUsuario = "A PARTIR DE R$2.500,00"; }
else if ($salarioUsuario == "7") { $salarioUsuario = "A PARTIR DE R$3.000,00"; }
else if ($salarioUsuario == "8") { $salarioUsuario = "A PARTIR DE R$4.000,00"; }
else if ($salarioUsuario == "9") { $salarioUsuario = "A PARTIR DE R$5.000,00"; }
else if ($salarioUsuario == "10") { $salarioUsuario = "A PARTIR DE R$6.000,00"; }
else if ($salarioUsuario == "11") { $salarioUsuario = "A PARTIR DE R$7.000,00"; }
else if ($salarioUsuario == "12") { $salarioUsuario = "A PARTIR DE R$8.000,00"; }
else if ($salarioUsuario == "13") { $salarioUsuario = "A PARTIR DE R$9.000,00"; }
else if ($salarioUsuario == "14") { $salarioUsuario = "A PARTIR DE R$10.000,00"; }

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
?>

<div id="conteudo">

<h1><?php echo $nomeUsuario; ?></h1>

<?php if ($exfuncionarioUsuario == "S") { ?>
<div class="ex-func">EX-FUNCIONÁRIO</div>
<?php } ?>

<div class="criado">CRIADO EM: <?php echo $criadoUsuario; ?> | ATUALIZADO EM: <?php echo $atualizadoUsuario; ?></div>

<h2>DADOS PESSOAIS</h2>

<table>
	<tr>
    	<td>
        	<div class="nome-campo">CPF</div>
            <div class="info-campo"><?php echo $cpfUsuario; ?></div>
		</td>
        <td>
        	<div class="nome-campo">RG</div>
            <div class="info-campo"><?php if ($rgUsuario != "") { echo $rgUsuario; } ?> <?php if ($uf_rgUsuario != "") { echo "/ ".$uf_rgUsuario; } ?></div>
        </td>
        <td>
        	<div class="nome-campo">E-MAIL</div>
            <div class="info-campo"></div>
        </td>
    </tr>
    <tr>
    	<td>
        	<div class="nome-campo">FONE</div>
            <div class="info-campo"><?php if ($foneUsuario != "") { echo $foneUsuario; } ?></div>
        </td>
        <td>
        	<div class="nome-campo">RECADOS</div>
            <div class="info-campo"><?php if ($recadosUsuario != "") { echo $recadosUsuario; } ?></div>
        </td>
        <td>
        	<div class="nome-campo">CELULAR</div>
            <div class="info-campo"><?php if ($celularUsuario != "") { echo $celularUsuario; } ?></div>
        </td>
    </tr>
    <tr>
    	<td colspan="3">
        	<div class="nome-campo">ENDEREÇO</div>
            <div class="info-campo"><?php if ($enderecoUsuario != "") { echo $enderecoUsuario; } ?><?php if ($numeroUsuario != "") { echo ", ".$numeroUsuario; } ?> <?php if ($bairroUsuario != "") { echo "- ".$bairroUsuario; } ?> <?php if ($cidadeUsuario != "") { echo "- ".$cidadeUsuario; } ?> <?php if ($ufUsuario != "") { echo "/ ".$ufUsuario; } ?> <?php if ($cepUsuario != "") { echo "- ".$cepUsuario; } ?> <?php if ($compUsuario != "") { echo "- ".$compUsuario; } ?></div>
        </td>
    </tr>
    <tr>
    	<td>
        	<div class="nome-campo">DATA NASCIMENTO</div>
            <div class="info-campo"><?php if ($nasc_diaUsuario != "" && $nasc_mesUsuario != "" && $nasc_anoUsuario != "") { echo $nasc_diaUsuario."/".$nasc_mesUsuario."/".$nasc_anoUsuario; echo " (". $interval->format('%Y anos').")"; } ?></div>
        </td>
        <td>
        	<div class="nome-campo">SEXO</div>
            <div class="info-campo"><?php if ($sexoUsuario != "") { echo $sexoUsuario; } ?></div>
        </td>
        <td>
        	<div class="nome-campo">ESTADO CIVIL</div>
            <div class="info-campo"><?php if ($estcivUsuario != "") { echo $estcivUsuario; } ?></div>
        </td>
    </tr>
    <tr>
    	<td colspan="3">
        	<div class="nome-campo">WEBSITE</div>
            <div class="info-campo"><?php if ($websiteUsuario != "") { echo $websiteUsuario; } ?></div>
        </td>
    </tr>
    <tr>
    	<td>
        	<div class="nome-campo">FILHOS</div>
            <div class="info-campo"><?php if ($filhosUsuario != "") { echo $filhosUsuario; } ?></div>
        </td>
        <td>
        	<div class="nome-campo">CNH</div>
            <div class="info-campo"><?php if ($cnhUsuario != "") { echo $cnhUsuario; } ?></div>
        </td>
        <td>
        	<div class="nome-campo">PNE</div>
            <div class="info-campo"><?php echo $pneUsuario; ?> <?php if ($pne_descUsuario != "") { echo "- ".$pne_descUsuario; } ?></div>
        </td>
    </tr>
    <tr>
    	<td>
        	<div class="nome-campo">EMPREGADO</div>
            <div class="info-campo"><?php if ($empregUsuario != "") { echo $empregUsuario; } ?></div>
        </td>
        <td>
        	<div class="nome-campo">SITUAÇÃO</div>
            <div class="info-campo"><?php if ($situacaoUsuario != "") { echo $situacaoUsuario; } ?></div>
        </td>
        <td>
        	<div class="nome-campo">INDICAÇÃO</div>
            <div class="info-campo"><?php if ($indicacaoUsuario != "") { echo $indicacaoUsuario; } ?></div>
        </td>
    </tr>
</table>

<h2>OBJETIVOS PROFISSIONAIS</h2>

<table>
	<tr>
    	<td>
        	<div class="nome-campo">ÁREA</div>
            <div class="info-campo"><?php if ($areaUsuario != "") { echo $areaUsuario; } ?></div>
		</td>
        <td>
        	<div class="nome-campo">NÍVEL</div>
            <div class="info-campo"><?php if ($nivelUsuario != "") { echo $nivelUsuario; } ?></div>
        </td>
        <td>
        	<div class="nome-campo">SALÁRIO</div>
            <div class="info-campo"><?php if ($salarioUsuario != "") { echo $salarioUsuario; } ?></div>
        </td>
    </tr>
    <tr>
    	<td colspan="3">
        	<div class="nome-campo">MINICURRÍCULO</div>
            <div class="info-campo"><?php echo $miniUsuario; ?></div>
        </td>
    </tr>
    <tr>
    	<td colspan="3">
        	<div class="nome-campo">OBJETIVO PROFISSIONAL</div>
            <div class="info-campo"><?php echo $objetivoUsuario; ?></div>
        </td>
    </tr>
</table>

<?php
/* ********************************************************
EXPERIÊNCIAS PROFISSIONAIS - INÍCIO
******************************************************** */
if ($contaExperiencias > 0) {
?>
<h2>EXPERIÊNCIAS PROFISSIONAIS</h2>

<table>
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
	<tr>
    	<td>
        	<div class="nome-campo">INÍCIO</div>
            <div class="info-campo"><?php if ($ini_mesExp != "" && $ini_anoExp != "") { echo $ini_mesExp."/".$ini_anoExp; } ?></div>
        </td>
        <td>
        	<div class="nome-campo">SAÍDA</div>
            <div class="info-campo"><?php if ($sai_mesExp != "" && $sai_anoExp != "") { echo $sai_mesExp."/".$sai_anoExp; } ?></div>
        </td>
        <td>
        	<div class="nome-campo">SALÁRIO</div>
            <div class="info-campo"><?php if ($salarioExp != "") { echo "R$ ".$salarioExp; } ?></div>
        </td>
    </tr>
    <tr>
    	<td colspan="2">
        	<div class="nome-campo">EMPRESA</div>
            <div class="info-campo"><?php if ($empresaExp != "") { echo $empresaExp; } ?></div>
         </td>
         <td>   
            <div class="nome-campo">CARGO</div>
            <div class="info-campo"><?php if ($cargoExp != "") { echo $cargoExp; } ?></div>
        </td>
	</tr>
    <tr>
        <td colspan="3">
            <div class="nome-campo">DESCRIÇÃO DAS FUNÇÕES</div>
            <div class="info-campo"><?php echo $descricaoExp; ?></div>
        </td>
    </tr>
    <tr>
    	<td colspan="3">
        	<hr>
        </td>
    </tr>
<?php
	}
?>
</table>
<?php
}
/* ********************************************************
EXPERIÊNCIAS PROFISSIONAIS - FIM
******************************************************** */
?>

<?php
/* ********************************************************
ESCOLARIDADE - INÍCIO
******************************************************** */
if ($contaEscolaridade > 0) {
?>
<h2>ESCOLARIDADE</h2>

<table>
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
	<tr>
    	<td>
        	<div class="nome-campo">INÍCIO</div>
            <div class="info-campo"><?php if ($ini_mesEsc != "" && $ini_anoEsc != "") { echo $ini_mesEsc."/".$ini_anoEsc; } ?></div>
        </td>
        <td>
        	<div class="nome-campo">TÉRMINO</div>
            <div class="info-campo"><?php if ($con_mesEsc != "" && $con_anoEsc != "") { echo $con_mesEsc."/".$con_anoEsc; } ?></div>
        </td>
        <td>
        	<div class="nome-campo">SITUAÇÃO</div>
            <div class="info-campo"><?php if ($situacaoEsc != "") { echo $situacaoEsc; } ?></div>
        </td>
    </tr>
    <tr>
    	<td colspan="2">
        	<div class="nome-campo">CURSO</div>
            <div class="info-campo"><?php if ($cursoEsc != "") { echo $cursoEsc; } ?></div>
        </td>
        <td>
        	<div class="nome-campo">GRAU</div>
            <div class="info-campo"><?php if ($grauEsc != "") { echo $grauEsc; } ?></div>
        </td>
    </tr>
    <tr>
    	<td colspan="3">
        	<hr>
        </td>
    </tr>
<?php
	}
?>
</table>
<?php
}
/* ********************************************************
ESCOLARIDADE - FIM
******************************************************** */
?>

<?php
/* ********************************************************
FORMAÇÃO COMPLEMENTAR - INÍCIO
******************************************************** */
if ($contaFormacao > 0) {
?>
<h2>FORMAÇÃO COMPLEMENTAR</h2>

<table>
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
	<tr>
    	<td>
        	<div class="nome-campo">INÍCIO</div>
            <div class="info-campo"><?php if ($ini_mesFor != "" && $ini_anoFor != "") { echo $ini_mesFor."/".$ini_anoFor; } ?></div>
        </td>
        <td>
        	<div class="nome-campo">TÉRMINO</div>
            <div class="info-campo"><?php if ($con_mesFor != "" && $con_anoFor != "") { echo $con_mesFor."/".$con_anoFor; } ?></div>
        </td>
        <td>
        	<div class="nome-campo">SITUAÇÃO</div>
            <div class="info-campo"><?php if ($situacaoFor != "") { echo $situacaoFor; } ?></div>
        </td>
    </tr>
    <tr>
    	<td colspan="2">
        	<div class="nome-campo">ATIVIDADE</div>
            <div class="info-campo"><?php if ($atividadeFor != "") { echo $atividadeFor; } ?></div>
        </td>
        <td>
        	<div class="nome-campo">CARGA HORÁRIA</div>
            <div class="info-campo"><?php if ($cargaFor != "") { echo $cargaFor." (horas)"; } ?></div>
        </td>
    </tr>
    <tr>
    	<td colspan="3">
        	<hr>
        </td>
    </tr>
<?php
	}
?>
</table>
<?php
}
/* ********************************************************
FORMAÇÃO COMPLEMENTAR - FIM
******************************************************** */
?>

<?php
/* ********************************************************
INFORMÁTICA - INÍCIO
******************************************************** */
if ($contaInformatica > 0) {
?>
<h2>CONHECIMENTO EM INFORMÁTICA</h2>

<table>
	<tr>
    	<td colspan="2">
        	<div class="nome-campo">APLICATIVO</div>
        </td>
        <td>
        	<div class="nome-campo">NÍVEL</div>
        </td>
    </tr>
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
    <tr>
    	<td colspan="2">
            <div class="info-campo"><?php if ($softwareInf != "") { echo $softwareInf; } ?></div>
        </td>
        <td>
            <div class="info-campo"><?php if ($nivelInf != "") { echo $nivelInf; } ?></div>
        </td>
    </tr>
<?php
	}
?>
</table>
<?php
}
/* ********************************************************
INFORMÁTICA - FIM
******************************************************** */
?>

<?php
/* ********************************************************
IDIOMAS - INÍCIO
******************************************************** */
if ($contaLinguas > 0) {
?>
<h2>CONHECIMENTO EM IDIOMAS</h2>

<table>
	<tr>
    	<td colspan="2">
        	<div class="nome-campo">IDIOMA</div>
        </td>
        <td>
        	<div class="nome-campo">NÍVEL</div>
        </td>
    </tr>
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
    <tr>
    	<td colspan="2">
            <div class="info-campo"><?php if ($idiomaLin != "") { echo $idiomaLin; } ?></div>
        </td>
        <td>
            <div class="info-campo"><?php if ($nivelLin != "") { echo $nivelLin; } ?></div>
        </td>
    </tr>
<?php
	}
?>
</table>
<?php
}
/* ********************************************************
IDIOMAS - FIM
******************************************************** */
?>

<?php
/* ********************************************************
OUTRAS INFORMAÇÕES - INÍCIO
******************************************************** */
if ($esportesUsuario != "" || $hobbiesUsuario != "" || $livrosUsuario != "" || $musicaUsuario != "" || $paixoesUsuario != "" || $trabsocialUsuario != "") {
?>

<h2>OUTRAS INFORMAÇÕES</h2>

<table>
	<tr>
    	<td>
        	<div class="nome-campo">ESPORTES</div>
            <div class="info-campo"><?php echo $esportesUsuario; ?></div>
        </td>
        <td>
        	<div class="nome-campo">HOBBIES</div>
            <div class="info-campo"><?php echo $hobbiesUsuario; ?></div>
        </td>
        <td>
        	<div class="nome-campo">LIVROS</div>
            <div class="info-campo"><?php echo $livrosUsuario; ?></div>
        </td>
    </tr>
    <tr>
    	<td>
        	<div class="nome-campo">MÚSICA</div>
            <div class="info-campo"><?php echo $musicaUsuario; ?></div>
        </td>
        <td>
        	<div class="nome-campo">PAIXÕES</div>
            <div class="info-campo"><?php echo $paixoesUsuario; ?></div>
        </td>
        <td>
        	<div class="nome-campo">TRABALHO SOCIAL</div>
            <div class="info-campo"><?php echo $trabsocialUsuario; ?></div>
        </td>
    </tr>
</table>

<?php
}
/* ********************************************************
OUTRAS INFORMAÇÕES - FINAL
******************************************************** */
?>

</div>

<?php
}
else {
	header ('Location: admsys.php?msgErro=Você não tem permissão para imprimir currículos');	
}
?>

</body>

</html>
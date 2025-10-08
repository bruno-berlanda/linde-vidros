<?php
include_once ("../../funcoes/conexao.php");
include_once ("../includes/permissao_curriculos.php");
include_once ("../includes/usuario_logado.php");
include_once ("funcoes.php");

// Data da atualização
$data = date("Y-m-d H:i:s");

$c_usuario = $_GET['u'];

// Dados do formulário
$nome 			= caracteres(strip_tags(trim($_POST['nome'])));
$email 			= caracteres(strip_tags(trim($_POST['email'])));
$data_nasc		= strip_tags(trim($_POST['data_nasc']));
$sexo			= strip_tags(trim($_POST['sexo']));
$estado_civil	= strip_tags(trim($_POST['estado_civil']));
$filhos			= strip_tags(trim($_POST['filhos']));

$rg				= caracteres(strip_tags(trim($_POST['rg'])));
$uf_rg			= strip_tags(trim($_POST['uf_rg']));
$cnh			= strip_tags(trim($_POST['cnh']));

$fone			= caracteres(strip_tags(trim($_POST['fone'])));
$recados		= caracteres(strip_tags(trim($_POST['recados'])));
$celular		= caracteres(strip_tags(trim($_POST['celular'])));
$website		= caracteres(strip_tags(trim($_POST['website'])));

$endereco		= caracteres(strip_tags(trim($_POST['endereco'])));
$numero			= caracteres(strip_tags(trim($_POST['numero'])));
$complemento	= caracteres(strip_tags(trim($_POST['complemento'])));
$bairro			= caracteres(strip_tags(trim($_POST['bairro'])));
$cep 			= caracteres(strip_tags(trim($_POST['cep'])));
$cidade			= caracteres(strip_tags(trim($_POST['cidade'])));
$uf				= strip_tags(trim($_POST['uf']));

$pne			= strip_tags(trim($_POST['pne']));
$pne_desc		= caracteres(strip_tags(trim($_POST['pne_desc'])));

$indicacao		= caracteres(strip_tags(trim($_POST['indicacao'])));

$empregado		= strip_tags(trim($_POST['empregado']));
$situacao		= strip_tags(trim($_POST['situacao']));

$area			= strip_tags(trim($_POST['area']));
$nivel			= strip_tags(trim($_POST['nivel']));
$salario		= strip_tags(trim($_POST['salario']));
$objetivo		= caracteres(strip_tags(trim($_POST['objetivo'])));
$mini			= caracteres(strip_tags(trim($_POST['mini'])));

// PNE
if ($pne == "N") { $pne_desc = ""; }

// Converter texto para maiusculas
$nome 			= strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$recados 		= strtr(strtoupper($recados),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$endereco 		= strtr(strtoupper($endereco),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$complemento 	= strtr(strtoupper($complemento),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$bairro 		= strtr(strtoupper($bairro),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$cidade 		= strtr(strtoupper($cidade),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$pne_desc 		= strtr(strtoupper($pne_desc),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$indicacao 		= strtr(strtoupper($indicacao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$objetivo 		= strtr(strtoupper($objetivo),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$mini 			= strtr(strtoupper($mini),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

// Converter texto para MINÚSCULO
$email = strtolower($email);
$website = strtolower($website);

// Data de Nascimento
$dt = explode ("/", $data_nasc);
	$nasc_dia = $dt[0];
	$nasc_mes = $dt[1];
	$nasc_ano = $dt[2];

$atualiza = mysqli_query ($conexao, "UPDATE usuarios SET nome='$nome', email='$email', atualizado='$data', pne='$pne', pne_desc='$pne_desc', indicacao='$indicacao', lido='0', ativo='1', sexo='$sexo', estado_civil='$estado_civil', filhos='$filhos', rg='$rg', uf_rg='$uf_rg', nasc_dia='$nasc_dia', nasc_mes='$nasc_mes', nasc_ano='$nasc_ano', fone='$fone', recados='$recados', celular='$celular', website='$website', endereco='$endereco', numero='$numero', complemento='$complemento', bairro='$bairro', cep='$cep', cidade='$cidade', uf='$uf', empregado='$empregado', situacao='$situacao', cnh='$cnh', area='$area', nivel='$nivel', salario='$salario', objetivo='$objetivo', mini='$mini' WHERE codigo='$c_usuario'") or die (mysqli_error());

header ('Location: ../dadospessoais.php?msgSucesso=Dados pessoais atualizados com sucesso.');
<?php
include_once ("../../funcoes/conexao.php");
include_once ("../includes/permissao_curriculos.php");
include_once ("../includes/usuario_logado.php");
include_once ("funcoes.php");

// Data da atualização
$data = date("Y-m-d H:i:s");

/* **********************************************************************
CADASTRAR
********************************************************************** */
if ($_GET['funcao'] == "cadastrar") {

$c_usuario	= $_GET['u'];

$consulta_cod = mysqli_query ($conexao, "SELECT id FROM usuarios WHERE codigo='$c_usuario'") or die (mysqli_error());
	$d = mysqli_fetch_array ($consulta_cod);
		$id_usuario = $d['id'];

// Dados do formulário
$data_inicio 	= strip_tags(trim($_POST['data_inicio']));
$data_saida 	= strip_tags(trim($_POST['data_saida']));
$empresa 		= caracteres(strip_tags(trim($_POST['empresa'])));
$cargo	 		= caracteres(strip_tags(trim($_POST['cargo'])));
$descricao 		= caracteres(strip_tags(trim($_POST['descricao'])));
$salario 		= caracteres(strip_tags(trim($_POST['salario'])));

// Converter texto para maiusculas
$empresa 	= strtr(strtoupper($empresa),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$cargo 		= strtr(strtoupper($cargo),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$descricao 	= strtr(strtoupper($descricao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

// Tratamento das Datas
$dt_inicio = explode ("/", $data_inicio);
	$ini_mes = $dt_inicio[0];
	$ini_ano = $dt_inicio[1];

$dt_saida = explode ("/", $data_saida);
	$sai_mes = $dt_saida[0];
	$sai_ano = $dt_saida[1];

$cadastra = mysqli_query ($conexao, "INSERT INTO usuarios_experiencias (id_usuario, ini_mes, ini_ano, sai_mes, sai_ano, empresa, cargo, descricao, salario) VALUES ('$id_usuario', '$ini_mes', '$ini_ano', '$sai_mes', '$sai_ano', '$empresa', '$cargo', '$descricao', '$salario')") or die (mysqli_error());
$atualiza = mysqli_query ($conexao, "UPDATE usuarios SET atualizado='$data', lido='0' WHERE codigo='$c_usuario'") or die (mysqli_error());
	header ('Location: ../expprofissional.php?msgSucesso=Experiência profissional cadastrada com sucesso');

}

/* **********************************************************************
EDITAR
********************************************************************** */
if ($_GET['funcao'] == "editar") {

$id 		= $_GET['id'];
$c_usuario	= $_GET['u'];

$consulta_cod = mysqli_query ($conexao, "SELECT id FROM usuarios WHERE codigo='$c_usuario'") or die (mysqli_error());
	$d = mysqli_fetch_array ($consulta_cod);
		$id_usuario = $d['id'];

// Verifica se o ID do item selecionado pertence ao usuário logado
$verifica_id = mysqli_query ($conexao, "SELECT id_usuario FROM usuarios_experiencias WHERE id=$id") or die (mysqli_error());
	$dados = mysqli_fetch_array ($verifica_id);
		$idUsuario_editar = $dados['id_usuario'];
		
// Se o ID for de outro usuário, retorna pra home com erro
if ($id_usuario != $idUsuario_editar) {
	header ('Location: ../expprofissional.php?msgErro=Você não tem permissão para acessar essa página');
}
else if ($id_usuario != $idUsuario) {
	header ('Location: ../expprofissional.php?msgErro=Você não tem permissão para acessar essa página');
}
else {

// Dados do formulário
$data_inicio 	= strip_tags(trim($_POST['data_inicio']));
$data_saida 	= strip_tags(trim($_POST['data_saida']));
$empresa 		= caracteres(strip_tags(trim($_POST['empresa'])));
$cargo	 		= caracteres(strip_tags(trim($_POST['cargo'])));
$descricao 		= caracteres(strip_tags(trim($_POST['descricao'])));
$salario 		= caracteres(strip_tags(trim($_POST['salario'])));

// Converter texto para maiusculas
$empresa 	= strtr(strtoupper($empresa),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$cargo 		= strtr(strtoupper($cargo),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$descricao 	= strtr(strtoupper($descricao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

// Tratamento das Datas
$dt_inicio = explode ("/", $data_inicio);
	$ini_mes = $dt_inicio[0];
	$ini_ano = $dt_inicio[1];

$dt_saida = explode ("/", $data_saida);
	$sai_mes = $dt_saida[0];
	$sai_ano = $dt_saida[1];

	$atualiza1 = mysqli_query ($conexao, "UPDATE usuarios_experiencias SET ini_mes='$ini_mes', ini_ano='$ini_ano', sai_mes='$sai_mes', sai_ano='$sai_ano', empresa='$empresa', cargo='$cargo', descricao='$descricao', salario='$salario' WHERE id='$id'") or die (mysqli_error());
	$atualiza2 = mysqli_query ($conexao, "UPDATE usuarios SET atualizado='$data', lido='0' WHERE codigo='$c_usuario'") or die (mysqli_error());
	
	header ('Location: ../expprofissional.php?msgSucesso=Experiência profissional alterada com sucesso');
	
}

}

/* **********************************************************************
EXCLUIR
********************************************************************** */
if ($_GET['funcao'] == "excluir") {

$id 		= $_GET['id'];
$c_usuario	= $_GET['u'];

$consulta_cod = mysqli_query ($conexao, "SELECT id FROM usuarios WHERE codigo='$c_usuario'") or die (mysqli_error());
	$d = mysqli_fetch_array ($consulta_cod);
		$id_usuario = $d['id'];

// Verifica se o ID do item selecionado pertence ao usuário logado
$verifica_id = mysqli_query ($conexao, "SELECT id_usuario FROM usuarios_experiencias WHERE id=$id") or die (mysqli_error());
	$dados = mysqli_fetch_array ($verifica_id);
		$idUsuario_exp = $dados['id_usuario'];
		
		// Se o ID for de outro usuário, retorna pra home com erro
		if ($id_usuario != $idUsuario_exp) {
			header ('Location: ../expprofissional.php?msgErro=Você não tem permissão para acessar essa página');
		}
		else {

			$exclui = mysqli_query ($conexao, "DELETE FROM usuarios_experiencias WHERE id='$id'") or die (mysqli_error());

			$atualiza = mysqli_query ($conexao, "UPDATE usuarios SET atualizado='$data' WHERE codigo='$c_usuario'") or die (mysqli_error());
			header ('Location: ../expprofissional.php?msgSucesso=Experiência profissional excluída com sucesso');
		}
}
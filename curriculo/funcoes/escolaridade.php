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
$data_conclusao	= strip_tags(trim($_POST['data_conclusao']));
$instituicao	= caracteres(strip_tags(trim($_POST['instituicao'])));
$curso	 		= caracteres(strip_tags(trim($_POST['curso'])));
$grau 			= strip_tags(trim($_POST['grau']));
$situacao 		= strip_tags(trim($_POST['situacao']));

// Converter texto para maiusculas
$instituicao	= strtr(strtoupper($instituicao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$curso 			= strtr(strtoupper($curso),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

// Tratamento das Datas
$dt_inicio = explode ("/", $data_inicio);
	$ini_mes = $dt_inicio[0];
	$ini_ano = $dt_inicio[1];

$dt_conc = explode ("/", $data_conclusao);
	$con_mes = $dt_conc[0];
	$con_ano = $dt_conc[1];

$cadastra = mysqli_query ($conexao, "INSERT INTO usuarios_escolaridade (id_usuario, ini_mes, ini_ano, con_mes, con_ano, instituicao, curso, grau, situacao) VALUES ('$id_usuario', '$ini_mes', '$ini_ano', '$con_mes', '$con_ano', '$instituicao', '$curso', '$grau', '$situacao')") or die (mysqli_error());
$atualiza = mysqli_query ($conexao, "UPDATE usuarios SET atualizado='$data', lido='0', ativo='1' WHERE codigo='$c_usuario'") or die (mysqli_error());
	
	header ('Location: ../escolaridade.php?msgSucesso=Escolaridade cadastrada com sucesso');

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
$verifica_id = mysqli_query ($conexao, "SELECT id_usuario FROM usuarios_escolaridade WHERE id=$id") or die (mysqli_error());
	$dados = mysqli_fetch_array ($verifica_id);
		$idUsuario_editar = $dados['id_usuario'];
		
// Se o ID for de outro usuário, retorna pra home com erro
if ($id_usuario != $idUsuario_editar) {
	header ('Location: ../escolaridade.php?msgErro=Você não tem permissão para acessar essa página');
}
else if ($id_usuario != $idUsuario) {
	header ('Location: ../escolaridade.php?msgErro=Você não tem permissão para acessar essa página');
}
else {

// Dados do formulário
$data_inicio 	= strip_tags(trim($_POST['data_inicio']));
$data_conclusao	= strip_tags(trim($_POST['data_conclusao']));
$instituicao	= caracteres(strip_tags(trim($_POST['instituicao'])));
$curso	 		= caracteres(strip_tags(trim($_POST['curso'])));
$grau 			= strip_tags(trim($_POST['grau']));
$situacao 		= strip_tags(trim($_POST['situacao']));

// Converter texto para maiusculas
$instituicao	= strtr(strtoupper($instituicao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$curso 			= strtr(strtoupper($curso),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

// Tratamento das Datas
$dt_inicio = explode ("/", $data_inicio);
	$ini_mes = $dt_inicio[0];
	$ini_ano = $dt_inicio[1];

$dt_conc = explode ("/", $data_conclusao);
	$con_mes = $dt_conc[0];
	$con_ano = $dt_conc[1];

	$atualiza1 = mysqli_query ($conexao, "UPDATE usuarios_escolaridade SET ini_mes='$ini_mes', ini_ano='$ini_ano', con_mes='$con_mes', con_ano='$con_ano', instituicao='$instituicao', curso='$curso', grau='$grau', situacao='$situacao' WHERE id='$id'") or die (mysqli_error());
	$atualiza2 = mysqli_query ($conexao, "UPDATE usuarios SET atualizado='$data', lido='0', ativo='1' WHERE codigo='$c_usuario'") or die (mysqli_error());
	
	header ('Location: ../escolaridade.php?msgSucesso=Escolaridade alterada com sucesso');
	
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
$verifica_id = mysqli_query ($conexao, "SELECT id_usuario FROM usuarios_escolaridade WHERE id=$id") or die (mysqli_error());
	$dados = mysqli_fetch_array ($verifica_id);
		$idUsuario_esc = $dados['id_usuario'];
		
		// Se o ID for de outro usuário, retorna pra home com erro
		if ($id_usuario != $idUsuario_esc) {
			header ('Location: ../escolaridade.php?msgErro=Você não tem permissão para acessar essa página');
		}
		else {

			$exclui = mysqli_query ($conexao, "DELETE FROM usuarios_escolaridade WHERE id='$id'") or die (mysqli_error());

			$atualiza = mysqli_query ($conexao, "UPDATE usuarios SET atualizado='$data' WHERE codigo='$c_usuario'") or die (mysqli_error());
			header ('Location: ../escolaridade.php?msgSucesso=Escolaridade excluída com sucesso');
		}
}
<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_adm == "S" || $perm_representantes == "S") {
	
/* ******************************************************************************************************************
CADASTRAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "cadastrar") {

// Dados do formulário
$nome 				= strip_tags(trim($_POST['nome']));
$usuario			= strip_tags(trim($_POST['usuario']));
$pwd 				= strip_tags(trim($_POST['senha']));

$email 				= strip_tags(trim($_POST['email']));
$fone1 				= strip_tags(trim($_POST['tel_fixo']));
$fone2 				= strip_tags(trim($_POST['tel_celular1']));
$fone3 				= strip_tags(trim($_POST['tel_celular2']));

$tipo 				= strip_tags(trim($_POST['tipo']));
$segmento			= strip_tags(trim($_POST['segmento']));

$p_diario_resp		= strip_tags(trim($_POST['p_diario_responsavel']));
$p_pedmov_resp		= strip_tags(trim($_POST['p_pedmov_responsavel']));

if (!$_POST['p_promocoes']) { $p_promocoes = "N"; } else { $p_promocoes = strip_tags(trim($_POST['p_promocoes'])); }
if (!$_POST['p_tabelas']) { $p_tabelas = "N"; } else { $p_tabelas = strip_tags(trim($_POST['p_tabelas'])); }
if (!$_POST['p_orcamentos']) { $p_orcamentos = "N"; } else { $p_orcamentos = strip_tags(trim($_POST['p_orcamentos'])); }
if (!$_POST['p_agenda']) { $p_agenda = "N"; } else { $p_agenda = strip_tags(trim($_POST['p_agenda'])); }
if (!$_POST['p_croquis']) { $p_croquis = "N"; } else { $p_croquis = strip_tags(trim($_POST['p_croquis'])); }
if (!$_POST['p_materiais']) { $p_materiais = "N"; } else { $p_materiais = strip_tags(trim($_POST['p_materiais'])); }
if (!$_POST['p_procedimentos']) { $p_procedimentos = "N"; } else { $p_procedimentos = strip_tags(trim($_POST['p_procedimentos'])); }
if (!$_POST['p_normas']) { $p_normas = "N"; } else { $p_normas = strip_tags(trim($_POST['p_normas'])); }
if (!$_POST['p_metas']) { $p_metas = "N"; } else { $p_metas = strip_tags(trim($_POST['p_metas'])); }
if (!$_POST['p_insulado']) { $p_insulado = "N"; } else { $p_insulado = strip_tags(trim($_POST['p_insulado'])); }
if (!$_POST['p_pedmov_gerenciar']) { $p_pedmov_gerenciar = "N"; } else { $p_pedmov_gerenciar = strip_tags(trim($_POST['p_pedmov_gerenciar'])); }
if (!$_POST['p_pedmov_solicitar']) { $p_pedmov_solicitar = "N"; } else { $p_pedmov_solicitar = strip_tags(trim($_POST['p_pedmov_solicitar'])); }
if (!$_POST['p_diario']) { $p_diario = "N"; } else { $p_diario = strip_tags(trim($_POST['p_diario'])); }
if (!$_POST['p_diario_gerente']) { $p_diario_gerente = "N"; } else { $p_diario_gerente = strip_tags(trim($_POST['p_diario_gerente'])); }

// Converter texto para MINÚSCULO
$usuario 	= strtolower($usuario);
$email 		= strtolower($email);

// Senha
$senha 		= md5($pwd);

/* ************ */
// Conta cadastro
$consultaCad = mysqli_query ($conexao, "SELECT id FROM representantes WHERE nome='$nome'") or die (mysqli_error());
$contaCad = mysqli_num_rows ($consultaCad);

// Conta login
$consultaUse = mysqli_query ($conexao, "SELECT id FROM representantes WHERE login='$usuario'") or die (mysqli_error());
$contaUse = mysqli_num_rows ($consultaUse);
/* ************ */

if ($contaCad == 1) {
	header ('Location: ../representantes.php?msgErro=Nome já cadastrado');
}
else if ($contaUse == 1) {
	header ('Location: ../representantes.php?msgErro=Usuário já cadastrado');
}
else {
	$cadastra = mysqli_query ($conexao, "INSERT INTO representantes (nome, login, senha, email, fone1, fone2, fone3, tipo, segmento, p_promocoes, p_tabelas, p_orcamentos, p_agenda, p_croquis, p_materiais, p_procedimentos, p_normas, p_metas, p_insulado, p_diario, p_diario_gerente, p_diario_responsavel, p_pedmov_solicitar, p_pedmov_gerenciar, p_pedmov_responsavel, pwd) VALUES ('$nome', '$usuario', '$senha', '$email', '$fone1', '$fone2', '$fone3', '$tipo', '$segmento', '$p_promocoes', '$p_tabelas', '$p_orcamentos', '$p_agenda', '$p_croquis', '$p_materiais', '$p_procedimentos', '$p_normas', '$p_metas', '$p_insulado', '$p_diario', '$p_diario_gerente', '$p_diario_resp', '$p_pedmov_solicitar', '$p_pedmov_gerenciar', '$p_pedmov_resp', '$pwd')") or die (mysqli_error());

	header ('Location: ../representantes.php?msgSucesso=Representante cadastrado com sucesso');
}

}

/* ******************************************************************************************************************
EDITAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "editar") {

$id 	= $_GET['id'];
$tipo 	= $_GET['t'];
$status = $_GET['s'];

if ($id == 1) {
	
	header("Location: ../niveis.php?msgErro=Você não tem permissão para fazer isso");

}
else {

// Dados do formulário
$nome 				= strip_tags(trim($_POST['nome']));
$usuario			= strip_tags(trim($_POST['usuario']));
$pwd 				= strip_tags(trim($_POST['senha']));

$email 				= strip_tags(trim($_POST['email']));
$fone1 				= strip_tags(trim($_POST['tel_fixo']));
$fone2 				= strip_tags(trim($_POST['tel_celular1']));
$fone3 				= strip_tags(trim($_POST['tel_celular2']));

$tipo 				= strip_tags(trim($_POST['tipo']));
$segmento			= strip_tags(trim($_POST['segmento']));

$p_diario_resp		= strip_tags(trim($_POST['p_diario_responsavel']));
$p_pedmov_resp		= strip_tags(trim($_POST['p_pedmov_responsavel']));

if (!$_POST['p_promocoes']) { $p_promocoes = "N"; } else { $p_promocoes = strip_tags(trim($_POST['p_promocoes'])); }
if (!$_POST['p_tabelas']) { $p_tabelas = "N"; } else { $p_tabelas = strip_tags(trim($_POST['p_tabelas'])); }
if (!$_POST['p_orcamentos']) { $p_orcamentos = "N"; } else { $p_orcamentos = strip_tags(trim($_POST['p_orcamentos'])); }
if (!$_POST['p_agenda']) { $p_agenda = "N"; } else { $p_agenda = strip_tags(trim($_POST['p_agenda'])); }
if (!$_POST['p_croquis']) { $p_croquis = "N"; } else { $p_croquis = strip_tags(trim($_POST['p_croquis'])); }
if (!$_POST['p_materiais']) { $p_materiais = "N"; } else { $p_materiais = strip_tags(trim($_POST['p_materiais'])); }
if (!$_POST['p_procedimentos']) { $p_procedimentos = "N"; } else { $p_procedimentos = strip_tags(trim($_POST['p_procedimentos'])); }
if (!$_POST['p_normas']) { $p_normas = "N"; } else { $p_normas = strip_tags(trim($_POST['p_normas'])); }
if (!$_POST['p_metas']) { $p_metas = "N"; } else { $p_metas = strip_tags(trim($_POST['p_metas'])); }
if (!$_POST['p_insulado']) { $p_insulado = "N"; } else { $p_insulado = strip_tags(trim($_POST['p_insulado'])); }
if (!$_POST['p_pedmov_gerenciar']) { $p_pedmov_gerenciar = "N"; } else { $p_pedmov_gerenciar = strip_tags(trim($_POST['p_pedmov_gerenciar'])); }
if (!$_POST['p_pedmov_solicitar']) { $p_pedmov_solicitar = "N"; } else { $p_pedmov_solicitar = strip_tags(trim($_POST['p_pedmov_solicitar'])); }
if (!$_POST['p_diario']) { $p_diario = "N"; } else { $p_diario = strip_tags(trim($_POST['p_diario'])); }
if (!$_POST['p_diario_gerente']) { $p_diario_gerente = "N"; } else { $p_diario_gerente = strip_tags(trim($_POST['p_diario_gerente'])); }

// Converter texto para MINÚSCULO
$usuario 	= strtolower($usuario);
$email 		= strtolower($email);

/* ************ */
// Conta cadastro
$consultaCad = mysqli_query ($conexao, "SELECT id FROM representantes WHERE nome='$nome'") or die (mysqli_error());
$contaCad = mysqli_num_rows ($consultaCad);

// Conta login
$consultaUse = mysqli_query ($conexao, "SELECT id FROM representantes WHERE login='$usuario'") or die (mysqli_error());
$contaUse = mysqli_num_rows ($consultaUse);
/* ************ */

// Hidden
$nome_atual 	= strip_tags(trim($_POST['nome_atual']));
$usuario_atual 	= strip_tags(trim($_POST['usuario_atual']));
$email_atual 	= strip_tags(trim($_POST['email_atual']));

if ($contaCad == 1 && $nome != $nome_atual) {
	header ('Location: ../representantes.php?editar='.$id.'&msgErro=Nome já cadastrado');
}
else if ($contaUse == 1 && $usuario != $usuario_atual) {
	header ('Location: ../representantes.php?editar='.$id.'&msgErro=Usuário já cadastrado');
}
else {
	
	$atualiza1 = mysqli_query ($conexao, "UPDATE representantes SET nome='$nome', login='$usuario', email='$email', fone1='$fone1', fone2='$fone2', fone3='$fone3', tipo='$tipo', segmento='$segmento',  p_promocoes='$p_promocoes', p_tabelas='$p_tabelas', p_orcamentos='$p_orcamentos', p_agenda='$p_agenda', p_croquis='$p_croquis', p_materiais='$p_materiais', p_procedimentos='$p_procedimentos', p_normas='$p_normas', p_metas='$p_metas', p_insulado='$p_insulado', p_diario='$p_diario', p_diario_gerente='$p_diario_gerente', p_diario_responsavel='$p_diario_resp', p_pedmov_solicitar='$p_pedmov_solicitar', p_pedmov_gerenciar='$p_pedmov_gerenciar', p_pedmov_responsavel='$p_pedmov_resp' WHERE id='$id'") or die (mysqli_error());
	
	if ($pwd != '') {
		
		$senha = md5($pwd);
		
		$atualiza3 = mysqli_query ($conexao, "UPDATE representantes SET senha='$senha', pwd='$pwd' WHERE id='$id'") or die (mysqli_error());
	
	}

	header ('Location: ../representantes.php?tipo='.$tipo.'&status='.$status.'&msgSucesso=Representante alterado com sucesso');
}
}

}

/* ******************************************************************************************************************
DESATIVAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "desativar") {

$id 	= $_GET['id'];
$tipo 	= $_GET['t'];
$status = $_GET['s'];

$cadastra = mysqli_query ($conexao, "UPDATE representantes SET ativo='N' WHERE id='$id'") or die (mysqli_error());

header ('Location: ../representantes.php?tipo='.$tipo.'&status='.$status.'&msgSucesso=Representante desativado com sucesso');

}

/* ******************************************************************************************************************
ATIVAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "ativar") {

$id 	= $_GET['id'];
$tipo 	= $_GET['t'];
$status = $_GET['s'];

$cadastra = mysqli_query ($conexao, "UPDATE representantes SET ativo='S' WHERE id='$id'") or die (mysqli_error());

header ('Location: ../representantes.php?tipo='.$tipo.'&status='.$status.'&msgSucesso=Representante ativado com sucesso');

}

} // Permissão para acessar a página
else {
	header ('Location: ../admsys.php?msgErro=Você não tem permissão para acessar essa página');
}
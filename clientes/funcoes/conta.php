<?php
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_clientes.php");

include_once ("../includes/usuario_logado.php");

/* ***************************************************************************
TROCA DE SENHA
*************************************************************************** */
if ($_GET['funcao'] == "senha") {
	
	$id_usuario		= $_GET['idUsuario'];
	
	$senha_atual 	= strip_tags(trim($_POST['senha_atual']));
	$senha1 		= strip_tags(trim($_POST['senha1']));
	$senha2			= strip_tags(trim($_POST['senha2']));
	
	$conSenha = mysqli_query ($conexao, "SELECT senha FROM clientes WHERE id='$id_usuario'") or die (mysql_error());
		$dados = mysql_fetch_array ($conSenha);
			$senhaBD = $dados['senha'];
	
	if ($senha_atual == $senhaBD) {
		
		if ($senha1 == $senha2) {
			$atualizaSenha = mysqli_query ($conexao, "UPDATE clientes SET senha='$senha1' WHERE id='$id_usuario'") or die (mysql_error());
			header ('Location: ../meucadastro.php?msgSucesso=Senha alterada com sucesso');
		}
		else {
			header ('Location: ../meucadastro.php?msgErro=As novas senhas digitadas não conferem');
		}
		
	}
	else {
		header ('Location: ../meucadastro.php?msgErro=A senha atual digitada não confere');
	}
	
}
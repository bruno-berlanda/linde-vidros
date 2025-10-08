<?php
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

/* ***************************************************************************
TROCA DE SENHA
*************************************************************************** */
if ($_GET['funcao'] == "senha") {
	
	$id_usuario		= $_GET['idUsuario'];
	
	$senha_atual 	= strip_tags(trim($_POST['senha_atual']));
	$senha1 		= strip_tags(trim($_POST['senha1']));
	$senha2			= strip_tags(trim($_POST['senha2']));
	
	$conSenha = mysqli_query ($conexao, "SELECT pwd FROM representantes WHERE id='$id_usuario'") or die (mysqli_error());
		$dados = mysqli_fetch_array ($conSenha);
			$senhaBD = $dados['pwd'];
	
	if ($senha_atual == $senhaBD) {
		
		if ($senha1 == $senha2) {
			
			$senha_crip = md5($senha1);
			
			$atualizaSenha = mysqli_query ($conexao, "UPDATE representantes SET senha='$senha_crip', pwd='$senha1', senha_padrao='N' WHERE id='$id_usuario'") or die (mysqli_error());
			
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
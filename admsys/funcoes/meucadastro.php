<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

/* **************************************************************************
ATUALIZAR SENHA
************************************************************************** */
if($_GET['funcao'] == "senha") {
		
	$senha_atual = md5(strip_tags(trim($_POST['senha_atual'])));
	$senha_nova1 = md5(strip_tags(trim($_POST['senha_nova1'])));
	$senha_nova2 = md5(strip_tags(trim($_POST['senha_nova2'])));
	
	$consulta_senha = mysqli_query ($conexao, "SELECT senha FROM admin_usuarios WHERE id='$id_usuario'") or die (mysqli_error());
		$dados_senha = mysqli_fetch_array ($consulta_senha);
			$senha_bd = $dados_senha['senha'];
	
	if ($senha_atual != $senha_bd) {
		header ('Location: ../meucadastro.php?msgErro=A senha atual não confere com a senha cadastrada');
	}
	elseif ($senha_nova1 != $senha_nova2) {
		header ('Location: ../meucadastro.php?msgErro=As senhas novas não conferem');
	}
	else {
		$atualizar = mysqli_query ($conexao, "UPDATE admin_usuarios SET senha='$senha_nova1' WHERE id='$id_usuario'") or die (mysqli_error());
		
		header ('Location: ../meucadastro.php?msgSucesso=Sua senha foi alterada com sucesso');
	}
	
}
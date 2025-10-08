<?php
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_curriculos.php");

include_once ("../includes/usuario_logado.php");

/* ***************************************************************************
TROCA DE SENHA
*************************************************************************** */
if ($_GET['funcao'] == "senha") {
	
	$id_usuario	= $_GET['idUsuario'];
	
	$senha = md5(strip_tags(trim($_POST['senha'])));
	
	$atualiza = mysqli_query($conexao, "UPDATE admin_usuarios SET senha='$senha' WHERE id='$id_usuario'") or die (mysqli_error());
	
	header ('Location: ../meucadastro.php?msgSucesso=Senha alterada com sucesso');

}
<?php
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

/* ***************************************************************************
CONFIGURAÇÕES
*************************************************************************** */
$id_usuario	= $_GET['idUsuario'];

$ordem_clientes = strip_tags(trim($_POST['ordem_clientes']));

$atualiza = mysqli_query ($conexao, "UPDATE representantes SET config_clientes='$ordem_clientes' WHERE id='$id_usuario'") or die (mysqli_error());
	
header ('Location: ../configuracoes.php?msgSucesso=Configurações atualizadas com sucesso');
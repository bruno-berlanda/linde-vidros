<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_adm == "S" || $perm_comentarios == "S") {
	
/* ******************************************************************************************************************
LIBERAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "liberar") {

$id = $_GET['id'];

$atualiza = mysqli_query($conexao, "UPDATE comentarios_site SET liberado='S' WHERE id='$id'") or die (mysqli_error());

	header ('Location: ../comentarios.php?msgSucesso=Comentário liberado com sucesso');

}

/* ******************************************************************************************************************
EXCLUIR
****************************************************************************************************************** */
if ($_GET['funcao'] == "excluir") {

$id = $_GET['id'];

$atualiza = mysqli_query($conexao, "UPDATE comentarios_site SET liberado='E' WHERE id='$id'") or die (mysqli_error());

	header ('Location: ../comentarios.php?msgSucesso=Comentário excluído com sucesso');

}

} // Permissão para acessar a página
else {
	header ('Location: ../admsys.php?msgErro=Você não tem permissão para acessar essa página');
}
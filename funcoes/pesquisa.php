<?php

/* ******************************************************************************************************************
RESPONDER
****************************************************************************************************************** */
if ($_GET['funcao'] == "responder") {

$p = $_GET['p'];

// Dados do formulário
$p_tra1 	= strip_tags(trim($_POST['p_tra1']));
$p_tra2 	= strip_tags(trim($_POST['p_tra2']));
$p_tra3		= strip_tags(trim($_POST['p_tra3']));
$obs_tra	= strip_tags(trim($_POST['obs_tra']));

$p_pro1		= strip_tags(trim($_POST['p_pro1']));
$p_pro2		= strip_tags(trim($_POST['p_pro2']));
$p_pro3		= strip_tags(trim($_POST['p_pro3']));
$p_pro4		= strip_tags(trim($_POST['p_pro4']));
$obs_pro	= strip_tags(trim($_POST['obs_pro']));

$p_com1		= strip_tags(trim($_POST['p_com1']));
$p_com2		= strip_tags(trim($_POST['p_com2']));
$p_com3		= strip_tags(trim($_POST['p_com3']));
$p_com4		= strip_tags(trim($_POST['p_com4']));
$p_com5		= strip_tags(trim($_POST['p_com5']));
$obs_com	= strip_tags(trim($_POST['obs_com']));

$c_tem 		= strip_tags(trim($_POST['c_tem']));
$c_sen 		= strip_tags(trim($_POST['c_sen']));
$c_lam 		= strip_tags(trim($_POST['c_lam']));
$c_tla 		= strip_tags(trim($_POST['c_tla']));
$c_ser		= strip_tags(trim($_POST['c_ser']));
$c_mar		= strip_tags(trim($_POST['c_mar']));
$c_ref		= strip_tags(trim($_POST['c_ref']));
$c_ins		= strip_tags(trim($_POST['c_ins']));
$c_hab		= strip_tags(trim($_POST['c_hab']));
$c_esp 		= strip_tags(trim($_POST['c_esp']));
$c_imp 		= strip_tags(trim($_POST['c_imp']));
$c_fer		= strip_tags(trim($_POST['c_fer']));
$c_mol		= strip_tags(trim($_POST['c_mol']));
$c_kit		= strip_tags(trim($_POST['c_kit']));
$c_alu		= strip_tags(trim($_POST['c_alu']));
$c_por 		= strip_tags(trim($_POST['c_por']));

$merlin		= strip_tags(trim($_POST['merlin']));

$outros		= strip_tags(trim($_POST['outros']));

$avaliacao	= strip_tags(trim($_POST['avaliacao']));

$obs_geral	= strip_tags(trim($_POST['obs_geral']));

$obs_tra 	= strtr(strtoupper($obs_tra),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$obs_pro 	= strtr(strtoupper($obs_pro),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$obs_com 	= strtr(strtoupper($obs_com),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$outros 	= strtr(strtoupper($outros),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$obs_geral 	= strtr(strtoupper($obs_geral),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

$data_resposta = date ("Y-m-d H:i:s");

// Conexão com o Banco de Dados
include_once ("conexao.php");

$cadastra = mysqli_query ($conexao, "UPDATE pesquisa_clientes SET 
						status='R', data_resposta='$data_resposta', 
						p_tra1='$p_tra1', p_tra2='$p_tra2', p_tra3='$p_tra3', obs_tra='$obs_tra',
						p_pro1='$p_pro1', p_pro2='$p_pro2', p_pro3='$p_pro3', p_pro4='$p_pro4', obs_pro='$obs_pro',
						p_com1='$p_com1', p_com2='$p_com2', p_com3='$p_com3', p_com4='$p_com4', p_com5='$p_com5', obs_com='$obs_com',
						c_tem='$c_tem', c_sen='$c_sen', c_lam='$c_lam', c_tla='$c_tla', c_ser='$c_ser', c_mar='$c_mar', c_ref='$c_ref', 
						c_ins='$c_ins', c_hab='$c_hab', c_esp='$c_esp', c_imp='$c_imp',
						c_fer='$c_fer', c_mol='$c_mol', c_kit='$c_kit', c_alu='$c_alu', c_por='$c_por',
						merlin='$merlin', outros='$outros', avaliacao='$avaliacao', obs_geral='$obs_geral'
						WHERE codigo='$p'") or die (mysqli_error());

mysqli_close ($conexao);

header ('Location: ../pesquisa/index.php?p='.$p.'&msgSucesso=A sua resposta foi enviada com sucesso');

}
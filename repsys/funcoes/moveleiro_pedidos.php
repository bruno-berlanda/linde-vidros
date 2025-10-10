<?php
include ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

/* Config */
$pasta = "../pedidos/moveleiro/";

/* ******************************************************************************************************************
CADASTRAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "cadastrar") {

// Dados do formulário
$cliente 		= strip_tags(trim($_POST['cliente']));
$pedido_id 		= strip_tags(trim($_POST['pedido_id']));
$prazo_entrega 	= strip_tags(trim($_POST['prazo_entrega']));
$transporte 	= strip_tags(trim($_POST['transporte']));
$frete 			= strip_tags(trim($_POST['frete']));

$pedido_id 		= strtr(strtoupper($pedido_id),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
//$forma_pgto 	= strtr(strtoupper($forma_pgto),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

/* ***** */

$codigo = md5(date("YmdHis").$cliente.rand());

// Consulta dados do cliente
//mysqli_close ($conexao);
//include_once ("../includes/conexao_interna.php");

$consulta_cliente = mysqli_query ($conexao, "SELECT a.razao_social, a.cidade, a.UF, a.rota_cliente, b.descricao FROM admin_clientes a LEFT JOIN admin_cond_pgto b ON a.cod_cliente=b.cod
WHERE a.cod_cliente='$cliente'") or die (mysqli_error());
	$dados_cliente = mysqli_fetch_array ($consulta_cliente);
		$cliente_nome 	= $dados_cliente['razao_social'];
		$cliente_cidade = $dados_cliente['cidade'];
		$cliente_uf 	= $dados_cliente['UF'];
		$cliente_rota 	= $dados_cliente['rota_cliente'];
		$cliente_pgto 	= $dados_cliente['descricao'];

//mysqli_close ($conexao_interna);

//include ("../../funcoes/conexao.php");

/* ***** */

$cadastrando = mysqli_query ($conexao, "INSERT INTO moveleiro_pedidos 
							(usuario, codigo, cliente_cod, cliente_nome, cliente_rota, cliente_cidade, cliente_uf, 
							pedido_id, forma_pgto, prazo_entrega, transporte, frete)
							VALUES
							('$id_usuario', '$codigo', '$cliente', '$cliente_nome', '$cliente_rota', '$cliente_cidade', '$cliente_uf', 
							'$pedido_id', '$cliente_pgto', '$prazo_entrega', '$transporte', '$frete')
							") or die (mysqli_error());

header ('Location: ../moveleiro-pedido-itens.php?pedido='.$codigo);

}

/* ******************************************************************************************************************
EDITAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "editar") {

$pedido = $_GET['pedido'];

// Dados do formulário
$cliente 		= strip_tags(trim($_POST['cliente']));
$pedido_id 		= strip_tags(trim($_POST['pedido_id']));
//$forma_pgto 	= strip_tags(trim($_POST['forma_pgto']));
$prazo_entrega 	= strip_tags(trim($_POST['prazo_entrega']));
$transporte 	= strip_tags(trim($_POST['transporte']));
$frete 			= strip_tags(trim($_POST['frete']));

$pedido_id 		= strtr(strtoupper($pedido_id),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$forma_pgto 	= strtr(strtoupper($forma_pgto),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

/* ***** */

// Consulta dados do cliente
//mysqli_close ($conexao);

//include_once ("../includes/conexao_interna.php");

$consulta_cliente = mysqli_query ($conexao, "SELECT a.razao_social, a.cidade, a.UF, a.rota_cliente, b.descricao FROM admin_clientes a LEFT JOIN admin_cond_pgto b ON a.cond_pagto=b.cod
WHERE a.cod_cliente='$cliente'") or die (mysqli_error());
	$dados_cliente = mysqli_fetch_array ($consulta_cliente);
		$cliente_nome 	= $dados_cliente['razao_social'];
		$cliente_cidade = $dados_cliente['cidade'];
		$cliente_uf 	= $dados_cliente['UF'];
		$cliente_rota 	= $dados_cliente['rota_cliente'];
		$cliente_pgto 	= $dados_cliente['descricao'];

//mysqli_close ($conexao_interna);

//include ("../../funcoes/conexao.php");

/* ***** */

$editando = mysqli_query ($conexao, "UPDATE moveleiro_pedidos 
						SET
						cliente_cod='$cliente', cliente_nome='$cliente_nome', cliente_rota='$cliente_rota', cliente_cidade='$cliente_cidade', cliente_uf='$cliente_uf',
						pedido_id='$pedido_id', forma_pgto='$cliente_pgto', prazo_entrega='$prazo_entrega', transporte='$transporte', frete='$frete', status='D'
						WHERE codigo='$pedido'") or die (mysqli_error());

header ('Location: ../moveleiro-pedido-itens.php?pedido='.$pedido.'&msgSucesso=Pedido atualizado com sucesso.');

}

/* ******************************************************************************************************************
SOLICITAR PEDIDO
****************************************************************************************************************** */
if ($_GET['funcao'] == "solicitar") {

$pedido = $_GET['pedido'];

$data_agora = date ("Y-m-d H:i:s");

$editando = mysqli_query ($conexao, "UPDATE moveleiro_pedidos 
						SET
						status='P', solicitado_data='$data_agora', solicitado_usuario='$id_usuario'
						WHERE codigo='$pedido'") or die (mysqli_error());

header ('Location: ../moveleiro-pedido-itens.php?pedido='.$pedido.'&msgSucesso=Pedido enviado com sucesso para o setor moveleiro.');

}

/* ******************************************************************************************************************
INCLUIR ITENS
****************************************************************************************************************** */
if ($_GET['funcao'] == "itens") {
	
$pedido 	= $_GET['pedido'];
$id_pedido 	= $_GET['id_pedido'];

// Dados do formulário
$qtde 		= strip_tags(trim($_POST['qtde']));
$un 		= strip_tags(trim($_POST['un']));
$descricao 	= strip_tags(trim($_POST['descricao']));
$embalagem 	= strip_tags(trim($_POST['embalagem']));
$preco 		= strip_tags(trim($_POST['preco']));
$ipi 		= strip_tags(trim($_POST['ipi']));

$descricao 	= strtr(strtoupper($descricao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

/* ***** */

$preco_ipi = $preco + ($preco * ($ipi / 100));

$preco_total = $qtde * $preco;
$preco_total_ipi = $qtde * $preco_ipi;

/* ***** */

/* Anexo */
if (is_file($_FILES['anexo']['tmp_name'])) {
		
	$anexo_upload = $_FILES['anexo']['name']; // Nome do arquivo original
	
	$extensao = @end(explode(".",$anexo_upload));
	
	// TRATAMENTO DO NOME DA FOTO
	$anexo_upload = $pedido."_".date("dmYHis").".".strtolower($extensao);
	
	$envia_anexo = move_uploaded_file($_FILES['anexo']['tmp_name'], $pasta.$anexo_upload);

}

/* ***** */

$codigo = md5(date("YmdHis").$descricao);

/* ***** */

$cadastrando = mysqli_query ($conexao, "INSERT INTO moveleiro_itens
						   (id_pedido, codigo, qtde, un, descricao, embalagem, ipi, preco_un, preco_ipi, preco_total, preco_total_ipi, anexo)
						   VALUES
						   ('$id_pedido', '$codigo', '$qtde', '$un', '$descricao', '$embalagem', '$ipi', '$preco', '$preco_ipi', '$preco_total', '$preco_total_ipi', '$anexo_upload')
						   ") or die (mysqli_error());

$atualiza = mysqli_query ($conexao, "UPDATE moveleiro_pedidos SET status='D' WHERE codigo='$pedido'") or die (mysqli_error());

header ('Location: ../moveleiro-pedido-itens.php?pedido='.$pedido);

}

/* ******************************************************************************************************************
EDITAR ITEM
****************************************************************************************************************** */
if ($_GET['funcao'] == "item_editar") {

$pedido = $_GET['pedido'];
$item 	= $_GET['item'];

// Dados do formulário
$qtde 		= strip_tags(trim($_POST['qtde']));
$un 		= strip_tags(trim($_POST['un']));
$descricao 	= strip_tags(trim($_POST['descricao']));
$embalagem 	= strip_tags(trim($_POST['embalagem']));
$preco 		= strip_tags(trim($_POST['preco']));
$ipi 		= strip_tags(trim($_POST['ipi']));

$descricao 	= strtr(strtoupper($descricao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

/* ***** */

$preco_ipi = $preco + ($preco * ($ipi / 100));

$preco_total = $qtde * $preco;
$preco_total_ipi = $qtde * $preco_ipi;

/* ***** */

/* Anexo */
if (is_file($_FILES['anexo']['tmp_name'])) {
		
	$consulta_anexo = mysqli_query ($conexao, "SELECT anexo FROM moveleiro_itens WHERE codigo='$item'") or die (mysqli_error());
		$d_anexo = mysqli_fetch_array ($consulta_anexo);
			$anexo_bd = $d_anexo['anexo'];
	
	unlink ($pasta.$anexo_bd);
	
	$anexo_upload = $_FILES['anexo']['name']; // Nome do arquivo original
	
	$extensao = @end(explode(".",$anexo_upload));
	
	// TRATAMENTO DO NOME DA FOTO
	$anexo_upload = $pedido."_".date("dmYHis").".".strtolower($extensao);
	
	$envia_anexo = move_uploaded_file($_FILES['anexo']['tmp_name'], $pasta.$anexo_upload);
	
	$atualiza = mysqli_query ($conexao, "UPDATE moveleiro_itens 
							SET
							anexo='$anexo_upload'
							WHERE codigo='$item'") or die (mysqli_error());

}

$editando = mysqli_query ($conexao, "UPDATE moveleiro_itens 
						SET
						qtde='$qtde', un='$un', descricao='$descricao', embalagem='$embalagem', ipi='$ipi',
						preco_un='$preco', preco_ipi='$preco_ipi', preco_total='$preco_total', preco_total_ipi='$preco_total_ipi'
						WHERE codigo='$item'") or die (mysqli_error());

header ('Location: ../moveleiro-pedido-itens.php?pedido='.$pedido.'&msgSucesso=Item atualizado com sucesso.');

}

/* ******************************************************************************************************************
EXCLUIR ITEM
****************************************************************************************************************** */
if ($_GET['funcao'] == "excluir_item") {

$pedido 	= $_GET['pedido'];
$item 		= $_GET['item'];

$consulta_anexo = mysqli_query ($conexao, "SELECT anexo FROM moveleiro_itens WHERE codigo='$item'") or die (mysqli_error());
	$dados_anexo = mysqli_fetch_array ($consulta_anexo);
		$anexo = $dados_anexo['anexo'];
		
unlink($pasta.$anexo);
	
$excluir = mysqli_query ($conexao, "DELETE FROM moveleiro_itens WHERE codigo='$item'") or die (mysqli_error());

$atualiza = mysqli_query ($conexao, "UPDATE moveleiro_pedidos SET status='D' WHERE codigo='$pedido'") or die (mysqli_error());

header ('Location: ../moveleiro-pedido-itens.php?pedido='.$pedido.'&msgSucesso=O item foi excluído com sucesso.');

}

/* ******************************************************************************************************************
EXCLUIR PEDIDO
****************************************************************************************************************** */
if ($_GET['funcao'] == "excluir_pedido") {

$pedido 	= $_GET['pedido'];

$consulta_pedido = mysqli_query ($conexao, "SELECT id, usuario, cliente_cod, cliente_nome, status FROM moveleiro_pedidos WHERE codigo='$pedido'") or die (mysqli_error());
	$dados_pedido = mysqli_fetch_array ($consulta_pedido);
		$pedido_id 			= $dados_pedido['id'];
		$pedido_usuario		= $dados_pedido['usuario'];
		$pedido_cli_cod 	= $dados_pedido['cliente_cod'];
		$pedido_cli_nome	= $dados_pedido['cliente_nome'];
		$pedido_status 		= $dados_pedido['status'];
		
		$n_id = str_pad($pedido_id, 5, "0", STR_PAD_LEFT);

$consulta_itens = mysqli_query ($conexao, "SELECT anexo FROM moveleiro_itens WHERE id_pedido='$pedido_id'") or die (mysqli_error());
while ($dados_itens = mysqli_fetch_array ($consulta_itens)) {
	$anexo = $dados_itens['anexo'];
	
	unlink($pasta.$anexo);	
}
	
$excluir1 = mysqli_query ($conexao, "DELETE FROM moveleiro_itens WHERE id_pedido='$pedido_id'") or die (mysqli_error());
$excluir2 = mysqli_query ($conexao, "DELETE FROM moveleiro_pedidos WHERE id='$pedido_id'") or die (mysqli_error());

// Se o status for igual a 'R' envia um e-mail alertando o setor moveleiro
if ($pedido_status == "R") {
	
	// Consulta o Requerente do Pedido
	$consulta_requerente = mysqli_query ($conexao, "SELECT nome FROM representantes WHERE id='$pedido_usuario'") or die (mysqli_error());
		$dados_requerente = mysqli_fetch_array ($consulta_requerente);
			$requerente_nome = $dados_requerente['nome'];
	
	/* **********************************************
	ENVIANDO O E-MAIL
	********************************************** */
	// Inclui o arquivo PHPMailerAutoload.php localizado na pasta phpmailer
	require_once ("../../phpmailer/PHPMailerAutoload.php");
	
	// Inicia a classe PHPMailer
	$mail = new PHPMailer();
	
	include_once ("../../funcoes/conexao_email.php");
	
	// Define os destinatário(s)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->AddAddress('deivid@lindevidros.com.br', 'Deivid');
	$mail->AddAddress('felipe.brand@lindevidros.com.br', 'Felipe');
	//$mail->AddAddress('bruno.berlanda@lindevidros.com.br', 'Bruno');
	//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
	//$mail->AddBCC('bruno.berlanda@lindevidros.com.br', 'Bruno Berlanda'); // Cópia Oculta

	// Define os dados técnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
	$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->Subject  = "[Exclusão] Pedido Moveleiro"; // Assunto da mensagem
	
	$mail->Body = "
	<html>
	<head>
	</head>
	<body link='#666666' vlink='#666666' alink='#666666'>
	
	<table border='0' width='600' cellpadding='5'>
		<tr height='106'>
			<td colspan='3'><img src='http://www.lindevidros.com.br/email/logo.png' /></td>
		</tr>
	  
		<tr>
			<td colspan='3' style='padding: 20px 0;'>
				<p><font face='Arial' size='5' color='#333333'><b>Pedido Excluído</b></font></p>
			</td>
		</tr>
		<tr>
			<td colspan='3' style='padding: 30px 0;'>
				<p><font face='Arial' size='2' color='#333333'>O representante <b>$requerente_nome</b> excluiu um pedido do sistema que já estava aprovado pelo setor moveleiro.</font></p>
			</td>
		</tr>
		<tr>
        	<td width='150' bgcolor='#333333' style='padding: 10px;'>
            	<p align='center'><font face='Arial' size='2' color='#FFFFFF'>PEDIDO</font></p>
            </td>
            <td width='450' bgcolor='#DD514C' style='padding: 10px;'>
            	<p align='center'><font face='Arial' size='2' color='#FFFFFF'>CLIENTE</font></p>
            </td>
        </tr>
        <tr>
		    <td>
				<p align='center'><font face='Arial' size='3' color='#CC3333'>$n_id</font></p>
			</td>
            <td>
				<p align='center'><font face='Arial' size='3' color='#CC3333'>$pedido_cli_cod - $pedido_cli_nome</font></p>
			</td>
		</tr>
	  </table>
	
	</body>
	</html>
	";
	$mail->AltBody = "";

	// Define os anexos (opcional)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo

	// Envia o e-mail
	$enviado = $mail->Send();

	// Limpa os destinatários e os anexos
	$mail->ClearAllRecipients();
	/* ******************************************************************************** */
	
}

header ('Location: ../moveleiro-gerenciar-pedidos.php?msgSucesso=O pedido foi excluído com sucesso.');

}

/* ******************************************************************************************************************
OBSERVAÇÕES
****************************************************************************************************************** */
if ($_GET['funcao'] == "obs") {

$pedido 	= $_GET['pedido'];

// Dados do formulário
$obs 		= strip_tags(trim($_POST['obs']));

$obs 		= strtr(strtoupper($obs),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	
$editando = mysqli_query ($conexao, "UPDATE moveleiro_pedidos SET obs='$obs' WHERE codigo='$pedido'") or die (mysqli_error());

header ('Location: ../moveleiro-pedido-itens.php?pedido='.$pedido.'&msgSucesso=Observações atualizadas com sucesso.');

}

/* ******************************************************************************************************************
ACEITAR PEDIDO
****************************************************************************************************************** */
if ($_GET['funcao'] == "aceitar_pedido") {

$pedido = $_GET['pedido'];

$data_agora = date ("Y-m-d H:i:s");

$editando = mysqli_query ($conexao, "UPDATE moveleiro_pedidos 
						SET
						status='R', recebido_data='$data_agora', recebido_usuario='$id_usuario'
						WHERE codigo='$pedido'") or die (mysqli_error());

header ('Location: ../moveleiro-gerenciar-pedidos.php?msgSucesso=Pedido aceito com sucesso.');

}

/* ******************************************************************************************************************
RECUSAR PEDIDO
****************************************************************************************************************** */
if ($_GET['funcao'] == "recusar_pedido") {

$pedido 	= $_GET['pedido'];
$id_pedido 	= $_GET['id_pedido'];

// Dados do formulário
$motivo 		= strip_tags(trim($_POST['motivo']));

$motivo 		= strtr(strtoupper($motivo),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

$data_agora = date ("Y-m-d H:i:s");

$editando = mysqli_query ($conexao, "UPDATE moveleiro_pedidos 
						SET
						status='X', recebido_data='$data_agora', recebido_usuario='$id_usuario', recebido_motivo='$motivo'
						WHERE codigo='$pedido'") or die (mysqli_error());

	/* ******** */
	
	$n_id = str_pad($id_pedido, 5, "0", STR_PAD_LEFT);
	
	// Consulta o e-mail do representante
	$consulta_representante = mysqli_query ($conexao, "SELECT a.email FROM representantes a, moveleiro_pedidos b WHERE a.id=b.usuario AND b.codigo='$pedido'") or die (mysqli_error());
		$dados_rep = mysqli_fetch_array ($consulta_representante);
			$rep_email = $dados_rep['email'];
	
	/* **********************************************
	ENVIANDO O E-MAIL
	********************************************** */
	// Inclui o arquivo PHPMailerAutoload.php localizado na pasta phpmailer
	require_once ("../../phpmailer/PHPMailerAutoload.php");
	
	// Inicia a classe PHPMailer
	$mail = new PHPMailer();
	
	include_once ("../../funcoes/conexao_email.php");
	
	// Define os destinatário(s)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->AddAddress($rep_email);
	//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
	//$mail->AddBCC('bruno.berlanda@lindevidros.com.br', 'Bruno Berlanda'); // Cópia Oculta

	// Define os dados técnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
	$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->Subject  = "[Pedido Linde] Pedido Recusado"; // Assunto da mensagem
	
	$mail->Body = "
	<html>
	<head>
	</head>
	<body link='#666666' vlink='#666666' alink='#666666'>
	
	<table border='0' width='600' cellpadding='5'>
		<tr height='106'>
			<td colspan='3'><img src='http://www.lindevidros.com.br/email/logo.png' /></td>
		</tr>
	  
		<tr>
			<td colspan='3' style='padding: 20px 0;'>
				<p><font face='Arial' size='5' color='#333333'><b>Pedido Recusado</b></font></p>
			</td>
		</tr>
		<tr>
			<td colspan='3' style='padding: 30px 0;'>
				<p><font face='Arial' size='2' color='#333333'>O seu pedido foi <b>recusado</b>. Para maiores informações, entre em contato com o setor comercial.</font></p>
			</td>
		</tr>
		<tr>
        	<td width='150' bgcolor='#333333' style='padding: 10px;'>
            	<p align='center'><font face='Arial' size='2' color='#FFFFFF'>PEDIDO</font></p>
            </td>
            <td width='450' colspan='2' bgcolor='#DD514C' style='padding: 10px;'>
            	<p align='center'><font face='Arial' size='2' color='#FFFFFF'>MOTIVO</font></p>
            </td>
        </tr>
        <tr>
		    <td>
				<p align='center'><font face='Arial' size='3' color='#333333'>$n_id</font></p>
			</td>
            <td>
				<p align='center'><font face='Arial' size='3' color='#333333'>$motivo</font></p>
			</td>
		</tr>
	  </table>
	
	</body>
	</html>
	";
	$mail->AltBody = "";

	// Define os anexos (opcional)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo

	// Envia o e-mail
	$enviado = $mail->Send();

	// Limpa os destinatários e os anexos
	$mail->ClearAllRecipients();
	/* ******************************************************************************** */

header ('Location: ../moveleiro-gerenciar-pedidos.php?msgSucesso=Pedido recusado com sucesso.');

}

/* ******************************************************************************************************************
PRAZO
****************************************************************************************************************** */
if ($_GET['funcao'] == "prazo") {

$pedido 	= $_GET['pedido'];
$id_pedido 	= $_GET['id_pedido'];

// Dados do formulário
$prazo_entrega 	= strip_tags(trim($_POST['prazo_entrega']));
$motivo 		= strip_tags(trim($_POST['motivo']));

$motivo 		= strtr(strtoupper($motivo),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

// Hidden
$prazo_atual 	= strip_tags(trim($_POST['prazo_atual']));

// Se as datas forem diferentes atualiza e envia e-mail para o representante
if ($prazo_entrega != $prazo_atual) {

	// Grava o LOG
	$cadastrando = mysqli_query ($conexao, "INSERT INTO moveleiro_log_prazo
							   (usuario, id_pedido, data_antiga, data_nova, motivo)
							   VALUES
							   ('$id_usuario', '$id_pedido', '$prazo_atual', '$prazo_entrega', '$motivo')
							   ") or die (mysqli_error());
	
	// Atualiza o pedido						   
	$editando = mysqli_query ($conexao, "UPDATE moveleiro_pedidos 
							SET
							prazo_entrega='$prazo_entrega'
							WHERE codigo='$pedido'") or die (mysqli_error());
	
	/* ******** */
	
	$n_id = str_pad($id_pedido, 5, "0", STR_PAD_LEFT);
	
	// Formata os valores de data para enviar por e-mail
	$prazo_entrega_x 	= date('d/m/Y', strtotime($prazo_entrega));
	$prazo_atual_x 		= date('d/m/Y', strtotime($prazo_atual));
	
	// Consulta o e-mail do representante
	$consulta_representante = mysqli_query ($conexao, "SELECT a.email FROM representantes a, moveleiro_pedidos b WHERE a.id=b.usuario AND b.codigo='$pedido'") or die (mysqli_error());
		$dados_rep = mysqli_fetch_array ($consulta_representante);
			$rep_email = $dados_rep['email'];
	
	/* **********************************************
	ENVIANDO O E-MAIL
	********************************************** */
	// Inclui o arquivo PHPMailerAutoload.php localizado na pasta phpmailer
	require_once ("../../phpmailer/PHPMailerAutoload.php");
	
	// Inicia a classe PHPMailer
	$mail = new PHPMailer();
	
	include_once ("../../funcoes/conexao_email.php");
	
	// Define os destinatário(s)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->AddAddress($rep_email);
	//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
	//$mail->AddBCC('bruno.berlanda@lindevidros.com.br', 'Bruno Berlanda'); // Cópia Oculta

	// Define os dados técnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
	$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->Subject  = "[Pedido Linde] Alteração no Limite de Produção"; // Assunto da mensagem
	
	$mail->Body = "
	<html>
	<head>
	</head>
	<body link='#666666' vlink='#666666' alink='#666666'>
	
	<table border='0' width='600' cellpadding='5'>
		<tr height='106'>
			<td colspan='3'><img src='http://www.lindevidros.com.br/email/logo.png' /></td>
		</tr>
	  
		<tr>
			<td colspan='3' style='padding: 20px 0;'>
				<p><font face='Arial' size='5' color='#333333'><b>Limite de Produção Atualizado</b></font></p>
			</td>
		</tr>
		<tr>
			<td colspan='3' style='padding: 30px 0;'>
				<p><font face='Arial' size='2' color='#333333'>O seu pedido precisou sofrer alteração no <b>Limite de Produção</b>. Para maiores informações, entre em contato com o setor comercial.</font></p>
			</td>
		</tr>
		<tr>
        	<td width='200' bgcolor='#333333' style='padding: 10px;'>
            	<p align='center'><font face='Arial' size='2' color='#FFFFFF'>PEDIDO</font></p>
            </td>
            <td width='200' bgcolor='#DD514C' style='padding: 10px;'>
            	<p align='center'><font face='Arial' size='2' color='#FFFFFF'>DATA ANTIGA</font></p>
            </td>
			<td width='200' bgcolor='#5CB85C' style='padding: 10px;'>
            	<p align='center'><font face='Arial' size='2' color='#FFFFFF'>NOVA DATA</font></p>
            </td>
        </tr>
        <tr>
		    <td>
				<p align='center'><font face='Arial' size='3' color='#333333'>$n_id</font></p>
			</td>
            <td>
				<p align='center'><font face='Arial' size='3' color='#333333'>$prazo_atual_x</font></p>
			</td>
			<td>
				<p align='center'><font face='Arial' size='3' color='#333333'>$prazo_entrega_x</font></p>
			</td>
		</tr>
		<tr>
			<td colspan='3' style='padding: 30px 0;'>
				<p>
				<font face='Arial' size='1' color='#333333'><b>MOTIVO DA ALTERAÇÃO</b></font>
				<br>
				<font face='Arial' size='2' color='#333333'>$motivo</font>
				</p>
			</td>
		</tr>
	  </table>
	
	</body>
	</html>
	";
	$mail->AltBody = "";

	// Define os anexos (opcional)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo

	// Envia o e-mail
	$enviado = $mail->Send();

	// Limpa os destinatários e os anexos
	$mail->ClearAllRecipients();
	/* ******************************************************************************** */
	
}

header ('Location: ../moveleiro-pedido-ver.php?pedido='.$pedido.'&msgSucesso=Limite de produção atualizado com sucesso.');

}
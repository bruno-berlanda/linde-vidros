<?php
include_once ("../../funcoes/conexao.php");
include_once ("../includes/permissao_clientes.php");
include_once ("../includes/usuario_logado.php");

if ($wkUsuario == "S") {

	/* **********************************************************************
	ALTERAR DATA
	********************************************************************** */
	if ($_GET['funcao'] == "alterar_data") {
	
	$id = $_GET['p'];
	
	// Dados do formulário
	$data 	= strip_tags(trim($_POST['data']));
	$obs 	= strip_tags(trim($_POST['obs']));
	
	// Converter texto para maiusculas
	$obs	= strtr(strtoupper($obs),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	
	$data_atualizacao = date ("Y-m-d H:i:s");
	
	// Data e-mail
	$x = explode ("-", $data);
		$data_email = $x[2]."/".$x[1]."/".$x[0]; // Data do formulário
		
		$atu_email = date ("d/m/Y H:i:s");
	
	$cadastra = mysqli_query ($conexao, "UPDATE vendas_weiku SET alteracao_data='$data', observacoes_weiku='$obs', situacao='3', data_edit_weiku='$data_atualizacao' WHERE id_pedido_weiku='$id'") or die (mysqli_error());
	
	$consulta_at = mysqli_query ($conexao, "SELECT at_weiku FROM vendas_weiku WHERE id_pedido_weiku='$id'") or die (mysqli_error());
		$dados_at = mysqli_fetch_array ($consulta_at);
			$at = $dados_at['at_weiku'];
	
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
	$mail->AddAddress('janaina@lindevidros.com.br');
	//$mail->AddAddress('josnei.wendt@lindevidros.com.br');
	$mail->AddCC('logistica@lindevidros.com.br'); // Cópia
	$mail->AddCC('transporte@lindevidros.com.br'); // Cópia
	$mail->AddBCC('bruno.berlanda@lindevidros.com.br'); // Cópia Oculta

	// Define os dados técnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
	$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->Subject  = "Pedido Weiku: Alteração de Data"; // Assunto da mensagem
	
	$mail->Body = "
	<html>
	<head>
	</head>
	<body>
	
	<table border='0' width='100%' cellpadding='3'>
		<tr height='106'>
			<td colspan='2'><img src='http://www.lindevidros.com.br/email/logo.png'></td>
		</tr>
	
		<tr>
			<td bgcolor='#1469B8' height='50' valign='middle'><p><font face='Georgia' size='4' color='#FFFFFF'><b>&nbsp;&nbsp; Weiku: Alteração de Data</b></font></p></td>
		</tr>
		<tr>
			<td align='justify'><font color='#1469B8' face='Verdana' size='1'><b>ATUALIZAÇÃO:</b></font>
			<br>
            <font face='Verdana' size='1'>A Weiku solicitou alteração na data de entrega no PEDIDO:</font>
            <br><br>
			<font face='Verdana' size='5' color='#BC3C3E'><b>$at</b></font>
			<br><br>
            <font face='Verdana' size='1'>Para a data</font> <font face='Verdana' size='2' color='#333333'><b>$data_email</b></font>.
            <br>
			</td>
		</tr>
		<tr>
			<td bgcolor='#EEEEEE'>
			<p><font color='#1469B8' face='Verdana' size='1'><b>OBSERVAÇÕES:</b></font> <font face='Verdana' size='1'>$obs</font>
			<br>
			<font color='#999999' face='Verdana' size='1'>$atu_email</font></p>
			</td>
		</tr>
	</table>
	
	</font>
	
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
		
	header ('Location: ../pedidos_detalhes.php?p='.$id.'&msgSucesso=Você atualizou a data de entrega com sucesso');
	
	}
	
	/* ************************************************************************************************************************************************************************** */
	/* ************************************************************************************************************************************************************************** */
	/* ************************************************************************************************************************************************************************** */
	/* ************************************************************************************************************************************************************************** */
	/* ************************************************************************************************************************************************************************** */
	/* ************************************************************************************************************************************************************************** */
	/* ************************************************************************************************************************************************************************** */
	/* ************************************************************************************************************************************************************************** */
	
	/* **********************************************************************
	PROCEDIMENTO DE ENTREGA
	********************************************************************** */
	if ($_GET['funcao'] == "procedimento") {
	
	$id = $_GET['p'];
	
	// Dados do formulário
	$cliente 		= strip_tags(trim($_POST['cliente']));
	$cidade 		= strip_tags(trim($_POST['cidade']));
	$uf 			= strip_tags(trim($_POST['uf']));
	$endereco 		= strip_tags(trim($_POST['endereco']));
	$numero 		= strip_tags(trim($_POST['numero']));
	$bairro 		= strip_tags(trim($_POST['bairro']));
	$referencia 	= strip_tags(trim($_POST['referencia']));
	$obs 			= strip_tags(trim($_POST['obs']));
	
	$contato1 		= strip_tags(trim($_POST['contato1']));
	$fone1c1 		= strip_tags(trim($_POST['fone1c1']));
	$fone2c1 		= strip_tags(trim($_POST['fone2c1']));
	$contato2 		= strip_tags(trim($_POST['contato2']));
	$fone1c2 		= strip_tags(trim($_POST['fone1c2']));
	$fone2c2 		= strip_tags(trim($_POST['fone2c2']));
	$horario 		= strip_tags(trim($_POST['horario']));
	
	$nf 			= strip_tags(trim($_POST['nf']));
	$nf_serie 		= strip_tags(trim($_POST['nf_serie']));
	$nf_data 		= strip_tags(trim($_POST['nf_data']));
	
	$mapa 			= $_POST['mapa'];
		
	// Converter texto para maiusculas
	$cliente		= strtr(strtoupper($cliente),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	$cidade			= strtr(strtoupper($cidade),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	$endereco		= strtr(strtoupper($endereco),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	$numero			= strtr(strtoupper($numero),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	$bairro			= strtr(strtoupper($bairro),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	$referencia		= strtr(strtoupper($referencia),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	$obs			= strtr(strtoupper($obs),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	
	$contato1		= strtr(strtoupper($contato1),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	$contato2		= strtr(strtoupper($contato2),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	
	// Data atualização
	$data_atualizacao = date ("Y-m-d H:i:s");
	
	// Local Apto
	if (isset($_POST['local_apto'])) {
		$local_apto = "S";
	}
	else {
		$local_apto = "N";
	}
	
	// Contato Antes
	if (isset($_POST['contato_antes'])) {
		$contato_antes = "S";
	}
	else {
		$contato_antes = "N";
	}
	
	// Consulta se ja há cadastro deste procedimento
	$consulta_procedimento = mysqli_query ($conexao, "SELECT data FROM vendas_weiku_procedimentos WHERE id_pedido='$id'") or die (mysqli_error());
	
	$conta_procedimento = mysqli_num_rows ($consulta_procedimento);
	
	if ($conta_procedimento == 0) {
		
		$cadastra = mysqli_query ($conexao, "INSERT INTO 
								vendas_weiku_procedimentos (
								id_pedido, cliente, cidade, uf, endereco, numero, bairro, referencia, local_apto, obs,
								nome_contato1, fone1_contato1, fone2_contato1, nome_contato2, fone1_contato2, fone2_contato2, contato_antes, horario_entrega,
								nf, nf_serie, nf_data, mapa, atualizado
								) VALUES (
								'$id', '$cliente', '$cidade', '$uf', '$endereco', '$numero', '$bairro', '$referencia', '$local_apto', '$obs',
								'$contato1', '$fone1c1', '$fone2c1', '$contato2', '$fone1c2', '$fone2c2', '$contato_antes', '$horario',
								'$nf', '$nf_serie', '$nf_data', '$mapa', '$data_atualizacao'
								)") or die (mysqli_error());
	
	}
	else {
		
		$atualiza = mysqli_query ($conexao, "UPDATE
								vendas_weiku_procedimentos
								SET
								cliente='$cliente', cidade='$cidade', uf='$uf', endereco='$endereco', numero='$numero', bairro='$bairro', referencia='$referencia', 
								local_apto='$local_apto', obs='$obs',
								nome_contato1='$contato1', fone1_contato1='$fone1c1', fone2_contato1='$fone2c1', nome_contato2='$contato2', fone1_contato2='$fone1c2',
								fone2_contato2='$fone2c2', contato_antes='$contato_antes', horario_entrega='$horario',
								nf='$nf', nf_serie='$nf_serie', nf_data='$nf_data', mapa='$mapa', atualizado='$data_atualizacao'
								WHERE 
								id_pedido='$id'"
								) or die (mysqli_error());
		
	}
	
	$consulta_at = mysqli_query ($conexao, "SELECT at_weiku FROM vendas_weiku WHERE id_pedido_weiku='$id'") or die (mysqli_error());
		$dados_at = mysqli_fetch_array ($consulta_at);
			$at = $dados_at['at_weiku'];
	
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
	$mail->AddAddress('janaina@lindevidros.com.br');
	//$mail->AddAddress('josnei.wendt@lindevidros.com.br');
	$mail->AddCC('logistica@lindevidros.com.br'); // Cópia
	$mail->AddCC('transporte@lindevidros.com.br'); // Cópia
	$mail->AddBCC('bruno.berlanda@lindevidros.com.br'); // Cópia Oculta

	// Define os dados técnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
	$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->Subject  = "Pedido Weiku: Procedimento de Entrega"; // Assunto da mensagem
	
	$mail->Body = "
	<html>
	<head>
	</head>
	<body>
	
	<table border='0' width='100%' cellpadding='3'>
		<tr height='106'>
			<td colspan='2'><img src='http://www.lindevidros.com.br/email/logo.png'></td>
		</tr>
	
		<tr>
			<td bgcolor='#444444' height='50' valign='middle'><p><font face='Georgia' size='4' color='#FFFFFF'><b>&nbsp;&nbsp; Weiku: Procedimento de Entrega</b></font></p></td>
		</tr>
		<tr>
			<td align='justify'><font color='#1469B8' face='Verdana' size='1'><b>ATUALIZAÇÃO:</b></font>
			<br>
            <font face='Verdana' size='1'>A Weiku enviou o procedimento de entrega do PEDIDO:</font>
            <br><br>
			<font face='Verdana' size='5' color='#BC3C3E'><b>$at</b></font>
            <br>
			</td>
		</tr>
	</table>
	
	</font>
	
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
		
	header ('Location: ../pedidos_procedimento.php?p='.$id.'&msgSucesso=Procedimento atualizado com sucesso');
	
	}

}
else {
	header ('Location: ../index.php?msgErro=Você não tem permissão para acessar essa página. Para maiores informações entre em contato com o responsável pelo sistema na Linde Vidros.');
}
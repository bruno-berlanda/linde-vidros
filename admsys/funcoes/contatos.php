<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_adm == "S" || $perm_contatos == "S") {
	
/* **************************************************************************
CADASTRAR
************************************************************************** */
if ($_GET['funcao'] == "cadastrar") {
	
	$nome 	= strip_tags(trim($_POST['nome']));
	$email 	= strip_tags(trim($_POST['email']));
	
	$nome 	= strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	$email 	= strtolower($email);
	
	$consultaEmail = mysqli_query($conexao, "SELECT email FROM contato_emails WHERE email='$email'") or die (mysqli_error());
	$contaEmail = mysqli_num_rows ($consultaEmail);
	
	if ($contaEmail == 1) {
		$atualiza = mysqli_query($conexao, "UPDATE contato_emails SET nome='$nome', ativo='1' WHERE email='$email'") or die (mysqli_error());		
		header ('Location: ../contatos.php?msgSucesso=E-mail atualizado com sucesso');
	}
	
	$cadastrando = mysqli_query($conexao, "INSERT INTO contato_emails (nome, email) VALUES ('$nome', '$email')") or die (mysqli_error());	
	header ('Location: ../contatos.php?msgSucesso=E-mail cadastrado com sucesso');
}

/* **************************************************************************
DESATIVAR
************************************************************************** */
if ($_GET['funcao'] == "desativar") {
	
	$email 	= strip_tags(trim($_POST['email']));
	
	$atualiza = mysqli_query($conexao, "UPDATE contato_emails SET ativo='0' WHERE id='$email'") or die (mysqli_error());		

	header ('Location: ../contatos.php?msgSucesso=E-mail desativado com sucesso');
}

/* **************************************************************************
ENCAMINHAR E-MAIL
************************************************************************** */
if($_GET['funcao'] == "enviar") {

	$id = $_GET['id'];
	
	$para = $_POST['destinatario'];
	
	$consulta = mysqli_query($conexao, "SELECT * FROM contato WHERE id='$id'") or die (mysqli_error());
		$linha = mysqli_fetch_array($consulta);
			$id 		= $linha['id'];
			$tipo 		= $linha['tipo'];
			$assunto 	= $linha['assunto'];
			$nome 		= $linha['nome'];
			$cidade 	= $linha['cidade'];
			$uf 		= $linha['uf'];
			$email 		= $linha['email'];
			$fone 		= $linha['fone'];
			$mensagem 	= $linha['mensagem'];
			$resposta 	= $linha['resposta'];
			$data 		= $linha['data'];
			$hora 		= $linha['hora'];
	
	// Tratamento da DATA
	$data = substr($data,8,2) . "/" .substr($data,5,2) . "/" . substr($data,0,4);
	
	// Tratamento da HORA
	$hora = substr($hora,0,2) . ":" .substr($hora,3,2);
	
	// Tratamento do TIPO
	switch ($tipo) {
		case "1": $tipo = "RECLAMAÇÃO"; break;
		case "2": $tipo = "CRÍTICA"; break;
		case "3": $tipo = "SUGESTÃO"; break;
		case "4": $tipo = "DÚVIDA"; break;
		case "5": $tipo = "COMENTÁRIO";
	}
	
	// Tratamento do ASSUNTO
	switch ($assunto) {
		case "1": $assunto = "A LINDE VIDROS"; break;
		case "2": $assunto = "NOSSO SITE"; break;
		case "3": $assunto = "ATENDIMENTO"; break;
		case "4": $assunto = "PRODUTOS"; break;
		case "5": $assunto = "ENGENHARIA"; break;
		case "6": $assunto = "MOVELEIRO";
	}
	
	// Tratamento da RESPOSTA
	switch ($resposta) {
		case "1": $img_resposta = "<img src='http://www.lindevidros.com.br/email/contato/contato1_img_10.png'>"; break;
		case "2": $img_resposta = "<img src='http://www.lindevidros.com.br/email/contato/contato1_img_11.png'>"; break;
		case "3": $img_resposta = "<img src='http://www.lindevidros.com.br/email/contato/contato1_img_12.png'>";
	}
	
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
	$mail->AddAddress($para);
	//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
	$mail->AddBCC('bruno.berlanda@lindevidros.com.br', 'Bruno Berlanda'); // Cópia Oculta

	// Define os dados técnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
	$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->Subject  = "Contato Website: $tipo - $assunto"; // Assunto da mensagem
	
	$mail->Body = "
	<html>
	<head>
	</head>
	<body>
	
	<table border='0' width='600' cellpadding='0' cellspacing='1'>
		<tr>
			<td colspan='4' style='padding: 8px 0' align='center'><img src='http://www.lindevidros.com.br/email/logo.png'></td>
		</tr>
		
		<tr>
			<td colspan='4' style='padding: 8px 0'>
				<img src='http://www.lindevidros.com.br/email/contato/contato1_img_01.png'>
			</td>
		</tr>
		<tr>
			<td colspan='4'>
				<img src='http://www.lindevidros.com.br/email/contato/contato1_img_02.png'>
			</td>
		</tr>
		
		<tr>
			<td width='100'><img src='http://www.lindevidros.com.br/email/contato/contato1_img_03.png'></td>
			<td width='200' style='padding-left: 4px;'><font face='Verdana' size='1' color='#666666'>$tipo</font></td>
			<td width='100'><img src='http://www.lindevidros.com.br/email/contato/contato1_img_04.png'></td>
			<td width='200' style='padding-left: 4px;'><font face='Verdana' size='1' color='#666666'>$assunto</font></td>
		</tr>
		<tr>
			<td width='100'><img src='http://www.lindevidros.com.br/email/contato/contato1_img_05.png'></td>
			<td width='200' style='padding-left: 4px;'><font face='Verdana' size='1' color='#666666'>$nome</font></td>
			<td width='100'><img src='http://www.lindevidros.com.br/email/contato/contato1_img_06.png'></td>
			<td width='200' style='padding-left: 4px;'><font face='Verdana' size='1' color='#666666'>$cidade / $uf</font></td>
		</tr>
		<tr>
			<td width='100'><img src='http://www.lindevidros.com.br/email/contato/contato1_img_07.png'></td>
			<td width='200' style='padding-left: 4px;'><font face='Verdana' size='1' color='#666666'>$email</font></td>
			<td width='100'><img src='http://www.lindevidros.com.br/email/contato/contato1_img_08.png'></td>
			<td width='200' style='padding-left: 4px;'><font face='Verdana' size='1' color='#666666'>$fone</font></td>
		</tr>
		
		<tr>
			<td colspan='4' style='padding-top: 20px;'>
				<img src='http://www.lindevidros.com.br/email/contato/contato1_img_09.png'>
			</td>
		</tr>
		<tr>
			<td colspan='4' style='padding: 15px 8px; text-align: justify; text-indent: 30px'>
				<p><font face='Verdana' size='1' color='#333333'>$mensagem</font></p>
			</td>
		</tr>
		
		<tr>
			<td colspan='4'>
				$img_resposta
			</td>
		</tr>
		<tr>
			<td colspan='4' align='center'>
				<font color='#666666' face='Verdana' size='1'><b>MENSAGEM ENVIADA EM $data $hora</b></font>
			</td>
		</tr>
	</table>
	
	</font>
	
	</body>
	</html>
	";

	// Envia o e-mail
	$enviado = $mail->Send();

	// Limpa os destinatários e os anexos
	$mail->ClearAllRecipients();
	
	/* ******************************************************************************** */
	
	$data_log = date ("Y-m-d");
	$hora_log = date ("H:i:s");
	
	$grava 	= mysqli_query($conexao, "INSERT INTO contato_enviados (id_contato, email, data, hora) VALUES ('$id', '$para', '$data_log', '$hora_log')") or die (mysqli_error());
	$lido 	= mysqli_query($conexao, "UPDATE contato SET lido='1' WHERE id='$id'") or die (mysqli_error());
	
	header('Location: ../contatos.php?msgSucesso=E-mail enviado com sucesso');
}

/* **************************************************************************
EXCLUIR
************************************************************************** */
if($_GET['funcao'] == "excluir") {
	
	$id = $_GET['id'];
	
	$motivo = strip_tags(trim($_POST['motivo']));
	
	$motivo = strtr(strtoupper($motivo),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	
	$excluir = mysqli_query($conexao, "UPDATE contato SET motivo='$motivo', ativo='0' WHERE id='$id'") or die (mysqli_error());
	$lido = mysqli_query($conexao, "UPDATE contato SET lido='1' WHERE id='$id'") or die (mysqli_error());
	
	header('Location: ../contatos.php?msgSucesso=E-mail excluído com sucesso');
}

} // Permissão para acessar a página
else {
	header ('Location: ../admsys.php?msgErro=Você não tem permissão para acessar essa página');
}
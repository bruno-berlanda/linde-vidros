<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_adm == "S") {
	
/* **************************************************************************
EXCLUIR CADASTRO
************************************************************************** */
if ($_GET['funcao'] == "excluir") {
	
$id = $_GET['id'];

$excluir = mysqli_query($conexao, "DELETE FROM clientes WHERE id='$id'") or die (mysqli_error());
		
header ('Location: ../cadastros.php?msgSucesso=Cadastro excluído com sucesso');

}

/* **************************************************************************
LIBERAR ACESSO
************************************************************************** */
if ($_GET['funcao'] == "criar_senha") {

	$id = $_GET['id'];
	
	$senha = $_POST['senha'];
	
	$consulta_cliente = mysqli_query($conexao, "SELECT cnpj, email, nome FROM clientes WHERE id='$id'") or die (mysqli_error());
		$dados = mysqli_fetch_array ($consulta_cliente);
			$cnpj 	= $dados['cnpj'];
			$email 	= $dados['email'];
			$nome 	= $dados['nome'];
	
	
	/* **********************************************
	ENVIANDO O E-MAIL
	********************************************** */
	/// Inclui o arquivo PHPMailerAutoload.php localizado na pasta phpmailer
	require_once ("../../phpmailer/PHPMailerAutoload.php");
	
	// Inicia a classe PHPMailer
	$mail = new PHPMailer();
	
	include_once ("../../funcoes/conexao_email.php");
	
	// Define os destinatário(s)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->AddAddress($email);
	//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
	$mail->AddBCC('bruno.berlanda@lindevidros.com.br', 'Bruno Berlanda'); // Cópia Oculta

	// Define os dados técnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
	$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->Subject  = "Acesso Restrito Liberado"; // Assunto da mensagem
	
	$mail->Body = "
	<html>
	<head>
	</head>
	<body>
	
	<table border='0' width='100%' cellpadding='3'>
		<tr height='106'>
			<td colspan='2'><img src='http://www.lindevidros.com.br/email/logo.png' /></td>
		</tr>
	
		<tr>
			<td colspan='2' bgcolor='#1469B8'><p><font face='Georgia' size='4' color='#FFFFFF'><b>&nbsp;&nbsp; Seu acesso foi liberado!</b></font></p></td>
		</tr>
		<tr>
			<td>
				<p><font face='Verdana' size='2'>Olá <b>$nome</b>,</font></p>
				<p><font face='Verdana' size='2'>Seu cadastro foi realizado com sucesso! A partir de agora você já pode acessar á <b>Área do Cliente</b> e ficar por dentro das novidades que a Linde Vidros tem pra você.</font></p>
				<p>
				<font face='Verdana' size='2'>Para acessar a área restrita use a senha que foi enviada neste e-mail:</font>
				<br />
				<font color='#1469B8' face='Verdana' size='2'><b>SENHA:</b></font> <font face='Verdana' size='2'>$senha</font>
				<br /><br />
				<font face='Verdana' size='2'>A sua senha pode ser alterada na sua área restrita.</font>
				</p>
				<p><font face='Verdana' size='2'>A <b>Linde Vidros</b> agradece o seu contato.</font></p>
			</td>
		</tr>
		<tr>
			<td align='center'>
			<a href='http://www.lindevidros.com.br'><img src='http://www.lindevidros.com.br/email/lindesite.png' /></a>
			<br /><br />
			<a href='https://www.facebook.com/pages/Linde-Vidros/280108568717364'><img src='http://www.lindevidros.com.br/email/face.png' /></a>
			&nbsp;
			<a href='http://www.youtube.com/user/lindevidros'><img src='http://www.lindevidros.com.br/email/youtube.png' /></a>
			&nbsp;
			<a href='https://instagram.com/lindevidros'><img src='http://www.lindevidros.com.br/email/instagram.png' /></a>
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

	$cadastra_senha = mysqli_query($conexao, "UPDATE clientes SET senha='$senha', liberado='1' WHERE id='$id'") or die (mysqli_error());
	
	header ('Location: ../cadastros_ver.php?cliente='.$id.'&msgSucesso=E-mail com a senha de acesso enviado com sucesso');
}

/* **************************************************************************
TROCAR SENHA ACESSO
************************************************************************** */
if ($_GET['funcao'] == "alterar_senha") {

	$id = $_GET['id'];
	
	$senha = $_POST['senha'];
	
	$consulta_cliente = mysqli_query($conexao, "SELECT cnpj, email, nome FROM clientes WHERE id='$id'") or die (mysqli_error());
		$dados = mysqli_fetch_array ($consulta_cliente);
			$cnpj 	= $dados['cnpj'];
			$email 	= $dados['email'];
			$nome 	= $dados['nome'];
	
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
	$mail->AddAddress($email);
	//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
	$mail->AddBCC('bruno.berlanda@lindevidros.com.br', 'Bruno Berlanda'); // Cópia Oculta

	// Define os dados técnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
	$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->Subject  = "Senha de acesso alterada"; // Assunto da mensagem
	
	$mail->Body = "
	<html>
	<head>
	</head>
	<body>
	
	<table border='0' width='100%' cellpadding='3'>
		<tr height='106'>
			<td colspan='2'><img src='http://www.lindevidros.com.br/email/logo.png' /></td>
		</tr>
	
		<tr>
			<td colspan='2' bgcolor='#1469B8'><p><font face='Georgia' size='4' color='#FFFFFF'><b>&nbsp;&nbsp; Sua senha de acesso foi alterada!</b></font></p></td>
		</tr>
		<tr>
			<td>
				<p><font face='Verdana' size='2'>Olá <b>$nome</b>,</font></p>
				<p><font face='Verdana' size='2'>Sua senha de acesso foi alterada pelo administrador do sistema! Use a nova senha para acessar a <b>Área do Cliente</b> e ficar por dentro das novidades que a Linde Vidros tem pra você.</font></p>
				<p>
				<font face='Verdana' size='2'>Para acessar a área restrita use a senha que foi enviada neste e-mail:</font>
				<br />
				<font color='#1469B8' face='Verdana' size='2'><b>SENHA:</b></font> <font face='Verdana' size='2'>$senha</font>
				<br /><br />
				<font face='Verdana' size='2'>A sua senha pode ser alterada na sua área restrita.</font>
				</p>
				<p><font face='Verdana' size='2'>A <b>Linde Vidros</b> agradece o seu contato.</font></p>
			</td>
		</tr>
		<tr>
			<td align='center'>
			<a href='http://www.lindevidros.com.br'><img src='http://www.lindevidros.com.br/email/lindesite.png' /></a>
			<br /><br />
			<a href='https://www.facebook.com/pages/Linde-Vidros/280108568717364'><img src='http://www.lindevidros.com.br/email/face.png' /></a>
			&nbsp;
			<a href='http://www.youtube.com/user/lindevidros'><img src='http://www.lindevidros.com.br/email/youtube.png' /></a>
			&nbsp;
			<a href='https://instagram.com/lindevidros'><img src='http://www.lindevidros.com.br/email/instagram.png' /></a>
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

	$cadastra_senha = mysqli_query($conexao, "UPDATE clientes SET senha='$senha' WHERE id='$id'") or die (mysqli_error());
	
	header ('Location: ../cadastros_ver.php?cliente='.$id.'&msgSucesso=E-mail com a nova senha de acesso enviado com sucesso');
}

/* **************************************************************************
ACESSO WEIKU: LIBERAR
************************************************************************** */
if ($_GET['funcao'] == "p_weiku_s") {
	
$id = $_GET['id'];

$atualiza = mysqli_query($conexao, "UPDATE clientes SET wk='S' WHERE id='$id'") or die (mysqli_error());
		
header ('Location: ../cadastros_ver.php?cliente='.$id.'&msgSucesso=Acesso liberado com sucesso');

}

/* **************************************************************************
ACESSO WEIKU: BLOQUEAR
************************************************************************** */
if ($_GET['funcao'] == "p_weiku_n") {
	
$id = $_GET['id'];

$atualiza = mysqli_query($conexao, "UPDATE clientes SET wk='N' WHERE id='$id'") or die (mysqli_error());
		
header ('Location: ../cadastros_ver.php?cliente='.$id.'&msgSucesso=Acesso bloqueado com sucesso');

}

/* **************************************************************************
ACESSO INSULADO: LIBERAR
************************************************************************** */
if ($_GET['funcao'] == "p_insulado_s") {
	
$id = $_GET['id'];

$atualiza = mysqli_query($conexao, "UPDATE clientes SET insulado='S' WHERE id='$id'") or die (mysqli_error());
		
header ('Location: ../cadastros_ver.php?cliente='.$id.'&msgSucesso=Acesso liberado com sucesso');

}

/* **************************************************************************
ACESSO INSULADO: BLOQUEAR
************************************************************************** */
if ($_GET['funcao'] == "p_insulado_n") {
	
$id = $_GET['id'];

$atualiza = mysqli_query($conexao, "UPDATE clientes SET insulado='N' WHERE id='$id'") or die (mysqli_error());
		
header ('Location: ../cadastros_ver.php?cliente='.$id.'&msgSucesso=Acesso bloqueado com sucesso');

}

/* **************************************************************************
ACESSO MOVELEIRO: LIBERAR
************************************************************************** */
if ($_GET['funcao'] == "p_moveleiro_s") {
	
$id = $_GET['id'];

$atualiza = mysqli_query($conexao, "UPDATE clientes SET moveleiro='S' WHERE id='$id'") or die (mysqli_error());
		
header ('Location: ../cadastros_ver.php?cliente='.$id.'&msgSucesso=Acesso liberado com sucesso');

}

/* **************************************************************************
ACESSO MOVELEIRO: BLOQUEAR
************************************************************************** */
if ($_GET['funcao'] == "p_moveleiro_n") {
	
$id = $_GET['id'];

$atualiza = mysqli_query($conexao, "UPDATE clientes SET moveleiro='N' WHERE id='$id'") or die (mysqli_error());
		
header ('Location: ../cadastros_ver.php?cliente='.$id.'&msgSucesso=Acesso bloqueado com sucesso');

}

} // Permissão para acessar a página
else {
	header ('Location: ../admsys.php?msgErro=Você não tem permissão para acessar essa página');
}
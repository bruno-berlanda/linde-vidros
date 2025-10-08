<?php
// Busca a biblioteca reCaptcha
require_once "recaptchalib.php";

// Sua chave secreta
$secret = "6LebcucSAAAAADguFB-eR7Z4GUUAyDVjSCs5w58c";
 
// Resposta vazia
$response = null;
 
// Verifique a chave secreta
$reCaptcha = new ReCaptcha($secret);

// Se submetido, verifique a resposta
if ($_POST["g-recaptcha-response"]) {
$response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}

// Se tudo estiver OK, faz o cadastro
if ($response != null && $response->success) {

// Data do cadastro
$data = date("Y-m-d");

// Dados do formulário
$nome 		= strip_tags(trim($_POST['nome']));
$cpf 		= strip_tags(trim($_POST['cpf']));
$email1		= strip_tags(trim($_POST['email1']));
$email2		= strip_tags(trim($_POST['email2']));
$senha1		= strip_tags(trim($_POST['senha1']));
$senha2		= strip_tags(trim($_POST['senha2']));

if ($senha1 == $senha2) { $senha = $senha1; }
if ($email1 == $email2) { $email = $email1; }

// Converter texto para MINÚSCULO
$email = strtolower($email);

// Conexão com o Banco de Dados
include_once ("conexao.php");

$conCPF = mysqli_query ($conexao, "SELECT cpf FROM usuarios WHERE cpf='$cpf'") or die (mysqli_error());
$contaCPF = mysqli_num_rows ($conCPF);

$conEmail = mysqli_query ($conexao, "SELECT email FROM usuarios WHERE email='$email'") or die (mysqli_error());
$contaEmail = mysqli_num_rows ($conEmail);

// Verifica se os campos foram preenchidos
if ($nome == '' || $cpf == '' || $email1 == '' || $email2 == '' || $senha1 == '' || $email2 == '') {
	header ('Location: ../curriculo-cadastrar.php?msgErro=Você precisa preencher todos os campos');
}
// Verifica se o CPF já está cadastrado
else if ($contaCPF >= 1) {
	header ('Location: ../curriculo-cadastrar.php?msgErro=CPF já cadastrado');
}
// Confere os dois e-mails digitados no cadastro
else if ($email1 != $email2) {
	header ('Location: ../curriculo-cadastrar.php?msgErro=Os e-mails digitados não conferem');
}
// Verifica se o E-MAIL já está cadastrado
else if ($contaEmail >= 1) {
	header ('Location: ../curriculo-cadastrar.php?msgErro=E-mail já cadastrado');
}
// Confere as duas senhas digitadas no cadastro
else if ($senha1 != $senha2) {
	header ('Location: ../curriculo-cadastrar.php?msgErro=As senhas digitadas não conferem');
}
// Se tudo estiver OK faz o cadastro
else {
// Converter texto para maiusculas
$nome = strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

$senha_cripto 	= md5($senha);
$codigo 		= md5($cpf);

// Grava no banco de dados o cadastro
$cadastrando = mysqli_query ($conexao, "INSERT INTO usuarios (cpf, nome, email, senha, codigo, criado) VALUES ('$cpf', '$nome', '$email', '$senha_cripto', '$codigo', '$data')") or die (mysqli_error());

/* *******************************************************************************
ENVIANDO E-MAIL
******************************************************************************* */
// Inclui o arquivo PHPMailerAutoload.php localizado na pasta phpmailer
require_once ("../phpmailer/PHPMailerAutoload.php");

// Inicia a classe PHPMailer
$mail = new PHPMailer();

include_once ("conexao_email.php");

// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->AddAddress($email);
//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta

// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
//$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->Subject  = "Cadastro realizado com sucesso"; // Assunto da mensagem
$mail->Body = "
<html>
<head>
</head>
<body>

<table border='0' width='100%' cellpadding='5'>
	<tr height='106'>
		<td><img src='http://www.lindevidros.com.br/email/logo.png' /></td>
	</tr>

	<tr>
		<td>
		<p><font face='Georgia' size='4' color='#1469B8'><b>&nbsp;&nbsp; Cadastro realizado com sucesso!</b></font></p>
		<p><font face='Verdana' size='2'>Olá <b>$nome</b>,</font></p>
        <p><font face='Verdana' size='2'>Você efetuou o seu cadastro com sucesso em nosso website. A partir deste momento você pode fazer o login em nossa área de currículos e cadastrar seus dados. É de extrema importância que seu currículo esteja sempre atualizado, pois a partir das informações contidas nele estaremos fazendo novas contratações.</font></p>
        <p>
        <font color='#1469B8' face='Verdana' size='2'><b>CPF:</b></font> <font face='Verdana' size='2'>$cpf</font>
        <br />
        <font color='#1469B8' face='Verdana' size='2'><b>SENHA:</b></font> <font face='Verdana' size='2'>$senha</font>
        </p>
        <p><font face='Verdana' size='2'>A <b>Linde Vidros</b> agradece o seu contato.</font></p>
		</td>
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
$mail->ClearAttachments();

header ('Location: ../curriculo-entrar.php?msgSucesso=Cadastro realizado com sucesso! Você já pode cadastrar seu currículo');
}

// If do reCaptcha
}
else {
	header ('Location: ../curriculo-cadastrar.php?msgErro=Houve algum erro na hora de efetuar o cadastro. Tente novamente');
}
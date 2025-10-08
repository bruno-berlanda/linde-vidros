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

// Dados do formulário
$cpf 	= strip_tags(trim($_POST['cpf']));
$email 	= strip_tags(trim($_POST['email']));

// Conexão com o Banco de Dados
include_once ("conexao.php");

$conCPF = mysqli_query ($conexao, "SELECT cpf, nome, email, senha FROM usuarios WHERE cpf='$cpf'") or die (mysqli_error());
$contaCPF = mysqli_num_rows ($conCPF);

$dados = mysqli_fetch_array ($conCPF);
	$cpfUsuario 	= $dados['cpf'];
	$nomeUsuario 	= $dados['nome'];
	$emailUsuario	= $dados['email'];
	
// Verifica se o CPF digitado está cadastrado
if ($contaCPF == 0) {
	header ('Location: ../curriculo-entrar.php?opt=reqsenha&msgErro=CPF inválido');
}
// Verifica se o e-mail corresponde ao CPF digitado
else if ($email != $emailUsuario) {
	header ('Location: ../curriculo-entrar.php?opt=reqsenha&msgErro=E-mail não corresponde ao CPF cadastrado');
}
else if ($contaCPF == 1 && $email == $emailUsuario) { // Envia a senha por e-mail
	// Gera uma senha nova
	function geraSenha($tamanho = 4, $maiusculas = false, $numeros = true, $simbolos = false) {
		// Caracteres de cada tipo
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$simb = '!@#$%*-';
		
		// Variáveis internas
		$retorno = '';
		$caracteres = '';
		
		// Agrupamos todos os caracteres que poderão ser utilizados
		$caracteres .= $lmin;
		if ($maiusculas) $caracteres .= $lmai;
		if ($numeros) $caracteres .= $num;
		if ($simbolos) $caracteres .= $simb;
		
		// Calculamos o total de caracteres possíveis
		$len = strlen($caracteres);
		for ($n = 1; $n <= $tamanho; $n++) {
			// Criamos um número aleatório de 1 até $len para pegar um dos caracteres
			$rand = mt_rand(1, $len);
			// Concatenamos um dos caracteres na variável $retorno
			$retorno .= $caracteres[$rand-1];
		}
		return $retorno;
	}
	
	$nova_senha = geraSenha();
	$nova_senha_cri = md5($nova_senha);
	
	// Atualiza senha no BD
	$atu_senha = mysqli_query($conexao, "UPDATE usuarios SET senha='$nova_senha_cri' WHERE cpf='$cpfUsuario'") or die (mysqli_error());
	
	// Inclui o arquivo PHPMailerAutoload.php localizado na pasta phpmailer
	require_once ("../phpmailer/PHPMailerAutoload.php");
	
	// Inicia a classe PHPMailer
	$mail = new PHPMailer();
	
	include_once ("conexao_email.php");
	
	// Define os destinatário(s)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->AddAddress($emailUsuario);
	//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
	//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
	
	// Define os dados técnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
	//$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
	$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
	
	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->Subject  = "Recuperação de senha"; // Assunto da mensagem
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
			<p><font face='Georgia' size='4' color='#1469B8'><b>&nbsp;&nbsp; Recuperação de Senha</b></font></p>
			<p><font face='Verdana' size='2'>Olá <b>$nomeUsuario</b>,</font></p>
			<p><font face='Verdana' size='2'>Você selecionou a opção <b>Recuperar Senha</b> na área de Currículos em nosso website. Segue neste e-mail a sua senha para poder efetuar o login novamente.</font></p>
			<p>
			<font color='#1469B8' face='Verdana' size='2'><b>CPF:</b></font> <font face='Verdana' size='2'>$cpfUsuario</font>
			<br />
			<font color='#1469B8' face='Verdana' size='2'><b>NOVA SENHA:</b></font> <font face='Verdana' size='2'>$nova_senha</font>
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
	
	// Exibe uma mensagem de resultado
	header ('Location: ../curriculo-entrar.php?msgSucesso=Verifique seu e-mail, a senha foi enviada com sucesso');
}

// If do reCaptcha
}
else {
	header ('Location: ../curriculo-entrar.php?opt=reqsenha&msgErro=Houve algum erro ao recuperar senha. Tente novamente');
}
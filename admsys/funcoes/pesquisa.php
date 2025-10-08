<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_adm == "S" || $perm_pesquisa == "S") {
	
/* ******************************************************************************************************************
CADASTRAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "cadastrar") {

// Dados do formulário
$nome = strip_tags(trim($_POST['nome']));

$nome = strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

$data_hoje = date ("Y-m-d");

/* ************ */
// Conta cadastro
$consultaCad = mysqli_query ($conexao, "SELECT nome FROM pesquisa WHERE nome='$nome'") or die (mysqli_error());
$contaCad = mysqli_num_rows ($consultaCad);
/* ************ */

if ($contaCad == 1) {
	header ('Location: ../pesquisa.php?msgErro=Já existe uma pesquisa com esse nome');
}
else {
	$cadastra = mysqli_query ($conexao, "INSERT INTO pesquisa (nome) VALUES ('$nome')") or die (mysqli_error());

	header ('Location: ../pesquisa.php?msgSucesso=Pesquisa criada com sucesso, adicione os clientes que irão responder à essa pesquisa');
}

}

/* ******************************************************************************************************************
EDITAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "editar") {

$id = $_GET['id'];

$nome = strip_tags(trim($_POST['nome']));

$nome = strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

// Hidden
$nome_atual = $_POST['nome_atual'];

/* ************ */
// Conta cadastro
$consultaCad = mysqli_query ($conexao, "SELECT nome FROM pesquisa WHERE nome='$nome'") or die (mysqli_error());
$contaCad = mysqli_num_rows ($consultaCad);
/* ************ */

if ($contaCad == 1 && $nome != $nome_atual) {
	header ('Location: ../pesquisa.php?editar='.$id.'&msgErro=Já existe uma pesquisa com esse nome');
}
else {
	$atualiza = mysqli_query ($conexao, "UPDATE pesquisa SET nome='$nome' WHERE id='$id'") or die (mysqli_error());

	header ('Location: ../pesquisa.php?msgSucesso=Pesquisa alterada com sucesso');
}

}

/* ******************************************************************************************************************
EXCLUIR
****************************************************************************************************************** */
if ($_GET['funcao'] == "excluir") {

$id = $_GET['id'];

$excluir1 = mysqli_query ($conexao, "DELETE FROM pesquisa_clientes WHERE id_pesquisa='$id'") or die (mysqli_error());
$excluir2 = mysqli_query ($conexao, "DELETE FROM pesquisa WHERE id='$id'") or die (mysqli_error());

header ('Location: ../pesquisa.php?msgSucesso=Pesquisa excluída com sucesso');

}

/* ******************************************************************************************************************
CADASTRAR CLIENTE
****************************************************************************************************************** */
if ($_GET['funcao'] == "cad_cliente") {

$id_pesquisa = $_GET['id_pesquisa'];

// Dados do formulário
$cliente 		= strip_tags(trim($_POST['cliente']));
$responsavel 	= strip_tags(trim($_POST['responsavel']));

$responsavel 	= strtr(strtoupper($responsavel),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

/* ************ */
// Consulta dados do cliente
require ("../../clientes/includes/conexao_interna.php");

$con_cliente = mysqli_query ($conexao, "SELECT razao_social, rota_cliente, email FROM admin_clientes WHERE cod_cliente='$cliente'") or die (mysqli_error());
	$dados = mysqli_fetch_array ($con_cliente);
		$c_razao 	= $dados['razao_social'];
		$c_rota 	= $dados['rota_cliente'];
		$c_email 	= $dados['email'];

mysqli_close ($conexao_interna);

require ("../../funcoes/conexao.php"); // Conecta novamente ao BD
/* ************ */

if ($c_email == "") {
	header ('Location: ../pesquisa.php?editar='.$id_pesquisa.'&msgErro=O cliente '.$cliente.' - '.$c_razao.' não pode ser adicionado por não ter um e-mail cadastrado');
}
else {
	
	/* ************ */
	// Conta cadastro
	$consultaCad = mysqli_query ($conexao, "SELECT id FROM pesquisa_clientes WHERE id='$id_pesquisa' AND cod_cliente='$cliente'") or die (mysqli_error());
	$contaCad = mysqli_num_rows ($consultaCad);
	/* ************ */
	
	if ($contaCad == 1) {
		header ('Location: ../pesquisa.php?editar='.$id_pesquisa.'&msgErro=Cliente já cadastrado nesta pesquisa');
	}
	else {
		
		$codigo = md5($id_pesquisa.$cliente);
		
		$data_hoje = date ("Y-m-d");
		
		$cadastra = mysqli_query ($conexao, "INSERT INTO pesquisa_clientes (id_pesquisa, cod_cliente, nome_cliente, rota, responsavel, email, codigo, ultimo_alerta) VALUES ('$id_pesquisa', '$cliente', '$c_razao', '$c_rota', '$responsavel', '$c_email', '$codigo', '$data_hoje')") or die (mysqli_error());
		
		/* **********************************************
		ENVIANDO O E-MAIL
		********************************************** */
		
		/************
		Configurações
		************/
		$para = $c_email;
		//$para = "bruno.berlanda@lindevidros.com.br";
		
		// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
		require ("../../phpmailer/class.phpmailer.php");
	
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
		$mail->Subject  = "Pesquisa de Satisfação Linde Vidros"; // Assunto da mensagem
		
		$mail->Body = "
		<html>
		<head>
		</head>
		<body link='#666666' vlink='#666666' alink='#666666'>
	
		<table border='0' width='700' cellpadding='5'>
			<tr>
				<td align='center'><font face='Verdana' size='1'>Caso não consiga visualizar as imagens selecione 'Sempre mostrar conteúdo'.</font></td>
			</tr>
			<tr height='106'>
				<td colspan='4'><img src='http://www.lindevidros.com.br/email/logo.png'></td>
			</tr>
		  
			<tr>
				<td style='padding: 13px 0'>
					<p><font face='Georgia' size='5' color='#1469B8'><b>Pesquisa de Satisfação</b></font></p>
				</td>
			</tr>
			<tr>
				<td>
					<p><font face='Verdana' size='2' color='#444444'>Olá <b>$responsavel</b>,</font></p>
				</td>
			</tr>
			<tr>
				<td>
					<p><font face='Verdana' size='2' color='#444444'>A <b>Linde Vidros</b> tem como compromisso buscar a melhoria continua na qualidade em lhe atender, objetivando sempre a sua satisfação.</font></p>
				</td>
			</tr>
			<tr>
				<td>
					<p><font face='Verdana' size='2' color='#444444'>A sua participação é primordial para que consigamos aperfeiçoar nossos trabalhos e atingir nossos objetivos. Por isso solicitamos que nos ajude, respondendo um pequeno questionário. É rápido e fácil.</font></p>
				</td>
			</tr>
			<tr>
				<td align='center'>
				<a href='http://www.lindevidros.com.br/pesquisa/index.php?p=$codigo'><img src='http://www.lindevidros.com.br/email/pesquisa.png'></a>
				</td>
			</tr>
			<tr>
				<td>
					<p><font face='Verdana' size='2' color='#444444'>Desde já, agradecemos a sua colaboração.</font></p>
				</td>
			</tr>
			<tr>
				<td align='center'>
				<a href='http://www.lindevidros.com.br'><img src='http://www.lindevidros.com.br/email/lindesite.png'></a>
				<br><br>
				<a href='https://www.facebook.com/pages/Linde-Vidros/280108568717364'><img src='http://www.lindevidros.com.br/email/face.png'></a>
				&nbsp;
				<a href='http://www.youtube.com/user/lindevidros'><img src='http://www.lindevidros.com.br/email/youtube.png'></a>
				&nbsp;
				<a href='https://instagram.com/lindevidros'><img src='http://www.lindevidros.com.br/email/instagram.png'></a>
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
		/* ******************************************************************************** */
		
		header ('Location: ../pesquisa.php?editar='.$id_pesquisa.'&msgSucesso=Cliente adicionado na pesquisa com sucesso');
	}

}

}

/* ******************************************************************************************************************
EXCLUIR CLIENTE
****************************************************************************************************************** */
if ($_GET['funcao'] == "excluir_cliente") {

$id 			= $_GET['id'];
$id_pesquisa 	= $_GET['id_pesquisa'];

$excluir = mysqli_query ($conexao, "DELETE FROM pesquisa_clientes WHERE id='$id'") or die (mysqli_error());

header ('Location: ../pesquisa.php?editar='.$id_pesquisa.'&msgSucesso=Cliente removido da pesquisa com sucesso');

}


} // Permissão para acessar a página
else {
	header ('Location: ../admsys.php?msgErro=Você não tem permissão para acessar essa página');
}

/* ******************************************************************************************************************
CADASTRAR CLIENTE
****************************************************************************************************************** */
if ($_GET['funcao'] == "reenviar_email") {

$id = $_GET['id'];

$consulta_cliente = mysqli_query ($conexao, "SELECT id_pesquisa, responsavel, email, codigo FROM pesquisa_clientes WHERE id='$id'") or die (mysqli_error());
	$dados_cliente = mysqli_fetch_array ($consulta_cliente);
		$id_pesquisa 		= $dados_cliente['id_pesquisa'];
		$cli_responsavel 	= $dados_cliente['responsavel'];
		$cli_email 			= $dados_cliente['email'];
		$cli_codigo			= $dados_cliente['codigo'];

/* **********************************************
ENVIANDO O E-MAIL
********************************************** */
// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
require ("../../phpmailer/class.phpmailer.php");

// Inicia a classe PHPMailer
$mail = new PHPMailer();

include_once ("../../funcoes/conexao_email.php");

// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->AddAddress($cli_email);
//$mail->AddAddress('bruno.berlanda@lindevidros.com.br', 'Bruno Berlanda');
//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
//$mail->AddBCC('bruno.berlanda@lindevidros.com.br', 'Bruno Berlanda'); // Cópia Oculta

// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->Subject  = "Pesquisa de Satisfação Linde Vidros"; // Assunto da mensagem

$mail->Body = "
<html>
<head>
</head>
<body link='#666666' vlink='#666666' alink='#666666'>

<table border='0' width='700' cellpadding='5'>
	<tr>
		<td align='center'><font face='Verdana' size='1'>Caso não consiga visualizar as imagens selecione 'Sempre mostrar conteúdo'.</font></td>
	</tr>
	<tr height='106'>
		<td colspan='4'><img src='http://www.lindevidros.com.br/email/logo.png'></td>
	</tr>
  
	<tr>
		<td style='padding: 13px 0'>
			<p><font face='Georgia' size='5' color='#1469B8'><b>Pesquisa de Satisfação</b></font></p>
		</td>
	</tr>
	<tr>
		<td>
			<p><font face='Verdana' size='2' color='#444444'>Olá <b>$cli_responsavel</b>,</font></p>
		</td>
	</tr>
	<tr>
		<td>
			<p><font face='Verdana' size='2' color='#444444'>A <b>Linde Vidros</b> tem como compromisso buscar a melhoria continua na qualidade em lhe atender, objetivando sempre a sua satisfação.</font></p>
		</td>
	</tr>
	<tr>
		<td>
			<p><font face='Verdana' size='2' color='#444444'>A sua participação é primordial para que consigamos aperfeiçoar nossos trabalhos e atingir nossos objetivos. Por isso solicitamos que nos ajude, respondendo um pequeno questionário. É rápido e fácil.</font></p>
		</td>
	</tr>
	<tr>
		<td align='center'>
		<a href='http://www.lindevidros.com.br/pesquisa/index.php?p=$cli_codigo'><img src='http://www.lindevidros.com.br/email/pesquisa.png'></a>
		</td>
	</tr>
	<tr>
		<td>
			<p><font face='Verdana' size='2' color='#444444'>Desde já, agradecemos a sua colaboração.</font></p>
		</td>
	</tr>
	<tr>
		<td align='center'>
		<a href='http://www.lindevidros.com.br'><img src='http://www.lindevidros.com.br/email/lindesite.png'></a>
		<br><br>
		<a href='https://www.facebook.com/pages/Linde-Vidros/280108568717364'><img src='http://www.lindevidros.com.br/email/face.png'></a>
		&nbsp;
		<a href='http://www.youtube.com/user/lindevidros'><img src='http://www.lindevidros.com.br/email/youtube.png'></a>
		&nbsp;
		<a href='https://instagram.com/lindevidros'><img src='http://www.lindevidros.com.br/email/instagram.png'></a>
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
/* ******************************************************************************** */

$data_hoje = date ("Y-m-d");

$atualiza = mysqli_query ($conexao, "UPDATE pesquisa_clientes SET ultimo_alerta='$data_hoje' WHERE id='$id'") or die (mysqli_error());

header ('Location: ../pesquisa.php?editar='.$id_pesquisa.'&msgSucesso=Alerta enviado com sucesso');

}
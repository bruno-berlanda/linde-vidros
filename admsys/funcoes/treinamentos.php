<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_adm == "S" || $perm_treinamentos == "S") {
	
	$pasta = '../../img/treinamentos/';
	
/* ******************************************************************************************************************
CADASTRAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "cadastrar") {

// Dados do formulário
$nome 	= strip_tags(trim($_POST['nome']));
$link 	= strip_tags(trim($_POST['link']));
$aulas 	= strip_tags(trim($_POST['aulas']));

$nome 	= strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

// Verifica se foi selecionada uma foto para a notícia
if (is_file($_FILES['foto']['tmp_name'])) {
	
	$foto = $_FILES['foto']['name']; // Nome do arquivo original
	
	$extensao = @end(explode(".",$foto));
	
	// TRATAMENTO DO NOME DA FOTO
	$foto = md5($nome.date("Y-m-d H:i:s")).".".strtolower($extensao);
	
	$envia_foto = move_uploaded_file($_FILES['foto']['tmp_name'], $pasta.$foto);

}

/* *** */

$codigo = md5($nome);

/* *** */

$cadastrando = mysqli_query ($conexao, "INSERT INTO treinamentos (nome, link, aulas, foto, codigo) VALUES ('$nome', '$link', '$aulas', '$foto', '$codigo')") or die (mysqli_error());

header ('Location: ../treinamentos.php?msgSucesso=Treinamento cadastrado com sucesso');

}

/* ******************************************************************************************************************
EDITAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "editar") {

$id = $_GET['id'];

// Dados do formulário
$nome 	= strip_tags(trim($_POST['nome']));
$link 	= strip_tags(trim($_POST['link']));
$aulas 	= strip_tags(trim($_POST['aulas']));

$nome 	= strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

// Verifica se foi selecionada uma foto para a notícia
if (is_file($_FILES['foto']['tmp_name'])) {
	
	// Excluir a foto
	$sql_foto = mysqli_query ($conexao, "SELECT foto FROM treinamentos WHERE id='$id'");
		$linha = mysqli_fetch_array($sql_foto);
			$foto_db = $linha['foto'];
	
	unlink($pasta.$foto_db);
	
	$foto = $_FILES['foto']['name']; // Nome do arquivo original
	
	$extensao = @end(explode(".",$foto));
	
	// TRATAMENTO DO NOME DA FOTO
	$foto = md5($nome.date("Y-m-d H:i:s")).".".strtolower($extensao);
	
	$envia_foto = move_uploaded_file($_FILES['foto']['tmp_name'], $pasta.$foto);
	
	$editando_foto = mysqli_query ($conexao, "UPDATE treinamentos SET foto='$foto' WHERE id='$id'") or die (mysqli_error());

}

/* *** */

$editando = mysqli_query ($conexao, "UPDATE treinamentos SET nome='$nome', link='$link', aulas='$aulas' WHERE id='$id'") or die (mysqli_error());

header ('Location: ../treinamentos.php?msgSucesso=Treinamento alterado com sucesso');

}

/* ******************************************************************************************************************
EXCLUIR
****************************************************************************************************************** */
if($_GET['funcao'] == "excluir") {
	
$id = $_GET['id'];
		
// Excluir a foto
$sql_foto = mysqli_query ($conexao, "SELECT foto FROM treinamentos WHERE id='$id'");
	$linha = mysqli_fetch_array($sql_foto);
		$foto_db = $linha['foto'];

unlink ($pasta.$foto_db);

$excluir = mysqli_query ($conexao, "DELETE FROM treinamentos WHERE id='$id'") or die (mysqli_error());

header ('Location: ../treinamentos.php?msgSucesso=Treinamento excluído com sucesso');
}

/* ******************************************************************************************************************
DESATIVAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "desativar") {
	
	$id = $_GET['id'];
	
	$editando = mysqli_query ($conexao, "UPDATE treinamentos SET ativo='N' WHERE id='$id'") or die (mysqli_error());				

	header('Location: ../treinamentos.php?msgSucesso=Treinamento desativado com sucesso');
}

/* ******************************************************************************************************************
ATIVAR
****************************************************************************************************************** */
if ($_GET['funcao'] == "ativar") {
	
	$id = $_GET['id'];
	
	$editando = mysqli_query ($conexao, "UPDATE treinamentos SET ativo='S' WHERE id='$id'") or die (mysqli_error());				

	header('Location: ../treinamentos.php?msgSucesso=Treinamento ativado com sucesso');
}

/* ************************************************************************************************************************************************************************ */
/* ************************************************************************************************************************************************************************ */
/* ************************************************************************************************************************************************************************ */
/* ************************************************************************************************************************************************************************ */
/* ************************************************************************************************************************************************************************ */

/* ******************************************************************************************************************
NOVO USUÁRIO
****************************************************************************************************************** */
if ($_GET['funcao'] == "novo_usuario") {

// Dados do formulário
$cliente 		= strip_tags(trim($_POST['cliente']));
$nome 			= strip_tags(trim($_POST['nome']));
$email 			= strip_tags(trim($_POST['email']));
$treinamento 	= strip_tags(trim($_POST['treinamento']));

$nome 	= strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$email 	= strtolower($email);

/* *** */

$con_registro = mysqli_query ($conexao, "SELECT id FROM treinamentos_usuarios WHERE cliente='$cliente' AND nome='$nome' AND email='$email' AND codigo_curso='$treinamento'") or die (mysqli_error());
$conta_registro = mysqli_num_rows ($con_registro);

if ($conta_registro > 0) {
	header ('Location: ../treinamentos_usuarios.php?msgErro=Este usuário já está cadastrado nesse treinamento');
}
else {
	// Consulta dados do cliente
	$con_cliente = mysqli_query ($conexao, "SELECT razao_social, nome_fantasia, rota_cliente, cnpj FROM admin_clientes WHERE cod_cliente='$cliente'") or die (mysqli_error());
		$d_cliente = mysqli_fetch_array ($con_cliente);
			$cliente_razao 	= $d_cliente['razao_social'];
			$cliente_nome 	= $d_cliente['nome_fantasia'];
			$cliente_rota 	= $d_cliente['rota_cliente'];
			$cliente_cnpj 	= $d_cliente['cnpj'];
	
	/* *** */
	
	// Consulta dados do treinamento
	$con_treinamento = mysqli_query ($conexao, "SELECT nome, aulas FROM treinamentos WHERE codigo='$treinamento'") or die (mysqli_error());
		$d_treinamento = mysqli_fetch_array ($con_treinamento);
			$treinamento_nome 	= $d_treinamento['nome'];
			$treinamento_aulas 	= $d_treinamento['aulas'];
	
	/* *** */
	
	$codigo = md5($cliente.$nome.$treinamento.date("YmdHis"));
	
	/* *** */
	
	$cadastrando = mysqli_query ($conexao, "INSERT INTO treinamentos_usuarios (cliente, razao_social, nome_fantasia, rota, cnpj, nome, email, codigo, codigo_curso, aulas_total) VALUES ('$cliente', '$cliente_razao', '$cliente_nome', '$cliente_rota', '$cliente_cnpj', '$nome', '$email', '$codigo', '$treinamento', '$treinamento_aulas')") or die (mysqli_error());
	
	/* ******************************************************************************************** */
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
	//$mail->AddAddress($para);
	//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
	$mail->AddBCC('bruno.berlanda@lindevidros.com.br', 'Bruno Berlanda'); // Cópia Oculta

	// Define os dados técnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
	$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->Subject  = "Treinamento Linde Vidros"; // Assunto da mensagem
	
	$mail->Body = "
	<html>
	<head>
	</head>
	<body>
	
	<center>
	
	<table border='0' width='600' cellpadding='0' cellspacing='1'>
		<tr>
			<td style='padding: 12px 0' align='center'><img src='http://www.lindevidros.com.br/email/logo.png'></td>
		</tr>
		
		<tr>
			<td style='padding: 8px 0'>
				<img src='http://www.lindevidros.com.br/email/treinamento/tr1_img01.png'>
			</td>
		</tr>
		<tr>
			<td style='padding: 15px 0'>
				<p><font face='Verdana' size='2' color='#333333'>Olá, <b>$nome</b>!</font></p>
				
				<p><font face='Verdana' size='2' color='#333333'>Conhecimento nunca é demais, não é mesmo?</font></p>
				
				<p><font face='Verdana' size='2' color='#333333'>Já que concordamos, que tal aprender um pouco mais sobre um assunto selecionado especialmente para lhe dar apoio no dia-a-dia.</font></p>
				
				<p><font face='Verdana' size='2' color='#333333'>Aproveite!</font></p>
			</td>
		</tr>
		
		<tr>
			<td style='padding: 8px 0'>
				<img src='http://www.lindevidros.com.br/email/treinamento/tr1_img02.png'>
			</td>
		</tr>
		<tr>
			<td style='padding: 15px 0'>
				<p align='center'><font face='Verdana' size='6' color='#333333'><b>$treinamento_nome</b></font></p>
			</td>
		</tr>
		
		<tr>
			<td style='padding: 15px 0'>
				<p align='center'><a href='#'><img src='http://www.lindevidros.com.br/email/treinamento/tr1_img03.png'></a></p>
			</td>
		</tr>
		
		<tr>
			<td style='padding: 15px 0'>
				<p><img src='http://www.lindevidros.com.br/email/treinamento/tr1_img04.png'></p>
			</td>
		</tr>
	</table>
	
	</center>
	
	</body>
	</html>
	";

	// Envia o e-mail
	$enviado = $mail->Send();

	// Limpa os destinatários e os anexos
	$mail->ClearAllRecipients();
	/* ******************************************************************************************** */
	
	
	header ('Location: ../treinamentos_usuarios.php?msgSucesso=Usuário cadastrado com sucesso');
}

}

/* ******************************************************************************************************************
EXCLUIR USUÁRIO
****************************************************************************************************************** */
if($_GET['funcao'] == "excluir_usuario") {
	
	$codigo = $_GET['u'];
	
	$excluir = mysqli_query ($conexao, "DELETE FROM treinamentos_usuarios WHERE codigo='$codigo'") or die (mysqli_error());
	
	header ('Location: ../treinamentos_usuarios.php?msgSucesso=Usuário excluído com sucesso');
	
}

/* ******************************************************************************************************************
DESATIVAR USUÁRIO
****************************************************************************************************************** */
if ($_GET['funcao'] == "desativar_usuario") {
	
	$codigo = $_GET['u'];
	
	$editando = mysqli_query ($conexao, "UPDATE treinamentos_usuarios SET ativo='N' WHERE codigo='$codigo'") or die (mysqli_error());				

	header('Location: ../treinamentos_usuarios.php?msgSucesso=Usuário desativado com sucesso');
	
}

/* ******************************************************************************************************************
ATIVAR USUÁRIO
****************************************************************************************************************** */
if ($_GET['funcao'] == "ativar_usuario") {
	
	$codigo = $_GET['u'];
	
	$editando = mysqli_query ($conexao, "UPDATE treinamentos_usuarios SET ativo='S' WHERE codigo='$codigo'") or die (mysqli_error());				

	header('Location: ../treinamentos_usuarios.php?msgSucesso=Usuário ativado com sucesso');
	
}

/* ***** */

} // Permissão para acessar a página
else {
	header ('Location: ../admsys.php?msgErro=Você não tem permissão para acessar essa página');
}
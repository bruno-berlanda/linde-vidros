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
$tipo 		= strip_tags(trim($_POST['tipo']));
$assunto 	= strip_tags(trim($_POST['assunto']));
$nome 		= strip_tags(trim($_POST['nome']));
$cidade 	= strip_tags(trim($_POST['cidade']));
$uf 		= strip_tags(trim($_POST['uf']));
$email 		= strip_tags(trim($_POST['email']));
$telefone 	= strip_tags(trim($_POST['telefone']));
$mensagem	= nl2br(strip_tags(trim($_POST['mensagem'])));
$resposta	= strip_tags(trim($_POST['resposta']));

// Verifica se os campos foram preenchidos
if ($tipo == "" || $assunto == "" || $nome == "" || $cidade == "" || $uf == "" || $email == "" || $telefone == "" || $mensagem == "" || $resposta == "") {
	header('Location: ../contato.php?msgErro=Você precisa preencher todos os campos para contato');
}
// Se estiver OK envia o e-mail
else {
// Data e Hora do contato
$data_contato = date("Y-m-d");
$hora_contato = date("H:i:s");

$nome 	= strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$cidade = strtr(strtoupper($cidade),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

$email = strtolower($email);

// Conexão com o Banco de Dados
include_once ("conexao.php");

// Grava no Banco de Dados
$cadastro = mysqli_query ($conexao, "INSERT INTO contato (tipo, assunto, nome, cidade, uf, email, fone, mensagem, resposta, data, hora) VALUES ('$tipo', '$assunto', '$nome', '$cidade', '$uf', '$email', '$telefone', '$mensagem', '$resposta', '$data_contato', '$hora_contato')") or die (mysqli_error());

mysqli_close ($conexao);

// Mensagem enviada com sucesso
header ('Location: ../contato.php?msgSucesso=Sua mensagem foi enviada com sucesso');
}

// If do reCaptcha
}
else {
	header ('Location: ../contato.php?msgErro=Houve algum erro na hora de enviar o contato. Tente novamente');
}
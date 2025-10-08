<?
// Conexão com o Banco de Dados
include_once ("conexao.php");

// Data do cadastro
$data = date("Y-m-d");

/* **********************************************************************
CADASTRAR CIENTE LINDE
********************************************************************** */
if ($_GET['opt'] == "cliente") {
	
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
$razao 			= strip_tags(trim($_POST['razao']));
$nome 			= strip_tags(trim($_POST['nome']));
$ramo			= strip_tags(trim($_POST['ramo']));
$cnpj			= strip_tags(trim($_POST['cnpjj']));
$inscricao		= strip_tags(trim($_POST['inscricao']));
$endereco		= strip_tags(trim($_POST['endereco']));
$numero			= strip_tags(trim($_POST['numero']));
$bairro 		= strip_tags(trim($_POST['bairro']));
$cidade			= strip_tags(trim($_POST['cidade']));
$uf				= strip_tags(trim($_POST['uf']));
$cep			= strip_tags(trim($_POST['cep']));
$fone			= strip_tags(trim($_POST['fone']));
$fax 			= strip_tags(trim($_POST['fax']));
$celular		= strip_tags(trim($_POST['celular']));
$email			= strip_tags(trim($_POST['email']));
$skype			= strip_tags(trim($_POST['skype']));
$end_cobranca	= strip_tags(trim($_POST['end_cobranca']));
$end_entrega	= strip_tags(trim($_POST['end_entrega']));
$vendedor		= strip_tags(trim($_POST['vendedor']));
$obs 			= strip_tags(trim($_POST['obs']));

$conCNPJ = mysqli_query ($conexao, "SELECT cnpj FROM clientes WHERE cnpj='$cnpj'") or die (mysqli_error());
$contaCNPJ = mysqli_num_rows ($conCNPJ);

// Verifica se o CNPJ já está cadastrado
if ($contaCNPJ >= 1) {
	header ('Location: ../area-restrita.php?msgErro=CNPJ já cadastrado');
}
else {
// Converter texto para MAÍUSCULO
$razao 			= strtr(strtoupper($razao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$nome 			= strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$ramo 			= strtr(strtoupper($ramo),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$endereco 		= strtr(strtoupper($endereco),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$bairro 		= strtr(strtoupper($bairro),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$cidade 		= strtr(strtoupper($cidade),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$end_cobranca 	= strtr(strtoupper($end_cobranca),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$end_entrega 	= strtr(strtoupper($end_entrega),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$vendedor 		= strtr(strtoupper($vendedor),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$obs 			= strtr(strtoupper($obs),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

// Converter texto para MINÚSCULO
$email = strtolower($email);

$tipo = 1; // Cliente Linde

// Cadastra na tabela CLIENTES
$cadastrando1 = mysqli_query ($conexao, "INSERT INTO clientes (
	cnpj, razao, email, criado, tipo,
	nome, ramo, inscricao, endereco, numero, bairro, cidade, uf, cep, fone, fax, celular, skype, end_cobranca, end_entrega, vendedor, obs
	) VALUES (
	'$cnpj', '$razao', '$email', '$data', '$tipo',
	'$nome', '$ramo', '$inscricao', '$endereco', '$numero', '$bairro', '$cidade', '$uf', '$cep', '$fone', '$fax', '$celular', '$skype', '$end_cobranca', '$end_entrega', '$vendedor', '$obs'
	)") or die (mysqli_error());

	header ('Location: ../area-restrita.php?msgSucesso=Cadastro realizado com sucesso! Aguarde liberação por e-mail');
}

// If do reCaptcha
}
else {
	header ('Location: ../area-restrita.php?msgErro=Houve algum erro na hora de efetuar o cadastro. Tente novamente');
}

}

/* **********************************************************************
CADASTRAR CLIENTE NOVO
********************************************************************** */
if ($_GET['opt'] == "novo") {

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
$razao 			= strip_tags(trim($_POST['razao']));
$nome 			= strip_tags(trim($_POST['nome']));
$ramo			= strip_tags(trim($_POST['ramo']));
$cnpj			= strip_tags(trim($_POST['cnpj']));
$inscricao		= strip_tags(trim($_POST['inscricao']));
$endereco		= strip_tags(trim($_POST['endereco']));
$numero			= strip_tags(trim($_POST['numero']));
$bairro 		= strip_tags(trim($_POST['bairro']));
$cidade			= strip_tags(trim($_POST['cidade']));
$uf				= strip_tags(trim($_POST['uf']));
$cep			= strip_tags(trim($_POST['cep']));
$fone			= strip_tags(trim($_POST['fone']));
$fax 			= strip_tags(trim($_POST['fax']));
$celular		= strip_tags(trim($_POST['celular']));
$email			= strip_tags(trim($_POST['email']));
$skype			= strip_tags(trim($_POST['skype']));
$end_cobranca	= strip_tags(trim($_POST['end_cobranca']));
$end_entrega	= strip_tags(trim($_POST['end_entrega']));
$obs 			= strip_tags(trim($_POST['obs']));

$socio1 		= strip_tags(trim($_POST['socio1']));
$cotas1 		= strip_tags(trim($_POST['cotas1']));
$rg1			= strip_tags(trim($_POST['rg1']));
$cpf1			= strip_tags(trim($_POST['cpf1']));
$nasc1			= strip_tags(trim($_POST['nasc1']));
$socio2 		= strip_tags(trim($_POST['socio2']));
$cotas2 		= strip_tags(trim($_POST['cotas2']));
$rg2			= strip_tags(trim($_POST['rg2']));
$cpf2			= strip_tags(trim($_POST['cpf2']));
$nasc2			= strip_tags(trim($_POST['nasc2']));

$empresa1 		= strip_tags(trim($_POST['empresa1']));
$fone1 			= strip_tags(trim($_POST['fone1']));
$compra1		= strip_tags(trim($_POST['compra1']));
$valor1			= strip_tags(trim($_POST['valor1']));
$email1			= strip_tags(trim($_POST['email1']));
$empresa2 		= strip_tags(trim($_POST['empresa2']));
$fone2 			= strip_tags(trim($_POST['fone2']));
$compra2		= strip_tags(trim($_POST['compra2']));
$valor2			= strip_tags(trim($_POST['valor2']));
$email2			= strip_tags(trim($_POST['email2']));
$empresa3 		= strip_tags(trim($_POST['empresa3']));
$fone3 			= strip_tags(trim($_POST['fone3']));
$compra3		= strip_tags(trim($_POST['compra3']));
$valor3			= strip_tags(trim($_POST['valor3']));
$email3			= strip_tags(trim($_POST['email3']));

$banco1 		= strip_tags(trim($_POST['banco1']));
$conta1 		= strip_tags(trim($_POST['conta1']));
$contato1		= strip_tags(trim($_POST['contato1']));
$foneb1			= strip_tags(trim($_POST['foneb1']));

$bem1 			= strip_tags(trim($_POST['bem1']));
$valorb1 		= strip_tags(trim($_POST['valorb1']));
$ano1			= strip_tags(trim($_POST['ano1']));
$bem2 			= strip_tags(trim($_POST['bem2']));
$valorb2 		= strip_tags(trim($_POST['valorb2']));
$ano2			= strip_tags(trim($_POST['ano2']));
$bem3 			= strip_tags(trim($_POST['bem3']));
$valorb3 		= strip_tags(trim($_POST['valorb3']));
$ano3			= strip_tags(trim($_POST['ano3']));
$bem4 			= strip_tags(trim($_POST['bem4']));
$valorb4 		= strip_tags(trim($_POST['valorb4']));
$ano4			= strip_tags(trim($_POST['ano4']));

$conCNPJ = mysqli_query ($conexao, "SELECT cnpj FROM clientes WHERE cnpj='$cnpj'") or die (mysqli_error());
$contaCNPJ = mysqli_num_rows ($conCNPJ);

// Verifica se o CNPJ já está cadastrado
if ($contaCNPJ >= 1) {
	header ('Location: ../cadastro_novo.php?msgErro=CNPJ já cadastrado');
}
else {
// Converter texto para maiusculas
$razao 			= strtr(strtoupper($razao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$nome 			= strtr(strtoupper($nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$ramo 			= strtr(strtoupper($ramo),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$endereco 		= strtr(strtoupper($endereco),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$bairro 		= strtr(strtoupper($bairro),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$cidade 		= strtr(strtoupper($cidade),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$end_cobranca 	= strtr(strtoupper($end_cobranca),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$end_entrega 	= strtr(strtoupper($end_entrega),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$obs 			= strtr(strtoupper($obs),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

$socio1 		= strtr(strtoupper($socio1),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$socio2 		= strtr(strtoupper($socio2),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

$empresa1 		= strtr(strtoupper($empresa1),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$empresa2 		= strtr(strtoupper($empresa2),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$empresa3 		= strtr(strtoupper($empresa3),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

$banco1 		= strtr(strtoupper($banco1),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$contato1 		= strtr(strtoupper($contato1),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

$bem1 			= strtr(strtoupper($bem1),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$bem2 			= strtr(strtoupper($bem2),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$bem3 			= strtr(strtoupper($bem3),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$bem4 			= strtr(strtoupper($bem4),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

// Converter texto para MINÚSCULO
$email 	= strtolower($email);
$email1 = strtolower($email1);
$email2 = strtolower($email2);
$email3 = strtolower($email3);

// Remove os caracteres R$ e % dos campos
$caracteres_porc = array ("%", " %");
$cotas1 = str_replace($caracteres_porc, "", $cotas1);
$cotas2 = str_replace($caracteres_porc, "", $cotas2);

$caracteres_din = array ("R$", "R$ ");
$valor1 = str_replace($caracteres_din, "", $valor1);
$valor2 = str_replace($caracteres_din, "", $valor2);
$valor3 = str_replace($caracteres_din, "", $valor3);
$valorb1 = str_replace($caracteres_din, "", $valorb1);
$valorb2 = str_replace($caracteres_din, "", $valorb2);
$valorb3 = str_replace($caracteres_din, "", $valorb3);
$valorb4 = str_replace($caracteres_din, "", $valorb4);

// Remove os espaços em branco dos campos
$cotas1 = rtrim($cotas1);
$cotas2 = rtrim($cotas2);

$valor1 = trim($valor1);
$valor2 = trim($valor2);
$valor3 = trim($valor3);
$valorb1 = trim($valorb1);
$valorb2 = trim($valorb2);
$valorb3 = trim($valorb3);
$valorb4 = trim($valorb4);

$tipo = 2; // Cliente Novo

// Cadastra na tabela CLIENTES
$cadastrando1 = mysqli_query ($conexao, "INSERT INTO clientes (
	cnpj, razao, email, criado, tipo,
	nome, ramo, inscricao, endereco, numero, bairro, cidade, uf, cep, fone, fax, celular, skype, end_cobranca, end_entrega, obs,
	socio1, cotas1, rg1, cpf1, nasc1, socio2, cotas2, rg2, cpf2, nasc2,
	empresa1, fone1, compra1, valor1, email1, empresa2, fone2, compra2, valor2, email2, empresa3, fone3, compra3, valor3, email3,
	banco1, conta1, contato1, foneb1,
	bem1, valorb1, ano1, bem2, valorb2, ano2, bem3, valorb3, ano3, bem4, valorb4, ano4
	) VALUES (
	'$cnpj', '$razao', '$email', '$data', '$tipo',
	'$nome', '$ramo', '$inscricao', '$endereco', '$numero', '$bairro', '$cidade', '$uf', '$cep', '$fone', '$fax', '$celular', '$skype', '$end_cobranca', '$end_entrega', '$obs',
	'$socio1', '$cotas1', '$rg1', '$cpf1', '$nasc1', '$socio2', '$cotas2', '$rg2', '$cpf2', '$nasc2',
	'$empresa1', '$fone1', '$compra1', '$valor1', '$email1', '$empresa2', '$fone2', '$compra2', '$valor2', '$email2', '$empresa3', '$fone3', '$compra3', '$valor3', '$email3',
	'$banco1', '$conta1', '$contato1', '$foneb1',
	'$bem1', '$valorb1', '$ano1', '$bem2', '$valorb2', '$ano2', '$bem3', '$valorb3', '$ano3', '$bem4', '$valorb4', '$ano4'
	)") or die (mysqli_error());

	header ('Location: ../cadastro_novo.php?msgSucesso=Cadastro realizado com sucesso!');

}

// If do reCaptcha
}
else {
	header ('Location: ../cadastro_novo.php?msgErro=Houve algum erro na hora de efetuar o cadastro. Tente novamente');
}
	
}
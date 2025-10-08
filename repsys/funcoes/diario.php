<?php
include ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

include_once ("../includes/funcoes.php");

/* Config */
$pasta = "../upload/diario/";

// Largura máximo das fotos
$config_largura = 800;

// Formatos permitidos
$permitido = array ("image/gif", "image/png", "image/jpg");

/* Envio de e-mail */
$teste_sistema = false;

/* ******************************************************************************************************************
NOVO CLIENTE
****************************************************************************************************************** */
if ($_GET['funcao'] == "novo_cliente") {

// Dados do formulário
$cliente 	= strip_tags(trim($_POST['cliente']));
$rota 		= strip_tags(trim($_POST['rota']));
$cidade 	= strip_tags(trim($_POST['cidade']));
$uf 		= strip_tags(trim($_POST['uf']));
$segmento	= strip_tags(trim($_POST['segmento']));
$novo 		= strip_tags(trim($_POST['novo']));

$cliente 	= strtr(strtoupper($cliente),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$cidade 	= strtr(strtoupper($cidade),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$uf 		= strtr(strtoupper($uf),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

/* ***** */

$con_cliente = mysqli_query ($conexao, "SELECT cliente FROM geral_clientes
							 WHERE
							 cliente='$cliente' AND rota='$rota' AND cidade='$cidade' AND uf='$uf' AND responsavel='$id_usuario'
							 ") or die (mysqli_error());

$conta_cliente = mysqli_num_rows ($con_cliente);

if ($conta_cliente > 0) {

header ('Location: ../diario-novo.php?msgErro=Cliente já cadastrado');

}
else{

$cadastrando = mysqli_query ($conexao, "INSERT INTO geral_clientes 
							(cliente, rota, cidade, uf, responsavel, segmento, novo)
							VALUES
							('$cliente', '$rota', '$cidade', '$uf', '$id_usuario', '$segmento', '$novo')
							") or die (mysqli_error());

header ('Location: ../diario-novo.php?msgSucesso=Cliente cadastrado com sucesso.');

}

}

/* ******************************************************************************************************************
EDITAR CLIENTE
****************************************************************************************************************** */
if ($_GET['funcao'] == "editar_cliente") {

$id = $_GET['id'];

// Dados do formulário
$cliente 	= strip_tags(trim($_POST['cliente']));
$rota 		= strip_tags(trim($_POST['rota']));
$cidade 	= strip_tags(trim($_POST['cidade']));
$uf 		= strip_tags(trim($_POST['uf']));
$segmento	= strip_tags(trim($_POST['segmento']));
$novo 		= strip_tags(trim($_POST['novo']));

$cliente 	= strtr(strtoupper($cliente),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$cidade 	= strtr(strtoupper($cidade),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
$uf 		= strtr(strtoupper($uf),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

// Hidden
$rota_atual	= strip_tags(trim($_POST['rota_atual'])); 

$editando = mysqli_query ($conexao, "UPDATE geral_clientes 
						  SET
						  cliente='$cliente', rota='$rota', cidade='$cidade', uf='$uf', segmento='$segmento', novo='$novo'
						  WHERE id='$id'") or die (mysqli_error());

if ($rota != $rota_atual) {

// Atualiza as ROTAS na tabela de CONTATOS
$con_cliente_diario = mysqli_query ($conexao, "SELECT id FROM diario_contato WHERE cliente='$id'") or die (mysqli_error());
if (mysqli_num_rows($con_cliente_diario) > 0) {
	while ($d_cd = mysqli_fetch_array ($con_cliente_diario)) {
		$diario_id = $d_cd['id'];
		
		$atu_diario1 = mysqli_query ($conexao, "UPDATE diario_contato SET rota='$rota' WHERE id='$diario_id'") or die (mysqli_error());
		
		// Verifica quem é o RESPONSÁVEL pela rota nova
		if ($segmento == "ENG") {
			/* Engenharia */
			$vend1_id 		= rota_vendedor($rota, "ENG", $conexao);
			$vend1_nome 	= rota_nome($rota, "ENG", $conexao);
			$vend1_email 	= rota_email($rota, "ENG", $conexao);
		}
		elseif ($segmento == "MOV") {
			/* Moveleiro */
			$vend1_id 		= rota_vendedor($rota, "MOV", $conexao);
			$vend1_nome 	= rota_nome($rota, "MOV", $conexao);
			$vend1_email 	= rota_email($rota, "MOV", $conexao);
		}
		elseif ($segmento == "CHA") {
			/* Engenharia */
			$vend1_id 		= rota_vendedor($rota, "ENG", $conexao);
			$vend1_nome 	= rota_nome($rota, "ENG", $conexao);
			$vend1_email 	= rota_email($rota, "ENG", $conexao);
			
			/* Moveleiro */
			$vend2_id 		= rota_vendedor($rota, "MOV", $conexao);
			$vend2_nome 	= rota_nome($rota, "MOV", $conexao);
			$vend2_email 	= rota_email($rota, "MOV", $conexao);
			
			/* Chaparia */
			$vend3_id 		= rota_vendedor($rota, "CHA", $conexao);
			$vend3_nome 	= rota_nome($rota, "CHA", $conexao);
			$vend3_email 	= rota_email($rota, "CHA", $conexao);
		}
		elseif ($segmento == "FER") {
			/* Engenharia */
			$vend1_id 		= rota_vendedor($rota, "ENG", $conexao);
			$vend1_nome 	= rota_nome($rota, "ENG", $conexao);
			$vend1_email 	= rota_email($rota, "ENG", $conexao);
			
			/* Moveleiro */
			$vend2_id 		= rota_vendedor($rota, "MOV", $conexao);
			$vend2_nome 	= rota_nome($rota, "MOV", $conexao);
			$vend2_email 	= rota_email($rota, "MOV", $conexao);
			
			/* Ferragens */
			$vend3_id 		= rota_vendedor($rota, "FER", $conexao);
			$vend3_nome 	= rota_nome($rota, "FER", $conexao);
			$vend3_email 	= rota_email($rota, "FER", $conexao);
		}
		
		$atu_diario2 = mysqli_query ($conexao, "UPDATE diario_contato SET vendedor1='$vend1_id', vendedor2='$vend2_id', vendedor3='$vend3_id' WHERE id='$diario_id'") or die (mysqli_error());
	}
}

}

header ('Location: ../diario-novo.php?msgSucesso=Cliente atualizado com sucesso.');

}

/* ******************************************************************************************************************
SITUAÇÃO CLIENTE
****************************************************************************************************************** */
if ($_GET['funcao'] == "situacao_cliente") {

$id = $_GET['id'];

// Dados do formulário
$situacao 	= strip_tags(trim($_POST['situacao']));

$editando = mysqli_query ($conexao, "UPDATE geral_clientes 
						  SET
						  ativo='$situacao'
						  WHERE id='$id'") or die (mysqli_error());

header ('Location: ../diario-novo.php?msgSucesso=Cliente atualizado com sucesso.');

}

/* **************************************************************************************************************************************************************************** */
/* **************************************************************************************************************************************************************************** */
/* **************************************************************************************************************************************************************************** */
/* **************************************************************************************************************************************************************************** */
/* **************************************************************************************************************************************************************************** */


/* ******************************************************************************************************************
CADASTRAR CONTATO
****************************************************************************************************************** */
if ($_GET['funcao'] == "cadastrar") {

// Dados do formulário
$data_visita	= strip_tags(trim($_POST['data_visita']));
$cliente 		= strip_tags(trim($_POST['cliente']));
$descricao 		= strip_tags(trim($_POST['descricao']));
$tipo 			= strip_tags(trim($_POST['tipo']));

$descricao 		= strtr(strtoupper($descricao),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

if ($cliente == "" || $descricao == "" || $tipo == "") {
	header ('Location: ../diario-novo.php?msgErro=Você precisa colocar os dados do contato.');
}
else {

// Consulta se há cadastro com esses dados
$consulta_feed = mysqli_query ($conexao, "SELECT * FROM diario_contato WHERE data_visita='$data_visita' AND cliente='$cliente' AND descricao='$descricao'") or die (mysqli_error());
$conta_feed = mysqli_num_rows ($consulta_feed);

if ($conta_feed >= 1) {
	header ('Location: ../diario-novo.php?msgErro=Feedback duplicado. Você está tentando registrar um contato que já está cadastrado.');
}
else {

/* ***** */

/*
if (is_file($_FILES['anexo']['tmp_name'])) {
		
	$anexo_upload = $_FILES['anexo']['name']; // Nome do arquivo original
	
	$extensao = @end(explode(".",$anexo_upload));
	
	// TRATAMENTO DO NOME DA FOTO
	$anexo_upload = $pedido."_".date("dmYHis").".".strtolower($extensao);
	
	$envia_anexo = move_uploaded_file($_FILES['anexo']['tmp_name'], $pasta.$anexo_upload);

} */


if (is_file($_FILES['foto1']['tmp_name'])) {
	$foto1_temp = $_FILES['foto1']['tmp_name']; // Nome do arquivo temporário
	$foto1 = $_FILES['foto1']['name']; // Nome do arquivo original
	
	$extensao1 = @end(explode(".",$foto1));
	
	// TRATAMENTO DO NOME DA FOTO
	$foto1 = date("YmdHis")."_1.".$extensao1;
	
	upload($foto1_temp, $foto1, $config_largura, $pasta, $foto1);
}

if (is_file($_FILES['foto2']['tmp_name'])) {
	$foto2_temp = $_FILES['foto2']['tmp_name']; // Nome do arquivo temporário
	$foto2 = $_FILES['foto2']['name']; // Nome do arquivo original
	
	$extensao2 = @end(explode(".",$foto2));
	
	// TRATAMENTO DO NOME DA FOTO
	$foto2 = date("YmdHis")."_2.".$extensao2;
	
	upload($foto2_temp, $foto2, $config_largura, $pasta, $foto2);
}

if (is_file($_FILES['foto3']['tmp_name'])) {
	$foto3_temp = $_FILES['foto3']['tmp_name']; // Nome do arquivo temporário
	$foto3 = $_FILES['foto3']['name']; // Nome do arquivo original
	
	$extensao3 = @end(explode(".",$foto3));
	
	// TRATAMENTO DO NOME DA FOTO
	$foto3 = date("YmdHis")."_3.".$extensao3;
	
	upload($foto3_temp, $foto3, $config_largura, $pasta, $foto3);
}

/* ***** */

$codigo = md5(date("YmdHis").$cliente);

/* ***** */

// Formatar Nome do Usuário
$nome_usuario_maiusc = strtr(strtoupper($nome_usuario),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

// Pega os dados do cliente
$con_cliente = mysqli_query ($conexao, "SELECT * FROM geral_clientes WHERE id='$cliente'") or die (mysqli_error());
	$c_clientes = mysqli_fetch_array ($con_cliente);
		$c_nome 	= $c_clientes['cliente'];
		$c_rota 	= $c_clientes['rota'];
		$c_cidade 	= $c_clientes['cidade'];
		$c_uf 		= $c_clientes['uf'];
		$c_seg 		= $c_clientes['segmento'];

// Verifica qual vendedor principal é responsável por essa rota
if ($c_seg == "ENG") {
	/* Engenharia */
	$vend1_id 		= rota_vendedor($c_rota, "ENG", $conexao);
	$vend1_nome 	= rota_nome($c_rota, "ENG", $conexao);
	$vend1_email 	= rota_email($c_rota, "ENG", $conexao);
}
elseif ($c_seg == "MOV") {
	/* Moveleiro */
	$vend1_id 		= rota_vendedor($c_rota, "MOV", $conexao);
	$vend1_nome 	= rota_nome($c_rota, "MOV", $conexao);
	$vend1_email 	= rota_email($c_rota, "MOV", $conexao);
}
elseif ($c_seg == "CHA") {
	/* Engenharia */
	$vend1_id 		= rota_vendedor($c_rota, "ENG", $conexao);
	$vend1_nome 	= rota_nome($c_rota, "ENG", $conexao);
	$vend1_email 	= rota_email($c_rota, "ENG", $conexao);
	
	/* Moveleiro */
	$vend2_id 		= rota_vendedor($c_rota, "MOV", $conexao);
	$vend2_nome 	= rota_nome($c_rota, "MOV", $conexao);
	$vend2_email 	= rota_email($c_rota, "MOV", $conexao);
	
	/* Chaparia */
	$vend3_id 		= rota_vendedor($c_rota, "CHA", $conexao);
	$vend3_nome 	= rota_nome($c_rota, "CHA", $conexao);
	$vend3_email 	= rota_email($c_rota, "CHA", $conexao);
}
elseif ($c_seg == "FER") {
	/* Engenharia */
	$vend1_id 		= rota_vendedor($c_rota, "ENG", $conexao);
	$vend1_nome 	= rota_nome($c_rota, "ENG", $conexao);
	$vend1_email 	= rota_email($c_rota, "ENG", $conexao);
	
	/* Moveleiro */
	$vend2_id 		= rota_vendedor($c_rota, "MOV", $conexao);
	$vend2_nome 	= rota_nome($c_rota, "MOV", $conexao);
	$vend2_email 	= rota_email($c_rota, "MOV", $conexao);
	
	/* Ferragens */
	$vend3_id 		= rota_vendedor($c_rota, "FER", $conexao);
	$vend3_nome 	= rota_nome($c_rota, "FER", $conexao);
	$vend3_email 	= rota_email($c_rota, "FER", $conexao);
}

/* ***** */

$cadastrando = mysqli_query ($conexao, "INSERT INTO diario_contato 
							(codigo, data_visita, usuario, vendedor1, vendedor2, vendedor3, cliente, rota, descricao, tipo, foto1, foto2, foto3)
							VALUES
							('$codigo', '$data_visita', '$id_usuario', '$vend1_id', '$vend2_id', '$vend3_id', '$cliente', '$c_rota', '$descricao', '$tipo', 
							'$foto1', '$foto2', '$foto3')
							") or die (mysqli_error());

/* **********************************************
ENVIANDO O E-MAIL
********************************************** */
// Verifica se está sendo testado o sistema
if ($teste_sistema == false) {
// Inclui o arquivo PHPMailerAutoload.php localizado na pasta phpmailer
require_once ("../../phpmailer/PHPMailerAutoload.php");

// Inicia a classe PHPMailer
$mail = new PHPMailer();

include_once ("../../funcoes/conexao_email.php");

// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->AddAddress('adriano.lindevidros@gmail.com', 'Adriano');
if ($vend1_email != "") {
	$mail->AddAddress($vend1_email, $vend1_nome); // E-mail do vendedor responsável
}
if ($vend2_email != "") {
	$mail->AddAddress($vend2_email, $vend2_nome); // E-mail do vendedor responsável
}
if ($vend3_email != "") {
	$mail->AddAddress($vend3_email, $vend3_nome); // E-mail do vendedor responsável
}

if ($tipo_usuario == "V" && $seg_usuario == "MOV") {
$mail->AddAddress('flavio@lindevidros.com.br', 'Flavio');
}
if ($tipo_usuario == "V" && $seg_usuario == "ENG" || $tipo_usuario == "R" && $seg_usuario == "ENG") {
$mail->AddAddress('william@lindevidros.com.br', 'William');
}

// Se o cliente for de chaparia
if ($c_seg == "CHA") {
	$con_ven_cha = mysqli_query ($conexao, "SELECT nome, email FROM representantes WHERE tipo='V' AND segmento='CHA' AND p_diario='S' AND ativo='S'") or die (mysqli_error());
	
	while ($d_ven_cha = mysqli_fetch_array ($con_ven_cha)) {
		$cha_nome 	= $d_ven_cha['nome'];
		$cha_email 	= $d_ven_cha['email'];
		
		$mail->AddAddress($cha_email, $cha_nome); // E-mail do vendedor responsável
				
	}
}

// Se o cliente for de ferragens
if ($c_seg == "FER") {
	$con_ven_fer = mysqli_query ($conexao, "SELECT nome, email FROM representantes WHERE tipo='V' AND segmento='FER' AND p_diario='S' AND ativo='S'") or die (mysqli_error());
	
	while ($d_ven_fer = mysqli_fetch_array ($con_ven_fer)) {
		$fer_nome 	= $d_ven_fer['nome'];
		$fer_email 	= $d_ven_fer['email'];
		
		$mail->AddAddress($fer_email, $fer_nome); // E-mail do vendedor responsável
				
	}	
}

//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
$mail->AddBCC('bruno.berlanda@lindevidros.com.br', 'Bruno'); // Cópia Oculta

// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->Subject  = "[DIÁRIO] Novo Registro"; // Assunto da mensagem

$mail->Body = "
<html>
<head>
</head>
<body>

<table border='0' width='600' cellpadding='0' cellspacing='1'>
    <tr>
        <td colspan='3' style='padding: 8px 0' align='center'><img src='http://www.lindevidros.com.br/email/logo.png'></td>
    </tr>
    <tr>
        <td colspan='3' style='padding: 8px 0'>
            <img src='http://www.lindevidros.com.br/email/diario/diario1_img_01.png'>
        </td>
    </tr>
    <tr>
        <td colspan='3'>
            <img src='http://www.lindevidros.com.br/email/diario/diario1_img_02.png'>
        </td>
    </tr>
    <tr>
    	<td width='33%'><p><img src='http://www.lindevidros.com.br/email/diario/diario1_img_03.png'></p></td>
        <td width='33%'><p><img src='http://www.lindevidros.com.br/email/diario/diario1_img_04.png'></p></td>
        <td width='33%'><p><img src='http://www.lindevidros.com.br/email/diario/diario1_img_05.png'></p></td>
    </tr>
    <tr>
    	<td width='33%' style='padding: 12px 0;' align='center'><p><font face='Verdana' size='1' color='#333333'>$nome_usuario_maiusc</font></p></td>
        <td width='33%' style='padding: 12px 0;' align='center'><p><font face='Verdana' size='1' color='#333333'>$c_nome</font></p></td>
        <td width='33%' style='padding: 12px 0;' align='center'><p><font face='Verdana' size='1' color='#333333'>$c_rota - $c_cidade / $c_uf</font></p></td>
    </tr>
    <tr>
        <td colspan='3'>
            <img src='http://www.lindevidros.com.br/email/diario/diario1_img_06.png'>
        </td>
    </tr>
    <tr>
        <td colspan='3' style='padding: 15px 8px'>
            <p align='justify'><font face='Verdana' size='1' color='#333333'>$descricao</font></p>
        </td>
    </tr>
    <tr>
        <td colspan='3' align='center'>
            <a href='www.lindevidros.com.br/repsys/'><img src='http://www.lindevidros.com.br/email/diario/diario1_img_07.png'></a>
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

} // Teste Sistema
/* ******************************************************************************** */

header ('Location: ../diario-novo.php?msgSucesso=Contato enviado com sucesso');

}

}

}

/* ******************************************************************************************************************
FEEDBACK
****************************************************************************************************************** */
if ($_GET['funcao'] == "retorno") {

$id 	= $_GET['id'];
$codigo = $_GET['c'];

// Dados do Filtro
$di = $_GET['di'];
$df = $_GET['df'];
$re = $_GET['re'];
$cl = $_GET['cl'];
$st = $_GET['st'];

$feedback = strip_tags(trim($_POST['feedback']));
$feedback = strtr(strtoupper($feedback),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

if (isset($_POST['alerta'])) { $alerta = "S"; } else { $alerta = "N"; }
if (isset($_POST['venda'])) { $venda = "S"; } else { $venda = "N"; }

$data_atu = date("Y-m-d H:i:s");

$cadastrando = mysqli_query ($conexao, "INSERT INTO diario_respostas 
						   (id_contato, data, usuario, feedback)
						   VALUES
						   ('$id', '$data_atu', '$id_usuario', '$feedback')
						    ") or die (mysqli_error());

// Fechou Venda (?)
if ($venda == "S") {
	$c_cliente = mysqli_query ($conexao, "SELECT cliente FROM diario_contato WHERE id='$id'") or die (mysqli_error());
		$d_cliente = mysqli_fetch_array ($c_cliente);
			$id_cliente = $d_cliente['cliente'];
	
	$atu_cliente = mysqli_query ($conexao, "UPDATE geral_clientes 
							 	SET
							 	fechou_venda='$venda'
							 	WHERE id='$id_cliente'") or die (mysqli_error());
}

/*
if ($p_diario_gerente == "S" || $tipo_usuario == "R") {
	
	$atualizar = mysqli_query ($conexao, "UPDATE diario_contato 
							   SET
							   alerta='$alerta', fechou_venda='$venda', status='G'
							   WHERE id='$id'") or die (mysqli_error());

}
else {

	$atualizar = mysqli_query ($conexao, "UPDATE diario_contato 
							   SET
							   alerta='$alerta', fechou_venda='$venda', status='R'
							   WHERE id='$id'") or die (mysqli_error());

}
*/
$atualizar = mysqli_query ($conexao, "UPDATE diario_contato 
						   SET
						   alerta='$alerta', fechou_venda='$venda', status='R'
						   WHERE id='$id'") or die (mysqli_error());

/* ****************** */

$consulta_reg = mysqli_query ($conexao, "SELECT usuario, vendedor1, vendedor2, vendedor3, cliente, descricao FROM diario_contato WHERE id='$id'") or die (mysqli_error());
	$d_reg = mysqli_fetch_array ($consulta_reg);
		$reg_usuario	= $d_reg['usuario'];
		$reg_vendedor1	= $d_reg['vendedor1'];
		$reg_vendedor2	= $d_reg['vendedor2'];
		$reg_vendedor3	= $d_reg['vendedor3'];
		$reg_cliente 	= $d_reg['cliente'];
		$reg_descricao 	= $d_reg['descricao'];

/* Usuário que abriu o contato */
$consulta_use = mysqli_query ($conexao, "SELECT nome, email FROM representantes WHERE id='$reg_usuario'") or die (mysqli_error());
	$d_use = mysqli_fetch_array ($consulta_use);
		$use_nome		= $d_use['nome'];
		$use_email		= $d_use['email'];

/* Vendedor 1 */
$consulta_ven1 = mysqli_query ($conexao, "SELECT nome, email FROM representantes WHERE id='$reg_vendedor1'") or die (mysqli_error());
	$d_ven1 = mysqli_fetch_array ($consulta_ven1);
		$ven1_nome		= $d_ven1['nome'];
		$ven1_email		= $d_ven1['email'];

/* Vendedor 2 */
$consulta_ven2 = mysqli_query ($conexao, "SELECT nome, email FROM representantes WHERE id='$reg_vendedor2'") or die (mysqli_error());
	$d_ven2 = mysqli_fetch_array ($consulta_ven2);
		$ven2_nome		= $d_ven2['nome'];
		$ven2_email		= $d_ven2['email'];
        
/* Vendedor 3 */
$consulta_ven3 = mysqli_query ($conexao, "SELECT nome, email FROM representantes WHERE id='$reg_vendedor3'") or die (mysqli_error());
	$d_ven3 = mysqli_fetch_array ($consulta_ven3);
		$ven3_nome		= $d_ven3['nome'];
		$ven3_email		= $d_ven3['email'];

/* Cliente */
$consulta_cli = mysqli_query ($conexao, "SELECT * FROM geral_clientes WHERE id='$reg_cliente'") or die (mysqli_error());
	$d_cli = mysqli_fetch_array ($consulta_cli);
		$cli_cliente 	= $d_cli['cliente'];
		$cli_rota 		= $d_cli['rota'];
		$cli_cidade 	= $d_cli['cidade'];
		$cli_uf 		= $d_cli['uf'];

/* ****************** */

$nome_usuario_maiusc = strtr(strtoupper($use_nome),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

/* **********************************************
ENVIANDO O E-MAIL
********************************************** */
// Verifica se está sendo testado o sistema
if ($teste_sistema == false) {

// Inclui o arquivo PHPMailerAutoload.php localizado na pasta phpmailer
require_once ("../../phpmailer/PHPMailerAutoload.php");

// Inicia a classe PHPMailer
$mail = new PHPMailer();

include_once ("../../funcoes/conexao_email.php");

// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
// O REPRESENTANTE respondeu
if ($id_usuario == $reg_usuario) {
	$mail->AddAddress($ven1_email, $ven1_nome);
	$mail->AddAddress($ven2_email, $ven2_nome);
	$mail->AddAddress($ven3_email, $ven3_nome);
}
// O VENDEDOR respondeu
elseif ($id_usuario == $reg_vendedor1 || $id_usuario == $reg_vendedor2 || $id_usuario == $reg_vendedor3) {
	$mail->AddAddress($use_email, $use_nome);
}
// O GERENTE respondeu
else {
	$mail->AddAddress($ven1_email, $ven1_nome);
	$mail->AddAddress($ven2_email, $ven2_nome);
	$mail->AddAddress($ven3_email, $ven3_nome);
	$mail->AddAddress($use_email, $use_nome);
}
$mail->AddCC('adriano.lindevidros@gmail.com', 'Adriano');
$mail->AddCC('william@lindevidros.com.br', 'William');
//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia

$mail->AddBCC('bruno.berlanda@lindevidros.com.br', 'Bruno'); // Cópia Oculta

// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->Subject  = "[DIÁRIO] Feedback do Contato"; // Assunto da mensagem

$mail->Body = "
<html>
<head>
</head>
<body>

<table border='0' width='600' cellpadding='0' cellspacing='1'>
    <tr>
        <td colspan='3' style='padding: 8px 0' align='center'><img src='http://www.lindevidros.com.br/email/logo.png'></td>
    </tr>
    <tr>
        <td colspan='3' style='padding: 8px 0'>
            <img src='http://www.lindevidros.com.br/email/diario/diario2_img_01.png'>
        </td>
    </tr>
    <tr>
        <td colspan='3'>
            <img src='http://www.lindevidros.com.br/email/diario/diario2_img_02.png'>
        </td>
    </tr>
    <tr>
    	<td width='33%'><p><img src='http://www.lindevidros.com.br/email/diario/diario1_img_03.png'></p></td>
        <td width='33%'><p><img src='http://www.lindevidros.com.br/email/diario/diario1_img_04.png'></p></td>
        <td width='33%'><p><img src='http://www.lindevidros.com.br/email/diario/diario1_img_05.png'></p></td>
    </tr>
    <tr>
    	<td width='33%' style='padding: 12px 0;' align='center'><p><font face='Verdana' size='1' color='#333333'>$nome_usuario_maiusc</font></p></td>
        <td width='33%' style='padding: 12px 0;' align='center'><p><font face='Verdana' size='1' color='#333333'>$cli_cliente</font></p></td>
        <td width='33%' style='padding: 12px 0;' align='center'><p><font face='Verdana' size='1' color='#333333'>$cli_rota - $cli_cidade / $cli_uf</font></p></td>
    </tr>
    <tr>
        <td colspan='3'>
            <img src='http://www.lindevidros.com.br/email/diario/diario1_img_06.png'>
        </td>
    </tr>
    <tr>
        <td colspan='3' style='padding: 15px 8px'>
            <p align='justify'><font face='Verdana' size='1' color='#333333'>$reg_descricao</font></p>
        </td>
    </tr>
	<tr>
        <td colspan='3'>
            <img src='http://www.lindevidros.com.br/email/diario/diario2_img_03.png'>
        </td>
    </tr>
    <tr>
        <td colspan='3' style='padding: 15px 8px'>
            <p align='justify'><font face='Verdana' size='1' color='#333333'>$feedback</font></p>
        </td>
    </tr>
    <tr>
        <td colspan='3' align='center'>
            <a href='www.lindevidros.com.br/repsys/'><img src='http://www.lindevidros.com.br/email/diario/diario1_img_07.png'></a>
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

} // Teste Sistema
/* ******************************************************************************** */

header ('Location: ../diario-gerenciar.php?data_inicial='.$di.'&data_final='.$df.'&representante='.$re.'&cliente='.$cl.'&status='.$st.'&msgSucesso=Feedback enviado com sucesso');

}

/* ******************************************************************************************************************
EXCLUIR FEEDBACK
****************************************************************************************************************** */
if ($_GET['funcao'] == "excluir") {

$id 	= $_GET['id'];
$codigo = $_GET['c'];

// Dados do Filtro
$di = $_GET['di'];
$df = $_GET['df'];
$re = $_GET['re'];
$cl = $_GET['cl'];

$consulta_fotos = mysqli_query ($conexao, "SELECT foto1, foto2, foto3 FROM diario_contato WHERE id='$id'") or die (mysqli_error());
	$d_fotos = mysqli_fetch_array ($consulta_fotos);
		$foto1	= $d_fotos['foto1'];
		$foto2	= $d_fotos['foto2'];
		$foto3 	= $d_fotos['foto3'];
		
	if ($foto1 != "") {	
		unlink($pasta.$foto1);
	}
	if ($foto2 != "") {	
		unlink($pasta.$foto2);
	}
	if ($foto3 != "") {	
		unlink($pasta.$foto3);
	}

$excluir1 = mysqli_query ($conexao, "DELETE FROM diario_respostas WHERE id_contato='$id'") or die (mysqli_error());
$excluir2 = mysqli_query ($conexao, "DELETE FROM diario_contato WHERE id='$id'") or die (mysqli_error());

header ('Location: ../diario-gerenciar.php?data_inicial='.$di.'&data_final='.$df.'&representante='.$re.'&cliente='.$cl.'&status='.$st.'&msgSucesso=Contato excluído com sucesso');

}
<?php

$consulta = mysqli_query ($conexao, "SELECT * FROM clientes WHERE cnpj='$login_usuario'") or die (mysqli_error());
	$infos = mysqli_fetch_array ($consulta);
		$idUsuario 				= $infos['id'];
		$cnpjUsuario 			= $infos['cnpj'];
		$razaoUsuario 			= $infos['razao'];
		$emailUsuario 			= $infos['email'];
		$criadoUsuario 			= $infos['criado'];
		$atualizadoUsuario 		= $infos['atualizado'];
		$tipoUsuario 			= $infos['tipo'];
		$nomeUsuario 			= $infos['nome'];
		$ramoUsuario 			= $infos['ramo'];
		$inscricaoUsuario 		= $infos['inscricao'];
		$enderecoUsuario 		= $infos['endereco'];
		$numeroUsuario 			= $infos['numero'];
		$bairroUsuario 			= $infos['bairro'];
		$cidadeUsuario 			= $infos['cidade'];
		$ufUsuario 				= $infos['uf'];
		$cepUsuario 			= $infos['cep'];
		$foneUsuario 			= $infos['fone'];
		$faxUsuario 			= $infos['fax'];
		$celularUsuario 		= $infos['celular'];
		$skypeUsuario 			= $infos['skype'];
		$end_cobrancaUsuario 	= $infos['end_cobranca'];
		$end_entregaUsuario 	= $infos['end_entrega'];
		$obsUsuario 			= $infos['obs'];
		$socio1Usuario 			= $infos['socio1'];
		$cotas1Usuario 			= $infos['cotas1'];
		$rg1Usuario 			= $infos['rg1'];
		$cpf1Usuario 			= $infos['cpf1'];
		$nasc1Usuario 			= $infos['nasc1'];
		$socio2Usuario 			= $infos['socio2'];
		$cotas2Usuario 			= $infos['cotas2'];
		$rg2Usuario 			= $infos['rg2'];
		$cpf2Usuario 			= $infos['cpf2'];
		$nasc2Usuario 			= $infos['nasc2'];
		$empresa1Usuario 		= $infos['empresa1'];
		$fone1Usuario 			= $infos['fone1'];
		$compra1Usuario 		= $infos['compra1'];
		$valor1Usuario 			= $infos['valor1'];
		$email1Usuario 			= $infos['email1'];
		$empresa2Usuario 		= $infos['empresa2'];
		$fone2Usuario 			= $infos['fone2'];
		$compra2Usuario 		= $infos['compra2'];
		$valor2Usuario 			= $infos['valor2'];
		$email2Usuario 			= $infos['email2'];
        $empresa3Usuario 		= $infos['empresa3'];
		$fone3Usuario 			= $infos['fone3'];
		$compra3Usuario 		= $infos['compra3'];
		$valor3Usuario 			= $infos['valor3'];
		$email3Usuario 			= $infos['email3'];
		$banco1Usuario 			= $infos['banco1'];
		$conta1Usuario 			= $infos['conta1'];
		$contato1Usuario 		= $infos['contato1'];
		$foneb1Usuario 			= $infos['fone1'];
		$bem1Usuario 			= $infos['bem1'];
		$valorb1Usuario 		= $infos['valorb1'];
		$ano1Usuario 			= $infos['ano1'];
		$bem2Usuario 			= $infos['bem2'];
		$valorb2Usuario 		= $infos['valorb2'];
		$ano2Usuario 			= $infos['ano2'];
        $bem3Usuario 			= $infos['bem3'];
		$valorb3Usuario 		= $infos['valorb3'];
		$ano3Usuario 			= $infos['ano3'];
        $bem4Usuario 			= $infos['bem4'];
		$valorb4Usuario 		= $infos['valorb4'];
		$ano4Usuario 			= $infos['ano4'];
		
		$wkUsuario 				= $infos['wk'];
		$orcInsulado			= $infos['insulado'];

// Tratamento da DATA
$criadoUsuario 		= substr($criadoUsuario,8,2) . "/" .substr($criadoUsuario,5,2) . "/" . substr($criadoUsuario,0,4);
$atualizadoUsuario 	= substr($atualizadoUsuario,8,2) . "/" .substr($atualizadoUsuario,5,2) . "/" . substr($atualizadoUsuario,0,4);

if ($end_cobrancaUsuario == '') {
	$end_cobUsuario = "O MESMO";
}

if ($end_entregaUsuario == '') {
	$end_entUsuario = "O MESMO";
}

// Tratamento na formatação da observação
$obsUsuario = str_replace("\n","<br />",$obsUsuario);
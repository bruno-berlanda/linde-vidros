<?php

$consulta_usuario = mysqli_query ($conexao, "SELECT * FROM usuarios WHERE cpf='$login_usuario' AND nome='$nome_usuario'") or die (mysqli_error());
	$dados = mysqli_fetch_array ($consulta_usuario);
	
		$idUsuario 			= $dados['id'];
		$usuarioCPF 		= $dados['cpf'];
		$usuarioNome 		= $dados['nome'];
		$usuarioEmail 		= $dados['email'];
		$usuarioCod 		= $dados['codigo'];
		$usuarioCriado 		= $dados['criado'];
		$usuarioAtualizado	= $dados['atualizado'];
		$usuarioPNE 		= $dados['pne'];
		$usuarioPNEDesc		= $dados['pne_desc'];
		$usuarioIndicacao	= $dados['indicacao'];
		$usuarioSexo 		= $dados['sexo'];
		$usuarioEstadoCivil	= $dados['estado_civil'];
		$usuarioFilhos 		= $dados['filhos'];
		$usuarioRG 			= $dados['rg'];
		$usuarioUFRG 		= $dados['uf_rg'];
		$usuarioNascDia		= $dados['nasc_dia'];
		$usuarioNascMes		= $dados['nasc_mes'];
		$usuarioNascAno		= $dados['nasc_ano'];
		$usuarioFone 		= $dados['fone'];
		$usuarioRecados		= $dados['recados'];
		$usuarioCelular		= $dados['celular'];
		$usuarioWebsite		= $dados['website'];
		$usuarioEndereco	= $dados['endereco'];
		$usuarioNumero 		= $dados['numero'];
		$usuarioComplemento	= $dados['complemento'];
		$usuarioBairro 		= $dados['bairro'];
		$usuarioCEP 		= $dados['cep'];
		$usuarioCidade 		= $dados['cidade'];
		$usuarioUF 			= $dados['uf'];
		$usuarioEmpregado	= $dados['empregado'];
		$usuarioSituacao	= $dados['situacao'];
		$usuarioCNH 		= $dados['cnh'];
		$usuarioFoto 		= $dados['foto'];
		$usuarioEsportes	= $dados['esportes'];
		$usuarioHobbies		= $dados['hobbies'];
		$usuarioLivros 		= $dados['livros'];
		$usuarioMusica 		= $dados['musica'];
		$usuarioPaixoes		= $dados['paixoes'];
		$usuarioTrabsocial	= $dados['trabsocial'];
		$usuarioArea 		= $dados['area'];
		$usuarioNivel 		= $dados['nivel'];
		$usuarioSalario		= $dados['salario'];
		$usuarioObjetivo	= $dados['objetivo'];
		$usuarioMini		= $dados['mini'];
		
		// Data Criado
		$usuarioCriado = substr($usuarioCriado,8,2) . "/" .substr($usuarioCriado,5,2) . "/" . substr($usuarioCriado,0,4);
		
		// Data Criado
		$usuarioAtualizado = substr($usuarioAtualizado,8,2) . "/" .substr($usuarioAtualizado,5,2) . "/" . substr($usuarioAtualizado,0,4);
		
		// Data de Nascimento
		$usuarioDataNasc = $usuarioNascDia."/".$usuarioNascMes."/".$usuarioNascAno;
		
		// ESCOLARIDADE
		$consulta_escolaridade = mysqli_query ($conexao, "SELECT * FROM usuarios_escolaridade WHERE id_usuario='$idUsuario' ORDER BY ini_ano, ini_mes") or die (mysqli_error());
			$conta_escolaridade = mysqli_num_rows ($consulta_escolaridade);
		
		// EXPERIÊNCIAS
		$consulta_experiencias = mysqli_query ($conexao, "SELECT * FROM usuarios_experiencias WHERE id_usuario='$idUsuario' ORDER BY ini_ano, ini_mes") or die (mysqli_error());
			$conta_experiencias = mysqli_num_rows ($consulta_experiencias);
		
		// FORMAÇÃO
		$consulta_formacao = mysqli_query ($conexao, "SELECT * FROM usuarios_formacao WHERE id_usuario='$idUsuario' ORDER BY ini_ano, ini_mes") or die (mysqli_error());
			$conta_formacao = mysqli_num_rows ($consulta_formacao);
		
		// INFORMÁTICA
		$consulta_informatica = mysqli_query ($conexao, "SELECT * FROM usuarios_informatica WHERE id_usuario='$idUsuario'") or die (mysqli_error());
			$conta_informatica = mysqli_num_rows ($consulta_informatica);
		
		// LÍNGUAS
		$consulta_linguas = mysqli_query ($conexao, "SELECT * FROM usuarios_linguas WHERE id_usuario='$idUsuario'") or die (mysqli_error());
			$conta_linguas = mysqli_num_rows ($consulta_linguas);

/* *****************************************************************************************************************************************
CÁLCULO % DE PREENCHIMENTO DO CURRÍCULO
***************************************************************************************************************************************** */
// DADOS BÁSICOS
if ($usuarioSexo != '') { $vlr01 = 1; }
if ($usuarioEstadoCivil != '') { $vlr02 = 1; }
if ($usuarioFilhos != '') { $vlr03 = 1; }
if ($usuarioRG != '') { $vlr04 = 1; }
if ($usuarioUFRG != '') { $vlr05 = 1; }
if ($usuarioNascDia != '') { $vlr06 = 1; }
if ($usuarioNascMes != '') { $vlr07 = 1; }
if ($usuarioNascAno != '') { $vlr08 = 1; }
if ($usuarioFone != '') { $vlr09 = 1; }
if ($usuarioRecados != '') { $vlr10 = 1; }
if ($usuarioEndereco != '') { $vlr11 = 1; }
if ($usuarioNumero != '') { $vlr12 = 1; }
if ($usuarioBairro != '') { $vlr13 = 1; }
if ($usuarioCEP != '') { $vlr14 = 1; }
if ($usuarioCidade != '') { $vlr15 = 1; }
if ($usuarioUF != '') { $vlr16 = 1; }
if ($usuarioEmpregado != '') { $vlr17 = 1; }
if ($usuarioSituacao != '') { $vlr18 = 1; }
if ($usuarioCNH != '') { $vlr19 = 1; }
if ($usuarioFoto != '') { $vlr20 = 1; }

$porc_dados = $vlr01 + $vlr02 + $vlr03 + $vlr04 + $vlr05 + $vlr06 + $vlr07 + $vlr08 + $vlr09 + $vlr10 + $vlr11 + $vlr12 + $vlr13 + $vlr14 + $vlr15 + $vlr16 + $vlr17 + $vlr18 + $vlr19 + $vlr20;

// OUTRAS INFORMAÇÕES
/*
if ($usuarioEsportes != '') { $vlr21 = 1.66; }
if ($usuarioHobbies != '') { $vlr22 = 1.66; }
if ($usuarioLivros != '') { $vlr23 = 1.66; }
if ($usuarioMusica != '') { $vlr24 = 1.66; }
if ($usuarioPaixoes != '') { $vlr25 = 1.66; }
if ($usuarioTrabsocial != '') { $vlr26 = 1.66; }

$porc_info = $vlr21 + $vlr22 + $vlr23 + $vlr24 + $vlr25 + $vlr26;
*/

// PROFISSIONAL
if ($usuarioArea != '') { $vlr27 = 2; }
if ($usuarioNivel != '') { $vlr28 = 2; }
if ($usuarioSalario != '') { $vlr29 = 2; }
if ($usuarioObjetivo != '') { $vlr30 = 2; }
if ($usuarioMini != '') { $vlr31 = 2; }

$porc_profissional = $vlr27 + $vlr28 + $vlr29 + $vlr30 + $vlr31;

// ESCOLARIDADE
if ($conta_escolaridade >= 1) {
	$porc_escolaridade = 15;
}

// EXPERIÊNCIAS
if ($conta_experiencias >= 1) {
	$porc_experiencias = 15;
}

// FORMAÇÃO
if ($conta_formacao >= 1) {
	$porc_formacao = 15;
}

// INFORMÁTICA
if ($conta_informatica >= 1) {
	$porc_informatica = 15;
}

// LINGUAS
if ($conta_linguas >= 1) {
	$porc_linguas = 10;
}

/* ************************************************ */
$porc_total = $porc_dados + $porc_profissional + $porc_escolaridade + $porc_experiencias + $porc_formacao + $porc_informatica + $porc_linguas;
// Arredonda
$porc_total = round($porc_total);
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
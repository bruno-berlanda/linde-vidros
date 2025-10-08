<?php

$consulta_usuario = mysqli_query ($conexao, "SELECT id, nome, nivel FROM admin_usuarios WHERE login='$login_usuario' AND nome='$nome_usuario'") or die (mysqli_error());
	$dados = mysqli_fetch_array ($consulta_usuario);
	
		$id_usuario			= $dados['id'];
		$nome_usuario 		= $dados['nome'];
		$nivel_usuario		= $dados['nivel'];
		
		$consulta_nivel = mysqli_query ($conexao, "SELECT * FROM admin_niveis WHERE id='$nivel_usuario'") or die (mysqli_error());
			$dados = mysqli_fetch_array ($consulta_nivel);
				$perm_adm 				= $dados['adm'];
				$perm_noticias 			= $dados['noticias'];
				$perm_galerias 			= $dados['galerias'];
				$perm_produtos 			= $dados['produtos'];
				$perm_vendedores 		= $dados['vendedores'];
				$perm_rotas 			= $dados['rotas'];
				$perm_promocoes 		= $dados['promocoes'];
				$perm_slides 			= $dados['slides'];
				$perm_contatos 			= $dados['contatos'];
				$perm_comentarios 		= $dados['comentarios'];
				$perm_cadastros 		= $dados['cadastros'];
				$perm_pesquisa 			= $dados['pesquisa'];
				$perm_curriculos 		= $dados['curriculos'];
				$perm_vagas 			= $dados['vagas'];
				$perm_avisos 			= $dados['avisos'];
				$perm_logs 				= $dados['logs'];
				$perm_usuarios 			= $dados['usuarios'];
				$perm_niveis 			= $dados['niveis'];
				$perm_representantes	= $dados['representantes'];
				$perm_treinamentos		= $dados['treinamentos'];
				$perm_tags				= $dados['tags'];
				$perm_arquivos			= $dados['arquivos'];
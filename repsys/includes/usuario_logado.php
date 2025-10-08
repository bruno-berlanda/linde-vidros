<?php

$consulta_usuario = mysqli_query ($conexao, "SELECT * FROM representantes WHERE login='$login_usuario' AND nome='$nome_usuario'") or die (mysqli_error());
	$dados = mysqli_fetch_array ($consulta_usuario);
	
		$id_usuario				= $dados['id'];
		$nome_usuario 			= $dados['nome'];
		$tipo_usuario			= $dados['tipo'];
		$seg_usuario			= $dados['segmento'];
		
		$p_promocoes			= $dados['p_promocoes'];
		$p_tabelas				= $dados['p_tabelas'];
		$p_orcamentos			= $dados['p_orcamentos'];
		$p_agenda				= $dados['p_agenda'];
		$p_croquis				= $dados['p_croquis'];
		$p_materiais			= $dados['p_materiais'];
		$p_procedimentos		= $dados['p_procedimentos'];
		$p_normas				= $dados['p_normas'];
		$p_metas				= $dados['p_metas'];
		$p_insulado				= $dados['p_insulado'];
		$p_diario				= $dados['p_diario'];
		$p_diario_gerente		= $dados['p_diario_gerente'];
		$p_diario_responsavel	= $dados['p_diario_responsavel'];
		$p_pedmov_solicitar		= $dados['p_pedmov_solicitar'];
		$p_pedmov_gerenciar		= $dados['p_pedmov_gerenciar'];
		$p_pedmov_responsavel	= $dados['p_pedmov_responsavel'];
		
		$senha_padrao			= $dados['senha_padrao'];
		
		$config_clientes		= $dados['config_clientes'];
		
		/* Config */
		switch ($config_clientes) {
			case "1":
				$ordem_clientes = " ORDER BY cliente";
				break;
			case "2":
				$ordem_clientes = " ORDER BY cidade, cliente";
				break;
			case "3":
				$ordem_clientes = " ORDER BY rota, cidade, cliente";
		}
		
// Navegador
$nav_chrome	= strpos($_SERVER['HTTP_USER_AGENT'],"Chrome");
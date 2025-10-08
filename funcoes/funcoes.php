<?php

function titulo($pg_end, $pg_det) {
	
	if ($pg_det == "") {
	
		switch ($pg_end) {
			case "/engenharia-vidro-temperado.php": 
				$title = "Linde Vidros - Vidro Temperado"; 
				break;
			case "/engenharia-vidro-laminado.php": 
				$title = "Vidro Laminado - Segurança e proteção"; 
				break;
			case "/engenharia-vidro-refletivo.php": 
				$title = "Linde Vidros - Vidro Refletivo"; 
				break;
			case "/engenharia-vidro-insulado.php": 
				$title = "Vidro Insulado - Proteção térmica e acústica"; 
				break;
			case "/engenharia-vidro-habitat.php": 
				$title = "Vidros Habitat - Proteção solar para residências"; 
				break;
			case "/engenharia-vidro-impresso.php": 
				$title = "Linde Vidros - Vidro Impresso"; 
				break;
			case "/engenharia-vidro-extra-clear.php": 
				$title = "Linde Vidros - Vidro Extra Clear"; 
				break;
			case "/engenharia-sentryglas.php": 
				$title = "Linde Vidros - SentryGlas"; 
				break;
			case "/moveleiro-vidro-temperado.php": 
				$title = "Linde Vidros - Vidro Temperado para Moveleiro"; 
				break;
			case "/moveleiro-portas-aluminio.php": 
				$title = "Linde Vidros - Portas de Alumínio"; 
				break;
			case "/moveleiro-espelho.php": 
				$title = "Linde Vidros - Espelhos"; 
				break;
			case "/refrigeracao-portas-expositores.php":
				$title = "Linde Vidros - Portas para Expositores";
				break;
			case "/refrigeracao-tampas-freezer.php":
				$title = "Linde Vidros - Tampas para Freezer";
				break;
			case "/acessorios-ferragens.php":
				$title = "Linde Vidros - Ferragens";
				break;
			case "/acessorios-aluminios.php":
				$title = "Linde Vidros - Alumínios";
				break;
			case "/acessorios-idea-glass.php": 
				$title = "Linde Vidros - Kits Idea Glass"; 
				break;
			case "/servicos-pelicula-seguranca.php": 
				$title = "Linde Vidros - Películas de Segurança"; 
				break;
			case "/servicos-serigrafia.php": 
				$title = "Linde Vidros - Serigrafia"; 
				break;
			case "/servicos-lapidacao.php": 
				$title = "Linde Vidros - Lapidação"; 
				break;
			case "/servicos-incisao.php": 
				$title = "Linde Vidros - Incisão"; 
				break;
			case "/servicos-cantos.php": 
				$title = "Linde Vidros - Cantos"; 
				break;
			case "/dicas-instalacao-vidros.php": 
				$title = "Linde Vidros - Instalação de Vidros"; 
				break;
			case "/dicas-instalacao-espelhos.php": 
				$title = "Linde Vidros - Instalação de Espelhos"; 
				break;
			case "/dicas-fixacao-espelhos.php": 
				$title = "Linde Vidros - Fixação de Espelhos"; 
				break;
			case "/dicas-manuseio-espelhos.php": 
				$title = "Linde Vidros - Manuseio de Espelhos"; 
				break;
			case "/dicas-furos-tempera.php": 
				$title = "Linde Vidros - Furos para Têmpera"; 
				break;
			
			case "/acessorios.php":
				$title = "Linde Vidros - Acessórios para Vidro";
				break;
			case "/contato.php":
				$title = "Linde Vidros - Contato";
				break;
			case "/area-restrita.php":
				$title = "Linde Vidros - Área Restrita";
				break;
			case "/curriculo-cadastrar.php":
				$title = "Linde Vidros - Cadastre seu Currículo";
				break;
			case "/curriculo-entrar.php":
				$title = "Linde Vidros - Acesse seu Currículo";
				break;
			case "/dicas.php":
				$title = "Linde Vidros - Dicas Sobre Vidros e Espelhos";
				break;
			case "/empresa.php":
				$title = "Linde Vidros - Empresa";
				break;
			case "/engenharia.php":
				$title = "Linde Vidros - Vidros para Engenharia";
				break;
			case "/gestao-pessoas.php":
				$title = "Linde Vidros - Gestão de Pessoas";
				break;
			case "/moveleiro.php":
				$title = "Linde Vidros - Vidros para Móveis";
				break;
			case "/refrigeracao.php":
				$title = "Linde Vidros - Linha Refrigeração";
				break;
			case "/index.php":
				$title = "Linde Vidros - Solução em Vidros";
				break;
			case "/":
				$title = "Linde Vidros - Solução em Vidros";
				break;
			case "":
				$title = "Linde Vidros - Solução em Vidros";
				break;
	
		}
	
	}
	
	else {
		
		$y = explode("=", $pg_det);
			$y_pro = $y[0];
			$y_cod = $y[1];
		
		if ($y_pro == "acessorios-aluminios-detalhes.php") {
			$con_p = mysqli_query ($conexao, "SELECT descricao FROM produtos_aluminios WHERE cod='$y_cod'") or die (mysqli_error());
				$d_pro = mysqli_fetch_array ($con_p);
					$desc_pro = ucfirst(strtolower($d_pro['descricao']));
		}
		elseif ($y_prod == "acessorios-ferragens-detalhes.php") {
			$con_p = mysqli_query ($conexao, "SELECT descricao FROM produtos_ferragens WHERE cod='$y_cod'") or die (mysqli_error());
				$d_pro = mysqli_fetch_array ($con_p);
					$desc_pro = ucfirst(strtolower($d_pro['descricao']));
		}
		
		$title = "Linde Vidros - ".$y_cod;

	}
	
	return $title;
	
}

function descricao($pg_end, $pg_det) {
	
	if ($pg_det == "") {
	
		switch ($pg_end) {
			case "/engenharia-vidro-temperado.php": 
				$descricao = "Vidro Temperado para Construção Civil e Indústria Moveleira, excelente acabamento e precisão nas medidas, resistência física e térmica do vidro temperado"; 
				break;
			case "/engenharia-vidro-laminado.php": 
				$descricao = "O vidro laminado temperado, une a qualidade de dois vidros de segurança formando um produto ainda mais resistente e com maior conforto acústico"; 
				break;
			case "/engenharia-vidro-refletivo.php": 
				$descricao = "Vidro Refletivo conhecido como Vidro Espelhado, garante isolamento térmico, economia no consumo de energia elétrica, protege contra raios UV, para fachadas de edifícios residenciais e comerciais, portas e janelas"; 
				break;
			case "/engenharia-vidro-insulado.php": 
				$descricao = "A solução mais avançada para melhorar o desempenho térmico e acústico residencial, Vidro Insulado"; 
				break;
			case "/engenharia-vidro-habitat.php": 
				$descricao = "Os vidros de proteção solar para residências Linha Habitat trazem uma segurança para você, sua casa, seus móveis e revestimentos contra o calor e os raios UV"; 
				break;
			case "/engenharia-vidro-impresso.php": 
				$descricao = "Vidro Impresso, resistência e conforto, privacidade, esteticamente agradável, usado em decoração, o Vidro Impresso pode ser, Vidro Pontilhado, Vidro Quadrato, Vidro Astral, Vidro Antílope, Vidro Squadriglass, Vidro Miniboreal"; 
				break;
			case "/engenharia-vidro-extra-clear.php": 
				$descricao = "Vidro Extra Clear, clareza, neutralidade e transparência, pode ser utilizado como vidro monolítico, laminado, temperado e insulado, ideal para peças serigrafadas e pintadas"; 
				break;
			case "/engenharia-sentryglas.php": 
				$descricao = "SentryGlas, altíssima resistência e segurança, protege contra tempestades, impactos e explosões, proteção raios UV, transparência, eficiência energética"; 
				break;
			case "/moveleiro-vidro-temperado.php": 
				$descricao = "Vidro Temperado para a indústria moveleira, resistência física e térmica do vidro temperado"; 
				break;
			case "/moveleiro-portas-aluminio.php": 
				$descricao = "Porta de Alúminio com o vidro ou espelho já encaixilhado traz um design diferenciado ao seu produto"; 
				break;
			case "/moveleiro-espelho.php": 
				$descricao = "Os espelhos de alta qualidade trazem ao seu ambiente um toque de modernidade e sofisticação"; 
				break;
			case "/refrigeracao-portas-expositores.php":
				$descricao = "Portas para Expositores Verticais em perfil em PVC de alta resistência mecânica, disponível em diversas cores utilizando vidros baixo emissivos Low-E";
				break;
			case "/refrigeracao-tampas-freezer.php":
				$descricao = "Tampas para Freezer Horizontal com vidro monolítico baixo emissivo temperado";
				break;
			case "/acessorios-ferragens.php":
				$descricao = "Linha completa de ferragens para portas e janelas de vidro";
				break;
			case "/acessorios-aluminios.php":
				$descricao = "Linha completa de alumínios para portas e janelas de vidro";
				break;
			case "/acessorios-idea-glass.php": 
				$descricao = "Os Kits Idea Glass deixa sua obra mais elegante, com acessórios para box de banheiro, portas e sacadas"; 
				break;
			case "/servicos-pelicula-seguranca.php": 
				$descricao = "A película de segurança deixa seu vidro mais resistente e forte, proteção contra acidentes domésticos e roubos. Ideal em projetos residênciais, escritórios e box de banheiro"; 
				break;
			case "/servicos-serigrafia.php": 
				$descricao = "O Vidro Serigrafado tem resistência, durabilidade e acabamento nobre, ideal para cozinhas, salas de jantar e dormitórios. O Vidro Marmorizado amplia as opções de decoração de casas"; 
				break;
			case "/servicos-lapidacao.php": 
				$descricao = "A lapidação é um tratamento dado ao vidro deixando-o mais seguro e resistente, permite um maior número de detalhes, que valorizam qualquer ideia em espelhos e tampos de vidro"; 
				break;
			case "/servicos-incisao.php": 
				$descricao = "A incisão consiste em gravar cavas na superfície do vidro, deixando com uma aparência moderna cheia de estilo"; 
				break;
			case "/servicos-cantos.php": 
				$descricao = "Você pode escolher o canto do seu vidro de acordo com o seu projeto, canto M, canto N, canto reto, canto tick, canto moeda, canto garrafa, canto garrafão, canto chanfrado"; 
				break;
			case "/dicas-instalacao-vidros.php": 
				$descricao = "Instale seu vidro com segurança e de maneira correta, seguinte esses simples passos"; 
				break;
			case "/dicas-instalacao-espelhos.php": 
				$descricao = "Instale seu espelho com segurança e de maneira correta, seguinte esses simples passos"; 
				break;
			case "/dicas-fixacao-espelhos.php": 
				$descricao = "Fixe seu espelho com segurança e corretamente, utilize o fixa espelho para maior garantia na instalação"; 
				break;
			case "/dicas-manuseio-espelhos.php": 
				$descricao = "Saiba como fazer o manuseio correto do seu espelho, desde o recebimento, armazenagem e transporte"; 
				break;
			case "/dicas-furos-tempera.php": 
				$descricao = "Os furos para o vidro têmperado devem seguir algumas regras. Saiba tudo sobre o diâmetro e as distâncias recomendadas"; 
				break;
			
			case "/acessorios.php":
				$descricao = "Acessórios para Vidros, Ferragens e Acessórios para Vidro Temperado, Perfis de Alumínio para Vidros Temperados, Kits Idea Glass";
				break;
			case "/contato.php":
				$descricao = "Entre em contato conosco, será um prazer atendê-lo, você pode entrar em contato via telefone, fax, e-mail ou por um formulário de contato. Encontre a Linde Vidros também nas redes sociais";
				break;
			case "/area-restrita.php":
				$descricao = "Para os clientes Linde Vidros, disponibilizamos uma área dedicada com diversos materiais de apoio";
				break;
			case "/curriculo-cadastrar.php":
				$descricao = "Quer trabalhar conosco? Faça seu cadastro e cadastre seu currículo";
				break;
			case "/curriculo-entrar.php":
				$descricao = "Acesse seu currículo e mantenha-o sempre atualizado";
				break;
			case "/dicas.php":
				$descricao = "Fique por dentro das dicas para manuseio e instalação do seu vidro ou espelho";
				break;
			case "/empresa.php":
				$descricao = "A Linde Vidros é uma indústria beneficiadora de vidro localizada na cidade de Rio Negro, Paraná. Fundada em 1966 está a mais de 50 anos no mercado";
				break;
			case "/engenharia.php":
				$descricao = "Vidros Temperados, Laminados e Refletivos, Vidro Impresso, Vidro Habitat, Vidro Insulado, Vidro Extra Clear, SentryGlas, Espelhos, Instalações Especiais. Atendemos engenheiros, arquitetos, decoradores";
				break;
			case "/gestao-pessoas.php":
				$descricao = "A Linde Vidros busca parceria com seus colaboradores, para juntos perseguirem os objetivos e metas com profissionalismo e ética, visando aumentar a satisfação dos clientes, funcionários e cidadãos";
				break;
			case "/moveleiro.php":
				$descricao = "Vidros para Linha Moveleira, Vidro Temperado, Portas de Alumínio, Espelhos, Películas de Segurança, Serigrafia, Lapidação, Incisão";
				break;
			case "/refrigeracao.php":
				$descricao = "Soluções em Vidros Low-E, Temperados para Expositores Verticais e Tampas para Freezer Horizontal, Aplicação em sistemas refrigerados, Ótimo desempenho térmico, Linha Refrigeração";
				break;
			case "/index.php":
				$descricao = "Vidros Residenciais, Proteção Solar, Conforto Térmico, Vidro Laminado, Vidro Insulado, Vidro Habitat, Vidros para Construção Civil, Indústria Moveleira, Refrigeração";
				break;
			case "/":
				$descricao = "Vidros Residenciais, Proteção Solar, Conforto Térmico, Vidro Laminado, Vidro Insulado, Vidro Habitat, Vidros para Construção Civil, Indústria Moveleira, Refrigeração";
				break;
			case "":
				$descricao = "Vidros Residenciais, Proteção Solar, Conforto Térmico, Vidro Laminado, Vidro Insulado, Vidro Habitat, Vidros para Construção Civil, Indústria Moveleira, Refrigeração";
				break;
	
		}
	
	}
	
	else {
		
		$y = explode("=", $pg_det);
			$y_pro = $y[0];
			$y_cod = $y[1];
			
		if ($y_pro == "acessorios-aluminios-detalhes.php") {
			$con_p = mysqli_query ($conexao, "SELECT descricao FROM produtos_aluminios WHERE cod='$y_cod'") or die (mysqli_error());
				$d_pro = mysqli_fetch_array ($con_p);
					$desc_pro = ucfirst(strtolower($d_pro['descricao']));
		}
		elseif ($y_prod == "acessorios-ferragens-detalhes.php") {
			$con_p = mysqli_query ($conexao, "SELECT descricao FROM produtos_ferragens WHERE cod='$y_cod'") or die (mysqli_error());
				$d_pro = mysqli_fetch_array ($con_p);
					$desc_pro = ucfirst(strtolower($d_pro['descricao']));
		}
		
		$descricao = $y_cod;
		
	}
	
	return $descricao;
	
}
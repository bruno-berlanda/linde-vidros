<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_sistema.php");
include_once ("includes/usuario_logado.php");
include_once ("includes/cabecalho.php");
?>

<body>

<?php include_once ("includes/menu_topo.php"); ?>

<div class="container-fluid" id="conteudo">

<div class="row" id="titulo">
	<div class="col-md-12">
    	<h1>Pesquisa de Satisfação</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_pesquisa == "S") {
?>

<?php
include_once("includes/msgs.php");
?>

<?php
$id_pesquisa = $_GET['pesquisa'];
$id_resposta = $_GET['resposta'];

$consulta_pesquisa = mysqli_query ($conexao, "SELECT * FROM pesquisa_clientes WHERE id='$id_resposta'") or die (mysqli_error());
	$dados = mysqli_fetch_array ($consulta_pesquisa);
		$data 			= $dados['data'];
		$cod_cliente 	= $dados['cod_cliente'];
		$nome_cliente 	= $dados['nome_cliente'];
		$rota 			= $dados['rota'];
		$responsavel	= $dados['responsavel'];
		$data_resposta	= $dados['data_resposta'];
		
		$p_tra1 		= $dados['p_tra1'];
		$p_tra2 		= $dados['p_tra2'];
		$p_tra3 		= $dados['p_tra3'];
		$obs_tra		= $dados['obs_tra'];
		
		$p_pro1 		= $dados['p_pro1'];
		$p_pro2 		= $dados['p_pro2'];
		$p_pro3 		= $dados['p_pro3'];
		$p_pro4			= $dados['p_pro4'];
		$obs_pro		= $dados['obs_pro'];
		
		$p_com1 		= $dados['p_com1'];
		$p_com2 		= $dados['p_com2'];
		$p_com3 		= $dados['p_com3'];
		$p_com4			= $dados['p_com4'];
		$p_com5			= $dados['p_com5'];
		$obs_com		= $dados['obs_com'];
		
		$c_tem 			= $dados['c_tem'];
		$c_sen 			= $dados['c_sen'];
		$c_lam 			= $dados['c_lam'];
		$c_tla 			= $dados['c_tla'];
		$c_ser 			= $dados['c_ser'];
		$c_mar 			= $dados['c_mar'];
		$c_ref 			= $dados['c_ref'];
		$c_ins 			= $dados['c_ins'];
		$c_hab 			= $dados['c_hab'];
		$c_esp 			= $dados['c_esp'];
		$c_imp 			= $dados['c_imp'];
		$c_fer 			= $dados['c_fer'];
		$c_mol 			= $dados['c_mol'];
		$c_kit 			= $dados['c_kit'];
		$c_alu 			= $dados['c_alu'];
		$c_por 			= $dados['c_por'];
		
		$merlin			= $dados['merlin'];
		
		$outros			= $dados['outros'];
		
		$avaliacao		= $dados['avaliacao'];
		
		$obs_geral		= $dados['obs_geral'];
		
		/* *************************************** */
		
		$data 			= date('d/m/Y H:i', strtotime($data));
		$data_resposta 	= date('d/m/Y H:i', strtotime($data_resposta));
		
		function resposta_pesquisa($a) {
			
			switch ($a) {
				case "1": $a_desc = "1 - MUITO INSATISFEITO"; break;
				case "2": $a_desc = "2 - INSATISFEITO"; break;
				case "3": $a_desc = "3 - SATISFEITO"; break;
				case "4": $a_desc = "4 - MUITO SATISFEITO"; break;
			}
			
			return $a_desc;
			
		}
		
		function produto_cor($c) {
			
			switch ($c) {
				case "S": $c_cor = "alert-success"; break;
				case "N": $c_cor = "alert-danger"; break;
			}
			
			return $c_cor;
			
		}
		
		function produto_icone($c) {
			
			switch ($c) {
				case "S": $c_icone = "<i class=\"fas fa-check\"></i>"; break;
				case "N": $c_icone = "<i class=\"fas fa-times\"></i>"; break;
			}
			
			return $c_icone;
			
		}
		
		function texto_media($m) {
			
			switch ($m) {
				case "1": $m_desc = "MUITO INSATISFEITO"; break;
				case "2": $m_desc = "INSATISFEITO"; break;
				case "3": $m_desc = "SATISFEITO"; break;
				case "4": $m_desc = "MUITO SATISFEITO"; break;
			}
			
			return $m_desc;
			
		}
		
		// Médias
		$media_tra = round(($p_tra1 + $p_tra2 + $p_tra3) / 3);
		$media_pro = round(($p_pro1 + $p_pro2 + $p_pro3 + $p_pro3) / 4);
		$media_com = round(($p_com1 + $p_com2 + $p_com3 + $p_com3 + $p_com3) / 5);
		
		// Média Geral
		$media_geral = round(($media_tra + $media_pro + $media_com) / 3);
		
		// Merlin
		switch ($merlin) {
			case "S": $merlin_desc = "SIM"; break;
			case "N": $merlin_desc = "NÃO"; break;
		}
		
		// Avaliação
		switch ($avaliacao) {
			case "1": $av_img = "pesquisa_1.png"; $av_texto = "INFERIOR"; break;
			case "2": $av_img = "pesquisa_2.png"; $av_texto = "IGUAL"; break;
			case "3": $av_img = "pesquisa_3.png"; $av_texto = "SUPERIOR"; break;
		}
?>

<div class="row">
	<div class="col-md-4">
    	<div class="row">
        	<div class="col-md-12">
            	<strong class="lead text-danger"><?php echo $nome_cliente; ?></strong>
            </div>
        </div>
        
        <hr>
        
        <div class="row">
        	<div class="col-xs-6">
            	<small class="text-muted">DATA SOLICITAÇÃO</small>
                <br>
                <?php echo $data; ?>
            </div>
            <div class="col-xs-6">
            	<small class="text-muted">DATA RESPOSTA</small>
                <br>
                <strong><?php echo $data_resposta; ?></strong>
            </div>
        </div>
        
        <hr>
        
        <div class="row">
        	<div class="col-md-3">
            	<small class="text-muted">CÓDIGO</small>
                <br>
                <?php echo $cod_cliente; ?>
            </div>
            <div class="col-md-3">
            	<small class="text-muted">ROTA</small>
                <br>
                <?php echo $rota; ?>
            </div>
            <div class="col-md-6">
            	<small class="text-muted">RESPONSÁVEL</small>
                <br>
                <?php echo $responsavel; ?>
            </div>
        </div>
        
        <hr>
        
        <div class="panel panel-default">
            <div class="panel-heading text-center"><small><strong>MÉDIA GERAL</strong></small></div>
            <div class="panel-body text-center">
                <strong class="lead text-primary"><?php echo $media_geral; ?></strong>
                <br>
                <small><?php echo texto_media($media_geral); ?></small>
            </div>
        </div>
        
        <hr>
        
        <h2>Avaliação Geral</h2>
        
        <div class="panel panel-default-inverse">
            <div class="panel-heading"><small>COMO EU AVALIO A LINDE VIDROS EM COMPARAÇÃO À CONCORRÊNCIA</small></div>
            <div class="panel-body text-center">
                <img src="img/<?php echo $av_img; ?>" alt="">
            </div>
            <div class="panel-footer text-center"><strong><?php echo $av_texto; ?></strong></div>
        </div>
    </div>
    <div class="col-md-8">
    	<div class="well">
        	<div class="row">
            	<div class="col-md-9">
                    <h2>Transporte</h2>
                
                    <p class="text-primary"><strong>1 - O motorista verifica o local onde será descarregado (condicionado) o produto?</strong></p>
                    <p><small><?php echo resposta_pesquisa($p_tra1); ?></small></p>
                    
                    <p class="text-primary"><strong>2 - O motorista faz a contagem e conferência das peças junto ao cliente e em caso de alguma dúvida faz a recontagem?</strong></p>
                    <p><small><?php echo resposta_pesquisa($p_tra2); ?></small></p>
                    
                    <p class="text-primary"><strong>3 - O motorista dá o tempo necessário para a conferência dos produtos?</strong></p>
                    <p><small><?php echo resposta_pesquisa($p_tra3); ?></small></p>
                    
                    <br>
                    
                    <div class="panel panel-primary">
                    	<div class="panel-heading"><small>OBSERVAÇÕES</small></div>
                        <div class="panel-body">
                        	<?php echo $obs_tra; ?>
                        </div>
                    </div>                    
            	</div>
                <div class="col-md-3 text-center">
                	<div class="panel panel-default">
                    	<div class="panel-heading"><small>MÉDIA</small></div>
                        <div class="panel-body">
                        	<strong class="lead text-primary"><?php echo $media_tra; ?></strong>
                            <br>
                            <small><?php echo texto_media($media_tra); ?></small>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="row">
            	<div class="col-md-9">
                    <h2>Produto</h2>
        
                    <p class="text-danger"><strong>4 - Qualidade dos produtos</strong></p>
                    <p><small><?php echo resposta_pesquisa($p_pro1); ?></small></p>
                    
                    <p class="text-danger"><strong>5 - As peças entregues atendem à qualidade desejada?</strong></p>
                    <p><small><?php echo resposta_pesquisa($p_pro2); ?></small></p>
                    
                    <p class="text-danger"><strong>6 - A quantidade solicitada é entregue em sua totalidade?</strong></p>
                    <p><small><?php echo resposta_pesquisa($p_pro3); ?></small></p>
                    
                    <p class="text-danger"><strong>7 - Quando há dúvidas e problemas com peças, o setor de qualidade dá o devido atendimento?</strong></p>
                    <p><small><?php echo resposta_pesquisa($p_pro4); ?></small></p>
                    
                    <br>
                    
                    <div class="panel panel-danger">
                    	<div class="panel-heading"><small>OBSERVAÇÕES</small></div>
                        <div class="panel-body">
                        	<?php echo $obs_pro; ?>
                        </div>
                    </div>
            	</div>
                <div class="col-md-3 text-center">
                	<div class="panel panel-default">
                    	<div class="panel-heading"><small>MÉDIA</small></div>
                        <div class="panel-body">
                        	<strong class="lead text-danger"><?php echo $media_pro; ?></strong>
                            <br>
                            <small><?php echo texto_media($media_pro); ?></small>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="row">
            	<div class="col-md-9">
                    <h2>Comercial</h2>
        
                    <p class="text-warning"><strong>8 - A visita do representante é frequente e eficiente?</strong></p>
                    <p><small><?php echo resposta_pesquisa($p_com1); ?></small></p>
                    
                    <p class="text-warning"><strong>9 - O atendimento telefônico é rápido e prestativo?</strong></p>
                    <p><small><?php echo resposta_pesquisa($p_com2); ?></small></p>
                    
                    <p class="text-warning"><strong>10 - O retorno de orçamentos e pendências com os vendedores internos estão dentro da sua expectativa?</strong></p>
                    <p><small><?php echo resposta_pesquisa($p_com3); ?></small></p>
                    
                    <p class="text-warning"><strong>11 - O prazo de entrega dos pedidos atende as suas necessidades?</strong></p>
                    <p><small><?php echo resposta_pesquisa($p_com4); ?></small></p>
                    
                    <p class="text-warning"><strong>12 - O departamento financeiro é rápido e eficaz na resolução de pendências?</strong></p>
                    <p><small><?php echo resposta_pesquisa($p_com5); ?></small></p>
                    
                    <br>
                    
                    <div class="panel panel-warning">
                    	<div class="panel-heading"><small>OBSERVAÇÕES</small></div>
                        <div class="panel-body">
                        	<?php echo $obs_com; ?>
                        </div>
                    </div>
            	</div>
                <div class="col-md-3 text-center">
                	<div class="panel panel-default">
                    	<div class="panel-heading"><small>MÉDIA</small></div>
                        <div class="panel-body">
                        	<strong class="lead text-warning"><?php echo $media_com; ?></strong>
                            <br>
                            <small><?php echo texto_media($media_com); ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    	
        <h2>Conhecimento dos Produtos</h2>
        
        <div class="row">
        	<div class="col-md-3">
            	<div class="alert <?php echo produto_cor($c_tem); ?>" role="alert">
                    <?php echo produto_icone($c_tem); ?> <small>TEMPERADO</small>
                </div>
            </div>
            <div class="col-md-3">
            	<div class="alert <?php echo produto_cor($c_lam); ?>" role="alert">
                    <?php echo produto_icone($c_lam); ?> <small>LAMINADO</small>
                </div>
            </div>
            <div class="col-md-3">
            	<div class="alert <?php echo produto_cor($c_tla); ?>" role="alert">
                    <?php echo produto_icone($c_tla); ?> <small>LAMINADO TEMPERADO</small>
                </div>
            </div>
            <div class="col-md-3">
            	<div class="alert <?php echo produto_cor($c_sen); ?>" role="alert">
                    <?php echo produto_icone($c_sen); ?> <small>LAMINADO SENTRYGLAS</small>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-3">
            	<div class="alert <?php echo produto_cor($c_ser); ?>" role="alert">
                    <?php echo produto_icone($c_ser); ?> <small>SERIGRAFADO</small>
                </div>
            </div>
            <div class="col-md-3">
            	<div class="alert <?php echo produto_cor($c_mar); ?>" role="alert">
                    <?php echo produto_icone($c_mar); ?> <small>MARMORIZADO</small>
                </div>
            </div>
            <div class="col-md-3">
            	<div class="alert <?php echo produto_cor($c_ref); ?>" role="alert">
                    <?php echo produto_icone($c_ref); ?> <small>REFLETIVO</small>
                </div>
            </div>
            <div class="col-md-3">
            	<div class="alert <?php echo produto_cor($c_ins); ?>" role="alert">
                    <?php echo produto_icone($c_ins); ?> <small>INSULADO</small>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-3">
            	<div class="alert <?php echo produto_cor($c_hab); ?>" role="alert">
                    <?php echo produto_icone($c_hab); ?> <small>HABITAT</small>
                </div>
            </div>
            <div class="col-md-3">
            	<div class="alert <?php echo produto_cor($c_esp); ?>" role="alert">
                    <?php echo produto_icone($c_esp); ?> <small>ESPELHO</small>
                </div>
            </div>
            <div class="col-md-3">
            	<div class="alert <?php echo produto_cor($c_imp); ?>" role="alert">
                    <?php echo produto_icone($c_imp); ?> <small>IMPRESSO</small>
                </div>
            </div>
            <div class="col-md-3">
            	<div class="alert <?php echo produto_cor($c_fer); ?>" role="alert">
                    <?php echo produto_icone($c_fer); ?> <small>FERRAGENS</small>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-3">
            	<div class="alert <?php echo produto_cor($c_mol); ?>" role="alert">
                    <?php echo produto_icone($c_mol); ?> <small>MOLA</small>
                </div>
            </div>
            <div class="col-md-3">
            	<div class="alert <?php echo produto_cor($c_kit); ?>" role="alert">
                    <?php echo produto_icone($c_kit); ?> <small>KIT BOX</small>
                </div>
            </div>
            <div class="col-md-3">
            	<div class="alert <?php echo produto_cor($c_alu); ?>" role="alert">
                    <?php echo produto_icone($c_alu); ?> <small>ALUMÍNIOS</small>
                </div>
            </div>
            <div class="col-md-3">
            	<div class="alert <?php echo produto_cor($c_por); ?>" role="alert">
                    <?php echo produto_icone($c_por); ?> <small>PORTA AUTOMÁTICA</small>
                </div>
            </div>
        </div>
        
        <div class="row">
        	<div class="col-md-6">
            	<h2>Conhece a marca Merlin?</h2>
        
                <div class="alert <?php echo produto_cor($merlin); ?>" role="alert">
                    <?php echo produto_icone($merlin); ?> <small><?php echo $merlin_desc; ?></small>
                </div>
            </div>
            <div class="col-md-6">
            	<h2>Outros Produtos</h2>
        
                <div class="panel panel-default">
                    <div class="panel-heading"><small>OUTROS PRODUTOS QUE O CLIENTE GOSTARIA DE COMPRAR</small></div>
                    <div class="panel-body">
                        <?php echo $outros; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <h2>Observações Gerais</h2>
        
        <div class="panel panel-default">
            <div class="panel-heading"><small>SUGESTÕES / CRÍTICAS / ELOGIOS</small></div>
            <div class="panel-body">
                <?php echo $obs_geral; ?>
            </div>
        </div>
        
    </div>
</div>

<?php
} else {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Você não tem permissão para acessar essa página. Consulte o Administrador do sistema.
		</div>
	</div>
</div>
<?php
}
?>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_curriculos.php");
include_once ("includes/usuario_logado.php");

include_once ("includes/cabecalho.php");
?>

<body>

<?php include_once ("includes/menu_topo.php"); ?>

<div class="container-fluid" id="conteudo">

<div class="row" id="titulo">
	<div class="col-md-12">
    	<h1><?php echo $usuarioNome; ?></h1>
    </div>
</div>

<?php include_once ("includes/msgs.php"); ?>

<div class="row">
	<div class="col-md-2">
    	<?php
		if ($usuarioFoto == '') {
			if ($usuarioSexo == "M") {
				$foto = "sem_foto_m.jpg";
			}
			else if ($usuarioSexo == "F") {
				$foto = "sem_foto_f.jpg";
			}
			else {
				$foto = "sem_foto_mf.jpg";
			}
		}
		else {
			$foto = $usuarioFoto;
		}
		?>
        
        <p class="text-center"><img src="fotos/<?php echo $foto; ?>" alt="" class="img-circle img-responsive"></p>
        
        <?php
		if ($usuarioFoto == '') {
		?>
        <p><a href="meucadastro.php#meucadastro" class="btn btn-danger btn-block btn-sm"><i class="fas fa-camera-retro"></i> Quero colocar uma foto!</a></p>
        <?php
		}
		?>
        
        <br>
        
        <p>Seu currículo está <?php echo $porc_total; ?>% completo.</p>
        <?php
		if ($porc_total < 50) {
		?>
        <div class="progress progress-striped">
        	<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porc_total; ?>%;"></div>
        </div>
        <?php
		}
		else if ($porc_total >= 50 && $porc_total < 90) {
		?>
        <div class="progress progress-striped">
        	<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porc_total; ?>%;"></div>
        </div>
        <?php	
		}
		else {
		?>
        <div class="progress progress-striped">
        	<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porc_total; ?>%;"></div>
        </div>
        <?php	
		}
		?>
    </div>
    <div class="col-md-10">
    	<div class="well">
        	<h1>Seja um Destaque!</h1>
        	<p class="lead">Mantenha seu currículo sempre atualizado e mais completo possível. Quanto mais preenchido e mais atualizado, maiores são as suas chances de conseguir um destaque entre os currículos.</p>
        	<p class="lead"><strong>Currículos com poucas informações (somente com os dados pessoais) não serão visualizados pelo setor de RH.</strong></p>
        </div>
        
        <?php
		/* *******************************************************************
		VAGAS EM ABERTO
		******************************************************************* */
		$consultaVagas = mysqli_query ($conexao, "SELECT id, id_vaga, descricao FROM vagas_criadas WHERE status='1' ORDER BY id DESC") or die (mysqli_error());
		$contaVagas = mysqli_num_rows ($consultaVagas);
		
		if ($contaVagas >= 1) {
		?>
        
        <h2>Vagas Abertas</h2>
        
        <div class="row">
        <?php
			$i = 0;
			
			while ($dados = mysqli_fetch_array($consultaVagas)) {
				$id 		= $dados['id'];
				$id_vaga 	= $dados['id_vaga'];
				$descricao 	= $dados['descricao'];
				
				$consVaga = mysqli_query ($conexao, "SELECT vaga FROM vagas WHERE id='$id_vaga'") or die (mysqli_error());
					$dados = mysqli_fetch_array ($consVaga);
						$nomeVaga = $dados['vaga'];
				
				$i++;
		?>
        	<div class="col-sm-12 col-md-4">
                <div class="thumbnail">
                    <div class="caption">
                    	<h3><?php echo $nomeVaga; ?></h3>
                   	
                        <p><button type="button" class="btn btn-sm btn-warning btn-block" data-toggle="modal" data-target="#myModal<?php echo $i; ?>">REQUISITOS PARA A VAGA</button></p>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    	<h4 class="modal-title" id="myModalLabel"><?php echo $nomeVaga; ?></h4>
                                    </div>
                                    <div class="modal-body">
                                    	<h4>Requisitos para a vaga</h4>
                    					<hr>
										<?php echo nl2br($descricao); ?>
                                    </div>
                                    <div class="modal-footer">
                                    	<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        
                        <div id="myModal<?php echo $i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 id="myModalLabel"><?php echo $nomeVaga; ?></h3>
                            </div>
                            <div class="modal-body">
                                <h4>REQUISITOS PARA A VAGA</h4>
                                <hr>
                                <?php echo nl2br($descricao); ?>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Fechar</button>
                            </div>
                        </div>
                        <!-- Modal -->
                        
                        <?php
						$consInscricao = mysqli_query ($conexao, "SELECT data FROM vagas_inscritos WHERE id_vaga='$id' AND candidato='$idUsuario'") or die (mysqli_error());
						$contaInscricao = mysqli_num_rows ($consInscricao);
						
							if ($contaInscricao == 0) {
						?>
						<p><a href="funcoes/vagas.php?funcao=ins&v=<?php echo $id; ?>&u=<?php echo $usuarioCod; ?>" class="btn btn-success btn-lg btn-block"><i class="far fa-thumbs-up"></i> EU QUERO ESSA VAGA</a></p>
						<?php
							}
							else {
								$dados = mysqli_fetch_array ($consInscricao);
									$dataInsc = $dados['data'];
									
									// Tratamento da Data
									$dataInsc = substr($dataInsc,8,2) . "/" .substr($dataInsc,5,2) . "/" . substr($dataInsc,2,2);
						?>
						<p><a href="funcoes/vagas.php?funcao=can&v=<?php echo $id; ?>&u=<?php echo $usuarioCod; ?>" class="btn btn-danger btn-lg btn-block"><i class="far fa-thumbs-down"></i> EU NÃO QUERO ESSA VAGA</a></p> <span class="label label-success">VOCÊ SE CANDIDATOU PARA A VAGA DIA <?php echo $dataInsc; ?></span>
						<?php
							}
						?>
                    </div>
                </div>
            </div>
        <?php
			}
		}
		?>
        </div>
        
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts_bootstrap.php"); ?>

</body>

</html>
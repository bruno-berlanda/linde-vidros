		<?php
		if ($conta_formacao > 0) {
		?>
        <h4>Formações Cadastradas</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>CURSO</th>
                    <th>SITUAÇÃO</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?php
		$i= 1;

		while ($infos = mysqli_fetch_array($consulta_formacao)) {
			$id 			= $infos['id'];
			$intituicaoFor	= $infos['instituicao'];
			$atividadeFor	= $infos['atividade'];
			$situacaoFor	= $infos['situacao'];
			
			// Tratamento da SITUAÇÃO
			if ($situacaoFor == "1") { $situacaoTab = "Concluído"; }
			if ($situacaoFor == "2") { $situacaoTab = "Cursando"; }
			if ($situacaoFor == "3") { $situacaoTab = "Interrompido"; }
		?>
        		<tr>
                	<td><?php echo $i++; ?></td>
                    <td><?php echo $atividadeFor; ?></td>
                    <td><?php echo $situacaoTab; ?></td>
                    <td><a href="formacao_editar.php?opt=<?php echo $id; ?>&usr=<?php echo $idUsuario; ?>#formacao" title="Editar" class="btn btn-warning btn-block"><i class="icon-pencil icon-white"></i></a></td>
                    <td><a href="funcoes/formacao.php?funcao=excluir&id=<?=$id ?>&idUsuario=<?=$idUsuario ?>" title="Excluir" class="btn btn-danger btn-block" onClick="return confirm('Tem certeza que deseja excluir o curso <?php echo $atividadeFor; ?> (<?php echo $intituicaoFor; ?>)?')"><i class="icon-trash icon-white"></i></a></td>
                </tr>
        <?php
		}
		?>
            </tbody>
        </table>
        <?php
		}
		else {
		?>
        	<div class="alert"><a class="close" data-dismiss="alert" href="#">&times;</a>Nenhum curso cadastrado</div>
        <?php
		}
		?>
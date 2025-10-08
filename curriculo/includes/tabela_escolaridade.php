		<?php
		if ($conta_escolaridade > 0) {
		?>
        <h4>Escolaridade Cadastrada</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>INSTITUIÇÃO</th>
                    <th>SITUAÇÃO</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?php
		$i= 1;

		while ($infos = mysqli_fetch_array($consulta_escolaridade)) {
			$id 			= $infos['id'];
			$cursoEsc 		= $infos['curso'];
			$situacaoEsc	= $infos['situacao'];
			
			// Tratamento da SITUAÇÃO
			if ($situacaoEsc == "1") { $situacaoTab = "Concluído"; }
			if ($situacaoEsc == "2") { $situacaoTab = "Cursando - 1º ano"; }
			if ($situacaoEsc == "3") { $situacaoTab = "Cursando - 2º ano"; }
			if ($situacaoEsc == "4") { $situacaoTab = "Cursando - 3º ano"; }
			if ($situacaoEsc == "5") { $situacaoTab = "Cursando - 4º ano"; }
			if ($situacaoEsc == "6") { $situacaoTab = "Cursando - 5º ano"; }
			if ($situacaoEsc == "7") { $situacaoTab = "Cursando - 6º ano"; }
			if ($situacaoEsc == "8") { $situacaoTab = "Cancelado"; }
			if ($situacaoEsc == "9") { $situacaoTab = "Trancado"; }
		?>
        		<tr>
                	<td><?php echo $i++; ?></td>
                    <td><?php echo $cursoEsc; ?></td>
                    <td><?php echo $situacaoTab; ?></td>
                    <td><a href="escolaridade_editar.php?opt=<?php echo $id; ?>&usr=<?php echo $idUsuario; ?>#escolaridade" title="Editar" class="btn btn-warning btn-block"><i class="icon-pencil icon-white"></i></a></td>
                    <td><a href="funcoes/escolaridade.php?funcao=excluir&id=<?=$id ?>&idUsuario=<?=$idUsuario ?>" title="Excluir" class="btn btn-danger btn-block" onClick="return confirm('Tem certeza que deseja excluir o curso <?php echo $cursoEsc; ?>?')"><i class="icon-trash icon-white"></i></a></td>
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
		<?php
		if ($conta_experiencias > 0) {
		?>
        <h4>Experiências Cadastradas</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>EMPRESA</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?php
		$i= 1;

		while ($infos = mysqli_fetch_array($consulta_experiencias)) {
			$id 		= $infos['id'];
			$empresaExp = $infos['empresa'];
		?>
        		<tr>
                	<td><?php echo $i++; ?></td>
                    <td><?php echo $empresaExp; ?></td>
                    <td><a href="expprofissional_editar.php?opt=<?php echo $id; ?>&usr=<?php echo $idUsuario; ?>#expprofissional" title="Editar" class="btn btn-warning btn-block"><i class="icon-pencil icon-white"></i></a></td>
                    <td><a href="funcoes/experiencia.php?funcao=excluir&id=<?=$id ?>&idUsuario=<?=$idUsuario ?>" title="Excluir" class="btn btn-danger btn-block" onClick="return confirm('Tem certeza que deseja excluir a experiência na empresa <?php echo $empresaExp; ?>?')"><i class="icon-trash icon-white"></i></a></td>
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
        	<div class="alert"><a class="close" data-dismiss="alert" href="#">&times;</a>Nenhuma experiência cadastrada</div>
        <?php
		}
		?>
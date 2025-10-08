		<?php
		if ($conta_linguas > 0) {
		?>
        <h4>Conhecimentos Cadastrados</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>IDIOMA</th>
                    <th>NÍVEL</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?php
		$i= 1;

		while ($infos = mysqli_fetch_array($consulta_linguas)) {
			$id 		= $infos['id'];
			$idioma		= $infos['idioma'];
			$nivel		= $infos['nivel'];
			
			// Tratamento do IDIOMA
			if ($idioma == "1") { $idiomaTab = "Inglês"; }
			if ($idioma == "2") { $idiomaTab = "Espanhol"; }
			if ($idioma == "3") { $idiomaTab = "Francês"; }
			if ($idioma == "4") { $idiomaTab = "Italiano"; }
			if ($idioma == "5") { $idiomaTab = "Alemão"; }
			if ($idioma == "6") { $idiomaTab = "Chinês"; }
			if ($idioma == "7") { $idiomaTab = "Japonês"; }
			
			// Tratamento do NÍVEL
			if ($nivel == "1") { $nivelTab = "Básico"; }
			if ($nivel == "2") { $nivelTab = "Intermediário"; }
			if ($nivel == "3") { $nivelTab = "Avançado"; }
			if ($nivel == "4") { $nivelTab = "Fluente"; }
		?>
        		<tr>
                	<td><?php echo $i++; ?></td>
                    <td><?php echo $idiomaTab; ?></td>
                    <td><?php echo $nivelTab; ?></td>
                    <td><a href="funcoes/linguas.php?funcao=excluir&id=<?=$id ?>&idUsuario=<?=$idUsuario ?>" title="Excluir" class="btn btn-danger btn-block" onClick="return confirm('Tem certeza que deseja excluir o conhecimento no idioma <?php echo $idiomaTab; ?>?')"><i class="icon-trash icon-white"></i></a></td>
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
        	<div class="alert"><a class="close" data-dismiss="alert" href="#">&times;</a>Nenhum idioma cadastrado</div>
        <?php
		}
		?>
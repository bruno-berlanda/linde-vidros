		<?php
		if ($conta_informatica > 0) {
		?>
        <h4>Conhecimentos Cadastrados</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>APLICATIVO</th>
                    <th>NÍVEL</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?php
		$i= 1;

		while ($infos = mysqli_fetch_array($consulta_informatica)) {
			$id 		= $infos['id'];
			$software	= $infos['software'];
			$nivel		= $infos['nivel'];
			
			// Tratamento do APLICATIVO
			if ($software == "1") { $softwareTab = "Windows"; }
			if ($software == "2") { $softwareTab = "Linux"; }
			if ($software == "3") { $softwareTab = "Microsoft Word"; }
			if ($software == "4") { $softwareTab = "Microsoft Excel"; }
			if ($software == "5") { $softwareTab = "Microsoft PowerPoint"; }
			if ($software == "6") { $softwareTab = "Microsoft Outlook"; }
			if ($software == "7") { $softwareTab = "Microsoft Access"; }
			if ($software == "8") { $softwareTab = "CorelDRAW"; }
			if ($software == "9") { $softwareTab = "Adobe Photoshop"; }
			if ($software == "10") { $softwareTab = "AutoCAD"; }
			if ($software == "11") { $softwareTab = "Internet"; }
			if ($software == "12") { $softwareTab = "Redes"; }
			
			// Tratamento do NÍVEL
			if ($nivel == "1") { $nivelTab = "Básico"; }
			if ($nivel == "2") { $nivelTab = "Intermediário"; }
			if ($nivel == "3") { $nivelTab = "Avançado"; }
		?>
        		<tr>
                	<td><?php echo $i++; ?></td>
                    <td><?php echo $softwareTab; ?></td>
                    <td><?php echo $nivelTab; ?></td>
                    <td><a href="funcoes/informatica.php?funcao=excluir&id=<?=$id ?>&idUsuario=<?=$idUsuario ?>" title="Excluir" class="btn btn-danger btn-block" onClick="return confirm('Tem certeza que deseja excluir o conhecimento no aplicativo <?php echo $softwareTab; ?>?')"><i class="icon-trash icon-white"></i></a></td>
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
        	<div class="alert"><a class="close" data-dismiss="alert" href="#">&times;</a>Nenhum aplicativo cadastrado</div>
        <?php
		}
		?>
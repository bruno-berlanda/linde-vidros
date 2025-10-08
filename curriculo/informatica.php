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
    	<h1><i class="fas fa-laptop"></i> Informática</h1>
    </div>
</div>

<?php include_once ("includes/msgs.php"); ?>

<div class="row">
	<div class="col-md-6">
        <form method="post" action="funcoes/informatica.php?funcao=cadastrar&u=<?php echo $usuarioCod; ?>" class="form-horizontal">
            
            <legend>O que você conhece?</legend>
            
            <div class="form-group">
            	<label for="selectSoftware" class="col-sm-3 control-label">Aplicativo</label>
                <div class="col-sm-7">
                	<select name="software" class="form-control" id="selectSoftware" required>
                    	<option></option>
                        <option value="1">Windows (Sistema Operacional)</option>
                        <option value="2">Linux (Sistema Operacional)</option>
                        <option value="3">Microsoft Word (Pacote Office)</option>
                        <option value="4">Microsoft Excel (Pacote Office)</option>
                        <option value="5">Microsoft PowerPoint (Pacote Office)</option>
                        <option value="6">Microsoft Outlook (Pacote Office)</option>
                        <option value="7">Microsoft Access (Pacote Office)</option>
                        <option value="8">CorelDRAW (Software Gráfico)</option>
                        <option value="9">Adobe Photoshop (Software Gráfico)</option>
                        <option value="10">AutoCAD (Software Gráfico)</option>
                        <option value="11">Internet (Navegação)</option>
                        <option value="12">Redes (Configuração)</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
            	<label for="selectNivel" class="col-sm-3 control-label">Nível</label>
                <div class="col-sm-5">
                	<select name="nivel" class="form-control" id="selectNivel" required>
                    	<option></option>
                        <option value="1">Básico</option>
                        <option value="2">Intermediário</option>
                        <option value="3">Avançado</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-lg btn-primary"><i class="fas fa-save"></i> Salvar</button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="col-md-6">
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
                    <td><a href="funcoes/informatica.php?funcao=excluir&id=<?php echo $id; ?>&u=<?php echo $usuarioCod; ?>" title="Excluir" class="btn btn-xs btn-danger btn-block" onClick="return confirm('Tem certeza que deseja excluir o conhecimento no aplicativo <?php echo $softwareTab; ?>?')"><i class="fas fa-trash-alt"></i></a></td>
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
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                Nenhum conhecimento cadastrado
                </div>
            </div>
        </div>
        <?php
		}
		?>      
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts_bootstrap.php"); ?>

</body>

</html>
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
    	<h1><i class="fas fa-globe"></i> Idiomas</h1>
    </div>
</div>

<?php include_once ("includes/msgs.php"); ?>

<div class="row">
	<div class="col-md-6">
        <form method="post" action="funcoes/linguas.php?funcao=cadastrar&u=<?php echo $usuarioCod; ?>" class="form-horizontal">
            
            <legend>O que você conhece?</legend>
            
            <div class="form-group">
            	<label for="selectIdioma" class="col-sm-3 control-label">Idioma</label>
                <div class="col-sm-7">
                	<select name="idioma" class="form-control" id="selectIdioma" required>
                    	<option></option>
                        <option value="1">Inglês</option>
                        <option value="2">Espanhol</option>
                        <option value="3">Francês</option>
                        <option value="4">Italiano</option>
                        <option value="5">Alemão</option>
                        <option value="6">Chinês</option>
                        <option value="7">Japonês</option>
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
                        <option value="4">Fluente</option>
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
                    <td><a href="funcoes/linguas.php?funcao=excluir&id=<?php echo $id; ?>&u=<?php echo $usuarioCod; ?>" title="Excluir" class="btn btn-xs btn-danger btn-block" onClick="return confirm('Tem certeza que deseja excluir o conhecimento no idioma <?php echo $idiomaTab; ?>?')"><i class="fas fa-trash-alt"></i></a></td>
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
                Nenhum idioma cadastrado
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
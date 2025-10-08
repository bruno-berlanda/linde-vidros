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
    	<h1><i class="fas fa-graduation-cap"></i> Escolaridade</h1>
    </div>
</div>

<?php include_once ("includes/msgs.php"); ?>

<div class="row">
	<div class="col-md-6">
        <form method="post" action="funcoes/escolaridade.php?funcao=cadastrar&u=<?php echo $usuarioCod; ?>" class="form-horizontal">
            
            <legend>Onde você estuda ou estudou?</legend>
            
            <div class="form-group">
            	<label for="inputDataInicio" class="col-sm-3 control-label">Data Início</label>
                <div class="col-sm-3">
                	<input type="text" name="data_inicio" class="form-control" id="inputDataInicio" placeholder="MM/AAAA" required autofocus>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputDataConclusao" class="col-sm-3 control-label">Data Conclusão</label>
                <div class="col-sm-3">
                	<input type="text" name="data_conclusao" class="form-control" id="inputDataConclusao" placeholder="MM/AAAA">
                </div>
            </div>
            <div class="form-group">
            	<label for="inputInstituicao" class="col-sm-3 control-label">Instituição</label>
                <div class="col-sm-9">
                	<input type="text" name="instituicao" class="form-control" id="inputInstituicao" maxlength="50" autocomplete="off" required>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputCurso" class="col-sm-3 control-label">Curso</label>
                <div class="col-sm-9">
                	<input type="text" name="curso" class="form-control" id="inputCurso" maxlength="40" autocomplete="off" required>
                </div>
            </div>
            <div class="form-group">
            	<label for="selectGrauFormacao" class="col-sm-3 control-label">Grau de Formação</label>
                <div class="col-sm-5">
                	<select name="grau" class="form-control" id="selectGrauFormacao" required>
                    	<option></option>
                        <option value="1">Ensino Médio</option>
                        <option value="2">Técnico</option>
                        <option value="3">Graduação</option>
                        <option value="4">Pós-Graduação</option>
                        <option value="5">MBA</option>
                        <option value="6">Mestrado</option>
                        <option value="7">Doutorado</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
            	<label for="selectSituacao" class="col-sm-3 control-label">Situação</label>
                <div class="col-sm-5">
                	<select name="situacao" class="form-control" id="selectSituacao" required>
                    	<option></option>
                        <option value="1">Concluído</option>
                        <option value="2">Cursando - 1º ano</option>
                        <option value="3">Cursando - 2º ano</option>
                        <option value="4">Cursando - 3º ano</option>
                        <option value="5">Cursando - 4º ano</option>
                        <option value="6">Cursando - 5º ano</option>
                        <option value="7">Cursando - 6º ano</option>
                        <option value="8">Cancelado</option>
                        <option value="9">Trancado</option>
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
                    <td><a href="escolaridade_editar.php?opt=<?php echo $id; ?>&u=<?php echo $usuarioCod; ?>" title="Editar" class="btn btn-xs btn-warning btn-block"><i class="fas fa-pencil-alt"></i></a></td>
                    <td><a href="funcoes/escolaridade.php?funcao=excluir&id=<?php echo $id; ?>&u=<?php echo $usuarioCod; ?>" title="Excluir" class="btn btn-xs btn-danger btn-block" onClick="return confirm('Tem certeza que deseja excluir o curso <?php echo $cursoEsc; ?>?')"><i class="fas fa-trash-alt"></i></a></td>
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
                Nenhum curso cadastrado
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
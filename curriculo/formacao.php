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
    	<h1><i class="fas fa-university"></i> Formação Complementar</h1>
    </div>
</div>

<?php include_once ("includes/msgs.php"); ?>

<div class="row">
	<div class="col-md-6">
        <form method="post" action="funcoes/formacao.php?funcao=cadastrar&u=<?php echo $usuarioCod; ?>" class="form-horizontal">
            
            <legend>Cursos extras</legend>
            
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
            	<label for="inputCurso" class="col-sm-3 control-label">Curso/Atividade</label>
                <div class="col-sm-9">
                	<input type="text" name="atividade" class="form-control" id="inputCurso" maxlength="40" autocomplete="off" required>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputCargaHoraria" class="col-sm-3 control-label">Carga Horária</label>
                <div class="col-sm-3">
                	<input type="text" name="carga" class="form-control" id="inputCargaHoraria" placeholder="horas">
                </div>
            </div>
            <div class="form-group">
            	<label for="selectSituacao" class="col-sm-3 control-label">Situação</label>
                <div class="col-sm-5">
                	<select name="situacao" class="form-control" id="selectSituacao" required>
                    	<option></option>
                        <option value="1">Concluído</option>
                        <option value="2">Cursando</option>
                        <option value="3">Interrompido</option>
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
                    <td><a href="formacao_editar.php?opt=<?php echo $id; ?>&u=<?php echo $usuarioCod; ?>" title="Editar" class="btn btn-xs btn-warning btn-block"><i class="fas fa-pencil-alt"></i></a></td>
                    <td><a href="funcoes/formacao.php?funcao=excluir&id=<?php echo $id; ?>&u=<?php echo $usuarioCod; ?>" title="Excluir" class="btn btn-xs btn-danger btn-block" onClick="return confirm('Tem certeza que deseja excluir o curso <?php echo $atividadeFor; ?> (<?php echo $intituicaoFor; ?>)?')"><i class="fas fa-trash-alt"></i></a></td>
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
                Nenhum curso complementar cadastrado
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
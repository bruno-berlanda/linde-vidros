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

<?php
$id 		= $_GET['opt'];
$c_usuario 	= $_GET['u'];

$consulta_cod = mysqli_query ($conexao, "SELECT id FROM usuarios WHERE codigo='$c_usuario'") or die (mysqli_error());
	$d = mysqli_fetch_array ($consulta_cod);
		$id_usuario = $d['id'];

// Verifica se o ID do item selecionado pertence ao usuário logado
$verifica_id = mysqli_query ($conexao, "SELECT id_usuario FROM usuarios_escolaridade WHERE id=$id") or die (mysqli_error());
	$dados = mysqli_fetch_array ($verifica_id);
		$idUsuario_editar = $dados['id_usuario'];
		
		// Se o ID for de outro usuário, retorna pra home com erro
		if ($id_usuario != $idUsuario_editar) {
			header ('Location: escolaridade.php?msgErro=Você não tem permissão para acessar essa página');
		}
		if ($id_usuario != $idUsuario) {
			header ('Location: escolaridade.php?msgErro=Você não tem permissão para acessar essa página');
		}

$consulta = mysqli_query ($conexao, "SELECT * FROM usuarios_escolaridade WHERE id='$id'") or die (mysqli_error());
	$dados = mysqli_fetch_array ($consulta);
		$ini_mes 		= $dados['ini_mes'];
		$ini_ano 		= $dados['ini_ano'];
		$con_mes 		= $dados['con_mes'];
		$con_ano 		= $dados['con_ano'];
		$instituicao 	= $dados['instituicao'];
		$curso 			= $dados['curso'];
		$grau 			= $dados['grau'];
		$situacao 		= $dados['situacao'];
?>

<div class="row">
	<div class="col-md-6">
        <form method="post" action="funcoes/escolaridade.php?funcao=editar&id=<?php echo $id; ?>&u=<?php echo $usuarioCod; ?>" class="form-horizontal">
            
            <legend>Editar Escolaridade</legend>
            
            <div class="form-group">
            	<label for="inputDataInicio" class="col-sm-3 control-label">Data Início</label>
                <div class="col-sm-3">
                	<input type="text" name="data_inicio" class="form-control" id="inputDataInicio" placeholder="MM/AAAA" required autofocus value="<?php echo $ini_mes ?>/<?php echo $ini_ano ?>">
                </div>
            </div>
            <div class="form-group">
            	<label for="inputDataConclusao" class="col-sm-3 control-label">Data Conclusão</label>
                <div class="col-sm-3">
                	<input type="text" name="data_conclusao" class="form-control" id="inputDataConclusao" placeholder="MM/AAAA" value="<?php echo $con_mes ?>/<?php echo $con_ano ?>">
                </div>
            </div>
            <div class="form-group">
            	<label for="inputInstituicao" class="col-sm-3 control-label">Instituição</label>
                <div class="col-sm-9">
                	<input type="text" name="instituicao" class="form-control" id="inputInstituicao" maxlength="50" autocomplete="off" required value="<?php echo $instituicao ?>">
                </div>
            </div>
            <div class="form-group">
            	<label for="inputCurso" class="col-sm-3 control-label">Curso</label>
                <div class="col-sm-9">
                	<input type="text" name="curso" class="form-control" id="inputCurso" maxlength="40" autocomplete="off" required value="<?php echo $curso ?>">
                </div>
            </div>
            <div class="form-group">
            	<label for="selectGrauFormacao" class="col-sm-3 control-label">Grau de Formação</label>
                <div class="col-sm-5">
                	<select name="grau" class="form-control" id="selectGrauFormacao" required>
                        <option value="1"<?php if ($grau == "1") { echo " selected"; } ?>>Ensino Médio</option>
                        <option value="2"<?php if ($grau == "2") { echo " selected"; } ?>>Técnico</option>
                        <option value="3"<?php if ($grau == "3") { echo " selected"; } ?>>Graduação</option>
                        <option value="4"<?php if ($grau == "4") { echo " selected"; } ?>>Pós-Graduação</option>
                        <option value="5"<?php if ($grau == "5") { echo " selected"; } ?>>MBA</option>
                        <option value="6"<?php if ($grau == "6") { echo " selected"; } ?>>Mestrado</option>
                        <option value="7"<?php if ($grau == "7") { echo " selected"; } ?>>Doutorado</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
            	<label for="selectSituacao" class="col-sm-3 control-label">Situação</label>
                <div class="col-sm-5">
                	<select name="situacao" class="form-control" id="selectSituacao" required>
                    	<option></option>
                        <option value="1"<?php if ($situacao == "1") { echo " selected"; } ?>>Concluído</option>
                        <option value="2"<?php if ($situacao == "2") { echo " selected"; } ?>>Cursando - 1º ano</option>
                        <option value="3"<?php if ($situacao == "3") { echo " selected"; } ?>>Cursando - 2º ano</option>
                        <option value="4"<?php if ($situacao == "4") { echo " selected"; } ?>>Cursando - 3º ano</option>
                        <option value="5"<?php if ($situacao == "5") { echo " selected"; } ?>>Cursando - 4º ano</option>
                        <option value="6"<?php if ($situacao == "6") { echo " selected"; } ?>>Cursando - 5º ano</option>
                        <option value="7"<?php if ($situacao == "7") { echo " selected"; } ?>>Cursando - 6º ano</option>
                        <option value="8"<?php if ($situacao == "8") { echo " selected"; } ?>>Cancelado</option>
                        <option value="9"<?php if ($situacao == "9") { echo " selected"; } ?>>Trancado</option>
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
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
    	<h1><i class="fas fa-briefcase"></i> Experiência Profissional</h1>
    </div>
</div>

<?php include_once ("includes/msgs.php"); ?>

<div class="row">
	<div class="col-md-6">
        <form method="post" action="funcoes/experiencia.php?funcao=cadastrar&u=<?php echo $usuarioCod; ?>" class="form-horizontal">
            
            <legend>Onde você trabalhou?</legend>
            
            <div class="form-group">
            	<label for="inputDataInicio" class="col-sm-3 control-label">Data Início</label>
                <div class="col-sm-3">
                	<input type="text" name="data_inicio" class="form-control" id="inputDataInicio" placeholder="MM/AAAA" required autofocus>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputDataSaida" class="col-sm-3 control-label">Data Saída</label>
                <div class="col-sm-3">
                	<input type="text" name="data_saida" class="form-control" id="inputDataSaida" placeholder="MM/AAAA">
                </div>
            </div>
            <div class="form-group">
            	<label for="inputEmpresa" class="col-sm-3 control-label">Empresa</label>
                <div class="col-sm-9">
                	<input type="text" name="empresa" class="form-control" id="inputEmpresa" maxlength="50" autocomplete="off" required>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputCargo" class="col-sm-3 control-label">Cargo</label>
                <div class="col-sm-9">
                	<input type="text" name="cargo" class="form-control" id="inputCargo" maxlength="40" autocomplete="off" required>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputDescricao" class="col-sm-3 control-label">Descrição</label>
                <div class="col-sm-9">
                	<textarea name="descricao" rows="10" class="form-control" id="inputDescricao" required placeholder="Atribuições/Realizações no cargo"></textarea>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputRemuneracao" class="col-sm-3 control-label">Remuneração</label>
                <div class="col-sm-4">
                	<input type="text" name="salario" class="form-control" id="inputRemuneracao" autocomplete="off" placeholder="Somente números">
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
                    <td><a href="expprofissional_editar.php?opt=<?php echo $id; ?>&u=<?php echo $usuarioCod; ?>#expprofissional" title="Editar" class="btn btn-xs btn-warning btn-block"><i class="fas fa-pencil-alt"></i></a></td>
                    <td><a href="funcoes/experiencia.php?funcao=excluir&id=<?php echo $id; ?>&u=<?php echo $usuarioCod; ?>" title="Excluir" class="btn btn-xs btn-danger btn-block" onClick="return confirm('Tem certeza que deseja excluir a experiência na empresa <?php echo $empresaExp; ?>?')"><i class="fas fa-trash-alt"></i></a></td>
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
                Nenhuma experiência cadastrada
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
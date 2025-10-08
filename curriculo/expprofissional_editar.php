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

<?php
$id 		= $_GET['opt'];
$c_usuario 	= $_GET['u'];

$consulta_cod = mysqli_query ($conexao, "SELECT id FROM usuarios WHERE codigo='$c_usuario'") or die (mysqli_error());
	$d = mysqli_fetch_array ($consulta_cod);
		$id_usuario = $d['id'];

// Verifica se o ID do item selecionado pertence ao usuário logado
$verifica_id = mysqli_query ($conexao, "SELECT id_usuario FROM usuarios_experiencias WHERE id=$id") or die (mysqli_error());
	$dados = mysqli_fetch_array ($verifica_id);
		$idUsuario_editar = $dados['id_usuario'];
		
		// Se o ID for de outro usuário, retorna pra home com erro
		if ($id_usuario != $idUsuario_editar) {
			header ('Location: expprofissional.php?msgErro=Você não tem permissão para acessar essa página');
		}
		if ($id_usuario != $idUsuario) {
			header ('Location: expprofissional.php?msgErro=Você não tem permissão para acessar essa página');
		}

$consulta = mysqli_query ($conexao, "SELECT * FROM usuarios_experiencias WHERE id='$id'") or die (mysqli_error());
	$dados = mysqli_fetch_array ($consulta);
		$ini_mes 	= $dados['ini_mes'];
		$ini_ano 	= $dados['ini_ano'];
		$sai_mes 	= $dados['sai_mes'];
		$sai_ano 	= $dados['sai_ano'];
		$empresa 	= $dados['empresa'];
		$cargo 		= $dados['cargo'];
		$descricao 	= $dados['descricao'];
		$salario 	= $dados['salario'];
?>

<div class="row">
	<div class="col-md-6">
        <form method="post" action="funcoes/experiencia.php?funcao=editar&id=<?php echo $id; ?>&u=<?php echo $usuarioCod; ?>" class="form-horizontal">
            
            <legend>Editar Experiência</legend>
            
            <div class="form-group">
            	<label for="inputDataInicio" class="col-sm-3 control-label">Data Início</label>
                <div class="col-sm-3">
                	<input type="text" name="data_inicio" class="form-control" id="inputDataInicio" placeholder="MM/AAAA" required autofocus value="<?php echo $ini_mes ?>/<?php echo $ini_ano ?>">
                </div>
            </div>
            <div class="form-group">
            	<label for="inputDataSaida" class="col-sm-3 control-label">Data Saída</label>
                <div class="col-sm-3">
                	<input type="text" name="data_saida" class="form-control" id="inputDataSaida" placeholder="MM/AAAA" value="<?php echo $sai_mes ?>/<?php echo $sai_ano ?>">
                </div>
            </div>
            <div class="form-group">
            	<label for="inputEmpresa" class="col-sm-3 control-label">Empresa</label>
                <div class="col-sm-9">
                	<input type="text" name="empresa" class="form-control" id="inputEmpresa" maxlength="50" autocomplete="off" required value="<?php echo $empresa ?>">
                </div>
            </div>
            <div class="form-group">
            	<label for="inputCargo" class="col-sm-3 control-label">Cargo</label>
                <div class="col-sm-9">
                	<input type="text" name="cargo" class="form-control" id="inputCargo" maxlength="40" autocomplete="off" required value="<?php echo $cargo ?>">
                </div>
            </div>
            <div class="form-group">
            	<label for="inputDescricao" class="col-sm-3 control-label">Descrição</label>
                <div class="col-sm-9">
                	<textarea name="descricao" rows="10" class="form-control" id="inputDescricao" required placeholder="Atribuições/Realizações no cargo"><?php echo $descricao ?></textarea>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputRemuneracao" class="col-sm-3 control-label">Remuneração</label>
                <div class="col-sm-4">
                	<input type="text" name="salario" class="form-control" id="inputRemuneracao" autocomplete="off" placeholder="Somente números" value="<?php echo $salario ?>">
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
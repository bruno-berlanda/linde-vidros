<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_sistema.php");
include_once ("includes/usuario_logado.php");
include_once ("includes/cabecalho.php");
?>

<body>

<?php include_once ("includes/menu_topo.php"); ?>

<div class="container-fluid" id="conteudo">

<div class="row" id="titulo">
	<div class="col-md-12">
    	<h1>Embalagens: Moveleiro</h1>
    </div>
</div>

<?php
if ($perm_adm == "S") {
?>

<?php
include_once("includes/msgs.php");
?>

<div class="row">
<div class="col-md-6">
<?php
if (!isset($_GET['editar'])) {
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
CADASTRAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<form method="post" action="funcoes/embalagens.php?funcao=cadastrar" class="form-horizontal">
    <fieldset>
        <legend>Cadastrar Embalagem</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputTipoEmbalagem" class="col-sm-3 control-label">Tipo</label>
            <div class="col-sm-3">
            	<input type="text" name="tipo" class="form-control" id="inputTipoEmbalagem" autocomplete="off" required autofocus>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputDescricao" class="col-sm-3 control-label">Descrição</label>
            <div class="col-sm-9">
            	<input type="text" name="descricao" class="form-control" id="inputDescricao" autocomplete="off" required maxlength="255">
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </fieldset>
</form>
<?php
}
else if (isset($_GET['editar'])) {
	
	$id = $_GET['editar'];
	
	$consulta = mysqli_query ($conexao, "SELECT * FROM moveleiro_embalagens WHERE id='$id'") or die (mysqli_error());
		$dados = mysqli_fetch_array($consulta);
			$tipo 		= $dados['tipo'];
			$descricao	= $dados['descricao'];
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
EDITAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<form method="post" action="funcoes/embalagens.php?funcao=editar&id=<?php echo $id; ?>" class="form-horizontal">
    <fieldset>
        <legend>Editar Nível</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputTipoEmbalagem" class="col-sm-3 control-label">Tipo</label>
            <div class="col-sm-3">
            	<input type="text" name="tipo" class="form-control" id="inputTipoEmbalagem" autocomplete="off" required autofocus value="<?php echo $tipo; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputDescricao" class="col-sm-3 control-label">Descrição</label>
            <div class="col-sm-9">
            	<input type="text" name="descricao" class="form-control" id="inputDescricao" autocomplete="off" required value="<?php echo $descricao; ?>" maxlength="255">
            </div>
        </div>
        
        <input type="hidden" name="tipo_atual" value="<?php echo $tipo; ?>">
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
                <a href="moveleiro_embalagens.php" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </fieldset>
</form>
<?php
}
?>
</div>

<div class="col-md-6">
<h2>Embalagens Cadastradas</h2>

<?php
$i = 1;

$consulta = mysqli_query ($conexao, "SELECT * FROM moveleiro_embalagens ORDER BY tipo") or die (mysqli_error());
$conta = mysqli_num_rows ($consulta);

if ($conta == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhuma embalagem cadastrada
		</div>
	</div>
</div>
<?php
}
else {
?>

<table class="table table-striped">
    <thead>
    	<tr>
        	<th>#</th>
            <th>TIPO</th>
            <th>DESCRIÇÃO</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha = mysqli_fetch_array($consulta)) {
    $id 		= $linha['id'];
    $tipo		= $linha['tipo'];
	$descricao	= $linha['descricao'];
	$ativo		= $linha['ativo'];
?>
    
    	<tr>
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><?php echo $tipo; ?></td>
            <td><?php echo $descricao; ?></td>
            
            <td>
			<?php 
            if ($ativo == "S") { ?>
                <a href="funcoes/embalagens.php?funcao=desativar&id=<?php echo $id; ?>" title="Desativar" class="btn btn-xs btn-block btn-success"><i class="fas fa-thumbs-up"></i></a>
			<?php 
            } else { 
            ?>
                <a href="funcoes/embalagens.php?funcao=ativar&id=<?php echo $id; ?>" title="Ativar" class="btn btn-xs btn-block btn-default"><i class="fas fa-thumbs-down"></i></a>
            <?php
            }
            ?>
            </td>
            
            <td>
            <a href="moveleiro_embalagens.php?editar=<?php echo $id; ?>" class="btn btn-xs btn-block btn-warning"><i class="fas fa-pencil-alt"></i></a>
            </td>
            
            <td>
			<?php if ($perm_adm == "S") { ?>
            <a href="funcoes/embalagens.php?funcao=excluir&id=<?php echo $id; ?>" class="btn btn-xs btn-block btn-danger" onClick="return confirm('Tem certeza que deseja excluir a embalagem <?php echo $tipo; ?> - <?php echo $descricao; ?>?')"><i class="fas fa-trash-alt"></i></a>
            <?php } else { ?>
            <a href="#" class="btn btn-xs btn-block btn-default disabled"><i class="fas fa-trash-alt"></i></a>
            <?php } ?>
            </td>
        </tr>
 <?php } ?>

	</tbody>
</table>
<?php 
} 
?>
</div>
</div>

<?php
} else {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Você não tem permissão para acessar essa página. Consulte o Administrador do sistema.
		</div>
	</div>
</div>
<?php
}
?>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
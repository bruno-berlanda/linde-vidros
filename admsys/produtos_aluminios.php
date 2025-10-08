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
    	<h1>Produtos: Alumínios</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_produtos == "S") {
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
<form method="post" action="funcoes/produtos_aluminios.php?funcao=cadastrar" enctype="multipart/form-data" class="form-horizontal">
    <fieldset>
        <legend>Cadastrar Alumínio</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputCodigo" class="col-sm-3 control-label">Código</label>
            <div class="col-sm-4">
            	<input type="text" name="codigo" class="form-control" id="inputCodigo" autocomplete="off" required autofocus>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputDescricao" class="col-sm-3 control-label">Descrição</label>
            <div class="col-sm-9">
            	<input type="text" name="descricao" class="form-control" id="inputDescricao" autocomplete="off" maxlength="255">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputPeso" class="col-sm-3 control-label">Peso</label>
            <div class="col-sm-3">
            	<input type="text" name="peso" class="form-control" id="inputPeso" autocomplete="off">
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
        	<label for="checkCores" class="col-sm-3 control-label">Cores</label>
            <div class="col-sm-9">
            	<div class="checkbox">
                    <label>
                    	<input type="checkbox" name="cor_bz" value="S"> Bronze
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="cor_pt" value="S"> Preto
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="cor_cr" value="S"> Cromado
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="cor_bc" value="S"> Branco
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="cor_nf" value="S"> Natural Fosco
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="cor_mf" value="S"> Marfim
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="cor_mg" value="S"> Mogno
                    </label>
                </div>
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
        	<label for="inputFoto1" class="col-sm-3 control-label">Foto 1</label>
            <div class="col-sm-9">
            	<input type="file" name="foto1" class="form-control" id="inputFoto1">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputFoto2" class="col-sm-3 control-label">Foto 2</label>
            <div class="col-sm-9">
            	<input type="file" name="foto2" class="form-control" id="inputFoto2">
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<span class="help-block">Envie imagens no tamanho de 700 x 300 pixels.</span>
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
	
	$consulta = mysqli_query ($conexao, "SELECT * FROM produtos_aluminios WHERE id='$id'") or die (mysqli_error());
		$dados = mysqli_fetch_array ($consulta);
			$id 		= $dados['id'];
    		$cod 		= $dados['cod'];
			$descricao 	= $dados['descricao'];
			$peso 		= $dados['peso'];
			$cor_bz		= $dados['cor_bz'];
			$cor_pt		= $dados['cor_pt'];
			$cor_cr		= $dados['cor_cr'];
			$cor_bc		= $dados['cor_bc'];
			$cor_nf		= $dados['cor_nf'];
			$cor_mf		= $dados['cor_mf'];
			$cor_mg		= $dados['cor_mg'];
    		$imagem1 	= $dados['imagem1'];
			$imagem2 	= $dados['imagem2'];
			$ativo 		= $dados['ativo'];
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
EDITAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<form method="post" action="funcoes/produtos_aluminios.php?funcao=editar&id=<?php echo $id; ?>" enctype="multipart/form-data" class="form-horizontal">
    <fieldset>
        <legend>Editar Alumínio</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputCodigo" class="col-sm-3 control-label">Código</label>
            <div class="col-sm-4">
            	<input type="text" name="codigo" class="form-control" id="inputCodigo" autocomplete="off" required autofocus value="<?php echo $cod; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputDescricao" class="col-sm-3 control-label">Descrição</label>
            <div class="col-sm-9">
            	<input type="text" name="descricao" class="form-control" id="inputDescricao" autocomplete="off" maxlength="255" value="<?php echo $descricao; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputPeso" class="col-sm-3 control-label">Peso</label>
            <div class="col-sm-3">
            	<input type="text" name="peso" class="form-control" id="inputPeso" autocomplete="off" value="<?php echo $peso; ?>">
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
        	<label for="checkCores" class="col-sm-3 control-label">Cores</label>
            <div class="col-sm-9">
            	<div class="checkbox">
                    <label>
                    	<input type="checkbox" name="cor_bz" value="S"<?php if ($cor_bz == "S") { echo " checked"; } ?>> Bronze
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="cor_pt" value="S"<?php if ($cor_pt == "S") { echo " checked"; } ?>> Preto
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="cor_cr" value="S"<?php if ($cor_cr == "S") { echo " checked"; } ?>> Cromado
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="cor_bc" value="S"<?php if ($cor_bc == "S") { echo " checked"; } ?>> Branco
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="cor_nf" value="S"<?php if ($cor_nf == "S") { echo " checked"; } ?>> Natural Fosco
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="cor_mf" value="S"<?php if ($cor_mf == "S") { echo " checked"; } ?>> Marfim
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="cor_mg" value="S"<?php if ($cor_mg == "S") { echo " checked"; } ?>> Mogno
                    </label>
                </div>
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
        	<label for="inputFoto1" class="col-sm-3 control-label">Foto 1</label>
            <div class="col-sm-9">
            	<input type="file" name="foto1" class="form-control" id="inputFoto1">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputFoto2" class="col-sm-3 control-label">Foto 2</label>
            <div class="col-sm-9">
            	<input type="file" name="foto2" class="form-control" id="inputFoto2">
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<span class="help-block">Envie imagens no tamanho de 700 x 300 pixels.</span>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
                <a href="produtos_aluminios.php" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </fieldset>
</form>

<hr>

<div class="row">
	<div class="col-xs-6">
    	<?php if ($imagem1 != "") { ?>
        <img src="../img/produtos/aluminios/<?php echo $imagem1; ?>" class="img-responsive img-thumbnail">
        <?php } ?>
    </div>
    <div class="col-xs-6">
    	<?php if ($imagem2 != "") { ?>
        <img src="../img/produtos/aluminios/<?php echo $imagem2; ?>" class="img-responsive img-thumbnail">
        <?php } ?>
    </div>
</div>

<?php
}
?>
</div>

<div class="col-md-6">
<h2>Alumínios Cadastrados</h2>

<?php
$i = 1;

$consulta = mysqli_query ($conexao, "SELECT * FROM produtos_aluminios ORDER BY cod") or die (mysqli_error());
$conta = mysqli_num_rows ($consulta);

if ($conta == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhum produto cadastrado
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
            <th>COD</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha = mysqli_fetch_array($consulta)) {
    $id 		= $linha['id'];
    $cod		= $linha['cod'];
	$ativo		= $linha['ativo'];
?>
    
    	<tr>
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><strong><?php echo $cod; ?></strong></td>
            
            <td>
            <?php
			if ($ativo == "S") {
			?>
            <a href="funcoes/produtos_aluminios.php?funcao=desativar&id=<?php echo $id; ?>" class="btn btn-xs btn-block btn-success"><i class="fas fa-thumbs-up"></i></a>
            <?php
			} else if ($ativo == "N") {
			?>
            <a href="funcoes/produtos_aluminios.php?funcao=ativar&id=<?php echo $id; ?>" class="btn btn-xs btn-block btn-default"><i class="fas fa-thumbs-down"></i></a>
            <?php
			}
			?>
            </td>
            
            <td>
            <a href="produtos_aluminios.php?editar=<?php echo $id; ?>" class="btn btn-xs btn-block btn-warning"><i class="fas fa-pencil-alt"></i></a>
            </td>
            
            <td>
			<?php if ($perm_adm == "S") { ?>
            <a href="funcoes/produtos_aluminios.php?funcao=excluir&id=<?php echo $id; ?>" class="btn btn-xs btn-block btn-danger" onClick="return confirm('Tem certeza que deseja excluir o produto <?php echo $cod; ?>?')"><i class="fas fa-trash-alt"></i></a>
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
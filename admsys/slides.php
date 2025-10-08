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
    	<h1>Slides</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_slides == "S") {
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
<form method="post" action="funcoes/slides.php?funcao=cadastrar" class="form-horizontal" enctype="multipart/form-data">
    <fieldset>
        <legend>Cadastrar Imagem</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputFoto" class="col-sm-3 control-label">Foto</label>
            <div class="col-sm-9">
            	<input type="file" name="foto" class="form-control" id="inputFoto" required>
                <span class="help-block">Enviar foto com 1980 x 500 pixels</span>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputSeq" class="col-sm-3 control-label">Sequência</label>
            <div class="col-sm-3">
            	<input type="number" name="seq" class="form-control" id="inputSeq" autocomplete="off" required min="1" max="9">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputTitulo" class="col-sm-3 control-label">Título</label>
            <div class="col-sm-6">
            	<input type="text" name="titulo" class="form-control" id="inputTitulo" autocomplete="off" maxlength="20">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputFrase" class="col-sm-3 control-label">Frase</label>
            <div class="col-sm-9">
            	<input type="text" name="frase" class="form-control" id="inputFrase" autocomplete="off" maxlength="60">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputLink" class="col-sm-3 control-label">Link</label>
            <div class="col-sm-9">
            	<input type="text" name="link" class="form-control" id="inputLink" autocomplete="off" maxlength="255">
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
	
	$consulta = mysqli_query ($conexao, "SELECT * FROM admin_slides WHERE id='$id'") or die (mysqli_error());
		$dados = mysqli_fetch_array($consulta);
			$foto 			= $dados['foto'];
			$seq			= $dados['seq'];
			$titulo			= $dados['titulo'];
			$frase			= $dados['frase'];
			$link			= $dados['link'];
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
EDITAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<form method="post" action="funcoes/slides.php?funcao=editar&id=<?php echo $id; ?>" class="form-horizontal" enctype="multipart/form-data">
    <fieldset>
        <legend>Editar Imagem</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputFoto" class="col-sm-3 control-label">Foto</label>
            <div class="col-sm-9">
            	<input type="file" name="foto" class="form-control" id="inputFoto">
                <span class="help-block">Enviar foto com 1980 x 500 pixels</span>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputSeq" class="col-sm-3 control-label">Sequência</label>
            <div class="col-sm-3">
            	<input type="number" name="seq" class="form-control" id="inputSeq" autocomplete="off" required min="1" max="9" value="<?php echo $seq; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputTitulo" class="col-sm-3 control-label">Título</label>
            <div class="col-sm-6">
            	<input type="text" name="titulo" class="form-control" id="inputTitulo" autocomplete="off" maxlength="20" value="<?php echo $titulo; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputFrase" class="col-sm-3 control-label">Frase</label>
            <div class="col-sm-9">
            	<input type="text" name="frase" class="form-control" id="inputFrase" autocomplete="off" maxlength="60" value="<?php echo $frase; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputLink" class="col-sm-3 control-label">Link</label>
            <div class="col-sm-9">
            	<input type="text" name="link" class="form-control" id="inputLink" autocomplete="off" maxlength="255" value="<?php echo $link; ?>">
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
                <a href="slides.php" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<img src="../img/slide/<?php echo $foto; ?>" class="img-responsive img-thumbnail">
            </div>
        </div>
    </fieldset>
</form>
<?php
}
?>
</div>

<div class="col-md-6">
<h2>Imagens Cadastradas</h2>

<?php
$i = 1;

$consulta = mysqli_query ($conexao, "SELECT * FROM admin_slides ORDER BY ativo DESC, seq") or die (mysqli_error());
$conta = mysqli_num_rows ($consulta);

if ($conta == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhuma imagem cadastrada
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
            <th></th>
            <th>SEQ</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha = mysqli_fetch_array($consulta)) {
    $id 		= $linha['id'];
    $foto		= $linha['foto'];
	$seq		= $linha['seq'];
	$ativo		= $linha['ativo'];
?>
    
    	<tr>
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><img src="../img/slide/<?php echo $foto; ?>" class="img-responsive img-thumbnail" id="img-mini"></td>
            <td><?php echo $seq; ?></td>
            
            <td>
			<?php 
            if ($ativo == "S") { ?>
                <a href="funcoes/slides.php?funcao=desativar&id=<?php echo $id; ?>" title="Desativar" class="btn btn-xs btn-block btn-success"><i class="fas fa-thumbs-up"></i></a>
			<?php 
            } else { 
            ?>
                <a href="funcoes/slides.php?funcao=ativar&id=<?php echo $id; ?>" title="Ativar" class="btn btn-xs btn-block btn-default"><i class="fas fa-thumbs-down"></i></a>
            <?php
            }
            ?>
            </td>
            
            <td>
            <a href="slides.php?editar=<?php echo $id; ?>" class="btn btn-xs btn-block btn-warning"><i class="fas fa-pencil-alt"></i></a>
            </td>
            
            <td>
			<?php if ($perm_adm == "S") { ?>
            <a href="funcoes/slides.php?funcao=excluir&id=<?php echo $id; ?>" class="btn btn-xs btn-block btn-danger" onClick="return confirm('Tem certeza que deseja excluir essa imagem?')"><i class="fas fa-trash-alt"></i></a>
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
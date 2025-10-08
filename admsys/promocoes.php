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
    	<h1>Promoções</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_promocoes == "S") {
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
<form method="post" action="funcoes/promocoes.php?funcao=cadastrar" enctype="multipart/form-data" class="form-horizontal">
    <fieldset>
        <legend>Cadastrar Promoção</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputTitulo" class="col-sm-3 control-label">Título</label>
            <div class="col-sm-9">
            	<input type="text" name="titulo" class="form-control" id="inputTitulo" autocomplete="off" required autofocus>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputImagem1" class="col-sm-3 control-label">Imagem Miniatura</label>
            <div class="col-sm-9">
            	<input type="file" name="imagem1" class="form-control" id="inputImagem1" autocomplete="off" required>
                <span class="help-block">Tamanho (800 x 300)</span>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputImagem2" class="col-sm-3 control-label">Imagem</label>
            <div class="col-sm-9">
            	<input type="file" name="imagem2" class="form-control" id="inputImagem2" autocomplete="off" required>
                <span class="help-block">Largura (800)</span>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputFinalizar" class="col-sm-3 control-label">Finalizar Promoção</label>
            <div class="col-sm-4">
            	<input type="date" name="finalizar" class="form-control" id="inputFinalizar" autocomplete="off" required>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="checkMostrar" class="col-sm-3 control-label">Mostrar</label>
            <div class="checkbox">
                <label>
                	<input type="checkbox" name="mostrar_restrita" value="S" checked> Área Restrita
                </label>
                <label>
                	<input type="checkbox" name="mostrar_representante" value="S" checked> Área do Representante
                </label>
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
	
	$consulta = mysqli_query ($conexao, "SELECT * FROM admin_promocoes WHERE id='$id'") or die (mysqli_error());
		$dados = mysqli_fetch_array($consulta);
			$titulo		= $dados['titulo'];
			$imagem1 	= $dados['imagem1'];
			$imagem2 	= $dados['imagem2'];
			$finalizar 	= $dados['finalizar'];
			$status 	= $dados['status'];
			$data_fim	= $dados['data_fim'];
			$m_res		= $dados['mostrar_restrita'];
			$m_rep		= $dados['mostrar_representante'];
			
			$data_fim = date('d/m/y', strtotime($data_fim));
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
EDITAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<form method="post" action="funcoes/promocoes.php?funcao=editar&id=<?php echo $id; ?>" enctype="multipart/form-data" class="form-horizontal">
    <fieldset<?php if ($status == "N") { echo " disabled"; } ?>>
        <legend>Editar Promoção</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputTitulo" class="col-sm-3 control-label">Título</label>
            <div class="col-sm-9">
            	<input type="text" name="titulo" class="form-control" id="inputTitulo" autocomplete="off" required autofocus value="<?php echo $titulo; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputImagem1" class="col-sm-3 control-label">Imagem Miniatura</label>
            <div class="col-sm-9">
            	<input type="file" name="imagem1" class="form-control" id="inputImagem1" autocomplete="off">
                <span class="help-block">Tamanho (800 x 300)</span>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputImagem2" class="col-sm-3 control-label">Imagem</label>
            <div class="col-sm-9">
            	<input type="file" name="imagem2" class="form-control" id="inputImagem2" autocomplete="off">
                <span class="help-block">Largura (800)</span>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputFinalizar" class="col-sm-3 control-label">Finalizar Promoção</label>
            <div class="col-sm-4">
            	<input type="date" name="finalizar" class="form-control" id="inputFinalizar" autocomplete="off" required value="<?php echo $finalizar; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="checkMostrar" class="col-sm-3 control-label">Mostrar</label>
            <div class="checkbox">
                <label>
                	<input type="checkbox" name="mostrar_restrita" value="S"<?php if ($m_res == "S") { echo " checked"; } ?>> Área Restrita
                </label>
                <label>
                	<input type="checkbox" name="mostrar_representante" value="S"<?php if ($m_rep == "S") { echo " checked"; } ?>> Área do Representante
                </label>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
                <a href="promocoes.php" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
        
        <?php
		if ($status == "N") {
		?>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<p class="text-muted">A promoção foi finalizada em <?php echo $data_fim; ?></p>
            </div>
        </div>
        <?php
		}
		?>
    </fieldset>
</form>
<?php
}
?>
</div>

<div class="col-md-6">
<h2>Promoções Cadastradas</h2>

<?php
$i = 1;

$consulta = mysqli_query ($conexao, "SELECT * FROM admin_promocoes ORDER BY status DESC, data DESC") or die (mysqli_error());
$conta = mysqli_num_rows ($consulta);

if ($conta == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhuma promoção cadastrada
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
            <th>DATA</th>
            <th>TÍTULO</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha = mysqli_fetch_array($consulta)) {
    $id 		= $linha['id'];
	$data 		= $linha['data'];
	$titulo		= $linha['titulo'];
	$status		= $linha['status'];
	$data_fim	= $linha['data_fim'];
	
	$data = date('d/m/y', strtotime($data));
	$data_fim = date('d/m/y', strtotime($data_fim));
?>
    
    	<tr>
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><?php echo $data; ?></td>
            <td><?php echo $titulo; ?></td>
            
            <td>
			<?php 
            if ($status == "S") { ?>
                <a href="funcoes/promocoes.php?funcao=desativar&id=<?php echo $id; ?>" title="Desativar" class="btn btn-xs btn-block btn-success"><i class="fas fa-thumbs-up"></i></a>
			<?php 
            }
			if ($status == "N") {
            ?>
            	<a href="#" title="Promoção Finalizada em <?php echo $data_fim; ?>" class="btn btn-xs btn-block btn-default disabled"><i class="fas fa-thumbs-down"></i></a>
            <?php
			}
			?>
            </td>
            
            <td>
            <a href="promocoes.php?editar=<?php echo $id; ?>" class="btn btn-xs btn-block btn-warning"><i class="fas fa-pencil-alt"></i></a>
            </td>
            
            <td>
			<?php if ($perm_adm == "S") { ?>
            <a href="funcoes/promocoes.php?funcao=excluir&id=<?php echo $id; ?>" class="btn btn-xs btn-block btn-danger" onClick="return confirm('Tem certeza que deseja excluir a promoção <?php echo $titulo; ?>?')"><i class="fas fa-trash-alt"></i></a>
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
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
    	<h1>Notícias</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_noticias == "S") {
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
<form method="post" action="funcoes/noticias.php?funcao=cadastrar" enctype="multipart/form-data" class="form-horizontal">
    <fieldset>
        
        <legend>Nova Notícia</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputTitulo" class="col-sm-3 control-label">Título</label>
            <div class="col-sm-9">
            	<input type="text" name="titulo" class="form-control" id="inputTitulo" autocomplete="off" maxlength="100" required autofocus>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputNoticia" class="col-sm-3 control-label">Notícia</label>
            <div class="col-sm-9">
            	<textarea name="noticia" rows="12" class="form-control" id="inputNoticia"></textarea>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputFoto" class="col-sm-3 control-label">Foto</label>
            <div class="col-sm-9">
            	<input type="file" name="foto" class="form-control" id="inputFoto">
                <span class="help-block">Enviar foto com 700px de largura no máximo</span>
            </div>
        </div>
        
        <?php
		$consulta_galerias = mysqli_query ($conexao, "SELECT id, titulo FROM admin_galerias WHERE status='S' ORDER BY titulo") or die (mysqli_error());
		$conta_galerias = mysqli_num_rows ($consulta_galerias);
		
		if ($conta_galerias > 0) {
		?>
        <div class="form-group form-group-sm">
        	<label for="selectGaleria" class="col-sm-3 control-label">Galeria de Fotos</label>
            <div class="col-sm-9">
            	<select name="galeria" id="selectGaleria" class="form-control">
                	<option></option>
                    <?php
						while ($dados = mysqli_fetch_array ($consulta_galerias)) {
							$id_galeria 	= $dados['id'];
							$titulo 		= $dados['titulo'];
					?>
                    <option value="<?php echo $id_galeria; ?>"><?php echo $titulo; ?></option>
					<?php
						}
					?>
                </select>
            </div>
        </div>
        <?php
		}
		?>
		
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
	
	$consulta = mysqli_query ($conexao, "SELECT * FROM admin_artigos WHERE id='$id'") or die (mysqli_error());
		$dados = mysqli_fetch_array($consulta);
			$titulo		= $dados['titulo'];
			$noticia 	= $dados['noticia'];
			$foto 		= $dados['foto'];
			$galeria 	= $dados['galeria'];
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
EDITAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<form method="post" action="funcoes/noticias.php?funcao=editar&id=<?php echo $id; ?>" enctype="multipart/form-data" class="form-horizontal">
    <fieldset>
        
        <legend>Editar Notícia</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputTitulo" class="col-sm-3 control-label">Título</label>
            <div class="col-sm-9">
            	<input type="text" name="titulo" class="form-control" id="inputTitulo" autocomplete="off" maxlength="100" required autofocus value="<?php echo $titulo; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputNoticia" class="col-sm-3 control-label">Notícia</label>
            <div class="col-sm-9">
            	<textarea name="noticia" rows="12" class="form-control" id="inputNoticia"><?php echo $noticia; ?></textarea>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputFoto" class="col-sm-3 control-label">Foto</label>
            <div class="col-sm-9">
                <?php
				if ($foto == "") {
				?>
				<input type="file" name="foto" class="form-control" id="inputFoto">
                <span class="help-block">Enviar foto com 700px de largura no máximo</span>
				<?php
				} else {
				?>
				<a href="funcoes/noticias.php?funcao=excluir_foto&id=<?php echo $id; ?>" class="btn btn-danger btn-block"><i class="fas fa-trash-alt"></i> Excluir Foto</a>
                <br>
                <p><img src="../imagens/noticias/<?php echo $foto; ?>" class="img-responsive img-thumbnail"></p>
				<?php
				}
				?>
            </div>
        </div>
        
        <?php
		$consulta_galerias = mysqli_query ($conexao, "SELECT id, titulo FROM admin_galerias WHERE status='S' ORDER BY titulo") or die (mysqli_error());
		$conta_galerias = mysqli_num_rows ($consulta_galerias);
		
		if ($conta_galerias > 0) {
		?>
        <div class="form-group form-group-sm">
        	<label for="selectGaleria" class="col-sm-3 control-label">Galeria de Fotos</label>
            <div class="col-sm-9">
            	<select name="galeria" id="selectGaleria" class="form-control">
                	<option></option>
                    <?php
						while ($dados = mysqli_fetch_array ($consulta_galerias)) {
							$id_galeria 	= $dados['id'];
							$titulo 		= $dados['titulo'];
					?>
                    <option value="<?php echo $id_galeria; ?>"<?php if ($id_galeria == $galeria) { echo " selected"; } ?>><?php echo $titulo; ?></option>
					<?php
						}
					?>
                </select>
            </div>
        </div>
        <?php
		}
		?>
		
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
                <a href="noticias.php" class="btn btn-danger">Cancelar</a>
            </div>
        </div>    
    </fieldset>
</form>
<?php
}
?>
</div>

<div class="col-md-6">
<h2>Notícias Cadastradas</h2>

<?php
$i = 1;

$consulta = mysqli_query ($conexao, "SELECT * FROM admin_artigos ORDER BY data DESC") or die (mysqli_error());
$conta = mysqli_num_rows ($consulta);

if ($conta == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhuma notícia cadastrada
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
            <th>NOTÍCIA</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha = mysqli_fetch_array($consulta)) {
    $id 		= $linha['id'];
    $data		= $linha['data'];
	$titulo		= $linha['titulo'];
	$status		= $linha['status'];
	
	$data = date('d/m/y', strtotime($data));
?>
    
    	<tr>
        	<td><?php echo $i++; ?></td>
            <td><?php echo $data; ?></td>
            <td><?php echo $titulo; ?></td>
            
            <td>
			<?php 
            if ($status == "S") { ?>
                <a href="funcoes/noticias.php?funcao=desativar&id=<?php echo $id; ?>" title="Desativar" class="btn btn-xs btn-block btn-success"><i class="fas fa-thumbs-up"></i></a>
			<?php 
            } else { 
            ?>
                <a href="funcoes/noticias.php?funcao=ativar&id=<?php echo $id; ?>" title="Ativar" class="btn btn-xs btn-block btn-default"><i class="fas fa-thumbs-down"></i></a>
            <?php
            }
            ?>
            </td>
            
            <td>
            <a href="noticias.php?editar=<?php echo $id; ?>" class="btn btn-xs btn-block btn-warning"><i class="fas fa-pencil-alt"></i></a>
            </td>
            
            <td>
			<?php if ($perm_adm == "S") { ?>
            <a href="funcoes/noticias.php?funcao=excluir&id=<?php echo $id; ?>" class="btn btn-xs btn-block btn-danger" onClick="return confirm('Tem certeza que deseja excluir a notícia <?php echo $titulo; ?>?')"><i class="fas fa-trash-alt"></i></a>
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
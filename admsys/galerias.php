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
    	<h1>Galeria de Fotos</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_galerias == "S") {
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
<form method="post" action="funcoes/galerias.php?funcao=cadastrar" class="form-horizontal">
    <fieldset>
        <legend>Criar uma Nova Galeria</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputTitulo" class="col-sm-3 control-label">Título</label>
            <div class="col-sm-9">
            	<input type="text" name="titulo" class="form-control" id="inputTitulo" maxlength="100" autocomplete="off" autofocus required>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="textDescricao" class="col-sm-3 control-label">Descrição</label>
            <div class="col-sm-9">
            	<textarea name="descricao" class="form-control" rows="8" id="textDescricao" placeholder="Coloque uma descrição para a galeria de fotos" maxlength="255"></textarea>
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
    
    $consulta = mysqli_query ($conexao, "SELECT * FROM admin_galerias WHERE id='$id'") or die (mysqli_error());
        $dados = mysqli_fetch_array($consulta);
            $titulo		= $dados['titulo'];
            $descricao 	= $dados['descricao'];
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
EDITAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<form method="post" action="funcoes/galerias.php?funcao=enviar_fotos&id=<?php echo $id; ?>" enctype="multipart/form-data" class="form-horizontal">
    <fieldset>
        <legend>Fazer Upload das Fotos</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputFotos" class="col-sm-3 control-label">Foto(s)</label>
            <div class="col-sm-9">
            	<input type="file" name="img[]" class="form-control" id="inputFotos" required multiple>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary" name="upload">Enviar Fotos</button>
                <a href="galerias.php" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </fieldset>
</form>

<br><br>

<form method="post" action="funcoes/galerias.php?funcao=editar&id=<?php echo $id; ?>" class="form-horizontal">
    <fieldset>
        <legend>Editar Galeria</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputTitulo" class="col-sm-3 control-label">Título</label>
            <div class="col-sm-9">
            	<input type="text" name="titulo" class="form-control" id="inputTitulo" maxlength="100" autocomplete="off" required value="<?php echo $titulo; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="textDescricao" class="col-sm-3 control-label">Descrição</label>
            <div class="col-sm-9">
            	<textarea name="descricao" class="form-control" rows="8" id="textDescricao" placeholder="Coloque uma descrição para a galeria de fotos" maxlength="255"><?php echo $descricao; ?></textarea>
            </div>
        </div>
        
        <input type="hidden" name="titulo_atual" value="<?php echo $titulo; ?>">
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
                <a href="galerias.php" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </fieldset>
</form>

<hr>

<h2>Fotos Enviadas</h2>

<?php
$upload_dir = '../imagens/galerias/';

$consulta_dados_galeria = mysqli_query ($conexao, "SELECT data, titulo FROM admin_galerias WHERE id='$id'") or die (mysqli_error());
    $dados = mysqli_fetch_array ($consulta_dados_galeria);
        $data_galeria 	= $dados['data'];
        $titulo_galeria = $dados['titulo'];
        
$ano_galeria = date('Y', strtotime($data_galeria));

// Local das fotos
$pasta = $upload_dir . $ano_galeria . "/" .  md5($titulo_galeria) . "/";

$consulta_fotos_galeria = mysqli_query ($conexao, "SELECT id, foto FROM admin_galerias_fotos WHERE id_galeria='$id'") or die (mysqli_error());
?>
<div class="row">
<?php
while ($dados = mysqli_fetch_array ($consulta_fotos_galeria)) {
    $id_foto 	= $dados['id'];
    $foto 		= $dados['foto'];
?>
    <div class="col-xs-4 col-sm-4 col-md-3">
    	<a href="funcoes/galerias.php?funcao=excluir_foto&id_foto=<?php echo $id_foto; ?>&id_galeria=<?php echo $id; ?>" class="thumbnail" onClick="return confirm('Tem certeza que deseja excluir essa foto?')">
    		<img src="<?php echo $pasta.$foto; ?>" alt="">
    	</a>
    </div>
<?php
}
?>
</div>
<?php
}
?>
</div>

<div class="col-md-6">

<h2>Galerias Cadastradas</h2>

<?php
$i = 1;

$consulta = mysqli_query ($conexao, "SELECT * FROM admin_galerias ORDER BY data DESC") or die (mysqli_error());
$conta = mysqli_num_rows ($consulta);

if ($conta == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhuma galeria cadastrada
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
            <th>GALERIA</th>
            <th></th>
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
	
	$consulta_fotos = mysqli_query ($conexao, "SELECT id_galeria FROM admin_galerias_fotos WHERE id_galeria='$id'") or die (mysqli_error());
	$conta_fotos = mysqli_num_rows ($consulta_fotos);
?>
    
    	<tr>
        	<td><?php echo $i++; ?></td>
            <td><?php echo $data; ?></td>
            <td><?php echo $titulo; ?></td>
            
            <td>
            <button class="btn btn-xs btn-default btn-block disabled" type="button"><?php echo $conta_fotos; ?></button>
            </td>
            
            <td>
			<?php 
            if ($status == "S") { ?>
                <a href="funcoes/galerias.php?funcao=desativar&id=<?php echo $id; ?>" title="Desativar" class="btn btn-xs btn-block btn-success"><i class="fas fa-thumbs-up"></i></a>
			<?php 
            } else { 
            ?>
                <a href="funcoes/galerias.php?funcao=ativar&id=<?php echo $id; ?>" title="Ativar" class="btn btn-xs btn-block btn-default"><i class="fas fa-thumbs-down"></i></a>
            <?php
            }
            ?>
            </td>
            
            <td>
            <a href="galerias.php?editar=<?php echo $id; ?>" class="btn btn-xs btn-block btn-warning"><i class="fas fa-pencil-alt"></i></a>
            </td>
            
            <td>
			<?php if ($perm_adm == "S") { ?>
            <a href="funcoes/galerias.php?funcao=excluir&id=<?php echo $id; ?>" class="btn btn-xs btn-block btn-danger" onClick="return confirm('Tem certeza que deseja excluir a galeria <?php echo $titulo; ?>?')"><i class="fas fa-trash-alt"></i></a>
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
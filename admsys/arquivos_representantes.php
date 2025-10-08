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
    	<h1>Aquivos Representantes</h1>
    </div>
</div>

<?php
if ($perm_arquivos == "S") {
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
<form method="post" action="funcoes/arquivos.php?funcao=cadastrar_rep" class="form-horizontal" enctype="multipart/form-data">
    <fieldset>
        <legend>Enviar Arquivo</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputNome" class="col-sm-3 control-label">Nome</label>
            <div class="col-sm-9">
            	<input type="text" name="nome" class="form-control" id="inputNome" autocomplete="off" maxlength="100" required autofocus>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputDescricao" class="col-sm-3 control-label">Descrição</label>
            <div class="col-sm-9">
            	<input type="text" name="descricao" class="form-control" id="inputDescricao" autocomplete="off" maxlength="255">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="selectTipo" class="col-sm-3 control-label">Categoria</label>
            <div class="col-sm-5">
            	<select name="categoria" id="selectTipo" class="form-control" required>
                	<option></option>
                    <option value="M">Material de Divulgação</option>
                    <option value="N">Normas</option>
                    <option value="P">Procedimentos</option>
                </select>
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
        	<label for="inputArquivo" class="col-sm-3 control-label">Arquivo</label>
            <div class="col-sm-9">
            	<input type="file" name="arquivo" class="form-control" id="inputArquivo" required>
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="aviso_envio" value="S"> Não permitir o envio deste arquivo para o cliente
                    </label>
                </div>
            </div>
        </div>
        
        <br><br>
        
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
	
	$consulta = mysqli_query ($conexao, "SELECT * FROM arquivos WHERE id='$id'") or die (mysqli_error());
		$dados = mysqli_fetch_array($consulta);
			$nome 				= $dados['nome'];
			$descricao			= $dados['descricao'];
			$categoria 			= $dados['categoria'];
			$arquivo			= $dados['arquivo'];
			$aviso_envio		= $dados['aviso_envio'];
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
EDITAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<form method="post" action="funcoes/arquivos.php?funcao=editar_rep&id=<?php echo $id; ?>" class="form-horizontal">
    <fieldset>
        <legend>Editar Informações do Arquivo</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputNome" class="col-sm-3 control-label">Nome</label>
            <div class="col-sm-9">
            	<input type="text" name="nome" class="form-control" id="inputNome" autocomplete="off" maxlength="100" required autofocus value="<?php echo $nome; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputDescricao" class="col-sm-3 control-label">Descrição</label>
            <div class="col-sm-9">
            	<input type="text" name="descricao" class="form-control" id="inputDescricao" autocomplete="off" maxlength="255" value="<?php echo $descricao; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="selectTipo" class="col-sm-3 control-label">Categoria</label>
            <div class="col-sm-5">
            	<select name="categoria" id="selectTipo" class="form-control" required>
                    <option value="M"<?php if ($categoria == "M") { echo " selected"; } ?>>Material de Divulgação</option>
                    <option value="N"<?php if ($categoria == "N") { echo " selected"; } ?>>Normas</option>
                    <option value="P"<?php if ($categoria == "P") { echo " selected"; } ?>>Procedimentos</option>
                </select>
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="aviso_envio" value="S"<?php if ($aviso_envio == "S") { echo " checked"; } ?>> Não permitir o envio deste arquivo para o cliente
                    </label>
                </div>
            </div>
        </div>
        
        <input type="hidden" name="categoria_atual" value="<?php echo $categoria; ?>">
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Gravar</button>
                <a href="arquivos_representantes.php" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </fieldset>
</form>

<form method="post" action="funcoes/arquivos.php?funcao=atuarq_rep&id=<?php echo $id; ?>" class="form-horizontal" enctype="multipart/form-data">
    <fieldset>
        <legend>Atualizar Arquivo</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputArquivo" class="col-sm-3 control-label">Arquivo</label>
            <div class="col-sm-9">
            	<input type="file" name="arquivo" class="form-control" id="inputArquivo" required>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
                <a href="arquivos_representantes.php" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </fieldset>
</form>
<?php
}
?>
</div>

<div class="col-md-6">
<h2>Arquivos Cadastrados</h2>

<?php
$i = 1;

$consulta = mysqli_query ($conexao, "SELECT * FROM arquivos WHERE ativo='S' ORDER BY categoria, nome") or die (mysqli_error());
$conta = mysqli_num_rows ($consulta);

if ($conta == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhum arquivo cadastrado
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
            <th>NOME</th>
            <th>CATEGORIA</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha = mysqli_fetch_array($consulta)) {
    $id 		= $linha['id'];
    $nome		= $linha['nome'];
	$categoria	= $linha['categoria'];
	$ativo		= $linha['ativo'];
	
	switch ($categoria) {
		case "M": $categArquivo = "MATERIAIS"; break;
		case "N": $categArquivo = "NORMAS"; break;
		case "P": $categArquivo = "PROCEDIMENTOS"; break;
	}
?>
    
    	<tr>
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><?php echo $nome; ?></td>
            <td><?php echo $categArquivo; ?></td>
            
            <td>
			<?php 
            if ($ativo == "S") { ?>
                <a href="funcoes/arquivos.php?funcao=desativar_arq&id=<?php echo $id; ?>" title="Desativar" class="btn btn-xs btn-block btn-success" onClick="return confirm('Tem certeza que deseja remover esse arquivo?\n\n O arquivo será desabilitado permanentemente.')"><i class="fas fa-thumbs-up"></i></a>
			<?php 
            }
            ?>
            </td>
            
            <td>
            <a href="arquivos_representantes.php?editar=<?php echo $id; ?>" class="btn btn-xs btn-block btn-warning"><i class="fas fa-pencil-alt"></i></a>
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
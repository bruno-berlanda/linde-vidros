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
    	<h1>Níveis</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_niveis == "S") {
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
<form method="post" action="funcoes/niveis.php?funcao=cadastrar" class="form-horizontal">
    <fieldset>
        <legend>Cadastrar Nível</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputNivel" class="col-sm-3 control-label">Nível</label>
            <div class="col-sm-9">
            	<input type="text" name="nivel" class="form-control" id="inputNivel" autocomplete="off" required autofocus>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="inputNivel" class="col-sm-3 control-label">Permissões</label>
            <div class="col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_adm" value="S"> Administrador
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_noticias" value="S"> Notícias
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_galerias" value="S"> Galerias
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_produtos" value="S"> Produtos
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_vendedores" value="S"> Vendedores
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_rotas" value="S"> Rotas
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_promocoes" value="S"> Promoções
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_slides" value="S"> Slides
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_contatos" value="S"> Contatos
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_comentarios" value="S"> Comentários
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_cadastros" value="S"> Cadastros
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_pesquisa" value="S"> Pesquisa
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_curriculos" value="S"> Currículos
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_vagas" value="S"> Vagas
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_usuarios" value="S"> Usuários
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_niveis" value="S"> Níveis
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_representantes" value="S"> Representantes
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_treinamentos" value="S"> Treinamentos
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_tags" value="S"> Tags
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="perm_arquivos" value="S"> Arquivos
                    </label>
                </div>
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
	
	$consulta = mysqli_query ($conexao, "SELECT * FROM admin_niveis WHERE id='$id'") or die (mysqli_error());
		$dados = mysqli_fetch_array($consulta);
			$nivel 				= $dados['nivel'];
			$p_adm				= $dados['adm'];
			$p_noticias			= $dados['noticias'];
			$p_galerias 		= $dados['galerias'];
			$p_produtos 		= $dados['produtos'];
			$p_vendedores		= $dados['vendedores'];
			$p_rotas 			= $dados['rotas'];
			$p_promocoes		= $dados['promocoes'];
			$p_slides			= $dados['slides'];
			$p_contatos			= $dados['contatos'];
			$p_comentarios		= $dados['comentarios'];
			$p_cadastros		= $dados['cadastros'];
			$p_pesquisa			= $dados['pesquisa'];
			$p_curriculos		= $dados['curriculos'];
			$p_vagas 			= $dados['vagas'];
			$p_usuarios 		= $dados['usuarios'];
			$p_niveis 			= $dados['niveis'];
			$p_representantes 	= $dados['representantes'];
			$p_treinamentos 	= $dados['treinamentos'];
			$p_tags 			= $dados['tags'];
        $p_arquivos 			= $dados['arquivos'];
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
EDITAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<form method="post" action="funcoes/niveis.php?funcao=editar&id=<?php echo $id; ?>" class="form-horizontal">
    <fieldset>
        <legend>Editar Nível</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputNivel" class="col-sm-3 control-label">Nível</label>
            <div class="col-sm-9">
            	<input type="text" name="nivel" class="form-control" id="inputNivel" autocomplete="off" required autofocus value="<?php echo $nivel; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="inputNivel" class="col-sm-3 control-label">Permissões</label>
            <div class="col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_adm" value="S"<?php if ($p_adm == "S") { echo " checked"; } ?>> Administrador
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_noticias" value="S"<?php if ($p_noticias == "S") { echo " checked"; } ?>> Notícias
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_galerias" value="S"<?php if ($p_galerias == "S") { echo " checked"; } ?>> Galerias
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_produtos" value="S"<?php if ($p_produtos == "S") { echo " checked"; } ?>> Produtos
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_vendedores" value="S"<?php if ($p_vendedores == "S") { echo " checked"; } ?>> Vendedores
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_rotas" value="S"<?php if ($p_rotas == "S") { echo " checked"; } ?>> Rotas
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_promocoes" value="S"<?php if ($p_promocoes == "S") { echo " checked"; } ?>> Promoções
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_slides" value="S"<?php if ($p_slides == "S") { echo " checked"; } ?>> Slides
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_contatos" value="S"<?php if ($p_contatos == "S") { echo " checked"; } ?>> Contatos
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_comentarios" value="S"<?php if ($p_comentarios == "S") { echo " checked"; } ?>> Comentários
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_cadastros" value="S"<?php if ($p_cadastros == "S") { echo " checked"; } ?>> Cadastros
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_pesquisa" value="S"<?php if ($p_pesquisa == "S") { echo " checked"; } ?>> Pesquisa
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_curriculos" value="S"<?php if ($p_curriculos == "S") { echo " checked"; } ?>> Currículos
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_vagas" value="S"<?php if ($p_vagas == "S") { echo " checked"; } ?>> Vagas
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_usuarios" value="S"<?php if ($p_usuarios == "S") { echo " checked"; } ?>> Usuários
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_niveis" value="S"<?php if ($p_niveis == "S") { echo " checked"; } ?>> Níveis
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_representantes" value="S"<?php if ($p_representantes == "S") { echo " checked"; } ?>> Representantes
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_treinamentos" value="S"<?php if ($p_treinamentos == "S") { echo " checked"; } ?>> Treinamentos
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="perm_tags" value="S"<?php if ($p_tags == "S") { echo " checked"; } ?>> Tags
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="perm_arquivos" value="S"<?php if ($p_arquivos == "S") { echo " checked"; } ?>> Arquivos
                    </label>
                </div>
            </div>
        </div>
        
        <input type="hidden" name="nivel_atual" value="<?php echo $nivel; ?>">
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
                <a href="niveis.php" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </fieldset>
</form>
<?php
}
?>
</div>

<div class="col-md-6">
<h2>Níveis Cadastrados</h2>

<?php
$i = 1;

$consulta = mysqli_query ($conexao, "SELECT * FROM admin_niveis WHERE id!='1' ORDER BY nivel") or die (mysqli_error());
$conta = mysqli_num_rows ($consulta);

if ($conta == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhum nível cadastrado
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
            <th>NÍVEL</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha = mysqli_fetch_array($consulta)) {
    $id 		= $linha['id'];
    $nivel		= $linha['nivel'];
	$ativo		= $linha['ativo'];
?>
    
    	<tr>
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><?php echo $nivel; ?></td>
            
            <td>
			<?php 
            if ($ativo == "S") { ?>
                <a href="funcoes/niveis.php?funcao=desativar&id=<?php echo $id; ?>" title="Desativar" class="btn btn-xs btn-block btn-success"><i class="fas fa-thumbs-up"></i></a>
			<?php 
            } else { 
            ?>
                <a href="funcoes/niveis.php?funcao=ativar&id=<?php echo $id; ?>" title="Ativar" class="btn btn-xs btn-block btn-default"><i class="fas fa-thumbs-down"></i></a>
            <?php
            }
            ?>
            </td>
            
            <td>
            <a href="niveis.php?editar=<?php echo $id; ?>" class="btn btn-xs btn-block btn-warning"><i class="fas fa-pencil-alt"></i></a>
            </td>
            
            <td>
			<?php if ($perm_adm == "S") { ?>
            <a href="funcoes/niveis.php?funcao=excluir&id=<?php echo $id; ?>" class="btn btn-xs btn-block btn-danger" onClick="return confirm('Tem certeza que deseja excluir o nível <?php echo $nivel; ?>?')"><i class="fas fa-trash-alt"></i></a>
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
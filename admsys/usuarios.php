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
    	<h1>Usuários</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_usuarios == "S") {
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
<form method="post" action="funcoes/usuarios.php?funcao=cadastrar" class="form-horizontal">
    <fieldset>
        <legend>Cadastrar Usuário</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputNome" class="col-sm-3 control-label">Nome</label>
            <div class="col-sm-9">
            	<input type="text" name="nome" class="form-control" id="inputNome" autocomplete="off" required autofocus>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputUsuario" class="col-sm-3 control-label">Usuário</label>
            <div class="col-sm-5">
            	<input type="text" name="usuario" class="form-control" id="inputUsuario" autocomplete="off" required>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputSenha" class="col-sm-3 control-label">Senha</label>
            <div class="col-sm-5">
            	<input type="password" name="senha" class="form-control" id="inputSenha" required>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputEmail" class="col-sm-3 control-label">E-mail</label>
            <div class="col-sm-9">
            	<input type="email" name="email" class="form-control" id="inputEmail" autocomplete="off">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="selectNivel" class="col-sm-3 control-label">Nível</label>
            <div class="col-sm-9">
            	<select name="nivel" id="selectNivel" class="form-control" required>
                	<option></option>
                    <?php
					$consulta_niveis = mysqli_query ($conexao, "SELECT id, nivel FROM admin_niveis WHERE ativo='S' AND id!='1' ORDER BY nivel") or die (mysqli_error());
						while ($dados = mysqli_fetch_array ($consulta_niveis)) {
							$id_nivel 	= $dados['id'];
							$nivel 		= $dados['nivel'];
					?>
                    <option value="<?php echo $id_nivel; ?>"><?php echo $nivel; ?></option>
					<?php
						}
					?>
                </select>
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
	
	$consulta = mysqli_query ($conexao, "SELECT * FROM admin_usuarios WHERE id='$id'") or die (mysqli_error());
		$dados = mysqli_fetch_array($consulta);
			$nome 			= $dados['nome'];
			$usuario		= $dados['login'];
			$email 			= $dados['email'];
			$nivel_bd 		= $dados['nivel'];
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
EDITAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<form method="post" action="funcoes/usuarios.php?funcao=editar&id=<?php echo $id; ?>" class="form-horizontal">
    <fieldset>
        <legend>Editar Usuário</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputNome" class="col-sm-3 control-label">Nome</label>
            <div class="col-sm-9">
            	<input type="text" name="nome" class="form-control" id="inputNome" autocomplete="off" required autofocus value="<?php echo $nome; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputUsuario" class="col-sm-3 control-label">Usuário</label>
            <div class="col-sm-5">
            	<input type="text" name="usuario" class="form-control" id="inputUsuario" autocomplete="off" required value="<?php echo $usuario; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputSenha" class="col-sm-3 control-label">Senha</label>
            <div class="col-sm-5">
            	<input type="password" name="senha" class="form-control" id="inputSenha">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputEmail" class="col-sm-3 control-label">E-mail</label>
            <div class="col-sm-9">
            	<input type="email" name="email" class="form-control" id="inputEmail" autocomplete="off" value="<?php echo $email; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="selectNivel" class="col-sm-3 control-label">Nível</label>
            <div class="col-sm-9">
            	<select name="nivel" id="selectNivel" class="form-control" required>
                	<option></option>
                    <?php
					$consulta_niveis = mysqli_query ($conexao, "SELECT id, nivel FROM admin_niveis WHERE ativo='S' AND id!='1' ORDER BY nivel") or die (mysqli_error());
						while ($dados = mysqli_fetch_array ($consulta_niveis)) {
							$id_nivel 	= $dados['id'];
							$nivel 		= $dados['nivel'];
					?>
                    <option value="<?php echo $id_nivel; ?>"<?php if ($id_nivel == $nivel_bd) { echo " selected"; } ?>><?php echo $nivel; ?></option>
					<?php
						}
					?>
                </select>
            </div>
        </div>
        
        <input type="hidden" name="nome_atual" value="<?php echo $nome; ?>">
        <input type="hidden" name="usuario_atual" value="<?php echo $usuario; ?>">
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
                <a href="usuarios.php" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </fieldset>
</form>
<?php
}
?>
</div>

<div class="col-md-6">
<h2>Usuários Cadastrados</h2>

<?php
$i = 1;

$consulta = mysqli_query ($conexao, "SELECT * FROM admin_usuarios WHERE ativo='1' AND id!='1' ORDER BY nivel, nome") or die (mysqli_error());
$conta = mysqli_num_rows ($consulta);

if ($conta == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhum usuário cadastrado
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
            <th>NÍVEL</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha = mysqli_fetch_array($consulta)) {
    $id 		= $linha['id'];
    $nome		= $linha['nome'];
	$nivel		= $linha['nivel'];
	
	$consulta_nivel = mysqli_query ($conexao, "SELECT nivel FROM admin_niveis WHERE id='$nivel'") or die (mysqli_error());
		$dados = mysqli_fetch_array ($consulta_nivel);
			$nome_nivel = $dados['nivel'];
?>
    
    	<tr>
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><?php echo $nome; ?></td>
            <td><?php echo $nome_nivel; ?></td>
            
            <td>
            <a href="usuarios.php?editar=<?php echo $id; ?>" class="btn btn-xs btn-block btn-warning"><i class="fas fa-pencil-alt"></i></a>
            </td>
            
            <td>
			<?php if ($perm_adm == "S") { ?>
            <a href="funcoes/usuarios.php?funcao=excluir&id=<?php echo $id; ?>" class="btn btn-xs btn-block btn-danger" onClick="return confirm('Tem certeza que deseja excluir o usuário <?php echo nome_sobrenome($nome); ?>?')"><i class="fas fa-trash-alt"></i></a>
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
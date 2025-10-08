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
    	<h1>Rotas</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_rotas == "S") {
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
<form method="post" action="funcoes/rotas.php?funcao=cadastrar" class="form-horizontal">
    <fieldset>
        <legend>Cadastrar Rota</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputRota" class="col-sm-3 control-label">Rota</label>
            <div class="col-sm-3">
            	<input type="text" name="rota" class="form-control" id="inputRota" maxlength="3" autocomplete="off" required autofocus>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="selectUF" class="col-sm-3 control-label">UF</label>
            <div class="col-sm-2">
            	<select name="uf" id="selectUF" class="form-control" required>
                	<option></option>
                    <option value="MG">MG</option>
                    <option value="RS">RS</option>
                    <option value="SC">SC</option>
                    <option value="PR">PR</option>
                    <option value="SP">SP</option>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="selectVendedor" class="col-sm-3 control-label">Vendedor</label>
            <div class="col-sm-9">
            	<select name="vendedor" id="selectVendedor" class="form-control" required>
                	<option></option>
                    <?php
					$consultaVendedores = mysqli_query ($conexao, "SELECT id, nome FROM representantes WHERE tipo='V' AND ativo='S' ORDER BY nome") or die (mysqli_error());
					while ($dados = mysqli_fetch_array ($consultaVendedores)) {
						$idVendedor 	= $dados['id'];
						$nomeVendedor 	= $dados['nome'];
					?>
					<option value="<?php echo $idVendedor; ?>"><?php echo nome_sobrenome($nomeVendedor); ?></option>
					<?php
						}
					?>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="selectSegmento" class="col-sm-3 control-label">Segmento</label>
            <div class="col-sm-4">
            	<select name="segmento" id="selectSegmento" class="form-control" required>
                	<option></option>
                    <option value="ENG">ENGENHARIA</option>
					<option value="MOV">MOVELEIRO</option>
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
	
	$consulta = mysqli_query ($conexao, "SELECT * FROM admin_rotas WHERE id='$id'") or die (mysqli_error());
		$dados = mysqli_fetch_array($consulta);
			$rota 		= $dados['rota'];
			$uf			= $dados['uf'];
			$vendedor 	= $dados['vendedor'];
			$produto	= $dados['produto'];
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
EDITAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<form method="post" action="funcoes/rotas.php?funcao=editar&id=<?php echo $id; ?>" class="form-horizontal">
    <fieldset>
        <legend>Editar Rota</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputRota" class="col-sm-3 control-label">Rota</label>
            <div class="col-sm-3">
            	<input type="text" name="rota" class="form-control" id="inputRota" maxlength="3" autocomplete="off" required value="<?php echo $rota; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="selectUF" class="col-sm-3 control-label">UF</label>
            <div class="col-sm-2">
            	<select name="uf" id="selectUF" class="form-control" required>
                	<option></option>
                    <option value="MG"<?php if ($uf == "MG") { echo " selected"; } ?>>MG</option>
                    <option value="RS"<?php if ($uf == "RS") { echo " selected"; } ?>>RS</option>
                    <option value="SC"<?php if ($uf == "SC") { echo " selected"; } ?>>SC</option>
                    <option value="PR"<?php if ($uf == "PR") { echo " selected"; } ?>>PR</option>
                    <option value="SP"<?php if ($uf == "SP") { echo " selected"; } ?>>SP</option>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="selectVendedor" class="col-sm-3 control-label">Vendedor</label>
            <div class="col-sm-9">
            	<select name="vendedor" id="selectVendedor" class="form-control" required>
                	<option></option>
                    <?php
					$consultaVendedores = mysqli_query ($conexao, "SELECT id, nome FROM representantes WHERE tipo='V' AND segmento='$produto' AND ativo='S' ORDER BY nome") or die (mysqli_error());
					while ($dados = mysqli_fetch_array ($consultaVendedores)) {
						$idVendedor 	= $dados['id'];
						$nomeVendedor 	= $dados['nome'];
					?>
					<option value="<?php echo $idVendedor; ?>"<?php if ($vendedor == $idVendedor) { echo " selected"; } ?>><?php echo nome_sobrenome($nomeVendedor); ?></option>
					<?php
						}
					?>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="selectSegmento" class="col-sm-3 control-label">Segmento</label>
            <div class="col-sm-4">
            	<select name="segmento" id="selectSegmento" class="form-control" required>
                	<option></option>
                    <option value="ENG"<?php if ($produto == "ENG") { echo " selected"; } ?>>ENGENHARIA</option>
					<option value="MOV"<?php if ($produto == "MOV") { echo " selected"; } ?>>MOVELEIRO</option>
                </select>
            </div>
        </div>
        
        <input type="hidden" name="vendedor_atual" value="<?php echo $vendedor; ?>">
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </fieldset>
</form>

<hr>

<div class="well">
<form method="post" action="funcoes/rotas.php?funcao=cadastrar_cidade&id=<?php echo $id; ?>" class="form-horizontal">
    <fieldset>
        <legend>Cadastrar Cidade</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputCidade" class="col-sm-3 control-label">Cidade</label>
            <div class="col-sm-9">
            	<input type="text" name="cidade" class="form-control" id="inputCidade" autocomplete="off" required autofocus>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary btn-sm">Gravar</button>
                <a href="rotas.php" class="btn btn-danger btn-sm">Cancelar</a>
            </div>
        </div>
    </fieldset>
</form>
</div>
<?php
}
?>
</div>

<div class="col-md-6">
<?php
/* *******************************************************************************************************************************************
SE NÃO ESTIVER NA TELA DE EDITAR - MOSTRA AS ROTAS CADASTRADAS
******************************************************************************************************************************************* */
if (!isset($_GET['editar'])) {
?>
<h2>Rotas Cadastradas</h2>

<?php
$i = 1;

$consulta = mysqli_query ($conexao, "SELECT * FROM admin_rotas ORDER BY produto, rota, uf") or die (mysqli_error());
$conta = mysqli_num_rows ($consulta);

if ($conta == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhuma rota cadastrada
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
            <th>SEG</th>
            <th>ROTA</th>
            <th>VENDEDOR</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha = mysqli_fetch_array($consulta)) {
    $id 		= $linha['id'];
    $rota		= $linha['rota'];
	$uf			= $linha['uf'];
	$vendedor	= $linha['vendedor'];
	$produto	= $linha['produto'];
	$ativo		= $linha['ativo'];
	
	switch ($produto) {
		case "ENG":
			$cor_p = "text-success";
			break;
		case "MOV":	
			$cor_p = "text-danger";
			break;
	}
	
	$consultaVendedor = mysqli_query ($conexao, "SELECT nome FROM representantes WHERE id='$vendedor'") or die (mysqli_error());
		$dados = mysqli_fetch_array ($consultaVendedor);
			$nomeVendedor = $dados['nome'];
?>
    
    	<tr class="<?php echo $cor_p; ?>">
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><strong><?php echo $produto; ?></strong></td>
            <td><?php echo $rota; ?> (<?php echo $uf; ?>)</td>
            <td><?php echo nome_sobrenome($nomeVendedor); ?></td>
           
            <td>
			<?php 
            if ($ativo == "1") { ?>
                <a href="funcoes/rotas.php?funcao=desativar&id=<?php echo $id; ?>" title="Desativar" class="btn btn-xs btn-block btn-success"><i class="fas fa-thumbs-up"></i></a>
			<?php 
            } else { 
            ?>
                <a href="funcoes/rotas.php?funcao=ativar&id=<?php echo $id; ?>" title="Ativar" class="btn btn-xs btn-block btn-default"><i class="fas fa-thumbs-down"></i></a>
            <?php
            }
            ?>
            </td>
            
            <td>
            <a href="rotas.php?editar=<?php echo $id; ?>" class="btn btn-xs btn-block btn-warning"><i class="fas fa-pencil-alt"></i></a>
            </td>
            
            <td>
			<?php if ($perm_adm == "S") { ?>
            <a href="funcoes/rotas.php?funcao=excluir&id=<?php echo $id; ?>" class="btn btn-xs btn-block btn-danger" onClick="return confirm('Tem certeza que deseja excluir a rota <?php echo $rota; ?> - <?php echo nome_sobrenome($nomeVendedor); ?>?')"><i class="fas fa-trash-alt"></i></a>
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
<?php
} // If !isset $_GET['editar']
/* *******************************************************************************************************************************************
SE ESTIVER NA TELA DE EDITAR - MOSTRA AS CIDADES CADASTRADAS
******************************************************************************************************************************************* */
else {
?>
<h2>Cidades Cadastradas</h2>

<?php
$id_rota = $_GET['editar'];

$i = 1;

$consulta = mysqli_query ($conexao, "SELECT * FROM admin_cidades WHERE id_rota='$id_rota' ORDER BY cidade") or die (mysqli_error());
$conta = mysqli_num_rows ($consulta);

if ($conta == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhuma cidade cadastrada para essa rota
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
            <th>CIDADE</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha = mysqli_fetch_array($consulta)) {
    $id_cidade	= $linha['id'];
    $cidade		= $linha['cidade'];
	$ativo		= $linha['ativo'];
?>
    
    	<tr>
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><?php echo $cidade; ?></td>

            <td>
			<?php 
            if ($ativo == "1") { ?>
                <a href="funcoes/rotas.php?funcao=desativar_cidade&id=<?php echo $id_cidade; ?>&id_rota=<?php echo $id; ?>" title="Desativar" class="btn btn-xs btn-block btn-success"><i class="fas fa-thumbs-up"></i></a>
			<?php 
            } else { 
            ?>
                <a href="funcoes/rotas.php?funcao=ativar_cidade&id=<?php echo $id_cidade; ?>&id_rota=<?php echo $id; ?>" title="Ativar" class="btn btn-xs btn-block btn-default"><i class="fas fa-thumbs-down"></i></a>
            <?php
            }
            ?>
            </td>
            
            <td>
			<?php if ($perm_adm == "S") { ?>
            <a href="funcoes/rotas.php?funcao=excluir_cidade&id=<?php echo $id_cidade; ?>&id_rota=<?php echo $id; ?>" class="btn btn-xs btn-block btn-danger" onClick="return confirm('Tem certeza que deseja excluir a cidade <?php echo $cidade; ?>?')"><i class="fas fa-trash-alt"></i></a>
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
}  // If isset $_GET['editar']
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
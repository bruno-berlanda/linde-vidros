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
    	<h1>Cadastro de Clientes</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_cadastros == "S") {
?>

<?php
include_once("includes/msgs.php");
?>

<div class="row">
<div class="col-md-12">
<?php
$consulta_cliente = mysqli_query ($conexao, "SELECT id, cnpj, razao, criado, liberado, nome, cidade, uf, vendedor FROM clientes WHERE tipo='1' ORDER BY criado DESC") or die (mysqli_error());
$conta_clientes = mysqli_num_rows ($consulta_cliente);
	
$titulo_clientes = "CADASTRO DE CLIENTES LINDE";


$i = 1;

if ($conta_clientes == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhum cliente cadastrado
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
            <th>CADASTRO</th>
            <th>EMPRESA</th>
            <th>CIDADE / UF</th>
            <?php if (!isset($_GET['mostrar']) || $_GET['mostrar'] == "clientes") { ?><th>VENDEDOR</th><?php } ?>
            <th>ÚLTIMO ACESSO</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha = mysqli_fetch_array($consulta_cliente)) {
    $id 		= $linha['id'];
	$cnpj 		= $linha['cnpj'];
    $razao 		= $linha['razao'];
	$criado 	= $linha['criado'];
	$liberado 	= $linha['liberado'];
	$nome 		= $linha['nome'];
	$cidade 	= $linha['cidade'];
	$uf			= $linha['uf'];
	$vendedor	= $linha['vendedor'];
	
	$criado = substr($criado,8,2) . "/" .substr($criado,5,2) . "/" . substr($criado,2,2);
	
	$consulta_logins = mysqli_query ($conexao, "SELECT data, hora FROM login_clientes WHERE cnpj='$cnpj' GROUP BY data, hora ORDER BY data DESC, hora DESC") or die (mysqli_error());
		$conta_logins = mysqli_num_rows ($consulta_logins);
		
		$info = mysqli_fetch_array ($consulta_logins);
			$data_login = $info['data'];
			$hora_login = $info['hora'];
			
			$data_login = substr($data_login,8,2) . "/" .substr($data_login,5,2) . "/" . substr($data_login,0,4);
			$hora_login = substr($hora_login,0,2) . ":" .substr($hora_login,3,2);
?>
    
    	<tr>
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><?php echo $criado; ?></td>
    		<td><?php echo $nome; ?> <br> <span class="text-muted"><small><?php echo $razao; ?></small></span></td>
    		<td><?php echo $cidade; ?> / <?php echo $uf; ?></td>
    		<?php if (!isset($_GET['mostrar']) || $_GET['mostrar'] == "clientes") { ?><td><?php echo $vendedor; ?></td><?php } ?>
            
            <td>
            <?php if ($liberado == "1" && $conta_logins > 0) { ?>
            <p class="text-muted"><?php echo $data_login." ".$hora_login; ?></p>
            <?php } ?>
            </td>
            
            <td>
            <?php if ($liberado == "1" && $conta_logins > 0) { ?>
            <button class="btn btn-xs btn-default btn-block disabled" type="button" title="Qtde de Acessos"><?php echo $conta_logins; ?></button>
            <?php } ?>
            </td>
            
            <td>
            <?php if ($liberado == "1") { ?>
            <button class="btn btn-xs btn-block btn-success disabled" type="button"><i class="fas fa-thumbs-up"></i></button>
            <?php } else if ($liberado == "0") { ?>
            <button class="btn btn-xs btn-block btn-default disabled" type="button"><i class="fas fa-thumbs-down"></i></button>
            <?php } ?>
            </td>
            
            <td>
            <a href="cadastros_ver.php?cliente=<?php echo $id; ?>" class="btn btn-xs btn-block btn-primary"><i class="fas fa-search"></i></a>
            </td>
            
            <td>
            <?php if ($perm_adm == "S") { ?>
            <a href="funcoes/cadastros.php?funcao=excluir&id=<?php echo $id; ?>" class="btn btn-xs btn-block btn-danger" onClick="return confirm('Tem certeza que deseja excluir o cliente <?php echo $nome; ?> (<?php echo $razao; ?>)?')"><i class="fas fa-trash-alt"></i></a>
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
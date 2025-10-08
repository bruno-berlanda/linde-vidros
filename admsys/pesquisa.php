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
    	<h1>Pesquisa de Satisfação</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_pesquisa == "S") {
?>

<?php
include_once("includes/msgs.php");
?>

<?php
if (!isset($_GET['editar'])) {
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
CADASTRAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<div class="row">
<div class="col-md-4">

<form method="post" action="funcoes/pesquisa.php?funcao=cadastrar" class="form-horizontal">
    <fieldset>
        <legend>Nova Pesquisa</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputNome" class="col-sm-3 control-label">Nome</label>
            <div class="col-sm-9">
            	<input type="text" name="nome" class="form-control" id="inputNome" autocomplete="off" required autofocus>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </fieldset>
</form>

</div>
<div class="col-md-8">

<h2>Pesquisas</h2>

<?php
$i = 1;

$consulta = mysqli_query ($conexao, "SELECT * FROM pesquisa ORDER BY data DESC") or die (mysqli_error());
$conta = mysqli_num_rows ($consulta);

if ($conta == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhuma pesquisa cadastrada
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
            <th>NOME</th>
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
	$nome		= $linha['nome'];
	
	$data = date('d/m/Y H:i', strtotime($data));
	
	$consulta_respondidos = mysqli_query ($conexao, "SELECT id FROM pesquisa_clientes WHERE id_pesquisa='$id' AND status='R'") or die (mysqli_error());
		$conta_respondidos = mysqli_num_rows ($consulta_respondidos);
?>
    
    	<tr>
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><?php echo $data; ?></td>
            <td><?php echo $nome; ?></td>
            
            <td>
            <?php
			if ($conta_respondidos > 0) {
			?>
            <a href="pesquisa_relatorio.php?pesquisa=<?php echo $id; ?>" target="_blank" class="btn btn-xs btn-success btn-block"><i class="fas fa-list-ul"></i> <?php echo $conta_respondidos; ?></a>
            <?php
			} else {
			?>
            <button class="btn btn-xs btn-default btn-block disabled"><i class="fas fa-list-ul"></i> <?php echo $conta_respondidos; ?></button>
            <?php
			}
			?>
            </td>
            
            <td>
            <a href="pesquisa.php?editar=<?php echo $id; ?>" class="btn btn-xs btn-block btn-warning"><i class="fas fa-pencil-alt"></i></a>
            </td>
            
            <td>
			<?php if ($perm_adm == "S") { ?>
            <a href="funcoes/pesquisa.php?funcao=excluir&id=<?php echo $id; ?>" class="btn btn-xs btn-block btn-danger" onClick="return confirm('Tem certeza que deseja excluir a pesquisa <?php echo $nome; ?>?')"><i class="fas fa-trash-alt"></i></a>
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
}
else if (isset($_GET['editar'])) {
	
	$id = $_GET['editar'];
	
	$consulta = mysqli_query ($conexao, "SELECT * FROM pesquisa WHERE id='$id'") or die (mysqli_error());
		$dados = mysqli_fetch_array($consulta);
			$nome			= $dados['nome'];
			$ultimo_alerta	= $dados['ultimo_alerta'];
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
EDITAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<div class="row">

<div class="col-md-4">

<form method="post" action="funcoes/pesquisa.php?funcao=editar&id=<?php echo $id; ?>" class="form-horizontal">
    <fieldset>
        <legend>Editar Pesquisa</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputNome" class="col-sm-3 control-label">Nome</label>
            <div class="col-sm-9">
            	<input type="text" name="nome" class="form-control" id="inputNome" autocomplete="off" required value="<?php echo $nome; ?>">
            </div>
        </div>
        
        <input type="hidden" name="nome_atual" value="<?php echo $nome; ?>">
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
                <a href="pesquisa.php" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </fieldset>
</form>

</div>

<div class="col-md-8">

<form method="post" action="funcoes/pesquisa.php?funcao=cad_cliente&id_pesquisa=<?php echo $id; ?>" class="form-inline">
    
    <legend>Adicione Cliente</legend>
    
    <div class="form-group form-group-sm">
    	<label for="inputCliente">Cod Cliente</label>
    	<input type="text" name="cliente" class="form-control" id="inputCliente" autocomplete="off" required autofocus>
    </div>
    <div class="form-group form-group-sm">
    	<label for="inputResponsavel">Responsável</label>
    	<input type="text" name="responsavel" class="form-control" id="inputResponsavel" autocomplete="off" required>
    </div>
	
    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Incluir Cliente</button>
</form>

<br>

<small><div id="resultado" class="text-muted"></div></small>

<!-- Verifica Código Cliente -->
<script type="text/javascript">
$(function(){
	$("input[name='cliente']").blur( function(){
		var cliente = $("input[name='cliente']").val();
		$.post('funcoes/verifica_cliente.php',{cliente: cliente},function(data){
			$('#resultado').html(data);
		});
	});
});
</script>

<hr>

<ul class="nav nav-tabs" role="tablist">
	<li role="presentation"><a href="#respondido" aria-controls="respondido" role="tab" data-toggle="tab">Pesquisas Respondidas</a></li>
	<li role="presentation" class="active"><a href="#pendente" aria-controls="pendente" role="tab" data-toggle="tab">Pesquisas Pendentes</a></li>
</ul>

<div class="tab-content">
<div role="tabpanel" class="tab-pane" id="respondido">
<h2>Pesquisas Respondidas</h2>

<?php
$r = 1;

$consulta_res = mysqli_query ($conexao, "SELECT id, data, cod_cliente, nome_cliente, rota, responsavel, email, status, data_resposta FROM pesquisa_clientes WHERE id_pesquisa='$id' AND status='R' ORDER BY data_resposta DESC") or die (mysqli_error());
$conta_res = mysqli_num_rows ($consulta_res);

if ($conta_res == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhuma pesquisa respondida
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
            <th>DATA</th>
            <th>CLIENTE</th>
            <th>RESPONSÁVEL</th>
            <th>RESPOSTA</th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha_res = mysqli_fetch_array($consulta_res)) {
    $r_id 			= $linha_res['id'];
	$r_data 		= $linha_res['data'];
    $r_cod			= $linha_res['cod_cliente'];
	$r_razao		= $linha_res['nome_cliente'];
	$r_rota			= $linha_res['rota'];
	$r_responsavel	= $linha_res['responsavel'];
	$r_email		= $linha_res['email'];
	$r_status		= $linha_res['status'];
	$r_resposta		= $linha_res['data_resposta'];
	
	$r_data 		= date('d/m/Y H:i', strtotime($r_data));
	$r_resposta 	= date('d/m/Y H:i', strtotime($r_resposta));
?>
    
    	<tr>
        	<td class="text-muted"><?php echo $r++; ?></td>
            <td>
            <?php
			if ($r_status == "P") {
			?>
            <img src="img/img_pesquisa_nao.png" alt="">
            <?php
			} else {
			?>
            <img src="img/img_pesquisa_sim.png" alt="">
            <?php
			}
			?>
            </td>            
            <td class="text-muted"><?php echo $r_data; ?></td>
            <td><?php echo $r_cod; ?> - <?php echo $r_razao; ?> <br> <small class="text-muted">ROTA <?php echo $r_rota; ?></small></td>
            <td><?php echo $r_responsavel; ?> <br> <small class="text-muted"><?php echo $r_email; ?></small></td>
            
            <td>
            <?php
			if ($r_status == "R") {
			?>
            <?php echo $r_resposta; ?>
            <?php
			}
			?>
            </td>
            
            <td>
            <?php
			if ($r_status == "R") {
			?>
            <a href="pesquisa_ver.php?pesquisa=<?php echo $id; ?>&resposta=<?php echo $r_id; ?>" class="btn btn-xs btn-block btn-primary" target="_blank"><i class="fas fa-search"></i></a>
            <?php
			} else {
			?>
            <a href="#" class="btn btn-xs btn-block btn-default disabled"><i class="fas fa-search"></i></a>
            <?php
			}
			?>
            </td> 
        </tr>
 <?php } ?>

	</tbody>
</table>
<?php 
} 
?>
</div>
<div role="tabpanel" class="tab-pane active" id="pendente">
<h2>Pesquisas Pendentes</h2>

<?php
$c = 1;

$consulta_cli = mysqli_query ($conexao, "SELECT id, data, cod_cliente, nome_cliente, rota, responsavel, email, status, ultimo_alerta, data_resposta FROM pesquisa_clientes WHERE id_pesquisa='$id' AND status='P' ORDER BY data DESC") or die (mysqli_error());
$conta_cli = mysqli_num_rows ($consulta_cli);

if ($conta_cli == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhum cliente adicionado nesta pesquisa
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
            <th>DATA</th>
            <th>CLIENTE</th>
            <th>RESPONSÁVEL</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha_cli = mysqli_fetch_array($consulta_cli)) {
    $c_id 			= $linha_cli['id'];
	$c_data 		= $linha_cli['data'];
    $c_cod			= $linha_cli['cod_cliente'];
	$c_razao		= $linha_cli['nome_cliente'];
	$c_rota			= $linha_cli['rota'];
	$c_responsavel	= $linha_cli['responsavel'];
	$c_email		= $linha_cli['email'];
	$c_status		= $linha_cli['status'];
	$c_alerta		= $linha_cli['ultimo_alerta'];

	$c_data 		= date('d/m/Y H:i', strtotime($c_data));
?>
    
    	<tr>
        	<td class="text-muted"><?php echo $c++; ?></td>
            <td>
            <?php
			if ($c_status == "P") {
			?>
            <img src="img/img_pesquisa_nao.png" alt="">
            <?php
			} else {
			?>
            <img src="img/img_pesquisa_sim.png" alt="">
            <?php
			}
			?>
            </td>            
            <td><?php echo $c_data; ?></td>
            <td><?php echo $c_cod; ?> - <?php echo $c_razao; ?> <br> <small class="text-muted">ROTA <?php echo $c_rota; ?></small></td>
            <td><?php echo $c_responsavel; ?> <br> <small class="text-muted"><?php echo $c_email; ?></small></td>
            
            <td>
            <?php
			// Próximo Alerta
			$proximo_alerta = date('Y-m-d', strtotime("+7 days", strtotime($c_alerta))); 
			
			if ($data_hoje >= $proximo_alerta) {
			?>
			<a href="funcoes/pesquisa.php?funcao=reenviar_email&id=<?php echo $c_id; ?>" class="btn btn-warning btn-xs btn-block" onClick="return confirm('Tem certeza que deseja enviar um alerta para este cliente?')"><i class="fas fa-envelope"></i></a>
			<?php
			}
			else {
				$proximo_alerta = date('d/m/Y', strtotime($proximo_alerta));
			?>
			<button class="btn btn-default btn-xs btn-block disabled" title="Você poderá enviar novo alerta para essa pesquisa no dia <strong><?php echo $proximo_alerta; ?>"><i class="fas fa-envelope"></i></a></button>
			<?php
			}
			?>
            </td>
            
            <td>
			<?php if ($c_status == "P") { ?>
            <a href="funcoes/pesquisa.php?funcao=excluir_cliente&id=<?php echo $c_id; ?>&id_pesquisa=<?php echo $id; ?>" class="btn btn-xs btn-block btn-danger" onClick="return confirm('Tem certeza que deseja excluir o cliente <?php echo $c_razao; ?> desta pesquisa?')"><i class="fas fa-trash-alt"></i></a>
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

</div>

</div>


<?php
}
?>

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
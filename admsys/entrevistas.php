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
    	<h1>Entrevistas</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_curriculos == "S") {
?>

<?php
include_once("includes/msgs.php");
?>

<div class="row">
<div class="col-md-3">
    <div class="well">
    <form method="post" action="entrevistas.php" class="form-horizontal">
        <fieldset>
            <legend>Filtrar por Data</legend>
            
            <div class="form-group form-group-sm">
                <label for="inputData" class="col-sm-3 control-label">Data</label>
                <div class="col-sm-9">
                    <input type="text" name="data" class="form-control" id="inputData" autocomplete="off" required autofocus>
                </div>
            </div>
            
            <div class="form-group form-group-sm">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </fieldset>
    </form>
    </div>
</div>

<div class="col-md-9">
<?php
if (isset($_POST['data'])) {
	$data_filtro = $_POST['data'];
	
	$data_filtro = explode('/',$data_filtro);
        $dia = $data_filtro[0];
        $mes = $data_filtro[1];
        $ano = $data_filtro[2];
    		$data_bd = $ano."-".$mes."-".$dia;
	
	$consulta = mysqli_query ($conexao, "SELECT * FROM usuarios_entrevistas WHERE data='$data_bd' ORDER BY data, hora") or die (mysqli_error());
}
else {
	$consulta = mysqli_query ($conexao, "SELECT * FROM usuarios_entrevistas ORDER BY data DESC, hora ASC LIMIT 50") or die (mysqli_error());
}
$conta = mysqli_num_rows ($consulta);

if ($conta == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhuma entrevista agendada
		</div>
	</div>
</div>
<?php	
}
else {
?>

<?php
	if (isset($_POST['data'])) {
?>		
	<p><a href="entrevistas.php" class="btn btn-danger" title="Fechar Filtro"><i class="fas fa-times"></i></a></p>
<?php			
	}
?>

<table class="table table-striped">
    <thead>
    	<tr>
        	<th>#</th>
            <th>DATA</th>
            <th>HORA</th>
            <th>NOME</th>
            <th>VAGA</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
	<tbody>
<?php
$i = 1;

while ($linha = mysqli_fetch_array($consulta)) {
    $id 		= $linha['id'];
    $id_usuario = $linha['id_usuario'];
	$data 		= $linha['data'];
	$hora 		= $linha['hora'];
	$vaga 		= $linha['vaga'];
	//$feedback 	= $linha['feedback'];
	
	$data = substr($data,8,2) . "/" .substr($data,5,2) . "/" . substr($data,2,2);
	$hora = substr($hora,0,2) . ":" .substr($hora,3,2);
	
	$consultaUsuario = mysqli_query ($conexao, "SELECT nome FROM usuarios WHERE id='$id_usuario'") or die (mysqli_error());
		$dados = mysqli_fetch_array($consultaUsuario);
			$nomeUsuario = $dados['nome'];
	
	$consultaVaga = mysqli_query ($conexao, "SELECT vaga FROM vagas WHERE id='$vaga'") or die (mysqli_error());
		$dados = mysqli_fetch_array($consultaVaga);
			$nomeVaga = $dados['vaga'];
	
	$consultaPNE = mysqli_query ($conexao, "SELECT pne FROM usuarios WHERE id='$id_usuario'") or die (mysqli_error());
		$linha = mysqli_fetch_array($consultaPNE);
			$pne = $linha['pne'];
	
	$consulta_feedbacks = mysqli_query ($conexao, "SELECT id FROM usuarios_feed_entrevistas WHERE id_entrevista='$id'") or die (mysqli_error());
	$conta_feedbacks = mysqli_num_rows ($consulta_feedbacks);
?>

		<tr>
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><?php echo $data; ?></td>
    		<td><?php echo $hora; ?></td>
    		<td><?php echo $nomeUsuario; ?></td>
    		<td><?php echo $nomeVaga; ?></td>
            
            <td>
            <?php if ($pne == "S") { ?>
            <i class="fa fa-wheelchair-alt" aria-hidden="true"></i>
            <?php } ?>
            </td>
            
            <td>
            <?php if ($conta_feedbacks == 0) { ?>
            <a href="entrevistas_feedback.php?id=<?php echo $id; ?>" class="btn btn-xs btn-block btn-default" title="Cadastrar Feedback"><i class="fas fa-list-ul"></i></a>
            <?php } else { ?>
            <a href="entrevistas_feedback.php?id=<?php echo $id; ?>" class="btn btn-xs btn-block btn-success" title="Visualizar Feedback"><i class="fas fa-list-ul"></i></a>
            <?php } ?>
            </td>
            
            <td>
            <a href="curriculos_ver.php?curriculo=<?php echo $id_usuario; ?>" class="btn btn-xs btn-block btn-primary"><i class="fas fa-search"></i></a>
            </td>
            
            <td>
            <a href="funcoes/entrevistas.php?funcao=excluir&id=<?php echo $id; ?>" class="btn btn-xs btn-block btn-danger" onClick="return confirm('Tem certeza que deseja cancelar a entrevista de <?php echo $nomeUsuario; ?> no dia <?php echo $data; ?>?')"><i class="fas fa-trash-alt"></i></a>
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
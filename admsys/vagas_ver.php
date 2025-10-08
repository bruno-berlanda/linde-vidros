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
    	<h1>Vagas</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_vagas == "S") {
?>

<?php
include_once("includes/msgs.php");
?>

<?php
$id = $_GET['id'];
$consultaVaga = mysqli_query ($conexao, "SELECT id_vaga FROM vagas_criadas WHERE id='$id'") or die (mysqli_error());
	$dados = mysqli_fetch_array ($consultaVaga);
		$id_vaga = $dados['id_vaga'];

$consultaNomeVaga = mysqli_query ($conexao, "SELECT vaga FROM vagas WHERE id='$id_vaga'") or die (mysqli_error());
	$dados = mysqli_fetch_array ($consultaNomeVaga);
		$nomeVaga = $dados['vaga'];
?>

<div class="row">
<div class="col-md-12">
<h2><?php echo $nomeVaga; ?></h2>

<?php
$i = 1;

$consulta_inscritos = mysqli_query ($conexao, "SELECT id, candidato, data, hora FROM vagas_inscritos WHERE id_vaga='$id' AND candidato!='2180' ORDER BY id DESC") or die (mysqli_error());
$conta_inscritos = mysqli_num_rows ($consulta_inscritos);

if ($conta_inscritos == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhuma candidato se inscreveu para a vaga
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
            <th>HORA</th>
            <th>CPF</th>
            <th>NOME</th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha = mysqli_fetch_array($consulta_inscritos)) {
    $id_inscricao	= $linha['id'];
	$candidato 		= $linha['candidato'];
    $data 			= $linha['data'];
    $hora 			= $linha['hora'];
	
	$data = substr($data,8,2) . "/" .substr($data,5,2) . "/" . substr($data,2,2);
	$hora = substr($hora,0,2) . ":" .substr($hora,3,2);
	
	$consultaCandidato = mysqli_query ($conexao, "SELECT cpf, nome FROM usuarios WHERE id='$candidato'") or die (mysqli_error());
		$dados = mysqli_fetch_array ($consultaCandidato);
			$cpfCandidato 	= $dados['cpf'];
			$nomeCandidato 	= $dados['nome'];
?>
    
    	<tr>
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><?php echo $data; ?></td>
            <td><?php echo $hora; ?></td>
            <td><?php echo $cpfCandidato; ?></td>
            <td><?php echo $nomeCandidato; ?></td>
          	<td>
            <a href="curriculos_ver.php?curriculo=<?php echo $candidato; ?>" class="btn btn-xs btn-primary btn-block"><i class="fas fa-search"></i></a>
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
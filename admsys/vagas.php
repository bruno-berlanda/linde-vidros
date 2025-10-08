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

<div class="row">
<div class="col-md-4">
<?php
if (!isset($_GET['editar'])) {
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
CADASTRAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<form method="post" action="funcoes/vagas.php?funcao=criar" class="form-horizontal">
    <fieldset>
        
        <legend>Nova vaga em aberto</legend>
        
        <div class="form-group form-group-sm">
        	<label for="selectVaga" class="col-sm-3 control-label">Vaga</label>
            <div class="col-sm-9">
            	<select name="vaga" id="selectVaga" class="form-control" required>
                	<option></option>
                    <?php
					$consulta_vagas = mysqli_query ($conexao, "SELECT * FROM vagas ORDER BY vaga") or die (mysqli_error());
						while ($linha = mysqli_fetch_array($consulta_vagas)) {
							$id_bd 	= $linha['id'];
							$vaga 	= $linha['vaga'];
					?>
                    <option value="<?php echo $id_bd; ?>"><?php echo $vaga; ?></option>
					<?php
						}
					?>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputRequisitos" class="col-sm-3 control-label">Requisitos</label>
            <div class="col-sm-9">
            	<textarea name="descricao" rows="16" id="inputRequisitos" class="form-control" placeholder="Coloque os requisitos para vaga" required></textarea>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </fieldset>
</form>

<hr>

<form method="post" action="funcoes/vagas.php?funcao=nova_vaga" class="form-horizontal">
    <fieldset>
        
        <legend>Cadastrar Vaga</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputVaga" class="col-sm-3 control-label">Vaga</label>
            <div class="col-sm-9">
            	<input type="text" name="vaga" id="inputVaga" class="form-control" required autocomplete="off">
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
	
	$consulta = mysqli_query ($conexao, "SELECT * FROM vagas_criadas WHERE id='$id'") or die (mysqli_error());
		$dados = mysqli_fetch_array($consulta);
			$id_bd 		= $dados['id'];
			$id_vaga 	= $dados['id_vaga'];
			$descricao 	= $dados['descricao'];
			
			$consultaVaga = mysqli_query ($conexao, "SELECT vaga FROM vagas WHERE id='$id_vaga'") or die (mysqli_error());
				$dados = mysqli_fetch_array($consultaVaga);
					$nomeVaga = $dados['vaga'];
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
EDITAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<form method="post" action="funcoes/vagas.php?funcao=editar&id=<?php echo $id_bd; ?>" class="form-horizontal">
    <fieldset>
        
        <legend>Editar vaga em aberto</legend>
        
        <div class="form-group form-group-sm">
        	<label for="selectVaga" class="col-sm-3 control-label">Vaga</label>
            <div class="col-sm-9">
            	<select name="vaga" id="selectVaga" class="form-control" required>
                	<option></option>
                    <?php
					$consulta_vagas = mysqli_query ($conexao, "SELECT * FROM vagas ORDER BY vaga") or die (mysqli_error());
						while ($linha = mysqli_fetch_array($consulta_vagas)) {
							$id_bd 	= $linha['id'];
							$vaga 	= $linha['vaga'];
					?>
                    <option value="<?php echo $id_bd; ?>"<?php if ($id_vaga == $id_bd) { echo " selected"; } ?>><?php echo $vaga; ?></option>
					<?php
						}
					?>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputRequisitos" class="col-sm-3 control-label">Requisitos</label>
            <div class="col-sm-9">
            	<textarea name="descricao" rows="16" id="inputRequisitos" class="form-control" placeholder="Coloque os requisitos para vaga" required><?php echo $descricao; ?></textarea>
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
?>
</div>

<div class="col-md-8">
<h2>Vagas Abertas</h2>

<?php
$i = 1;

$consulta = mysqli_query ($conexao, "SELECT * FROM vagas_criadas ORDER BY status DESC, termino DESC LIMIT 20") or die (mysqli_error());
$conta = mysqli_num_rows ($consulta);

if ($conta == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhuma vaga criada
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
            <th>INÍCIO</th>
            <th>TÉRMINO</th>
            <th>VAGA</th>
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
    $id_vaga 	= $linha['id_vaga'];
    $inicio 	= $linha['inicio'];
	$termino 	= $linha['termino'];
	$status 	= $linha['status'];
	
	$inicio 	= substr($inicio,8,2) . "/" .substr($inicio,5,2) . "/" . substr($inicio,0,4);
	$termino 	= substr($termino,8,2) . "/" .substr($termino,5,2) . "/" . substr($termino,0,4);
	
	$consultaVaga = mysqli_query ($conexao, "SELECT vaga FROM vagas WHERE id='$id_vaga'") or die (mysqli_error());
		$dados = mysqli_fetch_array ($consultaVaga);
			$nomeVaga = $dados['vaga'];
	
	$consultaCandidatos = mysqli_query ($conexao, "SELECT id_vaga FROM vagas_inscritos WHERE id_vaga='$id'") or die (mysqli_query());
		$contaCandidatos = mysqli_num_rows ($consultaCandidatos);
?>
    
    	<tr>
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><?php echo $inicio; ?></td>
            <td><span class="text-muted"><?php if ($termino != "00/00/0000") { echo $termino; } ?></span></td>
            <td><?php echo $nomeVaga; ?></td>
            <td>
            	<?php if ($contaCandidatos > 0) { ?>
                <a href="vagas_ver.php?id=<?php echo $id; ?>" class="btn btn-xs btn-block btn-default btn-block"><?php echo $contaCandidatos; ?></a>
                <?php } else { ?>
                <a href="#" class="btn  btn-xs btn-block btn-default btn-block disabled"><?php echo $contaCandidatos; ?></a>
                <?php } ?>
            </td>
            
            <td>
			<?php 
            if ($status == "1") { ?>
                <a href="funcoes/vagas.php?funcao=fechar&id=<?php echo $id; ?>" title="Fechar Vaga" class="btn btn-xs btn-block btn-success" onClick="return confirm('Tem certeza que deseja encerrar as inscrições para a vaga de <?=$nomeVaga;?>?')"><i class="fas fa-thumbs-up"></i></a>
			<?php 
            } else { 
            ?>
                <a href="#" class="btn btn-xs btn-block disabled btn-default"><i class="fas fa-thumbs-down"></i></a>
            <?php
            }
            ?>
            </td>
            
            <td>
            <a href="vagas.php?editar=<?php echo $id; ?>" class="btn btn-xs btn-block btn-warning"><i class="fas fa-pencil-alt"></i></a>
            </td>
            
            <td>
			<?php if ($perm_adm == "S") { ?>
            <a href="funcoes/vagas.php?funcao=excluir&id=<?php echo $id; ?>" class="btn btn-xs btn-block btn-danger" onClick="return confirm('Tem certeza que deseja excluir a vaga <?php echo $nomeVaga; ?>?')"><i class="fas fa-trash-alt"></i></a>
            <?php } else { ?>
            <a href="#" class="btn btn-xs btn-block disabled"><i class="fas fa-trash-alt"></i></a>
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
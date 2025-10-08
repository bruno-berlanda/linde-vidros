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
    	<h1>Diário</h1>
    </div>
</div>

<?php
include_once("includes/msgs.php");
?>

<?php if ($p_diario == "S" && isset($_GET['cliente_editar'])) { ?>

<div class="row">

<div class="col-md-5">

<div class="well">

<?php
$consulta_cadastro = mysqli_query ($conexao, "SELECT * FROM geral_clientes WHERE id='{$_GET['cliente_editar']}'") or die (mysqli_error($conexao));
	$dados_cadastro = mysqli_fetch_array ($consulta_cadastro);
		$cliente 		= $dados_cadastro['cliente'];
		$rota 			= $dados_cadastro['rota'];
		$cidade 		= $dados_cadastro['cidade'];
		$uf 			= $dados_cadastro['uf'];
		$responsavel 	= $dados_cadastro['responsavel'];
		$segmento 		= $dados_cadastro['segmento'];
		$novo 			= $dados_cadastro['novo'];
		$ativo 			= $dados_cadastro['ativo'];
?>

<form method="post" action="funcoes/diario.php?funcao=editar_cliente&id=<?php echo $_GET['cliente_editar']; ?>" class="form-horizontal">
    <fieldset<?php if ($responsavel != $id_usuario) { echo " disabled"; } ?>>
        <legend>Editar Cliente</legend>
        
        <div class="form-group">
        	<label for="inputCliente" class="col-sm-3 control-label">Cliente</label>
            <div class="col-sm-9">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-user"></i></span>
                	<input type="text" name="cliente" class="form-control" id="inputCliente" autocomplete="off" required value="<?php echo $cliente; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="inputRota" class="col-sm-3 control-label">Rota</label>
            <div class="col-sm-4">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-truck"></i></span>
                	<input type="text" name="rota" class="form-control" id="inputRota" autocomplete="off" required value="<?php echo $rota; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="inputCidade" class="col-sm-3 control-label">Cidade</label>
            <div class="col-sm-9">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                	<input type="text" name="cidade" class="form-control" id="inputCidade" required value="<?php echo $cidade; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="inputUF" class="col-sm-3 control-label">UF</label>
            <div class="col-sm-4">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-globe"></i></span>
                	<input type="text" name="uf" class="form-control" id="inputUF" required value="<?php echo $uf; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="selectSegmento" class="col-sm-3 control-label">Segmento</label>
            <div class="col-sm-9">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="far fa-handshake"></i></span>
                	<select name="segmento" class="form-control" id="selectSegmento" required>
                        <option value="CHA"<?php if ($segmento == "CHA") { echo " selected"; } ?>>CHAPARIA</option>
                        <option value="ENG"<?php if ($segmento == "ENG") { echo " selected"; } ?>>ENGENHARIA</option>
                        <option value="MOV"<?php if ($segmento == "MOV") { echo " selected"; } ?>>MOVELEIRO</option>
                        <option value="FER"<?php if ($segmento == "FER") { echo " selected"; } ?>>FERRAGENS</option>
                    </select>
                </div>
                <span id="helpBlock" class="help-block">Como foi efetuado esse contato com o cliente?</span>
            </div>
        </div>
        <div class="form-group">
        	<label for="inputUF" class="col-sm-3 control-label">Cliente Novo?</label>
            <div class="col-sm-3">
            	<div class="input-group">
                	<div class="radio">
                        <label>
                        	<input type="radio" name="novo" value="N"<?php if ($novo == "N") { echo " checked"; } ?>> Não
                        </label>
					</div>
                    <div class="radio">
                        <label>
                        	<input type="radio" name="novo" value="S"<?php if ($novo == "S") { echo " checked"; } ?>> Sim
                        </label>
					</div>
                </div>
            </div>
        </div>
        
        <input type="hidden" name="rota_atual" value="<?php echo $rota; ?>">
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-success">Atualizar Cliente</button>
                <a href="diario-novo.php" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </fieldset>
</form>

</div>

</div>

<div class="col-md-5">

<div class="well">

<form method="post" action="funcoes/diario.php?funcao=situacao_cliente&id=<?php echo $_GET['cliente_editar']; ?>" class="form-horizontal">
	<fieldset<?php if ($responsavel != $id_usuario) { echo " disabled"; } ?>>
        <legend>Situação Cliente</legend>
        
        <div class="form-group">
        	<label for="selectSituacao" class="col-sm-3 control-label">Situação</label>
            <div class="col-sm-9">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-eye"></i></span>
                	<select name="situacao" class="form-control" id="selectSituacao" onChange="submit()">
                        <option value="S"<?php if ($ativo == "S") { echo " selected"; } ?>>ATIVO</option>
                        <option value="N"<?php if ($ativo == "N") { echo " selected"; } ?>>INATIVO</option>
                    </select>
                </div>
                <span id="helpBlock" class="help-block">Um cliente INATIVO não irá aparecer na lista quando for lançar um <strong>Novo Contato</strong>.</span>
            </div>
        </div>
	</fieldset>
</form>

</div>

</div>

</div>

<?php } // Permissão para acessar a página ?>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
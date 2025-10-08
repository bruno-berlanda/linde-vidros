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

<?php if ($p_diario == "S") { ?>

<div class="row">

<div class="col-md-7">

<form method="post" action="funcoes/diario.php?funcao=cadastrar" enctype="multipart/form-data" class="form-horizontal">
    <fieldset>
        <legend>Feedback</legend>
        
        <div class="form-group">
        	<label for="inputDataVisita" class="col-sm-3 control-label">Data Visita</label>
            <div class="col-sm-4">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-calendar-alt"></i></span>
                	<input type="date" name="data_visita" class="form-control" id="inputDataVisita" autocomplete="off" required autofocus value="<?php echo $data_hoje; ?>" max="<?php echo $data_hoje; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="selectCliente" class="col-sm-3 control-label">Cliente</label>
            <div class="col-sm-9">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-user"></i></span>
                	<select name="cliente" class="form-control" id="selectCliente" required>
                    	<option></option>
                        <?php
						$con_clientes = mysqli_query ($conexao, "SELECT * FROM geral_clientes WHERE responsavel='$id_usuario' AND ativo='S'".$ordem_clientes) or die (mysqli_error($conexao));
						while ($d_clientes = mysqli_fetch_array ($con_clientes)) {
							$c_id 		= $d_clientes['id'];
							$c_cliente 	= $d_clientes['cliente'];
							$c_rota 	= $d_clientes['rota'];
							$c_cidade 	= $d_clientes['cidade'];
							$c_uf 		= $d_clientes['uf'];
							$c_seg 		= $d_clientes['segmento'];
							
							/* Config */
							switch ($config_clientes) {
								case "1":
									$forma_clientes = $c_cliente." - (".$c_rota.") ".$c_cidade."/".$c_uf." - ".$c_seg;
									break;
								case "2":
									$forma_clientes = $c_cidade."/".$c_uf." (".$c_rota.") - ".$c_cliente." - ".$c_seg;
									break;
								case "3":
									$forma_clientes = $c_rota." (".$c_cidade."/".$c_uf.") - ".$c_cliente." - ".$c_seg;
							}
						?>
                        <option value="<?php echo $c_id; ?>"><?php echo $forma_clientes; ?></option>
                        <?php
						}
						?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="textDescricao" class="col-sm-3 control-label">Descrição</label>
            <div class="col-sm-9">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-align-left"></i></span>
                	<textarea name="descricao" class="form-control" id="textDescricao" rows="20" required></textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="selectTipo" class="col-sm-3 control-label">Tipo Contato</label>
            <div class="col-sm-9">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-phone-volume"></i></span>
                	<select name="tipo" class="form-control" id="selectTipo" required>
                    	<option></option>
                        <option value="E">E-MAIL</option>
                        <option value="S">SKYPE</option>
                        <option value="T">TELEFONE</option>
                        <option value="V">VISITA NO CLIENTE</option>
                        <option value="W">WHATSAPP</option>
                    </select>
                </div>
                <span id="helpBlock" class="help-block">Como foi efetuado esse contato com o cliente?</span>
            </div>
        </div>
        
        <hr>
        
        <div class="form-group">
        	<label for="inputFoto1" class="col-sm-3 control-label">Foto 1</label>
            <div class="col-sm-9">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-paperclip"></i></span>
                	<input type="file" name="foto1" class="form-control" id="inputFoto1" accept="image/*">
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="inputFoto2" class="col-sm-3 control-label">Foto 2</label>
            <div class="col-sm-9">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-paperclip"></i></span>
                	<input type="file" name="foto2" class="form-control" id="inputFoto2" accept="image/*">
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="inputFoto3" class="col-sm-3 control-label">Foto 3</label>
            <div class="col-sm-9">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-paperclip"></i></span>
                	<input type="file" name="foto3" class="form-control" id="inputFoto3" accept="image/*">
                </div>
            </div>
        </div>
        
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary btn-lg">Salvar</button>
            </div>
        </div>
    </fieldset>
</form>

</div>

<div class="col-md-5">

<div class="well">

<form method="post" action="funcoes/diario.php?funcao=novo_cliente" class="form-horizontal">
    <fieldset>
        <legend>Novo Cliente</legend>
        
        <div class="form-group">
        	<label for="inputCliente" class="col-sm-3 control-label">Cliente</label>
            <div class="col-sm-9">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-user"></i></span>
                	<input type="text" name="cliente" class="form-control" id="inputCliente" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="inputRota" class="col-sm-3 control-label">Rota</label>
            <div class="col-sm-5">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-truck"></i></span>
                	<input type="text" name="rota" class="form-control" id="inputRota" autocomplete="off" required>
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="inputCidade" class="col-sm-3 control-label">Cidade</label>
            <div class="col-sm-9">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                	<input type="text" name="cidade" class="form-control" id="inputCidade" required>
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="inputUF" class="col-sm-3 control-label">UF</label>
            <div class="col-sm-5">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-globe"></i></span>
                	<input type="text" name="uf" class="form-control" id="inputUF" required>
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="selectSegmento" class="col-sm-3 control-label">Segmento</label>
            <div class="col-sm-9">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="far fa-handshake"></i></span>
                	<select name="segmento" class="form-control" id="selectSegmento" required>
                    	<option<?php if ($seg_usuario == "") { echo " selected"; } ?>></option>
                        <option value="CHA"<?php if ($seg_usuario == "CHA") { echo " selected"; } ?>>CHAPARIA</option>
                        <option value="ENG"<?php if ($seg_usuario == "ENG") { echo " selected"; } ?>>ENGENHARIA</option>
                        <option value="MOV"<?php if ($seg_usuario == "MOV") { echo " selected"; } ?>>MOVELEIRO</option>
                        <option value="FER"<?php if ($seg_usuario == "FER") { echo " selected"; } ?>>FERRAGENS</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="inputUF" class="col-sm-3 control-label">Cliente Novo?</label>
            <div class="col-sm-3">
            	<div class="input-group">
                	<div class="radio">
                        <label>
                        	<input type="radio" name="novo" value="N" checked> Não
                        </label>
					</div>
                    <div class="radio">
                        <label>
                        	<input type="radio" name="novo" value="S"> Sim
                        </label>
					</div>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-success">Cadastrar Cliente</button>
            </div>
        </div>
    </fieldset>
</form>

</div>

<?php
$consulta_cadastros = mysqli_query ($conexao, "SELECT id FROM geral_clientes WHERE responsavel='$id_usuario'") or die (mysqli_error($conexao));
$conta_cadastros = mysqli_num_rows ($consulta_cadastros);

if ($conta_cadastros == 0) {
?>
<p class="text-center">VOCÊ AINDA NÃO CADASTROU CLIENTES</p>
<?php
}
elseif ($conta_cadastros == 1) {
?>
<p class="text-center">VOCÊ TEM <strong>1</strong> CLIENTE CADASTRADO</p>
<?php
}
else {
?>
<p class="text-center">VOCÊ TEM <strong><?php echo $conta_cadastros; ?></strong> CLIENTES CADASTRADOS</p>
<?php
}
?>

<form action="diario-cliente-editar.php" method="get">
<div class="input-group">
    <select name="cliente_editar" class="form-control" id="selectClientesCadastrados" required>
    	<option></option>
        <?php
		$con_clientes_cad = mysqli_query ($conexao, "SELECT * FROM geral_clientes WHERE responsavel='$id_usuario' ORDER BY cliente") or die (mysqli_error($conexao));
		while ($d_clientes_cad = mysqli_fetch_array ($con_clientes_cad)) {
			$cc_id 		= $d_clientes_cad['id'];
			$cc_cliente = $d_clientes_cad['cliente'];
			$cc_rota 	= $d_clientes_cad['rota'];
			$cc_cidade 	= $d_clientes_cad['cidade'];
			$cc_uf 		= $d_clientes_cad['uf'];
			$cc_seg 	= $d_clientes_cad['segmento'];
			
			/* Config */
			switch ($config_clientes) {
				case "1":
					$forma_clientes_editar = $cc_cliente." - (".$cc_rota.") ".$cc_cidade."/".$cc_uf." - ".$cc_seg;
					break;
				case "2":
					$forma_clientes_editar = $cc_cidade."/".$cc_uf." (".$cc_rota.") - ".$cc_cliente." - ".$cc_seg;
					break;
				case "3":
					$forma_clientes_editar = $cc_rota." (".$cc_cidade."/".$cc_uf.") - ".$cc_cliente." - ".$cc_seg;
			}
		?>
		<option value="<?php echo $cc_id; ?>"><?php echo $forma_clientes_editar; ?></option>
		<?php
		}
		?>
    </select>
    <span class="input-group-btn">
    	<button class="btn btn-sm btn-warning" type="submit"><i class="fas fa-pencil-alt"></i> Editar</button>
    </span>
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
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
    	<h1>Moveleiro: Novo Pedido</h1>
    </div>
</div>

<?php
include_once("includes/msgs.php");
?>

<?php if ($p_pedmov_solicitar == "S") { ?>

<div class="row">

<div class="col-md-6">

<form method="post" action="funcoes/moveleiro_pedidos.php?funcao=cadastrar" class="form-horizontal">
    <fieldset>
        <legend>Novo Pedido</legend>
        
        <div class="form-group">
        	<label for="inputCliente" class="col-sm-3 control-label">Cliente</label>
            <div class="col-sm-5">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-user"></i></span>
                	<input type="text" name="cliente" class="form-control" id="inputCliente" autocomplete="off" required autofocus>
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="inputIdPedido" class="col-sm-3 control-label">Id. Pedido</label>
            <div class="col-sm-8">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="far fa-address-card"></i></span>
                	<input type="text" name="pedido_id" class="form-control" id="inputIdPedido" autocomplete="off" maxlength="50" placeholder="Identificação do pedido">
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="inputPrazoEntrega" class="col-sm-3 control-label">Prazo Entrega</label>
            <div class="col-sm-4">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                	<input type="date" name="prazo_entrega" class="form-control" id="inputPrazoEntrega" required min="<?php echo date("Y-m-d"); ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="selectTransporte" class="col-sm-3 control-label">Transporte</label>
            <div class="col-sm-8">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-truck"></i></span>
                	<select name="transporte" class="form-control" id="selectTransporte" required>
                    	<option></option>
                        <option value="P">PRÓPRIO</option>
                        <option value="R">RETIRA</option>
                        <option value="T">TRANSPORTADORA</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="selectFrete" class="col-sm-3 control-label">Frete</label>
            <div class="col-sm-5">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-road"></i></span>
                	<select name="frete" class="form-control" id="selectFrete" required>
                    	<option></option>
                        <option value="C">CIF</option>
                        <option value="F">FOB</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary btn-lg">Salvar e Incluir Peças</button>
            </div>
        </div>
    </fieldset>
</form>

<!-- Verifica Código Cliente -->
<script type="text/javascript">
$(function(){
	$("input[name='cliente']").keyup( function(){
		var cliente = $("input[name='cliente']").val();
		$.post('funcoes/verifica_cliente.php',{cliente: cliente},function(data){
			$('#resultado').html(data);
		});
	});
});
</script>

</div>

<div class="col-md-6">

<h3>Informações do Cliente</h3>

<div class="well well-lg">
	<div id="resultado"></div>
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
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
    	<h1>Configurações</h1>
    </div>
</div>

<?php
include_once("includes/msgs.php");
?>

 
<div class="row">
    <div class="col-md-6">

        <form method="post" action="funcoes/config.php?idUsuario=<?php echo $id_usuario; ?>" class="form-horizontal">
            <fieldset>
            
            <legend>Configurações Sistema</legend>
            
            <div class="form-group">
                <label for="inputSenha1" class="col-sm-3 control-label">Exibir Clientes (Diário)</label>
                <div class="col-sm-9">
                    <div class="radio">
                        <label>
                        	<input type="radio" name="ordem_clientes" value="1"<?php if ($config_clientes == 1) { echo " checked"; } ?>> CLIENTE - (ROTA) CIDADE - SEGMENTO
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                        	<input type="radio" name="ordem_clientes" value="2"<?php if ($config_clientes == 2) { echo " checked"; } ?>> CIDADE (ROTA) - CLIENTE - SEGMENTO
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                        	<input type="radio" name="ordem_clientes" value="3"<?php if ($config_clientes == 3) { echo " checked"; } ?>> ROTA (CIDADE) - CLIENTE - SEGMENTO
                        </label>
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
</div>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
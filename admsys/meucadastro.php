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
    	<h1>Meu cadastro</h1>
    </div>
</div>

<?php
include_once("includes/msgs.php");
?>

<div class="row">

<div class="col-md-6">

<form method="post" action="funcoes/meucadastro.php?funcao=senha" class="form-horizontal">
    <fieldset>
        <legend>Alterar minha senha</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputSenhaAtual" class="col-sm-3 control-label">Senha Atual</label>
            <div class="col-sm-5">
            	<input type="password" name="senha_atual" class="form-control" id="inputSenhaAtual" autocomplete="off" required autofocus>
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
        	<label for="inputSenhaNova1" class="col-sm-3 control-label">Senha Nova 1</label>
            <div class="col-sm-5">
            	<input type="password" name="senha_nova1" class="form-control" id="inputSenhaNova1" autocomplete="off" required>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputSenhaNova2" class="col-sm-3 control-label">Senha Nova 2</label>
            <div class="col-sm-5">
            	<input type="password" name="senha_nova2" class="form-control" id="inputSenhaNova2" autocomplete="off" required>
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

</div>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
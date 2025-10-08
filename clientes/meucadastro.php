<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_clientes.php");
include_once ("includes/usuario_logado.php");
include_once ("includes/cabecalho.php");
?>

<body>

<?php include_once ("includes/menu_topo.php"); ?>

<div class="container-fluid" id="conteudo">

<div class="row" id="titulo">
	<div class="col-md-12">
    	<h1>Meu Cadastro</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
		include_once("includes/msgs.php");
		?>

		<div class="row">
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                <i class="fas fa-info-circle fa-lg"></i>
                Você se cadastrou em <?php echo $criadoUsuario; ?>.
                </div>
            </div>
        </div>
        
        <div class="row">
        	<div class="col-md-6">
        
                <form method="post" action="funcoes/conta.php?funcao=senha&idUsuario=<?php echo $idUsuario; ?>" class="form-horizontal">
                    <fieldset>
                    
                    <legend>Trocar minha senha</legend>
                    
                    <div class="form-group form-group-sm">
                        <label for="inputSenha1" class="col-sm-3 control-label">Senha atual</label>
                        <div class="col-sm-5">
                            <input type="password" name="senha_atual" class="form-control" id="inputSenha1" required autofocus>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="inputSenha2" class="col-sm-3 control-label">Nova senha</label>
                        <div class="col-sm-5">
                            <input type="password" name="senha1" class="form-control" id="inputSenha2" required>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="inputSenha3" class="col-sm-3 control-label">Confirmar senha</label>
                        <div class="col-sm-5">
                            <input type="password" name="senha2" class="form-control" id="inputSenha3" required>
                        </div>
                    </div>
                    
                    <div class="form-group form-group-sm">
                        <div class="col-sm-offset-3 col-sm-9">
                        	<button type="submit" class="btn btn-primary">Atualizar Senha</button>
                        </div>
                    </div>
                                
                    </fieldset>
                </form>
        
        	</div>
        </div>
        
	</div>
</div>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts_bootstrap.php"); ?>

</body>

</html>
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
    	<h1>Trocar Senha</h1>
    </div>
</div>

<?php
include_once("includes/msgs.php");
?>

 
<div class="row">
    <div class="col-md-6">

        <form method="post" action="funcoes/conta.php?funcao=senha&idUsuario=<?php echo $id_usuario; ?>" class="form-horizontal">
            <fieldset>
            
            <legend>Trocar minha senha</legend>
            
            <div class="form-group">
                <label for="inputSenha1" class="col-sm-3 control-label">Senha atual</label>
                <div class="col-sm-5">
                    <input type="password" name="senha_atual" class="form-control" id="inputSenha1" maxlength="6" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSenha2" class="col-sm-3 control-label">Nova senha</label>
                <div class="col-sm-5">
                    <input type="password" name="senha1" class="form-control" id="inputSenha2" maxlength="6" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSenha3" class="col-sm-3 control-label">Confirmar senha</label>
                <div class="col-sm-5">
                    <input type="password" name="senha2" class="form-control" id="inputSenha3" maxlength="6" required>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary btn-lg">Atualizar Senha</button>
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
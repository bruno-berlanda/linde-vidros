<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_curriculos.php");
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

<?php include_once ("includes/msgs.php"); ?>

<div class="row">
	<div class="col-md-12">
		<div class="alert alert-info" role="alert">
		<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
		Você se cadastrou em <?php echo $usuarioCriado; ?>. E atualizou seu currículo pela última vez em <strong><?php echo $usuarioAtualizado; ?></strong>.
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
        <form method="post" action="funcoes/conta.php?funcao=senha&u=<?php echo $usuarioCod; ?>" class="form-horizontal">
            
            <legend>Trocar minha senha</legend>
            
            <div class="form-group">
            	<label for="inputSenha1" class="col-sm-3 control-label">Senha atual</label>
                <div class="col-sm-5">
                	<input type="password" name="senha_atual" class="form-control" id="inputSenha1" required autofocus>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputSenha2" class="col-sm-3 control-label">Nova senha</label>
                <div class="col-sm-5">
                	<input type="password" name="senha1" class="form-control" id="inputSenha2" required>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputSenha3" class="col-sm-3 control-label">Confirmar nova senha</label>
                <div class="col-sm-5">
                	<input type="password" name="senha2" class="form-control" id="inputSenha3" required>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-lg btn-primary"><i class="fas fa-save"></i> Salvar</button>
                </div>
            </div>
        </form>
        
        <hr>
        
        <form method="post" action="funcoes/conta.php?funcao=foto&u=<?php echo $usuarioCod; ?>" enctype="multipart/form-data" class="form-horizontal">
            
            <legend>Alterar minha foto</legend>
            
            <div class="form-group">
            	<label for="inputFoto" class="col-sm-3 control-label">Foto</label>
                <div class="col-sm-9">
                	<input type="file" name="arquivo" class="form-control" id="inputFoto" accept="image/*" required>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-lg btn-primary"><i class="fas fa-save"></i> Salvar</button>
                </div>
            </div>
            
            <?php if ($usuarioFoto != "") { ?>
        	<div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <a href="funcoes/conta.php?funcao=excluir_foto&u=<?php echo $usuarioCod; ?>" class="btn btn-danger" onClick="return confirm('Tem certeza que deseja excluir a sua foto?')"><i class="fas fa-trash-alt"></i> Excluir Foto</a>
                </div>
            </div>
        	<?php } ?>
        </form>
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts_bootstrap.php"); ?>

</body>

</html>
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
    	<h1><i class="fas fa-music"></i> Informações</h1>
    </div>
</div>

<?php include_once ("includes/msgs.php"); ?>

<div class="row">
	<div class="col-md-6">
        <form method="post" action="funcoes/informacoes.php?funcao=cadastrar&u=<?php echo $usuarioCod; ?>" class="form-horizontal">
            
            <legend>Conte-nos mais sobre você</legend>
            
            <div class="form-group">
            	<label for="inputEsportes" class="col-sm-3 control-label">Esportes</label>
                <div class="col-sm-9">
                	<textarea name="esportes" rows="4" class="form-control" id="inputEsportes"><?php echo $usuarioEsportes; ?></textarea>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputHobbies" class="col-sm-3 control-label">Hobbies</label>
                <div class="col-sm-9">
                	<textarea name="hobbies" rows="4" class="form-control" id="inputHobbies"><?php echo $usuarioHobbies; ?></textarea>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputLivros" class="col-sm-3 control-label">Livros</label>
                <div class="col-sm-9">
                	<textarea name="livros" rows="4" class="form-control" id="inputLivros"><?php echo $usuarioLivros; ?></textarea>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputMusica" class="col-sm-3 control-label">Música</label>
                <div class="col-sm-9">
                	<textarea name="musica" rows="4" class="form-control" id="inputMusica"><?php echo $usuarioMusica; ?></textarea>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputPaixoes" class="col-sm-3 control-label">Paixões</label>
                <div class="col-sm-9">
                	<textarea name="paixoes" rows="4" class="form-control" id="inputPaixoes"><?php echo $usuarioPaixoes; ?></textarea>
                </div>
            </div>
            <div class="form-group">
            	<label for="inputTrabSocial" class="col-sm-3 control-label">Trabalho Social</label>
                <div class="col-sm-9">
                	<textarea name="trabalho" rows="4" class="form-control" id="inputTrabSocial"><?php echo $usuarioTrabsocial; ?></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-lg btn-primary"><i class="fas fa-save"></i> Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts_bootstrap.php"); ?>

</body>

</html>
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
    	<h1>Relatar Erro</h1>
    </div>
</div>

<?php include_once ("includes/msgs.php"); ?>

<div class="row">
	<div class="col-md-6">
        <form method="post" action="funcoes/relatar.php?funcao=cadastrar&u=<?php echo $usuarioCod; ?>" class="form-horizontal">
            
            <legend>Descreva o Problema</legend>
            
            <div class="form-group">
            	<label for="inputDescricao" class="col-sm-3 control-label">Descrição</label>
                <div class="col-sm-9">
                	<textarea name="descricao" rows="8" class="form-control" id="inputDescricao" placeholder="Coloque uma breve descrição do problema que você teve." required autofocus></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-lg btn-primary"><i class="fas fa-save"></i> Enviar Relatório</button>
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
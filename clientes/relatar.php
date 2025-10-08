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
    	<h1>Relatar Erro</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
		include_once("includes/msgs.php");
		?>
		
        <div class="well well-sm">
        	<span class="text-danger">Está com algum problema ao acessar a área restrita? Nos ajude a estar sempre melhorando essa área que é dedicada à você.</span>
        </div>

        <div class="row">
        	<div class="col-md-6">
        
                <form method="post" action="funcoes/relatar.php?funcao=cadastrar&idUsuario=<?php echo $idUsuario; ?>" class="form-horizontal">
                    <fieldset>
                    
                    <legend>Descreva o Problema</legend>
                    
                    <div class="form-group">
                        <label for="inputDescricao" class="col-sm-3 control-label">Descrição</label>
                        <div class="col-sm-9">
                            <textarea name="descricao" class="form-control" rows="8" id="inputDescricao" placeholder="Coloque uma breve descrição do problema que você teve." autofocus></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                        	<button type="submit" class="btn btn-primary btn-lg">Enviar Relatório</button>
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
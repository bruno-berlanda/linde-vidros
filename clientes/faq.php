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
    	<h1>FAQ</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
		include_once("includes/msgs.php");
		?>

		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="heading1">
                    <h4 class="panel-title">
                    	<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                    		Meus Dados
                    	</a>
                    </h4>
                </div>
            <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                <div class="panel-body">
                	<p>Visualize as informações que você preencheu na hora do seu cadastro, se necessitar de alguma alteração, a mesma pode ser requisitada nessa mesma página.</p>
                </div>
            </div>
            </div>
            
            <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="heading2">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                        	Projetos
                        </a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                    <div class="panel-body">
                    	<p>Pensando em falicitar o seu projeto e a comunicação com o nosso setor de projetos, disponibilizamos os croquis para você usar.</p>
                    </div>
                </div>
            </div>
        
            <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="heading3">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                        	Promoções
                        </a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                    <div class="panel-body">
                    	<p>Fique por dentro das promoções.</p>
                    </div>
                </div>
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
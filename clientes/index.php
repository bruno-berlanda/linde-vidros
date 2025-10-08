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
    	<h1>Área Restrita</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
		include_once("includes/msgs.php");
		?>

		<div class="jumbotron">
            <div class="container">
            	<h1>Seja bem vindo!</h1>
            	<p>Olá <?php echo $nomeUsuario; ?>, essa área foi criada para você. Aqui você encontrará ferramentas para facilitar seu dia-a-dia. Aproveite!</p>
            	<p><a href="projetos.php" class="btn btn-primary btn-lg"><i class="fas fa-paste"></i> Croquis de Projetos</a></p>
            </div>
        </div>
        
        <div class="row">
        
        <div class="col-md-8">
        	<h2>Promoções</h2>
            
            <?php
			$consulta_promocoes = mysqli_query ($conexao, "SELECT id, titulo, imagem1 FROM admin_promocoes WHERE status='S' AND CURRENT_DATE()<=finalizar AND mostrar_restrita='S' ORDER BY id DESC") or die (mysqli_error());
			$conta_promocoes = mysqli_num_rows ($consulta_promocoes);
			
			if ($conta_promocoes == 0) {
			?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle fa-lg"></i>
                    Nenhuma promoção no momento :(
                    </div>
                </div>
            </div>
            <?php
			}
			else {
			?>
            <div class="row">
            <?php
				while ($dados = mysqli_fetch_array ($consulta_promocoes)) {
					$id_promo 		= $dados['id'];
					$titulo_promo 	= $dados['titulo'];
					$imagem_promo 	= $dados['imagem1'];
			?>
            	<div class="col-md-4">
            		<a href="promocoes.php#<?php echo $id_promo; ?>" title="<?php echo $titulo_promo; ?>">
                        <img src="../imagens/promocoes/<?php echo $imagem_promo; ?>" alt="<?php echo $titulo_promo; ?>" class="img-responsive img-thumbnail">
                    </a>
                </div>
            <?php
				}
			?>
            </div>
            <?php
			}
			?>
        </div>
        
        <div class="col-md-4">
        	<h2>Apostila de Projetos</h2>
            
            <p><a href="http://www.youblisher.com/p/889002-Apostila-de-Projetos-Linde-Vidros/" rel="shadowbox" class="btn btn-primary btn-block" target="_blank"><i class="fas fa-book"></i> Acessar Apostila</a></p>
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
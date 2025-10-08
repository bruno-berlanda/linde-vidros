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
    	<h1>Promoções</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
		include_once("includes/msgs.php");
		?>

		<?php
		$consulta_promocoes = mysqli_query ($conexao, "SELECT id, titulo, imagem2 FROM admin_promocoes WHERE status='S' AND CURRENT_DATE()<=finalizar AND mostrar_restrita='S' ORDER BY id DESC") or die (mysqli_error());
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
			while ($dados = mysqli_fetch_array ($consulta_promocoes)) {
				$id_promo 		= $dados['id'];
				$titulo_promo 	= $dados['titulo'];
				$imagem_promo 	= $dados['imagem2'];
		?>
			<section id="<?php echo $id_promo; ?>">
			<h2><?php echo $titulo_promo; ?></h2>
			<p class="text-center"><img src="../imagens/promocoes/<?php echo $imagem_promo; ?>" alt="<?php echo $titulo_promo; ?>" class="img-responsive img-rounded"></p>
			</section>
			
			<hr>
		<?php
			}
		}
		?>
        
	</div>
</div>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts_bootstrap.php"); ?>

</body>

</html>
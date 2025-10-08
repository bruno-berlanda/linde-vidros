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
    	<h1>Promoções</h1>
    </div>
</div>

<?php
include_once("includes/msgs.php");
?>

<?php if ($p_promocoes == "S") { ?>

<div class="row">
    <div class="col-md-12">
        <?php
		include_once("includes/msgs.php");
		?>

        <?php
        $con_promocoes = mysqli_query ($conexao, "SELECT * FROM admin_promocoes WHERE status='S' AND CURRENT_DATE()<=finalizar AND mostrar_representante='S' ORDER BY id DESC") or die (mysqli_error($conexao));

        while ($d_promocoes = mysqli_fetch_array($con_promocoes)) {
            ?>
            <section id="<?php echo $d_promocoes['id']; ?>">
                <h2>
                    <?php echo $d_promocoes['titulo']; ?>
                </h2>
                <p class="text-center">
                    <img src="../imagens/promocoes/<?php echo $d_promocoes['imagem2']; ?>" alt="<?php echo $d_promocoes['titulo']; ?>" class="img-responsive img-rounded">
                </p>
            </section>
            <?php
        }
        ?>
	</div>
</div>

<?php } // Permissão para acessar a página ?>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
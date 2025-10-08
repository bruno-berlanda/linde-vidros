<!doctype html>
<html lang="pt-br">

<?php
$produto = $_GET['produto'];
	
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT ferragens_detalhes AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */
	
$consulta_produto = mysqli_query ($conexao, "SELECT * FROM produtos_ferragens WHERE cod='$produto' AND ativo='S'") or die (mysqli_error());
$conta_produto = mysqli_num_rows ($consulta_produto);
	
	$dados_produto = mysqli_fetch_array ($consulta_produto);
		$p_codigo 		= $dados_produto['cod'];
		$p_descricao 	= $dados_produto['descricao'];
		$p_peso 		= $dados_produto['peso'];
		$p_cor_bz 		= $dados_produto['cor_bz'];
		$p_cor_pt 		= $dados_produto['cor_pt'];
		$p_cor_cr 		= $dados_produto['cor_cr'];
		$p_cor_bc 		= $dados_produto['cor_bc'];
		$p_cor_nf 		= $dados_produto['cor_nf'];
		$p_cor_mf 		= $dados_produto['cor_mf'];
		$p_cor_mg 		= $dados_produto['cor_mg'];
		$p_img1 		= $dados_produto['imagem1'];
		$p_img2 		= $dados_produto['imagem2'];
		
		$p_peso_x = number_format($p_peso, 3, ',', '.');

$title = $p_codigo." - ".ucfirst(strtolower($p_descricao))." - Linde Vidros";

$description = $p_codigo." - ".ucfirst(strtolower($p_descricao)) . $tg;
$keywords = "";

$og_url = "http://www.lindevidros.com.br/ferragens";
$og_name = "Ferragens para Vidros";

$submenu_id = "A-FR";

require_once ("includes/links.php");
?>

<?php include_once ("includes/cabecalho.php"); ?>

<body>

<?php include_once ("includes/analyticstracking.php"); // Google Analytics ?>

<?php include_once ("includes/topo.php"); ?>

<?php include_once ("includes/menu.php"); ?>

<?php //include_once ("includes/logo.php"); ?>

<div class="container-fluid">
	<div class="row" id="titulo">
    	<div class="col-md-12">
        	<div class="container">
            	<div class="row">
                    <div class="col-md-12">
                    	<h1>Ferragens</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
    <div class="row" id="img-pg">
    	<div class="col-md-12">
        	<img src="img/img_ferragens.jpg" alt="Ferragens para Vidros" class="img-rounded img-responsive">
        </div>
    </div>
    <div class="row" id="conteudo">
        <div class="col-md-9">
            <?php
			if ($conta_produto == 1) {
			?>            
            <h2><?php echo $p_codigo; ?></h2>
            
            <div class="row">
            	<?php
				if ($p_img1 != "" || $p_img2 != "") {
				?>
                <div class="col-md-4">
            		<div class="row">
                    	<?php if ($p_img1 != "") { ?>
                        <div class="col-xs-12">
                        	<a href="img/produtos/ferragens/<?php echo $p_img1; ?>" rel="shadowbox[vocation]" title="<?php echo $p_codigo; ?>"><img src="img/produtos/ferragens/<?php echo $p_img1; ?>" class="img-thumbnail" alt="<?php echo $p_codigo; ?>"></a>
                        </div>
                        <?php } ?>
                        <?php if ($p_img2 != "") { ?>
                        <div class="col-xs-12">
                        	<a href="img/produtos/ferragens/<?php echo $p_img2; ?>" rel="shadowbox[vocation]" title="<?php echo $p_codigo; ?>"><img src="img/produtos/ferragens/<?php echo $p_img2; ?>" class="img-thumbnail" alt="<?php echo $p_codigo; ?>"></a>
                        </div>
                        <?php } ?>
                    </div>
            	</div>
                <?php
				}
				?>
                <div class="col-md-8">
            		<br class="visible-xs visible-sm">
                    <?php
					// Descrição
					if ($p_descricao != null) {
					?>
                    <strong class="text-muted"><small>DESCRIÇÃO</small></strong>
                    <br>
                    <?php echo $p_descricao; ?>
                    <?php
					}
					?>
                    
                    <?php
					// Peso
					if ($p_peso > 0) {
					?>
                    <hr>
                    
                    <strong class="text-muted"><small>PESO</small></strong>
                    <br>
                    <?php echo $p_peso_x; ?>
                    <?php
					}
					?>
                    
                    <?php
					// Cores
					if ($p_cor_bz == "S" || $p_cor_pt == "S" || $p_cor_cr == "S" || $p_cor_bc == "S" || $p_cor_nf == "S" || $p_cor_mf == "S" || $p_cor_mg == "S") {
					?>
                    <hr>
                    
                    <strong class="text-muted"><small>CORES</small></strong>
                    <br>
                    <?php if ($p_cor_bz == "S") { ?>
                    <a id="tooltip-cor1" rel="tooltip" data-placement="bottom" title="Bronze"><img src="img/cor_bz.jpg" alt="<?php echo $p_codigo; ?> - Bronze" class="img-thumbnail"></a>&nbsp;
                    <?php } ?>
                    <?php if ($p_cor_pt == "S") { ?>
                    <a id="tooltip-cor2" rel="tooltip" data-placement="bottom" title="Preto"><img src="img/cor_pt.jpg" alt="<?php echo $p_codigo; ?> - Preto" class="img-thumbnail"></a>&nbsp;
                    <?php } ?>
                    <?php if ($p_cor_cr == "S") { ?>
                    <a id="tooltip-cor3" rel="tooltip" data-placement="bottom" title="Cromado"><img src="img/cor_cr.jpg" alt="<?php echo $p_codigo; ?> - Cromado" class="img-thumbnail"></a>&nbsp;
                    <?php } ?>
                    <?php if ($p_cor_bc == "S") { ?>
                    <a id="tooltip-cor4" rel="tooltip" data-placement="bottom" title="Branco"><img src="img/cor_bc.jpg" alt="<?php echo $p_codigo; ?> - Branco" class="img-thumbnail"></a>&nbsp;
                    <?php } ?>
                    <?php if ($p_cor_nf == "S") { ?>
                    <a id="tooltip-cor5" rel="tooltip" data-placement="bottom" title="Natural Fosco"><img src="img/cor_nf.jpg" alt="<?php echo $p_codigo; ?> - Natural Fosco" class="img-thumbnail"></a>&nbsp;
                    <?php } ?>
                    <?php if ($p_cor_mf == "S") { ?>
                    <a id="tooltip-cor6" rel="tooltip" data-placement="bottom" title="Marfim"><img src="img/cor_mf.jpg" alt="<?php echo $p_codigo; ?> - Marfim" class="img-thumbnail"></a>&nbsp;
                    <?php } ?>
                    <?php if ($p_cor_mg == "S") { ?>
                    <a id="tooltip-cor7" rel="tooltip" data-placement="bottom" title="Mogno"><img src="img/cor_mg.jpg" alt="<?php echo $p_codigo; ?> - Mogno" class="img-thumbnail"></a>
                    <?php } ?>
                    <?php
					}
					?>
            	</div>
            </div>
            <?php
			} else {
			?>
            
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-warning alert-dismissible text-center" role="alert">
                        <i class="fa fa-frown-o fa-4x" aria-hidden="true"></i>
                        <br>
                        <strong class="lead">PRODUTO NÃO ENCONTRADO</strong>
                        <br><br>
                        <a href="acessorios-ferragens.php" title="Ferragens" class="alert-link">Volte para as Ferragens e selecione outro produto</a>
                    </div>
                </div>
            </div>
            
            <?php
			}
			mysqli_close ($conexao);
			?>
        </div>
        <div class="col-md-3">
			<?php include_once ("includes/menu_acessorios.php"); ?>
        </div>
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
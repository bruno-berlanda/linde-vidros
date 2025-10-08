<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT ferragens AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Ferragens para Vidros - Linde Vidros";

$description = "Ferragens para Vidro e Acessórios para Vidros Temperados" . $tg;
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
            <p class="text-justify">Nossas <strong>ferragens</strong> são de excelente qualidade, devido a um material super-resistente e acabamento primoroso.</p>
            
            <?php
			include_once ("funcoes/conexao.php");
				
			$consulta = mysqli_query ($conexao, "SELECT * FROM produtos_ferragens WHERE ativo='S' ORDER BY cod") or die (mysqli_error());
			$conta = mysqli_num_rows ($consulta);
		
			if ($conta >= 1) {
			?>
            <hr>
            
            <div class="row">
				<?php
                while ($dados = mysqli_fetch_array ($consulta)) {
                    $cod 		= $dados['cod'];
                    $imagem1 	= $dados['imagem1'];
				?>
                <div class="col-xs-6 col-sm-4 col-md-3">
                    <div class="thumbnail" id="img-thumb">
                        <img src="img/produtos/ferragens/<?php echo $imagem1; ?>" alt="<?php echo $cod; ?>">
                        <div class="caption">
                            <p class="text-center"><?php echo $cod; ?></p>
                            <p><a href="ferragens-detalhes.php?produto=<?php echo $cod; ?>" class="btn btn-primary btn-sm btn-block" role="button" title="<?php echo $cod; ?>"><i class="fas fa-link"></i> Detalhes</a></p>
                        </div>
                    </div>
                </div>
                <?php
					}
				?>
            </div>
            <?php
			}
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
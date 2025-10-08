<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT aluminios AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Alumínios para Vidros - Linde Vidros";

$description = "Linha completa de alumínios para portas e janelas de vidro" . $tg;
$keywords = "";

$og_url = "http://www.lindevidros.com.br/aluminios";
$og_name = "Alumínios para Vidros";

$submenu_id = "A-AL";

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
                    	<h1>Alumínios</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
    <div class="row" id="img-pg">
    	<div class="col-md-12">
        	<img src="img/img_aluminios.jpg" alt="Alumínios para Vidros" class="img-rounded img-responsive">
        </div>
    </div>
    <div class="row" id="conteudo">
        <div class="col-md-9">
            <p class="text-justify">Os perfis da linha de engenharia em <strong>alumínio</strong> para vidros temperados proporcionam aos clientes soluções práticas e inteligentes para janelas e instalações em geral.</p>
            
            <p class="text-justify">Controles rigorosos desde a matéria-prima à extrusão, assim como na anodização e pintura eletrostática, garantem a procedência dos produtos.</p>
            
            <?php
			include_once ("funcoes/conexao.php");
				
			$consulta = mysqli_query ($conexao, "SELECT * FROM produtos_aluminios WHERE ativo='S' ORDER BY cod") or die (mysqli_error());
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
                        <img src="img/produtos/aluminios/<?php echo $imagem1; ?>" alt="<?php echo $cod; ?>">
                        <div class="caption">
                            <p class="text-center"><?php echo $cod; ?></p>
                            <p><a href="aluminios-detalhes.php?produto=<?php echo $cod; ?>" class="btn btn-primary btn-sm btn-block" role="button" title="<?php echo $cod; ?>"><i class="fas fa-link"></i> Detalhes</a></p>
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
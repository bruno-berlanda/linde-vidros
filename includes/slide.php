<?php
require_once ("funcoes/conexao.php");

$consulta_slides = mysqli_query ($conexao, "SELECT foto, titulo, frase, link FROM admin_slides WHERE ativo='S' ORDER BY seq") or die (mysqli_error());

$conta_slides = mysqli_num_rows ($consulta_slides);

if ($conta_slides > 0) {
?>

<div class="container-fluid">
	<div class="row" id="slide">
        <div class="col-md-12" id="slide-imagens">
			<div id="carousel-linde" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php
					for ($i = 0; $i < $conta_slides; $i++) {
						if ($i == 0) {
					?>
                    <li data-target="#carousel-linde" data-slide-to="<?php echo $i; ?>" class="active"></li>
                    <?php
						}
						else {
					?>
                    <li data-target="#carousel-linde" data-slide-to="<?php echo $i; ?>"></li>
                    <?php		
						}
					}
					?>
                </ol>
                
                <div class="carousel-inner" role="listbox">
                    <?php
					$s = 0;
					
					while ($dados_slides = mysqli_fetch_array ($consulta_slides)) {
						$slide_foto 	= $dados_slides['foto'];
						$slide_titulo 	= $dados_slides['titulo'];
						$slide_frase 	= $dados_slides['frase'];
						$slide_link 	= $dados_slides['link'];
						
						if ($slide_titulo != "") {
							$slide_titulo_ok = $slide_titulo;	
						}
						else {
							$slide_titulo_ok = "";
						}
						
						$s++;
					?>
                    <div class="item<?php if ($s == 1) { echo " active"; } ?>">
                    	<?php if ($slide_link != "") { ?><a href="<?php echo $slide_link; ?>" title="<?php echo $slide_titulo_ok; ?>"><?php } ?>
                        <img src="img/slide/<?php echo $slide_foto; ?>" alt="<?php echo $slide_titulo_ok; ?>">
                        <?php if ($slide_link != "") { ?></a><?php } ?>
                        <div class="carousel-caption">
                        	<h3 class="hidden-xs"><?php echo $slide_titulo_ok; ?></h3>
                            <p><?php echo $slide_frase; ?></p>
                        </div>
                    </div>
                    <?php
					}
					?>
                </div>
                
                <a class="left carousel-control" href="#carousel-linde" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-linde" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
	</div>
</div>

<?php
}
?>
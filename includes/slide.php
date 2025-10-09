<?php
require_once ("funcoes/conexao.php");

$c_slides = mysqli_query ($conexao, "SELECT foto, titulo, frase, link FROM admin_slides WHERE ativo='S' ORDER BY seq") or die (mysqli_error($conexao));

if (mysqli_num_rows ($c_slides) > 0) {
?>

<div class="container-fluid">
	<div class="row" id="slide">
        <div class="col-12 p-0">
            <div id="carouselLinde" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php
                    for ($i = 0; $i < mysqli_num_rows ($c_slides); $i++) {
                        if ($i == 0) {
                            ?>
                            <button type="button" data-bs-target="#carouselLinde" data-bs-slide-to="<?php echo $i; ?>" class="active" aria-current="true" aria-label="Slide <?php echo $i + 1; ?>"></button>
                            <?php
                        }
                        else {
                            ?>
                            <button type="button" data-bs-target="#carouselLinde" data-bs-slide-to="<?php echo $i; ?>" aria-label="Slide <?php echo $i + 1; ?>"></button>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="carousel-inner">
                    <?php
                    $s = 0;

                    while ($d_slides = mysqli_fetch_array ($c_slides)) {
                        ?>
                        <div class="carousel-item<?php if ($s == 0) { echo " active"; } ?>" data-bs-interval="3000">
                            <?php if ($d_slides['link'] != "") { ?><a href="<?php echo $d_slides['link']; ?>" title="<?php echo ($d_slides['titulo'] != '') ? $d_slides['titulo'] : ''; ?>"><?php } ?>
                                <img src="img/slide/<?php echo $d_slides['foto']; ?>" class="d-block w-100" alt="<?php echo ($d_slides['titulo'] != '') ? $d_slides['titulo'] : ''; ?>">
                            <?php if ($d_slides['link'] != "") { ?></a><?php } ?>
                            <div class="carousel-caption d-none d-md-block">
                                <h5><?php echo ($d_slides['titulo'] != '') ? $d_slides['titulo'] : ''; ?></h5>
                                <p><?php echo $d_slides['frase']; ?></p>
                            </div>
                        </div>
                        <?php
                        $s++;
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselLinde" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselLinde" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
	</div>
</div>

<?php
}
?>
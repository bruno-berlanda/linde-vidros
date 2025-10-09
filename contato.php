<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT contato AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Contato - Linde Vidros";

$description = "Entre em contato conosco, será um prazer atendê-lo, você pode entrar em contato via telefone, fax, e-mail ou por um formulário de contato. Encontre a Linde Vidros também nas redes sociais" . $tg;
$keywords = "fale com a linde vidros, contato linde vidros, telefone linde vidros, endereço linde vidros, e-mail linde vidros";

$og_url = "https://www.lindevidros.com.br/contato";
$og_name = "Contato";

$submenu_id = "CONTATO";

require_once ("includes/links.php");
?>

<?php include_once ("includes/cabecalho.php"); ?>

<div>

<?php include_once ("includes/analyticstracking.php"); // Google Analytics ?>

<?php include_once ("includes/topo.php"); ?>

<?php include_once ("includes/menu.php"); ?>

<?php //include_once ("includes/logo.php"); ?>

<div class="container-fluid">
	<div class="row">
    	<div class="col-12 bg-light py-4 border-bottom">
        	<div class="container">
            	<div class="row">
                    <div class="col-12">
                    	<h1 class="text-azul-linde">Contato</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row mt-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-6">
                    <div class="border rounded p-3 text-center">
                        <small class="text-secondary"><i class="fa-solid fa-phone fa-fw"></i> TELEFONE</small>
                        <p class="lead mt-2"><a href="https://api.whatsapp.com/send?phone=554736414444" class="link-underline link-underline-opacity-0">47 3641 4444</a></p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="border rounded p-3 text-center">
                        <small class="text-secondary"><i class="fa-solid fa-envelope fa-fw"></i> E-MAIL</small>
                        <p class="lead mt-2"><a href="mailto:linde@lindevidros.com.br" class="link-underline link-underline-opacity-0">linde@lindevidros.com.br</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row my-4">
    	<div class="col-12 col-md-4">
            <h2>Endereço</h2>
        
            <address>
                <p>
                Avenida General Luiz Carlos Pereira Tourinho, 4197 <br>
                Tijuco Preto <br>
                Paralela a BR 116 <br>
                Rio Negro - PR <br>
                CEP 83885-302
                </p>
            </address>
        </div>
        <div class="col-12 col-md-8">
			<h2>Trabalhe Conosco</h2>
            
            <?php include_once ("includes/trabalhe.php"); // Trabalhe Conosco ?>
            </div>
        </div>
    </div>
</div>

<?php include_once ("includes/mapa.php"); ?>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
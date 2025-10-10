<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT vidro_habitat AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Vidros Habitat, proteção solar para residências - Linde Vidros";

$description = "Os Vidros Habitat trazem proteção solar para sua residência, protegendo você e seus móveis do calor e dos raios UV" . $tg;
$keywords = "Vidro Habitat, Vidros Habitat, Proteção Solar, Proteção UV, Linde Vidros, distribuidora de vidro, beneficiadora de vidro, fábrica de vidro";

$og_url = "https://www.lindevidros.com.br/vidro-habitat";
$og_name = "Vidros Habitat";

$submenu_id = "E-VH";

require_once ("includes/links.php");
?>

<?php include_once ("includes/cabecalho.php"); ?>

<body>

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
                        <h1 class="text-azul-linde">Vidro Habitat</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-3">
    	<div class="col-md-12">
        	<img src="img/img_habitat.jpg" alt="Vidro Habitat" class="rounded img-fluid">
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-9">
			<img src="img/habitat_cebrace.png" alt="Vidro Habitat" class="img-fluid float-start me-4 mb-4">
            
            <p class="text-justify">O <strong>Vidro Habitat</strong> traz uma segurança para você, sua casa e seus móveis e revestimentos contra o calor e os raios UV.</p>
            
            <p class="text-justify">Esse vidro tem a característica de diminuir o nível da entrada de ruído na residência quando laminado. O que torna a casa mais tranquila e confortável, independentemente de onde tenha sido construída.</p>
            
            <p class="text-justify">Além de levar inovação e modernidade a todos os tipos de residência, seu design permite a utilização nos mais diversos ambientes, além de possibilitar uma harmônica integração da parte interna com a parte externa. Amplamente versáteis, os <strong>Vidros Habitat</strong> podem ser adquiridos com ou sem aspecto refletivo, conferindo maior privacidade para o cliente ou transparência.</p>
            
            <p class="text-justify">Por reduzir a entrada de calor e deixar o ambiente mais agradável na residência, não será necessário o constante uso do ar-condicionado, permitindo uma considerável economia de energia elétrica.</p>

            <br>

            <div class="alert alert-warning text-center" role="alert">
                <i class="fa-solid fa-sun fa-3x"></i>
                <br><br>
                Saiba mais sobre os <a href="vidro-controle-solar" title="Vidro de Controle Solar" class="text-danger">Vidros de Controle Solar</a>.
            </div>

            <br>
            
            <p><strong>Vantagens do Vidro Habitat Temperado:</strong></p>
            <ul>
            	<li>Segurança contra cortes e acidentes</li>
                <li>Segurança contra roubos</li>
                <li>Aplicação autoportante, como um vidro sem a estrutura metálica</li>
            </ul>
            
            <p><strong>Vantagens do Vidro Habitat Laminado:</strong></p>
            <ul>
            	<li>Segurança contra cortes e acidentes</li>
                <li>Segurança contra roubos</li>
                <li>Protege a sua família dos danos causados pelos raios UV</li>
                <li>Protege os seus móveis e qualquer objeto que esteja exposto ao sol, evitando o desbotamento</li>
                <li>Diminui a passagem do ruído</li>
            </ul>
            
            <br>
            
            <h2>Cores dos Vidros Habitat</h2>
            
            <p class="text-justify">Você pode ter todos os benefícios de proteção solar e escolher entre um aspecto refletivo ou uma aparência mais neutra.</p>
            
            <div class="row">
            	<div class="col-12">
                	<h3>Vidro Habitat Refletivo</h3>
                    
                    <p class="text-justify">Possui um aspecto espelhado. Oferece privacidade, pois inibe a visão de fora para dentro durante o dia, sem prejudicar a visibilidade de quem está no interior do ambiente.</p>
                    
                    <p><strong>Espessuras (mm):</strong></p>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="40%"></th>
                                <th width="30%">TEMPERADO</th>
                                <th width="30%">LAMINADO</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Cinza</td>
                            <td>4, 6, 8, 10</td>
                            <td>3+3, 4+4, 4+6, 6+6</td>
                        </tr>
                        <tr>
                            <td>Esmeralda</td>
                            <td>4, 6, 8, 10</td>
                            <td>3+3, 4+4, 4+6, 6+6</td>
                        </tr>
                        <tr>
                            <td>Champanhe</td>
                            <td>4, 6, 8, 10</td>
                            <td>3+3, 4+4, 4+6, 6+6</td>
                        </tr>
                        </tbody>
                    </table>
                    
                    <p><strong>Características:</strong></p>
                    
                    <table class="table table-bordered">
                        <tr>
                            <td class="text-body-tertiary">Características</td>
                            <td width="18%" class="text-center">Cinza</td>
                            <td width="18%" class="text-center">Esmeralda</td>
                            <td width="18%" class="text-center">Champanhe</td>
                            <td width="18%" class="text-center bg-light text-secondary">Vidro Incolor</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Proteção de Calor</td>
                            <td class="text-center">71%</td>
                            <td class="text-center">66%</td>
                            <td class="text-center">50%</td>
                            <td class="text-center bg-light text-secondary">15%</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Proteção UV</td>
                            <td class="text-center">84%</td>
                            <td class="text-center">96%</td>
                            <td class="text-center">91%</td>
                            <td class="text-center bg-light text-secondary"><i class="fa-solid fa-xmark"></i></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Proteção UV</td>
                            <td class="text-center"><i class="fa-solid fa-dollar-sign"></i><i class="fa-solid fa-dollar-sign"></i></td>
                            <td class="text-center"><i class="fa-solid fa-dollar-sign"></i><i class="fa-solid fa-dollar-sign"></i></td>
                            <td class="text-center"><i class="fa-solid fa-dollar-sign"></i></td>
                            <td class="text-center bg-light text-secondary"><i class="fa-solid fa-xmark"></i></td>
                        </tr>
                    </table>
                </div>
                
                <div class="col-12">
                	<h3>Vidro Habitat Neutro</h3>
                    
                    <p class="text-justify">Recebe uma metalização mais suave dando uma aparência semelhante ao vidro comum, e com isso deixa a casa mais iluminada, integrada com o ambiente externo e protegida dos raios UV.</p>
                    
                    <p><strong>Espessuras (mm):</strong></p>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="40%"></th>
                                <th width="30%">TEMPERADO</th>
                                <th width="30%">LAMINADO</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Cinza</td>
                            <td>4, 6, 8, 10</td>
                            <td>3+3, 4+4, 4+6, 6+6</td>
                        </tr>
                        <tr>
                            <td>Cinza Claro</td>
                            <td>4, 6, 8, 10</td>
                            <td>3+3, 4+4, 4+6, 6+6</td>
                        </tr>
                        <tr>
                            <td>Incolor</td>
                            <td>4, 6, 8, 10</td>
                            <td>3+3, 4+4, 4+6, 6+6</td>
                        </tr>
                        </tbody>
                    </table>
                    
                    <p><strong>Características:</strong></p>

                    <table class="table table-bordered">
                        <tr>
                            <td class="text-body-tertiary">Características</td>
                            <td width="18%" class="text-center">Cinza</td>
                            <td width="18%" class="text-center">Cinza Claro</td>
                            <td width="18%" class="text-center">Incolor</td>
                            <td width="18%" class="text-center bg-light text-secondary">Vidro Incolor</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Proteção de Calor</td>
                            <td class="text-center">45%</td>
                            <td class="text-center">39%</td>
                            <td class="text-center">32%</td>
                            <td class="text-center bg-light text-secondary">15%</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Proteção UV</td>
                            <td class="text-center">67%</td>
                            <td class="text-center">60%</td>
                            <td class="text-center">57%</td>
                            <td class="text-center bg-light text-secondary"><i class="fa-solid fa-xmark"></i></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Proteção UV</td>
                            <td class="text-center"><i class="fa-solid fa-dollar-sign"></i><i class="fa-solid fa-dollar-sign"></i></td>
                            <td class="text-center"><i class="fa-solid fa-dollar-sign"></i><i class="fa-solid fa-dollar-sign"></i></td>
                            <td class="text-center"><i class="fa-solid fa-dollar-sign"></i></td>
                            <td class="text-center bg-light text-secondary"><i class="fa-solid fa-xmark"></i></td>
                        </tr>
                    </table>
                </div>
            </div>
                        
            <p>Dados referentes a vidros na espessura de 4 mm. Quando laminado, o desempenho de proteção UV do produto é de 99,6%</p>

            <hr>

            <div class="ratio ratio-16x9">
        		<iframe width="100%" height="100%" src="https://www.youtube.com/embed/6RqjDqM8FT8" frameborder="0" allowfullscreen></iframe>
        	</div>
        </div>
        <div class="col-md-3">
			<?php include_once ("includes/menu_engenharia_produtos.php"); ?>
        </div>
    </div>
    
    <div class="row my-4">
    	<div class="col-12">
        	<hr>
            
            <div class="row">
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/habitat1.jpg" rel="shadowbox[vocation]" title="Vidro Habitat">
                        <img src="img/produtos/miniatura/habitat1.jpg" alt="Vidro Habitat" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/habitat2.jpg" rel="shadowbox[vocation]" title="Vidro Habitat">
                        <img src="img/produtos/miniatura/habitat2.jpg" alt="Vidro Habitat" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/habitat3.jpg" rel="shadowbox[vocation]" title="Vidro Habitat">
                        <img src="img/produtos/miniatura/habitat3.jpg" alt="Vidro Habitat" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/habitat4.jpg" rel="shadowbox[vocation]" title="Vidro Habitat">
                        <img src="img/produtos/miniatura/habitat4.jpg" alt="Vidro Habitat" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/habitat5.jpg" rel="shadowbox[vocation]" title="Vidro Habitat">
                        <img src="img/produtos/miniatura/habitat5.jpg" alt="Vidro Habitat" class="img-fluid img-thumbnail">
                    </a>
                </div>
                <div class="col-4 col-md-2 mb-2">
                    <a href="img/produtos/grande/habitat6.jpg" rel="shadowbox[vocation]" title="Vidro Habitat">
                        <img src="img/produtos/miniatura/habitat6.jpg" alt="Vidro Habitat" class="img-fluid img-thumbnail">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
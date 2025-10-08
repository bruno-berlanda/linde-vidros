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
    	<h1>Super Combo</h1>
    </div>
</div>

<?php
include_once("includes/msgs.php");
?>

<?php if ($p_promocoes == "S") { ?>

<div class="row">
    <div class="col-md-12">
        <table>
        	<tr>
            	<td><img src="img/combo/combo24032017_01.jpg" class="img-responsive"></td>
            </tr>
            <tr>
            	<td><img src="img/combo/combo24032017_02.jpg" class="img-responsive"></td>
            </tr>
            <tr>
            	<td><img src="img/combo/combo24032017_03.jpg" class="img-responsive"></td>
            </tr>
            <tr>
            	<td><img src="img/combo/combo24032017_04.jpg" class="img-responsive"></td>
            </tr>
            <tr>
            	<td><img src="img/combo/combo24032017_05.jpg" class="img-responsive"></td>
            </tr>
            <tr>
            	<td><img src="img/combo/combo24032017_06.jpg" class="img-responsive"></td>
            </tr>
            <tr>
            	<td><img src="img/combo/combo24032017_07.jpg" class="img-responsive"></td>
            </tr>
            <tr>
            	<td><img src="img/combo/combo24032017_08.jpg" class="img-responsive"></td>
            </tr>
            <tr>
            	<td><img src="img/combo/combo24032017_09.jpg" class="img-responsive"></td>
            </tr>
            <tr>
            	<td><img src="img/combo/combo24032017_10.jpg" class="img-responsive"></td>
            </tr>
        </table>        
	</div>
</div>

<?php } // Permissão para acessar a página ?>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
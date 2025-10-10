<!-- --------------------------------------------------------------------------------------------------------------------------------------------
Arquivos Javascript
--------------------------------------------------------------------------------------------------------------------------------------------- -->
<script src="../js/jquery.mask.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- Tail Select -->
<script src="js/tail.select-full.min.js?<?php echo filemtime('js/tail.select-full.min.js'); ?>"></script>
<script src="js/config-tail.select.js?<?php echo filemtime('js/config-tail.select.js'); ?>"></script>

<!-- Shadowbox -->
<script type="text/javascript" src="../js/shadowbox/shadowbox.js"></script>
<link rel="stylesheet" href="../js/shadowbox/shadowbox.css" type="text/css">
<script type="text/javascript">
Shadowbox.init({
    language: 'pt',
    players:  ['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv'],
});
</script>

<!-- Popover -->
<script type="text/javascript">
$(function () {
	$("[rel='popover']").popover();
});
</script>

<script>
$('#aviso-tabelas')
	.hide()
	.delay('1000')
	.fadeIn('1000');

$('#atualizar-senha')
	.hide()
	.delay('1500')
	.fadeIn('slow');

$('#aviso-navegador')
	.hide()
	.delay('1500')
	.fadeIn('slow');

$('#aviso-pedido')
	.hide()
	.delay('1500')
	.fadeIn('slow');
</script>

<!-- Máscaras Formulários -->
<script type="text/javascript">
$(document).ready(function() {
	$('#inputPrecoUn').mask('00000000.00', {reverse: true});
	$('#inputRota').mask('000');
	$('#inputUF').mask('SS');
	
	/* Orçamento Insulado */
	$('#inputValor1').mask('0000.00', {reverse: true});
	$('#inputValor2').mask('0000.00', {reverse: true});
	$('#inputValor3').mask('0000.00', {reverse: true});
	$('#inputImposto').mask('0000000.00', {reverse: true});

	/* Pedidos Moveleiro */
    $('#inputIPI').mask('00.00', {reverse: true});
});
</script>
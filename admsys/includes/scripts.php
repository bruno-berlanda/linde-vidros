<!-- --------------------------------------------------------------------------------------------------------------------------------------------
Arquivos Javascript
--------------------------------------------------------------------------------------------------------------------------------------------- -->
<script src="../js/jquery.mask.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<!-- Shadowbox -->
<script type="text/javascript" src="../js/shadowbox/shadowbox.js"></script>
<link rel="stylesheet" href="../js/shadowbox/shadowbox.css" type="text/css" />
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

<!-- Máscaras Formulários -->
<script type="text/javascript">
$(document).ready(function() {
	$('#inputFone').mask('00 0000-0000');
	$('#inputData').mask('00/00/0000');
	
	/* Currículos */
	$('#inputDataEntrevista').mask('00/00/0000');
	$('#inputHoraEntrevista').mask('00:00');
	
	/* Entrevistas */
	$('#inputDataEnt').mask('00/00/0000');
	$('#inputHoraEnt').mask('00:00');
	
	/* Representantes */
	$('#inputTelFixo').mask('00 0000-0000');
	$('#inputTelCelular1').mask('00 00000-0000');
	$('#inputTelCelular2').mask('00 00000-0000');
	
	/* Pesquisa */
	$('#inputCliente').mask('00000');
	
	/* Produtos */
	$('#inputPeso').mask('00.000', {reverse: true});
	
	/* Embalagens */
	$('#inputTipoEmbalagem').mask('000');
});
</script>
<!-- --------------------------------------------------------------------------------------------------------------------------------------------
Arquivos Javascript
--------------------------------------------------------------------------------------------------------------------------------------------- -->
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery.mask.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<!-- Máscaras -->
<script type="text/javascript">
$(document).ready(function() {
	$('#inputDataNasc').mask('00/00/0000');
	$('#inputFone').mask('00 0000-0000');
	$('#inputCelular').mask('00 00000-0000');
	$('#inputCEP').mask('00.000-000');
	
	$('#inputDataInicio').mask('00/0000');
	$('#inputDataSaida').mask('00/0000');
	$('#inputRemuneracao').mask('000.000.000.000.000,00', {reverse: true});
	
	$('#inputCargaHoraria').mask('0000');
	
	$('#inputDataConclusao').mask('00/0000');
});
</script>

<!-- Shadowbox -->
<script type="text/javascript" src="../js/shadowbox/shadowbox.js"></script>
<link rel="stylesheet" href="../js/shadowbox/shadowbox.css" type="text/css" />
<script type="text/javascript">
Shadowbox.init({
    language: 'pt',
    players:  ['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv'],
});
</script>

<script type="text/javascript">
var isNS = (navigator.appName == "Netscape") ? 1 : 0; var EnableRightClick = 0; if(isNS) document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP); function mischandler(){ if(EnableRightClick==1){ return true; } else {return false; } } function mousehandler(e){ if(EnableRightClick==1){ return true; } var myevent = (isNS) ? e : event; var eventbutton = (isNS) ? myevent.which : myevent.button; if((eventbutton==2)||(eventbutton==3)) return false; } function keyhandler(e) { var myevent = (isNS) ? e : window.event; if (myevent.keyCode==96) EnableRightClick = 1; return; } document.oncontextmenu = mischandler; document.onkeypress = keyhandler; document.onmousedown = mousehandler; document.onmouseup = mousehandler;
</script>
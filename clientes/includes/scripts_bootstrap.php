<!-- --------------------------------------------------------------------------------------------------------------------------------------------
Arquivos Javascript
--------------------------------------------------------------------------------------------------------------------------------------------- -->
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery.mask.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<!-- Popover -->
<script type="text/javascript">
$(function () {
	$("[rel='popover']").popover();
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

<!-- Máscaras Formulários -->
<script type="text/javascript">
var NovoDigitoCel = function (val) {
  return val.replace(/\D/g, '').length === 11 ? '00 00000-0000' : '00 0000-00009';
},
spOptions = {
  onKeyPress: function(val, e, field, options) {
      field.mask(NovoDigitoCel.apply({}, arguments), options);
    }
};

$(document).ready(function() {
	$('#inputF1C1').mask(NovoDigitoCel, spOptions);
	$('#inputF2C1').mask(NovoDigitoCel, spOptions);
	$('#inputF1C2').mask(NovoDigitoCel, spOptions);
	$('#inputF2C2').mask(NovoDigitoCel, spOptions);
	
	$('#inputNF').mask('0000000000', {reverse: true});
	$('#inputNFSerie').mask('00', {reverse: true});
	
	/* Orçamento Insulado */
	$('#inputValor1').mask('0000.00', {reverse: true});
	$('#inputValor2').mask('0000.00', {reverse: true});
	$('#inputValor3').mask('0000.00', {reverse: true});
	$('#inputImposto').mask('0000000.00', {reverse: true});
});
</script>

<!--
<script type="text/javascript">
var isNS = (navigator.appName == "Netscape") ? 1 : 0; var EnableRightClick = 0; if(isNS) document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP); function mischandler(){ if(EnableRightClick==1){ return true; } else {return false; } } function mousehandler(e){ if(EnableRightClick==1){ return true; } var myevent = (isNS) ? e : event; var eventbutton = (isNS) ? myevent.which : myevent.button; if((eventbutton==2)||(eventbutton==3)) return false; } function keyhandler(e) { var myevent = (isNS) ? e : window.event; if (myevent.keyCode==96) EnableRightClick = 1; return; } document.oncontextmenu = mischandler; document.onkeypress = keyhandler; document.onmousedown = mousehandler; document.onmouseup = mousehandler;
</script>
-->
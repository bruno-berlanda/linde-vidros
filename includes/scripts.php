<!-- --------------------------------------------------------------------------------------------------------------------------------------------
Arquivos Javascript
--------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- Scripts Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- Máscaras Formulários -->
<script src="js/jquery.mask.min.js"></script>
<!-- Chart -->
<script src="js/chart.min.js"></script>

<!-- reCaptcha -->
<script src='https://www.google.com/recaptcha/api.js?hl=pt-BR'></script>

<script type="text/javascript">
$('.carousel').carousel({
  interval: 4000
})
</script>

<!-- Tooltip -->
<script type="text/javascript">
	$('#tooltip-linde').tooltip()
	$('#tooltip-facebook1').tooltip()
	$('#tooltip-facebook2').tooltip()
	$('#tooltip-instagram1').tooltip()
	$('#tooltip-instagram2').tooltip()
	$('#tooltip-linkedin1').tooltip()
	$('#tooltip-linkedin2').tooltip()
	$('#tooltip-blog1').tooltip()
	$('#tooltip-blog2').tooltip()
	$('#tooltip-email1').tooltip()
	$('#tooltip-cartoes').tooltip()
	$('#tooltip-habitat').tooltip()
	$('#tooltip-cor1').tooltip()
	$('#tooltip-cor2').tooltip()
	$('#tooltip-cor3').tooltip()
	$('#tooltip-cor4').tooltip()
	$('#tooltip-cor5').tooltip()
	$('#tooltip-cor6').tooltip()
	$('#tooltip-cor7').tooltip()
	
	$('#tooltip-merlin').tooltip()
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
	$('#inputTelefoneTodos').mask(NovoDigitoCel, spOptions);
	$('#inputTelefone').mask('00 0000-0000');
	$('#inputFax').mask('00 0000-0000');
	$('#inputCelular').mask(NovoDigitoCel, spOptions);
	$('#inputCNPJ').mask('00.000.000/0000-00');
	$('#inputCNPJLogin1').mask('00.000.000/0000-00');
	$('#inputCNPJLogin2').mask('00.000.000/0000-00');
	$('#inputCNPJ').mask('00.000.000/0000-00');
	$('#inputCPF').mask('000.000.000-00');
	$('#inputCPF2').mask('000.000.000-00');
	$('#inputCEP').mask('00000-000');
	$('#inputDinheiro').mask('000.000.000.000.000,00', {reverse: true});
});
</script>

<!-- Shadowbox -->
<script type="text/javascript" src="js/shadowbox/shadowbox.js"></script>
<link rel="stylesheet" href="js/shadowbox/shadowbox.css" type="text/css">
<script type="text/javascript">
Shadowbox.init({
    language: 'pt',
    players:  ['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv'],
});
</script>

<!-- Verifica se o CPF já está cadastrado -->
<script type="text/javascript">
$(function(){
	$("input[name='cpf']").blur( function(){
		var cpf = $("input[name='cpf']").val();
		$.post('funcoes/verifica_cpf.php',{cpf: cpf},function(data){
			$('#resultado').html(data);
		});
	});
});
</script>

<!-- Verifica se o CNPJ já está cadastrado -->
<script type="text/javascript">
$(function(){
	$("input[name='cnpjj']").blur( function(){
		var cnpjj = $("input[name='cnpjj']").val();
		$.post('funcoes/verifica_cnpj.php',{cnpjj: cnpjj},function(data){
			$('#resultado').html(data);
		});
	});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('a[href="#top"]').fadeIn();
        } else {
            $('a[href="#top"]').fadeOut();
        }
    });

    $('a[href="#top"]').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });
});
</script>

<!-- BEGIN JIVOSITE CODE {literal} -->
<!--
<script type='text/javascript'>
	(function(){ var widget_id = '7NC6lfGM7p';var d=document;var w=window;function l(){
	var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>
-->
<!-- {/literal} END JIVOSITE CODE -->
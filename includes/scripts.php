<!-- --------------------------------------------------------------------------------------------------------------------------------------------
Arquivos Javascript
--------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- Scripts Bootstrap -->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- Máscaras Formulários -->
<script src="js/jquery.mask.min.js"></script>

<!-- reCaptcha -->
<script src='https://www.google.com/recaptcha/api.js?hl=pt-BR'></script>

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
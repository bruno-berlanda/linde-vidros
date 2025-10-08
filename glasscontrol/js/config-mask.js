var NovoDigitoCel = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '00 00000-0000' : '00 0000-00009';
    },
    spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(NovoDigitoCel.apply({}, arguments), options);
        }
    };
$(document).ready(function() {
    $('#inputFone1, #inputFone2, #inputFone3').mask(NovoDigitoCel, spOptions);
});

$('#inputPlaca').mask('SSS-0A00');
$('#inputRenavam').mask('00000000000');
$('#inputAno').mask('0000');

$('#inputComissao').mask('00.0', {reverse: true});

/* Viagem */
$('#inputKmSaida').mask('000000');
$('#inputKmChegada').mask('000000');
$('#inputPeso').mask('00.00', {reverse: false});
$('#inputValorTon').mask('000.00', {reverse: true});
$('#inputValorDespesa').mask('000000.00', {reverse: true});
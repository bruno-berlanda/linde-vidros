<?php
/* *****************************************************************************************************************************************
CÁLCULO % DE PREENCHIMENTO DO CURRÍCULO
***************************************************************************************************************************************** */
// DADOS BÁSICOS
if ($sexoUsuario != '') { $vlr01 = 1; }
if ($estcivUsuario != '') { $vlr02 = 1; }
if ($filhosUsuario != '') { $vlr03 = 1; }
if ($rgUsuario != '') { $vlr04 = 1; }
if ($uf_rgUsuario != '') { $vlr05 = 1; }
if ($nasc_diaUsuario != '') { $vlr06 = 1; }
if ($nasc_mesUsuario != '') { $vlr07 = 1; }
if ($nasc_anoUsuario != '') { $vlr08 = 1; }
if ($foneUsuario != '') { $vlr09 = 1; }
if ($recadosUsuario != '') { $vlr10 = 1; }
if ($enderecoUsuario != '') { $vlr11 = 1; }
if ($numeroUsuario != '') { $vlr12 = 1; }
if ($bairroUsuario != '') { $vlr13 = 1; }
if ($cepUsuario != '') { $vlr14 = 1; }
if ($cidadeUsuario != '') { $vlr15 = 1; }
if ($ufUsuario != '') { $vlr16 = 1; }
if ($empregUsuario != '') { $vlr17 = 1; }
if ($situacaoUsuario != '') { $vlr18 = 1; }
if ($cnhUsuario != '') { $vlr19 = 1; }
if ($fotoUsuario != '') { $vlr20 = 1; }

$porc_dados = $vlr01 + $vlr02 + $vlr03 + $vlr04 + $vlr05 + $vlr06 + $vlr07 + $vlr08 + $vlr09 + $vlr10 + $vlr11 + $vlr12 + $vlr13 + $vlr14 + $vlr15 + $vlr16 + $vlr17 + $vlr18 + $vlr19 + $vlr20;

// OUTRAS INFORMAÇÕES
/*
if ($usuarioEsportes != '') { $vlr21 = 1.66; }
if ($usuarioHobbies != '') { $vlr22 = 1.66; }
if ($usuarioLivros != '') { $vlr23 = 1.66; }
if ($usuarioMusica != '') { $vlr24 = 1.66; }
if ($usuarioPaixoes != '') { $vlr25 = 1.66; }
if ($usuarioTrabsocial != '') { $vlr26 = 1.66; }

$porc_info = $vlr21 + $vlr22 + $vlr23 + $vlr24 + $vlr25 + $vlr26;
*/

// PROFISSIONAL
if ($areaUsuario != '') { $vlr27 = 2; }
if ($nivelUsuario != '') { $vlr28 = 2; }
if ($salarioUsuario != '') { $vlr29 = 2; }
if ($objetivoUsuario != '') { $vlr30 = 2; }
if ($miniUsuario != '') { $vlr31 = 2; }

$porc_profissional = $vlr27 + $vlr28 + $vlr29 + $vlr30 + $vlr31;

// ESCOLARIDADE
if ($contaEscolaridade >= 1) {
	$porc_escolaridade = 15;
}

// EXPERIÊNCIAS
if ($contaExperiencias >= 1) {
	$porc_experiencias = 15;
}

// FORMAÇÃO
if ($contaFormacao >= 1) {
	$porc_formacao = 15;
}

// INFORMÁTICA
if ($contaInformatica >= 1) {
	$porc_informatica = 15;
}

// LINGUAS
if ($contaLinguas >= 1) {
	$porc_linguas = 10;
}

/* ************************************************ */
$porc_total = $porc_dados + $porc_profissional + $porc_escolaridade + $porc_experiencias + $porc_formacao + $porc_informatica + $porc_linguas;
// Arredonda
$porc_total = round($porc_total);
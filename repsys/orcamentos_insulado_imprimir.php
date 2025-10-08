<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_sistema.php");
include_once ("includes/usuario_logado.php");
?>

<?php
if ($p_insulado == "S") {
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="Intranet - Linde Vidros">
	<meta name="author" content="Bruno Berlanda">
	<link rel="shortcut icon" href="img/favicon.ico">
	<title>Intranet :: Linde Vidros</title>
    
    <link rel="stylesheet" href="css/orcamento_insulado.css?<?php echo filemtime('css/orcamento_insulado.css'); ?>">
    <link rel="stylesheet" href="../css/fontawesome-all.min.css?<?php echo filemtime('../css/fontawesome-all.min.css'); ?>">
</head>

<body>

<?php
function tipo($x) {
	switch ($x) {
		case "": $descricao = ""; break;
		case "C": $descricao = "COMUM"; break;
		case "T": $descricao = "TEMPERADO"; break;
	}
	
	return $descricao;	
}

function medida($x) {
	$x = number_format($x, 3, ',', '.');
	
	return $x;	
}

function valor($x) {
	$x = number_format($x, 2, ',', '.');
	
	return $x;	
}
?>

<?php
$codigo = $_GET['orcamento'];

$c_orcamento = mysqli_query ($conexao, "SELECT * FROM insulado_orcamentos WHERE codigo='$codigo'") or die (mysqli_error());
	$dados1 = mysqli_fetch_array ($c_orcamento);
		$id_orcamento	= $dados1['id'];
		$data 			= $dados1['data'];
		$usuario 		= $dados1['usuario'];
		$cliente_cod 	= $dados1['cliente_cod'];
		$cliente_nome	= $dados1['cliente_nome'];
		$observacoes	= $dados1['observacoes'];
		$v1_vidro		= $dados1['vidro1_vidro'];
		$v1_esp 		= $dados1['vidro1_esp'];
		$v1_tipo		= $dados1['vidro1_tipo'];
		$v1_vlr			= $dados1['vidro1_vlr'];
		$v2_vidro		= $dados1['vidro2_vidro'];
		$v2_esp 		= $dados1['vidro2_esp'];
		$v2_tipo		= $dados1['vidro2_tipo'];
		$v2_vlr			= $dados1['vidro2_vlr'];
		$v3_vidro		= $dados1['vidro3_vidro'];
		$v3_esp 		= $dados1['vidro3_esp'];
		$v3_tipo		= $dados1['vidro3_tipo'];
		$v3_vlr			= $dados1['vidro3_vlr'];
		$camara1		= $dados1['camara1'];
		$camara2		= $dados1['camara2'];
		$tipo_camaras	= $dados1['tipo_camaras'];	
		$tipo_comp		= $dados1['tipo_composicao'];
		$gas 			= $dados1['gas'];
		$s_todas 		= $dados1['silicone_todas'];
		$s_cantos 		= $dados1['silicone_cantos'];
		$imposto 		= $dados1['imposto'];
		
		$n_id = str_pad($id_orcamento, 5, "0", STR_PAD_LEFT);
	
		$data = date('d/m/Y', strtotime($data));
		
		// Verifica se há peças com mais de 3m² onde obrigatoriamente é aplicado silicone (Duraseal / Duralite)
		$con_pecas_m2 = mysqli_query ($conexao, "SELECT id FROM insulado_pecas WHERE id_orcamento='$id_orcamento' AND m2_peca>='3'") or die (mysqli_error());
			$conta_pecas_m2 = mysqli_num_rows ($con_pecas_m2);
		
		if ($gas == "S") {
			$obs1 = "<i class=\"far fa-check-circle\"></i> <strong class=\"gas\">PEÇAS COM GÁS ARGÔNIO</strong>";	
		}
		else {
			$obs1 = "";
		}
		
		if ($s_todas == "S" && $s_cantos == "N") {
			$obs2 = "<i class=\"far fa-check-circle\"></i> <strong class=\"silicone\">TODAS AS PEÇAS COM SILICONE</strong>";
		}
		elseif ($s_todas == "N" && $s_cantos == "S") {
			$obs2 = "<i class=\"far fa-check-circle\"></i> <strong class=\"silicone\">PEÇAS COM SILICONE NOS CANTOS</strong>";
		}
		elseif ($tipo_camaras == "DUR" && $conta_pecas_m2 > 0 || $tipo_camaras == "DLT" && $conta_pecas_m2 > 0) {
			$obs2 = "<i class=\"far fa-check-circle\"></i> <strong class=\"silicone\">SILICONE APLICADO AUTOMATICAMENTE EM PEÇAS ACIMA DE 3M²</strong>";
		}
		else {
			$obs2 = "";
		}

		$c_usuario = mysqli_query ($conexao, "SELECT nome, email, fone1 FROM representantes WHERE id='$usuario'") or die (mysqli_error());
			$dados2 = mysqli_fetch_array ($c_usuario);
				$nome_usuario_orc 	= $dados2['nome'];
				$email_usuario_orc 	= $dados2['email'];
				$fone_usuario_orc 	= $dados2['fone1'];
				
				$nome_usuario_orc 	= strtr(strtoupper($nome_usuario_orc),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
		
		$c_insulado_1 = mysqli_query ($conexao, "SELECT nome_completo, descricao FROM insulado_tipos WHERE id='$camara1'") or die (mysqli_error());
			$dados3 = mysqli_fetch_array ($c_insulado_1);
				$nome_insulado_1 = $dados3['nome_completo'];
				$desc_insulado_1 = $dados3['descricao'];
				
		$c_insulado_2 = mysqli_query ($conexao, "SELECT nome_completo, descricao FROM insulado_tipos WHERE id='$camara2'") or die (mysqli_error());
			$dados4 = mysqli_fetch_array ($c_insulado_2);
				$nome_insulado_2 = $dados4['nome_completo'];
				$desc_insulado_2 = $dados4['descricao'];
		
		// Vidro 1
		if ($v1_vidro != null && $v1_esp != null && $v1_tipo != null) {
			$comp_v1 = $v1_vidro." ".$v1_esp."MM (".tipo($v1_tipo).")";
		}
		else {
			$comp_v1 = "";
		}
		
		// Vidro 2
		if ($v2_vidro != null && $v2_esp != null && $v2_tipo != null) {
			$comp_v2 = $v2_vidro." ".$v2_esp."MM (".tipo($v2_tipo).")";
		}
		else {
			$comp_v2 = "";
		}
		
		// Vidro 3
		if ($v3_vidro != null && $v3_esp != null && $v3_tipo != null) {
			$comp_v3 = $v3_vidro." ".$v3_esp."MM (".tipo($v3_tipo).")";
		}
		else {
			$comp_v3 = "";
		}

$c_pecas = mysqli_query ($conexao, "SELECT * FROM insulado_pecas WHERE id_orcamento='$id_orcamento'") or die (mysqli_error());
$conta_pecas = mysqli_num_rows ($c_pecas);
?>

<div class="topo">
	<div class="logo-linde">
    	<img src="img/logo.png">
    </div>
</div>

<div class="clear"></div>

<div class="titulo-orc">ORÇAMENTO DE VIDRO INSULADO</div>

<div class="tabela">
    <table>
        <tr>
            <td width="30%"><i class="fas fa-hashtag"></i> <br> <?php echo $n_id; ?></td>
            <td width="25%"><i class="far fa-calendar-alt"></i> <strong>DATA</strong> <br> <?php echo $data; ?></td>
            <td width="55%"><i class="fas fa-user"></i> <strong>CLIENTE</strong> <br> <?php echo $cliente_nome; ?></td>
        </tr>
        <tr>
            <td><i class="far fa-user"></i> <strong>VENDEDOR</strong> <br> <?php echo $nome_usuario_orc; ?></td>
            <td><i class="fas fa-phone"></i> <strong>TELEFONE</strong> <br> <?php echo $fone_usuario_orc; ?></td>
            <td><i class="fas fa-envelope"></i> <strong>E-MAIL</strong> <br> <?php echo $email_usuario_orc; ?></td>
        </tr>
    </table>
</div>

<div class="vidros-composicao">
    <i class="fas fa-list"></i> <strong>COMPOSIÇÃO:</strong>
    
    <table class="composicao">
    	<tr>
        	<td width="12%"></td>
            <td width="76%"><strong>DESCRIÇÃO</strong></td>
            <td width="12%" align="right"><strong>PREÇO M²</strong></td>
        </tr>
        <tr class="linha-vidro">
        	<td><i class="fas fa-folder"></i> <strong>VIDRO &nbsp;1</strong></td>
            <td><?php echo $comp_v1; ?></td>
            <td class="comp-valor"><?php echo "R$ ".valor($v1_vlr); ?></td>
        </tr>
        <tr class="linha-camara">
        	<td><i class="far fa-folder"></i> <strong>CÃMARA 1</strong></td>
            <td><?php echo $nome_insulado_1; ?></td>
            <td></td>
        </tr>        
        <tr class="linha-vidro">
        	<td><i class="fas fa-folder"></i> <strong>VIDRO &nbsp;2</strong></td>
            <td><?php echo $comp_v2; ?></td>
            <td class="comp-valor"><?php echo "R$ ".valor($v2_vlr); ?></td>
        </tr>
        <?php if ($tipo_comp == "T") { ?>
        <tr class="linha-camara">
        	<td><i class="far fa-folder"></i> <strong>CÃMARA 2</strong></td>
            <td><?php echo $nome_insulado_2; ?></td>
            <td></td>
        </tr>
        <tr class="linha-vidro">
        	<td><i class="fas fa-folder"></i> <strong>VIDRO &nbsp;3</strong></td>
            <td><?php echo $comp_v3; ?></td>
            <td class="comp-valor"><?php echo "R$ ".valor($v3_vlr); ?></td>
        </tr>
        <?php } ?>
    </table>
    
    <?php if ($obs1 != "" || $obs2 != "") { ?>
    <br>
    <table class="borda text-center">
    	<tr>
        	<?php if ($obs1 != "") { ?><td width="50%"><?php echo $obs1; ?></td><?php } ?>
            <?php if ($obs2 != "") { ?><td width="50%"><?php echo $obs2; ?></td><?php } ?>
        </tr>
    </table>
    <?php } ?>
    
    <?php if ($imposto > 0) { ?>
    <br>
    
    <i class="fas fa-dollar-sign"></i> <strong>IMPOSTO:</strong>
    
    <table class="composicao">
    	<tr class="linha-vidro">
        	<td width="12%"><i class="fas fa-percent fa-sm"></i> <strong>TOTAL</strong></td>
            <td width="76%"><?php echo $imposto; ?></td>
            <td width="12%"></td>
        </tr>
    </table>
    <?php } ?>
</div>

<div class="tabela">
    <table class="borda">
        <tr class="titulo">
            <td>#</td>
            <td>QTDE</td>
            <td>LARGURA</td>
            <td>ALTURA</td>
            <td>M² PEÇA</td>
            <td>R$ VIDRO 1</td>
            <td>R$ VIDRO 2</td>
            <?php if ($tipo_comp == "T") { ?>
            <td>R$ VIDRO 3</td>
            <?php } ?>
            <td>ML</td>
            <td>R$ PEÇA</td>
            <td>R$ TOTAL</td>
        </tr>
    <?php
    $n_cor = 0;
    
    $i = 1;
    
    while ($dados = mysqli_fetch_array ($c_pecas)) {
        $qtde 			= $dados['qtde'];
        $largura 		= $dados['largura'];
        $altura 		= $dados['altura'];
        $m2_peca 		= $dados['m2_peca'];
        $vlr_vidro1 	= $dados['vidro1_vlr'];
        $vlr_vidro2 	= $dados['vidro2_vlr'];
        $vlr_vidro3 	= $dados['vidro3_vlr'];
        $ml 			= $dados['ml'];
        $vlr_un 		= $dados['valor_un'];
        $vlr_total 		= $dados['valor_total'];
        
        // Coloração das linhas
        if ($n_cor == 0) {
            $cor_padrao = "#FFFFFF";
            $n_cor++;
        }
        else {
            $cor_padrao = "#F3F3F3";
            $n_cor = 0;
        }
    ?>
        <tr bgcolor="<?php echo $cor_padrao; ?>">
            <td><strong class="muted"><?php echo $i++; ?></strong></td>
            <td><?php echo $qtde; ?></td>
            <td><?php echo $largura; ?></td>
            <td><?php echo $altura; ?></td>
            <td><?php echo medida($m2_peca); ?></td>
            <td><?php echo valor($vlr_vidro1); ?></td>
            <td><?php echo valor($vlr_vidro2); ?></td>
            <?php if ($tipo_comp == "T") { ?>
            <td><?php echo valor($vlr_vidro3); ?></td>
            <?php } ?>
            <td><?php echo medida($ml); ?></td>
            <td><?php echo valor($vlr_un); ?></td>
            <td><?php echo valor($vlr_total); ?></td>
        </tr>
    <?php
    }
    
    $c_totais = mysqli_query ($conexao, "SELECT 
                            SUM(qtde) AS soma_qtde,
                            SUM(m2_total) AS soma_m2,
                            SUM(ml_total) AS soma_ml,
                            SUM(valor_total) AS soma_valor
                            FROM insulado_pecas
                            WHERE id_orcamento='$id_orcamento'
                            ") or die (mysqli_error());
    
    $dados = mysqli_fetch_array ($c_totais);
        $soma_qtde 		= $dados['soma_qtde'];
        $soma_m2 		= $dados['soma_m2'];
        $soma_vidro1 	= $dados['soma_vidro1'];
        $soma_vidro2 	= $dados['soma_vidro2'];
        $soma_ml 		= $dados['soma_ml'];
        $soma_valor 	= $dados['soma_valor'];
	
	// Imposto
	if ($imposto > 0) {
		$soma_imposto = $soma_valor + ($soma_valor * ($imposto/100));
	}
    ?>
        <tr class="total">
            <td></td>
            <td><?php echo $soma_qtde; ?></td>
            <td></td>
            <td></td>
            <td><?php echo medida($soma_m2); ?></td>
            <td></td>
            <td></td>
            <?php if ($tipo_comp == "T") { ?>
            <td></td>
            <?php } ?>
            <td><?php echo medida($soma_ml); ?></td>
            <td></td>
            <td><?php echo valor($soma_valor); ?></td>
        </tr>
        <?php if ($imposto > 0) { ?>
        <tr class="total-imposto">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <?php if ($tipo_comp == "T") { ?>
            <td></td>
            <?php } ?>
            <td colspan="2">VALOR TOTAL COM IMPOSTO >>></td>
            <td><?php echo valor($soma_imposto); ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<div class="obs">
<i class="fas fa-exclamation-circle"></i> <strong>OBSERVAÇÕES:</strong>
<div class="conteudo-obs">
	<?php echo $observacoes; ?>
</div>
</div>

<div class="desc-duplo">
	<?php echo $desc_insulado_1; ?>
    <br><br>
    <strong>ORÇAMENTO VÁLIDO POR 15 DIAS</strong>
</div>

<hr>

<div class="endereco">
	Avenida Luiz Carlos Pereira Tourinho, 4197 - Bairro Indústrial - Paralela a BR116 - Rio Negro - PR - CEP 83885-302
    <br>
    <strong>www.lindevidros.com.br</strong>
    
    <br><br>
    
    <img src="img/logos_parceiros.png">
</div>

</body>

</html>

<?php
} else {
	header ('Location: ../index.php?msgErro=Você não tem acesso para visualizar essa página');
}
?>
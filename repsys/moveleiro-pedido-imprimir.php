<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_sistema.php");
include_once ("includes/usuario_logado.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>Área do Representante : Linde Vidros</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/favicon.ico">
    
    <!-- CSS -->
    <link rel="stylesheet" href="css/moveleiro_imprimir.css?<?php echo filemtime('css/moveleiro_imprimir.css'); ?>">
</head>

<body>

<?php if ($p_pedmov_solicitar == "S" || $p_pedmov_gerenciar == "S") { ?>

<?php
$pedido = $_GET['pedido'];

$consulta_pedido = mysqli_query ($conexao, "SELECT * FROM moveleiro_pedidos WHERE codigo='$pedido'") or die (mysqli_error());
	$dados_pedido = mysqli_fetch_array ($consulta_pedido);
		$id_pedido 		= $dados_pedido['id'];
		$data 			= $dados_pedido['data'];
		$usuario 		= $dados_pedido['usuario'];
		$cliente_cod	= $dados_pedido['cliente_cod'];
		$cliente_nome	= $dados_pedido['cliente_nome'];
		$cliente_rota	= $dados_pedido['cliente_rota'];
		$cliente_cidade	= $dados_pedido['cliente_cidade'];
		$cliente_uf		= $dados_pedido['cliente_uf'];
		$pedido_id 		= $dados_pedido['pedido_id'];
		$forma_pgto 	= $dados_pedido['forma_pgto'];
		$prazo_entrega 	= $dados_pedido['prazo_entrega'];
		$transporte 	= $dados_pedido['transporte'];
		$frete 			= $dados_pedido['frete'];
		$obs 			= $dados_pedido['obs'];
		$status 		= $dados_pedido['status'];
		
		$sol_data 		= $dados_pedido['solicitado_data'];
		$sol_usuario 	= $dados_pedido['solicitado_usuario'];
		$rec_data 		= $dados_pedido['recebido_data'];
		$rec_usuario 	= $dados_pedido['recebido_usuario'];
		
		$n_id = str_pad($id_pedido, 5, "0", STR_PAD_LEFT);
	
		$prazo_entrega = date('d/m/Y', strtotime($prazo_entrega));
		
		switch ($transporte) {
			case "P":
				$transporte_desc = "PRÓPRIO";
				break;
			case "R":
				$transporte_desc = "RETIRA";
				break;
			case "T":
				$transporte_desc = "TRANSPORTADORA";
				break;
		}
		
		switch ($frete) {
			case "C":
				$frete_desc = "CIF";
				break;
			case "F":
				$frete_desc = "FOB";
				break;
		}
		
		/* ***** */
		
		$data 		= date('d/m/Y H:i:s', strtotime($data));
		$sol_data 	= date('d/m/Y H:i:s', strtotime($sol_data));
		$rec_data 	= date('d/m/Y H:i:s', strtotime($rec_data));

// Consulta itens
$consulta_itens = mysqli_query ($conexao, "SELECT * FROM moveleiro_itens WHERE id_pedido='$id_pedido'") or die (mysqli_error());

$conta_itens = mysqli_num_rows ($consulta_itens);
?>

<table>
	<tr>
    	<td width="40%"><img src="img/logo_pb.jpg" alt="Linde Vidros"></td>
        <td width="60%" align="right" id="impresso">Impresso por: <br> <?php echo nome_representante($id_usuario, $conexao); ?> <br> <?php echo date("d/m/Y"); ?> às <?php echo date("H:i:s"); ?></td>
    </tr>
</table>

<p class="numero-pedido">#<?php echo $n_id; ?></p>

<div class="info-pedido">
<table>
	<tr>
    	<td width="60%">
        <strong class="text-muted">CLIENTE:</strong> <?php echo $cliente_cod; ?> - <?php echo $cliente_nome; ?>
        <br>
        <strong class="text-muted">ROTA:</strong> <?php echo $cliente_rota; ?>
        <br>
        <strong class="text-muted">CIDADE:</strong> <?php echo $cliente_cidade; ?> / <?php echo $cliente_uf; ?>
        </td>
        
        <td width="40%">
        <strong class="text-muted">FORMA PAGAMENTO:</strong> <?php echo $forma_pgto; ?>
        <br>
        <strong class="text-muted">LIMITE PRODUÇÃO:</strong> <?php echo $prazo_entrega; ?>
        <br>
        <strong class="text-muted">ID:</strong> <?php echo $pedido_id; ?>
        <br><br>
        <strong class="text-muted">TRANSPORTE:</strong> <?php echo $transporte_desc; ?>
        <br>
        <strong class="text-muted">FRETE:</strong> <?php echo $frete_desc; ?>
        </td>
    </tr>
</table>
</div>

<?php if ($obs != null) { ?>
<div class="observacoes">
<strong>OBSERVAÇÕES</strong>
<br>
<?php echo nl2br($obs); ?>
</div>
<?php } ?>

<div class="lista-itens">
<table class="borda">
	<tr class="titulo">
    	<td width="5%">#</td>
        <td width="6%">QTDE</td>
        <td width="4%">UN</td>
        <td width="30%">DESCRIÇÃO</td>
        <td width="5%">EMB</td>
        <td width="10%">R$ UN</td>
        <td width="10%">R$ TOTAL</td>
        <td width="10%">IPI</td>
        <td width="10%">R$ UN</td>
        <td width="10%">R$ TOTAL</td>
    </tr>
    <?php
	$i = 1;

    $total_pedido = 0;
    $total_pedido_ipi = 0;

	while ($dados_itens = mysqli_fetch_array ($consulta_itens)) {
		$item_codigo		= $dados_itens['codigo'];
		$item_qtde 			= $dados_itens['qtde'];
		$item_un			= $dados_itens['un'];
		$item_descricao		= $dados_itens['descricao'];
		$item_embalagem		= $dados_itens['embalagem'];
		$item_ipi			= $dados_itens['ipi'];
		$item_preco_un		= $dados_itens['preco_un'];
		$item_preco_ipi		= $dados_itens['preco_ipi'];
		$item_preco_total	= $dados_itens['preco_total'];
		$item_preco_total_i	= $dados_itens['preco_total_ipi'];
		
		// Totais
		$total_pedido += $item_preco_total;
		$total_pedido_ipi += $item_preco_total_i;
		
		/* *** */
		
		$item_pu 	= number_format($item_preco_un, 2, ',', '.');
		$item_pt 	= number_format($item_preco_total, 2, ',', '.');
		
		$item_pu_ipi 	= number_format($item_preco_ipi, 2, ',', '.');
		$item_pt_ipi 	= number_format($item_preco_total_i, 2, ',', '.');	
		
		$total_p 		= number_format($total_pedido, 2, ',', '.');
		$total_p_ipi 	= number_format($total_pedido_ipi, 2, ',', '.');
	?>
    <tr>
    	<td><span class="seq"><?php echo $i++; ?></span></td>
        <td><?php echo $item_qtde; ?></td>
        <td><?php echo $item_un; ?></td>
        <td><?php echo $item_descricao; ?></td>
        <td><?php echo cod_embalagem($item_embalagem, $conexao); ?></td>
        <td>R$ <?php echo $item_pu; ?></td>
        <td>R$ <?php echo $item_pt; ?></td>
        <td class="bg-cinza"><?php echo $item_ipi; ?>%</td>
        <td class="bg-cinza">R$ <?php echo $item_pu_ipi; ?></td>
        <td class="bg-cinza">R$ <?php echo $item_pt_ipi; ?></td>
    </tr>
    <?php
	}
	?>
    <tr>
    	<td colspan="6"></td>
        <td><strong>R$ <?php echo $total_p; ?></strong></td>
        <td colspan="2" class="bg-cinza"></td>
        <td class="bg-cinza"><strong>R$ <?php echo $total_p_ipi; ?></strong></td>
    </tr>
</table>
</div>

<?php
/* **********************************************************************
EMBALAGENS
********************************************************************** */
$con_embalagens = mysqli_query ($conexao, "SELECT b.tipo, b.descricao FROM moveleiro_itens a, moveleiro_embalagens b WHERE a.id_pedido='$id_pedido' AND a.embalagem=b.id GROUP BY a.embalagem ORDER BY b.tipo") or die (mysqli_error());
$conta_embalagens = mysqli_num_rows ($con_embalagens);

if ($conta_embalagens > 0) {
?>
<br>

<div class="lista-itens">
<table class="borda">
	<tr>
    	<td colspan="2"><strong>EMBALAGENS SOLICITADAS NO PEDIDO</strong></td>
    </tr>
    <tr class="titulo">
    	<td width="6%">TIPO</td>
        <td width="94%">DESCRIÇÃO</td>
    </tr>
    <?php
	while ($dados_emb = mysqli_fetch_array ($con_embalagens)) {
    	$emb_tipo		= $dados_emb['tipo'];
		$emb_descricao	= $dados_emb['descricao'];
	?>
    <tr>
        <td><?php echo $emb_tipo; ?></td>
        <td><?php echo $emb_descricao; ?></td>
    </tr>
    <?php
	}
	?>
</table>
</div>
<?php
}
?>

<?php
$consulta_log = mysqli_query ($conexao, "SELECT * FROM moveleiro_log_prazo WHERE id_pedido='$id_pedido' ORDER BY data DESC") or die (mysqli_error());
$conta_log = mysqli_num_rows ($consulta_log);

if ($conta_log > 0) {
?>
<div class="log-pedido">

<p><strong>ALTERAÇÃO NO LIMITE DE PRODUÇÃO</strong></p>

<table class="borda">
	<tr class="titulo">
    	<td width="30%">RESPONSÁVEL</td>
        <td width="25%">ALTERAÇÃO</td>
        <td width="45%">MOTIVO</td>
    </tr>
<?php
while ($dados_log = mysqli_fetch_array ($consulta_log)) {
	$log_data 			= $dados_log['data'];
	$log_usuario 		= $dados_log['usuario'];
	$log_data_antiga 	= $dados_log['data_antiga'];
	$log_data_nova 		= $dados_log['data_nova'];
	$log_motivo 		= $dados_log['motivo'];
	
	/* *** */
	
	$log_data 			= date('d/m/Y H:i:s', strtotime($log_data));
	$log_data_antiga 	= date('d/m/Y', strtotime($log_data_antiga));
	$log_data_nova 		= date('d/m/Y', strtotime($log_data_nova));
	
	$consulta_responsavel = mysqli_query ($conexao, "SELECT nome FROM representantes WHERE id='$log_usuario'") or die (mysqli_error());
		$dados_resp = mysqli_fetch_array ($consulta_responsavel);
			$nome_responsavel = $dados_resp['nome'];
?>
	<tr>
    	<td class="text-uppercase"><?php echo $log_data; ?> - <?php echo primeiro_nome($nome_responsavel); ?></td>
        <td><?php echo $log_data_antiga; ?> &rArr; <?php echo $log_data_nova; ?></td>
        <td><?php echo $log_motivo; ?></td>
    </tr>
<?php
}
?>
</table>
</div>
<?php
}
?>

<div class="obs-cancelamento">
	<strong>ATENÇÃO</strong>
    <br><br>
    APÓS A APROVAÇÃO DESTE PELO DEPARTAMENTO COMERCIAL, NÃO SERÃO ACEITAS ALTERAÇÕES
    <br>
    OS VALORES SERÃO VALIDADOS ANTES DA APROVAÇÃO DO PEDIDO
</div>

<div class="horarios-pedido">
<table>
	<tr>
    	<td width="33%">
        <strong>PEDIDO CRIADO</strong>
        <br>
        <?php echo $data; ?> <br> <?php echo nome_representante($usuario, $conexao); ?>
        </td>
        <td width="33%">
        <strong>PEDIDO SOLICITADO</strong>
        <br>
        <?php if ($sol_usuario != null) { ?><?php echo $sol_data; ?> <br> <?php echo nome_representante($sol_usuario, $conexao); ?><?php } ?>
        </td>
        <td width="33%">
        <?php if ($status == "R") { ?>
        <strong>PEDIDO APROVADO</strong>
        <?php } else if ($status == "X") { ?>
        <strong>PEDIDO RECUSADO</strong>
        <?php } ?>
        <br>
        <?php if ($rec_usuario != null) { ?><?php echo $rec_data; ?> <br> <?php echo nome_representante($rec_usuario, $conexao); ?><?php } ?>
        </td>
    </tr>
</table>
</div>

<?php
}
?>

</body>

</html>
<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_sistema.php");
include_once ("includes/usuario_logado.php");
include_once ("includes/cabecalho.php");
?>

<body>

<?php include_once ("includes/menu_topo.php"); ?>

<div class="container-fluid" id="conteudo">

<div class="row" id="titulo">
	<div class="col-md-12">
    	<h1>Orçamentos: Vidro Insulado</h1>
    </div>
</div>

<?php
if ($p_insulado == "S") {
?>

<div class="row">

<div class="col-md-12">

<p><a href="orcamentos_insulado_novo.php" class="btn btn-success"><i class="fas fa-plus-square"></i> Novo Orçamento</a></p>

<hr>

<?php
$consulta_orcamentos = mysqli_query ($conexao, "SELECT * FROM insulado_orcamentos WHERE usuario='$id_usuario' AND tipo_usuario='R' ORDER BY id DESC") or die (mysqli_error());
$conta_orcamentos = mysqli_num_rows ($consulta_orcamentos);

if ($conta_orcamentos == 0) {
?>

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-warning" role="alert">
        <i class="fas fa-exclamation-triangle fa-lg"></i>
        Nenhum orçamento encontrado. <a href="orcamentos_insulado_novo.php" class="alert-link">Clique aqui</a> para criar seu primeiro orçamento.
        </div>
    </div>
</div>

<?php
}
else {
?>

<table class="table table-striped">
    <thead>
    	<tr>
            <th>#</th>
            <th>DATA</th>
            <th>VENDEDOR</th>
            <th>CLIENTE</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha = mysqli_fetch_array($consulta_orcamentos)) {
    $id				= $linha['id'];
	$codigo			= $linha['codigo'];
	$data 			= $linha['data'];
	$usuario		= $linha['usuario'];
	$cliente_cod	= $linha['cliente_cod'];
	$cliente_nome	= $linha['cliente_nome'];
	$v1_vidro		= $linha['vidro1_vidro'];
	$v1_esp 		= $linha['vidro1_esp'];
	$v1_tipo		= $linha['vidro1_tipo'];
	$v2_vidro		= $linha['vidro2_vidro'];
	$v2_esp 		= $linha['vidro2_esp'];
	$v2_tipo		= $linha['vidro2_tipo'];
	$v3_vidro		= $linha['vidro3_vidro'];
	$v3_esp 		= $linha['vidro3_esp'];
	$v3_tipo		= $linha['vidro3_tipo'];
	$camara1 		= $linha['camara1'];
	$camara2		= $linha['camara2'];
	$tipo_camaras	= $linha['tipo_camaras'];
	$tipo_comp		= $linha['tipo_composicao'];
	
	$n_id = str_pad($id, 5, "0", STR_PAD_LEFT);
	
	$data_req = date('d/m/y H:i', strtotime($data));
		
	$consulta_requerente = mysqli_query ($conexao, "SELECT nome FROM representantes WHERE id='$usuario'") or die (mysqli_error());
		$dados = mysqli_fetch_array ($consulta_requerente);
			$nome_requerente = $dados['nome'];
			
			$nome_requerente = strtr(strtoupper($nome_requerente),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	
	$consulta_insulado_1 = mysqli_query ($conexao, "SELECT nome FROM insulado_tipos WHERE id='$camara1'") or die (mysqli_error());
		$dados_ins1 = mysqli_fetch_array ($consulta_insulado_1);
			$camara_1 = $dados_ins1['nome'];
	
	$consulta_insulado_2 = mysqli_query ($conexao, "SELECT nome FROM insulado_tipos WHERE id='$camara2'") or die (mysqli_error());
		$dados_ins2 = mysqli_fetch_array ($consulta_insulado_2);
			$camara_2 = $dados_ins2['nome'];
	
	switch ($tipo_camaras) {
		case "ALU":
			$t_camara = "ALUMÍNIO";
			break;
		case "TRI":
			$t_camara = "TRISEAL";
			break;
		case "DUR":
			$t_camara = "DURASEAL";
			break;
		case "DLT":
			$t_camara = "DURALITE";
			break;
		case "PER":
			$t_camara = "PERSIANA";
			break;
		default:
			$t_camara = "";
	}
	
	if ($tipo_comp == "N") {
		$composicao_cor = "btn-default";
		$composicao_titulo = "???";
		$composicao = "Aguardando composição...";
	}
	elseif ($tipo_comp == "D") {
		$composicao_cor = "btn-outline-warning";
		$composicao_titulo = "DUPLO";
		$composicao = "<small>".$v1_vidro." ".$v1_esp."MM (".$v1_tipo.") <br> <strong>".$camara_1."</strong> <br> ".$v2_vidro." ".$v2_esp."MM (".$v2_tipo.")</small>";
	}
	elseif ($tipo_comp == "T") {
		$composicao_cor = "btn-outline-success";
		$composicao_titulo = "TRIPLO";
		$composicao = "<small>".$v1_vidro." ".$v1_esp."MM (".$v1_tipo.") <br> <strong>".$camara_1."</strong> <br> ".$v2_vidro." ".$v2_esp."MM (".$v2_tipo.") <br> <strong>".$camara_2."</strong> <br> ".$v3_vidro." ".$v3_esp."MM (".$v3_tipo.")</small>";
	}
?>
    
    <tr>
        <td><strong><?php echo $n_id; ?></strong></td>
        <td><?php echo $data_req; ?></td>
        <td><?php echo $nome_requerente; ?></td>
        <td><?php echo $cliente_nome; ?></td>
        
        <td>
            <a class="btn btn-xs btn-block <?php echo $composicao_cor; ?>" tabindex="0" rel="popover" data-toggle="popover" data-html="true" data-placement="left" data-trigger="focus" title="<?php echo $composicao_titulo." ".$t_camara; ?>" data-content="<?php echo $composicao; ?>"><?php echo $tipo_comp; ?></a>
        </td>
        
        <td><a href="orcamentos_insulado_novo.php?orcamento=<?php echo $codigo; ?>" class="btn btn-xs btn-primary btn-block"><i class="fas fa-search"></i></a></td>
    </tr>
 <?php } ?>

	</tbody>
</table>

<?php
}
?>

</div>

</div>

<?php
}
else {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Você não tem permissão para acessar essa página. Para maiores informações entre em contato com o responsável pelo sistema na Linde Vidros.
		</div>
	</div>
</div>
<?php
}
?>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
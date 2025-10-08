<?php
include_once ("../../funcoes/conexao.php");

$consulta = mysqli_query ($conexao, "SELECT razao_social, rota_cliente FROM admin_clientes WHERE cod_cliente='{$_POST['cliente']}' AND tipo_cliente='C'") or die (mysqli_error());

if (mysqli_num_rows($consulta) > 0) {
	$dados = mysqli_fetch_array ($consulta);
		$nome = $dados['razao_social'];
		$rota = $dados['rota_cliente'];
	
	echo $nome."<br><small style=\"color: #999; font-weight: normal;\">(ROTA ".$rota.")</small>";
}
else {
	echo "<span style=\"color: #C33;\">CLIENTE NÃO ENCONTRADO</span>";
}

mysqli_close($conexao);
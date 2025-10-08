<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sem título</title>
</head>

<body>

<?php
require_once ("../funcoes/conexao.php");

$consulta_usuarios = mysqli_query ($conexao, "SELECT id, cpf, senha FROM usuarios") or die (mysqli_error());
while ($d = mysqli_fetch_array ($consulta_usuarios)) {
	$id 	= $d['id'];
	$cpf 	= $d['cpf'];
	$senha 	= $d['senha'];
	
	$codigo 	= md5($cpf);
	$nova_senha = md5($senha);
	
	$atualiza = mysqli_query ($conexao, "UPDATE usuarios SET senha='$nova_senha', codigo='$codigo' WHERE id='$id'") or die (mysqli_error());
	
}

echo "FINALIZADO :)";
?>

</body>
</html>
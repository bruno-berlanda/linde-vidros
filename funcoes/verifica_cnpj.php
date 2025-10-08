<?php
include_once ("conexao.php");

$consulta = mysqli_query ($conexao, "SELECT cnpj FROM clientes WHERE cnpj='{$_POST['cnpjj']}'") or die (mysqli_error());

$tamanho = strlen($_POST['cnpjj']);

if ($_POST['cnpjj'] == "") {
	echo "";
}
else if ($tamanho < 18) {
	echo "<span class=\"text-danger\"><i class=\"fas fa-times\"></i></span>";
}
else if (mysqli_num_rows($consulta) > 0) {
	echo "<span class=\"text-danger\"><i class=\"fas fa-times\"></i></span>";
}
else {
	echo "<span class=\"text-success\"><i class=\"fas fa-check\"></i></span>";
}
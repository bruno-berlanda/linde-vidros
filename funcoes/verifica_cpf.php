<?php
include_once ("conexao.php");

$consulta = mysqli_query ($conexao, "SELECT cpf FROM usuarios WHERE cpf='{$_POST['cpf']}'") or die (mysqli_error());

$tamanho = strlen($_POST['cpf']);

if ($_POST['cpf'] == "") {
	echo "";
}
else if ($tamanho < 14) {
	echo "<span class=\"text-danger\"><i class=\"fas fa-times\"></i></span>";
}
else if (mysqli_num_rows($consulta) > 0) {
	echo "<span class=\"text-danger\"><i class=\"fas fa-times\"></i></span>";
}
else {
	echo "<span class=\"text-success\"><i class=\"fas fa-check\"></i></span>";
}
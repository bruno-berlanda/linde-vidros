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
    	<h1>Acesso Restrito</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_curriculos == "S" || $perm_cadastros == "S") {
?>

<?php
include_once("includes/msgs.php");
?>

<div class="row">
<div class="col-md-4">
<h2>Sistema de Currículos</h2>

<?php
if ($perm_curriculos == "S") {
	
	$consulta_login_usuarios = mysqli_query ($conexao, "SELECT * FROM login_usuarios GROUP BY data, hora ORDER BY data DESC, hora DESC LIMIT 30") or die (mysqli_error());
	
	$consulta_login_usuarios_total = mysqli_query ($conexao, "SELECT * FROM login_usuarios GROUP BY data, hora ORDER BY data DESC, hora DESC") or die (mysqli_error());
	$conta_login_usuarios = mysqli_num_rows ($consulta_login_usuarios_total);
?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info" role="alert">
            <i class="fas fa-info-circle fa-lg"></i>
            TOTAL DE LOGINS: <strong><?php echo $conta_login_usuarios; ?></strong>
            </div>
        </div>
    </div>
    	
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>DATA</th>
                <th>HORA</th>
                <th>NOME</th>
            </tr>
        </thead>
        <tbody>
<?php
	$i = 1;
		
	while ($dados = mysqli_fetch_array ($consulta_login_usuarios)) {
		$cpf 	= $dados['cpf'];
		$data1 	= $dados['data'];
		$hora1 	= $dados['hora'];
		
		$data1 = substr($data1,8,2) . "/" .substr($data1,5,2) . "/" . substr($data1,0,4);
		$hora1 = substr($hora1,0,2) . ":" .substr($hora1,3,2);
		
		$consUsuario = mysqli_query ($conexao, "SELECT nome FROM usuarios WHERE cpf='$cpf'") or die (mysqli_error());
			$dados = mysqli_fetch_array ($consUsuario);
				$nomeUsuario = $dados['nome'];
?>

		<tr<?php if ($perm_adm == "S" && $cpf == "") { ?> class="warning"<?php } ?>>
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><?php echo $data1; ?></td>
            <td><?php echo $hora1; ?></td>
            <td><?php echo $nomeUsuario; ?></td>
        </tr>

<?php
	}
?>
	</tbody>
</table>
<?php
} // Permissão para mostrar log dos currículos
?>
</div>

<div class="col-md-4">
<h2>Área do Cliente</h2>

<?php
if ($perm_cadastros == "S") {
	
	$consulta_login_clientes = mysqli_query ($conexao, "SELECT * FROM login_clientes GROUP BY data, hora ORDER BY data DESC, hora DESC LIMIT 30") or die (mysqli_error());
	
	$consulta_login_clientes_total = mysqli_query ($conexao, "SELECT * FROM login_clientes GROUP BY data, hora ORDER BY data DESC, hora DESC") or die (mysqli_error());
	$conta_login_clientes = mysqli_num_rows ($consulta_login_clientes_total);
?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info" role="alert">
            <i class="fas fa-info-circle fa-lg"></i>
            TOTAL DE LOGINS: <strong><?php echo $conta_login_clientes; ?></strong>
            </div>
        </div>
    </div>
    	
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>DATA</th>
                <th>HORA</th>
                <th>NOME</th>
            </tr>
        </thead>
        <tbody>
<?php
	$i = 1;
		
	while ($dados = mysqli_fetch_array ($consulta_login_clientes)) {
		$cnpj 	= $dados['cnpj'];
		$data2 	= $dados['data'];
		$hora2 	= $dados['hora'];
		
		$data2 = substr($data2,8,2) . "/" .substr($data2,5,2) . "/" . substr($data2,0,4);
		$hora2 = substr($hora2,0,2) . ":" .substr($hora2,3,2);
		
		$consCliente = mysqli_query ($conexao, "SELECT nome FROM clientes WHERE cnpj='$cnpj'") or die (mysqli_error());
			$dados = mysqli_fetch_array ($consCliente);
				$nomeCliente = $dados['nome'];
?>

		<tr<?php if ($perm_adm == "S" && $cnpj == "") { ?> class="warning"<?php } ?>>
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><?php echo $data2; ?></td>
            <td><?php echo $hora2; ?></td>
            <td><?php echo $nomeCliente; ?></td>
        </tr>

<?php
	}
?>
	</tbody>
</table>
<?php
} // Permissão para mostrar log dos clientes
?>
</div>

<div class="col-md-4">
<h2>Área do Representante</h2>

<?php
if ($perm_representantes == "S") {
	
	$consulta_login_rep = mysqli_query ($conexao, "SELECT * FROM login_representantes WHERE usuario!='bruno' ORDER BY data DESC LIMIT 30") or die (mysqli_error());
	
	$consulta_login_rep_total = mysqli_query ($conexao, "SELECT * FROM login_representantes WHERE usuario!='bruno' ORDER BY data DESC") or die (mysqli_error());
	$conta_login_rep = mysqli_num_rows ($consulta_login_rep_total);
?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info" role="alert">
            <i class="fas fa-info-circle fa-lg"></i>
            TOTAL DE LOGINS: <strong><?php echo $conta_login_rep; ?></strong>
            </div>
        </div>
    </div>
    	
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>DATA</th>
                <th>HORA</th>
                <th>NOME</th>
            </tr>
        </thead>
        <tbody>
<?php
	$i = 1;
		
	while ($dados = mysqli_fetch_array ($consulta_login_rep)) {
		$data_rep		= $dados['data'];
        $usuario_rep 	= $dados['usuario'];
        
        $data_login_rep = date('d/m/Y', strtotime($data_rep));
        $hora_login_rep = date('H:i', strtotime($data_rep));
        
        $consUsuario = mysqli_query ($conexao, "SELECT nome FROM representantes WHERE login='$usuario_rep'") or die (mysqli_error());
            $dados = mysqli_fetch_array ($consUsuario);
                $nomeUsuario_rep = $dados['nome'];
?>

		<tr<?php if ($perm_adm == "S" && $usuario_rep == "") { ?> class="warning"<?php } ?>>
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><?php echo $data_login_rep; ?></td>
            <td><?php echo $hora_login_rep; ?></td>
            <td><?php echo nome_sobrenome($nomeUsuario_rep); ?></td>
        </tr>

<?php
	}
?>
	</tbody>
</table>
<?php
} // Permissão para mostrar log dos representantes
?>
</div>
</div>

<?php
} else {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Você não tem permissão para acessar essa página. Consulte o Administrador do sistema.
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
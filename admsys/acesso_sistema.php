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
    	<h1>Acesso Sistema</h1>
    </div>
</div>

<?php
if ($perm_adm == "S") {
?>

<?php
include_once("includes/msgs.php");
?>

<div class="row">
<div class="col-md-6">
	<?php
    $consulta_login_usuarios = mysqli_query ($conexao, "SELECT * FROM login_sistema ORDER BY data DESC LIMIT 50") or die (mysqli_error());
        
    $consulta_login_usuarios_total = mysqli_query ($conexao, "SELECT * FROM login_sistema ORDER BY data DESC") or die (mysqli_error());
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
                <th>LOGIN</th>
                <th>NOME</th>
            </tr>
        </thead>
        <tbody>
    <?php
    $i = 1;
        
    while ($dados = mysqli_fetch_array ($consulta_login_usuarios)) {
        $data 		= $dados['data'];
        $usuario 	= $dados['usuario'];
        
        $data_login = date('d/m/Y', strtotime($data));
        $hora_login = date('H:i', strtotime($data));
        
        $consUsuario = mysqli_query ($conexao, "SELECT nome FROM admin_usuarios WHERE login='$usuario'") or die (mysqli_error());
            $dados = mysqli_fetch_array ($consUsuario);
                $nomeUsuario = $dados['nome'];
    ?>
    
        <tr>
            <td class="text-muted"><?php echo $i++; ?></td>
            <td><?php echo $data_login; ?></td>
            <td><?php echo $hora_login; ?></td>
            <td><?php echo $usuario; ?></td>
            <td><?php echo $nomeUsuario; ?></td>
        </tr>
    
    <?php
    }
    ?>
    </tbody>
    </table>
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
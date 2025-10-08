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
    	<h1>Materiais de Divulgação</h1>
    </div>
</div>

<?php
include_once("includes/msgs.php");
?>

<?php if ($p_materiais == "S") { ?>

<?php
$consulta = mysqli_query ($conexao, "SELECT data, nome, descricao, arquivo, aviso_envio FROM arquivos WHERE categoria='M' AND ativo='S' ORDER BY nome") or die (mysqli_error());

$conta = mysqli_num_rows ($consulta);

if ($conta == 0) {
?>

<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		Nenhum material de divulgação encontrado
		</div>
	</div>
</div>

<?php
}
else {
?>

<div class="row">
    <div class="col-md-12">
        <?php
		while ($info = mysqli_fetch_array ($consulta)) {
			$data_arquivo 		= $info['data'];
			$nome_arquivo 		= $info['nome'];
			$descricao_arquivo 	= $info['descricao'];
			$arquivo 			= $info['arquivo'];
			$aviso_envio 		= $info['aviso_envio'];
			
			$data_arquivo = date('d/m/Y', strtotime($data_arquivo));
		?>
        <div class="col-sm-12 col-md-3">
            <div class="thumbnail" id="materiais">
            	<p class="text-center" id="img-materiais"><i class="fas fa-file-pdf fa-4x"></i></p>
                <div class="caption">
                	<h3><?php echo $nome_arquivo; ?></h3>
                	<p><a href="materiais/divulgacao/<?php echo $arquivo; ?>" class="btn btn-danger btn-block" target="_blank" role="button"<?php if ($aviso_envio == "S") { echo " onClick=\"return confirm('ATENÇÃO! Não envie esse arquivo para o cliente. Este documento serve apenas para consulta do vendedor.')\""; } ?>><i class="fas fa-search"></i> Visualizar</a></p>
                    <div class="row">
                    	<div class="col-xs-6">
                        	<?php
							if ($descricao_arquivo != "") {
							?>
                            <a tabindex="0" rel="popover" data-toggle="popover" data-placement="bottom" data-trigger="focus" data-content="<?php echo $descricao_arquivo; ?>"><i class="fas fa-info-circle"></i></a>
                            <?php
							}
							?>
                        </div>
                        <div class="col-xs-6">
                        	<p class="text-right text-muted"><small><?php echo $data_arquivo; ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
		}
		?>
	</div>
</div>

<?php
}
?>

<?php } // Permissão para acessar a página ?>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
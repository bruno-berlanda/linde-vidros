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
    	<h1>Comentários</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_comentarios == "S") {
?>

<?php
include_once("includes/msgs.php");
?>

<div class="row">
<div class="col-md-6">
	<h2>Notícias</h2>
    
    <?php
	$consulta_com_noticias = mysqli_query ($conexao, "SELECT * FROM comentarios_site WHERE pagina='N' AND liberado='N' ORDER BY data") or die (mysqli_error());
	$conta_com_noticias = mysqli_num_rows ($consulta_com_noticias);
	
	if ($conta_com_noticias == 0) {
	?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning" role="alert">
            <i class="fas fa-exclamation-triangle fa-lg"></i>
            Nenhum comentário pendente
            </div>
        </div>
    </div>
	<?php
	}
	else {
		
		while ($dados = mysqli_fetch_array ($consulta_com_noticias)) {
			$id 		= $dados['id'];
			$id_pagina 	= $dados['id_pagina'];
			$data 		= $dados['data'];
			$nome 		= $dados['nome'];
			$email 		= $dados['email'];
			$comentario = $dados['comentario'];
			
			$data = date('d/m/y H:i', strtotime($data));
			
			$consulta_noticia = mysqli_query ($conexao, "SELECT titulo FROM admin_noticias WHERE id='$id_pagina'") or die (mysqli_error());
				$dados = mysqli_fetch_array ($consulta_noticia);
					$titulo = $dados['titulo'];
	?>	
		<div class="well well-sm">
			<div class="row">
				<div class="col-md-3">
					<p class="text-muted"><?php echo $data; ?></p>
				</div>
				<div class="col-md-9">
					<p><span class="label label-default"><?php echo $titulo; ?></span></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<p class="text-primary"><?php echo $nome; ?></p>
				</div>
				<div class="col-md-7">
					<p class="text-muted"><?php echo $email; ?></p>
				</div>
			</div>
			
			<hr>
			
			<p><?php echo $comentario; ?></p>
			
			<hr>
			
			<div class="row">
				<div class="col-md-6">
					<form method="post" action="funcoes/comentarios.php?funcao=liberar&id=<?php echo $id; ?>" class="form-horizontal">
						<fieldset>
							<input type="submit" value="Liberar" class="btn btn-primary btn-block">
						</fieldset>
					</form>
				</div>
				<div class="col-md-6">
					<form method="post" action="funcoes/comentarios.php?funcao=excluir&id=<?php echo $id; ?>" class="form-horizontal">
						<fieldset>
							<input type="submit" value="Excluir" class="btn btn-danger btn-block">
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	<?php
		}
	}
	?>
</div>

<div class="col-md-6">
	<h2>Galerias</h2>
    
    <?php
	$consulta_com_galerias = mysqli_query ($conexao, "SELECT * FROM comentarios_site WHERE pagina='G' AND liberado='N' ORDER BY data") or die (mysqli_error());
	$conta_com_galerias = mysqli_num_rows ($consulta_com_galerias);
	
	if ($conta_com_galerias == 0) {
	?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning" role="alert">
            <i class="fas fa-exclamation-triangle fa-lg"></i>
            Nenhum comentário pendente
            </div>
        </div>
    </div>
	<?php
	}
	else {
		
		while ($dados = mysqli_fetch_array ($consulta_com_galerias)) {
			$id 		= $dados['id'];
			$id_pagina 	= $dados['id_pagina'];
			$data 		= $dados['data'];
			$nome 		= $dados['nome'];
			$email 		= $dados['email'];
			$comentario = $dados['comentario'];
			
			$data = date('d/m/y H:i', strtotime($data));
			
			$consulta_galerias = mysqli_query ($conexao, "SELECT titulo FROM admin_galerias WHERE id='$id_pagina'") or die (mysqli_error());
				$dados = mysqli_fetch_array ($consulta_galerias);
					$titulo = $dados['titulo'];
	?>	
		<div class="well well-sm">
			<div class="row">
				<div class="col-md-3">
					<p class="text-muted"><?php echo $data; ?></p>
				</div>
				<div class="col-md-9">
					<p><span class="label label-default"><?php echo $titulo; ?></span></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<p class="text-primary"><?php echo $nome; ?></p>
				</div>
				<div class="col-md-7">
					<p class="text-muted"><?php echo $email; ?></p>
				</div>
			</div>
			
			<hr>
			
			<p><?php echo $comentario; ?></p>
			
			<hr>
			
			<div class="row">
				<div class="col-md-6">
					<form method="post" action="funcoes/comentarios.php?funcao=liberar&id=<?php echo $id; ?>" class="form-horizontal">
						<fieldset>
							<input type="submit" value="Liberar" class="btn btn-primary btn-block">
						</fieldset>
					</form>
				</div>
				<div class="col-md-6">
					<form method="post" action="funcoes/comentarios.php?funcao=excluir&id=<?php echo $id; ?>" class="form-horizontal">
						<fieldset>
							<input type="submit" value="Excluir" class="btn btn-danger btn-block">
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	<?php
		}
	}
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
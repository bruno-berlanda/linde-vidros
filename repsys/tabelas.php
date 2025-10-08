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
    	<h1>Tabelas de Preços</h1>
    </div>
</div>

<?php
include_once("includes/msgs.php");
?>

<?php if ($p_tabelas == "S") { ?>

<div class="row" id="aviso-tabelas">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle"></i>
		<strong>ATENÇÃO!</strong>
        <br>
        Não envie esses arquivos para o cliente. Estes documentos servem apenas para consulta do vendedor.
		</div>
	</div>
</div>

<?php
include_once ("includes/conexao_interna.php");

// Tabela de R$ dos Vidros
$consulta_doc_vidros = mysqli_query ($conexao_interna, "SELECT * FROM admin_arquivos WHERE arquivo_categoria='Vidros' AND arquivo_situacao='Ativo' ORDER BY data_arquivo DESC") or die (mysqli_error());
	$conta_doc_vidros = mysqli_num_rows ($consulta_doc_vidros);

// Tabela de R$ dos Acessórios
$consulta_doc_acessorios = mysqli_query ($conexao_interna, "SELECT * FROM admin_arquivos WHERE arquivo_categoria='Acessorios' AND arquivo_situacao='Ativo' ORDER BY data_arquivo DESC") or die (mysqli_error());
	$conta_doc_acessorios = mysqli_num_rows ($consulta_doc_acessorios);
?>

<?php
if ($conta_doc_vidros > 0) {
?>
<h2>Tabelas de Vidros</h2>

<div class="row">
    <div class="col-md-12">
        <?php
		while ($info = mysqli_fetch_array ($consulta_doc_vidros)) {
			$nome_arquivo_1 = $info['arquivo_descricao'];
            $arquivo_1 		= $info['arquivo'];
            $data_arquivo_1 = $info['data_arquivo'];
            
            $data_arquivo_1 = date('d/m/Y', strtotime($data_arquivo_1));
		?>
        <div class="col-sm-12 col-md-3">
            <div class="thumbnail" id="materiais">
            	<p class="text-center" id="img-materiais"><i class="fas fa-dollar-sign fa-4x"></i></p>
                <div class="caption">
                	<h3><?php echo $nome_arquivo_1; ?></h3>
                	<p><a href="http://200.53.28.35:9456/arearestrita/arquivos/tabelas/<?php echo $arquivo_1; ?>" class="btn btn-danger btn-block" target="_blank" role="button" onClick="return confirm('ATENÇÃO! Não envie esse arquivo para o cliente. Este documento serve apenas para consulta do vendedor.')"><i class="fas fa-search"></i> Visualizar</a></p>
                    <p class="text-right text-muted"><small><?php echo $data_arquivo_1; ?></small></p>
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

<?php if ($conta_doc_vidros > 0 && $conta_doc_acessorios > 0) { ?><hr><?php } ?>

<?php
if ($conta_doc_acessorios > 0) {
?>
<h2>Tabelas de Acessórios</h2>

<div class="row">
    <div class="col-md-12">
        <?php
		while ($info = mysqli_fetch_array ($consulta_doc_acessorios)) {
			$nome_arquivo_2 = $info['arquivo_descricao'];
            $arquivo_2 		= $info['arquivo'];
            $data_arquivo_2 = $info['data_arquivo'];
            
            $data_arquivo_2 = date('d/m/Y', strtotime($data_arquivo_2));
		?>
        <div class="col-sm-12 col-md-3">
            <div class="thumbnail" id="materiais">
            	<p class="text-center" id="img-materiais"><i class="fas fa-dollar-sign fa-4x"></i></p>
                <div class="caption">
                	<h3><?php echo $nome_arquivo_2; ?></h3>
                	<p><a href="http://200.53.28.35:9456/arearestrita/arquivos/tabelas/<?php echo $arquivo_2; ?>" class="btn btn-warning btn-block" target="_blank" role="button" onClick="return confirm('ATENÇÃO! Não envie esse arquivo para o cliente. Este documento serve apenas para consulta do vendedor.')"><i class="fas fa-search"></i> Visualizar</a></p>
                    <p class="text-right text-muted"><small><?php echo $data_arquivo_2; ?></small></p>
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
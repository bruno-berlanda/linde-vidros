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
    	<h1>Moveleiro: Editar Item</h1>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="repsys.php">Início</a></li>
            <li><a href="moveleiro-gerenciar-pedidos.php">Pedidos</a></li>
            <li><a href="moveleiro-pedido-itens.php?pedido=<?php echo $_GET['pedido']; ?>">Digitação do Pedido</a></li>
            <li class="active">Editar Item</li>
        </ol>
	</div>
</div>

<?php
include_once("includes/msgs.php");
?>

<?php if ($p_pedmov_solicitar == "S") { ?>

<?php
$item 	= $_GET['item'];
$pedido = $_GET['pedido'];

$consulta_pedido = mysqli_query ($conexao, "SELECT * FROM moveleiro_pedidos WHERE codigo='$pedido'") or die (mysqli_error());
	$dados_pedido = mysqli_fetch_array ($consulta_pedido);
		$id_pedido 		= $dados_pedido['id'];
		$status 		= $dados_pedido['status'];
		
		$n_id = str_pad($id_pedido, 5, "0", STR_PAD_LEFT);

$consulta_item = mysqli_query ($conexao, "SELECT * FROM moveleiro_itens WHERE codigo='$item'") or die (mysqli_error());
	$dados_item = mysqli_fetch_array ($consulta_item);
		$item_qtde 			= $dados_item['qtde'];
		$iten_un 			= $dados_item['un'];
		$item_descricao		= $dados_item['descricao'];
		$iten_embalagem		= $dados_item['embalagem'];
		$item_ipi 			= $dados_item['ipi'];
		$iten_preco			= $dados_item['preco_un'];
?>

<div class="row">
	<div class="col-xs-6">
    	<div id="n-solicitacao">
        	<span id="n-pedido">#<?php echo $n_id; ?></span>
        </div>
    </div>
</div>

<div class="row">

<div class="col-md-8">

<form method="post" action="funcoes/moveleiro_pedidos.php?funcao=item_editar&pedido=<?php echo $pedido; ?>&item=<?php echo $item; ?>" enctype="multipart/form-data" class="form-horizontal">
    <fieldset<?php if ($status != "D") { echo " disabled"; } ?>>
        <legend>Editar Item do Pedido</legend>
        
        <div class="form-group">
        	<label for="inputQtde" class="col-sm-3 control-label">Qtde</label>
            <div class="col-sm-4">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-calculator"></i></span>
                	<input type="number" name="qtde" class="form-control" id="inputQtde" autocomplete="off" required autofocus value="<?php echo $item_qtde; ?>">
                </div>
            </div>
            <br class="visible-xs">
            <div class="col-sm-4">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-shopping-cart"></i></span>
                	<select name="un" class="form-control" id="selectUnidade" required>
                        <option value="PÇ"<?php if ($iten_un == "PÇ") { echo " selected"; } ?>>PÇ</option>
                        <option value="UN"<?php if ($iten_un == "UN") { echo " selected"; } ?>>UN</option>
                        <option value="KIT"<?php if ($iten_un == "KIT") { echo " selected"; } ?>>KIT</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="inputDescricao" class="col-sm-3 control-label">Descrição</label>
            <div class="col-sm-8">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-archive"></i></span>
                	<input type="text" name="descricao" class="form-control" id="inputDescricao" autocomplete="off" maxlength="200" required value="<?php echo $item_descricao; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="selectEmbalagem" class="col-sm-3 control-label">Embalagem</label>
            <div class="col-sm-8">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fab fa-accusoft"></i></span>
                	<select name="embalagem" class="form-control" id="selectEmbalagem" required>
						<?php
						$con_embalagens = mysqli_query ($conexao, "SELECT * FROM moveleiro_embalagens WHERE ativo='S' ORDER BY tipo") or die (mysqli_error());
						while ($d_emb = mysqli_fetch_array ($con_embalagens)) {
							$emb_id 	= $d_emb['id'];
							$emb_tipo 	= $d_emb['tipo'];
							$emb_desc 	= $d_emb['descricao'];
						?>
                        <option value="<?php echo $emb_id; ?>"<?php if ($iten_embalagem == $emb_id) { echo " selected"; } ?>><?php echo $emb_tipo; ?> - <?php echo $emb_desc; ?></option>
                        <?php
						}
						?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="inputPrecoUn" class="col-sm-3 control-label">Preço Unitário</label>
            <div class="col-sm-4">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>
                	<input type="text" name="preco" class="form-control" id="inputPrecoUn" required value="<?php echo $iten_preco; ?>">
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label for="inputIPI" class="col-sm-3 control-label">IPI</label>
            <div class="col-sm-3">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-percent fa-xs"></i></span>
                	<input type="number" name="ipi" class="form-control" id="inputIPI" min="0" value="<?php echo $item_ipi; ?>">
                </div>
            </div>
        </div>
        
        <hr>
        
        <div class="form-group">
        	<label for="inputAnexo" class="col-sm-3 control-label">Anexar Projeto</label>
            <div class="col-sm-8">
            	<div class="input-group">
                	<span class="input-group-addon"><i class="fas fa-paperclip"></i></span>
                	<input type="file" name="anexo" class="form-control" id="inputAnexo" accept=".pdf, image/*">
                </div>
                <span id="inputAnexo" class="help-block">Envie arquivos PDF ou arquivos de imagem (jpg, png). <strong>Se você enviar um novo arquivo, o mesmo irá substituir o atual</strong>.</span>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Atualizar Item</button>
            </div>
        </div>
    </fieldset>
</form>

</div>

</div>

<?php } // Permissão para acessar a página ?>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
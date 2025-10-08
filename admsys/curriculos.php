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
    	<h1>Currículos</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_curriculos == "S") {
?>

<?php
include_once("includes/msgs.php");
?>

<?php
if (isset($_GET['tipo']) && isset($_GET['class'])) {
	$filtro_tipo = $_GET['tipo'];
	$filtro_clas = $_GET['class'];
	
	// Tipo
	switch ($filtro_tipo) {
		case "cadsite":
			$sql_tipo = "SELECT * FROM usuarios WHERE id!='2180' AND atualizado!='0000-00-00' AND funcionario='N' AND ativo='1'";
			$txt_tipo = "CADASTROS EFETUADOS PELO SITE";	
			break;
		case "naolido":
			$sql_tipo = "SELECT * FROM usuarios WHERE id!='2180' AND atualizado!='0000-00-00' AND funcionario='N' AND lido='0' AND ativo='1'";
			$txt_tipo = "CURRÍCULOS NÃO LIDOS";	
			break;
		case "func":
			$sql_tipo = "SELECT * FROM usuarios WHERE id!='2180' AND atualizado!='0000-00-00' AND funcionario='S' AND ativo='1'";
			$txt_tipo = "CURRÍCULOS DE FUNCIONÁRIOS";	
			break;
		case "pne":
			$sql_tipo = "SELECT * FROM usuarios WHERE id!='2180' AND atualizado!='0000-00-00' AND funcionario='N' AND pne='S' AND ativo='1'";
			$txt_tipo = "CURRÍCULOS DE PORTADORES DE NECESSIDADES ESPECIAIS";	
			break;
		case "exc":
			$sql_tipo = "SELECT * FROM usuarios WHERE id!='2180' AND atualizado!='0000-00-00' AND funcionario='N' AND ativo='0'";
			$txt_tipo = "CURRÍCULOS EXCLUÍDOS";	
			break;
	}
	
	// Classificação
	switch ($filtro_clas) {
		case "atualizacao":
			$sql_ordem = " ORDER BY atualizado DESC, nome";
			$txt_ordem = "DATA DA ÚLTIMA ATUALIZAÇÃO";	
			break;
		case "nome":
			$sql_ordem = " ORDER BY nome";
			$txt_ordem = "NOME";	
			break;
		case "cadastro":
			$sql_ordem = " ORDER BY criado DESC, nome";
			$txt_ordem = "DATA DO CADASTRO";	
			break;
	}
	
}
else {
	$filtro_clas = "atualizacao";
	$filtro_tipo = "cadsite";
	
	// Tipo
	$sql_tipo = "SELECT * FROM usuarios WHERE id!='2180' AND atualizado!='0000-00-00' AND funcionario='N' AND ativo='1' AND cadrh='N'";
	$txt_tipo = "CADASTROS EFETUADOS PELO SITE";	
	
	// Classificação
	$sql_ordem = " ORDER BY atualizado DESC, nome";
	$txt_ordem = "DATA DA ÚLTIMA ATUALIZAÇÃO";	
}

$consulta_curriculos = mysqli_query ($conexao, $sql_tipo.$sql_ordem) or die (mysqli_error());
?>

<div class="row">
<div class="col-md-12">

<div class="row">
    <div class="col-md-12">
    	<form method="get" action="curriculos.php" class="form-inline">
            <div class="form-group form-group-sm">
            	<label for="selectTipo">MOSTRAR</label>
                <select name="tipo" class="form-control input-sm" id="selectTipo">
                	<option value="cadsite"<?php if ($filtro_tipo == "cadsite") { echo " selected"; } ?>>Cadastros Site</option>
                    <option value="naolido"<?php if ($filtro_tipo == "naolido") { echo " selected"; } ?>>Não Lido</option>
                    <option value="func"<?php if ($filtro_tipo == "func") { echo " selected"; } ?>>Funcionários</option>
                    <option value="pne"<?php if ($filtro_tipo == "pne") { echo " selected"; } ?>>PNE</option>
                    <option value="exc"<?php if ($filtro_tipo == "exc") { echo " selected"; } ?>>Excluídos</option>
                </select>
            </div>
            <div class="form-group form-group-sm">
            	<label for="selectClass">ORDENADO POR</label>
                <select name="class" class="form-control input-sm" id="selectClass">
                	<option value="atualizacao"<?php if ($filtro_clas == "atualizacao") { echo " selected"; } ?>>Atualização</option>
                    <option value="nome"<?php if ($filtro_clas == "nome") { echo " selected"; } ?>>Nome</option>
                    <option value="cadastro"<?php if ($filtro_clas == "cadastro") { echo " selected"; } ?>>Cadastro</option>
                </select>
            </div>

        	<button type="submit" class="btn btn-sm btn-success"><i class="fas fa-filter"></i> Atualizar</button>
        </form>
    </div>
</div>

<br>

<div class="well well-sm">
	<p class="text-center">MOSTRANDO: <span class="label label-danger"><?php echo $txt_tipo;?></span> ORDENADO POR: <span class="label label-danger"><?php echo $txt_ordem;?></span></p>
</div>

<br>

<?php
$conta = mysqli_num_rows ($consulta_curriculos);

if ($conta == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhum currículo encontrado
		</div>
	</div>
</div>
<?php
}
else {
?>

<div class="table-responsive">
<table class="table table-striped table-condensed">
    <thead>
    	<tr>
        	<th></th>
            <th></th>
            <th></th>
            <th>NOME</th>
            <th>ATUALIZADO</th>
            <th>CADASTRO</th>
            <th>ÁREA</th>
            <th>CIDADE</th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha = mysqli_fetch_array($consulta_curriculos)) {
    $id 		= $linha['id'];
    $nome 		= $linha['nome'];
	$criado 	= $linha['criado'];
	$atualizado = $linha['atualizado'];
	$pne 		= $linha['pne'];
	$pne_desc	= $linha['pne_desc'];
	$lido 		= $linha['lido'];
	$cidade 	= $linha['cidade'];
	$foto 		= $linha['foto'];
	$area 		= $linha['area'];
	
	$criado = date('d/m/Y', strtotime($criado));
	$atualizado = date('d/m/Y H:i', strtotime($atualizado));
	
	// Tratamento da ÁREA
	switch ($area) {
		case "1": $nomeArea = "ADMINISTRATIVA"; break;
		case "2": $nomeArea = "ALMOXARIFADO"; break;
		case "3": $nomeArea = "COMPRAS"; break;
		case "4": $nomeArea = "CONTABILIDADE"; break;
		case "5": $nomeArea = "CONSTRUÇÃO CIVIL"; break;
		case "6": $nomeArea = "FINANCEIRO"; break;
		case "7": $nomeArea = "MANUTENÇÃO"; break;
		case "8": $nomeArea = "PCP"; break;
		case "9": $nomeArea = "PORTARIA"; break;
		case "10": $nomeArea = "PRODUÇÃO"; break;
		case "11": $nomeArea = "PROJETO"; break;
		case "12": $nomeArea = "QUALIDADE"; break;
		case "13": $nomeArea = "RECEPÇÃO"; break;
		case "14": $nomeArea = "TI"; break;
		case "15": $nomeArea = "TRANSPORTE"; break;
		case "16": $nomeArea = "VENDAS"; break;
		case "17": $nomeArea = "LIMPEZA"; break;
		case "18": $nomeArea = "FATURAMENTO"; break;
		case "19": $nomeArea = "TÉC SEGURANÇA"; break;
		case "20": $nomeArea = "RH"; break;
	}
?>
    
    	<tr <?php if ($lido == "0") { echo "class=\"text-danger\""; } ?>>
        	<td>
            <a href="curriculos_ver.php?curriculo=<?php echo $id; ?>" class="btn btn-xs btn-block btn-primary"><i class="fas fa-search"></i></a>
            </td>
            <td class="text-danger">
            <?php if ($foto != "") { ?>
            <i class="fas fa-camera"></i>
			<?php } ?>
            </td>
            <td>
            <?php if ($pne == "S") { ?>
            <i class="fab fa-accessible-icon"></i>
            <?php } ?>
            </td>
            <td><?php echo $nome; ?></td>
    		<td><?php if ($atualizado != "00/00/00") { echo $atualizado; } ?></td>
    		<td><?php echo $criado; ?></td>
    		<td><?php if ($area != '') { echo $nomeArea; } ?></td>
    		<td><?php echo $cidade; ?></td>
         </tr>
 <?php } ?>
	</tbody>
</table>
</div>

<?php 
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
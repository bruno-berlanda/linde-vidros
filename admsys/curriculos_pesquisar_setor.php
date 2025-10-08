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

<div class="row">
<div class="col-md-4">
<form method="get" action="curriculos_pesquisar_setor.php" class="form-horizontal">
    <fieldset>
        <legend>Selecione o Setor</legend>
        
        <div class="form-group form-group-sm">
        	<label for="selectSetor" class="col-sm-3 control-label">Setor</label>
            <div class="col-sm-9">
            	<select name="setor" id="selectSetor" class="form-control" required>
                	<option></option>
                    <option value="administrativo" <?php if (isset($_GET['setor']) && $_GET['setor'] == "administrativo") { echo "selected"; } ?>>ADMINISTRATIVO</option>
                    <option value="almoxarifado" <?php if (isset($_GET['setor']) && $_GET['setor'] == "almoxarifado") { echo "selected"; } ?>>ALMOXARIFADO</option>
                    <option value="compras" <?php if (isset($_GET['setor']) && $_GET['setor'] == "compras") { echo "selected"; } ?>>COMPRAS</option>
                    <option value="contabilidade" <?php if (isset($_GET['setor']) && $_GET['setor'] == "contabilidade") { echo "selected"; } ?>>CONTABILIDADE</option>
                    <option value="construcao" <?php if (isset($_GET['setor']) && $_GET['setor'] == "construcao") { echo "selected"; } ?>>CONSTRUÇÃO CIVIL</option>
                    <option value="faturamento" <?php if (isset($_GET['setor']) && $_GET['setor'] == "faturamento") { echo "selected"; } ?>>FATURAMENTO</option>
                    <option value="financeiro" <?php if (isset($_GET['setor']) && $_GET['setor'] == "financeiro") { echo "selected"; } ?>>FINANCEIRO</option>
                    <option value="limpeza" <?php if (isset($_GET['setor']) && $_GET['setor'] == "limpeza") { echo "selected"; } ?>>LIMPEZA</option>
                    <option value="manutencao" <?php if (isset($_GET['setor']) && $_GET['setor'] == "manutencao") { echo "selected"; } ?>>MANUTENÇÃO</option>
                    <option value="pcp" <?php if (isset($_GET['setor']) && $_GET['setor'] == "pcp") { echo "selected"; } ?>>PCP</option>
                    <option value="portaria" <?php if (isset($_GET['setor']) && $_GET['setor'] == "portaria") { echo "selected"; } ?>>PORTARIA</option>
                    <option value="producao" <?php if (isset($_GET['setor']) && $_GET['setor'] == "producao") { echo "selected"; } ?>>PRODUÇÃO</option>
                    <option value="projeto" <?php if (isset($_GET['setor']) && $_GET['setor'] == "projeto") { echo "selected"; } ?>>PROJETO</option>
                    <option value="qualidade" <?php if (isset($_GET['setor']) && $_GET['setor'] == "qualidade") { echo "selected"; } ?>>QUALIDADE</option>
                    <option value="recepcao" <?php if (isset($_GET['setor']) && $_GET['setor'] == "recepcao") { echo "selected"; } ?>>RECEPÇÃO</option>
                    <option value="rh" <?php if (isset($_GET['setor']) && $_GET['setor'] == "rh") { echo "selected"; } ?>>RH</option>
                    <option value="seguranca" <?php if (isset($_GET['setor']) && $_GET['setor'] == "seguranca") { echo "selected"; } ?>>TÉCNICO SEGURANÇA</option>
                    <option value="ti" <?php if (isset($_GET['setor']) && $_GET['setor'] == "ti") { echo "selected"; } ?>>TI</option>
                    <option value="transporte" <?php if (isset($_GET['setor']) && $_GET['setor'] == "transporte") { echo "selected"; } ?>>TRANSPORTE</option>
                    <option value="vendas" <?php if (isset($_GET['setor']) && $_GET['setor'] == "vendas") { echo "selected"; } ?>>VENDAS</option>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="selectAvaliacao" class="col-sm-3 control-label">Avaliação</label>
            <div class="col-sm-3">
            	<select name="avaliacao" id="selectAvaliacao" class="form-control" required>
                	<option value="1" <?php if (isset($_GET['avaliacao']) && $_GET['avaliacao'] == "1") { echo "selected"; } ?>>1</option>
                    <option value="2" <?php if (isset($_GET['avaliacao']) && $_GET['avaliacao'] == "2") { echo "selected"; } ?>>2</option>
                    <option value="3" <?php if (isset($_GET['avaliacao']) && $_GET['avaliacao'] == "3") { echo "selected"; } ?>>3</option>
                    <option value="4" <?php if (isset($_GET['avaliacao']) && $_GET['avaliacao'] == "4") { echo "selected"; } ?>>4</option>
                    <option value="5" <?php if (isset($_GET['avaliacao']) && $_GET['avaliacao'] == "5") { echo "selected"; } ?>>5</option>
                </select>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Procurar Currículos</button>
            </div>
        </div>
    </fieldset>
</form>
</div>

<div class="col-md-8">
<?php
/* **********************************************************************************************************************************
INÍCIO - FILTRO POR ÁREA
********************************************************************************************************************************** */
if (isset($_GET['setor']) && isset($_GET['avaliacao'])) {
	
	$setor 		= $_GET['setor'];
	$avaliacao 	= $_GET['avaliacao'];
	
	// Nome Setor
	switch ($setor) {
		case "administrativo": $nome_setor = "ADMINISTRATIVO"; break;
		case "almoxarifado": $nome_setor = "ALMOXARIFADO"; break;
		case "compras": $nome_setor = "COMPRAS"; break;
		case "contabilidade": $nome_setor = "CONTABILIDADE"; break;
		case "construcao": $nome_setor = "CONSTRUÇÃO CIVIL"; break;
		case "faturamento": $nome_setor = "FATURAMENTO"; break;
		case "financeiro": $nome_setor = "FINANCEIRO"; break;
		case "manutencao": $nome_setor = "MANUTENÇÃO"; break;
		case "limpeza": $nome_setor = "LIMPEZA"; break;
		case "pcp": $nome_setor = "PCP"; break;
		case "producao": $nome_setor = "PRODUÇÃO"; break;
		case "projeto": $nome_setor = "PROJETOS"; break;
		case "qualidade": $nome_setor = "QUALIDADE"; break;
		case "recepcao": $nome_setor = "RECEPÇÃO"; break;
		case "rh": $nome_setor = "RH"; break;
		case "ti": $nome_setor = "TI"; break;
		case "seguranca": $nome_setor = "TÉCNICO SEGURANÇA"; break;
		case "transporte": $nome_setor = "TRANSPORTE"; break;
		case "vendas": $nome_setor = "VENDAS"; break;
	}
	
	$consulta_filtro = mysqli_query ($conexao, "SELECT id_usuario FROM usuarios_obs WHERE $setor='1'") or die (mysqli_error());
	$conta_filtro = mysqli_num_rows($consulta_filtro);
?>

<h2><?php echo $nome_setor; ?></h2>

<?php
if ($conta_filtro >= 1) {
?>
<table class="table table-striped">
    <thead>
    	<tr>
        	<th>#</th>
            <th>CADASTRO</th>
            <th>ATUALIZADO</th>
            <th>NOME</th>
            <th>ÁREA</th>
            <th>CIDADE</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php		
	$i = 1;
	
	while ($dados = mysqli_fetch_array($consulta_filtro)) {
		$id_usuario_filtro = $dados['id_usuario'];
		
		$consulta = mysqli_query ($conexao, "SELECT * FROM usuarios WHERE id='$id_usuario_filtro' AND atualizado!='0000-00-00' AND avaliacao='$avaliacao' AND ativo='1'") or die (mysqli_error());

		$linha = mysqli_fetch_array($consulta);
			$id 		= $linha['id'];
			$nome 		= $linha['nome'];
			$criado 	= $linha['criado'];
			$atualizado = $linha['atualizado'];
			$pne 		= $linha['pne'];
			$cadrh 		= $linha['cadrh'];
			$lido 		= $linha['lido'];
			$cidade 	= $linha['cidade'];
			$area 		= $linha['area'];
			
			$criado = date('d/m/Y', strtotime($criado));
			$atualizado = date('d/m/Y H:i', strtotime($atualizado));
			
			// Área
			switch ($area) {
				case "1":  $nomeArea = "ADMINISTRATIVA"; break;
				case "2":  $nomeArea = "ALMOXARIFADO"; break;
				case "3":  $nomeArea = "COMPRAS"; break;
				case "4":  $nomeArea = "CONTABILIDADE"; break;
				case "5":  $nomeArea = "CONSTRUÇÃO CIVIL"; break;
				case "6":  $nomeArea = "FINANCEIRO"; break;
				case "7":  $nomeArea = "MANUTENÇÃO"; break;
				case "8":  $nomeArea = "PCP"; break;
				case "9":  $nomeArea = "PORTARIA"; break;
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
				default:   $nomeArea = "-";
			}
			
			if ($id != "") {
?>
	<tr <?php if ($lido == "0") { echo "class=\"text-danger\""; } ?>>
        <td><?php echo $i++; ?></td>
        <td><?php echo $criado; ?></td>
        <td><?php if ($atualizado != "00/00/0000 00:00") { echo $atualizado; } ?></td>
        <td><?php echo $nome; ?></td>
        <td><?php if ($area != '') { echo $nomeArea; } ?></td>
        <td><?php echo $cidade; ?></td>
        
        <td>
        <?php if ($pne == "S") { ?>
        <i class="fab fa-accessible-icon"></i>
        <?php } ?>
        </td>
        
        <td>
        <a href="curriculos_ver.php?curriculo=<?php echo $id; ?>" class="btn btn-xs btn-block btn-primary"><i class="fas fa-search"></i></a>
        </td>
    </tr>
<?php
			}
	}
?>
	</tbody>
</table>
<?php
}
else {
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
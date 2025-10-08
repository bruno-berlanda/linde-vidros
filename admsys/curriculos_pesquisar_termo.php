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
<form method="get" action="curriculos_pesquisar_termo.php" class="form-horizontal">
    <fieldset>
        <legend>Digite o termo desejado</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputTermo" class="col-sm-3 control-label">Termo</label>
            <div class="col-sm-9">
            	<input type="text" name="termo" id="inputTermo" class="form-control" required autocomplete="off" autofocus>
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
if (isset($_GET['termo'])) {
	
	$termo = strtr(strtoupper($_GET['termo']),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
	
	// Pesquisa 1 - Informações	
	$consultaC = mysqli_query ($conexao, "SELECT a.id AS id_user, a.atualizado AS atualizacao, a.nome, a.criado, a.pne, a.cadrh, a.lido, a.cidade, a.area
										  FROM usuarios a 
										  WHERE a.objetivo LIKE '%$termo%' OR a.mini LIKE '%$termo%'
										  
										  UNION
										  
										  SELECT b.id_usuario AS id_user, a.atualizado AS atualizacao, a.nome, a.criado, a.pne, a.cadrh, a.lido, a.cidade, a.area 
										  FROM usuarios a, usuarios_escolaridade b 
										  WHERE a.id=b.id_usuario AND b.instituicao LIKE '%$termo%' 
										  OR a.id=b.id_usuario AND b.curso LIKE '%$termo%'
										  
										  UNION
										  
										  SELECT b.id_usuario AS id_user, a.atualizado AS atualizacao, a.nome, a.criado, a.pne, a.cadrh, a.lido, a.cidade, a.area 
										  FROM usuarios a, usuarios_experiencias b 
										  WHERE a.id=b.id_usuario AND b.empresa LIKE '%$termo%' 
										  OR a.id=b.id_usuario AND b.cargo LIKE '%$termo%' 
										  OR a.id=b.id_usuario AND b.descricao LIKE '%$termo%'
										  
										  UNION
										  
										  SELECT b.id_usuario AS id_user, a.atualizado AS atualizacao, a.nome, a.criado, a.pne, a.cadrh, a.lido, a.cidade, a.area 
										  FROM usuarios a, usuarios_formacao b 
										  WHERE a.id=b.id_usuario AND b.instituicao LIKE '%$termo%' 
										  OR a.id=b.id_usuario AND b.atividade LIKE '%$termo%'
										  
										  UNION
										  
										  SELECT b.id_usuario AS id_user, a.atualizado AS atualizacao, a.nome, a.criado, a.pne, a.cadrh, a.lido, a.cidade, a.area 
										  FROM usuarios a, usuarios_obs b 
										  WHERE a.id=b.id_usuario AND b.obs LIKE '%$termo%'
										  
										  ORDER BY atualizacao DESC
										  LIMIT 50") or die (mysqli_error());
	$contaC = mysqli_num_rows($consultaC);
?>

<h2>Termo: <?php echo $termo; ?></h2>

<?php
if ($contaC >= 1) {
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
	
	while ($dados = mysqli_fetch_array($consultaC)) {
			$id_user		= $dados['id_user'];
			$atualizacao	= $dados['atualizacao'];
			$nome 			= $dados['nome'];
			$criado 		= $dados['criado'];
			$pne 			= $dados['pne'];
			$cadrh 			= $dados['cadrh'];
			$lido 			= $dados['lido'];
			$cidade 		= $dados['cidade'];
			$area 			= $dados['area'];
			
			$criado 		= date('d/m/Y', strtotime($criado));
			$atualizacao 	= date('d/m/Y H:i', strtotime($atualizacao));
			
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
?>
	<tr <?php if ($lido == "0") { echo "class=\"text-danger\""; } ?>>
        <td><?php echo $i++; ?></td>
        <td class="text-muted"><?php echo $criado; ?></td>
        <td><?php echo $atualizacao; ?></td>
        <td><?php echo $nome; ?></td>
        <td><?php echo $nomeArea; ?></td>
        <td><?php echo $cidade; ?></td>
        
        <td>
        <?php if ($pne == "S") { ?>
        <i class="fab fa-accessible-icon"></i>
        <?php } ?>
        </td>
        
        <td>
        <a href="curriculos_ver.php?curriculo=<?php echo $id_user; ?>" target="_blank" class="btn btn-xs btn-block btn-primary"><i class="fas fa-search"></i></a>
        </td>
    </tr>
<?php
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
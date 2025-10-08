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
    	<h1>Entrevistas</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_curriculos == "S") {
?>

<?php
include_once("includes/msgs.php");
?>

<?php
$id = $_GET['id'];

$consulta_entrevista = mysqli_query ($conexao, "SELECT * FROM usuarios_entrevistas WHERE id='$id'") or die (mysqli_error());
	$dados = mysqli_fetch_array ($consulta_entrevista);
		$usuario_ent 	= $dados['id_usuario'];
		$data 			= $dados['data'];
		$hora 			= $dados['hora'];
		$vaga 			= $dados['vaga'];
		$status 		= $dados['status'];
		
		$data = substr($data,8,2) . "/" .substr($data,5,2) . "/" . substr($data,0,4);
		
		$consultaUsuario = mysqli_query ($conexao, "SELECT nome FROM usuarios WHERE id='$usuario_ent'") or die (mysqli_error());
			$dados = mysqli_fetch_array($consultaUsuario);
				$nomeUsuario = $dados['nome'];
		
		$consultaVaga = mysqli_query ($conexao, "SELECT vaga FROM vagas WHERE id='$vaga'") or die (mysqli_error());
			$dados = mysqli_fetch_array($consultaVaga);
				$nomeVaga = $dados['vaga'];
?>

<div class="row">
<div class="col-md-5">
<h2>Feedback da Entrevista</h2>

<?php
$consulta_feedbacks = mysqli_query ($conexao, "SELECT * FROM usuarios_feed_entrevistas WHERE id_entrevista='$id'") or die (mysqli_error());
$conta_feed = mysqli_num_rows ($consulta_feedbacks);

if ($conta_feed == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhum feedback cadastrado para esta entrevista
		</div>
	</div>
</div>
<?php
} else {
?>
<div class="well">
<?php
while ($dados = mysqli_fetch_array ($consulta_feedbacks)) {
	$data_feed 		= $dados['data'];
	$feedback 		= $dados['feedback'];
	$situacao 		= $dados['situacao'];
	$data_retorno 	= $dados['data_retorno'];
	$hora_retorno 	= $dados['hora_retorno'];
	
	$data_feed = substr($data_feed,8,2) . "/" .substr($data_feed,5,2) . "/" . substr($data_feed,0,4);
	
	$data_retorno = substr($data_retorno,8,2) . "/" .substr($data_retorno,5,2) . "/" . substr($data_retorno,0,4);
	$hora_retorno = substr($hora_retorno,0,2) . ":" .substr($hora_retorno,3,2);
	
	// Tipo
	switch ($situacao) {
		case "E": $situacao_ext = "EM ANDAMENTO"; $situacao_class = "label label-info"; break;
		case "A": $situacao_ext = "APROVADO(A)"; $situacao_class = "label label-success"; break;
		case "R": $situacao_ext = "REPROVADO(A)"; $situacao_class = "label label-danger"; break;
		case "I": $situacao_ext = "INDICADO(A) PARA OUTRA VAGA"; $situacao_class = "label label-warning"; break;
		case "D": $situacao_ext = "DESISTÊNCIA"; $situacao_class = "label label-purple"; break;
		case "C": $situacao_ext = "NÃO COMPARECEU"; $situacao_class = "label label-mint"; break;
	}
?>
<p><?php echo $data_feed; ?></p>
<p class="text-primary"><?php echo $feedback; ?></p>
<p><span class="<?php echo $situacao_class; ?>"><?php echo $situacao_ext; ?></span></p>
<?php if ($situacao == "E") { ?>
<p><span class="text-danger">O CANDIDATO DEVERÁ RETORNOR DIA <strong><?php echo $data_retorno; ?></strong> ÀS <strong><?php echo $hora_retorno; ?></strong></span></p>
<?php } ?>
<hr>
<?php
}
?>
</div>
<?php
}
?>
</div>

<div class="col-md-7">
<?php
if ($status == "P") {
	
	if ($conta_feed == 0) {
		$data_feed = $data;
	}
	else {
		$data_feed = date ("d-m-Y");
	}
?>

<form method="post" action="funcoes/entrevistas.php?funcao=feedback&entrevista=<?php echo $id; ?>&usuario=<?php echo $usuario_ent; ?>&vaga=<?php echo $vaga; ?>" class="form-horizontal">
    <fieldset>
        <legend>Salvar Feedback</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputData" class="col-sm-3 control-label">Data</label>
            <div class="col-sm-4">
            	<input type="text" name="data" class="form-control" id="inputData" autocomplete="off" required autofocus value="<?php echo $data_feed; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
            <label for="inputFeedback" class="col-sm-3 control-label">Feedback</label>
            <div class="col-sm-9">
                <textarea name="feedback" rows="8" class="form-control" id="inputFeedback" placeholder="Informe o feedback da entrevista" required></textarea>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <label for="radioSituacao" class="col-sm-3 control-label">Situação</label>
            <div class="col-sm-9">
                <div class="radio">
                    <label>
                        <input type="radio" name="situacao" value="E" checked onclick="if(document.getElementById('inputDataEnt').disabled==true && document.getElementById('inputHoraEnt').disabled==true){document.getElementById('inputDataEnt').disabled=false; document.getElementById('inputHoraEnt').disabled=false}"> Em andamento
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="situacao" value="A" onclick="if(document.getElementById('inputDataEnt').disabled==false && document.getElementById('inputHoraEnt').disabled==false){document.getElementById('inputDataEnt').disabled=true; document.getElementById('inputHoraEnt').disabled=true}"> Aprovado
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="situacao" value="R" onclick="if(document.getElementById('inputDataEnt').disabled==false && document.getElementById('inputHoraEnt').disabled==false){document.getElementById('inputDataEnt').disabled=true; document.getElementById('inputHoraEnt').disabled=true}"> Reprovado
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="situacao" value="I" onclick="if(document.getElementById('inputDataEnt').disabled==false && document.getElementById('inputHoraEnt').disabled==false){document.getElementById('inputDataEnt').disabled=true; document.getElementById('inputHoraEnt').disabled=true}"> Indicado para outra vaga
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="situacao" value="D" onclick="if(document.getElementById('inputDataEnt').disabled==false && document.getElementById('inputHoraEnt').disabled==false){document.getElementById('inputDataEnt').disabled=true; document.getElementById('inputHoraEnt').disabled=true}"> Desistência
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="situacao" value="C" onclick="if(document.getElementById('inputDataEnt').disabled==false && document.getElementById('inputHoraEnt').disabled==false){document.getElementById('inputDataEnt').disabled=true; document.getElementById('inputHoraEnt').disabled=true}"> Não compareceu
                    </label>
                </div>
            </div>
        </div>
        
        <hr>
        
        <p><strong>Agendar nova entrevista para <?php echo primeiro_nome($nomeUsuario); ?></strong></p>
        
        <div class="form-group form-group-sm">
        	<label for="inputDataEnt" class="col-sm-3 control-label">Data</label>
            <div class="col-sm-4">
            	<input type="text" name="data_ent" class="form-control" id="inputDataEnt" autocomplete="off">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputHoraEnt" class="col-sm-3 control-label">Hora</label>
            <div class="col-sm-4">
            	<input type="text" name="hora_ent" class="form-control" id="inputHoraEnt" autocomplete="off">
            </div>
        </div>
        
        <hr>
        
        <?php
		$consulta_obs = mysqli_query ($conexao, "SELECT * FROM usuarios_obs WHERE id_usuario='$usuario_ent'") or die (mysqli_error());
			$dados = mysqli_fetch_array ($consulta_obs);
				$administrativo = $dados['administrativo'];
				$almoxarifado 	= $dados['almoxarifado'];
				$compras 		= $dados['compras'];
				$contabilidade 	= $dados['contabilidade'];
				$construcao 	= $dados['construcao'];
				$financeiro 	= $dados['financeiro'];
				$manutencao 	= $dados['manutencao'];
				$pcp 			= $dados['pcp'];
				$portaria 		= $dados['portaria'];
				$producao 		= $dados['producao'];
				$projeto 		= $dados['projeto'];
				$qualidade 		= $dados['qualidade'];
				$recepcao 		= $dados['recepcao'];
				$ti 			= $dados['ti'];
				$transporte 	= $dados['transporte'];
				$vendas 		= $dados['vendas'];
				$limpeza 		= $dados['limpeza'];
				$faturamento 	= $dados['faturamento'];
				$seguranca 		= $dados['seguranca'];
				$rh 			= $dados['rh'];
		?>
        
        <p><strong>O candidato é indicado para outra área?</strong></p>
        
        <div class="form-group form-group-sm">
            <label for="checkboxPerfil" class="col-sm-3 control-label">Perfil</label>
            <div class="col-sm-9">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="administrativo" value="1"<?php if ($administrativo == "1") { echo " checked"; } ?>> Administrativo
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="almoxarifado" value="1"<?php if ($almoxarifado == "1") { echo " checked"; } ?>> Almoxarifado
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="compras" value="1"<?php if ($compras == "1") { echo " checked"; } ?>> Compras
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="contabilidade" value="1"<?php if ($contabilidade == "1") { echo " checked"; } ?>> Contabilidade
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="construcao" value="1"<?php if ($construcao == "1") { echo " checked"; } ?>> Construção
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="faturamento" value="1"<?php if ($faturamento == "1") { echo " checked"; } ?>> Faturamento
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="financeiro" value="1"<?php if ($financeiro == "1") { echo " checked"; } ?>> Financeiro
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="limpeza" value="1"<?php if ($limpeza == "1") { echo " checked"; } ?>> Limpeza
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="manutencao" value="1"<?php if ($manutencao == "1") { echo " checked"; } ?>> Manutenção
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="pcp" value="1"<?php if ($pcp == "1") { echo " checked"; } ?>> PCP
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="portaria" value="1"<?php if ($portaria == "1") { echo " checked"; } ?>> Portaria
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="producao" value="1"<?php if ($producao == "1") { echo " checked"; } ?>> Produção
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="projeto" value="1"<?php if ($projeto == "1") { echo " checked"; } ?>> Projeto
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="qualidade" value="1"<?php if ($qualidade == "1") { echo " checked"; } ?>> Qualidade
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="recepcao" value="1"<?php if ($recepcao == "1") { echo " checked"; } ?>> Recepção
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="rh" value="1"<?php if ($rh == "1") { echo " checked"; } ?>> RH
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="seguranca" value="1"<?php if ($seguranca == "1") { echo " checked"; } ?>> Segurança do Trabalho
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="ti" value="1"<?php if ($ti == "1") { echo " checked"; } ?>> TI
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="transporte" value="1"<?php if ($transporte == "1") { echo " checked"; } ?>> Transporte
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="vendas" value="1"<?php if ($vendas == "1") { echo " checked"; } ?>> Vendas
                    </label>
                </div>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </fieldset>
</form>

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
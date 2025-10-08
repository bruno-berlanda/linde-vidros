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
    	<h1>Tags</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_tags == "S") {
?>

<?php
include_once("includes/msgs.php");
?>

<div class="row">
<div class="col-md-6">
<?php
$consulta = mysqli_query ($conexao, "SELECT * FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$dados = mysqli_fetch_array($consulta);
		$p_home 				= $dados['home'];
		$p_acessorios			= $dados['acessorios'];
		$p_aluminios			= $dados['aluminios'];
		$p_aluminios_detalhes 	= $dados['aluminios_detalhes'];
		$p_area_restrita 		= $dados['area_restrita'];
		$p_cantos				= $dados['cantos'];
		$p_contato 				= $dados['contato'];
		$p_curriculo_cadastrar	= $dados['curriculo_cadastrar'];
		$p_curriculo_entrar		= $dados['curriculo_entrar'];
		$p_empresa				= $dados['empresa'];
		$p_engenharia			= $dados['engenharia'];
		$p_espelho				= $dados['espelho'];
		$p_ferragens			= $dados['ferragens'];
		$p_ferragens_detalhes	= $dados['ferragens_detalhes'];
		$p_gestao_pessoas		= $dados['gestao_pessoas'];
		$p_idea_glass 			= $dados['idea_glass'];
		$p_incisao 				= $dados['incisao'];
		$p_lapidacao 			= $dados['lapidacao'];
		$p_moveleiro 			= $dados['moveleiro'];
		$p_pelicula 			= $dados['pelicula'];
		$p_portas_aluminio 		= $dados['portas_aluminio'];
		$p_portas_expositores	= $dados['portas_expositores'];
		$p_refrigeracao			= $dados['refrigeracao'];
		$p_sentryglas			= $dados['sentryglas'];
		$p_serigrafia			= $dados['serigrafia'];
		$p_servicos				= $dados['servicos'];
		$p_tampas_freezer		= $dados['tampas_freezer'];
		$p_vidro_extraclear		= $dados['vidro_extraclear'];
		$p_vidro_habitat		= $dados['vidro_habitat'];
		$p_vidro_insulado 		= $dados['vidro_insulado'];
		$p_vidro_laminado		= $dados['vidro_laminado'];
		$p_vidro_refletivo		= $dados['vidro_refletivo'];
		$p_vidro_temperado		= $dados['vidro_temperado'];
		$p_vidro_texturizado	= $dados['vidro_texturizado'];
?>
<form method="post" action="funcoes/tags.php?funcao=atualizar" class="form-horizontal">
    <fieldset>
        <legend>Atualizar Tags</legend>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	PRINCIPAL
            </div>
        </div>
                
        <div class="form-group form-group-sm">
        	<label for="inputHome" class="col-sm-3 control-label">Home</label>
            <div class="col-sm-9">
            	<input type="text" name="p_home" class="form-control" id="inputHome" autocomplete="off" autofocus value="<?php echo $p_home; ?>">
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	EMPRESA
            </div>
        </div>
                
        <div class="form-group form-group-sm">
        	<label for="inputEmpresa" class="col-sm-3 control-label">Empresa</label>
            <div class="col-sm-9">
            	<input type="text" name="p_empresa" class="form-control" id="inputEmpresa" autocomplete="off" value="<?php echo $p_empresa; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputGestao" class="col-sm-3 control-label">Gestão Pessoas</label>
            <div class="col-sm-9">
            	<input type="text" name="p_gestao_pessoas" class="form-control" id="inputGestao" autocomplete="off" value="<?php echo $p_gestao_pessoas; ?>">
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	ENGENHARIA
            </div>
        </div>
                
        <div class="form-group form-group-sm">
        	<label for="inputEngenharia" class="col-sm-3 control-label">Engenharia</label>
            <div class="col-sm-9">
            	<input type="text" name="p_engenharia" class="form-control" id="inputEngenharia" autocomplete="off" value="<?php echo $p_engenharia; ?>">
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<hr>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
        	<label for="inputTemperado" class="col-sm-3 control-label">Temperado</label>
            <div class="col-sm-9">
            	<input type="text" name="p_vidro_temperado" class="form-control" id="inputTemperado" autocomplete="off" value="<?php echo $p_vidro_temperado; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputLaminado" class="col-sm-3 control-label">Laminado</label>
            <div class="col-sm-9">
            	<input type="text" name="p_vidro_laminado" class="form-control" id="inputLaminado" autocomplete="off" value="<?php echo $p_vidro_laminado; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputRefletivo" class="col-sm-3 control-label">Refletivo</label>
            <div class="col-sm-9">
            	<input type="text" name="p_vidro_refletivo" class="form-control" id="inputRefletivo" autocomplete="off" value="<?php echo $p_vidro_refletivo; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputInsulado" class="col-sm-3 control-label">Insulado</label>
            <div class="col-sm-9">
            	<input type="text" name="p_vidro_insulado" class="form-control" id="inputInsulado" autocomplete="off" value="<?php echo $p_vidro_insulado; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputHabitat" class="col-sm-3 control-label">Habitat</label>
            <div class="col-sm-9">
            	<input type="text" name="p_vidro_habitat" class="form-control" id="inputHabitat" autocomplete="off" value="<?php echo $p_vidro_habitat; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputTexturizado" class="col-sm-3 control-label">Texturizado</label>
            <div class="col-sm-9">
            	<input type="text" name="p_vidro_texturizado" class="form-control" id="inputTexturizado" autocomplete="off" value="<?php echo $p_vidro_texturizado; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputExtra" class="col-sm-3 control-label">Extra Clear</label>
            <div class="col-sm-9">
            	<input type="text" name="p_vidro_extraclear" class="form-control" id="inputExtra" autocomplete="off" value="<?php echo $p_vidro_extraclear; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputSentryGlas" class="col-sm-3 control-label">SentryGlas</label>
            <div class="col-sm-9">
            	<input type="text" name="p_sentryglas" class="form-control" id="inputSentryGlas" autocomplete="off" value="<?php echo $p_sentryglas; ?>">
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	MOVELEIRO
            </div>
        </div>
                
        <div class="form-group form-group-sm">
        	<label for="inputMoveleiro" class="col-sm-3 control-label">Moveleiro</label>
            <div class="col-sm-9">
            	<input type="text" name="p_moveleiro" class="form-control" id="inputMoveleiro" autocomplete="off" value="<?php echo $p_moveleiro; ?>">
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<hr>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
        	<label for="inputPortas" class="col-sm-3 control-label">Portas Alumínio</label>
            <div class="col-sm-9">
            	<input type="text" name="p_portas_aluminio" class="form-control" id="inputPortas" autocomplete="off" value="<?php echo $p_portas_aluminio; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputEspelho" class="col-sm-3 control-label">Espelho</label>
            <div class="col-sm-9">
            	<input type="text" name="p_espelho" class="form-control" id="inputEspelho" autocomplete="off" value="<?php echo $p_espelho; ?>">
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	REFRIGERAÇÃO
            </div>
        </div>
                
        <div class="form-group form-group-sm">
        	<label for="inputRefrigeracao" class="col-sm-3 control-label">Refrigeração</label>
            <div class="col-sm-9">
            	<input type="text" name="p_refrigeracao" class="form-control" id="inputRefrigeracao" autocomplete="off" value="<?php echo $p_refrigeracao; ?>">
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<hr>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
        	<label for="inputExpositores" class="col-sm-3 control-label">Portas Expositores</label>
            <div class="col-sm-9">
            	<input type="text" name="p_portas_expositores" class="form-control" id="inputExpositores" autocomplete="off" value="<?php echo $p_portas_expositores; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputTampas" class="col-sm-3 control-label">Tampas Freezer</label>
            <div class="col-sm-9">
            	<input type="text" name="p_tampas_freezer" class="form-control" id="inputTampas" autocomplete="off" value="<?php echo $p_tampas_freezer; ?>">
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	ACESSÓRIOS
            </div>
        </div>
                
        <div class="form-group form-group-sm">
        	<label for="inputAcessorios" class="col-sm-3 control-label">Acessórios</label>
            <div class="col-sm-9">
            	<input type="text" name="p_acessorios" class="form-control" id="inputAcessorios" autocomplete="off" value="<?php echo $p_acessorios; ?>">
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<hr>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
        	<label for="inputFerragens" class="col-sm-3 control-label">Ferragens</label>
            <div class="col-sm-9">
            	<input type="text" name="p_ferragens" class="form-control" id="inputFerragens" autocomplete="off" value="<?php echo $p_ferragens; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputFerragensD" class="col-sm-3 control-label">Ferragens (Detalhes)</label>
            <div class="col-sm-9">
            	<input type="text" name="p_ferragens_detalhes" class="form-control" id="inputFerragensD" autocomplete="off" value="<?php echo $p_ferragens_detalhes; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputAluminios" class="col-sm-3 control-label">Alumínios</label>
            <div class="col-sm-9">
            	<input type="text" name="p_aluminios" class="form-control" id="inputAluminios" autocomplete="off" value="<?php echo $p_aluminios; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputAluminiosD" class="col-sm-3 control-label">Alumínios (Detalhes)</label>
            <div class="col-sm-9">
            	<input type="text" name="p_aluminios_detalhes" class="form-control" id="inputAluminiosD" autocomplete="off" value="<?php echo $p_aluminios_detalhes; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputIdea" class="col-sm-3 control-label">Idea Glass</label>
            <div class="col-sm-9">
            	<input type="text" name="p_idea_glass" class="form-control" id="inputIdea" autocomplete="off" value="<?php echo $p_idea_glass; ?>">
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	SERVIÇOS
            </div>
        </div>
                
        <div class="form-group form-group-sm">
        	<label for="inputServicos" class="col-sm-3 control-label">Serviços</label>
            <div class="col-sm-9">
            	<input type="text" name="p_servicos" class="form-control" id="inputServicos" autocomplete="off" value="<?php echo $p_servicos; ?>">
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<hr>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
        	<label for="inputPelicula" class="col-sm-3 control-label">Película</label>
            <div class="col-sm-9">
            	<input type="text" name="p_pelicula" class="form-control" id="inputPelicula" autocomplete="off" value="<?php echo $p_pelicula; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputSerigrafia" class="col-sm-3 control-label">Serigrafia</label>
            <div class="col-sm-9">
            	<input type="text" name="p_serigrafia" class="form-control" id="inputSerigrafia" autocomplete="off" value="<?php echo $p_serigrafia; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputLapidacao" class="col-sm-3 control-label">Lapidação</label>
            <div class="col-sm-9">
            	<input type="text" name="p_lapidacao" class="form-control" id="inputLapidacao" autocomplete="off" value="<?php echo $p_lapidacao; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputIncisao" class="col-sm-3 control-label">Incisão</label>
            <div class="col-sm-9">
            	<input type="text" name="p_incisao" class="form-control" id="inputIncisao" autocomplete="off" value="<?php echo $p_incisao; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputCantos" class="col-sm-3 control-label">Cantos</label>
            <div class="col-sm-9">
            	<input type="text" name="p_cantos" class="form-control" id="inputCantos" autocomplete="off" value="<?php echo $p_cantos; ?>">
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	CONTATO
            </div>
        </div>
                
        <div class="form-group form-group-sm">
        	<label for="inputContato" class="col-sm-3 control-label">Contato</label>
            <div class="col-sm-9">
            	<input type="text" name="p_contato" class="form-control" id="inputContato" autocomplete="off" value="<?php echo $p_contato; ?>">
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<hr>
            </div>
        </div>
        
        <div class="form-group form-group-sm">
        	<label for="inputCurriculoC" class="col-sm-3 control-label">Currículo (Cadastrar)</label>
            <div class="col-sm-9">
            	<input type="text" name="p_curriculo_cadastrar" class="form-control" id="inputCurriculoC" autocomplete="off" value="<?php echo $p_curriculo_cadastrar; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputCurriculoE" class="col-sm-3 control-label">Currículo (Entrar)</label>
            <div class="col-sm-9">
            	<input type="text" name="p_curriculo_entrar" class="form-control" id="inputCurriculoE" autocomplete="off" value="<?php echo $p_curriculo_entrar; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputArea" class="col-sm-3 control-label">Área Restrita</label>
            <div class="col-sm-9">
            	<input type="text" name="p_area_restrita" class="form-control" id="inputArea" autocomplete="off" value="<?php echo $p_area_restrita; ?>">
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </fieldset>
</form>
</div>
<div class="col-md-6">
<div class="well">
<form method="post" action="funcoes/tags.php?funcao=atualizar_todas" class="form-horizontal">
    <fieldset>
        <legend>Atualizar Todas as Tags</legend>
                
        <div class="form-group form-group-sm">
        	<label for="inputNovaTag" class="col-sm-3 control-label">Nova Tag</label>
            <div class="col-sm-9">
            	<input type="text" name="tag_nova" class="form-control" id="inputNovaTag" autocomplete="off">
            </div>
        </div>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </fieldset>
</form>
</div>
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
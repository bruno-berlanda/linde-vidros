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
    	<h1>Representantes</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_representantes == "S") {
?>

<?php
include_once("includes/msgs.php");
?>

<div class="row">
<div class="col-md-6">
<?php
if (!isset($_GET['editar'])) {
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
CADASTRAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<form method="post" action="funcoes/representantes.php?funcao=cadastrar" class="form-horizontal">
    <fieldset>
        <legend>Cadastrar Representante</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputNome" class="col-sm-3 control-label">Nome</label>
            <div class="col-sm-9">
            	<input type="text" name="nome" class="form-control" id="inputNome" autocomplete="off" maxlength="100" required autofocus>
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
        	<label for="inputUsuario" class="col-sm-3 control-label">Usuário</label>
            <div class="col-sm-5">
            	<input type="text" name="usuario" class="form-control" id="inputUsuario" autocomplete="off" maxlength="50" required>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputSenha" class="col-sm-3 control-label">Senha</label>
            <div class="col-sm-5">
            	<input type="text" name="senha" class="form-control" id="inputSenha" autocomplete="off" maxlength="6" required>
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
        	<label for="inputEmail" class="col-sm-3 control-label">E-mail</label>
            <div class="col-sm-9">
            	<input type="email" name="email" class="form-control" id="inputEmail" autocomplete="off" maxlength="100" required>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputTelFixo" class="col-sm-3 control-label">Tel Fixo</label>
            <div class="col-sm-4">
            	<input type="text" name="tel_fixo" class="form-control" id="inputTelFixo" autocomplete="off">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputTelCelular1" class="col-sm-3 control-label">Tel Celular 1</label>
            <div class="col-sm-4">
            	<input type="text" name="tel_celular1" class="form-control" id="inputTelCelular1" autocomplete="off">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputTelCelular2" class="col-sm-3 control-label">Tel Celular 2</label>
            <div class="col-sm-4">
            	<input type="text" name="tel_celular2" class="form-control" id="inputTelCelular2" autocomplete="off">
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
        	<label for="selectTipo" class="col-sm-3 control-label">Tipo</label>
            <div class="col-sm-4">
            	<select name="tipo" id="selectTipo" class="form-control" required>
                	<option></option>
                    <option value="G">GERENTE</option>
                    <option value="R">REPRESENTANTE</option>
                    <option value="V">VENDEDOR</option>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="selectSegmento" class="col-sm-3 control-label">Segmento</label>
            <div class="col-sm-4">
            	<select name="segmento" id="selectSegmento" class="form-control">
                	<option></option>
                    <option value="ENG">ENGENHARIA</option>
                    <option value="MOV">MOVELEIRO</option>
                    <option value="CHA">CHAPARIA</option>
                    <option value="FER">FERRAGENS</option>
                </select>
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_promocoes" value="S" checked> Promoções
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_tabelas" value="S" checked> Tabelas de Preço
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_orcamentos" value="S" checked> Orçamentos
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_agenda" value="S" checked> Agenda
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_croquis" value="S" checked> Croquis
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_materiais" value="S" checked> Materiais de Divulgação
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_procedimentos" value="S" checked> Procedimentos
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_normas" value="S" checked> Normas
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_metas" value="S" checked> Metas
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_insulado" value="S" checked> Orçamento Insulado
                    </label>
                </div>
            </div>
        </div>
        
        <hr>
        
        <h2>Diário Representantes</h2>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_diario" value="S" checked> Diário
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_diario_gerente" value="S"> Diário (Gerenciar)
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="selectResponsavel" class="col-sm-3 control-label">Responsável</label>
            <div class="col-sm-9">
            	<select name="p_diario_responsavel" id="selectResponsavel" class="form-control">
                	<option></option>
                    <?php
					$sql_representantes = mysqli_query ($conexao, "SELECT id, nome FROM representantes WHERE id!='1' AND tipo='V' AND ativo='S' ORDER BY nome") or die (mysqli_error());
					
					while ($d_representantes = mysqli_fetch_array ($sql_representantes)) {
						$r_id = $d_representantes['id'];
						$r_nm = $d_representantes['nome'];
					?>
                    <option value="<?php echo $r_id; ?>"><?php echo $r_nm; ?></option>
                    <?php
					}
					?>
                </select>
            </div>
        </div>
        
        <hr>
        
        <h2>Pedidos Moveleiro</h2>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_pedmov_gerenciar" value="S"> Gerenciar Pedidos
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_pedmov_solicitar" value="S"> Solicitar Pedidos
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="selectResponsavel2" class="col-sm-3 control-label">Responsável</label>
            <div class="col-sm-9">
            	<select name="p_pedmov_responsavel" id="selectResponsavel2" class="form-control">
                	<option></option>
                    <?php
					$sql_representantes = mysqli_query ($conexao, "SELECT id, nome FROM representantes WHERE id!='1' AND tipo='V' AND ativo='S' ORDER BY nome") or die (mysqli_error());
					
					while ($d_representantes = mysqli_fetch_array ($sql_representantes)) {
						$r_id = $d_representantes['id'];
						$r_nm = $d_representantes['nome'];
					?>
                    <option value="<?php echo $r_id; ?>"><?php echo $r_nm; ?></option>
                    <?php
					}
					?>
                </select>
            </div>
        </div>
        
        <br><br>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </fieldset>
</form>
<?php
}
else if (isset($_GET['editar'])) {
	
	$id 		= $_GET['editar'];
	$f_tipo 	= $_GET['tipo'];
	$f_status 	= $_GET['status'];
	
	$consulta = mysqli_query ($conexao, "SELECT * FROM representantes WHERE id='$id'") or die (mysqli_error());
		$dados = mysqli_fetch_array($consulta);
			$nome 				= $dados['nome'];
			$usuario			= $dados['login'];
			$email 				= $dados['email'];
			$fone1 				= $dados['fone1'];
			$fone2				= $dados['fone2'];
			$fone3 				= $dados['fone3'];
			$tipo 				= $dados['tipo'];
			$segmento			= $dados['segmento'];
			
			$p_promocoes		= $dados['p_promocoes'];
			$p_tabelas			= $dados['p_tabelas'];
			$p_orcamentos		= $dados['p_orcamentos'];
			$p_agenda			= $dados['p_agenda'];
			$p_croquis			= $dados['p_croquis'];
			$p_materiais		= $dados['p_materiais'];
			$p_procedimentos	= $dados['p_procedimentos'];
			$p_normas			= $dados['p_normas'];
			$p_metas			= $dados['p_metas'];
			$p_insulado			= $dados['p_insulado'];
			$p_diario			= $dados['p_diario'];
			$p_diario_ger		= $dados['p_diario_gerente'];
			$p_diario_resp		= $dados['p_diario_responsavel'];
			$p_pedmov_solicitar	= $dados['p_pedmov_solicitar'];
			$p_pedmov_gerenciar	= $dados['p_pedmov_gerenciar'];
			$p_pedmov_resp		= $dados['p_pedmov_responsavel'];
?>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------------------
EDITAR
-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------- -->
<form method="post" action="funcoes/representantes.php?funcao=editar&id=<?php echo $id; ?>&f=<?php echo $f_tipo; ?>&s=<?php echo $f_status; ?>" class="form-horizontal">
    <fieldset>
        <legend>Editar Representante</legend>
        
        <div class="form-group form-group-sm">
        	<label for="inputNome" class="col-sm-3 control-label">Nome</label>
            <div class="col-sm-9">
            	<input type="text" name="nome" class="form-control" id="inputNome" autocomplete="off" maxlength="100" required autofocus value="<?php echo $nome; ?>">
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
        	<label for="inputUsuario" class="col-sm-3 control-label">Usuário</label>
            <div class="col-sm-5">
            	<input type="text" name="usuario" class="form-control" id="inputUsuario" autocomplete="off" maxlength="50" required value="<?php echo $usuario; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputSenha" class="col-sm-3 control-label">Senha</label>
            <div class="col-sm-5">
            	<input type="text" name="senha" class="form-control" id="inputSenha" autocomplete="off" maxlength="6">
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
        	<label for="inputEmail" class="col-sm-3 control-label">E-mail</label>
            <div class="col-sm-9">
            	<input type="email" name="email" class="form-control" id="inputEmail" autocomplete="off" maxlength="100" required value="<?php echo $email; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputTelFixo" class="col-sm-3 control-label">Tel Fixo</label>
            <div class="col-sm-4">
            	<input type="text" name="tel_fixo" class="form-control" id="inputTelFixo" autocomplete="off" value="<?php echo $fone1; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputTelCelular1" class="col-sm-3 control-label">Tel Celular 1</label>
            <div class="col-sm-4">
            	<input type="text" name="tel_celular1" class="form-control" id="inputTelCelular1" autocomplete="off" value="<?php echo $fone2; ?>">
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="inputTelCelular2" class="col-sm-3 control-label">Tel Celular 2</label>
            <div class="col-sm-4">
            	<input type="text" name="tel_celular2" class="form-control" id="inputTelCelular2" autocomplete="off" value="<?php echo $fone3; ?>">
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
        	<label for="selectTipo" class="col-sm-3 control-label">Tipo</label>
            <div class="col-sm-4">
            	<select name="tipo" id="selectTipo" class="form-control" required>
                    <option value="G"<?php if ($tipo == "G") { echo " selected"; } ?>>GERENTE</option>
                    <option value="R"<?php if ($tipo == "R") { echo " selected"; } ?>>REPRESENTANTE</option>
                    <option value="V"<?php if ($tipo == "V") { echo " selected"; } ?>>VENDEDOR</option>
                </select>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="selectSegmento" class="col-sm-3 control-label">Segmento</label>
            <div class="col-sm-4">
            	<select name="segmento" id="selectSegmento" class="form-control">
                	<option></option>
                    <option value="ENG"<?php if ($segmento == "ENG") { echo " selected"; } ?>>ENGENHARIA</option>
                    <option value="MOV"<?php if ($segmento == "MOV") { echo " selected"; } ?>>MOVELEIRO</option>
                    <option value="CHA"<?php if ($segmento == "CHA") { echo " selected"; } ?>>CHAPARIA</option>
                    <option value="FER"<?php if ($segmento == "FER") { echo " selected"; } ?>>FERRAGENS</option>
                </select>
            </div>
        </div>
        
        <hr>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_promocoes" value="S"<?php if ($p_promocoes == "S") { echo " checked"; } ?>> Promoções
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_tabelas" value="S"<?php if ($p_tabelas == "S") { echo " checked"; } ?>> Tabelas de Preço
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_orcamentos" value="S"<?php if ($p_orcamentos == "S") { echo " checked"; } ?>> Orçamentos
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_agenda" value="S"<?php if ($p_agenda == "S") { echo " checked"; } ?>> Agenda
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_croquis" value="S"<?php if ($p_croquis == "S") { echo " checked"; } ?>> Croquis
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_materiais" value="S"<?php if ($p_materiais == "S") { echo " checked"; } ?>> Materiais de Divulgação
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_procedimentos" value="S"<?php if ($p_procedimentos == "S") { echo " checked"; } ?>> Procedimentos
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_normas" value="S"<?php if ($p_normas == "S") { echo " checked"; } ?>> Normas
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_metas" value="S"<?php if ($p_metas == "S") { echo " checked"; } ?>> Metas
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_insulado" value="S"<?php if ($p_insulado == "S") { echo " checked"; } ?>> Orçamento Insulado
                    </label>
                </div>
            </div>
        </div>
        
        <hr>
        
        <h2>Diário Representantes</h2>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_diario" value="S"<?php if ($p_diario == "S") { echo " checked"; } ?>> Diário
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_diario_gerente" value="S"<?php if ($p_diario_ger == "S") { echo " checked"; } ?>> Diário (Gerenciar)
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="selectResponsavel" class="col-sm-3 control-label">Responsável</label>
            <div class="col-sm-9">
            	<select name="p_diario_responsavel" id="selectResponsavel" class="form-control">
                	<option></option>
                    <?php
					$sql_representantes = mysqli_query ($conexao, "SELECT id, nome FROM representantes WHERE id!='1' AND tipo='V' AND ativo='S' ORDER BY nome") or die (mysqli_error());
					
					while ($d_representantes = mysqli_fetch_array ($sql_representantes)) {
						$r_id = $d_representantes['id'];
						$r_nm = $d_representantes['nome'];
					?>
                    <option value="<?php echo $r_id; ?>"<?php if ($r_id == $p_diario_resp) { echo " selected"; } ?>><?php echo $r_nm; ?></option>
                    <?php
					}
					?>
                </select>
            </div>
        </div>
        
        <hr>
        
        <h2>Pedidos Moveleiro</h2>
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_pedmov_gerenciar" value="S"<?php if ($p_pedmov_gerenciar == "S") { echo " checked"; } ?>> Gerenciar Pedidos
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
                <div class="checkbox">
                    <label>
                    	<input type="checkbox" name="p_pedmov_solicitar" value="S"<?php if ($p_pedmov_solicitar == "S") { echo " checked"; } ?>> Solicitar Pedidos
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group form-group-sm">
        	<label for="selectResponsavel2" class="col-sm-3 control-label">Responsável</label>
            <div class="col-sm-9">
            	<select name="p_pedmov_responsavel" id="selectResponsavel2" class="form-control">
                	<option></option>
                    <?php
					$sql_representantes = mysqli_query ($conexao, "SELECT id, nome FROM representantes WHERE id!='1' AND tipo='V' AND ativo='S' ORDER BY nome") or die (mysqli_error());
					
					while ($d_representantes = mysqli_fetch_array ($sql_representantes)) {
						$r_id = $d_representantes['id'];
						$r_nm = $d_representantes['nome'];
					?>
                    <option value="<?php echo $r_id; ?>"<?php if ($r_id == $p_pedmov_resp) { echo " selected"; } ?>><?php echo $r_nm; ?></option>
                    <?php
					}
					?>
                </select>
            </div>
        </div>
        
        <br><br>
        
        <input type="hidden" name="nome_atual" value="<?php echo $nome; ?>">
        <input type="hidden" name="usuario_atual" value="<?php echo $usuario; ?>">
        
        <div class="form-group form-group-sm">
            <div class="col-sm-offset-3 col-sm-9">
            	<button type="submit" class="btn btn-primary">Salvar</button>
                <a href="representantes.php?tipo=<?php echo $f_tipo; ?>&status=<?php echo $f_status; ?>" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </fieldset>
</form>
<?php
}
?>
</div>

<div class="col-md-6">
<h2>Representantes Cadastrados</h2>

<?php
if (isset($_GET['tipo']) && isset($_GET['status'])) {
	$filtro_tipo 	= $_GET['tipo'];
	$filtro_status 	= $_GET['status'];
}
else {
	$filtro_tipo 	= "R";
	$filtro_status 	= "S";
}
?>

<form method="get" action="representantes.php" class="form-inline">
    <div class="form-group form-group-sm">
    	<select name="tipo" class="form-control input-sm" id="selectTipo">
        	<option value="R"<?php if ($filtro_tipo == "R") { echo " selected"; } ?>>Representante</option>
            <option value="V"<?php if ($filtro_tipo == "V") { echo " selected"; } ?>>Vendedor</option>
            <option value="G"<?php if ($filtro_tipo == "G") { echo " selected"; } ?>>Gerente</option>
        </select>
    </div>
    <div class="form-group form-group-sm">
    	<select name="status" class="form-control input-sm" id="selectStatus">
        	<option value="S"<?php if ($filtro_status == "S") { echo " selected"; } ?>>Ativo</option>
            <option value="N"<?php if ($filtro_status == "N") { echo " selected"; } ?>>Inativo</option>
        </select>
    </div>
    
	<button type="submit" class="btn btn-sm btn-primary">Filtrar</button>
</form>

<hr>

<?php
$i = 1;

$consulta = mysqli_query ($conexao, "SELECT * FROM representantes WHERE id!='1' AND tipo='$filtro_tipo' AND ativo='$filtro_status' ORDER BY nome") or die (mysqli_error());
$conta = mysqli_num_rows ($consulta);

if ($conta == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhum representante cadastrado
		</div>
	</div>
</div>
<?php
}
else {
?>

<table class="table table-striped">
    <thead>
    	<tr>
        	<th>#</th>
            <th>NOME</th>
            <th>TIPO</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
	<tbody>

<?php
while ($linha = mysqli_fetch_array($consulta)) {
    $id 		= $linha['id'];
    $nome		= $linha['nome'];
	$usuario	= $linha['login'];
	$tipo		= $linha['tipo'];
	$ativo		= $linha['ativo'];
	
	switch ($tipo) {
		case "G": $tipoUsuario = "GERENTE"; break;
		case "R": $tipoUsuario = "REPRESENTANTE"; break;
		case "V": $tipoUsuario = "VENDEDOR"; break;
	}
	
	// Consulta Logins
	$consulta_logins = mysqli_query ($conexao, "SELECT data FROM login_representantes WHERE usuario='$usuario'") or die (mysqli_error());
		$conta_logins = mysqli_num_rows ($consulta_logins);
	
	// Último Login
	$consulta_ultimo_login = mysqli_query ($conexao, "SELECT data FROM login_representantes WHERE usuario='$usuario' ORDER BY data DESC LIMIT 1") or die (mysqli_error());
		$info_login = mysqli_fetch_array ($consulta_ultimo_login);
			$data_ultimo = $info_login['data'];
			
			$data_ultimo = date('d/m/Y H:i', strtotime($data_ultimo));
?>
    
    	<tr>
        	<td class="text-muted"><?php echo $i++; ?></td>
            <td><?php echo nome_sobrenome($nome); ?></td>
            <td><?php echo $tipoUsuario; ?></td>
            <td>
            <?php
			if ($conta_logins > 0) {
			?>
            <a class="btn btn-xs btn-default btn-block" tabindex="0" rel="popover" data-toggle="popover" data-placement="left" data-trigger="focus" title="Último Acesso" data-content="<?php echo $data_ultimo; ?>"><?php echo $conta_logins; ?></a>
            <?php
			} else {
			?>
            <button class="btn btn-xs btn-default btn-block disabled"><?php echo $conta_logins; ?></button>
            <?php
			}
			?>
            </td>
            
            <td>
			<?php 
            if ($ativo == "S") { ?>
                <a href="funcoes/representantes.php?funcao=desativar&id=<?php echo $id; ?>&t=<?php echo $filtro_tipo; ?>&s=<?php echo $filtro_status; ?>" title="Desativar" class="btn btn-xs btn-block btn-success"><i class="fas fa-thumbs-up"></i></a>
			<?php 
            } else { 
            ?>
                <a href="funcoes/representantes.php?funcao=ativar&id=<?php echo $id; ?>&t=<?php echo $filtro_tipo; ?>&s=<?php echo $filtro_status; ?>" title="Ativar" class="btn btn-xs btn-block btn-default"><i class="fas fa-thumbs-down"></i></a>
            <?php
            }
            ?>
            </td>
            
            <td>
            <a href="representantes.php?editar=<?php echo $id; ?>&tipo=<?php echo $filtro_tipo; ?>&status=<?php echo $filtro_status; ?>" class="btn btn-xs btn-block btn-warning"><i class="fas fa-pencil-alt"></i></a>
            </td>
        </tr>
 <?php } ?>

	</tbody>
</table>
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
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
    	<h1>Contatos</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_contatos == "S") {
?>

<?php
include_once("includes/msgs.php");
?>

<div class="row" id="manutencao-emails">
	<div class="col-md-6">
    	<form method="post" action="funcoes/contatos.php?funcao=cadastrar" class="form-inline">
            
            <legend>Cadastrar e-mail</legend>
            
            <div class="form-group form-group-sm">
            	<input type="text" name="nome" class="form-control" id="inputNome" placeholder="Nome" required maxlength="50" autocomplete="off">
            </div>
            <div class="form-group form-group-sm">
            	<input type="email" name="email" class="form-control" id="inputNome" placeholder="E-mail" required maxlength="100" autocomplete="off">
            </div>

        	<button type="submit" class="btn btn-sm btn-primary">Salvar</button>
        </form>
    </div>
    <div class="col-md-6">
    	<form method="post" action="funcoes/contatos.php?funcao=desativar" class="form-inline">
            
            <legend>Desativar e-mail</legend>
            
            <div class="form-group form-group-sm">
            	<select name="email" class="form-control" id="selectEmail" required>
                	<option></option>
                    <?php
					$consulta_email = mysqli_query ($conexao, "SELECT * FROM contato_emails WHERE ativo='1' ORDER BY nome") or die (mysqli_error());
					while ($dados = mysqli_fetch_array($consulta_email)) {
						$email_id 		= $dados['id'];
						$email_nome 	= $dados['nome'];
						$email_email 	= $dados['email'];
					?>
                    <option value="<?php echo $email_id; ?>"><?php echo $email_nome; ?> - <?php echo $email_email; ?></option>
                    <?php
					}
					?>
                </select>
            </div>

        	<button type="submit" class="btn btn-sm btn-danger">Desativar</button>
        </form>
    </div>
</div>

<div class="row">
<div class="col-md-12">
<?php
$consulta = mysqli_query ($conexao, "SELECT * FROM contato WHERE ativo='1' ORDER BY id DESC LIMIT 15") or die (mysqli_error());
$conta = mysqli_num_rows ($consulta);

if ($conta == 0) {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Nenhuma mensagem recebida
		</div>
	</div>
</div>
<?	
}
else {

	while ($dados = mysqli_fetch_array($consulta)) {
		$id 		= $dados['id'];
		$tipo 		= $dados['tipo'];
		$assunto 	= $dados['assunto'];
		$nome 		= $dados['nome'];
		$cidade 	= $dados['cidade'];
		$uf 		= $dados['uf'];
		$email 		= $dados['email'];
		$fone 		= $dados['fone'];
		$mensagem 	= $dados['mensagem'];
		$resposta 	= $dados['resposta'];
		$data 		= $dados['data'];
		$hora 		= $dados['hora'];
		$motivo 	= $dados['motivo'];
		$lido 		= $dados['lido'];
		$ativo 		= $dados['ativo'];
		
		// Tratamento da DATA
		$data = substr($data,8,2) . "/" .substr($data,5,2) . "/" . substr($data,0,4);
		
		// Tratamento da HORA
		$hora = substr($hora,0,2) . ":" .substr($hora,3,2);
		
		// Tratamento do TIPO
		switch ($tipo) {
			case "1":
				$x_tipo = "RECLAMAÇÃO";
				break;
			case "2":
				$x_tipo = "CRÍTICA";
				break;
			case "3":
				$x_tipo = "SUGESTÃO";
				break;
			case "4":
				$x_tipo = "DÚVIDA";
				break;
			case "5":
				$x_tipo = "COMENTÁRIO";
				break;
		}
		
		// Tratamento do ASSUNTO
		switch ($assunto) {
			case "1":
				$x_assunto = "A LINDE VIDROS";
				break;
			case "2":
				$x_assunto = "NOSSO SITE";
				break;
			case "3":
				$x_assunto = "ATENDIMENTO";
				break;
			case "4":
				$x_assunto = "PRODUTOS";
				break;
			case "5":
				$x_assunto = "ENGENHARIA";
				break;
			case "6":
				$x_assunto = "MOVELEIRO";
				break;
		}
		
		// Tratamento da RESPOSTA
		switch ($resposta) {
			case "1":
				$x_resposta = "VIA E-MAIL";
				break;
			case "2":
				$x_resposta = "VIA TELEFONE";
				break;
			case "3":
				$x_resposta = "NENHUMA";
				break;
		}
?>

<div class="well well-lg"<?php if ($lido == 1) { ?> id="contato-lido"<?php } ?>>
	<div class="row">
    	<div class="col-md-1">
        	<span class="badge">#<?php echo $id; ?></span>
        </div>
        <div class="col-md-4">
        	<span class="badge"><?php echo $x_tipo; ?> - <?php echo $x_assunto; ?></span>
        </div>
        <div class="col-md-2">
        	<span class="text-muted"><?php echo $data; ?> <?php echo $hora; ?></span>
        </div>
        <div class="col-md-5">
        	<p>RESPOSTA: <span class="text-danger"><?php echo $x_resposta; ?></span></p>
        </div>
    </div>
    
    <div class="row">
    	<div class="col-md-5">
        	<p><?php echo $nome; ?> - <span class="text-muted"><?php echo $cidade; ?> / <?php echo $uf; ?></span></p>
        </div>
        <div class="col-md-2">
        	<p><?php echo $fone; ?></p>
        </div>
        <div class="col-md-5">
        	<p><?php echo $email; ?></p>
        </div>
    </div>
    
    <hr>
    
    <?php echo $mensagem; ?>
    
    <hr>
    
    <form method="post" action="funcoes/contatos.php?funcao=enviar&id=<?php echo $id; ?>" class="form-horizontal">
        <fieldset>
            <legend>Encaminhar E-mail</legend>
            
            <div class="form-group form-group-sm">
                <label for="selectEncaminhar" class="col-sm-3 control-label">Encaminhar para</label>
                <div class="col-sm-5">
                    <select name="destinatario" id="selectEncaminhar" class="form-control" required>
                        <option></option>
                        <?php
                        $consultaEmails = mysqli_query ($conexao, "SELECT * FROM contato_emails WHERE ativo='1' ORDER BY nome") or die (mysqli_error());
						while ($dados = mysqli_fetch_array ($consultaEmails)) {
							$nomeDest = $dados['nome'];
							$emailDest = $dados['email'];
						?>
                        <option value="<?php echo $emailDest;?>"><?php echo $nomeDest;?> - <?php echo $emailDest;?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            
            <?php
			/* ********************************************************************************************************************************************************************
			CONSULTA CIDADE
			******************************************************************************************************************************************************************** */
			$consulta_cidade = mysqli_query ($conexao, "SELECT id_rota FROM admin_cidades WHERE cidade='$cidade' AND uf='$uf'") or die (mysqli_error());
				$conta_cidade = mysqli_num_rows ($consulta_cidade);
			
			if ($conta_cidade > 0) {
			?>
			<div class="form-group form-group-sm">
            <?php
				while ($dados = mysqli_fetch_array ($consulta_cidade)) {
					$id_rota = $dados['id_rota'];
					
				$consulta_rota = mysqli_query ($conexao, "SELECT rota, vendedor FROM admin_rotas WHERE id='$id_rota'") or die (mysqli_error());
					$dados = mysqli_fetch_array ($consulta_rota);
						$rota 		= $dados['rota'];
						$vendedor 	= $dados['vendedor'];
						
						$consulta_vendedor = mysqli_query ($conexao, "SELECT nome FROM representantes WHERE id='$vendedor'") or die (mysqli_error());
							$dados = mysqli_fetch_array ($consulta_vendedor);
								$nome_vendedor = $dados['nome'];
			?>
                <div class="col-sm-offset-3 col-sm-9">
                    <p><span class="label label-default"><?php echo $rota; ?> - <?php echo nome_sobrenome($nome_vendedor); ?></span></p>
                </div>
			<?php
				}
			?>
            </div>
            <?php
			}
			/* ********************************************************************************************************************************************************************
			CONSULTA CIDADE
			******************************************************************************************************************************************************************** */
			?>
            <div class="form-group form-group-sm">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">Enviar E-mail</button>
                </div>
            </div>
            
            <?php
			$consultaEnvios = mysqli_query ($conexao, "SELECT * FROM contato_enviados WHERE id_contato='$id'") or die (mysqli_error());
			$contaEnvios = mysqli_num_rows ($consultaEnvios);
			
				if ($contaEnvios >= 1) {
			?>
            <div class="form-group form-group-sm">
                <div class="col-sm-offset-3 col-sm-9">
                    <p><strong>E-mail encaminhado para:</strong></p>
			<?php
					while ($dados = mysqli_fetch_array ($consultaEnvios)) {
						$emailEnvio = $dados['email'];
						$dataEnvio 	= $dados['data'];
						$horaEnvio 	= $dados['hora'];
						
						// Tratamento da DATA
						$dataEnvio = substr($dataEnvio,8,2) . "/" .substr($dataEnvio,5,2) . "/" . substr($dataEnvio,0,4);
						
						// Tratamento da HORA
						$horaEnvio = substr($horaEnvio,0,2) . ":" .substr($horaEnvio,3,2);
					?>
					<p class="text-muted"><?php echo $dataEnvio; ?> <?php echo $horaEnvio; ?> | <?php echo $emailEnvio; ?></p>
			<?php
					}
			?>
            	</div>
			</div>
            <?php
				}
			?>
        </fieldset>
    </form>
    
    <?php if ($contaEnvios == 0 && $perm_contatos == "S") { ?>
    <form method="post" action="funcoes/contatos.php?funcao=excluir&id=<?php echo $id; ?>" class="form-horizontal">
        <fieldset>
            <legend>Excluir E-mail</legend>
            
            <div class="form-group form-group-sm">
                <label for="inputMotivo" class="col-sm-3 control-label">Motivo</label>
                <div class="col-sm-6">
                    <input type="text" name="motivo" class="form-control" id="inputMotivo" autocomplete="off" required>
                </div>
            </div>
            
            <div class="form-group form-group-sm">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-danger">Excluir E-mail</button>
                </div>
            </div>
        </fieldset>
    </form>
    <?php } ?>
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
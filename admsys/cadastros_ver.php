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
    	<h1>Cadastro de Clientes</h1>
    </div>
</div>

<?php
if ($perm_adm == "S" || $perm_cadastros == "S") {
?>

<?php
include_once("includes/msgs.php");
?>

<div class="row">
<div class="col-md-3">
<?php
$id = $_GET['cliente'];

/* *************************************************
Dados do Cadastro
************************************************* */
$consulta = mysqli_query ($conexao, "SELECT * FROM clientes WHERE id='$id'") or die (mysqli_error());
	$infos = mysqli_fetch_array ($consulta);
		$idUsuario 				= $infos['id'];
		$cnpjUsuario 			= $infos['cnpj'];
		$razaoUsuario 			= $infos['razao'];
		$emailUsuario 			= $infos['email'];
		$senhaUsuario 			= $infos['senha'];
		$criadoUsuario 			= $infos['criado'];
		$atualizadoUsuario 		= $infos['atualizado'];
		$tipoUsuario 			= $infos['tipo'];
		$nomeUsuario 			= $infos['nome'];
		$ramoUsuario 			= $infos['ramo'];
		$inscricaoUsuario 		= $infos['inscricao'];
		$enderecoUsuario 		= $infos['endereco'];
		$numeroUsuario 			= $infos['numero'];
		$bairroUsuario 			= $infos['bairro'];
		$cidadeUsuario 			= $infos['cidade'];
		$ufUsuario 				= $infos['uf'];
		$cepUsuario 			= $infos['cep'];
		$foneUsuario 			= $infos['fone'];
		$faxUsuario 			= $infos['fax'];
		$celularUsuario 		= $infos['celular'];
		$skypeUsuario 			= $infos['skype'];
		$end_cobrancaUsuario 	= $infos['end_cobranca'];
		$end_entregaUsuario 	= $infos['end_entrega'];
		$vendedorUsuario 		= $infos['vendedor'];
		$obsUsuario 			= $infos['obs'];
		
		$socio1Usuario 			= $infos['socio1'];
		$cotas1Usuario 			= $infos['cotas1'];
		$rg1Usuario 			= $infos['rg1'];
		$cpf1Usuario 			= $infos['cpf1'];
		$nasc1Usuario 			= $infos['nasc1'];
		$socio2Usuario 			= $infos['socio2'];
		$cotas2Usuario 			= $infos['cotas2'];
		$rg2Usuario 			= $infos['rg2'];
		$cpf2Usuario 			= $infos['cpf2'];
		$nasc2Usuario 			= $infos['nasc2'];
		
		$empresa1Usuario 		= $infos['empresa1'];
		$fone1Usuario 			= $infos['fone1'];
		$compra1Usuario 		= $infos['compra1'];
		$valor1Usuario 			= $infos['valor1'];
		$email1Usuario 			= $infos['email1'];
		$empresa2Usuario 		= $infos['empresa2'];
		$fone2Usuario 			= $infos['fone2'];
		$compra2Usuario 		= $infos['compra2'];
		$valor2Usuario 			= $infos['valor2'];
		$email2Usuario 			= $infos['email2'];
        $empresa3Usuario 		= $infos['empresa3'];
		$fone3Usuario 			= $infos['fone3'];
		$compra3Usuario 		= $infos['compra3'];
		$valor3Usuario 			= $infos['valor3'];
		$email3Usuario 			= $infos['email3'];
		
		$banco1Usuario 			= $infos['banco1'];
		$conta1Usuario 			= $infos['conta1'];
		$contato1Usuario 		= $infos['contato1'];
		$foneb1Usuario 			= $infos['fone1'];
		
		$bem1Usuario 			= $infos['bem1'];
		$valorb1Usuario 		= $infos['valor1'];
		$ano1Usuario 			= $infos['ano1'];
		$bem2Usuario 			= $infos['bem2'];
		$valorb2Usuario 		= $infos['valor2'];
		$ano2Usuario 			= $infos['ano2'];
        $bem3Usuario 			= $infos['bem3'];
		$valorb3Usuario 		= $infos['valor3'];
		$ano3Usuario 			= $infos['ano3'];
        $bem4Usuario 			= $infos['bem4'];
		$valorb4Usuario 		= $infos['valor4'];
		$ano4Usuario 			= $infos['ano4'];
		
		$permissao_weiku		= $infos['wk'];
		$permissao_insulado		= $infos['insulado'];
		$permissao_moveleiro	= $infos['moveleiro'];
		
		if ($tipoUsuario == 1) { $tipo = "CLIENTE LINDE"; }
		if ($tipoUsuario == 2) { $tipo = "CLIENTE NOVO"; }
		
		if ($end_cobrancaUsuario == '') {
			$end_cobUsuario = "O MESMO";
		}
		else {
			$end_cobUsuario = $end_cobrancaUsuario;
		}

		if ($end_entregaUsuario == '') {
			$end_entUsuario = "O MESMO";
		}
		else {
			$end_entUsuario = $end_entregaUsuario;
		}
		
// Tratamento da DATA
$criadoUsuario = substr($criadoUsuario,8,2) . "/" .substr($criadoUsuario,5,2) . "/" . substr($criadoUsuario,0,4);
?>

<p><img src="../clientes/img/sem_foto.jpg" class="img-responsive img-rounded"></p>

<?php
if ($perm_adm == "S") {
?>

<p><a href="funcoes/cadastros.php?funcao=excluir&id=<?php echo $id; ?>" class="btn btn-danger btn-block" onClick="return confirm('Tem certeza que deseja excluir o cadastro do cliente <?php echo $nomeUsuario; ?>?')"><i class="fas fa-trash-alt"></i> EXCLUIR CADASTRO</a></p>

<?php
if ($senhaUsuario == "") {
?>
<p><a href="#liberarModal" role="button" class="btn btn-success btn-block" data-toggle="modal"><i class="fas fa-lock-open"></i> LIBERAR ACESSO</a></p>
		
<!-- Modal -->
<div class="modal fade" id="liberarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fas fa-lock-open"></i> Liberar Acesso Restrito</h4>
            </div>
            
            <div class="modal-body">
                <form method="post" action="funcoes/cadastros.php?funcao=criar_senha&id=<?php echo $id; ?>" class="form-horizontal">
                    <fieldset>
                    
                        <legend>Criar senha de acesso para <?php echo $nomeUsuario; ?></legend>
                        
                        <?php
                            $passCNPJ = substr($cnpjUsuario, 0, 6);
                            $passNome = substr($nomeUsuario, 0, 2);
                            
                            $passCNPJ = str_replace(".","",$passCNPJ);
                            $passNome = strtolower($passNome);
                            
                            $passwordCliente = $passNome.$passCNPJ;
                        ?>
                        
                        <div class="form-group form-group-sm">
                            <label for="inputSenha" class="col-sm-2 control-label">Senha</label>
                            <div class="col-sm-10">
                                <input type="text" name="senha" class="form-control" id="inputSenha" autocomplete="off" required value="<?php echo $passwordCliente; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group form-group-sm">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Liberar Acesso</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<?php
} else {
?>
<p><a href="#alterarModal" role="button" class="btn btn-primary btn-block" data-toggle="modal"><i class="fas fa-lock-open"></i> ALTERAR SENHA DE ACESSO</a></p>
        
<!-- Modal -->
<div class="modal fade" id="alterarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fas fa-lock-open"></i> Alterar Senha de Acesso</h4>
            </div>
            
            <div class="modal-body">
                <form method="post" action="funcoes/cadastros.php?funcao=alterar_senha&id=<?php echo $id; ?>" class="form-horizontal">
                    <fieldset>
                    
                        <legend>Alterar senha de acesso para <?php echo $nomeUsuario; ?></legend>
                        
                        <div class="form-group form-group-sm">
                            <label for="inputSenha" class="col-sm-2 control-label">Senha</label>
                            <div class="col-sm-10">
                                <input type="text" name="senha" class="form-control" id="inputSenha" required value="<?php echo $senhaUsuario; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group form-group-sm">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Liberar Acesso</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<p><strong>SENHA DE ACESSO:</strong> <?php echo $senhaUsuario; ?></p>
<?php
}
?>

<?php
if ($senhaUsuario != "") {
?>
<hr>

<h2>PERMISSÕES</h2>

<?php
/* ******************
WEIKU
****************** */
if ($permissao_weiku == "N") {
?>
<p><a href="funcoes/cadastros.php?funcao=p_weiku_s&id=<?php echo $id; ?>" class="btn btn-default btn-block"><i class="fa fa-times-circle" aria-hidden="true"></i> Acesso Sistema Weiku</a></p>
<?php
} else if ($permissao_weiku == "S") {
?>
<p><a href="funcoes/cadastros.php?funcao=p_weiku_n&id=<?php echo $id; ?>" class="btn btn-success btn-block"><i class="fa fa-check-circle" aria-hidden="true"></i> Acesso Sistema Weiku</a></p>
<?php
}
?>

<?php
/* ******************
INSULADO
****************** */
if ($permissao_insulado == "N") {
?>
<p><a href="funcoes/cadastros.php?funcao=p_insulado_s&id=<?php echo $id; ?>" class="btn btn-default btn-block"><i class="fa fa-times-circle" aria-hidden="true"></i> Acesso Isulado</a></p>
<?php
} else if ($permissao_insulado == "S") {
?>
<p><a href="funcoes/cadastros.php?funcao=p_insulado_n&id=<?php echo $id; ?>" class="btn btn-success btn-block"><i class="fa fa-check-circle" aria-hidden="true"></i> Acesso Isulado</a></p>
<?php
}
?>

<?php
/* ******************
MOVELEIRO
****************** */
if ($permissao_moveleiro == "N") {
?>
<p><a href="funcoes/cadastros.php?funcao=p_moveleiro_s&id=<?php echo $id; ?>" class="btn btn-default btn-block"><i class="fa fa-times-circle" aria-hidden="true"></i> Acesso Moveleiro</a></p>
<?php
} else if ($permissao_insulado == "S") {
?>
<p><a href="funcoes/cadastros.php?funcao=p_moveleiro_n&id=<?php echo $id; ?>" class="btn btn-success btn-block"><i class="fa fa-check-circle" aria-hidden="true"></i> Acesso Moveleiro</a></p>
<?php
}

}
?>

<?php
}
?>
</div>

<div class="col-md-9">
<div class="well" id="clientes">

<h1><?php echo $nomeUsuario; ?></h1>

<div class="row">
	<div class="col-md-12">
        <p class="lead text-primary"><strong><?php echo $razaoUsuario; ?></strong></p>
    </div>
</div>

<div class="row">
	<div class="col-md-4">
		<p class="text-muted"><small>CRIADO EM: <?php echo $criadoUsuario; ?></small></p>
    </div>
    <div class="col-md-8">
		<?php if ($vendedorUsuario != "") { ?><p class="text-muted"><small>VENDEDOR: <?php echo $vendedorUsuario; ?></small></p><?php } ?>
    </div>
</div>

<div class="row">
	<div class="col-md-3">
    	<p><strong>CNPJ:</strong> <?php echo $cnpjUsuario; ?></p>
    </div>
    <div class="col-md-4">
        <p><strong>INCRIÇÃO ESTADUAL:</strong> <?php if ($inscricaoUsuario != "") { echo $inscricaoUsuario; } ?></p>
    </div>
    <div class="col-md-5">
        <p><strong>RAMO:</strong> <?php if ($ramoUsuario != "") { echo $ramoUsuario; } ?></p>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
    	<p><strong>E-MAIL:</strong> <a href="mailto:<?php echo $emailUsuario; ?>"><?php echo $emailUsuario; ?></a></p>
    </div>
    <div class="col-md-6">
    	<p><strong>SKYPE:</strong> <a href="mailto:<?php echo $skypeUsuario; ?>"><?php echo $skypeUsuario; ?></a></p>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
        <p><strong>ENDEREÇO:</strong> <?php if ($enderecoUsuario != "") { echo $enderecoUsuario; } ?><?php if ($numeroUsuario != "") { echo ", ".$numeroUsuario; } ?> <?php if ($bairroUsuario != "") { echo "- ".$bairroUsuario; } ?> <?php if ($cidadeUsuario != "") { echo "- ".$cidadeUsuario; } ?> <?php if ($ufUsuario != "") { echo "/ ".$ufUsuario; } ?> <?php if ($cepUsuario != "") { echo "- ".$cepUsuario; } ?></p>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
        <p><strong>ENDEREÇO COBRANÇA:</strong> <?php echo $end_cobUsuario; ?></p>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
        <p><strong>ENDEREÇO ENTREGA:</strong> <?php echo $end_entUsuario; ?></p>
    </div>
</div>

<div class="row">
	<div class="col-md-4">
        <p><strong>FONE:</strong> <?php if ($foneUsuario != "") { echo $foneUsuario; } ?></p>
    </div>
    <div class="col-md-4">
        <p><strong>FAX:</strong> <?php if ($faxUsuario != "") { echo $faxUsuario; } ?></p>
    </div>
    <div class="col-md-4">
        <p><strong>CELULAR:</strong> <?php if ($celularUsuario != "") { echo $celularUsuario; } ?></p>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
        <p><strong>OBSERVAÇÕES:</strong> <?php echo $obsUsuario; ?></p>
    </div>
</div>

<hr>

<h2>SÓCIOS</h2>

<?php
/* ********************************************************
SÓCIOS - INÍCIO
******************************************************** */
if ($socio1Usuario == ""  && $socio2Usuario == "") {
?>
<p class="text-muted">Nenhum sócio cadastrado</p>
<?php
}
else {
?>

	<?php
	if ($socio1Usuario != "") {
	?>
        <blockquote>
            <h3><?php echo $socio1Usuario; ?></h3>
            <div class="row">
                <div class="col-md-6"><strong>RG:</strong> <?php if ($rg1Usuario != "") { echo $rg1Usuario; } ?></div>
                <div class="col-md-6"><strong>CPF:</strong> <?php if ($cpf1Usuario != "") { echo $cpf1Usuario; } ?></div>
            </div>
            <div class="row">
                <div class="col-md-6"><strong>DATA NASCIMENTO:</strong> <?php if ($nasc1Usuario != "") { echo $nasc1Usuario; } ?></div>
                <div class="col-md-6"><strong>COTA:</strong> <?php if ($cotas1Usuario != "") { echo $cotas1Usuario."%"; } ?></div>
            </div>
        </blockquote>
	<?php
	}
	?>
    <?php
	if ($socio2Usuario != "") {
	?>
        <blockquote>
            <h3><?php echo $socio2Usuario; ?></h3>
            <div class="row">
                <div class="col-md-6"><strong>RG:</strong> <?php if ($rg2Usuario != "") { echo $rg2Usuario; } ?></div>
                <div class="col-md-6"><strong>CPF:</strong> <?php if ($cpf2Usuario != "") { echo $cpf2Usuario; } ?></div>
            </div>
            <div class="row">
                <div class="col-md-6"><strong>DATA NASCIMENTO:</strong> <?php if ($nasc2Usuario != "") { echo $nasc2Usuario; } ?></div>
                <div class="col-md-6"><strong>COTA:</strong> <?php if ($cotas2Usuario != "") { echo $cotas2Usuario."%"; } ?></div>
            </div>
        </blockquote>
	<?php
	}
	?>
<?php
}
/* ********************************************************
SÓCIOS - FINAL
******************************************************** */
?>

<hr>

<h2>FORNECEDORES</h2>

<?php
/* ********************************************************
FORNECEDORES - INÍCIO
******************************************************** */
if ($empresa1Usuario == ""  && $empresa2Usuario == "" && $empresa3Usuario == "") {
?>
<p class="text-muted">Nenhum fornecedor cadastrado</p>
<?php
}
else {
?>

	<?php
	if ($empresa1Usuario != "") {
	?>
        <blockquote>
            <h3><?php echo $empresa1Usuario; ?></h3>
            <div class="row">
                <div class="col-md-6"><strong>FONE:</strong> <?php if ($fone1Usuario != "") { echo $fone1Usuario; } ?></div>
                <div class="col-md-6"><strong>E-MAIL:</strong> <?php if ($email1Usuario != "") { echo $email1Usuario; } ?></div>
            </div>
            <div class="row">
                <div class="col-md-6"><strong>ÚLTIMA COMPRA:</strong> <?php if ($compra1Usuario != "") { echo $compra1Usuario; } ?></div>
                <div class="col-md-6"><strong>VALOR:</strong> <?php if ($valor1Usuario != "") { echo "R$ ".$valor1Usuario; } ?></div>
            </div>
        </blockquote>
	<?php
	}
	?>
    <?php
	if ($empresa2Usuario != "") {
	?>
        <blockquote>
            <h3><?php echo $empresa2Usuario; ?></h3>
            <div class="row">
                <div class="col-md-6"><strong>FONE:</strong> <?php if ($fone2Usuario != "") { echo $fone2Usuario; } ?></div>
                <div class="col-md-6"><strong>E-MAIL:</strong> <?php if ($email2Usuario != "") { echo $email2Usuario; } ?></div>
            </div>
            <div class="row">
                <div class="col-md-6"><strong>ÚLTIMA COMPRA:</strong> <?php if ($compra2Usuario != "") { echo $compra2Usuario; } ?></div>
                <div class="col-md-6"><strong>VALOR:</strong> <?php if ($valor2Usuario != "") { echo "R$ ".$valor2Usuario; } ?></div>
            </div>
        </blockquote>
	<?php
	}
	?>
    <?php
	if ($empresa3Usuario != "") {
	?>
        <blockquote>
            <h3><?php echo $empresa3Usuario; ?></h3>
            <div class="row">
                <div class="col-md-6"><strong>FONE:</strong> <?php if ($fone3Usuario != "") { echo $fone3Usuario; } ?></div>
                <div class="col-md-6"><strong>E-MAIL:</strong> <?php if ($email3Usuario != "") { echo $email3Usuario; } ?></div>
            </div>
            <div class="row">
                <div class="col-md-6"><strong>ÚLTIMA COMPRA:</strong> <?php if ($compra3Usuario != "") { echo $compra3Usuario; } ?></div>
                <div class="col-md-6"><strong>VALOR:</strong> <?php if ($valor3Usuario != "") { echo "R$ ".$valor3Usuario; } ?></div>
            </div>
        </blockquote>
	<?php
	}
	?>
<?php
}
/* ********************************************************
FORNECEDORES - FINAL
******************************************************** */
?>

<hr>

<h2>REFERÊNCIA BANCÁRIA</h2>

<?php
/* ********************************************************
BANCO - INÍCIO
******************************************************** */
if ($banco1Usuario == "") {
?>
<p class="text-muted">Nenhum banco cadastrado</p>
<?php
}
else {
?>

	<?php
	if ($banco1Usuario != "") {
	?>
        <blockquote>
            <h3><?php echo $banco1Usuario; ?></h3>
            <div class="row">
                <div class="col-md-4"><strong>CONTA:</strong> <?php if ($conta1Usuario != "") { echo $conta1Usuario; } ?></div>
                <div class="col-md-4"><strong>CONTATO:</strong> <?php if ($contato1Usuario != "") { echo $contato1Usuario; } ?></div>
                <div class="col-md-4"><strong>FONE:</strong> <?php if ($foneb1Usuario != "") { echo $foneb1Usuario; } ?></div>
            </div>
        </blockquote>
	<?php
	}
	?>
<?php
}
/* ********************************************************
BANCO - FINAL
******************************************************** */
?>

<hr>

<h2>BENS</h2>

<?php
/* ********************************************************
BENS - INÍCIO
******************************************************** */
if ($bem1Usuario == "" && $bem2Usuario == "" && $bem3Usuario == "" && $bem4Usuario == "") {
?>
<p class="text-muted">Nenhum bem cadastrado</p>
<?php
}
else {
?>

	<?php
	if ($bem1Usuario != "") {
	?>
        <blockquote>
            <h3><?php echo $bem1Usuario; ?></h3>
            <div class="row">
                <div class="col-md-6"><strong>VALOR:</strong> <?php if ($valorb1Usuario != "") { echo "R$ ".$valorb1Usuario; } ?></div>
                <div class="col-md-6"><strong>ANO:</strong> <?php if ($ano1Usuario != "") { echo $ano1Usuario; } ?></div>
            </div>
        </blockquote>
	<?php
	}
	?>
    <?php
	if ($bem2Usuario != "") {
	?>
        <blockquote>
            <h3><?php echo $bem2Usuario; ?></h3>
            <div class="row">
                <div class="col-md-6"><strong>VALOR:</strong> <?php if ($valorb2Usuario != "") { echo "R$ ".$valorb2Usuario; } ?></div>
                <div class="col-md-6"><strong>ANO:</strong> <?php if ($ano2Usuario != "") { echo $ano2Usuario; } ?></div>
            </div>
        </blockquote>
	<?php
	}
	?>
    <?php
	if ($bem3Usuario != "") {
	?>
        <blockquote>
            <h3><?php echo $bem3Usuario; ?></h3>
            <div class="row">
                <div class="col-md-6"><strong>VALOR:</strong> <?php if ($valorb3Usuario != "") { echo "R$ ".$valorb3Usuario; } ?></div>
                <div class="col-md-6"><strong>ANO:</strong> <?php if ($ano3Usuario != "") { echo $ano3Usuario; } ?></div>
            </div>
        </blockquote>
	<?php
	}
	?>
    <?php
	if ($bem4Usuario != "") {
	?>
        <blockquote>
            <h3><?php echo $bem4Usuario; ?></h3>
            <div class="row">
                <div class="col-md-6"><strong>VALOR:</strong> <?php if ($valorb4Usuario != "") { echo "R$ ".$valorb4Usuario; } ?></div>
                <div class="col-md-6"><strong>ANO:</strong> <?php if ($ano4Usuario != "") { echo $ano4Usuario; } ?></div>
            </div>
        </blockquote>
	<?php
	}
	?>
<?php
}
/* ********************************************************
BENS - FINAL
******************************************************** */
?>
</div> <!-- well -->
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
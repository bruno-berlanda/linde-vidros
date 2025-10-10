<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_clientes.php");
include_once ("includes/usuario_logado.php");
include_once ("includes/cabecalho.php");
?>

<body>

<?php include_once ("includes/menu_topo.php"); ?>

<div class="container-fluid" id="conteudo">

<div class="row" id="titulo">
	<div class="col-md-12">
    	<h1>Meus Dados</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
		include_once("includes/msgs.php");
		?>

		<div class="well" id="clientes">

            <h2><?php echo $nomeUsuario; ?></h2>
            
            <div class="row">
                <div class="col-md-12">
                    <p class="text-info"><?php echo $razaoUsuario; ?></p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <p class="text-muted"><small>CADASTRADO EM: <?php echo $criadoUsuario; ?></small></p>
                </div>
                <div class="col-md-8">
                    <p class="text-muted"><small>VENDEDOR: <?php echo $vendedorUsuario ?? ''; ?></small></p>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle fa-lg"></i>
                    Nenhum sócio cadastrado
                    </div>
                </div>
            </div>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle fa-lg"></i>
                    Nenhum fornecedor cadastrado
                    </div>
                </div>
            </div>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle fa-lg"></i>
                    Nenhum banco cadastrado
                    </div>
                </div>
            </div>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle fa-lg"></i>
                    Nenhum bem cadastrado
                    </div>
                </div>
            </div>
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

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts_bootstrap.php"); ?>

</body>

</html>
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
    	<h1>Procedimento de Entrega</h1>
    </div>
</div>

<?php
if ($wkUsuario == "S") {
?>

<div class="row">
    <div class="col-md-12">
        
        <ol class="breadcrumb">
        	<li><a href="index.php">Início</a></li>
            <li><a href="pedidos.php">Pedidos</a></li>
        	<li class="active">Procedimento de Entrega</li>
        </ol>
		
		<?php
		include_once("includes/msgs.php");
		?>

	</div>
</div>

<?php
$id = $_GET['p'];

$consulta_pedido = mysqli_query ($conexao, "SELECT * FROM vendas_weiku WHERE id_pedido_weiku='$id'") or die (mysqli_error());
	$dados_pedido = mysqli_fetch_array ($consulta_pedido);
		$data_pedido 		= $dados_pedido['data_pedido'];
		$empresa 			= $dados_pedido['empresa_weiku'];
		$nome_cliente 		= $dados_pedido['nome_cliente_weiku'];
		$cidade 			= $dados_pedido['cidade_weiku'];
		$rota 				= $dados_pedido['rota_weiku'];
		$peso 				= $dados_pedido['peso_weiku'];
		$nf 				= $dados_pedido['numero_nota_weiku'];
		$valor 				= $dados_pedido['valor_weiku'];
		$vencimento 		= $dados_pedido['vencimento'];
		$ofs 				= $dados_pedido['of_weiku'];
		$at 				= $dados_pedido['at_weiku'];
		
		$qtde_tem			= $dados_pedido['quant_temperado'];
		$qtde_com			= $dados_pedido['quant_comum'];
		$qtde_ins			= $dados_pedido['quant_insulado'];
		
		$previsionamento 	= $dados_pedido['previsionamento'];
		$alteracao_data 	= $dados_pedido['alteracao_data'];
		
		$obs 				= $dados_pedido['observacoes_weiku'];
		$obs_trans 			= $dados_pedido['observacoes_transporte'];
		$obs_vendas 		= $dados_pedido['observacoes_vendas'];
		
		$situacao_weiku 	= $dados_pedido['situacao_weiku'];
		$situacao 			= $dados_pedido['situacao'];
		
		$data_cad_weiku 	= $dados_pedido['data_cad_weiku'];
		$edicao_ven 		= $dados_pedido['data_edit_vendas_weiku'];
		$edicao_fat			= $dados_pedido['data_edit_faturamento_weiku'];
		$edicao_tra			= $dados_pedido['data_edit_transporte_weiku'];
		
		$usuario_ven 		= $dados_pedido['usuario_edit_vendas_weiku'];
		$usuario_fat		= $dados_pedido['usuario_edit_faturamento_weiku'];
		$usuario_tra 		= $dados_pedido['usuario_edit_transporte_weiku'];
		
		$edicao_weiku 		= $dados_pedido['data_edit_weiku'];
		
		/* ***************************** */
		
		$n_id = str_pad($id, 5, "0", STR_PAD_LEFT);
	
		$data_pedido 		= date('d/m/Y', strtotime($data_pedido));
		$xprevisionamento 	= date('d/m/Y', strtotime($previsionamento));
		$xalteracao_data 	= date('d/m/Y', strtotime($alteracao_data));
		
		$xedicao_ven 		= date('d/m/Y', strtotime($edicao_ven));
		$xedicao_fat 		= date('d/m/Y', strtotime($edicao_fat));
		$xedicao_tra 		= date('d/m/Y', strtotime($edicao_tra));
		
		$xedicao_weiku 		= date('d/m/Y', strtotime($edicao_weiku));
		
		if ($vencimento != null) { $vencimento 	= date('d/m/Y', strtotime($vencimento)); } else { $vencimento = ""; }
		
		// Nome Empresa
		if ($empresa == "1290" ) { $nome_empresa = "WEIKU DO BRASIL"; }
		else if ($empresa == "3804" ) { $nome_empresa = "CLIMAGLASS"; }
		
		// Valor
		if ($vencimento != null) { $valor = number_format($valor, 2, ',', '.'); } else { $valor = ""; }
		
		// Quantidade de Peças
		$qtde_total = $qtde_tem + $qtde_com + $qtde_ins;

// Procedimento
$consulta_procedimento = mysqli_query ($conexao, "SELECT * FROM vendas_weiku_procedimentos WHERE id_pedido='$id'") or die (mysqli_error());
	$dados_procedimento = mysqli_fetch_array ($consulta_procedimento);
		$p_id				= $dados_procedimento['id'];
		$p_data				= $dados_procedimento['data'];
		$p_cliente 			= $dados_procedimento['cliente'];
		$p_cidade 			= $dados_procedimento['cidade'];
		$p_uf 				= $dados_procedimento['uf'];
		$p_endereco 		= $dados_procedimento['endereco'];
		$p_numero 			= $dados_procedimento['numero'];
		$p_bairro 			= $dados_procedimento['bairro'];
		$p_referencia 		= $dados_procedimento['referencia'];
		$p_local_apto 		= $dados_procedimento['local_apto'];
		$p_obs 				= $dados_procedimento['obs'];
		
		$p_nome1 			= $dados_procedimento['nome_contato1'];
		$p_fone1c1 			= $dados_procedimento['fone1_contato1'];
		$p_fone2c1 			= $dados_procedimento['fone2_contato1'];
		$p_nome2 			= $dados_procedimento['nome_contato2'];
		$p_fone1c2 			= $dados_procedimento['fone1_contato2'];
		$p_fone2c2 			= $dados_procedimento['fone2_contato2'];
		$p_contato_antes	= $dados_procedimento['contato_antes'];
		$p_horario_entrega	= $dados_procedimento['horario_entrega'];
		
		$p_nf				= $dados_procedimento['nf'];
		$p_nf_serie			= $dados_procedimento['nf_serie'];
		$p_nf_data			= $dados_procedimento['nf_data'];
		
		$p_mapa				= $dados_procedimento['mapa'];
		
		$p_atualizado		= $dados_procedimento['atualizado'];
		
		/* ******* */
		$p_data 			= date('d/m/Y', strtotime($p_data));
		$p_atualizado		= date('d/m/Y', strtotime($p_atualizado));
?>

<div class="row">
	<div class="col-md-5">
    	<h1><?php echo $ofs; ?></h1>        
       
        <br>
        
        <form method="post" action="funcoes/weiku.php?funcao=procedimento&p=<?php echo $id; ?>">
            
            <fieldset<?php if ($situacao_weiku == "Entregue") { echo " disabled"; } ?>>
            
            <legend>Procedimento de Entrega</legend>
            
            <h2>Endereço de Entrega</h2>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group form-group-sm">
                        <label for="inputCliente">Cliente</label>
                        <input type="text" name="cliente" class="form-control" id="inputCliente" required autocomplete="off" autofocus value="<?php echo $p_cliente; ?>">
                    </div>
            	</div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group form-group-sm">
                        <label for="inputCidade">Cidade</label>
                        <input type="text" name="cidade" class="form-control" id="inputCidade" required autocomplete="off" value="<?php echo $p_cidade; ?>">
                    </div>
            	</div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group form-group-sm">
                        <label for="selectUf">UF</label>
                            <select name="uf" id="selectUf" class="form-control" required>
                                <option value=""<?php if ($p_uf == "") { echo " selected"; } ?>></option>
                                <option value="AC"<?php if ($p_uf == "AC") { echo " selected"; } ?>>AC</option>
                                <option value="AL"<?php if ($p_uf == "AL") { echo " selected"; } ?>>AL</option>
                                <option value="AM"<?php if ($p_uf == "AM") { echo " selected"; } ?>>AM</option>
                                <option value="AP"<?php if ($p_uf == "AP") { echo " selected"; } ?>>AP</option>
                                <option value="BA"<?php if ($p_uf == "BA") { echo " selected"; } ?>>BA</option>
                                <option value="CE"<?php if ($p_uf == "CE") { echo " selected"; } ?>>CE</option>
                                <option value="DF"<?php if ($p_uf == "DF") { echo " selected"; } ?>>DF</option>
                                <option value="ES"<?php if ($p_uf == "ES") { echo " selected"; } ?>>ES</option>
                                <option value="GO"<?php if ($p_uf == "GO") { echo " selected"; } ?>>GO</option>
                                <option value="MA"<?php if ($p_uf == "MA") { echo " selected"; } ?>>MA</option>
                                <option value="MG"<?php if ($p_uf == "MG") { echo " selected"; } ?>>MG</option>
                                <option value="MS"<?php if ($p_uf == "MS") { echo " selected"; } ?>>MS</option>
                                <option value="MT"<?php if ($p_uf == "MT") { echo " selected"; } ?>>MT</option>
                                <option value="PA"<?php if ($p_uf == "PA") { echo " selected"; } ?>>PA</option>
                                <option value="PB"<?php if ($p_uf == "PB") { echo " selected"; } ?>>PB</option>
                                <option value="PE"<?php if ($p_uf == "PE") { echo " selected"; } ?>>PE</option>
                                <option value="PI"<?php if ($p_uf == "PI") { echo " selected"; } ?>>PI</option>
                                <option value="PR"<?php if ($p_uf == "PR") { echo " selected"; } ?>>PR</option>
                                <option value="RJ"<?php if ($p_uf == "RJ") { echo " selected"; } ?>>RJ</option>
                                <option value="RN"<?php if ($p_uf == "RN") { echo " selected"; } ?>>RN</option>
                                <option value="RO"<?php if ($p_uf == "RO") { echo " selected"; } ?>>RO</option>
                                <option value="RR"<?php if ($p_uf == "RR") { echo " selected"; } ?>>RR</option>
                                <option value="RS"<?php if ($p_uf == "RS") { echo " selected"; } ?>>RS</option>
                                <option value="SC"<?php if ($p_uf == "SC") { echo " selected"; } ?>>SC</option>
                                <option value="SE"<?php if ($p_uf == "SE") { echo " selected"; } ?>>SE</option>
                                <option value="SP"<?php if ($p_uf == "SP") { echo " selected"; } ?>>SP</option>
                                <option value="TO"<?php if ($p_uf == "TO") { echo " selected"; } ?>>TO</option>
                            </select>
                    </div>
            	</div>
			</div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group form-group-sm">
                        <label for="inputEndereco">Endereço</label>
                        <input type="text" name="endereco" class="form-control" id="inputEndereco" required autocomplete="off" value="<?php echo $p_endereco; ?>">
                    </div>
            	</div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group form-group-sm">
                        <label for="inputNumero">Número</label>
                            <input type="text" name="numero" class="form-control" id="inputNumero" required autocomplete="off" maxlength="5" value="<?php echo $p_numero; ?>">
                    </div>
            	</div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group form-group-sm">
                        <label for="inputBairro">Bairro</label>
                        <input type="text" name="bairro" class="form-control" id="inputBairro" required autocomplete="off" value="<?php echo $p_bairro; ?>">
                    </div>
            	</div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group form-group-sm">
                        <label for="inputReferencia">Referência</label>
                        <input type="text" name="referencia" class="form-control" id="inputReferencia" required autocomplete="off" value="<?php echo $p_referencia; ?>">
                    </div>
            	</div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group form-group-sm">
                        <label for="inputLocal">Local</label>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="local_apto" id="inputLocal" value="S"<?php if ($p_local_apto == "S") { echo " checked"; } ?>> O local é apto e em boas condições para receber o material
                            </label>
                        </div>
                    </div>
            	</div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group form-group-sm">
                        <label for="textObs">Observações</label>
                        <textarea name="obs" class="form-control" id="textObs" rows="5"><?php echo $p_obs; ?></textarea>
                    </div>
            	</div>
            </div>
            
            <hr>
            
            <h2>Contato para Recebimento</h2>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group form-group-sm">
                        <label for="inputContato1">Nome Contato 1</label>
                        <input type="text" name="contato1" class="form-control" id="inputContato1" required autocomplete="off" value="<?php echo $p_nome1; ?>">
                    </div>
            	</div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                	<div class="form-group form-group-sm">
                        <label for="inputF1C1">Fone 1</label>
                        <input type="text" name="fone1c1" class="form-control" id="inputF1C1" required autocomplete="off" value="<?php echo $p_fone1c1; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                	<div class="form-group form-group-sm">
                        <label for="inputF2C1">Fone 2</label>
                        <input type="text" name="fone2c1" class="form-control" id="inputF2C1" autocomplete="off" value="<?php echo $p_fone2c1; ?>">
                    </div>
                </div>
			</div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group form-group-sm">
                        <label for="inputContato2">Nome Contato 2</label>
                        <input type="text" name="contato2" class="form-control" id="inputContato2" autocomplete="off" value="<?php echo $p_nome2; ?>">
                    </div>
            	</div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                	<div class="form-group form-group-sm">
                        <label for="inputF1C2">Fone 1</label>
                        <input type="text" name="fone1c2" class="form-control" id="inputF1C2" autocomplete="off" value="<?php echo $p_fone1c2; ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                	<div class="form-group form-group-sm">
                        <label for="inputF2C2">Fone 2</label>
                        <input type="text" name="fone2c2" class="form-control" id="inputF2C2" autocomplete="off" value="<?php echo $p_fone2c2; ?>">
                    </div>
                </div>
			</div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group form-group-sm">
                        <label for="inputContato">Contato</label>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="contato_antes" id="inputContato" value="S"<?php if ($p_contato_antes == "S") { echo " checked"; } ?>> Entrar em contato com antecedência
                            </label>
                        </div>
                    </div>
            	</div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group form-group-sm">
                        <label for="inputHorario">Horário Específico</label>
                        <input type="time" name="horario" class="form-control" id="inputHorario" value="<?php echo $p_horario_entrega; ?>">
                    </div>
            	</div>
            </div>
            
            <hr>
            
            <h2>Dados Nota Fiscal</h2>
            
            <div class="row">
                <div class="col-sm-4">
                	<div class="form-group form-group-sm">
                        <label for="inputNF">NF</label>
                        <input type="text" name="nf" class="form-control" id="inputNF" autocomplete="off" value="<?php echo $p_nf; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                	<div class="form-group form-group-sm">
                        <label for="inputNFSerie">Série</label>
                        <input type="text" name="nf_serie" class="form-control" id="inputNFSerie" autocomplete="off" value="<?php echo $p_nf_serie; ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                	<div class="form-group form-group-sm">
                        <label for="inputNFData">Data</label>
                        <input type="date" name="nf_data" class="form-control" id="inputNFData" autocomplete="off" value="<?php echo $p_nf_data; ?>">
                    </div>
                </div>
			</div>
            
            <hr>
            
            <h2>Mapa</h2>
            
            <p class="text-muted">Para melhor entendimento do endereço de entrega, você pode enviar o mapa do endereço via Google Maps.</p>
            
            <p><a href="#dicamapa" role="button" class="btn btn-xs btn-outline-info" data-toggle="modal"><i class="far fa-question-circle"></i> Como posso fazer isso?</a></p>
            
            <!-- Modal -->
            <div class="modal fade" id="dicamapa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h2 class="modal-title" id="myModalLabel"><i class="far fa-question-circle"></i> Como posso fazer isso?</h2>
                        </div>
                        
                        <div class="modal-body">
                            
                            <ol>
                            	<li>Acesse o site do <a href="https://www.google.com.br/maps?hl=pt-BR" target="_blank">Google Maps</a></li>
                                <li>Localize o endereço desejado</li>
                                <li>Acesse o <strong>MENU</strong> no lado esquerdo <button class="btn btn-xs btn-default disabled"><i class="fas fa-bars"></i></button></li>
                                <li>Selecione a opção <strong><i class="fas fa-link"></i> Compartilhar ou incorporar mapa</strong></li>
                                <li>Selecione a opção <strong>Incorporar mapa</strong></li>
                                <li>Copie o endereço que aparece na janela aberta, e cole no campo do formulário</li>
                            </ol>
                            
                            <p class="text-danger">O código copiado é parecido com esse</p>
                            
                            <div class="well">
                            	<code>
                                &lt;iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d865.3834619729167!2d-49.7672170083388!3d-26.078103510995145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1spt-BR!2sbr!4v1470160825933" width="600" height="450" frameborder="0" style="border:0" allowfullscreen>&lt;/iframe&gt;
                                </code>
                            </div>
                    
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            
            <div class="row">
                <div class="col-sm-12">
                	<div class="form-group form-group-sm">
                        <label for="textMapa">Incorporar Mapa</label>
                        <textarea name="mapa" class="form-control" id="textMapa" autocomplete="off" rows="7"><?php echo $p_mapa; ?></textarea>
                    </div>
                </div>
			</div>
            
            <hr>
			
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar Procedimento</button>
            
            </fieldset>
            
        </form>
    </div>
    
    <div class="col-md-7">
        <h2>Dados Comerciais</h2>
        
        <br>
        
        <div class="table-responsive">
        <table class="table table-striped">
        	<tbody>
            	<tr>
                	<td class="text-muted" width="60%">DATA DE ENTRADA DO PEDIDO</td>
                    <td><?php echo $data_pedido; ?></td>
                </tr>
                <tr>
                	<td class="text-muted">EMPRESA</td>
                    <td><?php echo $nome_empresa; ?></td>
                </tr>
                <tr>
                	<td class="text-muted">NOME DO CLIENTE</td>
                    <td><?php echo $nome_cliente; ?></td>
                </tr>
                <tr>
                	<td class="text-muted">CIDADE</td>
                    <td><?php echo $cidade; ?></td>
                </tr>
                <tr>
                	<td class="text-muted">ROTA</td>
                    <td><?php echo $rota; ?></td>
                </tr>
                <tr>
                	<td class="text-muted">PESO (KG)</td>
                    <td><?php echo $peso; ?></td>
                </tr>
                <tr>
                	<td class="text-muted">AT</td>
                    <td><?php echo $at; ?></td>
                </tr>
            </tbody>
        </table>
        </div>
        
		<?php if ($obs_vendas != "") { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle fa-lg"></i>
                <?php echo $obs_vendas; ?>
                </div>
            </div>
        </div>
        <?php } ?>
        
        <h2>Quantidade de Peças</h2>
        
        <div class="table-responsive">
        <table class="table table-striped">
        	<tbody>
            	<tr>
                	<td class="text-muted">TEMPERADO</td>
                    <td><?php echo $qtde_tem; ?></td>
                </tr>
                <tr>
                	<td class="text-muted">COMUM</td>
                    <td><?php echo $qtde_com; ?></td>
                </tr>
                <tr>
                	<td class="text-muted">INSULADO</td>
                    <td><?php echo $qtde_ins; ?></td>
                </tr>
                <tr>
                	<td class="text-muted"><strong>TOTAL</strong></td>
                    <td><strong><?php echo $qtde_total; ?></strong></td>
                </tr>
        	</tbody>
        </table>
        </div>
        
        <div class="well" id="well-site">
        	<div class="row">
            	<div class="col-xs-6">
                	<p class="text-center text-muted"><i class="fas fa-calendar-alt fa-lg"></i></p>
                    <p class="text-center"><small><?php if ($edicao_ven != null) { echo $xedicao_ven; } else { echo "---"; } ?></small></p>
                </div>
                <div class="col-xs-6">
                	<p class="text-center text-muted"><i class="fas fa-user fa-lg"></i></p>
                    <p class="text-center"><small><?php if ($usuario_ven != null) { echo $usuario_ven; } else { echo "---"; } ?></small></p>
                </div>
            </div>
        </div>
        
        <hr>
        
        <h2>Dados Transporte</h2>
        
        <br>
        
        <div class="table-responsive">
        <table class="table table-striped">
        	<tbody>
            	<tr>
                	<td class="text-muted" width="60%">PREVISÃO DE ENTREGA</td>
                    <td><?php if ($previsionamento != null) { echo $xprevisionamento; } ?></td>
                </tr>
                <tr>
                	<td class="text-muted">ALTERAÇÃO (PRÓXIMA DATA)</td>
                    <td><?php if ($alteracao_data != null) { echo "<strong>".$xalteracao_data."</strong>"; } ?></td>
                </tr>
            </tbody>
        </table>
        </div>
		
        <?php if ($obs_trans != "") { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle fa-lg"></i>
                <?php echo $obs_trans; ?>
                </div>
            </div>
        </div>
        <?php } ?>
        
        <div class="well" id="well-site">
        	<div class="row">
            	<div class="col-xs-6">
                	<p class="text-center text-muted"><i class="fas fa-calendar-alt fa-lg"></i></p>
                    <p class="text-center"><small><?php if ($edicao_tra != null) { echo $xedicao_tra; } else { echo "---"; } ?></small></p>
                </div>
                <div class="col-xs-6">
                	<p class="text-center text-muted"><i class="fas fa-user fa-lg"></i></p>
                    <p class="text-center"><small><?php if ($usuario_tra != null) { echo $usuario_tra; } else { echo "---"; } ?></small></p>
                </div>
            </div>
        </div>
        
        <hr>
        
        <h2>Dados Faturamento</h2>
        
        <br>
        
        <div class="table-responsive">
        <table class="table table-striped">
        	<tbody>
            	<tr>
                	<td class="text-muted" width="60%">NOTA FISCAL</td>
                    <td><?php if ($nf != null) { echo $nf; } ?></td>
                </tr>
                <tr>
                	<td class="text-muted">VALOR</td>
                    <td><?php if ($valor != null) { echo "R$ ".$valor; } ?></td>
                </tr>
                <tr>
                	<td class="text-muted">VENCIMENTO</td>
                    <td><?php if ($vencimento != null) { echo $vencimento; } ?></td>
                </tr>
            </tbody>
        </table>
        </div>
        
        <div class="well" id="well-site">
        	<div class="row">
            	<div class="col-xs-6">
                	<p class="text-center text-muted"><i class="fas fa-calendar-alt fa-lg"></i></p>
                    <p class="text-center"><small><?php if ($edicao_fat != null) { echo $xedicao_fat; } else { echo "---"; } ?></small></p>
                </div>
                <div class="col-xs-6">
                	<p class="text-center text-muted"><i class="fas fa-user fa-lg"></i></p>
                    <p class="text-center"><small><?php if ($usuario_fat != null) { echo $usuario_fat; } else { echo "---"; } ?></small></p>
                </div>
            </div>
        </div>
        
    </div>
</div>

<?php
}
else {
?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
		<i class="fas fa-exclamation-triangle fa-lg"></i>
		Você não tem permissão para acessar essa página. Para maiores informações entre em contato com o responsável pelo sistema na Linde Vidros.
		</div>
	</div>
</div>
<?php
}
?>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts_bootstrap.php"); ?>

</body>

</html>
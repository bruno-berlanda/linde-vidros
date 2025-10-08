<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT contato AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Contato - Linde Vidros";

$description = "Entre em contato conosco, será um prazer atendê-lo, você pode entrar em contato via telefone, fax, e-mail ou por um formulário de contato. Encontre a Linde Vidros também nas redes sociais" . $tg;
$keywords = "fale com a linde vidros, contato linde vidros, telefone linde vidros, endereço linde vidros, e-mail linde vidros";

$og_url = "http://www.lindevidros.com.br/contato";
$og_name = "Contato";

$submenu_id = "CONTATO";

require_once ("includes/links.php");
?>

<?php include_once ("includes/cabecalho.php"); ?>

<body>

<?php include_once ("includes/analyticstracking.php"); // Google Analytics ?>

<?php include_once ("includes/topo.php"); ?>

<?php include_once ("includes/menu.php"); ?>

<?php //include_once ("includes/logo.php"); ?>

<div class="container-fluid">
	<div class="row" id="titulo">
    	<div class="col-md-12">
        	<div class="container">
            	<div class="row">
                    <div class="col-md-12">
                    	<h1>Contato</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row" id="conteudo">
        <div class="col-md-12">
        <div class="well" id="well-blue">
        	<div class="row">
                <div class="col-md-6 col-xs-6">
                    <p class="text-muted text-center"><small><i class="fas fa-phone"></i> TELEFONE</small></p>
                    <p class="lead text-center"><a href="https://api.whatsapp.com/send?phone=554736414444">47 3641 4444</a></p>
                </div>
                <div class="col-md-6 col-xs-6">
                    <p class="text-muted text-center"><small><i class="fas fa-envelope"></i> E-MAIL</small></p>
                     <p class="lead text-center"><a href="mailto:linde@lindevidros.com.br">linde@lindevidros.com.br</a></p>
                </div>
        	</div>
        </div>
        </div>
    </div>
    
    <div class="row" id="conteudo">
    	<div class="col-md-6">
        	<!--<h2>Escreva-nos</h2>-->
    
			<?php /* ***************************************************************************************************************************************** */ ?>
            <?php if (isset($_GET['msgSucesso'])) { $msg = $_GET['msgSucesso']; ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="fas fa-check-circle fa-lg"></i>
                        <?php echo $msg; ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if (isset($_GET['msgErro'])) { $msg = $_GET['msgErro']; ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="fas fa-times-circle fa-lg"></i>
                        <?php echo $msg; ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if (isset($_GET['msgInfo'])) { $msg = $_GET['msgInfo']; ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="fas fa-info-circle fa-lg"></i>
                        <?php echo $msg; ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if (isset($_GET['msgAlerta'])) { $msg = $_GET['msgAlerta']; ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="fas fa-exclamation-triangle fa-lg"></i>
                        <?php echo $msg; ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php /* ***************************************************************************************************************************************** */ ?>
             
            <!--
            <form method="post" action="funcoes/contato.php" class="form-horizontal">
                <div class="form-group">
                    <label for="selectTipo" class="col-sm-3 control-label">Tipo Mensagem</label>
                    <div class="col-sm-5">
                        <select name="tipo" id="selectTipo" class="form-control" required>
                            <option value=""></option>
                            <option value="1">Reclamação</option>
                            <option value="2">Crítica</option>
                            <option value="3">Sugestão</option>
                            <option value="4">Dúvida</option>
                            <option value="5">Comentário</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="selectAssunto" class="col-sm-3 control-label">Assunto</label>
                    <div class="col-sm-5">
                        <select name="assunto" id="selectAssunto" class="form-control" required>
                            <option value=""></option>
                            <option value="1">A Linde Vidros</option>
                            <option value="2">Nosso site</option>
                            <option value="3">Atendimento</option>
                            <option value="4">Produtos</option>
                            <option value="5">Engenharia</option>
                            <option value="6">Moveleiro</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputNome" class="col-sm-3 control-label">Nome</label>
                    <div class="col-sm-9">
                        <input type="text" name="nome" id="inputNome" class="form-control" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCidade" class="col-sm-3 control-label">Cidade</label>
                    <div class="col-sm-9">
                        <input type="text" name="cidade" id="inputCidade" class="form-control" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="selectUf" class="col-sm-3 control-label">Estado</label>
                    <div class="col-sm-3">
                        <select name="uf" id="selectUf" class="form-control" required>
                            <option value=""></option>
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AM">AM</option>
                            <option value="AP">AP</option>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="DF">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MG">MG</option>
                            <option value="MS">MS</option>
                            <option value="MT">MT</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="PR">PR</option>
                            <option value="RJ">RJ</option>
                            <option value="RN">RN</option>
                            <option value="RO">RO</option>
                            <option value="RR">RR</option>
                            <option value="RS">RS</option>
                            <option value="SC">SC</option>
                            <option value="SE">SE</option>
                            <option value="SP">SP</option>
                            <option value="TO">TO</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">E-mail</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" id="inputEmail" class="form-control" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputTelefoneTodos" class="col-sm-3 control-label">Telefone</label>
                    <div class="col-sm-5">
                        <input type="text" name="telefone" id="inputTelefoneTodos" class="form-control" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="textMensagem" class="col-sm-3 control-label">Mensagem</label>
                    <div class="col-sm-9">
                        <textarea name="mensagem" id="textMensagem" class="form-control" rows="12" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="radioResposta" class="col-sm-3 control-label">Como deseja receber o retorno dessa mensagem?</label>
                    <div class="col-sm-9">
                        <div class="radio">
                            <label>
                                <input type="radio" name="resposta" id="radioResposta" value="1" checked> Via e-mail
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="resposta" id="radioResposta" value="2"> Via telefone
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="resposta" id="radioResposta" value="3"> Não quero receber resposta
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                        <div class="g-recaptcha" data-sitekey="6LebcucSAAAAAJy_aqVNc5zV8NVV3fz7cbqDxHnW"></div>
                        <span class="help-block">Marque a opção "Não sou um robô"</span>
                    </div>
                </div>
            
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
                    </div>
                </div>
            </form>
        -->
            <h2>Endereço</h2>
        
            <address>
                <p>
                Avenida General Luiz Carlos Pereira Tourinho, 4197 <br>
                Tijuco Preto <br>
                Paralela a BR 116 <br>
                Rio Negro - PR <br>
                CEP 83885-302
                </p>
            </address>
        </div>
        <div class="col-md-6">            
			<h2>Trabalhe Conosco</h2>
            
            <?php include_once ("includes/trabalhe.php"); // Trabalhe Conosco ?>
            </div>
        </div>
    </div>
</div>

<?php include_once ("includes/mapa.php"); ?>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
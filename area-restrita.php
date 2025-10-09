<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT area_restrita AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error($conexao));
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Área Restrita - Linde Vidros";

$description = "Para os clientes Linde Vidros, disponibilizamos uma área dedicada com diversos materiais de apoio" . $tg;
$keywords = "área restrita linde vidros, área cliente linde vidros";

$og_url = "https://www.lindevidros.com.br/area-restrita";
$og_name = "Área Restrita";

$submenu_id = "AREA";

require_once ("includes/links.php");
?>

<?php include_once ("includes/cabecalho.php"); ?>

<body>

<?php include_once ("includes/analyticstracking.php"); // Google Analytics ?>

<?php include_once ("includes/topo.php"); ?>

<?php include_once ("includes/menu.php"); ?>

<?php //include_once ("includes/logo.php"); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 bg-light py-4 border-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-azul-linde">Área Restrita</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <?php /* ****************************************************************************************************************************************************************** */ ?>
	<?php if (isset($_GET['msgSucesso'])) { $msg = $_GET['msgSucesso']; ?>
    <div class="row my-4">
        <div class="col-12">
            <div class="alert alert-success" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> <?php echo $msg; ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if (isset($_GET['msgErro'])) { $msg = $_GET['msgErro']; ?>
    <div class="row my-4">
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                <i class="fa-solid fa-xmark me-2"></i> <?php echo $msg; ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if (isset($_GET['msgInfo'])) { $msg = $_GET['msgInfo']; ?>
    <div class="row my-4">
        <div class="col-12">
            <div class="alert alert-info" role="alert">
                <i class="fa-solid fa-circle-info me-2"></i> <?php echo $msg; ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if (isset($_GET['msgAlerta'])) { $msg = $_GET['msgAlerta']; ?>
    <div class="row my-4">
        <div class="col-12">
            <div class="alert alert-warning" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> <?php echo $msg; ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php /* ****************************************************************************************************************************************************************** */ ?>
    
    <div class="row my-4">
        <div class="col-md-5">
        	<form method="post" action="funcoes/login_clientes.php" class="form-horizontal">
                <fieldset>
                
                    <legend>Acesse a Área Restrita</legend>

                    <div class="form-floating mb-3">
                        <input type="text" name="cnpj" class="form-control" id="inputCNPJLogin2" required placeholder="">
                        <label for="inputCNPJLogin2">CNPJ</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="senha" class="form-control" id="inputSenha" required placeholder="">
                        <label for="inputSenha">Senha</label>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Entrar
                    </button>
                
                </fieldset>
            </form>
        </div>
        <div class="col-md-7">
            <h2>Quero me cadastrar!</h2>
            
            <p class="text-justify">Se você já é cliente Linde, e quer ter acesso à área restrita, faça seu cadastro. Em breve estaremos enviando os dados de acesso no e-mail cadastrado.</p>

            <div class="alert alert-warning" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> Campos com * são obrigatórios
            </div>
            
            <form method="post" action="funcoes/cadastro_cliente.php?opt=cliente" class="form-horizontal">
                <div class="form-group">
                    <label for="inputCNPJ" class="col-sm-4 control-label">CNPJ *</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                        <input type="text" name="cnpjj" class="form-control" id="inputCNPJ" required autocomplete="off">
                        <div class="input-group-addon"><span id="resultado"></span></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRazao" class="col-sm-4 control-label">Razão Social *</label>
                    <div class="col-sm-8">
                        <input type="text" name="razao" class="form-control" id="inputRazao" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputNome" class="col-sm-4 control-label">Nome Fantasia *</label>
                    <div class="col-sm-8">
                        <input type="text" name="nome" class="form-control" id="inputNome" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRamo" class="col-sm-4 control-label">Ramo de Atividade *</label>
                    <div class="col-sm-8">
                        <input type="text" name="ramo" class="form-control" id="inputRamo" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputInscricao" class="col-sm-4 control-label">Inscrição Estadual *</label>
                    <div class="col-sm-6">
                        <input type="text" name="inscricao" class="form-control" id="inputInscricao" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEndereco" class="col-sm-4 control-label">Endereço *</label>
                    <div class="col-sm-8">
                        <input type="text" name="endereco" class="form-control" id="inputEndereco" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputNumero" class="col-sm-4 control-label">Número *</label>
                    <div class="col-sm-3">
                        <input type="text" name="numero" class="form-control" id="inputNumero" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputBairro" class="col-sm-4 control-label">Bairro *</label>
                    <div class="col-sm-8">
                        <input type="text" name="bairro" class="form-control" id="inputBairro" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCidade" class="col-sm-4 control-label">Cidade *</label>
                    <div class="col-sm-8">
                        <input type="text" name="cidade" class="form-control" id="inputCidade" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="selectEstado" class="col-sm-4 control-label">Estado *</label>
                    <div class="col-sm-2">
                        <select name="uf" id="selectEstado" class="form-control" required>
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
                    <label for="inputCEP" class="col-sm-4 control-label">CEP *</label>
                    <div class="col-sm-3">
                        <input type="text" name="cep" class="form-control" id="inputCEP" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputTelefone" class="col-sm-4 control-label">Telefone *</label>
                    <div class="col-sm-3">
                        <input type="text" name="fone" class="form-control" id="inputTelefone" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputFax" class="col-sm-4 control-label">Fax</label>
                    <div class="col-sm-3">
                        <input type="text" name="fax" class="form-control" id="inputFax" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCelular" class="col-sm-4 control-label">Celular *</label>
                    <div class="col-sm-3">
                        <input type="text" name="celular" class="form-control" id="inputCelular" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-4 control-label">E-mail *</label>
                    <div class="col-sm-8">
                        <input type="email" name="email" class="form-control" id="inputEmail" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSkype" class="col-sm-4 control-label">Skype</label>
                    <div class="col-sm-6">
                        <input type="text" name="skype" class="form-control" id="inputSkype" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEndCob" class="col-sm-4 control-label">Endereço de Cobrança</label>
                    <div class="col-sm-8">
                        <input type="text" name="end_cobranca" class="form-control" id="inputEndCob" autocomplete="off">
                        <span id="helpBlock" class="help-block">Se for o mesmo do endereço, deixe em branco</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEndEnt" class="col-sm-4 control-label">Endereço de Entrega</label>
                    <div class="col-sm-8">
                        <input type="text" name="end_entrega" class="form-control" id="inputEndEnt" autocomplete="off">
                        <span id="helpBlock" class="help-block">Se for o mesmo do endereço, deixe em branco</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputVendedor" class="col-sm-4 control-label">Vendedor *</label>
                    <div class="col-sm-8">
                        <input type="text" name="vendedor" class="form-control" id="inputVendedor" autocomplete="off" required>
                        <span id="helpBlock" class="help-block">Nome do vendedor que lhe atende</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputObs" class="col-sm-4 control-label">Observações</label>
                    <div class="col-sm-8">
                        <textarea name="obs" class="form-control" id="inputObs" rows="5"></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-4 control-label"></label>
                    <div class="col-sm-8">
                        <div class="g-recaptcha" data-sitekey="6LebcucSAAAAAJy_aqVNc5zV8NVV3fz7cbqDxHnW"></div>
                        <span class="help-block">Marque a opção "Não sou um robô"</span>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
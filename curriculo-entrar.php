<!doctype html>
<html lang="pt-br">

<?php
require_once ("funcoes/conexao.php");

/* Tag Google */
$con_tag = mysqli_query ($conexao, "SELECT curriculo_entrar AS tag FROM admin_tags WHERE id='1'") or die (mysqli_error());
	$d_tag = mysqli_fetch_array ($con_tag);
		$tag = $d_tag['tag'];
		
	if ($tag != "") { $tg = ", ".$tag; } else { $tg = ""; }

/* *** */

$title = "Acesse seu Currículo - Linde Vidros";

$description = "Acesse seu currículo e mantenha-o sempre atualizado" . $tg;
$keywords = "currículo linde vidros, trabalhar na linde vidros";

$og_url = "http://www.lindevidros.com.br/curriculo-entrar";
$og_name = "Acesse seu Currículo";

$submenu_id = "C-EN";

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
                    	<h1>Trabalhe Conosco</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
    <?php /* ****************************************************************************************************************************************************************** */ ?>
	<?php if (isset($_GET['msgSucesso'])) { $msg = $_GET['msgSucesso']; ?>
    <div class="row" id="conteudo">
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
    <div class="row" id="conteudo">
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
    <div class="row" id="conteudo">
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
    <div class="row" id="conteudo">
        <div class="col-xs-12">
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fas fa-exclamation-triangle fa-lg"></i>
                <?php echo $msg; ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php /* ****************************************************************************************************************************************************************** */ ?>
    
    <div class="row" id="conteudo">
        <div class="col-md-7">
        	<form method="post" action="funcoes/login_curriculos.php" class="form-horizontal">
                
                <fieldset>
                
                <legend>Acesse seu Currículo</legend>
                
                <div class="form-group">
                    <label for="inputCPF" class="col-sm-3 control-label">CPF</label>
                    <div class="col-sm-6">
                        <input type="text" name="cpf" class="form-control" id="inputCPF" required autocomplete="off" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSenha" class="col-sm-3 control-label">Senha</label>
                    <div class="col-sm-6">
                        <input type="password" name="senha" class="form-control" id="inputSenha" maxlength="20" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-primary btn-lg">Entrar</button>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <i class="fa fa-lock" aria-hidden="true"></i> <a href="#recuperar-senha" data-toggle="modal" data-target="#recuperar-senha">Esqueceu sua senha?</a>
                    </div>
                </div>
                
                </fieldset>
            </form>
        </div>
        <div class="col-md-5">
        	<?php include_once("includes/trabalhe.php"); ?>
        </div>
    </div>
</div>

<!-- Senha - Login Currículos -->
<div class="modal fade" id="recuperar-senha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-lock" aria-hidden="true"></i> &nbsp; Recuperação de Senha</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="funcoes/recuperar_senha.php" class="form-horizontal">
            <div class="form-group">
                <label for="inputCPF2" class="col-sm-3 control-label">CPF</label>
                <div class="col-sm-5">
                    <input type="text" name="cpf" class="form-control" id="inputCPF2" autocomplete="off" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-sm-3 control-label">E-mail</label>
                <div class="col-sm-9">
                    <input type="email" name="email" class="form-control" id="inputEmail" autocomplete="off" required>
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
                    <button type="submit" class="btn btn-primary btn-lg">Recuperar minha senha</button>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal - Senha Currículos -->

<?php include_once ("includes/rodape.php"); ?>

<?php include_once ("includes/scripts.php"); ?>

</body>
</html>
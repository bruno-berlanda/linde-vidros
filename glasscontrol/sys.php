<?php require_once ("funcoes/_conexao.php"); ?>

<?php require_once ("funcoes/_login_confirmacao.php"); ?>

<?php require_once ("funcoes/_funcoes_geral.php"); ?>

<?php require_once ("includes/_sessao_login.php"); ?>

<?php require_once ("includes/layout_cabecalho.php"); ?>

<?php //require_once ("includes/layout_menu_topo.php"); ?>

<div id="wrapper">

<?php require_once ("includes/layout_menu_lateral.php"); ?>
	
<div id="content-wrapper" class="d-flex flex-column">

    <div id="content">
    
        <?php require_once ("includes/layout_barra_topo.php"); ?>

        <div class="container-fluid">

            <?php include "includes/msgs.php"; ?>

            <?php include "includes/senha_padrao.php"; ?>

            <?php include "includes/estatisticas.php"; ?>

        </div>

    </div>
    
<?php require_once ("includes/layout_rodape.php"); ?>
    
</div>
    
</div>

<?php require_once ("includes/modais.php"); ?>

<?php require_once ("includes/scripts.php"); ?>

</body>

</html>
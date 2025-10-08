<?php
include_once ("../funcoes/conexao.php");
include_once ("includes/funcoes.php");
include_once ("includes/permissao_sistema.php");
include_once ("includes/usuario_logado.php");
include_once ("includes/cabecalho_inicial.php");
?>

<body>

<?php include_once ("includes/menu_topo.php"); ?>

<div class="container-fluid" id="conteudo">

<div class="row" id="titulo">
	<div class="col-md-12">
    	<h1>Área do Representante</h1>
    </div>
</div>

<?php
include_once("includes/msgs.php");

$hora_agora = date("H:i");
if ($hora_agora >= "00:00" && $hora_agora <= "11:59") {
	$saudacao = "Bom dia";
}
else if ($hora_agora >= "12:00" && $hora_agora <= "17:59") {
	$saudacao = "Boa tarde";
}
else {
	$saudacao = "Boa noite";
}
?>

<?php
if ($nav_chrome == false) {
?>
<div class="row" id="aviso-navegador">
    <div class="col-md-12">
    	<div class="jumbotron" id="texto-aviso">
            <div class="container">
            	<h1><i class="fab fa-chrome"></i> Utilize o Google Chrome!</h1>
            	<p>Para melhor funcionabilidade do sistema, utilize o Google Chrome. Em outro navegador algumas funcionabilidades não executam corretamente.</p>
                <p><a href="https://www.google.com.br/chrome/browser/desktop/index.html" class="btn btn-primary btn-lg"><i class="fa fa-download" aria-hidden="true"></i> Faça o download do Google Chrome</a></p>
            </div>
        </div>
    </div>
</div>
<?php
}
?>

<?php
if ($senha_padrao == "S") {
?>
<div class="row" id="atualizar-senha">
    <div class="col-md-12">
    	<div class="jumbotron" id="texto-senha">
            <div class="container">
            	<h1><i class="fas fa-unlock"></i> Atualize a sua senha!</h1>
            	<p><strong><?php echo  primeiro_nome($nome_usuario); ?></strong>, você está usando a senha padrão gerada no cadastro do seu usuário. Para sua segurança altere a sua senha agora mesmo.</p>
                <p><a href="meucadastro.php" class="btn btn-primary btn-lg"><i class="fa fa-lock" aria-hidden="true"></i> Quero trocar a minha senha</a></p>
            </div>
        </div>
    </div>
</div>
<?php
}
?>

<div class="row">
    <div class="col-md-12">

		<div class="jumbotron">
            <div class="container">
            	<h1>Seja bem vindo</h1>
            	<p><?php echo $saudacao." ".primeiro_nome($nome_usuario); ?>, essa área foi criada para você. Aqui você encontrará ferramentas para facilitar o seu dia-a-dia. Aproveite!</p>
            	<?php if ($p_croquis == "S") { ?>
                <p><a href="projetos.php" class="btn btn-warning btn-lg"><i class="fas fa-edit"></i> Croquis de Projetos</a></p>
                <?php } ?>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4">
            	<?php if ($p_promocoes == "S") { ?>
                <h2>Promoções</h2>
            
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $con_promocoes = mysqli_query ($conexao, "SELECT * FROM admin_promocoes WHERE status='S' AND CURRENT_DATE()<=finalizar AND mostrar_representante='S' ORDER BY id DESC") or die (mysqli_error($conexao));

                        while ($d_promocoes = mysqli_fetch_array($con_promocoes)) {
                            ?>
                            <p>
                                <a href="promocoes.php#<?php echo $d_promocoes['id']; ?>" title="<?php echo $d_promocoes['titulo']; ?>">
                                    <?php echo $d_promocoes['titulo']; ?>
                                </a>
                            </p>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>
            </div>
            <div class="col-md-4">
            	<h2>Que Vidro Usar?</h2>
                
                <div class="row">
                    <div class="col-md-12">
                        <a href="materiais/que-vidro-usar.pdf" target="_blank" class="alert-link"><img src="img/img_vidro_usar.png" alt="" class="img-responsive img-thumbnail"></a>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
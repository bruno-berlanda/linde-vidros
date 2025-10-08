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
    	<h1>Projetos</h1>
    </div>
</div>

<?php
include_once("includes/msgs.php");
?>

<?php if ($p_croquis == "S") { ?>

<div class="row">
    <div class="col-md-12">
        <?php
		include_once("includes/msgs.php");
		?>
		
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                Se preferir salvar os projetos em seu computador, clique com o botão direito sobre o projeto desejado e selecione e opção <strong>Salvar link como...</strong>
                </div>
            </div>
        </div>
        
		<div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle"></i>
                        Para visualizar os projetos, você precisa ter instalado em seu computador, algum leitor de PDF.
                        <br><br>
                        <a href="https://get.adobe.com/br/reader/" target="_blank" class="btn btn-block btn-primary"><i class="fas fa-download"></i> Download Adobe Reader</a>
                        </div>
                    </div>
                </div>
                
                <div class="well">
                    <h1 class="text-center text-info"><i class="fas fa-download"></i> </h1>
                    
                    <a href="../croquis/branco.pdf" class="btn btn-lg btn-success btn-block" target="_blank"><i class="fas fa-save"></i> Croqui em Branco</a>
                </div>
            </div>
            
            <div class="col-md-8">
                
                <h2>Fixo</h2>
                
                <div class="row">
                    <div class="col-md-6">
                        <p><i class="fas fa-save"></i> <a href="../croquis/fixo.pdf" target="_blank">Fixo</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/fixos.pdf" target="_blank">Fixos</a></p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fas fa-save"></i> <a href="../croquis/fixo1019.pdf" target="_blank">Fixo Perfil 1019 (Cavalão)</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/fixos1019.pdf" target="_blank">Fixos Perfil 1019 (Cavalão)</a></p>
                    </div>
                </div>
                
                <hr>
                
                <h2>Box</h2>
                
                <div class="row">
                    <div class="col-md-6">
                        <p><i class="fas fa-save"></i> <a href="../croquis/boxpadrao.pdf" target="_blank">Box Padrão</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/boxcanto.pdf" target="_blank">Box de Canto</a></p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fas fa-save"></i> <a href="../croquis/boxgiro.pdf" target="_blank">Box de Giro</a></p>
                    </div>
                </div>
                
                <hr>
                
                <h2>Basculante e Maxiar</h2>
                
                <div class="row">
                    <div class="col-md-6">
                        <p><i class="fas fa-save"></i> <a href="../croquis/basculante.pdf" target="_blank">Basculante</a></p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fas fa-save"></i> <a href="../croquis/maxiar.pdf" target="_blank">Maxiar</a></p>
                    </div>
                </div>
                
                <hr>
                
                <h2>Portas de Correr</h2>
                
                <div class="row">
                    <div class="col-md-6">
                        <p><i class="fas fa-save"></i> <a href="../croquis/portacorrer1.pdf" target="_blank">Porta de Correr de 2 Folhas - Guia Aparente e Trilho Inteiro</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/portacorrer2.pdf" target="_blank">Porta de Correr de 2 Folhas - Guia Aparente e Trilho Interrompido</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/portacorrer3.pdf" target="_blank">Porta de Correr de 2 Folhas - Guia Embutida</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/portacorrer4.pdf" target="_blank">Porta de Correr - Guia Aparente e Trilho Inteiro</a></p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fas fa-save"></i> <a href="../croquis/portacorrer5.pdf" target="_blank">Porta de Correr - Guia Embutida Medida Tirada em Cima do Piso</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/portacorrer6.pdf" target="_blank">Porta de Correr - Guia Embutida Medida Tirada Dentro da Guia</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/portacorrer7.pdf" target="_blank">Porta de Correr - Guia Aparente e Trilho Interrompido</a></p>
                    </div>
                </div>
                
                <hr>
                
                <h2>Portas de Giro</h2>
                
                <div class="row">
                    <div class="col-md-6">
                        <p><i class="fas fa-save"></i> <a href="../croquis/portagiro1.pdf" target="_blank">Porta de Giro 2 Folhas</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/portagiro2.pdf" target="_blank">Porta de Giro 1 Folha</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/portagiro3.pdf" target="_blank">Porta de Giro - Puxador Diferenciado</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/portagiro4.pdf" target="_blank">Porta de Giro - Dois Móveis com Fixos</a></p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fas fa-save"></i> <a href="../croquis/portagiro5.pdf" target="_blank">Porta de Giro - Com Bandeira</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/portagiro6.pdf" target="_blank">Porta de Giro - 1 Fixo com Bandeira</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/portagiro7.pdf" target="_blank">Porta de Giro - 2 Portas e 1 Bandeira</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/portagiro8.pdf" target="_blank">Porta de Giro - 2 Portas, 2 Fixos e 1 Bandeira</a></p>
                    </div>
                </div>
                
                <hr>
                
                <h2>Janelas de Correr</h2>
                
                <div class="row">
                    <div class="col-md-6">
                        <p><i class="fas fa-save"></i> <a href="../croquis/janela1.pdf" target="_blank">Janela de 4 Folhas - Com Trinco</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/janela2.pdf" target="_blank">Janela de 4 Folhas - Sem Trinco</a></p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fas fa-save"></i> <a href="../croquis/janela3.pdf" target="_blank">Janela de 2 Folhas - Com Fecho e Trinco</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/janela4.pdf" target="_blank">Janela de 2 Folhas - Com Puxador e Trinco</a></p>
                    </div>
                </div>
                
                <hr>
                
                <h2>Janelas com Trilho Stanley</h2>
                
                <div class="row">
                    <div class="col-md-6">
                        <p><i class="fas fa-save"></i> <a href="../croquis/janelastanley1.pdf" target="_blank">Janela com Trilho Stanley e Mini Fechadura</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/janelastanley2.pdf" target="_blank">Janela com Trilho Stanley com Puxador e 1122M</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/janelastanley3.pdf" target="_blank">Janela com Trilho Stanley com Bate e Fecha e 1122M</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/janelastanley4.pdf" target="_blank">Janela com Trilho Stanley e Fechadura com 1122M</a></p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fas fa-save"></i> <a href="../croquis/janelastanley5.pdf" target="_blank">Janela com Trilho Stanley e Bate e Fecha</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/janelastanley6.pdf" target="_blank">Janela com Trilho Stanley e Mini Fechadura</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/janelastanley7.pdf" target="_blank">Janela com Trilho Stanley e Fechadura</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/janelastanley8.pdf" target="_blank">Janela com Trilho Stanley com Puxador e Trinco</a></p>
                    </div>
                </div>
                
                <hr>
                
                <h2>Portas com Trilho Stanley</h2>
                
                <div class="row">
                    <div class="col-md-6">
                        <p><i class="fas fa-save"></i> <a href="../croquis/portastanley1.pdf" target="_blank">Porta 2 folhas com Trilho Stanley embutido com medida tirada em cima do piso</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/portastanley2.pdf" target="_blank">Porta 2 folhas com Trilho Stanley embutido com medida tirada dentro do trilho</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/portastanley3.pdf" target="_blank">Porta 3 folhas com Trilho Stanley embutido com medida tirada dentro do trilho</a></p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fas fa-save"></i> <a href="../croquis/portastanley4.pdf" target="_blank">Porta 3 folhas com Trilho Stanley embutido com medida tirada em cima do piso</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/portastanley5.pdf" target="_blank">Porta 6 folhas com Trilho Stanley embutido com medida tirada dentro do trilho</a></p>
                        <p><i class="fas fa-save"></i> <a href="../croquis/portastanley6.pdf" target="_blank">Porta de 6 folhas com Trilho Stanley embutido com medida tirada em cima do piso</a></p>
                    </div>
                </div>
                
            </div>
            </div>
        
	</div>
</div>

<?php } // Permissão para acessar a página ?>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
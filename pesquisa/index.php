<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>Linde Vidros - Experiência com o Cliente</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A Linde Vidros está situada na cidade de Rio Negro, Paraná. Conheça nossa empresa e nossa linha de produtos. Linde Vidros, qualidade que se vê, e sente!">
    <meta name="keywords" content="">
	<meta name="author" content="Bruno Berlanda">
	<link rel="shortcut icon" href="../img/favicon.ico">
    
	<!-- CSS -->
	<link href="../css/bootstrap.min.css?<?php echo filemtime('../css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="css/pesquisa.css?<?php echo filemtime('css/pesquisa.css'); ?>" rel="stylesheet">
    
	<!-- JS -->
	<!--[if lt IE 9]>
	<script src="../js/html5shiv.js"></script>
	<![endif]-->
    
    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>
    
    <!-- iCheck -->
    <link href="css/square/blue.css" rel="stylesheet">
	<script src="js/icheck.js"></script>
    
    <script>
	$(document).ready(function(){
	  $('input').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue',
		increaseArea: '20%' // optional
	  });
	});
	</script>
    
	<!-- Fontes -->
	<link href="http://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Gudea" rel="stylesheet" type="text/css">
</head>

<body>

<div class="container" id="conteudo">

<div class="row">
	<div class="col-md-12 text-center">
    	<img src="../img/linde.png" alt="Linde Vidros" class="img-rounded">
        
        <h1>Questionário de Avaliação da Experiência com o Cliente</h1>
        
        <p class="text-info">O objetivo deste questionário é avaliar o desempenho da nossa empresa para que possamos melhorar continuamente.</p>
        
        <?php if (isset($_GET['msgSucesso'])) { $msg = $_GET['msgSucesso']; ?>
		<div class="alert alert-success"><strong><?php echo $msg; ?></strong></div>
		<?php } ?>
    </div>
</div>

<hr>

<div class="row">
<div class="col-md-12">

<?php
if (isset($_GET['p'])) {

	$p = $_GET['p'];
	
	require_once ("../funcoes/conexao.php");
	
	$consulta_pesquisa = mysqli_query ($conexao, "SELECT data, nome_cliente, rota, responsavel, status FROM pesquisa_clientes WHERE codigo='$p'") or die (mysqli_error());
		$dados = mysqli_fetch_array ($consulta_pesquisa);
			$data 			= $dados['data'];
			$nome_cliente 	= $dados['nome_cliente'];
			$rota 			= $dados['rota'];
			$responsavel 	= $dados['responsavel'];
			$status 		= $dados['status'];
	
/* *********************************************************************************************************************************************************************
PENDENTE
**********************************************************************************************************************************************************************/
if ($status == "P") {
?>
<p>Olá <strong><?php echo $responsavel; ?></strong>, a Linde Vidros quer ouvir como está a satisfação da <strong class="text-danger"><?php echo $nome_cliente; ?></strong>. <span class="lead">:)</span></p>

<div class="well" id="well-site">
<form method="post" action="../funcoes/pesquisa.php?funcao=responder&p=<?php echo $p; ?>" class="form-horizontal">
    <fieldset>
        <legend>Experiência com o Cliente</legend>
        
        <h2>Transporte</h2>
        
        <p><strong>1 - O motorista verifica o local onde será descarregado (condicionado) o produto?</strong></p>
            <label class="radio">
                <input type="radio" name="p_tra1" value="4" required> Muito satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_tra1" value="3" required> Satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_tra1" value="2" required> Insatisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_tra1" value="1" required> Muito insatisfeito
            </label>
		
        <br>
        
        <p><strong>2 - O motorista faz a contagem e conferência das peças junto ao cliente e em caso de alguma dúvida faz a recontagem?</strong></p>
            <label class="radio">
                <input type="radio" name="p_tra2" value="4" required> Muito satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_tra2" value="3" required> Satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_tra2" value="2" required> Insatisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_tra2" value="1" required> Muito insatisfeito
            </label>
        
        <br>
        
        <p><strong>3 - O motorista dá o tempo necessário para a conferência dos produtos?</strong></p>
            <label class="radio">
                <input type="radio" name="p_tra3" value="4" required> Muito satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_tra3" value="3" required> Satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_tra3" value="2" required> Insatisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_tra3" value="1" required> Muito insatisfeito
            </label>
        
        <br>
        
        <p><strong>Observações sobre o TRANSPORTE</strong></p>
        
        <textarea name="obs_tra" rows="4" class="form-control" placeholder="Use esse espaço caso queira deixar alguma observação sobre o TRANSPORTE."></textarea>
        
        <h2>Produto</h2>
        
        <p><strong>4 - Qualidade dos produtos</strong></p>
            <label class="radio">
                <input type="radio" name="p_pro1" value="4" required> Muito satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_pro1" value="3" required> Satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_pro1" value="2" required> Insatisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_pro1" value="1" required> Muito insatisfeito
            </label>
        
        <br>
        
        <p><strong>5 - As peças entregues atendem à qualidade desejada?</strong></p>
            <label class="radio">
                <input type="radio" name="p_pro2" value="4" required> Muito satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_pro2" value="3" required> Satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_pro2" value="2" required> Insatisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_pro2" value="1" required> Muito insatisfeito
            </label>
        
        <br>
        
        <p><strong>6 - A quantidade solicitada é entregue em sua totalidade?</strong></p>
            <label class="radio">
                <input type="radio" name="p_pro3" value="4" required> Muito satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_pro3" value="3" required> Satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_pro3" value="2" required> Insatisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_pro3" value="1" required> Muito insatisfeito
            </label>
		
        <br>
        
        <p><strong>7 - Quando há dúvidas e problemas com peças, o setor de qualidade dá o devido atendimento?</strong></p>
            <label class="radio">
                <input type="radio" name="p_pro4" value="4" required> Muito satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_pro4" value="3" required> Satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_pro4" value="2" required> Insatisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_pro4" value="1" required> Muito insatisfeito
            </label>
        
        <br>
        
        <p><strong>Observações sobre os PRODUTOS</strong></p>
        
        <textarea name="obs_pro" rows="4" class="form-control" placeholder="Use esse espaço caso queira deixar alguma observação sobre os PRODUTOS."></textarea>
        
        <h2>Comercial</h2>
        
        <p><strong>8 - A visita do representante é frequente e eficiente?</strong></p>
            <label class="radio">
                <input type="radio" name="p_com1" value="4" required> Muito satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_com1" value="3" required> Satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_com1" value="2" required> Insatisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_com1" value="1" required> Muito insatisfeito
            </label>
        
        <br>
        
        <p><strong>9 - O atendimento telefônico é rápido e prestativo?</strong></p>
            <label class="radio">
                <input type="radio" name="p_com2" value="4" required> Muito satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_com2" value="3" required> Satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_com2" value="2" required> Insatisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_com2" value="1" required> Muito insatisfeito
            </label>
        
        <br>
        
        <p><strong>10 - O retorno de orçamentos e pendências com os vendedores internos estão dentro da sua expectativa?</strong></p>
            <label class="radio">
                <input type="radio" name="p_com3" value="4" required> Muito satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_com3" value="3" required> Satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_com3" value="2" required> Insatisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_com3" value="1" required> Muito insatisfeito
            </label>
		
        <br>
        
        <p><strong>11 - O prazo de entrega dos pedidos atende as suas necessidades?</strong></p>
            <label class="radio">
                <input type="radio" name="p_com4" value="4" required> Muito satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_com4" value="3" required> Satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_com4" value="2" required> Insatisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_com4" value="1" required> Muito insatisfeito
            </label>
        
        <br>
        
        <p><strong>12 - O departamento financeiro é rápido e eficaz na resolução de pendências?</strong></p>
            <label class="radio">
                <input type="radio" name="p_com5" value="4" required> Muito satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_com5" value="3" required> Satisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_com5" value="2" required> Insatisfeito
            </label>
            <label class="radio">
                <input type="radio" name="p_com5" value="1" required> Muito insatisfeito
            </label>
        
        <br>
        
        <p><strong>Observações sobre o COMERCIAL</strong></p>
        
        <textarea name="obs_com" rows="4" class="form-control" placeholder="Use esse espaço caso queira deixar alguma observação sobre o COMERCIAL."></textarea>
        
        <h2>Conhecimento dos produtos</h2>
        
        <p><strong>13 - Você sabia que a Linde Vidros trabalha com?</strong></p>
        
        <table class="table table-striped">
        	<tr>
            	<td>Temperado</td>
                <td><input type="radio" name="c_tem" value="S" required> Sim</td>
                <td><input type="radio" name="c_tem" value="N" required> Não</td>
            </tr>
            <tr>
            	<td>Laminado</td>
                <td><input type="radio" name="c_lam" value="S" required> Sim</td>
                <td><input type="radio" name="c_lam" value="N" required> Não</td>
            </tr>
            <tr>
            	<td>Laminado Temperado</td>
                <td><input type="radio" name="c_tla" value="S" required> Sim</td>
                <td><input type="radio" name="c_tla" value="N" required> Não</td>
            </tr>
            <tr>
            	<td>Laminado SentryGlas&reg;</td>
                <td><input type="radio" name="c_sen" value="S" required> Sim</td>
                <td><input type="radio" name="c_sen" value="N" required> Não</td>
            </tr>
            <tr>
            	<td>Serigrafado</td>
                <td><input type="radio" name="c_ser" value="S" required> Sim</td>
                <td><input type="radio" name="c_ser" value="N" required> Não</td>
            </tr>
            <tr>
            	<td>Marmorizado</td>
                <td><input type="radio" name="c_mar" value="S" required> Sim</td>
                <td><input type="radio" name="c_mar" value="N" required> Não</td>
            </tr>
            <tr>
            	<td>Refletivo</td>
                <td><input type="radio" name="c_ref" value="S" required> Sim</td>
                <td><input type="radio" name="c_ref" value="N" required> Não</td>
            </tr>
            <tr>
            	<td>Insulado / Insulado com Persiana</td>
                <td><input type="radio" name="c_ins" value="S" required> Sim</td>
                <td><input type="radio" name="c_ins" value="N" required> Não</td>
            </tr>
            <tr>
            	<td>Linha Habitat</td>
                <td><input type="radio" name="c_hab" value="S" required> Sim</td>
                <td><input type="radio" name="c_hab" value="N" required> Não</td>
            </tr>
            <tr>
            	<td>Espelhos</td>
                <td><input type="radio" name="c_esp" value="S" required> Sim</td>
                <td><input type="radio" name="c_esp" value="N" required> Não</td>
            </tr>
            <tr>
            	<td>Impressos</td>
                <td><input type="radio" name="c_imp" value="S" required> Sim</td>
                <td><input type="radio" name="c_imp" value="N" required> Não</td>
            </tr>
            <tr>
            	<td>Ferragens</td>
                <td><input type="radio" name="c_fer" value="S" required> Sim</td>
                <td><input type="radio" name="c_fer" value="N" required> Não</td>
            </tr>
            <tr>
            	<td>Molas</td>
                <td><input type="radio" name="c_mol" value="S" required> Sim</td>
                <td><input type="radio" name="c_mol" value="N" required> Não</td>
            </tr>
            <tr>
            	<td>Kit Box</td>
                <td><input type="radio" name="c_kit" value="S" required> Sim</td>
                <td><input type="radio" name="c_kit" value="N" required> Não</td>
            </tr>
            <tr>
            	<td>Alumínios</td>
                <td><input type="radio" name="c_alu" value="S" required> Sim</td>
                <td><input type="radio" name="c_alu" value="N" required> Não</td>
            </tr>
            <tr>
            	<td>Porta Automática</td>
                <td><input type="radio" name="c_por" value="S" required> Sim</td>
                <td><input type="radio" name="c_por" value="N" required> Não</td>
            </tr>
        </table>
        
        <h2>Merlin</h2>
        
        <p><strong>14 - Você conhece a marca Merlin?</strong></p>
        	<label class="radio">
                <input type="radio" name="merlin" value="S" required> Sim
            </label>
            <label class="radio">
                <input type="radio" name="merlin" value="N" required> Não
            </label>
        
        <h2>Outros Produtos</h2>
        
        <p><strong>15 - Quais produtos você gostaria que tivesse em nossa gama de produtos, que hoje ainda não temos?</strong></p>
        
        <textarea name="outros" rows="3" class="form-control" placeholder="Deixe em branco caso não tenha nenhum produto desejado."></textarea>
        
        <h2>Conclusão</h2>
        
        <p><strong>16 - De forma geral, como você avalia a marca Linde em comparação à concorrência?</strong></p>
        	<label class="radio">
                <input type="radio" name="avaliacao" value="3" required> Superior
            </label>
            <label class="radio">
                <input type="radio" name="avaliacao" value="2" required> Igual
            </label>
            <label class="radio">
                <input type="radio" name="avaliacao" value="1" required> Inferior
            </label>
        
        <br>
        
        <textarea name="obs_geral" rows="8" class="form-control" placeholder="Use esse espaço caso queira comentar algo mais. Fazer algum elogio, crítica ou sugestão."></textarea>
        
        <hr>
                
        <input type="submit" value="Responder" class="btn btn-lg btn-primary">
        
    </fieldset>
</form>
</div>

<?php
}
/* *********************************************************************************************************************************************************************
CANCELADO
**********************************************************************************************************************************************************************/
else if ($status == "C") {
?>

<div class="well" id="well-site">
<p class="lead">Olá <strong><?php echo $responsavel; ?></strong>, a pesquisa não foi encontrada. Entre em contato com o vendedor que lhe atende para solicitar nova pesquisa.</p>
</div>

<?php	
}
/* *********************************************************************************************************************************************************************
RESPONDIDO
**********************************************************************************************************************************************************************/
else if ($status == "R") {
?>

<div class="well" id="well-site">
<p class="lead text-center">Muito obrigado <strong><?php echo $responsavel; ?></strong>, <br> por responder a nossa pesquisa. A sua opinião é muito importante para nós.</p>

<p class="text-center">Acesse nosso Website</p>
<p class="text-center"><a href="http://www.lindevidros.com.br" class="btn btn-large btn-primary">www.lindevidros.com.br</a></p>

<hr>

<p class="text-center text-warning">Acesse a nossa <strong>Área Restrita</strong> e fique por dentro das novidades!</p>
<p class="text-center"><a href="http://www.lindevidros.com.br/cliente.php" class="btn btn-warning"><span class="glyphicon glyphicon-share" aria-hidden="true"></span> Acesse Agora</a></p>
</div>

<?php
}
?>
</div>
</div>
<?php
} // if isset($_GET['p']
/* *********************************************************************************************************************************************************************
************************************************************************************************************************************************************************
************************************************************************************************************************************************************************
************************************************************************************************************************************************************************
************************************************************************************************************************************************************************
************************************************************************************************************************************************************************
************************************************************************************************************************************************************************
**********************************************************************************************************************************************************************/
else {
?>

<div class="well" id="well-site">
	<p class="lead text-center">PESQUISA NÃO ENCONTRADA! :(</p>
</div>

<?php	
} // else isset($_GET['p']
?>

<hr>

<footer>
    <address>
        <center>
        Avenida Luiz Carlos Pereira Tourinho, 4197 &bull; Bairro Industrial &bull; Paralela a BR 116 
        <br>
        Rio Negro - PR &bull; CEP 83885-302
        <br><br>
        <p class="lead"><strong>47 3641 4444</strong></p>
        </center>
    </address>
    
    <address>
        <center>
        <i class="icon-envelope"></i> <a href="mailto:linde@lindevidros.com.br">linde@lindevidros.com.br</a>
        </center>
    </address>
  
    <p class="text-center">
    	<a href="https://www.facebook.com/lindevidros" target="_blank" id="tooltip-facebook" rel="tooltip" data-placement="bottom" title="Linde Vidros no Facebook"><img src="../img/social_facebook.png" alt=""></a> 
        <a href="https://instagram.com/lindevidros" target="_blank" id="tooltip-instagram" rel="tooltip" data-placement="bottom" title="Linde Vidros no Instagram"><img src="../img/social_instagram.png" alt=""></a>
	</p>
    
    <p class="text-center"><small>Website desenvolvido por <a href="mailto:bruno.berlanda@gmail.com">Bruno Berlanda</a></small></p>
</footer>

</div> <!-- container -->

</body>

</html>
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
    	<h1>Diário</h1>
    </div>
</div>

<?php
include_once("includes/msgs.php");
?>

<?php if ($p_diario == "S") { ?>

<?php
$codigo = $_GET['c'];

// Dados do Filtro
$di = $_GET['di'];
$df = $_GET['df'];
$re = $_GET['re'];
$cl = $_GET['cl'];
$st = $_GET['st'];

$consulta_cliente = mysqli_query ($conexao, "SELECT cliente, vendedor1, vendedor2, vendedor3 FROM diario_contato WHERE codigo='$codigo'") or die (mysqli_error($conexao));
	$dados_c = mysqli_fetch_array ($consulta_cliente);
		$id_cliente 	= $dados_c['cliente'];
		$id_vendedor1 	= $dados_c['vendedor1'];
		$id_vendedor2 	= $dados_c['vendedor2'];
		$id_vendedor3 	= $dados_c['vendedor3'];

$con_cliente = mysqli_query ($conexao, "SELECT * FROM geral_clientes WHERE id='$id_cliente'") or die (mysqli_error($conexao));
	$dados_cliente = mysqli_fetch_array ($con_cliente);
		$c_cliente 	= $dados_cliente['cliente'];
		$c_rota 	= $dados_cliente['rota'];
		$c_cidade 	= $dados_cliente['cidade'];
		$c_uf 		= $dados_cliente['uf'];
		$c_resp		= $dados_cliente['responsavel'];
		$c_seg		= $dados_cliente['segmento'];
		$c_novo		= $dados_cliente['novo'];
		$c_fv		= $dados_cliente['fechou_venda'];
		
		switch ($c_seg) {
			case "ENG":
				$segmento = "ENGENHARIA";
				break;
			case "MOV":
				$segmento = "MOVELEIRO";
				break;
			case "CHA":
				$segmento = "CHPARIA";
				break;
			case "FER":
				$segmento = "FERRAGENS";
				break;
		}
?>

<div class="row">

<div class="col-md-3">
	<?php
	if ($di != "" || $df != "" || $re != "" || $cl != "" || $st!= "") {
	?>
    <a href="diario-gerenciar.php?data_inicial=<?php echo $di; ?>&data_final=<?php echo $df; ?>&representante=<?php echo $re; ?>&cliente=<?php echo $cl; ?>&status=<?php echo $st; ?>" class="btn btn-default btn-sm btn-block"><i class="fas fa-undo-alt"></i> Voltar</a>
    <?php
	} else {
	?>
    <a href="diario-gerenciar.php" class="btn btn-default btn-sm btn-block"><i class="fas fa-undo-alt"></i> Voltar</a>
    <?php
	}
	?>

    <hr>
	
    <div class="panel panel-primary">
        <div class="panel-heading"><i class="fas fa-user"></i> DADOS DO CLIENTE</div>
        <table class="table">
            <tbody>
                <?php
				if ($c_novo == "S") {
				?>
                <tr class="warning">
                    <td class="text-center">
                    <strong>CLIENTE NOVO</strong>
                    </td>
                </tr>
                <?php
				}
				?>
                <tr>
                    <td>
                    <strong class="text-muted"><small>CLIENTE</small></strong>
                    <br>
                    <?php echo $c_cliente; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                    <strong class="text-muted"><small>ROTA</small></strong>
                    <br>
                    <?php echo $c_rota; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                    <strong class="text-muted"><small>CIDADE</small></strong>
                    <br>
                    <?php echo $c_cidade; ?>/<?php echo $c_uf; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                    <strong class="text-muted"><small>REPRESENTANTE</small></strong>
                    <br>
                    <?php echo nome_representante($c_resp, $conexao); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                    <strong class="text-muted"><small>VENDEDOR RESPONSÁVEL</small></strong>
                    <br>
                    <?php echo nome_representante($id_vendedor1, $conexao); ?>
                    <?php
                    if ($id_vendedor2 > 0) {
						echo "<br>".nome_representante($id_vendedor2, $conexao);
					}

                    if ($id_vendedor3 > 0) {
						echo "<br>".nome_representante($id_vendedor3, $conexao);
					}
					?>
                    </td>
                </tr>
                <tr>
                    <td>
                    <strong class="text-muted"><small>SEGMENTO</small></strong>
                    <br>
                    <?php echo $segmento; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
	
    <hr>
    
    <?php
	$con_datas = mysqli_query ($conexao, "SELECT MAX(data_visita) AS max_dv, MIN(data_visita) AS min_dv FROM diario_contato WHERE cliente='$id_cliente'") or die (mysqli_error($conexao));
		$d_datas = mysqli_fetch_array ($con_datas);
			$max_dv = $d_datas['max_dv'];
			$min_dv = $d_datas['min_dv'];
	?>
    
    <form method="post" action="diario-imprimir.php?c=<?php echo $codigo; ?>" target="_blank">
        <div class="form-group">
        	<label for="inputDataInicial">Data Inicial</label>
        	<input type="date" name="data_inicial" class="form-control" id="inputDataInicial" min="<?php echo $min_dv; ?>" max="<?php echo $max_dv; ?>" value="<?php echo $min_dv; ?>" required>
        </div>
        <div class="form-group">
        	<label for="inputDataFinal">Data Final</label>
        	<input type="date" name="data_final" class="form-control" id="inputDataFinal" min="<?php echo $min_dv; ?>" max="<?php echo $max_dv; ?>" value="<?php echo $max_dv; ?>" required>
        </div>
    
    	<button type="submit" class="btn btn-default btn-block"><i class="fas fa-print"></i> Imprimir</button>
    </form>
</div>

<div class="col-md-9">
	<h2>Histórico de Visitas</h2>
    
    <?php
	$con_diario = mysqli_query ($conexao, "SELECT * FROM diario_contato WHERE usuario='$c_resp' AND cliente='$id_cliente' ORDER BY data_visita DESC, data DESC") or die (mysqli_error($conexao));
	
	while ($d_diario = mysqli_fetch_array ($con_diario)) {
		$d_id 			= $d_diario['id'];
		$d_data 		= $d_diario['data'];
		$d_data_visita 	= $d_diario['data_visita'];
		$d_usuario 		= $d_diario['usuario'];
		$d_vendedor1 	= $d_diario['vendedor1'];
		$d_vendedor2 	= $d_diario['vendedor2'];
		$d_vendedor3 	= $d_diario['vendedor3'];
		$d_descricao 	= $d_diario['descricao'];
		$d_tipo 		= $d_diario['tipo'];
		$d_foto1 		= $d_diario['foto1'];
		$d_foto2 		= $d_diario['foto2'];
		$d_foto3 		= $d_diario['foto3'];
		$d_alerta 		= $d_diario['alerta'];
		$d_fv 			= $d_diario['fechou_venda'];
		$d_status 		= $d_diario['status'];
		
		$n_id = str_pad($d_id, 5, "0", STR_PAD_LEFT);
	
		$data 			= date('d/m/Y H:i', strtotime($d_data));
		$data_visita 	= date('d/m/Y', strtotime($d_data_visita));
		$data_retorno 	= date('d/m/Y', strtotime($d_ret_data));
		
		switch ($d_tipo) {
			case "E";
				$t_img = "fas fa-envelope";
				$t_txt = "E-MAIL";
				break;
			case "S";
				$t_img = "fab fa-skype";
				$t_txt = "SKYPE";
				break;
			case "T";
				$t_img = "fas fa-phone";
				$t_txt = "TELEFONE";
				break;
			case "V";
				$t_img = "fas fa-home";
				$t_txt = "VISITA NO CLIENTE";
				break;
			case "W";
				$t_img = "fab fa-whatsapp";
				$t_txt = "WHATSAPP";
				break;
			default:
				$t_img = "";
				$t_txt = "";
		}
		
		if ($d_status == "R" || $d_status == "G") {
			$cor_panel = "panel-success";
		}
		elseif ($d_status == "P") {
			$cor_panel = "panel-danger";
		}
	?>
    <div class="panel <?php echo $cor_panel; ?>">
        <div class="panel-heading">
        	<div class="row">
            	<div class="col-xs-5">
                	<i class="fas fa-calendar-alt"></i> <strong><?php echo $data_visita; ?></strong>
                </div>
                <div class="col-xs-7 text-right">
                	<div class="btn-group" role="group" aria-label="botoes-fotos">
						<?php if ($d_foto1 != "") { ?>
                        <a href="upload/diario/<?php echo $d_foto1; ?>" rel="shadowbox" class="btn btn-primary btn-sm"><i class="fas fa-camera"></i></a>
                        <?php } else { ?>
                        <a href="#" class="btn btn-default btn-sm disabled"><i class="fas fa-camera"></i></a>
                        <?php } ?>
                        <?php if ($d_foto2 != "") { ?>
                        <a href="upload/diario/<?php echo $d_foto2; ?>" rel="shadowbox" class="btn btn-primary btn-sm"><i class="fas fa-camera"></i></a>
                        <?php } else { ?>
                        <a href="#" class="btn btn-default btn-sm disabled"><i class="fas fa-camera"></i></a>
                        <?php } ?>
                        <?php if ($d_foto3 != "") { ?>
                        <a href="upload/diario/<?php echo $d_foto3; ?>" rel="shadowbox" class="btn btn-primary btn-sm"><i class="fas fa-camera"></i></a>
                        <?php } else { ?>
                        <a href="#" class="btn btn-default btn-sm disabled"><i class="fas fa-camera"></i></a>
                        <?php } ?>
                    </div>
                    
                    <?php if ($p_diario_gerente == "S") { ?>
                    <a href="funcoes/diario.php?funcao=excluir&id=<?php echo $d_id; ?>&c=<?php echo $codigo; ?>&di=<?php echo $di; ?>&df=<?php echo $df; ?>&re=<?php echo $re; ?>&cl=<?php echo $cl; ?>&st=<?php echo $st ?>" class="btn btn-primary btn-sm" onClick="return confirm('Tem certeza que deseja excluir esse registro? Isso irá remover todo o contato e seus feedbacks.')"><i class="fas fa-trash-alt"></i></a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <table class="table">
            <tbody>
                <tr>
                    <td>
                    <strong class="text-muted"><small>DESCRIÇÃO DO CONTATO</small></strong>
                    <br>
                    <?php echo nl2br($d_descricao); ?>
                    </td>
                </tr>
                <?php if ($d_tipo != "") { ?>
                <tr>
                    <td>
                    <strong class="text-muted"><small>COMO FOI REALIZADO O CONTATO</small></strong>
                    <br>
                    <small><i class="<?php echo $t_img; ?>"></i> <?php echo $t_txt; ?></small>
                    </td>
                </tr>
				<?php } ?>
                
                <?php
				/* ***************************************
				CONSULTA RESPOSTAS
				*************************************** */
				$consulta_respostas = mysqli_query ($conexao, "SELECT * FROM diario_respostas WHERE id_contato='$d_id' ORDER BY data") or die (mysqli_error());
				$conta_respostas = mysqli_num_rows ($consulta_respostas);
				
				if ($conta_respostas > 0) {
					while ($dados_respostas = mysqli_fetch_array ($consulta_respostas)) {
						$r_data 	= $dados_respostas['data'];
						$r_usuario 	= $dados_respostas['usuario'];
						$r_feedback = $dados_respostas['feedback'];
						
						$data_resp	= date('d/m/Y H:i', strtotime($r_data));
				?>
                <tr class="active">
                    <td>
					<blockquote id="diario-resposta">
                    	<p><?php echo nl2br($r_feedback); ?></p>
                        <footer><?php echo $data_resp; ?> - <?php echo nome_representante($r_usuario, $conexao); ?></footer>
                    </blockquote>
                    </td>
                </tr>
                <?php
					}
				}
				?>
            </tbody>
        </table>
        <div class="panel-footer">
        	<form method="post" action="funcoes/diario.php?funcao=retorno&id=<?php echo $d_id; ?>&c=<?php echo $codigo; ?>&di=<?php echo $di; ?>&df=<?php echo $df; ?>&re=<?php echo $re; ?>&cl=<?php echo $cl; ?>&st=<?php echo $st ?>">
                <fieldset>
                
                <div class="form-group">
                    <label for="textRetorno">Feedback</label>
                    <textarea name="feedback" class="form-control" id="textRetorno" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="alerta" class="form-control" id="checkAlerta" value="S"<?php if ($d_alerta == "S") { echo " checked"; } ?>> Deixar este contato em <strong>alerta</strong>.
                </div>
                <?php
				if ($c_novo == "S" && $c_fv == "N") {
				?>
                <div class="form-group">
                    <input type="checkbox" name="venda" class="form-control" id="checkAlerta" value="S"<?php if ($c_fv == "S") { echo " checked"; } ?>> Depois deste contato o cliente fechou venda?
                </div>
                <?php
				}
				?>
    
                <button type="submit" class="btn btn-primary">Salvar</button>
                
                </fieldset>
            </form>
        </div>
    </div>
    <?php
	}
	?>
</div>

</div>

<?php } // Permissão para acessar a página ?>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
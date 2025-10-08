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
    	<h1>Diário: Relatório</h1>
    </div>
</div>

<?php
include_once("includes/msgs.php");
?>

<?php if ($p_diario_gerente == "S") { ?>

<?php
/* ****************************************************
FILTROS
**************************************************** */
if (isset($_GET['data_inicial']) || isset($_GET['data_final']) && isset($_GET['representante']) && isset($_GET['rota'])) {
	$filtro_data1 	= $_GET['data_inicial'];
	$filtro_data2 	= $_GET['data_final'];
	$filtro_repre 	= $_GET['representante'];
	$filtro_rota 	= $_GET['rota'];
	
	$x_d1 = explode("-", $filtro_data1);
		$data_inicial = $x_d1[2]."/".$x_d1[1]."/".$x_d1[0];
	
	$x_d2 = explode("-", $filtro_data2);
		$data_final = $x_d2[2]."/".$x_d2[1]."/".$x_d2[0];
		
	// Filtro Rota
	if ($filtro_rota !== "") {
		$sql_rota = " AND a.rota='$filtro_rota'";
		$desc_rota = $filtro_rota;
	}
	else {
		$sql_rota = "";
		$desc_rota = "TODAS";
	}

// TOTAL DE VISITAS
$con_diario = mysqli_query ($conexao, "SELECT MAX(a.data_visita) AS data_visita, DATEDIFF(NOW(),MAX(a.data_visita)) AS dias_visita, a.cliente AS id_cliente, 
							b.cliente, b.rota, b.cidade, b.uf, b.novo 
							FROM diario_contato a, geral_clientes b
							WHERE 
							date_format(a.data_visita, '%Y-%m-%d') BETWEEN '$filtro_data1' AND '$filtro_data2' AND
							a.usuario='$filtro_repre' AND a.cliente=b.id" . $sql_rota . "
							GROUP BY b.cliente
							ORDER BY MAX(a.data_visita), b.rota, b.uf, b.cidade, b.cliente") or die (mysqli_error());
$conta_diario = mysqli_num_rows ($con_diario);
?>

<div class="well">
<div class="row">
	<div class="col-sm-3">
		<strong>DATA INICIAL</strong> <br> <?php echo $data_inicial; ?> - <?php echo $data_final; ?> <br class="visible-xs"><br class="visible-xs">
	</div>
    <div class="col-sm-3">
		<strong>REPRESENTANTE</strong> <br> <?php echo nome_representante($filtro_repre, $conexao); ?> <br class="visible-xs"><br class="visible-xs">
	</div>
    <div class="col-sm-3">
		<strong>ROTA</strong> <br> <?php echo $desc_rota; ?> <br class="visible-xs"><br class="visible-xs">
	</div>
    <div class="col-sm-3">
		<strong>TOTAL DE CLIENTES</strong> <br> <?php echo $conta_diario; ?> <span class="text-muted"><?php echo $texto_novos; ?></span>
	</div>
</div>
</div>

<div class="row">
	<div class="col-sm-12">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php
			while ($dados_diario = mysqli_fetch_array ($con_diario)) {
				$d_data_visita 	= $dados_diario['data_visita'];
				$d_dias_visita 	= $dados_diario['dias_visita'];
				$d_id_cliente 	= $dados_diario['id_cliente'];
				$d_cliente 		= $dados_diario['cliente'];
				$d_rota 		= $dados_diario['rota'];
				$d_cidade 		= $dados_diario['cidade'];
				$d_uf 			= $dados_diario['uf'];
				$d_novo 		= $dados_diario['novo'];
				
				$d_data_visita = date('d/m/Y', strtotime($d_data_visita));
				
				if ($d_dias_visita == 0 || $d_dias_visita == 1) { $txt_dias = "dia"; } else { $txt_dias = "dias"; }
				
				// Verifica as visitas deste cliente
				$con_visitas = mysqli_query ($conexao, "SELECT data_visita, tipo, status FROM diario_contato
											 WHERE 
											 date_format(data_visita, '%Y-%m-%d') BETWEEN '$filtro_data1' AND '$filtro_data2' AND
											 usuario='$filtro_repre' AND cliente='$d_id_cliente'
											 ORDER BY data_visita DESC") or die (mysqli_error());
				$conta_visitas = mysqli_num_rows ($con_visitas);
			?>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="Cab<?php echo $d_id_cliente; ?>">
                    <div class="row">
                    	<div class="col-xs-1 col-sm-1">
                    		<?php if ($conta_visitas > 1) { ?>
                            <a class="collapsed btn btn-success btn-xs" role="button" data-toggle="collapse" data-parent="#accordion" href="#Reg<?php echo $d_id_cliente; ?>" aria-expanded="false" aria-controls="Reg<?php echo $d_id_cliente; ?>"><i class="fas fa-plus-square"></i></a>
                            <?php } else { ?>
                            <button class="btn btn-default btn-xs disabled"><i class="fas fa-plus-square"></i></button>
                            <?php } ?>
                    	</div>
                        <div class="col-xs-3 col-sm-1">
                        	<strong><?php echo $d_data_visita; ?></strong>
                        </div>
                        <div class="col-xs-5 col-sm-8">
                        	<?php echo $d_cliente; ?>
                            <br>
                            <small class="text-muted">(<?php echo $d_rota; ?>) <?php echo $d_cidade; ?>/<?php echo $d_uf; ?></small>
                        </div>
                        <div class="col-xs-1 col-sm-1 text-right">
                        	<span class="label label-default"><?php echo $conta_visitas; ?></span>
                        </div>
                        <div class="col-xs-1 col-sm-1 text-right">
                        	<span class="text-muted"><?php echo $d_dias_visita." ".$txt_dias; ?></span>
                        </div>
                    </div>
                </div>
                <?php if ($conta_visitas > 1) { ?>
                <div id="Reg<?php echo $d_id_cliente; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="Cab<?php echo $d_id_cliente; ?>">
                    <div class="panel-body">
                        <div class="table-responsive">
                        	<table class="table table-striped table-condensed">
                            	<thead>
                                	<tr>
                                    	<th>DATA VISITA</th>
                                        <th>TIPO CONTATO</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
									while ($d_visitas = mysqli_fetch_array ($con_visitas)) {
										$v_data 	= $d_visitas['data_visita'];
										$v_tipo 	= $d_visitas['tipo'];
										$v_status 	= $d_visitas['status'];
										
										$v_data = date('d/m/Y', strtotime($v_data));
										
										switch ($v_tipo) {
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
										
										switch ($v_status) {
											case "P";
												$v_txt = "PENDENTE";
												$v_cor = "text-danger";
												break;
											case "R";
												$v_txt = "RESPONDIDO";
												$v_cor = "text-success";
												break;
											case "G";
												$v_txt = "RESPONDIDO";
												$v_cor = "text-success";
												break;
											default:
												$v_txt = "";
												$v_cor = "";
										}
									?>
                                    <tr class="<?php echo $v_cor; ?>">
                                    	<td><strong><?php echo $v_data; ?></strong></td>
                                        <td><i class="<?php echo $t_img; ?>"></i> <?php echo $t_txt; ?></td>
                                        <td><?php echo $v_txt; ?></td>
                                    </tr>
                                    <?php
									}
									?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php
			}
			?>
        </div>
    </div>
</div>
<?php
}
?>

<?php } // Permissão para acessar a página ?>

<hr>

<?php include_once ("includes/rodape.php"); ?>

</div>

<?php include_once ("includes/scripts.php"); ?>

</body>

</html>
<?php require_once ("funcoes/_conexao.php"); ?>

<?php require_once ("funcoes/_login_confirmacao.php"); ?>

<?php require_once ("funcoes/_funcoes_geral.php"); ?>

<?php require_once ("includes/_sessao_login.php"); ?>

<?php require_once("includes/layout_cabecalho.php"); ?>

<div id="wrapper">

    <?php require_once("includes/layout_menu_lateral.php"); ?>

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <?php require_once("includes/layout_barra_topo.php"); ?>

            <div class="container-fluid">

                <?php include "includes/msgs.php"; ?>

                <?php include "includes/senha_padrao.php"; ?>

                <h1>Solicitações</h1>

                <?php
                if ($_GET['t'] === "p") {
                    $sql_consulta = "SELECT id, data, codigo, usuario, setor, assunto, prioridade, prazo, status FROM gc_solicitacoes WHERE status IN ('P','D','L','I','A','O') ORDER BY prioridade, data DESC";
                    $titulo_box = "Solicitações Pendentes";
                }
                if ($_GET['t'] === "f") {
                    $sql_consulta = "SELECT id, data, codigo, usuario, setor, assunto, prioridade, prazo, status FROM gc_solicitacoes WHERE status IN ('C','X') ORDER BY prioridade, data DESC";
                    $titulo_box = "Solicitações Finalizadas";
                }
                ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold"><?php echo $titulo_box; ?></h6>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover" id="dataTableSolicitacoes" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>DATA</th>
                                            <th>PRIORIDADE</th>
                                            <th>SETOR</th>
                                            <th>ASSUNTO</th>
                                            <th>REQUERENTE</th>
                                            <th>PRAZO</th>
                                            <th>STATUS</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>DATA</th>
                                            <th>PRIORIDADE</th>
                                            <th>SETOR</th>
                                            <th>ASSUNTO</th>
                                            <th>REQUERENTE</th>
                                            <th>PRAZO</th>
                                            <th>STATUS</th>
                                            <th></th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php
                                        $consulta = mysqli_query($conn, $sql_consulta) or die (mysqli_error($conn));

                                        while ($linha = mysqli_fetch_array($consulta)) {

                                            // LIDO
                                            if (!verificaLido($linha['id'], $idUsuario)) {
                                                $f_lido = "naolido";
                                            }
                                            else {
                                                $f_lido = "";
                                            }

                                            // PRAZO DE ENTREGA
                                            $status_pendentes = array("P","D","L","I","O");

                                            if (in_array($linha['status'], $status_pendentes)) {
                                                if ($linha['prazo'] != NULL && $linha['prazo'] < date("Y-m-d")) {
                                                    $ico_prazo = "<a href=\"#\" data-toggle=\"tooltip\" title=\"Solicitação com prazo de entrega vencido\"><span class=\"text-danger\"><i class=\"fas fa-exclamation-triangle\"></i></span></a>";
                                                }
                                                else {
                                                    $ico_prazo = "";
                                                }
                                            }
                                            else {
                                                $ico_prazo = "";
                                            }

                                            // STATUS
                                            if ($linha['status'] === "A") {
                                                $ico_status = "<a href=\"#\" data-toggle=\"tooltip\" title=\"Aguardando aprovação do requerente\"><span class=\"text-warning\"><i class=\"fas fa-exclamation-circle\"></i></span></a>";
                                            }
                                            elseif ($linha['status'] === "L") {
                                                $ico_status = "<a href=\"#\" data-toggle=\"tooltip\" title=\"Verificar internamente a resolução desta solicitação\"><span class=\"text-info\"><i class=\"fas fa-exclamation-circle\"></i></span></a>";
                                            }
                                            else {
                                                $ico_status = "";
                                            }
                                            ?>
                                            <tr id="<?php echo $f_lido; ?>">
                                                <td class="text-muted"><?php echo nID($linha['id']); ?></td>
                                                <td class="text-muted"><?php echo date('d/m/y', strtotime($linha['data'])); ?></td>
                                                <td class="text-<?php echo corPrioridade($linha['prioridade']); ?>"><i class="<?php echo icoPrioridade($linha['prioridade']); ?>"></i> <?php echo nomePrioridade($linha['prioridade']); ?></td>
                                                <td><?php echo nomeSetorId($linha['setor']); ?></td>
                                                <td><?php echo $linha['assunto']; ?></td>
                                                <td class="text-muted"><?php echo nomeUsuarioId($linha['usuario']); ?></td>
                                                <td><?php if ($linha['prazo'] != NULL) { echo date('d/m/y', strtotime($linha['prazo'])) . " " . $ico_prazo; } ?></td>
                                                <td><?php echo txtStatus($linha['status']) . " " . $ico_status; ?></td>
                                                <td class="col-btn">
                                                    <a href="solicitacoes-ver.php?c=<?php echo $linha['codigo']; ?>" class="btn btn-xs btn-secondary btn-block"><i class="fas fa-search"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <?php require_once("includes/layout_rodape.php"); ?>

    </div>

</div>

<?php require_once("includes/modais.php"); ?>

<?php require_once("includes/scripts.php"); ?>

</body>

</html>
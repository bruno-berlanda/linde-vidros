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

                <h1>Visualizar Solicitação</h1>

                <?php
                $cod = $_GET['c'];

                $consulta = mysqli_query ($conn, "SELECT * FROM gc_solicitacoes WHERE codigo='$cod'") or die (mysqli_error($conn));
                $dados = mysqli_fetch_array ($consulta);

                // ID da Solicitação
                $id_solicitacao = idSolicitacaoCod($cod);

                // Permissão para interagir na solicitação
                // Admin (A) - Diretor (D) - GlassControl (G)
                if ($tipoUsuario === "A" || $tipoUsuario === "D" || $tipoUsuario === "S" || $tipoUsuario === "G") {
                    $permissao_interacao = true;
                }
                else {
                    // Requerente da solicitação
                    if ($dados['usuario'] === $idUsuario) {
                        $permissao_interacao = true;
                    }
                    // Outros usuários
                    else {
                        $permissao_interacao = false;
                    }
                }

                // Marca como LIDO
                marcarLido($id_solicitacao, $idUsuario);
                ?>

                <div class="row">
                    <div class="col-12 col-xl-5">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold" id="n_id">#<?php echo nID($dados['id']); ?></h6>
                            </div>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <small class="text-muted">DATA</small>
                                    <br>
                                    <?php echo date('d/m/Y H:i', strtotime($dados['data'])); ?>
                                </li>
                                <li class="list-group-item">
                                    <small class="text-muted">REQUERENTE</small>
                                    <br>
                                    <?php echo nomeUsuarioId($dados['usuario']); ?>
                                </li>
                                <li class="list-group-item">
                                    <small class="text-muted">ASSUNTO</small>
                                    <br>
                                    <strong class="text-<?php echo corPrioridade($dados['prioridade']); ?>"><?php echo $dados['assunto']; ?></strong>
                                </li>
                                <li class="list-group-item">
                                    <small class="text-muted">DESCRIÇÃO</small>
                                    <br>
                                    <strong><?php echo nl2br($dados['descricao']); ?></strong>
                                </li>
                                <li class="list-group-item">
                                    <small class="text-muted">PRIORIDADE</small>
                                    <br>
                                    <span class="text-<?php echo corPrioridade($dados['prioridade']); ?>"><i class="<?php echo icoPrioridade($dados['prioridade']); ?>"></i> <?php echo nomePrioridade($dados['prioridade']); ?></span>
                                </li>
                                <li class="list-group-item">
                                    <small class="text-muted">PRAZO</small>
                                    <br>
                                    <?php if ($dados['prazo'] != NULL) { echo date('d/m/Y', strtotime($dados['prazo'])); } else { echo "-"; } ?>
                                </li>
                                <li class="list-group-item">
                                    <small class="text-muted">STATUS</small>
                                    <br>
                                    <?php echo txtStatus($dados['status']); ?>
                                </li>
                                <li class="list-group-item">
                                    <small class="text-muted">TICKET GLASSCONTROL</small>
                                    <br>
                                    <?php if ($dados['ticket'] != 0) { echo $dados['ticket']; } else { echo "-"; } ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="resposta-tab" data-toggle="tab" href="#resposta" role="tab" aria-controls="resposta" aria-selected="true">
                                    <i class="far fa-comment-dots fa-lg"></i> <?php echo pnomeUsuarioId($idUsuario); ?>
                                </a>
                            </li>
                            <?php if ($tipoUsuario === "G" && $dados['prazo'] != NULL && $dados['status'] === "D") { ?>
                            <li class="nav-item">
                                <a class="nav-link" id="prazo-tab" data-toggle="tab" href="#prazo" role="tab" aria-controls="prazo" aria-selected="false">
                                    <i class="far fa-calendar-alt fa-lg"></i> ALTERAR PRAZO
                                </a>
                            </li>
                            <?php } ?>
                            <?php if ($tipoUsuario === "A") { ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="ticket-tab" data-toggle="tab" href="#ticket" role="tab" aria-controls="ticket" aria-selected="false">
                                        <i class="fas fa-bolt fa-lg"></i> TICKET
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status" aria-selected="false">
                                        <i class="fas fa-toggle-off fa-lg"></i> STATUS
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="resposta" role="tabpanel" aria-labelledby="resposta-tab">
                                <form method="post" action="funcoes/solicitacoes.php?funcao=resposta&c=<?php echo $cod; ?>">
                                    <fieldset<?php if ($dados['status'] === "C" || $dados['status'] === "X" || !$permissao_interacao) { echo " disabled"; } ?>>
                                        <div class="form-row">
                                            <div class="form-group col-12">
                                                <label class="col-form-label col-form-label-sm" for="textDescricao">Descrição</label>
                                                <textarea name="descricao" class="form-control form-control-sm" id="textDescricao" rows="8" autocomplete="off" required></textarea>
                                            </div>
                                        </div>
                                        <?php
                                        // GLASSCONTROL - Permissão para alterar o prazo de entrega
                                        if ($tipoUsuario === "G" && $dados['prazo'] == NULL) {
                                        ?>
                                        <div class="form-row">
                                            <div class="form-group col-12 col-sm-4">
                                                <label class="col-form-label col-form-label-sm" for="inputPrazo">Prazo</label>
                                                <input type="date" name="prazo" class="form-control form-control-sm" id="inputPrazo" min="<?php echo date("Y-m-d"); ?>">
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php
                                        // GLASSCONTROL - Solicitar para que seja efetuado teste/aprovação
                                        if ($tipoUsuario === "G" && $dados['status'] === "D") {
                                        ?>
                                        <div class="form-row">
                                            <div class="form-group col-12">
                                                <div class="custom-control custom-switch mb-2">
                                                    <input type="checkbox" name="teste" value="S" class="custom-control-input" id="checkTeste"<?php if ($dados['status'] === "A") { echo " checked"; } ?>>
                                                    <label class="custom-control-label" for="checkTeste">Solicitar Teste/Aprovação</label>
                                                    <small class="form-text text-muted">Marque essa opção, caso a solicitação esteja concluída e necessite do teste e aprovação.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>

                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Salvar</button>
                                    </fieldset>
                                </form>
                            </div>
                            <?php if ($tipoUsuario === "G" && $dados['prazo'] != NULL && $dados['status'] === "D") { ?>
                            <div class="tab-pane fade" id="prazo" role="tabpanel" aria-labelledby="prazo-tab">
                                <form method="post" action="funcoes/solicitacoes.php?funcao=alterar_prazo&c=<?php echo $cod; ?>">
                                    <fieldset>
                                        <div class="form-row">
                                            <div class="form-group col-12 col-sm-4">
                                                <label class="col-form-label col-form-label-sm" for="inputNovoPrazo">Novo Prazo</label>
                                                <input type="date" name="prazo" class="form-control form-control-sm" id="inputNovoPrazo" required min="<?php echo date("Y-m-d"); ?>" value="<?php echo $dados['prazo']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-12">
                                                <label class="col-form-label col-form-label-sm" for="inputMotivo">Motivo</label>
                                                <input type="text" name="motivo" class="form-control form-control-sm" id="inputMotivo" required autocomplete="off">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Salvar</button>
                                    </fieldset>
                                </form>
                            </div>
                            <?php } ?>
                            <?php if ($tipoUsuario === "A") { ?>
                                <div class="tab-pane fade" id="ticket" role="tabpanel" aria-labelledby="ticket-tab">
                                    <form method="post" action="funcoes/solicitacoes.php?funcao=ticket&c=<?php echo $cod; ?>">
                                        <fieldset>
                                            <div class="form-row">
                                                <div class="form-group col-12 col-sm-4">
                                                    <label class="col-form-label col-form-label-sm" for="inputTicket">Atualizar Ticket</label>
                                                    <input type="text" name="ticket" class="form-control form-control-sm" id="inputTicket" maxlength="5" required autocomplete="off" value="<?php echo $dados['ticket']; ?>">
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Salvar</button>
                                        </fieldset>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="status" role="tabpanel" aria-labelledby="status-tab">
                                    <form method="post" action="funcoes/solicitacoes.php?funcao=status&c=<?php echo $cod; ?>">
                                        <fieldset>
                                            <div class="form-row">
                                                <div class="form-group col-12 col-sm-5">
                                                    <label class="col-form-label col-form-label-sm" for="selectStatus">Atualizar Status</label>
                                                    <select name="status" class="form-control form-control-sm" id="selectStatus" required>
                                                        <option value="P"<?php if ($dados['status'] === "P") { echo " selected"; } ?>>PENDENTE</option>
                                                        <option value="X"<?php if ($dados['status'] === "X") { echo " selected"; } ?>>CANCELADA</option>
                                                        <option value="D"<?php if ($dados['status'] === "D") { echo " selected"; } ?>>EM DESENVOLVIMENTO</option>
                                                        <option value="L"<?php if ($dados['status'] === "L") { echo " selected"; } ?>>RESOLUÇÃO INTERNA</option>
                                                        <option value="I"<?php if ($dados['status'] === "I") { echo " selected"; } ?>>AGUARDANDO IMPLANTAÇÃO</option>
                                                        <option value="A"<?php if ($dados['status'] === "A") { echo " selected"; } ?>>AGUARDANDO APROVAÇÃO</option>
                                                        <option value="C"<?php if ($dados['status'] === "C") { echo " selected"; } ?>>CONCLUÍDO</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Salvar</button>
                                        </fieldset>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>

                        <hr>

                        <?php
                        $con_respostas = mysqli_query ($conn, "SELECT id, data AS data_resposta, usuario, descricao, tipo FROM gc_solicitacoes_msgs WHERE id_solicitacao='$id_solicitacao' UNION SELECT id, data AS data_resposta, usuario, motivo AS descricao, tipo FROM gc_solicitacoes_prazos WHERE id_solicitacao='$id_solicitacao' ORDER BY data_resposta DESC") or die (mysqli_error($conn));
                        $conta_respostas = mysqli_num_rows ($con_respostas);

                        if ($conta_respostas == 0) {
                            ?>
                            <div class="alert alert-warning" role="alert">
                                <i class="fas fa-exclamation-triangle fa-lg"></i>
                                Não há retorno para esta solicitação até o momento.
                            </div>
                            <?php
                        } else {
                            while ($d_respostas = mysqli_fetch_array ($con_respostas)) {

                                // TIPO DE RESPOSTA - MENSAGEM
                                if ($d_respostas['tipo'] === "M") {
                                    // TIPO DE USUÁRIO - GLASSCONTROL
                                    if (tipoUsuarioId($d_respostas['usuario']) === "G") {
                                        $cor_card = "border-warning";
                                        $cor_header = "bg-light";
                                        $ico_resposta = "fas fa-comment-dots";
                                    }
                                    // TIPO DE USUÁRIO - LINDE
                                    else {
                                        $cor_card = "border-primary";
                                        $cor_header = "bg-light";
                                        $ico_resposta = "fas fa-comment-dots";
                                    }
                                }
                                // TIPO DE RESPOSTA - PRAZO
                                else {
                                    $cor_card = "border-danger";
                                    $cor_header = "bg-danger text-white";
                                    $ico_resposta = "fas fa-calendar-alt";
                                }
                                ?>
                                <div class="card mb-2 <?php echo $cor_card; ?>">
                                    <div class="card-header <?php echo $cor_header; ?>">
                                        <i class="<?php echo $ico_resposta; ?>"></i> <small><?php echo date('d/m/y H:i', strtotime($d_respostas['data_resposta'])) . " - " . nomeUsuarioId($d_respostas['usuario']); ?></small>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            <?php
                                            if ($d_respostas['tipo'] === "P") {
                                            ?>
                                                <small><strong>ALTERAÇÃO NO PRAZO</strong></small>
                                                <br>
                                                <span class="text-danger"><?php echo date('d/m/Y', strtotime(prazoAnterior($d_respostas['id']))); ?></span> <i class="fas fa-arrow-right"></i> <strong class="text-danger"><?php echo date('d/m/Y', strtotime(prazoNovo($d_respostas['id']))); ?></strong>
                                                <br><br>
                                                <?php
                                            }
                                            ?>
                                            <?php echo nl2br($d_respostas['descricao']); ?>
                                        </p>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
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
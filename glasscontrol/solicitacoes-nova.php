<?php require_once ("funcoes/_conexao.php"); ?>

<?php require_once ("funcoes/_login_confirmacao.php"); ?>

<?php require_once ("funcoes/_funcoes_geral.php"); ?>

<?php require_once ("includes/_sessao_login.php"); ?>

<?php
/**
 * PERMISSÃO PARA ACESSAR A PÁGINA
 */
if ($tipoUsuario === "A" || $tipoUsuario === "D" || $tipoUsuario === "T" || $tipoUsuario === "S") {
?>

<?php require_once("includes/layout_cabecalho.php"); ?>

<div id="wrapper">

    <?php require_once("includes/layout_menu_lateral.php"); ?>

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <?php require_once("includes/layout_barra_topo.php"); ?>

            <div class="container-fluid">

                <?php include "includes/msgs.php"; ?>

                <?php include "includes/senha_padrao.php"; ?>

                <h1>Nova Solicitação</h1>

                <div class="row">
                    <div class="col-xl-6">
                        <form method="post" action="funcoes/solicitacoes.php?funcao=novo" enctype="multipart/form-data">
                            <fieldset>
                                <div class="form-row">
                                    <div class="form-group col-12 col-sm-8">
                                        <label class="col-form-label col-form-label-sm" for="selectSetor">Setor</label>
                                        <select name="setor" class="form-control form-control-sm" id="selectSetor" required>
                                            <option></option>
                                            <?php
                                            $con_setores = mysqli_query ($conn, "SELECT id, setor FROM gc_setores WHERE ativo='S' ORDER BY setor") or die (mysqli_error($conn));
                                            while ($d_setor = mysqli_fetch_array($con_setores)) {
                                                ?>
                                                <option value="<?php echo $d_setor['id']; ?>"><?php echo $d_setor['setor']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label class="col-form-label col-form-label-sm" for="inputAssunto">Assunto</label>
                                        <input type="text" name="assunto" class="form-control form-control-sm" id="inputAssunto" required maxlength="45" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label class="col-form-label col-form-label-sm" for="textDescricao">Descrição</label>
                                        <textarea name="descricao" class="form-control form-control-sm" id="textDescricao" rows="8" autocomplete="off" required></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 col-sm-4">
                                        <label class="col-form-label col-form-label-sm" for="selectPrioridade">Prioridade</label>
                                        <select name="prioridade" class="form-control form-control-sm" id="selectPrioridade" required>
                                            <option></option>
                                            <option value="1">URGENTE</option>
                                            <option value="2">ALTA</option>
                                            <option value="3">MÉDIA</option>
                                            <option value="4">BAIXA</option>
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-row">
                                    <div class="form-group col-12 mb-1">
                                        <input type="file" name="arquivos[]" multiple class="custom-file-input" id="inputAnexo" accept="image/*,.pdf,.xls,.xlsx,.doc,.docx,.ppt,.pptx,.pps,.ppsx,.txt">
                                        <label class="custom-file-label form-control-sm" for="inputAnexos" data-browse="Anexos">Selecione os arquivos</label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-row">
                                    <div class="form-group col-5">
                                        <label class="col-form-label col-form-label-sm" for="inputTicket">Ticket GlassControl</label>
                                        <input type="number" name="ticket" class="form-control form-control-sm" id="inputTicket" maxlength="5" autocomplete="off">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Salvar</button>
                            </fieldset>
                        </form>
                    </div>
                </div>

            </div>

        </div>

        <?php require_once("includes/layout_rodape.php"); ?>

    </div>

</div>

<?php require_once("includes/modais.php"); ?>

<?php require_once("includes/scripts.php"); ?>

<?php
/**
 * PERMISSÃO PARA ACESSAR A PÁGINA
 */
}
else {

    header ('Location: _erro_permissao.php');

}
?>

</body>

</html>
<?php require_once ("funcoes/_conexao.php"); ?>

<?php require_once ("funcoes/_login_confirmacao.php"); ?>

<?php require_once ("funcoes/_funcoes_geral.php"); ?>

<?php require_once ("includes/_sessao_login.php"); ?>

<?php
/**
 * PERMISSÃO PARA ACESSAR A PÁGINA
 * Somente permissão para (A) Administradores
 */
if ($tipoUsuario === "A") {
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

                <h1>Setores</h1>

                <div class="row">
                    <div class="col-xl-6">
                    <?php
                    /**
                     * CADASTRAR
                     */
                    if (!isset($_GET['editar'])) {
                    ?>
                        <form method="post" action="funcoes/admin_setores.php?funcao=cadastrar">
                            <fieldset>
                                <div class="form-row">
                                    <div class="form-group col-12 col-sm-8">
                                        <label class="col-form-label col-form-label-sm" for="inputNome">Nome</label>
                                        <input type="text" name="nome" class="form-control form-control-sm" id="inputNome" maxlength="50" required autocomplete="off" autofocus>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Salvar</button>
                            </fieldset>
                        </form>
                    <?php
                    } else {
                    /**
                     * EDITAR
                     */

                    $id_editar = $_GET['editar'];

                    $con_editar = mysqli_query ($conn, "SELECT id, setor 
                                                               FROM gc_setores 
                                                               WHERE id='$id_editar'") or die (mysqli_error($conn));
                    $d_editar = mysqli_fetch_array ($con_editar);
                    ?>
                        <form method="post" action="funcoes/admin_setores.php?funcao=editar&i=<?php echo $d_editar['id']; ?>">
                            <fieldset>
                                <div class="form-row">
                                    <div class="form-group col-12 col-sm-8">
                                        <label class="col-form-label col-form-label-sm" for="inputNome">Nome</label>
                                        <input type="text" name="nome" class="form-control form-control-sm" id="inputNome" maxlength="50" required autocomplete="off" autofocus value="<?php echo $d_editar['setor']; ?>">
                                    </div>
                                </div>

                                <input type="hidden" name="setor_atual" value="<?php echo $d_editar['setor']; ?>">

                                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Salvar</button>
                                <a href="cadastro-setores.php" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> Cancelar</a>
                            </fieldset>
                        </form>
                    <?php
                    }
                    ?>
                    </div>
                    <div class="col-xl-6">
                        <hr class="d-xl-none">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold">Setores Cadastrados</h6>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover" id="dataTableSetores" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>NOME</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>NOME</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php
                                        $consulta = mysqli_query($conn, "SELECT id, setor 
                                                                                FROM gc_setores
                                                                                ORDER BY setor") or die (mysqli_error($conn));

                                        while ($linha = mysqli_fetch_array($consulta)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $linha['setor']; ?></td>
                                                <td class="col-btn">
                                                    <a href="cadastro-setores.php?editar=<?php echo $linha['id']; ?>" class="btn btn-xs btn-warning btn-block"><i class="fas fa-pencil-alt"></i></a>
                                                </td>
                                                <td class="col-btn">
                                                    <a href="funcoes/admin_setores.php?funcao=excluir&i=<?php echo $linha['id']; ?>" class="btn btn-xs btn-danger btn-block" onClick="return confirm('Tem certeza que deseja excluir o usuário <?php echo $linha['nome']; ?>?')"><i class="fas fa-trash-alt"></i></a>
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
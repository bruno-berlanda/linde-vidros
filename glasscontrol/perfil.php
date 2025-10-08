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

                <h1>Meu Perfil</h1>

                <div class="row">
                    <div class="col-xl-6">
                        <form method="post" action="funcoes/perfil.php?funcao=senha&i=<?php echo $loginUsuarioLogado; ?>">
                            <fieldset>
                                <p class="font-weight-bold text-secondary">ALTERAR MINHA SENHA</p>

                                <div class="form-row">
                                    <div class="form-group col-5">
                                        <label class="col-form-label col-form-label-sm" for="inputSenha1">Senha atual</label>
                                        <input type="password" name="senha_atual" class="form-control form-control-sm" id="inputSenha1" maxlength="10" required autocomplete="off" autofocus>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-row">
                                    <div class="form-group col-5">
                                        <label class="col-form-label col-form-label-sm" for="inputSenha2">Nova senha</label>
                                        <input type="password" name="senha1" class="form-control form-control-sm" id="inputSenha2" maxlength="10" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-5">
                                        <label class="col-form-label col-form-label-sm" for="inputSenha3">Confirmar senha</label>
                                        <input type="password" name="senha2" class="form-control form-control-sm" id="inputSenha3" maxlength="10" required autocomplete="off">
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

</body>

</html>
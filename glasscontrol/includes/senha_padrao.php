<?php
/**
 * Created by PhpStorm.
 * User: ti01
 * Date: 25/09/2020
 * Time: 17:03
 */

if ($dUsuario['senha_padrao'] === "S") {
    ?>
    <div class="jumbotron" id="senha-padrao">
        <h1 class="display-4">Altere sua senha!</h1>
        <p class="lead">Você está utilizando a senha padrão do sistema. <strong>Para sua segurança, altere a senha agora mesmo</strong>.</p>

        <hr class="my-4">
        <div id="box-senha-padrao">
            <form method="post" action="funcoes/config_usuario.php?funcao=alterarSenha">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputNovaSenha1">Nova senha</label>
                        <input type="password" name="senha1" class="form-control form-control" id="inputNovaSenha1" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputNovaSenha2">Confirmação da senha</label>
                        <input type="password" name="senha2" class="form-control" id="inputNovaSenha2" required>
                    </div>
                </div>

                <input type="hidden" name="cod_usuario" value="<?php echo $dUsuario['codigo']; ?>">
                <input type="hidden" name="url_atual" value="<?php echo getUrl(); ?>">

                <button type="submit" class="btn btn-lg btn-outline-light"><i class="fas fa-save"></i> Atualizar senha</button>
            </form>
        </div>
    </div>
    <?php
}
?>
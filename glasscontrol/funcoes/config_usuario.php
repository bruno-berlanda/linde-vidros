<?php
/**
 * Created by PhpStorm.
 * User: Bruno Berlanda
 * Date: 06/05/2020
 * Time: 09:40
 */

require_once ("_conexao.php");

require_once ("_login_confirmacao.php");

require_once ("../includes/usuario_logado.php");

/**
 * ALTERAR SENHA
 */
if ($_GET['funcao'] === "alterarSenha" && isset($_SESSION['loginSysLG'])) {

    // Código do usuário
    $cod_usuario = $_POST['cod_usuario'];

    // URL da página que o usuário estava
    $url_atual = $_POST['url_atual'];

    $url_retorno = end(explode("/", $url_atual));

    /* *** */

    $con_senha_atual = mysqli_query ($conn, "SELECT senha FROM gc_usuarios WHERE codigo='$cod_usuario'") or die (mysqli_error($conn));
        $d_senha_atual = mysqli_fetch_array ($con_senha_atual);

    $senha1 = sha1(strip_tags(trim($_POST['senha1'])));
    $senha2 = sha1(strip_tags(trim($_POST['senha2'])));

    if ($senha1 !== $senha2) {

        header ('Location: ../'.$url_retorno.'?msgErro=As senhas digitadas não conferem. Tente novamente.');

    }
    else {

        if ($d_senha_atual['senha'] === $senha1) {

            header ('Location: ../'.$url_retorno.'?msgErro=Você não pode usar a mesma senha que a atual. Escolha outra senha e tente novamente.');

        }
        else {

            $sql = "UPDATE gc_usuarios SET senha='$senha1', senha_padrao='N' WHERE codigo='$cod_usuario'";

            $atu = mysqli_query ($conn, $sql) or die (mysqli_error($conn));

            header ('Location: ../'.$url_retorno.'?msgSucesso=Senha atualizada com sucesso.');

        }

    }

}
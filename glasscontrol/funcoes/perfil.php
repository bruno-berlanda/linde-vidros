<?php
/**
 * Created by PhpStorm.
 * User: Bruno Berlanda
 * Date: 18/06/2020
 * Time: 17:20
 */

require_once ("_conexao.php");

require_once ("_login_confirmacao.php");

require_once ("../includes/usuario_logado.php");

require_once ("_funcoes_geral.php");

/**
 * CADASTRAR
 */
if ($_GET['funcao'] === "senha" && isset($_SESSION['loginSysLG'])) {

    $usuario = $_GET['i'];

    // Dados do formulário
    $senha_atual = sha1(strip_tags(trim($_POST['senha_atual'])));
    $senha1 = sha1(strip_tags(trim($_POST['senha1'])));
    $senha2 = sha1(strip_tags(trim($_POST['senha2'])));

    /* *** */

    if ($dUsuario['senha'] !== $senha_atual) {

        header ('Location: ../perfil.php?msgErro=Digite sua senha atual para alterar a sua senha.');

    }
    else {

        if ($senha1 !== $senha2) {

            header ('Location: ../perfil.php?msgErro=A nova senha não pode ser confirmada.');

        }
        else {

            $sql = "UPDATE gc_usuarios SET senha='$senha1' WHERE usuario='$usuario'";

            $atu = mysqli_query ($conn, $sql) or die (mysqli_error($conn));

            header ('Location: ../perfil.php?msgSucesso=Sua senha foi alterada com sucesso.');

        }

    }



}
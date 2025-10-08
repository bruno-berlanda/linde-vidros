<?php
/**
 * Created by PhpStorm.
 * User: Bruno Berlanda
 * Date: 24/09/2020
 * Time: 15:41
 */

require_once ("_conexao.php");

require_once ("_login_confirmacao.php");

require_once ("../includes/usuario_logado.php");

require_once ("_funcoes_geral.php");

/**
 * CADASTRAR
 */
if ($_GET['funcao'] === "cadastrar" && $tipoUsuario === "A" && isset($_SESSION['loginSysLG'])) {

    // Dados do formulário
    $nome = textoMaiusc(strip_tags(trim($_POST['nome'])));

    /* *** */

    $consulta = mysqli_query ($conn, "SELECT id FROM gc_setores WHERE setor='$nome'")or die (mysqli_error($conn));

    if (mysqli_num_rows($consulta) > 0) {
        header ('Location: ../cadastro-setores.php?msgErro=Setor já cadastrado.');
    }
    else {
        $codigo = sha1(time());

        $sql = "INSERT INTO gc_setores (setor) VALUES ('$nome')";

        $cad = mysqli_query ($conn, $sql) or die (mysqli_error($conn));

        header ('Location: ../cadastro-setores.php?msgSucesso=Setor cadastrado com sucesso.');
    }

}

/**
 * EDITAR
 */
if ($_GET['funcao'] === "editar" && $tipoUsuario === "A" && isset($_SESSION['loginSysLG'])) {

    $id = $_GET['i'];

    // Dados do formulário
    $nome = textoMaiusc(strip_tags(trim($_POST['nome'])));

    /* *** */

    $consulta = mysqli_query ($conn, "SELECT id FROM gc_setores WHERE setor='$nome'")or die (mysqli_error($conn));

    if (mysqli_num_rows($consulta) > 0 && $_POST['setor_atual'] != $nome) {
        header ('Location: ../cadastro-setores.php?editar='.$id.'&msgErro=Setor já cadastrado.');
    }
    else {
        $codigo = sha1(time());

        $sql = "UPDATE gc_setores SET setor='$nome' WHERE id='$id'";

        $cad = mysqli_query ($conn, $sql) or die (mysqli_error($conn));

        header ('Location: ../cadastro-setores.php?msgSucesso=Setor cadastrado com sucesso.');
    }

}

/**
 * EXCLUIR
 */
if ($_GET['funcao'] === "excluir" && $tipoUsuario === "A" && isset($_SESSION['loginSysLG'])) {

    $id = $_GET['i'];

    $sql = "UPDATE gc_setores SET ativo='N' WHERE id='$id'";

    $cad = mysqli_query ($conn, $sql) or die (mysqli_error($conn));

    header ('Location: ../cadastro-setores.php?msgSucesso=Setor excluído com sucesso.');

}
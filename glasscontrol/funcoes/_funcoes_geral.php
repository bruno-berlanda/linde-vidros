<?php
/**
 * Created by PhpStorm.
 * User: Bruno Berlanda
 * Date: 18/06/2020
 * Time: 14:25
 */

/**
 * PEGA A URL ATUAL
 * @return string
 */
function getUrl() {
    return strtolower(preg_replace('/[^a-zA-Z]/','',$_SERVER['SERVER_PROTOCOL'])).'://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
}

/**
 * CONVERTE TEXTO PARA MAIÚSCULO
 * @param $stg
 * @return string
 */
function textoMaiusc($stg) {
    return strtr(strtoupper($stg),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
}

/**
 * FORMATA O ID DA REQUISIÇÃO
 * @param $id
 * @return string
 */
function nID ($id) {
    return str_pad($id, 5, "0", STR_PAD_LEFT);
}

/**
 * ID DA SOLICITAÇÃO PELO CÓDIGO
 * @param $cod
 * @return mixed
 */
function idSolicitacaoCod($cod) {
    global $conn;

    $c = mysqli_query ($conn, "SELECT id FROM gc_solicitacoes WHERE codigo='$cod'") or die (mysqli_error($conn));
    $d = mysqli_fetch_array ($c);

    return $d['id'];
}

/**
 * REQUERENTE DA SOLICITAÇÃO PELO ID
 * @param $id
 * @return mixed
 */
function nomeRequerenteId($id) {
    global $conn;

    $c = mysqli_query ($conn, "SELECT usuario FROM gc_solicitacoes WHERE id='$id'") or die (mysqli_error($conn));
    $d = mysqli_fetch_array ($c);

    $usuario = $d['usuario'];

    $email = mysqli_query ($conn, "SELECT nome FROM gc_usuarios WHERE id='$usuario'") or die (mysqli_error($conn));
    $d_email = mysqli_fetch_array ($email);

    return $d_email['nome'];
}

/**
 * E-MAIL REQUERENTE PELO ID
 * @param $id
 * @return mixed
 */
function emailRequerenteId($id) {
    global $conn;

    $c = mysqli_query ($conn, "SELECT usuario FROM gc_solicitacoes WHERE id='$id'") or die (mysqli_error($conn));
    $d = mysqli_fetch_array ($c);

    $usuario = $d['usuario'];

    $email = mysqli_query ($conn, "SELECT email FROM gc_usuarios WHERE id='$usuario'") or die (mysqli_error($conn));
    $d_email = mysqli_fetch_array ($email);

    return $d_email['email'];
}

/**
 * DESCRIÇÃO DA SOLICITAÇÃO PELO ID
 * @param $id
 * @return mixed
 */
function descSolicitacaoId($id) {
    global $conn;

    $c = mysqli_query ($conn, "SELECT descricao FROM gc_solicitacoes WHERE id='$id'") or die (mysqli_error($conn));
    $d = mysqli_fetch_array ($c);

    return $d['descricao'];
}

/**
 * MARCA COMO LIDO
 * @param $id
 * @param $usuario
 */
function marcarLido($id, $usuario) {
    global $conn;

    $c = mysqli_query ($conn, "SELECT id FROM gc_lidas WHERE usuario='$usuario' AND id_solicitacao='$id'") or die (mysqli_error($conn));

    if (mysqli_num_rows($c) == 0) {
        $cad = mysqli_query ($conn, "INSERT INTO gc_lidas (usuario, id_solicitacao) VALUES ('$usuario', '$id')") or die (mysqli_num_rows($conn));
    }
}

/**
 * VERIFICA O LIDO
 * @param $id
 * @param $usuario
 * @return bool
 */
function verificaLido($id, $usuario) {
    global $conn;

    $c = mysqli_query ($conn, "SELECT id FROM gc_lidas WHERE usuario='$usuario' AND id_solicitacao='$id'") or die (mysqli_error($conn));

    if (mysqli_num_rows($c) > 0) {
        return true;
    }
    else {
        return false;
    }
}

/**
 * NOME DO USUÁRIO COMPLETO PELO ID
 * @param $id
 * @return mixed
 */
function nomeUsuarioId($id) {
    global $conn;

    $c = mysqli_query ($conn, "SELECT nome FROM gc_usuarios WHERE id='$id'") or die (mysqli_error($conn));
    $d = mysqli_fetch_array ($c);

    return $d['nome'];
}

/**
 * PRIMEIRO NOME DO USUÁRIO PELO ID
 * @param $id
 * @return mixed
 */
function pnomeUsuarioId($id) {
    global $conn;

    $c = mysqli_query ($conn, "SELECT nome FROM gc_usuarios WHERE id='$id'") or die (mysqli_error($conn));
    $d = mysqli_fetch_array ($c);

    $array = explode(" ", $d['nome']);

    $primeiro_nome = $array[0];

    return $primeiro_nome;
}

/**
 * NOME SETOR
 * @param $id
 * @return mixed
 */
function nomeSetorId($id) {
    global $conn;

    $c = mysqli_query ($conn, "SELECT setor FROM gc_setores WHERE id='$id'") or die (mysqli_error($conn));
    $d = mysqli_fetch_array ($c);

    return $d['setor'];
}

/**
 * TIPO DE USUÁRIO
 * @param $tipo
 * @return string
 */
function tipoUsuario($tipo) {
    switch ($tipo) {
        case "A":
            $t = "ADMIN";
            break;
        case "D":
            $t = "DIRETOR";
            break;
        case "T":
            $t = "GERENTE";
            break;
        case "S":
            $t = "SUPERVISOR";
            break;
        case "G":
            $t = "GLASSCONTROL";
    }

    return $t;
}

/**
 * TIDO USUÁRIO PELO ID
 * @param $id
 * @return mixed
 */
function tipoUsuarioId($id) {
    global $conn;

    $c = mysqli_query ($conn, "SELECT tipo FROM gc_usuarios WHERE id='$id'") or die (mysqli_error($conn));
    $d = mysqli_fetch_array ($c);

    return $d['tipo'];
}

/**
 * ID DO USUÁRIO PELO CÓDIGO
 * @param $id
 * @return mixed
 */
function idUsuarioCod($cod) {
    global $conn;

    $c = mysqli_query ($conn, "SELECT id FROM gc_usuarios WHERE codigo='$cod'") or die (mysqli_error($conn));
    $d = mysqli_fetch_array ($c);

    return $d['id'];
}

/**
 * NOME DAS PRIORIDADES
 * @param $x
 * @return string
 */
function nomePrioridade($x) {
    switch ($x) {
        case "1":
            $p = "URGENTE";
            break;
        case "2":
            $p = "ALTA";
            break;
        case "3":
            $p = "MÉDIA";
            break;
        case "4":
            $p = "BAIXA";
    }

    return $p;
}

/**
 * COR DA PRIORIDADE
 * @param $x
 * @return string
 */
function corPrioridade($x) {
    switch ($x) {
        case "1":
            $p = "danger";
            break;
        case "2":
            $p = "success";
            break;
        case "3":
            $p = "primary";
            break;
        case "4":
            $p = "warning";
    }

    return $p;
}

/**
 * ÍCONE DA PRIORIDADE
 * @param $x
 * @return string
 */
function icoPrioridade($x) {
    switch ($x) {
        case "1":
            $p = "fas fa-exclamation-triangle";
            break;
        case "2":
            $p = "fas fa-exclamation-circle";
            break;
        case "3":
            $p = "fas fa-info-circle";
            break;
        case "4":
            $p = "fas fa-question-circle";
    }

    return $p;
}

/**
 * NOME STATUS
 * @param $x
 * @return string
 */
function txtStatus($x) {
    switch ($x) {
        case "P":
            $s = "PENDENTE";
            break;
        case "C":
            $s = "CONCLUÍDO";
            break;
        case "X":
            $s = "CANCELADA";
            break;
        case "L":
            $s = "RESOLUÇÃO INTERNA";
            break;
        case "A":
            $s = "AGUARDANDO APROVAÇÃO";
            break;
        case "O":
            $s = "AGUARDANDO ORÇAMENTO";
            break;
        case "I":
            $s = "AGUARDANDO IMPLANTAÇÃO";
            break;
        case "D":
            $s = "EM DESENVOLVIMENTO";
    }

    return $s;
}

/**
 * PRAZO ATUAL
 * @param $id
 * @return mixed
 */
function prazoAtual($id) {
    global $conn;

    $c = mysqli_query ($conn, "SELECT prazo FROM gc_solicitacoes WHERE id='$id'") or die (mysqli_error($conn));
    $d = mysqli_fetch_array ($c);

    return $d['prazo'];
}

/**
 * PRAZO ANTERIOR
 * @param $id
 * @return mixed
 */
function prazoAnterior($id) {
    global $conn;

    $c = mysqli_query ($conn, "SELECT prazo_anterior FROM gc_solicitacoes_prazos WHERE id='$id'") or die (mysqli_error($conn));
    $d = mysqli_fetch_array ($c);

    return $d['prazo_anterior'];
}

/**
 * PRAZO NOVO
 * @param $id
 * @return mixed
 */
function prazoNovo($id) {
    global $conn;

    $c = mysqli_query ($conn, "SELECT prazo_novo FROM gc_solicitacoes_prazos WHERE id='$id'") or die (mysqli_error($conn));
    $d = mysqli_fetch_array ($c);

    return $d['prazo_novo'];
}
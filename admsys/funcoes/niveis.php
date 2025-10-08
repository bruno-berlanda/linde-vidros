<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_adm == "S" || $perm_niveis == "S") {
	
    /* ******************************************************************************************************************
    CADASTRAR
    ****************************************************************************************************************** */
    if ($_GET['funcao'] == "cadastrar") {

    // Dados do formulário
    $nivel 					= strip_tags(trim($_POST['nivel']));
    $perm_adm 				= $_POST['perm_adm'];
    $perm_noticias 			= $_POST['perm_noticias'];
    $perm_galerias 			= $_POST['perm_galerias'];
    $perm_produtos 			= $_POST['perm_produtos'];
    $perm_vendedores 		= $_POST['perm_vendedores'];
    $perm_rotas 			= $_POST['perm_rotas'];
    $perm_promocoes 		= $_POST['perm_promocoes'];
    $perm_slides 			= $_POST['perm_slides'];
    $perm_contatos 			= $_POST['perm_contatos'];
    $perm_comentarios 		= $_POST['perm_comentarios'];
    $perm_cadastros 		= $_POST['perm_cadastros'];
    $perm_pesquisa 			= $_POST['perm_pesquisa'];
    $perm_curriculos 		= $_POST['perm_curriculos'];
    $perm_vagas 			= $_POST['perm_vagas'];
    $perm_usuarios 			= $_POST['perm_usuarios'];
    $perm_niveis 			= $_POST['perm_niveis'];
    $perm_representantes	= $_POST['perm_representantes'];
    $perm_treinamentos		= $_POST['perm_treinamentos'];
    $perm_tags				= $_POST['perm_tags'];
    $perm_arquivos			= $_POST['perm_arquivos'];

    if ($perm_adm != "S") { $perm_adm = "N"; }
    if ($perm_noticias != "S") { $perm_noticias = "N"; }
    if ($perm_galerias != "S") { $perm_galerias = "N"; }
    if ($perm_produtos != "S") { $perm_produtos = "N"; }
    if ($perm_vendedores != "S") { $perm_vendedores = "N"; }
    if ($perm_rotas != "S") { $perm_rotas = "N"; }
    if ($perm_promocoes != "S") { $perm_promocoes = "N"; }
    if ($perm_slides != "S") { $perm_slides = "N"; }
    if ($perm_contatos != "S") { $perm_contatos = "N"; }
    if ($perm_comentarios != "S") { $perm_comentarios = "N"; }
    if ($perm_cadastros != "S") { $perm_cadastros = "N"; }
    if ($perm_pesquisa != "S") { $perm_pesquisa = "N"; }
    if ($perm_curriculos != "S") { $perm_curriculos = "N"; }
    if ($perm_vagas != "S") { $perm_vagas = "N"; }
    if ($perm_usuarios != "S") { $perm_usuarios = "N"; }
    if ($perm_niveis != "S") { $perm_niveis = "N"; }
    if ($perm_representantes != "S") { $perm_representantes = "N"; }
    if ($perm_treinamentos != "S") { $perm_treinamentos = "N"; }
    if ($perm_tags != "S") { $perm_tags = "N"; }
    if ($perm_arquivos != "S") { $perm_arquivos = "N"; }

    $nivel = strtr(strtoupper($nivel),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

    /* ************ */
    // Conta cadastro
    $consultaCad = mysqli_query ($conexao, "SELECT id FROM admin_niveis WHERE nivel='$nivel'") or die (mysqli_error($conexao));
    $contaCad = mysqli_num_rows ($consultaCad);
    /* ************ */

    if ($contaCad == 1) {
        header ('Location: ../niveis.php?msgErro=Nível já cadastrado');
    }
    else {
        $cadastra = mysqli_query ($conexao, "INSERT INTO admin_niveis (nivel, adm, noticias, galerias, produtos, vendedores, rotas, promocoes, slides, contatos, comentarios, cadastros, pesquisa, curriculos, vagas, usuarios, niveis, representantes, treinamentos, tags, arquivos) VALUES ('$nivel', '$perm_adm', '$perm_noticias', '$perm_galerias', '$perm_produtos', '$perm_vendedores', '$perm_rotas', '$perm_promocoes', '$perm_slides', '$perm_contatos', '$perm_comentarios', '$perm_cadastros', '$perm_pesquisa', '$perm_curriculos', '$perm_vagas', '$perm_usuarios', '$perm_niveis', '$perm_representantes', '$perm_treinamentos', '$perm_tags', '$perm_arquivos')") or die (mysqli_error($conexao));

        header ('Location: ../niveis.php?msgSucesso=Nível cadastrado com sucesso');
    }

    }

    /* ******************************************************************************************************************
    EDITAR
    ****************************************************************************************************************** */
    if ($_GET['funcao'] == "editar") {

    $id = $_GET['id'];

    if ($id == 1) {

        header("Location: ../niveis.php?msgErro=Você não tem permissão para fazer isso");

    }
    else {

    // Dados do formulário
    $nivel 					= strip_tags(trim($_POST['nivel']));
    $perm_adm 				= $_POST['perm_adm'];
    $perm_noticias 			= $_POST['perm_noticias'];
    $perm_galerias 			= $_POST['perm_galerias'];
    $perm_produtos 			= $_POST['perm_produtos'];
    $perm_vendedores 		= $_POST['perm_vendedores'];
    $perm_rotas 			= $_POST['perm_rotas'];
    $perm_promocoes 		= $_POST['perm_promocoes'];
    $perm_slides 			= $_POST['perm_slides'];
    $perm_contatos 			= $_POST['perm_contatos'];
    $perm_comentarios 		= $_POST['perm_comentarios'];
    $perm_cadastros 		= $_POST['perm_cadastros'];
    $perm_pesquisa 			= $_POST['perm_pesquisa'];
    $perm_curriculos 		= $_POST['perm_curriculos'];
    $perm_vagas 			= $_POST['perm_vagas'];
    $perm_usuarios 			= $_POST['perm_usuarios'];
    $perm_niveis 			= $_POST['perm_niveis'];
    $perm_representantes	= $_POST['perm_representantes'];
    $perm_treinamentos		= $_POST['perm_treinamentos'];
    $perm_tags				= $_POST['perm_tags'];
    $perm_arquivos			= $_POST['perm_arquivos'];

    if ($perm_adm != "S") { $perm_adm = "N"; }
    if ($perm_noticias != "S") { $perm_noticias = "N"; }
    if ($perm_galerias != "S") { $perm_galerias = "N"; }
    if ($perm_produtos != "S") { $perm_produtos = "N"; }
    if ($perm_vendedores != "S") { $perm_vendedores = "N"; }
    if ($perm_rotas != "S") { $perm_rotas = "N"; }
    if ($perm_promocoes != "S") { $perm_promocoes = "N"; }
    if ($perm_slides != "S") { $perm_slides = "N"; }
    if ($perm_contatos != "S") { $perm_contatos = "N"; }
    if ($perm_comentarios != "S") { $perm_comentarios = "N"; }
    if ($perm_cadastros != "S") { $perm_cadastros = "N"; }
    if ($perm_pesquisa != "S") { $perm_pesquisa = "N"; }
    if ($perm_curriculos != "S") { $perm_curriculos = "N"; }
    if ($perm_vagas != "S") { $perm_vagas = "N"; }
    if ($perm_usuarios != "S") { $perm_usuarios = "N"; }
    if ($perm_niveis != "S") { $perm_niveis = "N"; }
    if ($perm_representantes != "S") { $perm_representantes = "N"; }
    if ($perm_treinamentos != "S") { $perm_treinamentos = "N"; }
    if ($perm_tags != "S") { $perm_tags = "N"; }
    if ($perm_arquivos != "S") { $perm_arquivos = "N"; }

    $nivel = strtr(strtoupper($nivel),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

    // Hidden
    $nivel_atual = $_POST['nivel_atual'];

    /* ************ */
    // Conta cadastro
    $consultaCad = mysqli_query ($conexao, "SELECT id FROM admin_niveis WHERE nivel='$nivel'") or die (mysqli_error($conexao));
    $contaCad = mysqli_num_rows ($consultaCad);
    /* ************ */

    if ($contaCad == 1 && $nivel != $nivel_atual) {
        header ('Location: ../niveis.php?editar='.$id.'&msgErro=Nível já cadastrado');
    }
    else {
        $cadastra = mysqli_query ($conexao, "UPDATE admin_niveis SET nivel='$nivel', adm='$perm_adm', noticias='$perm_noticias', galerias='$perm_galerias', produtos='$perm_produtos', vendedores='$perm_vendedores', rotas='$perm_rotas', promocoes='$perm_promocoes', slides='$perm_slides', contatos='$perm_contatos', comentarios='$perm_comentarios', cadastros='$perm_cadastros', pesquisa='$perm_pesquisa', curriculos='$perm_curriculos', vagas='$perm_vagas', usuarios='$perm_usuarios', niveis='$perm_niveis', representantes='$perm_representantes', treinamentos='$perm_treinamentos', tags='$perm_tags', arquivos='$perm_arquivos' WHERE id='$id'") or die (mysqli_error($conexao));

        header ('Location: ../niveis.php?msgSucesso=Nível alterado com sucesso');
    }
    }

    }

    /* ******************************************************************************************************************
    EXCLUIR
    ****************************************************************************************************************** */
    if ($_GET['funcao'] == "excluir") {

    $id = $_GET['id'];

        if ($id == 1) {

            header ('Location: ../niveis.php?msgErro=Você não tem permissão para fazer isso');

        }
        else {

            $excluir = mysqli_query ($conexao, "DELETE FROM admin_niveis WHERE id='$id'") or die (mysqli_error($conexao));

            header ('Location: ../niveis.php?msgSucesso=Nível excluído com sucesso');

        }

    }

    /* ******************************************************************************************************************
    DESATIVAR
    ****************************************************************************************************************** */
    if ($_GET['funcao'] == "desativar") {

    $id = $_GET['id'];

    $cadastra = mysqli_query ($conexao, "UPDATE admin_niveis SET ativo='N' WHERE id='$id'") or die (mysqli_error($conexao));

    header ('Location: ../niveis.php?msgSucesso=Nível desativado com sucesso');

    }

    /* ******************************************************************************************************************
    ATIVAR
    ****************************************************************************************************************** */
    if ($_GET['funcao'] == "ativar") {

    $id = $_GET['id'];

    $cadastra = mysqli_query ($conexao, "UPDATE admin_niveis SET ativo='S' WHERE id='$id'") or die (mysqli_error($conexao));

    header ('Location: ../niveis.php?msgSucesso=Nível ativado com sucesso');

    }

} // Permissão para acessar a página
else {
	header ('Location: ../admsys.php?msgErro=Você não tem permissão para acessar essa página');
}
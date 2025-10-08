<?php
// Conexão com o banco de dados
include_once ("../../funcoes/conexao.php");

include_once ("../includes/permissao_sistema.php");

include_once ("../includes/usuario_logado.php");

if ($perm_arquivos == "S") {
	
    /* ******************************************************************************************************************
    CADASTRAR
    ****************************************************************************************************************** */
    if ($_GET['funcao'] == "cadastrar_rep") {

    // Dados do formulário
    $nome 				= strip_tags(trim($_POST['nome']));
    $descricao			= strip_tags(trim($_POST['descricao']));
    $categoria			= strip_tags(trim($_POST['categoria']));

    if (!$_POST['aviso_envio']) {
        $aviso_envio = "N";
    }
    else {
        $aviso_envio = strip_tags(trim($_POST['aviso_envio']));
    }

    // Pasta
    if ($categoria == "M") {
        $pasta = "../../repsys/materiais/divulgacao/";
    }
    else if ($categoria == "N") {
        $pasta = "../../repsys/materiais/normas/";
    }
    else if ($categoria == "P") {
        $pasta = "../../repsys/materiais/procedimentos/";
    }

    // Enviando o arquivo
    if (is_file($_FILES['arquivo']['tmp_name'])) {

        $arquivo_temp = $_FILES['arquivo']['name']; // Nome do arquivo original

        $extensao = @end(explode(".",$arquivo_temp));

        $x = explode(".",$arquivo_temp);
        $nome_temp = $x[0];

        // TRATAMENTO DO NOME DA FOTO
        $arquivo_upload = $nome_temp."_".date("YmdHis").".".strtolower($extensao);

        // Define os formatos de arquivos permitidos
        if ($extensao == "pdf" || $extensao == "PDF") {
            // Faz o upload do arquivo
            if (!move_uploaded_file($_FILES['arquivo']['tmp_name'], $pasta.$arquivo_upload)) {
                header ('Location: ../arquivos_representantes.php?msgErro=Erro ao enviar o arquivo do anexo');
            }
        }
        else {
            header ('Location: ../arquivos_representantes.php?msgErro=O formato do anexo não é valido. Somente arquivos em PDF.');
            exit;
        }
    }

    $cadastra = mysqli_query($conexao, "INSERT INTO arquivos (nome, descricao, categoria, arquivo, aviso_envio) VALUES ('$nome', '$descricao', '$categoria', '$arquivo_upload', '$aviso_envio')") or die (mysqli_error($conexao));

    header ('Location: ../arquivos_representantes.php?msgSucesso=Arquivo enviado com sucesso');

    }

    /* ******************************************************************************************************************
    EDITAR
    ****************************************************************************************************************** */
    if ($_GET['funcao'] == "editar_rep") {

    $id = $_GET['id'];

    // Dados do formulário
    $nome 				= strip_tags(trim($_POST['nome']));
    $descricao			= strip_tags(trim($_POST['descricao']));
    $categoria			= strip_tags(trim($_POST['categoria']));

    if (!$_POST['aviso_envio']) {
        $aviso_envio = "N";
    }
    else {
        $aviso_envio = strip_tags(trim($_POST['aviso_envio']));
    }

    // Hidden
    $categoria_atual 	= $_POST['categoria_atual'];

    // Se a categoria for alterada move o arquivo para a pasta correta
    if ($categoria != $categoria_atual) {

        $consulta_arquivo = mysqli_query($conexao, "SELECT arquivo FROM arquivos WHERE id='$id'") or die (mysqli_error($conexao));
            $dados = mysqli_fetch_array ($consulta_arquivo);
                $arquivo_bd = $dados['arquivo'];

        // Pasta Atual
        if ($categoria_atual == "M") {
            $pasta_atual = "../../repsys/materiais/divulgacao/";
        }
        else if ($categoria_atual == "N") {
            $pasta_atual = "../../repsys/materiais/normas/";
        }
        else if ($categoria_atual == "P") {
            $pasta_atual = "../../repsys/materiais/procedimentos/";
        }

        // Pasta Nova
        if ($categoria == "M") {
            $pasta = "../../repsys/materiais/divulgacao/";
        }
        else if ($categoria == "N") {
            $pasta = "../../repsys/materiais/normas/";
        }
        else if ($categoria == "P") {
            $pasta = "../../repsys/materiais/procedimentos/";
        }

        copy ($pasta_atual.$arquivo_bd, $pasta.$arquivo_bd); // Copia o arquivo

        unlink ($pasta_atual.$arquivo_bd); // Deleta o arquivo original
    }

    $atualiza = mysqli_query($conexao, "UPDATE arquivos SET nome='$nome', descricao='$descricao', categoria='$categoria', aviso_envio='$aviso_envio' WHERE id='$id'") or die (mysqli_error($conexao));

    header ('Location: ../arquivos_representantes.php?msgSucesso=Informações do arquivo alteradas com sucesso');

    }

    /* ******************************************************************************************************************
    ATUALIZAR ARQUIVO
    ****************************************************************************************************************** */
    if ($_GET['funcao'] == "atuarq_rep") {

    $id = $_GET['id'];

    // Dados do formulário
    $consulta_arquivo = mysqli_query($conexao, "SELECT categoria, arquivo FROM arquivos WHERE id='$id'") or die (mysqli_error($conexao));
        $dados = mysqli_fetch_array ($consulta_arquivo);
            $categoria_bd 	= $dados['categoria'];
            $arquivo_bd 	= $dados['arquivo'];

    // Pasta
    if ($categoria_bd == "M") {
        $pasta = "../../repsys/materiais/divulgacao/";
    }
    else if ($categoria_bd == "N") {
        $pasta = "../../repsys/materiais/normas/";
    }
    else if ($categoria_bd == "P") {
        $pasta = "../../repsys/materiais/procedimentos/";
    }

    // Enviando o arquivo
    if (is_file($_FILES['arquivo']['tmp_name'])) {

        $arquivo_temp = $_FILES['arquivo']['name']; // Nome do arquivo original

        $extensao = @end(explode(".",$arquivo_temp));

        $x = explode(".",$arquivo_temp);
        $nome_temp = $x[0];

        // TRATAMENTO DO NOME DA FOTO
        $arquivo_upload = $nome_temp."_".date("YmdHis").".".strtolower($extensao);

        // Define os formatos de arquivos permitidos
        if ($extensao == "pdf" || $extensao == "PDF") {
            // Faz o upload do arquivo
            if (!move_uploaded_file($_FILES['arquivo']['tmp_name'], $pasta.$arquivo_upload)) {
                header ('Location: ../arquivos_representantes.php?msgErro=Erro ao enviar o arquivo do anexo');
            }
        }
        else {
            header ('Location: ../arquivos_representantes.php?msgErro=O formato do anexo não é valido. Somente arquivos em PDF.');
            exit;
        }
    }

    $atualiza = mysqli_query($conexao, "UPDATE arquivos SET arquivo='$arquivo_upload' WHERE id='$id'") or die (mysqli_error($conexao));

    unlink ($pasta.$arquivo_bd);

    header ('Location: ../arquivos_representantes.php?msgSucesso=Arquivo enviado com sucesso');

    }

    /* ******************************************************************************************************************
    DESATIVAR
    ****************************************************************************************************************** */
    if ($_GET['funcao'] == "desativar_arq") {

    $id = $_GET['id'];

    $atualiza = mysqli_query($conexao, "UPDATE arquivos SET ativo='N' WHERE id='$id'") or die (mysqli_error($conexao));

    header ('Location: ../arquivos_representantes.php?msgSucesso=Arquivo desativado com sucesso');

    }

}
<?php
/**
 * Recebe o dado do CNPJ do formulário
 */
$cnpj = strip_tags(trim($_POST['cnpj']));

/**
 * Formata o CNPJ
 */
$cnpj_formatado = substr($cnpj, 0, 2) . "." . substr($cnpj, 2, 3) . "." . substr($cnpj, 5, 3) . "/" . substr($cnpj, 8, 4) . "-" . substr($cnpj, 12, 2);

/**
 * Conecta ao bando de dados
 */
require_once ("../../funcoes/conexao.php");

/**
 * Verifica se o CNPJ é de algum cliente cadastrado
 */
$con_cliente = mysqli_query ($conexao, "SELECT cod_cliente FROM admin_clientes WHERE cnpj='$cnpj_formatado'") or die (mysqli_error($conexao));

/**
 * Caso o CNPJ não seja encontrado, 
 * retorna o erro
 */
if (mysqli_num_rows($con_cliente) == 0) {

    setcookie('msg_erro', "CNPJ incorreto. Você precisa digitar um CNPJ válido.", -1, "/");
    header ('Location: ../');

} else {

    $d_cliente = mysqli_fetch_array ($con_cliente);
    
    /**
     * Verifica se o cliente está participando de alguma promoção
     */
    $con_promocao = mysqli_query ($conexao, "SELECT a.id FROM co_sorteio_numeros a INNER JOIN co_sorteio_promocao b ON a.id_promocao=b.id WHERE a.cod_cliente='{$d_cliente['cod_cliente']}'") or die (mysqli_error($conexao));
    
    if (mysqli_num_rows($con_promocao) == 0) {

        setcookie('msg_alerta', "Você não está participando de nenhuma promoção no momento.", -1, "/");
        header ('Location: ../');
    
    } else {
    
        // Cria a session
        session_start();
        $_SESSION['login_sorteio_lv'] = $cnpj;

        // Registra o login
        $registra_login = mysqli_query ($conexao, "INSERT INTO login_sorteio (cnpj) VALUES ('$cnpj_formatado')") or die (mysqli_error($conexao));

        header ('Location: ../');

    }    

}
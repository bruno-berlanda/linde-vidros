<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Sorteio | Linde Vidros</title>

    <link rel="shortcut icon" href="../img/favicon.ico">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/alertify/alertify.min.css">
    <link rel="stylesheet" href="css/alertify/default.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php session_start(); ?>

<div class="container">

    <?php
    if (!isset($_SESSION['login_sorteio_lv'])) {
    ?>    

        <div class="row mt-5 justify-content-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                <div class="mb-4 text-center" id="login-ico">
                    <i class="fa-solid fa-person-dots-from-line fa-2xl"></i>
                </div>

                <div class="text-center p-2 fw-bold fs-5 text-secondary">
                    NÚMERO DA SORTE
                </div>

                <form action="functions/login.php" method="post">
                    <div class="form-floating mb-3">
                        <input type="number" name="cnpj" class="form-control" id="inputCNPJ" placeholder="Digite seu CNPJ" required>
                        <label for="inputCNPJ">CNPJ</label>
                        <small class="text-muted">SOMENTE NÚMEROS</small>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-lg btn-primary">
                            Entrar
                        </button>
                    </div>
                </form>
            </div>
        </div>

    <?php
    } else {
        require_once ("../funcoes/conexao.php");

        /**
         * CNPJ do usuário logado
         */
        $cnpj_usuario_logado = $_SESSION['login_sorteio_lv'];

        /**
         * Formata o CNPJ
         */
        $cnpj_formatado = substr($cnpj_usuario_logado, 0, 2) . "." . substr($cnpj_usuario_logado, 2, 3) . "." . substr($cnpj_usuario_logado, 5, 3) . "/" . substr($cnpj_usuario_logado, 8, 4) . "-" . substr($cnpj_usuario_logado, 12, 2);

        /**
         * Consulta os dados do cliente
         */
        $con_cliente = mysqli_query ($conexao, "SELECT cod_cliente, nome_fantasia, cnpj FROM admin_clientes WHERE cnpj='$cnpj_formatado'") or die (mysqli_error($conexao));
        $d_cliente = mysqli_fetch_array($con_cliente);

        $cliente_cod = $d_cliente['cod_cliente'];
        $cliente_nome = $d_cliente['nome_fantasia'];
        $cliente_cnpj = $d_cliente['cnpj'];
    ?>

        <div class="row my-4">
            <div class="col-12 text-center">
                <img src="../img/linde.png">
            </div>
        </div>

        <div class="rounded bg-dark p-4 text-white">
            <div class="row">
                <div class="col-10 pt-1">
                    Olá <strong class="text-info"><?php echo $cliente_nome; ?></strong>.
                </div>
                <div class="col-2 text-end">
                    <a href="functions/logout.php" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-right-from-bracket"></i> Sair
                    </a>
                </div>
            </div>
        </div>

        <?php
        /**
         * SQL para buscar as promoções
         */
        $sql_promocoes = "SELECT b.codigo, b.nome, b.ativo FROM co_sorteio_numeros a INNER JOIN co_sorteio_promocao b ON a.id_promocao=b.id WHERE a.cod_cliente='$cliente_cod' GROUP BY a.id_promocao ORDER BY b.ativo DESC, b.nome";
        ?>

        <div class="row my-3">
            <div class="col-12 col-sm-3">
                <strong class="lead fw-bolder text-secondary">Promoções</strong>
                <br>
                <small>Confira seus números da sorte.</small>

                <hr>

                <?php
                $con_promocoes_menu = mysqli_query ($conexao, $sql_promocoes) or die (mysqli_error($conexao));

                while ($d_promocoes_menu = mysqli_fetch_array($con_promocoes_menu)) {

                    switch ($d_promocoes_menu['ativo']) {
                        case "S":
                            $class_btn_menu = "btn btn-sm btn-primary text-start";
                            break;
                        case "N":
                        default:
                            $class_btn_menu = "btn btn-sm btn-outline-secondary text-start";
                    }
                    ?>
                    <div class="d-grid gap-2 my-1">
                        <button class="<?php echo $class_btn_menu; ?>" id="promocoes-menu" type="button" data-bs-toggle="collapse" data-bs-target="#promo-<?php echo $d_promocoes_menu['codigo']; ?>" aria-expanded="false" aria-controls="#promo-<?php echo $d_promocoes_menu['codigo']; ?>">
                            <?php echo $d_promocoes_menu['nome']; ?>
                        </button>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="col-12 col-sm-9">
                <?php
                $con_promocoes_conteudo = mysqli_query ($conexao, $sql_promocoes) or die (mysqli_error($conexao));

                while ($d_promocoes_conteudo = mysqli_fetch_array($con_promocoes_conteudo)) {
                    ?>
                    <div class="collapse" id="promo-<?php echo $d_promocoes_conteudo['codigo']; ?>">
                        <div class="card card-body border-0">
                            <?php
                            /**
                             * Consulta os dados da promoção selecionada
                             */
                            $con_promocao_selecionada = mysqli_query ($conexao, "SELECT id, nome, sorteio_data, ativo FROM co_sorteio_promocao WHERE codigo='{$d_promocoes_conteudo['codigo']}'") or die (mysqli_error($conexao));
                            $d_promocao_selecionada = mysqli_fetch_array($con_promocao_selecionada);

                            /**
                             * ID da promoção selecionada
                             */
                            $promocao_id = $d_promocao_selecionada['id'];

                            /**
                             * Procura os valores de notas lançadas
                             */
                            $con_valor_notas = mysqli_query ($conexao, "SELECT DISTINCT(valor_notas) AS valor_notas FROM co_sorteio_numeros WHERE id_promocao='$promocao_id' AND cod_cliente='$cliente_cod' ORDER BY reg_data") or die (mysqli_error($conexao));

                            while ($d_valor_notas = mysqli_fetch_array($con_valor_notas)) {
                                ?>
                                <div class="card mb-3">
                                    <div class="card-header bg-secondary lead text-white">
                                        <?php echo $d_promocao_selecionada['nome']; ?>
                                    </div>
                                    <?php
                                    if ($d_promocao_selecionada['ativo'] == "N") {
                                        ?>
                                        <div class="card-body bg-success text-white">
                                            Sorteio realizado no dia <strong><?php echo date("d/m/Y", strtotime($d_promocao_selecionada['sorteio_data'])); ?></strong>.
                                            <br>
                                            <?php
                                            $con_numeros_sorteados = mysqli_query ($conexao, "SELECT numero FROM co_sorteio_numeros WHERE id_promocao='$promocao_id' AND numero_sorteado='S' ORDER BY sorteio_seq") or die (mysqli_error($conexao));
                                            ?>
                                            Número(s) sorteado(s):
                                            <?php
                                            while ($d_numeros_sorteados = mysqli_fetch_array($con_numeros_sorteados)) {
                                                ?>
                                                <span class="badge rounded-pill text-bg-light"><?php echo $d_numeros_sorteados['numero']; ?></span>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="card-body bg-light text-secondary">
                                        <small>VALOR NOTAS:</small> <strong><small>R$</small> <?php echo number_format($d_valor_notas['valor_notas'], 2, ",", "."); ?></strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                        <?php
                                        $con_numeros_sorte = mysqli_query ($conexao, "SELECT numero, numero_sorteado FROM co_sorteio_numeros WHERE cod_cliente='$cliente_cod' AND valor_notas='{$d_valor_notas['valor_notas']}' ORDER BY numero") or die (mysqli_error($conexao));

                                        while ($d_numeros_sorte = mysqli_fetch_array($con_numeros_sorte)) {

                                            switch ($d_numeros_sorte['numero_sorteado']) {
                                                case "S":
                                                    $box_numero_id = "numero-sorteado";
                                                    break;
                                                case "N":
                                                default:
                                                    $box_numero_id = "numero-normal";
                                            }
                                            ?>
                                            <div id="<?php echo $box_numero_id; ?>">
                                                <?php echo number_format($d_numeros_sorte['numero'], 0, "", "."); ?>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

    <?php
    }
    ?>

</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.mask.min.js"></script>
<script src="js/config-jquery.mask.js"></script>
<script src="js/alertify.min.js"></script>

<?php
// Mensagem de SUCESSO
if (isset($_COOKIE['msg_sucesso'])) {
?>
    <script>
        alertify.success("<i class=\"fas fa-check-circle fa-lg\"></i> <?php echo $_COOKIE['msg_sucesso']; ?>").delay(20);
    </script>
<?php
    setcookie('msg_sucesso', null, -1, '/');
}
?>

<?php
// Mensagem de ERRO
if (isset($_COOKIE['msg_erro'])) {
    ?>
    <script>
        alertify.error("<i class=\"fas fa-times-circle fa-lg\"></i> <?php echo $_COOKIE['msg_erro']; ?>").delay(20);
    </script>
    <?php
    setcookie('msg_erro', null, -1, '/');
}
?>

<?php
// Mensagem de ALERTA
if (isset($_COOKIE['msg_alerta'])) {
    ?>
    <script>
        alertify.warning("<i class=\"fas fa-exclamation-triangle fa-lg\"></i> <?php echo $_COOKIE['msg_alerta']; ?>").delay(20);
    </script>
    <?php
    setcookie('msg_alerta', null, -1, '/');
}
?>

<?php
// Mensagem de INFORMAÇÃO
if (isset($_COOKIE['msg_info'])) {
    ?>
    <script>
        alertify.notify("<i class=\"fas fa-info-circle fa-lg\"></i> <?php echo $_COOKIE['msg_info']; ?>").delay(20);
    </script>
    <?php
    setcookie('msg_info', null, -1, '/');
}
?>

</body>

</html>
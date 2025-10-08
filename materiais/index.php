<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vidro Laminado, Vidro Temperado, Vidro Insulado, Vidro Habitat, Vidro Texturizado, Sentryglas, Ferragens, Película de Segurança, Lapidação, Serigrafia, Vidros">
    <meta name="keywords" content="vidro, vidros, vidro laminado, vidro habitat, vidro insulado, vidro temperado, vidro texturizado, sentryglas, serigrafia, película de segurança, distribuidora de vidro, beneficiadora de vidro, fábrica de vidro">
    <meta name="author" content="Bruno Berlanda">
    <meta name="google-site-verification" content="ruHDS8wB7G0s0o7lkrG9fZPgxgrd87vm63wUm6rG0xM">

    <meta property="busca:image" content="http://www.lindevidros.com.br/img/h_200x200.png">
    <meta itemprop="url" content="http://www.lindevidros.com.br/">
    <meta itemprop="image" content="http://www.lindevidros.com.br/img/h_200x200.png">

    <meta property="og:locale" content="pt-br">
    <meta property="og:url" content="https://www.lindevidros.com.br/">
    <meta property="og:title" content="Linde Vidros - Materiais de Divulgação">
    <meta property="og:site_name" content="Linde Vidros">
    <meta property="og:description" content="Vidro Laminado, Vidro Temperado, Vidro Insulado, Vidro Habitat, Vidro Texturizado, Sentryglas, Ferragens, Película de Segurança, Lapidação, Serigrafia, Vidros">
    <meta property="og:image" content="http://www.lindevidros.com.br/img/h_800x800.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="800">
    <meta property="og:type" content="website">

    <link rel="shortcut icon" href="../img/favicon.ico">

    <title>Linde Vidros - Materiais de Divulgação</title>

    <!-- JS -->
    <!--[if lt IE 9]>
    <script src="../js/html5shiv.js"></script>
    <![endif]-->

    <!-- CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css?<?php echo filemtime('../css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="../css/materiais.css?<?php echo filemtime('../css/materiais.css'); ?>">
    <link rel="stylesheet" href="../css/fontawesome-all.min.css?<?php echo filemtime('../css/fontawesome-all.min.css'); ?>">

    <!-- Fontes -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Ropa+Sans" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
</head>

<body>

<?php include_once ("../includes/analyticstracking.php"); // Google Analytics ?>

<div class="container-fluid" id="topo">
    <div class="row">
        <div class="col-xs-12">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <img src="../img/linde.png" alt="Linde Vidros" class="img-responsive">
                    </div>
                    <div class="col-xs-6 col-sm-8 col-md-9">
                        <h1>Materiais de Divulgação</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
	<div class="row">
    	<div class="col-md-12">
            <?php
            require_once ("../funcoes/conexao.php");

            $consulta = mysqli_query ($conexao, "SELECT data, nome, descricao, arquivo, aviso_envio FROM arquivos WHERE categoria='M' AND ativo='S' ORDER BY nome") or die (mysqli_error($conexao));

            while ($info = mysqli_fetch_array ($consulta)) {
                $data_arquivo = $info['data'];
                $nome_arquivo = $info['nome'];
                $descricao_arquivo = $info['descricao'];
                $arquivo = $info['arquivo'];
                $aviso_envio = $info['aviso_envio'];

                $data_arquivo = date('d/m/Y', strtotime($data_arquivo));
                ?>
                <div class="col-sm-12 col-md-3">
                    <div class="thumbnail" id="materiais">
                        <p class="text-center" id="img-materiais"><i class="fas fa-file-pdf fa-4x"></i></p>
                        <div class="caption">
                            <h3><?php echo $nome_arquivo; ?></h3>
                            <p><a href="../repsys/materiais/divulgacao/<?php echo $arquivo; ?>" class="btn btn-primary btn-block" target="_blank" role="button"><i class="fas fa-search"></i> Visualizar</a></p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<hr>

<footer>
    <p class="text-center"><img src="../img/linde.png" alt="Linde Vidros" style="max-width: 180px;"></p>

    <address>
        <center>
            Avenida General Luiz Carlos Pereira Tourinho, 4197 &bull; Tijuco Preto &bull; Paralela a BR 116
            <br>
            Rio Negro - PR &bull; CEP 83885-302
            <br><br>
            <p class="lead"><strong>47 3641 4444</strong></p>
        </center>
    </address>

    <address>
        <center>
            <i class="fas fa-envelope"></i> <a href="mailto:linde@lindevidros.com.br">linde@lindevidros.com.br</a>
        </center>
    </address>

    <p class="text-center">
        <a href="https://www.facebook.com/lindevidros" target="_blank"><i class="fab fa-facebook fa-2x"></i></a>
        <a href="https://instagram.com/lindevidros" target="_blank"><i class="fab fa-instagram fa-2x"></i></a>
        <a href="https://www.linkedin.com/company/linde-vidros/" target="_blank"><i class="fab fa-linkedin fa-2x"></i></a>
        <a href="http://www.lindevidros.com.br/blog" target="_blank"><i class="fab fa-wordpress fa-2x"></i></a>
    </p>

    <p class="text-center"><small>Website desenvolvido por <a href="mailto:bruno.berlanda@gmail.com">Bruno Berlanda</a></small></p>
</footer>

<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- Scripts Bootstrap -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
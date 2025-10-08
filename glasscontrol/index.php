<?php
session_start();
if (isset($_SESSION['loginSysLG'])) {

    header ('Location: sys.php');

}
else {
    ?>
    <?php require_once("funcoes/_conexao.php"); ?>

    <?php require_once("funcoes/_funcoes_geral.php"); ?>

    <?php require_once("includes/layout_cabecalho.php"); ?>

    <body class="bg-gradient-dark">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6" style="min-height: 600px;">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4" style="text-transform: none;">Linde Vidros ::
                                            GlassControl</h1>
                                    </div>
                                    <form class="user" method="post" action="funcoes/_login.php">
                                        <div class="form-group">
                                            <select name="loginLG" class="form-control form-control-lg"
                                                    id="selectUsuarioLogin" autofocus required>
                                                <option></option>
                                                <?php
                                                $con_usuarios = mysqli_query($conn, "SELECT nome, usuario FROM gc_usuarios WHERE ativo='S' ORDER BY nome") or die (mysqli_error());

                                                while ($d_usuarios = mysqli_fetch_array($con_usuarios)) {
                                                    ?>
                                                    <option value="<?php echo $d_usuarios['usuario']; ?>"><?php echo textoMaiusc($d_usuarios['nome']); ?></option>
                                                    <?php
                                                }

                                                mysqli_close($conn);
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="senhaLG" class="form-control form-control-lg"
                                                   id="inputSenhaLogin" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Entrar</button>
                                    </form>

                                    <br>

                                    <?php require_once("includes/msgs.php"); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    </body>

    </html>
    <?php
}
?>
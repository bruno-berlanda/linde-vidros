<div class="bg-light border rounded p-4">
    <div class="row">
        <div class="col-12 col-md-6">
            <p class="text-center">
                <i class="fa-solid fa-address-card fa-fw fa-3x text-primary"></i>
            </p>

            <p class="text-center">Se você é um profissional que busca desafios, desenvolvimento e crescimento profissional, venha fazer parte deste time!</p>

            <p class="text-center">Cadastre seu currículo, e mantenha-o atualizado.</p>

            <hr>

            <p class="text-center"><a href="<?php echo $l_curcadastrar; ?>" class="btn btn-secondary"><i class="fas fa-plus-circle"></i> CADASTRAR</a> <a href="<?php echo $l_curentrar; ?>" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> ENTRAR</a></p>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header text-azul-linde">
                    Oportunidade de Trabalho
                </div>
                <?php
                require ("funcoes/conexao.php");

                $consultaVagas = mysqli_query ($conexao, "SELECT id_vaga, inicio FROM vagas_criadas WHERE status='1' ORDER BY inicio DESC") or die (mysqli_error($conexao));
                $contaVagas = mysqli_num_rows ($consultaVagas);

                if ($contaVagas == 0) {
                    ?>
                    <div class="card-body text-danger">
                        Nenhuma vaga em aberto no momento.
                    </div>
                    <?php
                }
                else {
                    ?>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item small bg-azul-escuro text-white"><i class="fa-solid fa-arrow-down"></i> VAGAS EM ABERTO</li>
                    <?php
                    while ($dados = mysqli_fetch_array ($consultaVagas)) {

                        $c_vaga = mysqli_query ($conexao, "SELECT vaga FROM vagas WHERE id='{$dados['id_vaga']}'") or die (mysqli_error($conexao));
                        $d_vaga = mysqli_fetch_array ($c_vaga);

                        ?>
                        <li class="list-group-item small text-muted py-1"><?php echo $d_vaga['vaga'] ?></li>
                        <?php
                    }
                    ?>
                    </ul>
                <?php
                }
                mysqli_close ($conexao);
                ?>
            </div>
        </div>
    </div>
</div>
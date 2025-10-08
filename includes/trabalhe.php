<div class="well">
    <p class="text-center"><i class="far fa-id-card fa-3x"></i></p>
    
    <p class="text-center">Se você é um profissional que busca desafios, desenvolvimento e crescimento profissional, venha fazer parte deste time!</p>
    
    <p class="text-center">Cadastre seu currículo, e mantenha-o atualizado.</p>
    
    <p class="text-center"><a href="<?php echo $l_curcadastrar; ?>" class="btn btn-danger"><i class="fas fa-plus-circle"></i> CADASTRAR</a> <a href="<?php echo $l_curentrar; ?>" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> ENTRAR</a></p>
                    
    <hr>
    
    <p class="lead text-primary">Oportunidade de Trabalho</p>
    
    <?php
    require ("funcoes/conexao.php");
    
    $consultaVagas = mysqli_query ($conexao, "SELECT id_vaga, inicio FROM vagas_criadas WHERE status='1' ORDER BY inicio DESC") or die (mysqli_error());
    $contaVagas = mysqli_num_rows ($consultaVagas);
    
    if ($contaVagas == 0) {
    ?>                
    <p class="text-danger">Nenhuma vaga em aberto no momento.</p>
    <?php
    }
    else {
        
        while ($dados = mysqli_fetch_array ($consultaVagas)) {
            $id_vaga    = $dados['id_vaga'];
            $inicio     = $dados['inicio'];
            
            $consulta_vaga = mysqli_query ($conexao, "SELECT vaga FROM vagas WHERE id='$id_vaga'") or die (mysqli_error());
                $dados = mysqli_fetch_array ($consulta_vaga);
                    $nome_vaga = $dados['vaga'];
            
            // Tratamento da Data
            $dataInicio = substr($inicio,8,2) . "/" .substr($inicio,5,2) . "/" . substr($inicio,2,2);
    ?>
    <small><span class="text-danger" id="vaga-aberta">VAGA EM ABERTO</span> <?php echo $nome_vaga ?></small> <br>
    <?php
        }
    ?>
    
    <?php
    }
    mysqli_close ($conexao);
    ?>
</div>
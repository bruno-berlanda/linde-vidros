<?php
/**
 * P = PENDENTE
 * C = CONCLUÍDA
 * X - CANCELADA
 * L = RESOLUÇÃO INTERNA
 * A = AGUARDANDO APROVAÇÃO
 * O = AGUARDANDO ORÇAMENTO
 * I = AGUARDANDO IMPLANTAÇÃO
 * D = EM DESENVOLVIMENTO
 */

// Urgente
$con_u = mysqli_query ($conn, "SELECT id FROM gc_solicitacoes WHERE prioridade='1' AND status IN ('P','D','A','L','I','O')") or die (mysqli_error($conn));
// Alta
$con_a = mysqli_query ($conn, "SELECT id FROM gc_solicitacoes WHERE prioridade='2' AND status IN ('P','D','A','L','I','O')") or die (mysqli_error($conn));
// Média
$con_m = mysqli_query ($conn, "SELECT id FROM gc_solicitacoes WHERE prioridade='3' AND status IN ('P','D','A','L','I','O')") or die (mysqli_error($conn));
// Baixa
$con_b = mysqli_query ($conn, "SELECT id FROM gc_solicitacoes WHERE prioridade='4' AND status IN ('P','D','A','L','I','O')") or die (mysqli_error($conn));

// Todos
$con_todos = mysqli_query ($conn, "SELECT id FROM gc_solicitacoes WHERE status NOT IN ('X')") or die (mysqli_error($conn));
$conta_todos = mysqli_num_rows($con_todos);

// Concluídos
$con_concluidos = mysqli_query ($conn, "SELECT id FROM gc_solicitacoes WHERE status IN ('C')") or die (mysqli_error($conn));
$conta_concluidos = mysqli_num_rows($con_concluidos);

// Porcentagem das solicitações concluídas
if ($conta_todos === $conta_concluidos) {
    $porc_concluidos = 100;
}
else {
    $porc_concluidos = round(($conta_concluidos / $conta_todos) * 100);
}
?>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Urgente</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo mysqli_num_rows($con_u); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Alta</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo mysqli_num_rows($con_a); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Média</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo mysqli_num_rows($con_m); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-info-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Baixa</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo mysqli_num_rows($con_b); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-question-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-left-secondary h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Solicitações Concluídas (<?php echo $conta_concluidos; ?>/<?php echo $conta_todos; ?>)</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $porc_concluidos; ?><small>%</small></div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-secondary" role="progressbar" style="width: <?php echo $porc_concluidos; ?>%" aria-valuenow="<?php echo $porc_concluidos; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
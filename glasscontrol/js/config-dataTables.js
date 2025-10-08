/* Tabelas SEM PAGINAÇÃO */
$(document).ready(function() {
    $('#dataTableUsuarios, #dataTableSetores').DataTable( {
        paging: false
    } );
} );

/* Tabelas SEM ORDENAÇÃO */
$(document).ready(function() {
    $('#dataTableSolicitacoes').DataTable( {
        order: [[8, "desc"]],
        lengthMenu: [[100, 200, 300, 500], [100, 200, 300, 500]]
    } );
} );
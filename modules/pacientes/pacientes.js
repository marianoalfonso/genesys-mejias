$(document).ready(function () {
    $('#example').DataTable({
        "language": {
            "lengthMenu": "mostrar _MENU_ registros",
            "zeroRecords": "no se encontraron resultados",
            "info": "mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "buscar",
            "oPaginate": {
                "sFirst": "primero",
                "sLast": "ultimo",
                "sNext": "siguiente",
                "sPrevious": "anterior"
            },
            "sProcessing": "procesando...",
        }
    });
});
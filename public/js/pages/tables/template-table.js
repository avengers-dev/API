$(function () {
    var length = 20;
    $('.js-basic-example').DataTable({
        ordering: false,
        dom: 'Bfrtip',
        responsive: true,
        lengthMenu: [length],
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    $('.testt').DataTable({
        dom: 'Bfrtip',
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false,
        buttons: [
            {
                extend: 'print',
                text: 'Print all'
            }
        ]
    })
    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
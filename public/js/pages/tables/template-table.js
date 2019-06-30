$(function () {
    var length = 100000;
    $('.js-basic-example').DataTable({
        ordering: false,
        dom: 'Bfrtip',
        responsive: true,
        lengthMenu: [length],
        "bInfo" : false,
        language: {
            searchPlaceholder: "Ký tự đầu tiên của tên ..."
        },
        buttons: [
            'copy', 
            {
                extend: 'excel',
                text: 'Excel all'
            },
            {
                extend: 'print',
                text: 'Print all'
            }
        ]
    });
    $('.testt').DataTable({
        dom: 'Bfrtip',
        "paging":   false,
        "ordering": false,
        lengthMenu: [length],
        "info":     false,
        "searching": false,
        buttons: [
            {
                extend: 'excel',
            },
            {
                extend: 'print',
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
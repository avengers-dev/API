$(function () {
    $('.js-basic-example').DataTable({
        ordering: false,
        dom: 'Bfrtip',
        responsive: true,
        "paging": false,
        "bInfo" : false,
        "searching": false,
        // columnDefs: [
        //     {
        //        targets: '_all',
        //     //    data: null,
        //        render: function ( data, type, row, meta ) {
        //           if(type === 'abc')
        //               return "abc";
                
        //           return data;
        //        }
        //     }
        //   ],
        buttons: [
            'copy', 
            {
                extend: 'excel',
                text: 'Excel all',
            },
            {
                extend: 'print',
                text: 'Print all',
                exportOptions: {
                    stripHtml: false,
                    stripNewlines: false,
                    // orthogonal: 'abc'
                }
            }
        ],
        // "columns": [
        //     null,
        //     null,
        //     { "width": "10%" },
        //     null,
        //     null
        //   ]
    });
    $('.testt').DataTable({
        dom: 'Bfrtip',
        "paging":   false,
        "ordering": false,
        "paging": false,
        "info":     false,
        "searching": false,
        buttons: [
            {
                extend: 'excel',
            },
            {
                extend: 'print',
            }
        ],
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
$(function () {
    $('.main-table').DataTable({
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
        "columns": [
            { "width": "10%" },
            null,
            null,
            null,
            null
          ]
    });
    $('.main2-table').DataTable({
        ordering: false,
        dom: 'Bfrtip',
        responsive: true,
        "paging": false,
        "bInfo" : false,
        "searching": true,
        language: {
            searchPlaceholder: "Tìm kiếm . . .",
            search : '' /*Empty to remove the label*/
        },
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
                }
            }
        ],
        "columns": [
            { "width": "1%" },
            null,
            { "width": "20%" },
            { "width": "5%" },
            { "width": "15%" },
            { "width": "15%" },
            { "width": "15%" },
            { "width": "5%" },
          ]
    });
    $('.main3-table').DataTable({
        ordering: false,
        dom: 'Bfrtip',
        responsive: true,
        "paging": false,
        "bInfo" : false,
        "searching": true,
        language: {
            searchPlaceholder: "Tìm kiếm . . .",
            search : '' /*Empty to remove the label*/
        },
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
                }
            }
        ],
        "columns": [
            { "width": "5%" },
            null,
            null,
            null,
            null,
            null,
          ]
    });
    $('.main4-table').DataTable({
        ordering: false,
        dom: 'Bfrtip',
        responsive: true,
        "paging": false,
        "bInfo": false,
        "searching": true,
        language: {
            searchPlaceholder: "Tìm kiếm . . .",
            search : '' /*Empty to remove the label*/
        },
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
                }
            }
        ],
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
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
                },
                title: "Sinh Viên Vi Phạm Toàn Trường"
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
                },
                title: "Danh Sách Giảng Viên"
            }
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
                },
                title: "tên lớp"
            }
        ],
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
                },
                title: "Danh Sách Các Môn"
            }
        ],
        "columns": [
            { "width": "5%" },
            null,
            null,
            { "width": "5%" },
          ]
    });
    $('.main5-table').DataTable({
        ordering: false,
        dom: 'Bfrtip',
        responsive: true,
        "paging": false,
        "bInfo": false,
        "searching": false,
        "columns": [
            { "width": "5%" },
            null,
            null,
            null,
            null,
            null,
            null,
          ],
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
                },
                title: "Họ Tên Giảng Viên"
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
                title: "Sinh Viên Vi Phạm Toàn Trường"
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
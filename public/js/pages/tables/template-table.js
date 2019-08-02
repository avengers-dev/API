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
                filename: 'Sinh Viên Vắng Toàn Trường - Chi Tiết'
            },
            {
                extend: 'print',
                text: 'Print all',
                exportOptions: {
                    stripHtml: false,
                    stripNewlines: false,
                    // orthogonal: 'abc'
                },
                title: "Sinh Viên Vắng Toàn Trường - Chi Tiết"
            }
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
                filename: 'Danh Sách Giảng Viên'
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
                filename: 'Danh sách lớp -  Tên Lớp'
            },
            {
                extend: 'print',
                text: 'Print all',
                exportOptions: {
                    stripHtml: false,
                    stripNewlines: false,
                },
                title: "Danh sách lớp: Tên Lớp"
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
                filename: 'Danh Sách Môn Học'
            },
            {
                extend: 'print',
                text: 'Print all',
                exportOptions: {
                    stripHtml: false,
                    stripNewlines: false,
                },
                title: "Danh Sách Môn Học"
            }
        ],
    });
    $('.main5-table').DataTable({
        ordering: false,
        dom: 'Bfrtip',
        responsive: true,
        "paging": false,
        "bInfo": false,
        "searching": false,
          buttons: [
            'copy',
            {
                extend: 'excel',
                text: 'Excel all',
                filename: 'Lịch dạy - Họ Tên Giảng Viên - Mã Giảng Viên'
            },
            {
                extend: 'print',
                text: 'Print all',
                exportOptions: {
                    stripHtml: false,
                    stripNewlines: false,
                },
                title: "Lịch dạy - Họ Tên Giảng Viên - Mã Giảng Viên"
            }
        ],
    });
    $('.main6-table').DataTable({
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
                filename: 'Danh Sách Quản Trị Viên'
            },
            {
                extend: 'print',
                text: 'Print all',
                exportOptions: {
                    stripHtml: false,
                    stripNewlines: false,
                },
                title: "Danh Sách Quản Trị Viên"
            }
        ],
    });
    $('.main7-table').DataTable({
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
                filename: 'Danh Sách Các Lớp'
            },
            {
                extend: 'print',
                text: 'Print all',
                exportOptions: {
                    stripHtml: false,
                    stripNewlines: false,
                },
                title: "Danh Sách Các Lớp"
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
                filename: 'Sinh Viên Vắng Toàn Trường'
            },
            {
                extend: 'print',
                title: "Sinh Viên Vắng Toàn Trường"
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
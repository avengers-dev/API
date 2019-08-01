<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>
        <?php
        if (Session::has('taikhoan')) {
            $taikhoan = Session::get('taikhoan');
            if ($taikhoan['chucvu'] == "CTSV") {
                echo "Phòng Công Tác Sinh Viên ";
            } else {
                echo "Phòng Quản Lí Đào Tạo ";
            }
        }
        ?>
        ITC</title>


    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-blue">

    @include('menu')

    <section class="content">
        @yield('content')
    </section>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="plugins/jquery-steps/jquery.steps.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/tables/template-table.js"></script>
    <script src="js/pages/forms/form-validation.js"></script>
    <script src="js/pages/forms/basic-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.add-mon-day', function() {
                title = $(this).attr('data-hogv') + " " + $(this).attr('data-tengv') + " - " + $(this).attr('data-magv');
                $.ajax({
                    url: '/add-mon-day/' + $(this).attr('data-magv'),
                    type: 'GET',
                    success: function(result) {
                        $('.clearfix').html(result);
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
                                    filename: 'Lịch dạy - ' + title
                                },
                                {
                                    extend: 'print',
                                    text: 'Print all',
                                    exportOptions: {
                                        stripHtml: false,
                                        stripNewlines: false,
                                    },
                                    title: 'Lịch dạy - ' + title
                                }
                            ],
                        });
                    }
                });
            })
            $(document).on('click', '.delete-buoiday', function() {
                title = $(this).attr('data-hogv') + " " + $(this).attr('data-tengv') + " - " + $(this).attr('data-ma-gv');
                $.ajax({
                    url: '/delete-buoiday/' + $(this).attr('data-ma-gv') + '/' + $(this).attr('data-buoi-day'),
                    type: 'GET',
                    success: function(result) {
                        $('.lich-day-giang-vien').html(result);
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
                                    filename: 'Lịch dạy - ' + title
                                },
                                {
                                    extend: 'print',
                                    text: 'Print all',
                                    exportOptions: {
                                        stripHtml: false,
                                        stripNewlines: false,
                                    },
                                    title: 'Lịch dạy - ' + title
                                }
                            ],
                        });
                    }
                });
            })
            $(document).on('click', '.delete-mh', function() {
                $.ajax({
                    url: '/delete-mh/' + $(this).attr('data-mamh'),
                    type: 'GET',
                    success: function(result) {
                        $('.table-responsive').html(result);
                        $('.main4-table').DataTable({
                            ordering: false,
                            dom: 'Bfrtip',
                            responsive: true,
                            "paging": false,
                            "bInfo": false,
                            "searching": true,
                            language: {
                                searchPlaceholder: "Tìm kiếm . . .",
                                search: '' /*Empty to remove the label*/
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
                    }
                });
            })
            $(document).on('click', '.delete-sv', function() {
                const ten_lophoc = $('.malop').find('span').html();
                $.ajax({
                    url: '/delete-sv/' + $(this).attr('data-malop') + '/' + $(this).attr('data-masv'),
                    type: 'GET',
                    success: function(result) {
                        $('.table-responsive').html(result);
                        $('.main3-table').DataTable({
                            ordering: false,
                            dom: 'Bfrtip',
                            responsive: true,
                            "paging": false,
                            "bInfo": false,
                            "searching": true,
                            language: {
                                searchPlaceholder: "Tìm kiếm . . .",
                                search: '' /*Empty to remove the label*/
                            },
                            buttons: [
                                'copy',
                                {
                                    extend: 'excel',
                                    text: 'Excel all',
                                    filename: "Danh sách lớp - " + ten_lophoc
                                },
                                {
                                    extend: 'print',
                                    text: 'Print all',
                                    exportOptions: {
                                        stripHtml: false,
                                        stripNewlines: false,
                                    },
                                    title: "Danh sách lớp: " + ten_lophoc
                                }
                            ],
                        });
                    }
                });
            })
            $(document).on('click', '.delete-taikhoan', function() {
                $.ajax({
                    url: '/delete-quan-tri/' + $(this).attr('data-taikhoan'),
                    type: 'GET',
                    success: function(result) {
                        $('.table-responsive').html(result);
                        $('.main6-table').DataTable({
                            ordering: false,
                            dom: 'Bfrtip',
                            responsive: true,
                            "paging": false,
                            "bInfo": false,
                            "searching": true,
                            language: {
                                searchPlaceholder: "Tìm kiếm . . .",
                                search: '' /*Empty to remove the label*/
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
                    }
                });
            })
            $(document).on('click', '.reset-pass-gv', function() {
                $.ajax({
                    url: '/reset-pass-gv/' + $(this).attr('data-magv'),
                    type: 'GET',
                    success: function(result) {
                        swal({
                            title: "Mật khẩu đặt lại thành công!",
                            text: " Mật khẩu: Kí tự đầu tên giảng viên in hoa + mã giảng viên",
                            type: "success"
                        }, function() {
                            window.location.href = '/dt';
                        });
                    }
                });
            })
            $(document).on('click', '.edit-gv', function() {
                title = $(this).attr('data-hogv') + " " + $(this).attr('data-tengv') + " - " + $(this).attr('data-magv');
                $.ajax({
                    url: '/edit-gv/' + $(this).attr('data-magv'),
                    type: 'GET',
                    success: function(result) {
                        $('.clearfix').html(result);
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
                                    filename: 'Lịch dạy - ' + title
                                },
                                {
                                    extend: 'print',
                                    text: 'Print all',
                                    exportOptions: {
                                        stripHtml: false,
                                        stripNewlines: false,
                                    },
                                    title: 'Lịch dạy - ' + title
                                }
                            ],
                        });
                    }
                });
            })
            $(document).on('click', '.delete-gv', function() {
                $.ajax({
                    url: '/delete-gv/' + $(this).attr('data-magv'),
                    type: 'GET',
                    success: function(result) {
                        $('.table-responsive').html(result);
                        $('.main2-table').DataTable({
                            ordering: false,
                            dom: 'Bfrtip',
                            responsive: true,
                            "paging": false,
                            "bInfo": false,
                            "searching": true,
                            language: {
                                searchPlaceholder: "Tìm kiếm . . .",
                                search: '' /*Empty to remove the label*/
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
                    }
                });
            })
            $(document).on('click', '.quan-tri-vien', function() {
                $('#ten_lophoc_search').html("Danh Sách Quản Trị Viên <a href='{{ route('quan-tri-vien') }}'><button style='float:right' type='button' class='btn btn-primary waves-effect'>Thêm Quản Trị Viên</button></a>");
                $.get('/load-quan-tri', function(data) {
                    $('.table-responsive').html(data);
                    $('.main6-table').DataTable({
                        ordering: false,
                        dom: 'Bfrtip',
                        responsive: true,
                        "paging": false,
                        "bInfo": false,
                        "searching": true,
                        language: {
                            searchPlaceholder: "Tìm kiếm . . .",
                            search: '' /*Empty to remove the label*/
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
                })
            })
            $(document).on('click', '.monhoc', function() {
                $('#ten_lophoc_search').html("Danh Sách Môn Học <a href='{{route('add-monhoc')}}'><button style='float:right' type='button' class='btn btn-primary waves-effect'>Thêm Môn Học</button></a>");
                $.get('/load-danh-sach-mon-hoc', function(data) {
                    $('.table-responsive').html(data);
                    $('.main4-table').DataTable({
                        ordering: false,
                        dom: 'Bfrtip',
                        responsive: true,
                        "paging": false,
                        "bInfo": false,
                        "searching": true,
                        language: {
                            searchPlaceholder: "Tìm kiếm . . .",
                            search: '' /*Empty to remove the label*/
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
                })
            })
            $('body').on('click', '.malop', function() {
                $('.malop').removeClass('active');
                $(this).addClass('active');
                const ten_lophoc = $(this).find('span').html();
                $.ajax({
                    url: '/search-danh-sach-sinh-vien-theo-malop/' + $(this).attr(
                        'data-malop'),
                    type: 'GET',
                    success: function(result) {

                        $('.table-responsive').html(result);
                        $('#ten_lophoc_search').html('Lớp : ' + ten_lophoc + "<a href=\"{{route('add-gv')}}\"><button style=\"float:right\" type=\"button\" class=\"btn btn-primary waves-effect\">Thêm Sinh Viên</button></a>");
                        $('.main3-table').DataTable({
                            ordering: false,
                            dom: 'Bfrtip',
                            responsive: true,
                            "paging": false,
                            "bInfo": false,
                            "searching": true,
                            language: {
                                searchPlaceholder: "Tìm kiếm . . .",
                                search: '' /*Empty to remove the label*/
                            },
                            buttons: [
                                'copy',
                                {
                                    extend: 'excel',
                                    text: 'Excel all',
                                    filename: "Danh sách lớp - " + ten_lophoc
                                },
                                {
                                    extend: 'print',
                                    text: 'Print all',
                                    exportOptions: {
                                        stripHtml: false,
                                        stripNewlines: false,
                                    },
                                    title: "Danh sách lớp: " + ten_lophoc
                                }
                            ],
                        });
                    }
                })
            })
            $('body').on('click', '.lop', function() {
                $('.lop').removeClass('active');
                $(this).addClass('active');
                const ten_lophoc = $(this).find('span').html();
                const title = "Lớp: " + ten_lophoc;
                $.ajax({
                    url: '/search-danh-sach-sinh-vien-vi-pham-theo-malop/' + $(this).attr(
                        'data-malop'),
                    type: 'GET',
                    success: function(result) {

                        $('.table-responsive').html(result);
                        $('#ten_lophoc_search').html('Lớp : ' + ten_lophoc);
                        $('.main-table').DataTable({
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
                                    filename: title
                                },
                                {
                                    extend: 'print',
                                    text: 'Print all',
                                    exportOptions: {
                                        stripHtml: false,
                                        stripNewlines: false,
                                    },
                                    title: title
                                }
                            ],
                        });
                        $('.testt').DataTable({
                            dom: 'Bfrtip',
                            "paging": false,
                            "ordering": false,
                            "paging": false,
                            "info": false,
                            "searching": false,
                            buttons: [{
                                    extend: 'excel',
                                },
                                {
                                    extend: 'print',
                                    title: title
                                }
                            ],
                        })
                    }
                })
            })
            $('body').on('click', '.toggle_chitiet_sv_vipham', function() {
                const masv = $(this).attr('data-masv');
                // $('.toogle').slideUp(1);

                // $('.toggle_chitiet_sv_vipham').css({
                //     'background': 'white'
                // })
                $('.toggle_chitiet_sv_vipham').css({
                    'font-weight': 'normal'
                })
                $(this).css({
                    'background': 'rgba(80,172,244,0.5)'
                });
                $(this).css({
                    'font-weight': 'bold'
                });
                $('.toogle_chitiet_' + masv).slideToggle();

            });
            $('body').on('click', '.menu_itc', function() {
                $('.menu_itc').removeClass('active');
                $(this).addClass('active');
            });
            $(document).on('keyup', '.search_ngay_vang', function(event) {
                var so_ngay_vang = $(this).val();
                if (so_ngay_vang == '') {
                    Number(so_ngay_vang);
                    so_ngay_vang = 0;
                }
                $.ajax({
                    url: '/search-danh-sach-sinh-vien-vi-pham-theo-so-ngay-vang/' + so_ngay_vang,
                    type: 'GET',
                    success: function(result) {
                        $('#danhsach_sinhvien_vipham').html(result);
                    }
                })
            })
            $(document).on('keyup', '.search_mssv', function() {
                const mssv = $(this).val();
                const url = "{{route('search_msv')}}";
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        mssv
                    },
                    success: function(data) {
                        $('#danhsach_sinhvien_vipham').html(data);
                    }
                })
            });
        })
    </script>
</body>

</html>
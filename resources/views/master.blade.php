<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Admin ITC</title>
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

    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

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

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

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

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
    <script>
        $(function() {
            $('body').on('click', '.lop', function() {
                $('.lop').removeClass('active');
                $(this).addClass('active');
                const ten_lophoc = $(this).find('span').html();
                $.ajax({
                    url: '/search-danh-sach-sinh-vien-vi-pham-theo-malop/' + $(this).attr('data-malop'),
                    type: 'GET',
                    success: function(result) {
                        $('#danhsach_sinhvien_vipham').html(result);
                        $('#ten_lophoc_search').html('Lớp : ' + ten_lophoc);
                    }
                })
            })
            $('body').on('click', '.toggle_chitiet_sv_vipham', function() {
                const masv = $(this).attr('data-masv');
                // $('.toogle').slideUp(1);
                
                $('.toggle_chitiet_sv_vipham').css({'background':'white'})
                $('.toggle_chitiet_sv_vipham').css({'font-weight':'normal'})
                $(this).css({'background':'rgba(247, 91, 91, 0.38)'});
                $(this).css({'font-weight':'bold'});
                $('.toogle_chitiet_'+masv).slideToggle();
                
            });
            $('body').on('click','.menu_itc',function(){
                $('.menu_itc').removeClass('active');
                $(this).addClass('active');
            });
            $('body').on('keyup','.search_ngay_vang',function(event){
                var so_ngay_vang = $(this).val();
                if(so_ngay_vang == ''){
                    Number(so_ngay_vang);
                    so_ngay_vang = 0;
                }
                $.ajax({
                    url : '/search-danh-sach-sinh-vien-vi-pham-theo-so-ngay-vang/'+so_ngay_vang,
                    type:'GET',
                    success:function(result){
                        $('#danhsach_sinhvien_vipham').html(result);
                    }
                })
            })
        })
    </script>
</body>

</html>
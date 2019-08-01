<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Xin đợi trong giây lát...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Search Bar -->
<div class="search-bar">
    <input type="text" placeholder="Tìm kiếm ...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
</div>
<!-- #END# Search Bar -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand">
                <?php
                if (Session::has('taikhoan')) {
                    $taikhoan = Session::get('taikhoan');
                    if ($taikhoan['chucvu'] == "CTSV") {
                        echo "Phòng Công Tác Sinh Viên ";
                    } else {
                        if ($taikhoan['chucvu'] == "DT") {
                            echo "Phòng Quản Lí Đào Tạo ";
                        } else {
                            echo "Admin - Phòng Quản Lí Đào Tạo ";
                        }
                    }
                }
                ?>
                - ITC
            </a>
        </div>
    </div>
</nav>
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <!-- <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div> -->
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:110%">
                    <?php
                    if (Session::has('taikhoan')) {
                        $taikhoan = Session::get('taikhoan');
                        echo $taikhoan['hogv'] . " " . $taikhoan['tengv'];
                    }
                    ?>
                </div>
                <div class="email" style="font-size:110%">
                    <?php
                    if (Session::has('taikhoan')) {
                        $taikhoan = Session::get('taikhoan');
                        echo $taikhoan['taikhoan'];
                    }
                    ?>
                </div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <!-- <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="separator" class="divider"></li> -->
                        <li><a href="{{ route('post_logout_admin') }}"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <?php
            if (Session::has('taikhoan')) {
                $taikhoan = Session::get('taikhoan');
                if ($taikhoan['chucvu'] == "CTSV") {
                    ?>
                    <ul class="list">
                        <li class="active">
                            <a class="menu-toggle">
                                <i class="material-icons col-red">donut_large</i>
                                <span>Warning</span>
                            </a>
                            <ul class="ml-menu">
                                <li class="menu_itc active">
                                    <a href="{{ route('ctsv') }}">
                                        <i class="material-icons" style="margin-left:-5px;">view_list</i>
                                        <span>Tất cả</span>
                                    </a>
                                </li>
                                <li class="menu_itc">
                                    <a class="menu-toggle">
                                        <i class="material-icons">view_list</i>
                                        <span>Lớp</span>
                                    </a>
                                    <ul class="ml-menu">
                                        @foreach($lops as $lop)
                                        <li class="lop" data-malop="{{$lop->malop}}">
                                            <a>
                                                <i class="material-icons">school</i>
                                                <span style="font-size:12px;">{{$lop->tenlop}}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                <?php
                } else {
                    ?>
                    <ul class="list">
                        <li class="active">
                            <a class="menu-toggle">
                                <i class="material-icons col-blue">donut_large</i>
                                <span>Danh sách</span>
                            </a>
                            <ul class="ml-menu">
                                <li class="menu_itc active">
                                    <a href="{{ route('dt') }}">
                                        <i class="material-icons">view_list</i>
                                        <span>Giảng viên</span>
                                    </a>
                                </li>
                                <li class="menu_itc">
                                    <a class="menu-toggle">
                                        <i class="material-icons">view_list</i>
                                        <span>Lớp</span>
                                    </a>
                                    <ul class="ml-menu">
                                        @foreach($lops as $lop)
                                        <li class="malop" data-malop="{{$lop->malop}}">
                                            <a>
                                                <i class="material-icons">school</i>
                                                <span style="font-size:12px;">{{$lop->tenlop}}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="monhoc menu_itc">
                                    <a>
                                        <i class="material-icons">view_list</i>
                                        <span>Môn học</span>
                                    </a>
                                </li>
                                <?php
                                    if ($taikhoan['chucvu'] == "AD") {
                                ?>
                                <li class="quan-tri-vien menu_itc">
                                    <a>
                                        <i class="material-icons">view_list</i>
                                        <span>Quản trị viên</span>
                                    </a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </li>
                    </ul>
                <?php
                }
            }
            ?>
        </div>
        <!-- #Menu -->

    </aside>
    <!-- #END# Left Sidebar -->
</section>
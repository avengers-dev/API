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
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
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
            <a class="navbar-brand" href="/">Phòng Đào Tạo - ITC</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Call Search -->
                <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
            </ul>
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
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:110%">Trần Công Mua
                </div>
                <div class="email" style="font-size:110%">muatc@itc.edu.vn</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <!-- <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="separator" class="divider"></li> -->
                        <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="active">
                    <a class="menu-toggle">
                        <i class="material-icons col-red">donut_large</i>
                        <span>Warning</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="menu_itc active">
                            <a  class="menu-toggle" href="{{ route('index') }}" >
                                <i class="material-icons">view_list</i>
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
                                <li>
                                    <a class="lop" data-malop="{{$lop->malop}}">
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
        </div>
        <!-- #Menu -->

    </aside>
    <!-- #END# Left Sidebar -->
</section>
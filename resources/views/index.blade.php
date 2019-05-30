@extends('master')
@section('content')
<div class="container-fluid">
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2 id="ten_lophoc_search">
                        Sinh Viên Vi Phạm Toàn Trường
                    </h2>

                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle btn btn-primary" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                Chọn Lớp
                            </a>
                            <ul class="dropdown-menu pull-right" style="width:250px;">
                                <li><a>aaaa</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table display table-bordered table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th style="width:20%;">Số Thứ Tự</th>
                                    <th style="width:20%;">Mã Số Sinh Viên</th>
                                    <th style="width:30%;">Họ Sinh Viên</th>
                                    <th style="width:15%;">Tên Sinh Viên</th>
                                    <th style="width:15%;">Số Điện Thoại</th>
                                </tr>
                            </thead>
                            <tbody id="danhsach_sinhvien_vipham">
                                <?php $stt = 0;?>
                                @foreach($ds_sinhvien_vipham as $item)
                                <?php $stt++;?>
                                <tr class='toggle_chitiet_sv_vipham' data-masv="{{$item->masv}}" >
                                    <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$stt}}</td>
                                    <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$item->masv}}</td>
                                    <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$item->hosv}}</td>
                                    <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$item->tensv}}</td>
                                    <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$item->sdt}}</td>
                                </tr>
                                <?php 
                                    foreach($item['mamh'] as $key => $value){
                                ?>
                                    <tr class="toogle toogle_chitiet_{{$item->masv}}" style="background:rgba(243, 224, 224, 0.68);display:none;">
                                        <td style="border:0;">
                                            Môn học: <?php echo $key?>
                                        </td>
                                        <td  style="border:0;">Số buổi vắng : <?php echo count($value )?></td>
                                        <td  style="border:0;">Ngày vắng: <?php foreach($value as $k) {echo $k." , ";} ?></td>
                                        <td  style="border:0;"></td>
                                        <td  style="border:0;"></td>
                                    </tr>
                                <?php }  ?>
                                
                                
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table display table-bordered table-hover testt dataTable">
                            <thead style="display: none">
                                <tr>
                                    <th style="width:20%;">Số Thứ Tự</th>
                                    <th style="width:20%;">Mã Số Sinh Viên</th>
                                    <th style="width:30%;">Họ Sinh Viên</th>
                                    <th style="width:15%;">Tên Sinh Viên</th>
                                    <th style="width:15%;">Số Điện Thoại</th>
                                </tr>
                            </thead>
                            <tbody style="display: none" id="danhsach_sinhvien_vipham">
                                <?php $stt = 0;?>
                                @foreach($ds_sinhvien_vipham as $item)
                                <?php $stt++;?>
                                <tr class='toggle_chitiet_sv_vipham' data-masv="{{$item->masv}}" >
                                    <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$stt}}</td>
                                    <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$item->masv}}</td>
                                    <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$item->hosv}}</td>
                                    <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$item->tensv}}</td>
                                    <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$item->sdt}}</td>
                                </tr>
                                
                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Basic Examples -->
</div>
@endsection
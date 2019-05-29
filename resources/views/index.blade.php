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
                                    <th>Mã Số Sinh Viên</th>
                                    <th>Tên Sinh Viên</th>
                                    <th>Môn Học</th>
                                    <th>Số Ngày Vắng</th>
                                </tr>
                            </thead>
                            <tbody id="danhsach_sinhvien_vipham">
                                @foreach($ds_sinhvien_vipham as $item)
                                <tr id='toggle_chitiet_sv_vipham' @if(count($item->ngay_cup_hoc) > 2) class="vi_pham_lan_3" @endif>
                                    <td>{{$item->masv}}</td>
                                    <td>{{$item->tensv}}</td>
                                    <td>
                                        @foreach($monhocs as $monhoc)
                                        @if($item->mamh == $monhoc->mamh)
                                        {{$monhoc->tenmh}}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td @if(count($item->ngay_cup_hoc) > 2) style="color:red" @endif >
                                        {{count($item->ngay_cup_hoc)}}
                                    </td>
                                </tr>
                               
                                <tr class="thontin_sinhvien_vipham_cha" style="display:none;">
                                    <td>
                                        Môn học: LTLT
                                    </td>
                                    <td>Số buổi vắng : 3</td>
                                    <td>Ngày vắng: 2019-05-19 , 2019-05-19</td>
                                    <td></td>
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
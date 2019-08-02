@extends('master')
@section('content')
<div class="container-fluid">
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2 id="ten_lophoc_search">
                        Sinh Viên Vắng Toàn Trường
                    </h2>
                    <script>
                        function isNumber(event) {
                            if (event.which < 46 || event.which > 57)
                                return false;
                            return true;
                        }
                    </script>
                    <ul class="header-dropdown m-r--5">
                        <input maxlength="2" type="text" onkeypress="return isNumber(event)" class='search_ngay_vang form-control' placeholder="Số ngày vắng tối thiểu ...">
                    </ul>
                    <ul class="header-dropdown m-r--5" style="margin-right:200px;">
                        <input maxlength="20" type="text" onkeypress="return isNumber(event)" class='search_mssv form-control' placeholder="Nhập mã số sinh viên ...">
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive get_data_sinhvien">
                        <table class="table display table-bordered table-hover main-table dataTable">
                            <thead>
                                <tr>
                                    <th style="width:20%;">STT</th>
                                    <th style="width:20%;">Mã</th>
                                    <th style="width:30%;">Họ</th>
                                    <th style="width:15%;">Tên</th>
                                    <th style="width:15%;">Số Điện Thoại</th>
                                </tr>
                            </thead>
                            <tbody id="danhsach_sinhvien_vipham">
                                <?php $stt = 0;
                                foreach ($ds_sinhvien_vipham as $item) {
                                    $stt++;
                                    ?>
                                    <tr class='toggle_chitiet_sv_vipham' data-masv="{{$item->masv}}">
                                        <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$stt}}</td>
                                        <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$item->masv}}</td>
                                        <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$item->hosv}}</td>
                                        <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$item->tensv}}</td>
                                        <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$item->sdt}}</td>
                                    </tr>

                                    <?php
                                    foreach ($item['mamh'] as $key => $value) {
                                        ?>
                                        <tr class="toogle toogle_chitiet_{{$item->masv}}" style="background:
                                                                                <?php
                                                                                if (count($value) >= 3) {
                                                                                    echo 'rgba(255,48,48);
                                        font-weight:bold;
                                        color:#f1f1f1';
                                                                                } else {
                                                                                    echo 'rgba(127,196,249,0.3)';
                                                                                }
                                                                                ?>
                                                                                ;display:none;">
                                            <td style="border:0;">
                                                Môn học: <?php echo $key ?>
                                            </td>
                                            <td style="border:0;">Số buổi vắng : <?php echo count($value) ?></td>
                                            <td style="border:0;">Ngày vắng:
                                                <?php
                                                echo "<br>";
                                                $i = 1;
                                                foreach ($value as $ngay) {
                                                    echo  "$i. " . $ngay . " <br> ";
                                                    $i += 1;
                                                }
                                                ?></td>
                                            <td style="border:0;"></td>
                                            <td style="border:0;"></td>
                                        </tr>
                                    <?php }
                                } ?>

                            </tbody>
                        </table>

                        <table class="table display table-bordered table-hover testt dataTable">
                            <thead style="display: none">
                                <tr>
                                    <th style="width:20%;">STT</th>
                                    <th style="width:20%;">Mã</th>
                                    <th style="width:30%;">Họ</th>
                                    <th style="width:15%;">Tên</th>
                                    <th style="width:15%;">Số Điện Thoại</th>
                                </tr>
                            </thead>
                            <tbody style="display: none" id="danhsach_sinhvien_vipham">
                                <?php $stt = 0; ?>
                                @foreach($ds_sinhvien_vipham as $item)
                                <?php $stt++; ?>
                                <tr class='toggle_chitiet_sv_vipham' data-masv="{{$item->masv}}">
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
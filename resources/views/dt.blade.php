@extends('master')
@section('content')
<div class="container-fluid">
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2 id="ten_lophoc_search">
                        Danh Sách Giảng Viên
                        <a href="{{route('add-gv')}}"><button style="float:right" type="button" class="btn btn-primary waves-effect">Thêm giảng viên</button></a>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive get_data_sinhvien">
                        <table class="table display table-bordered table-hover main2-table dataTable">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã</th>
                                    <th>Họ</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>SĐT</th>
                                    <th>Lịch</th>
                                    <th>Quản lí</th>
                                </tr>
                            </thead>
                            <tbody id="danhsach_quanli">
                                <?php $stt = 0;
                                foreach ($ds_giangvien as $item) {
                                    $stt++;
                                    ?>
                                    <tr>
                                        <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$stt}}</td>
                                        <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$item->magv}}</td>
                                        <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$item->hogv}}</td>
                                        <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$item->tengv}}</td>
                                        <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$item->email}}</td>
                                        <td style="border:0.1px solid rgba(0,0,0,0.1);">{{$item->sdt}}</td>
                                        <td style="border:0.1px solid rgba(0,0,0,0.1);">
                                            <?php
                                            if ($item->monday != "") {
                                                foreach ($item->monday as $key => $value) {
                                                    echo "<b>Thứ " . ($key + 1) . " :</b> <br>";
                                                    $st = 0;
                                                    foreach ($value as $k => $v) {
                                                        echo "<b>" . ($st += 1) . ". " . $k . "</b>" . " :<br>";
                                                        foreach ($v as $i => $x) {
                                                            echo "&diams; Ca " . $i . " :<br>";
                                                            foreach ($x as $y) {
                                                                echo "&rsaquo; " . $y . "<br>";
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td style="border:0.1px solid rgba(0,0,0,0.1);">
                                            <a data-magv="{{$item->magv}}" class="edit-gv"><i class="material-icons">edit</i></a>
                                            <a data-magv="{{$item->magv}}" class="delete-gv"><i class="material-icons">delete</i></a>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
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
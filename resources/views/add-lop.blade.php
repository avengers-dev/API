@extends('master')
@section('content')
<div class='container-fluid'>
    <div class='row clearfix'>
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class='card'>
                <div class='header'>
                    <h2 id='ten_lophoc_search'>
                        Thêm Lớp Học
                    </h2>
                </div>
                <div class='body'>
                    <div class='table-responsive get_data_sinhvien'>
                        <form action="{{route('addLop')}}" id='form_validation' method='POST'>
                            <div>
                                <select class='form-control' id='sel2' name='chontinhtrang'>";
                                    <option selected disabled>--Chọn tình trạng-</option>
                                    <option value="TC">Theo tín chỉ</option>
                                    <option value="HL">Học lại</option>
                                </select>
                            </div>
                            <br>
                            <div class='form-group form-float'>
                                <div class='form-line'>
                                    <input type='text' class='form-control' name='malop' required>
                                    <label class='form-label'>Mã</label>
                                </div>
                            </div>
                            <div class='form-group form-float'>
                                <div class='form-line'>
                                    <input type='text' class='form-control' name='tenlop' required>
                                    <label class='form-label'>Tên</label>
                                </div>
                            </div>
                            <button class='btn btn-primary waves-effect' type='submit'>Thêm</button>
                            <button onclick=" window.location.href='{{route('dt')}}'" class='btn btn-danger waves-effect' type='button'>Hủy</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
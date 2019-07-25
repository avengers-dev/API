@extends('master')
@section('content')
<div class='container-fluid'>
    <div class='row clearfix'>
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class='card'>
                <div class='header'>
                    <h2 id='ten_lophoc_search'>
                        Thêm Giảng Viên
                    </h2>
                </div>
                <div class='body'>
                    <div class='table-responsive get_data_sinhvien'>
                        <form action="{{route('addGV')}}" id='form_validation' method='POST'>
                        <div class='form-group form-float'>
                                <div class='form-line'>
                                    <input type='hidden' class='form-control' name='magv' required>
                                </div>
                            </div>
                            <div class='form-group form-float'>
                                <div class='form-line'>
                                    <input type='text' class='form-control' name='magv' required>
                                    <label class='form-label'>Mã giảng viên</label>
                                </div>
                            </div>
                            <div class='form-group form-float'>
                                <div class='form-line'>
                                    <input type='text' class='form-control' name='hogv' required>
                                    <label class='form-label'>Họ</label>
                                </div>
                            </div>
                            <div class='form-group form-float'>
                                <div class='form-line'>
                                    <input type='text' class='form-control' name='tengv' required>
                                    <label class='form-label'>Tên</label>
                                </div>
                            </div>
                            <div class='form-group form-float'>
                                <div class='form-line'>
                                    <input type='email' class='form-control' name='email' required>
                                    <label class='form-label'>Email</label>
                                </div>
                            </div>
                            <div class='form-group form-float'>
                                <div class='form-line'>
                                    <input type='number' class='form-control' name='sdt' required>
                                    <label class='form-label'>Số Điện Thoại</label>
                                </div>
                            </div>
                            <button class='btn btn-primary waves-effect' type='submit'>Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
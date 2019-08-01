@extends('master')
@section('content')
<div class='container-fluid'>
  <div class='row clearfix'>
    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
      <div class='card'>
        <div class='header'>
          <h2 id='ten_lophoc_search'>
            Thêm User
          </h2>
        </div>
        <div class='body'>
          <div class='table-responsive get_data_sinhvien'>
            <form action="{{route('addQTV')}}" method='POST'>
              <div style="margin-bottom:15px;">
                <select class='form-control' name='chonchucvu'>
                  <option disabled selected>- - Chọn chức vụ - -</option>
                  <option>AD</option>
                  <option>DT</option>
                  <option>CTSV</option>
                </select>
              </div>
              <div class='form-group form-float'>
                <div class='form-line'>
                  <input type='text' class='form-control' name='hogv' required>
                  <label class='form-label'>Họ giảng viên</label>
                </div>
              </div>
              <div class='form-group form-float'>
                <div class='form-line'>
                  <input type='text' class='form-control' name='tengv' required>
                  <label class='form-label'>Tên giảng viên</label>
                </div>
              </div>
              <div class='form-group form-float'>
                <div class='form-line'>
                  <input type='text' class='form-control' name='taikhoan' required>
                  <label class='form-label'>Tài khoản</label>
                </div>
              </div>
              <div class='form-group form-float'>
                <div class='form-line'>
                  <input type='password' class='form-control' name='matkhau' required>
                  <label class='form-label'>Mật khẩu</label>
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
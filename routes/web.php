<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Trang đăng nhập admin
Route::get('/', function () {
    return view('index');
})->name('login');

//Xác thực đăng nhập theo chức vụ
Route::group(['middleware' => 'tokenAdmin'], function () {

    Route::get('/dt', 'Api\DTController@index')->name('dt');

    Route::get('/ctsv', 'Api\CTSVController@index')->name('ctsv');
});
Route::post('post-login-admin', 'Api\LoginController@post_login_admin')->name('post_login_admin');
Route::get('post-logout-admin', 'Api\LoginController@post_logout_admin')->name('post_logout_admin');
//Phòng Công Tác Sinh Viên
Route::get('/search-danh-sach-sinh-vien-vi-pham-theo-malop/{malop}', 'Api\CTSVController@searchDanhSachSinhVienViPhamTheoMalop');
Route::get('/search-danh-sach-sinh-vien-vi-pham-theo-so-ngay-vang/{so_ngay_vang}', 'Api\CTSVController@searchDanhSachSinhVienViPhamTheoSoNgayVang');
Route::get('/search-danh-sach-sinh-vien-vi-pham-theo-mssv', 'Api\CTSVController@searchDanhSachSinhVienViPhamTheoMssv')->name('search_msv');
//Phòng Đào Tạo
//Load danh sách sinh viên theo lớp
Route::get('/search-danh-sach-sinh-vien-theo-malop/{malop}', 'Api\DTController@searchDanhSachSinhVienTheoMalop');
//Load danh sách môn học
Route::get('/load-danh-sach-mon-hoc','Api\DTController@loadDanhSachMonHoc')->name('dannh_sach_mon_hoc');
//Xóa giảng viên
Route::get('/delete-gv/{magv}', 'Api\DTController@deleteGV');
//Thay đổi thông tin giảng viên
Route::get('/edit-gv/{magv}', 'Api\DTController@editGV')->name('edit-gv');
Route::post('/save-gv', 'Api\DTController@saveGV')->name('save-gv');
Route::get('/reset-pass-gv/{magv}', 'Api\DTController@resetPassGV')->name('reset-pass-gv');
//Thêm giảng viên
Route::get('/add-gv','Api\DTController@getAddGV')->name('add-gv');
Route::post('/addGV', 'Api\DTController@addGV')->name('addGV');
//Xóa sinh viên
Route::get('/delete-sv/{malop}/{magv}', 'Api\DTController@deleteSV');
//Xóa môn học
Route::get('/delete-mh/{mamh}', 'Api\DTController@deleteMonHoc');
//Thêm môn học
Route::get('/add-monhoc','Api\DTController@getAddMH')->name('add-monhoc');
Route::post('/addMH', 'Api\DTController@addMH')->name('addMH');
//Thay đổi lịch giảng viên
Route::get('/add-mon-day/{magv}','Api\DTController@addMonDay')->name('add-mon-day');
Route::post('/save-mon-day','Api\DTController@saveMonDay')->name('save-mon-day');
//Thêm lớp
Route::get('/add-lop','Api\DTController@getAddLop')->name('add-lop');
Route::post('/addLop','Api\DTController@addLop')->name('addLop');
//Load danh sách các lớp
Route::get('/load-danh-sach-cac-lop','Api\DTController@loadDanhSachCacLop')->name('load-danh-sach-cac-lop');
//Xóa lớp
Route::get('/delete-lop/{malop}','Api\DTController@deleteLop')->name('delete-lop');
//Thêm Sinh Viên
Route::post('/import-excel','Api\DTController@importExcel');

//Admin
//Thêm quản trị viên
Route::get('/add-qtv','Api\DTController@getAddQTV')->name('add-qtv');
Route::post('/addQTV','Api\DTController@addQTV')->name('addQTV');
//Load danh sách quản trị viên
Route::get('/load-quan-tri','Api\DTController@loadQuanTri')->name('load-quan-tri');
//Xóa quản trị viên
Route::get('/delete-quan-tri/{taikhoan}','Api\DTController@deleteQuanTri')->name('delete-quan-tri');
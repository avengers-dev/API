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
Route::get('/', function () {
    return view('index');
})->name('login');
Route::group(['middleware' => 'tokenAdmin'], function () {

    Route::get('/dt', 'Api\DTController@index')->name('dt');

    Route::get('/ctsv', 'Api\CTSVController@index')->name('ctsv');
});

Route::post('post-login-admin', 'Api\LoginController@post_login_admin')->name('post_login_admin');
Route::get('post-logout-admin', 'Api\LoginController@post_logout_admin')->name('post_logout_admin');
Route::get('/search-danh-sach-sinh-vien-vi-pham-theo-malop/{malop}', 'Api\CTSVController@searchDanhSachSinhVienViPhamTheoMalop');
Route::get('/search-danh-sach-sinh-vien-vi-pham-theo-so-ngay-vang/{so_ngay_vang}', 'Api\CTSVController@searchDanhSachSinhVienViPhamTheoSoNgayVang');
Route::get('template-table', function () {
    return view('template-table');
})->name('template-table');
Route::get('/search-danh-sach-sinh-vien-vi-pham-theo-mssv', 'Api\CTSVController@searchDanhSachSinhVienViPhamTheoMssv')->name('search_msv');
Route::get('/search-danh-sach-sinh-vien-theo-malop/{malop}', 'Api\DTController@searchDanhSachSinhVienTheoMalop');
Route::get('/load-danh-sach-mon-hoc','Api\DTController@loadDanhSachMonHoc')->name('dannh_sach_mon_hoc');
Route::get('/delete-gv/{magv}', 'Api\DTController@deleteGV');
Route::get('/edit-gv/{magv}', 'Api\DTController@editGV')->name('edit-gv');
Route::post('/save-gv', 'Api\DTController@saveGV')->name('save-gv');
Route::get('/reset-pass-gv/{magv}', 'Api\DTController@resetPassGV')->name('reset-pass-gv');
Route::get('/add-gv',function(){
    return view('add-gv');
})->name('add-gv');
Route::post('/addGV', 'Api\DTController@addGV')->name('addGV');
Route::get('/delete-sv/{malop}/{magv}', 'Api\DTController@deleteSV');
Route::get('/delete-mh/{mamh}', 'Api\DTController@deleteMonHoc');
Route::get('/add-monhoc',function(){
    return view('add-monhoc');
})->name('add-monhoc');
Route::post('/addMH', 'Api\DTController@addMH')->name('addMH');
Route::get('/delete-buoiday/{magv}/{buoiday}', 'Api\DTController@deleteBuoiDay');
Route::get('/add-mon-day/{magv}','Api\DTController@addMonDay')->name('add-mon-day');
Route::post('/save-mon-day','Api\DTController@saveMonDay')->name('save-mon-day');
Route::get('/quan-tri-vien',function(){
    return view('quan-tri-vien');
})->name('quan-tri-vien');
Route::post('/addQTV','Api\DTController@addQTV')->name('addQTV');
Route::get('/load-quan-tri','Api\DTController@loadQuanTri')->name('load-quan-tri');
Route::get('/delete-quan-tri/{taikhoan}','Api\DTController@deleteQuanTri')->name('delete-quan-tri');
Route::get('/add-lop',function(){
    return view('add-lop');
})->name('add-lop');
Route::post('/addLop','Api\DTController@addLop')->name('addLop');
Route::get('/load-danh-sach-cac-lop','Api\DTController@loadDanhSachCacLop')->name('load-danh-sach-cac-lop');
Route::get('/delete-lop/{malop}','Api\DTController@deleteLop')->name('delete-lop');

Route::post('/import-excel','Api\DTController@importExcel');
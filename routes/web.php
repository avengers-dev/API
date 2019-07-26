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
Route::get('/load-danh-sach-mon-hoc','Api\DTController@loaddanhsachmonhoc')->name('dannh_sach_mon_hoc');
Route::get('/delete-gv/{magv}', 'Api\DTController@deleteGV');
Route::get('/edit-gv/{magv}', 'Api\DTController@editGV')->name('edit-gv');
Route::post('/save-gv', 'Api\DTController@saveGV')->name('save-gv');
Route::get('/reset-pass-gv/{magv}', 'Api\DTController@resetPassGV')->name('reset-pass-gv');
Route::get('/add-gv',function(){
    return view('add-gv');
})->name('add-gv');
Route::post('/addGV', 'Api\DTController@addGV')->name('addGV');
Route::get('/t',function(){
    return view('t');
})->name('t');
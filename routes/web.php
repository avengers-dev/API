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
Route::get('/',function(){
    return view('index');
});

Route::get('/dt',function(){
    return view('dt');
})->name('dt');
Route::post('post-login-admin','Api\LoginController@post_login_admin')->name('post_login_admin');
Route::get('post-logout-admin','Api\LoginController@post_logout_admin')->name('post_logout_admin');
Route::get('/ctsv','Api\CTSVController@index')->name('ctsv');
Route::get('/search-danh-sach-sinh-vien-vi-pham-theo-malop/{malop}','Api\CTSVController@searchDanhSachSinhVienViPhamTheoMalop');
Route::get('/search-danh-sach-sinh-vien-vi-pham-theo-so-ngay-vang/{so_ngay_vang}','Api\CTSVController@searchDanhSachSinhVienViPhamTheoSoNgayVang');
Route::get('template-table',function(){
    return view('template-table');
})->name('template-table');
Route::get('/search-danh-sach-sinh-vien-vi-pham-theo-mssv','Api\CTSVController@searchDanhSachSinhVienViPhamTheoMssv')->name('search_msv');

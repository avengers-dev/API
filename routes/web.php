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

Route::get('/Admin','Api\AdminController@index')->name('index');
Route::get('/search-danh-sach-sinh-vien-vi-pham-theo-malop/{malop}','Api\AdminController@searchDanhSachSinhVienViPhamTheoMalop');
Route::get('/search-danh-sach-sinh-vien-vi-pham-theo-so-ngay-vang/{so_ngay_vang}','Api\AdminController@searchDanhSachSinhVienViPhamTheoSoNgayVang');
Route::get('template-table',function(){
    return view('template-table');
})->name('template-table');
Route::get('/search-danh-sach-sinh-vien-vi-pham-theo-mssv','Api\AdminController@searchDanhSachSinhVienViPhamTheoMssv')->name('search_msv');
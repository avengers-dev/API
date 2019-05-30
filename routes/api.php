<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login','Api\LoginController@login')->middleware('cors');
Route::get('getAllMonHoc','Api\MonHocController@getAllMonHoc');
Route::group(['middleware'=>'validateToken'],function(){   
    Route::post('getDanhSachSinhVien','Api\SinhVienController@getDanhSachSinhVien');

    Route::post('saveDanhSachSinhVien','Api\DiemDanhController@saveDanhSachSinhVien');

    Route::post('getDanhSachSinhVienCheck','Api\DiemDanhController@getDanhSachSinhVienCheck');

    Route::post('saveDanhSachViPham','Api\ViphamController@saveDanhSachViPham');
});



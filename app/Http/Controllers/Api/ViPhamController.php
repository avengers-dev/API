<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ViPhams;

class ViPhamController extends Controller
{
    public function saveDanhSachViPham(Request $request)
    {
        if ($request->input('mamh') && $request->input('danhsachsvdiemdanh')) {
            date_default_timezone_set('asia/ho_chi_minh');
            $ngay_diem_danh = date("Y-m-d");
            $ma_mh = $request->input('mamh');
            $danh_sach_sinh_vien = $request->input('danhsachsvdiemdanh');
            return ViPhams::updateOrInsertDanhSachViPham($ngay_diem_danh,$ma_mh,$danh_sach_sinh_vien);
        }
    }
}

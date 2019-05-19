<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class DiemDanhs extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'diemdanhs';
    public $timestamps = false;
    
    public static function checkDiemDanh($ngay_diem_danh)
    {
        $query = DiemDanhs::all();
        return $query;
    }
    public static function insertNgayDiemDanh($ngay_diem_danh, $ma_gv, $ma_mh, $danh_sach_sinh_vien,$ca)
    {
        $data = [
            $ngay_diem_danh => [
                $ma_gv => [
                    $ma_mh => [
                        $ca => $danh_sach_sinh_vien
                    ]
                ]
            ]
        ];
        DiemDanhs::insert(
            [["ngaydiemdanh" => $ngay_diem_danh,'data' => $data]]
        );
        return $data;
    }
    public static function updateOrInsertDanhSachSinhVien($ngay_diem_danh, $data)
    {
        DiemDanhs::where('ngaydiemdanh', $ngay_diem_danh)->update(['data' => $data]);
        // return DiemDanhs::all();
    }
}

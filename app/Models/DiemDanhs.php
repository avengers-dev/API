<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class DiemDanhs extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'diemdanhs';

    public static function checkDiemDanh($ngay_diem_danh)
    {
        $query = DiemDanhs::all();
        return $query;
    }
    public static function insertNgayDiemDanh($ngay_diem_danh, $ma_gv, $ma_mh, $danh_sach_sinh_vien)
    {
        $result = [];
        foreach($danh_sach_sinh_vien as $key => $value){
            $result[] = [
                'masv' => $danh_sach_sinh_vien[$key]['masv'],
                'check' => $danh_sach_sinh_vien[$key]['check'],
            ];
        }
        $data = [
            $ngay_diem_danh => [
                $ma_gv => [
                    $ma_mh => $result
                ]
            ]
        ];
        DiemDanhs::insert(
            [['ngaydiemdanh' => $data]]
        );
    }
    public static function getDanhSachSinhVienDiemDanh()
    {
        $query = DiemDanhs::select('ngaydiemdanh.')->get()[0];
        return $query;
    }
}

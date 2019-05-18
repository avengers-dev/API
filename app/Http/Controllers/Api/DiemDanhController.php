<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiemDanhs;
use App\Models\GiangViens;

class DiemDanhController extends Controller
{
    public function updateOrInsertDanhSachSinhVien(Request $request)
    {
        if ($request->input('mamh') && $request->input('danhsachsvdiemdanh') && $request->input('ca')) {
            date_default_timezone_set('asia/ho_chi_minh');
            $ngay_diem_danh = date("Y-m-d");
            $ma_gv = GiangViens::where('token', $request->input('token'))->select('magv')->get()
                ->makeHidden('_id');
            $ma_gv = $ma_gv[0]['magv'];
            $ma_mh = $request->input('mamh');
            $ca = $request->input('ca');
            $danh_sach_sinh_vien = $request->input('danhsachsvdiemdanh');
            $data_check_diem_danh = DiemDanhs::checkDiemDanh($ngay_diem_danh);
            $flag_ngaydiemdanh = false;
            $index = 0;
            foreach ($data_check_diem_danh as $key => $value) {
                if (array_key_exists($ngay_diem_danh, $data_check_diem_danh[$key]['data'])) {
                    $flag_ngaydiemdanh = true;
                    $index = $key;
                }
            }
            if ($flag_ngaydiemdanh) {
                $flag_magv = false;
                if (array_key_exists($ma_gv, $data_check_diem_danh[$index]['data'][$ngay_diem_danh])) {
                    $flag_magv = true;
                }
                if ($flag_magv) {
                    $flag_mamh = false;
                    if (array_key_exists($ma_mh, $data_check_diem_danh[$index]['data'][$ngay_diem_danh][$ma_gv])) {
                        $flag_mamh = true;
                    }
                    if ($flag_mamh) {
                        $flag_ca = false;
                        if(array_key_exists($ca,$data_check_diem_danh[$index]['data'][$ngay_diem_danh][$ma_gv][$ma_mh]))
                        {
                            $flag_ca = true;
                        }
                        if($flag_ca){
                            $data_update = $data_check_diem_danh[$index]['data'];
                            $data_update[$ngay_diem_danh][$ma_gv][$ma_mh][$ca] = $danh_sach_sinh_vien;
                            $data = DiemDanhs::updateOrInsertDanhSachSinhVien($ngay_diem_danh, $data_update);
                            $data = $data[0]['data'][$ngay_diem_danh][$ma_gv][$ma_mh];
                            return $this->responses($data, 200, trans('messages.api_success'));
                        }
                        else{
                            $data_insert = $data_check_diem_danh[$index]['data'];
                            $data_insert[$ngay_diem_danh][$ma_gv][$ma_mh][$ca] = $danh_sach_sinh_vien;
                            $data = DiemDanhs::updateOrInsertDanhSachSinhVien($ngay_diem_danh, $data_insert);
                            $data = $data[0]['data'][$ngay_diem_danh][$ma_gv][$ma_mh];
                            return $this->responses($data, 200, trans('messages.api_success'));
                        }
                            
                    }
                    else{
                        $data_insert = $data_check_diem_danh[$index]['data'];
                        $data_insert[$ngay_diem_danh][$ma_gv][$ma_mh][$ca] = $danh_sach_sinh_vien;
                        $data = DiemDanhs::updateOrInsertDanhSachSinhVien($ngay_diem_danh, $data_insert);
                        $data = $data[0]['data'][$ngay_diem_danh][$ma_gv][$ma_mh][$ca];
                        return $this->responses($data, 200, trans('messages.api_success'));
                    }
                } else {
                    $data_insert = $data_check_diem_danh[$index]['data'];
                    $data_insert[$ngay_diem_danh][$ma_gv][$ma_mh][$ca] = $danh_sach_sinh_vien;
                    $data = DiemDanhs::updateOrInsertDanhSachSinhVien($ngay_diem_danh, $data_insert);
                    $data = $data[0]['data'][$ngay_diem_danh][$ma_gv][$ma_mh][$ca];
                    return $this->responses($data, 200, trans('messages.api_success'));
                }
            } 
            else {
                $data = DiemDanhs::insertNgayDiemDanh($ngay_diem_danh, $ma_gv, $ma_mh, $danh_sach_sinh_vien,$ca,$ngay_diem_danh);
                return $this->responses($data, 200, trans('messages.api_success'));
            }
        } 
        else {
            return $this->responses([], 404, trans('messages.api_not_enough_params'));
        }
    }
}

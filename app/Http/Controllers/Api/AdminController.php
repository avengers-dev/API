<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lops;
use App\Models\Monhocs;
use App\Models\Viphams;

class AdminController extends Controller
{
    public function index()
    {
        $ds_sinhvien_vipham = ViPhams::all();
        $lops = Lops::all();
        $monhocs = Monhocs::all();
        session()->put('chon_lop_hoc', "");
        return view('index', compact('ds_sinhvien_vipham', 'lops', 'monhocs'));
    }
    public function searchDanhSachSinhVienViPhamTheoMalop($malop)
    {
        session()->put('chon_lop_hoc', $malop);
        $ds_sinhvien_vipham = ViPhams::all()->toArray();
        $monhocs = Monhocs::all()->toArray();
        $data = [];
        foreach ($ds_sinhvien_vipham as $key => $value) {
            foreach ($value['malop'] as $k) {
                if ($malop == $k) {
                    $data[] = $ds_sinhvien_vipham[$key];
                }
            }
        }
        $stt = 0;
        $string = '';
        foreach ($data as $key => $value) {
            $stt++;
            $string .= "<tr class='toggle_chitiet_sv_vipham' data-masv='" . $value['masv'] . "' >"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>$stt</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['masv'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['hosv'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['tensv'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['sdt'] . "</td>"
                . "</tr>";
            foreach ($value['mamh'] as $k => $v) {
                $ngay_vang = "";
                foreach ($v as $ngay) {
                    $ngay_vang .= $ngay . " , ";
                }
                $string .= "<tr class='toogle toogle_chitiet_" . $value['masv'] . "' style='background:rgba(243, 224, 224, 0.68);display:none;'>"
                . "<td style='border:0;'>"
                . "Môn học: $k"
                . "</td>"
                . "<td  style='border:0;'>Số buổi vắng : " . count($v) . "</td>"
                    . "<td  style='border:0;'>Ngày vắng: $ngay_vang</td>"
                    . "<td  style='border:0;'></td>"
                    . "<td  style='border:0;'></td>"
                    . "</tr>";
            }
        }
        echo $string;
    }
    public function searchDanhSachSinhVienViPhamTheoSoNgayVang($so_ngay_vang)
    {
        if (session()->has('chon_lop_hoc')) {
            if (session('chon_lop_hoc') != '') {
                $ds_sinhvien_vipham = ViPhams::all()->toArray();
                $monhocs = Monhocs::all()->toArray();
                $data = [];
                foreach ($ds_sinhvien_vipham as $key => $value) {
                    foreach ($value['malop'] as $k) {
                        if (session('chon_lop_hoc') == $k) {
                            $data[] = $ds_sinhvien_vipham[$key];
                        }
                    }
                }
                $stt = 0;
                $string = '';
                $result = [];
                foreach ($data as $key => $value) {
                    $flag = false;
                    foreach ($value['mamh'] as $item => $i) {
                        if (count($i) >= $so_ngay_vang) {
                            $flag = true;
                        }
                    }
                    if($flag){
                        $result[] = $data[$key];
                    } 
                }
                foreach ($result as $key => $value) {
                    $stt++;
                    $string .= "<tr class='toggle_chitiet_sv_vipham' data-masv='" . $value['masv'] . "' >"
                        . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>$stt</td>"
                        . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['masv'] . "</td>"
                        . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['hosv'] . "</td>"
                        . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['tensv'] . "</td>"
                        . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['sdt'] . "</td>"
                        . "</tr>";
                    foreach ($value['mamh'] as $k => $v) {
                        $ngay_vang = "";
                        foreach ($v as $ngay) {
                            $ngay_vang .= $ngay . " , ";
                        }
                        $string .= "<tr class='toogle toogle_chitiet_" . $value['masv'] . "' style='background:rgba(243, 224, 224, 0.68);display:none;'>"
                        . "<td style='border:0;'>"
                        . "Môn học: $k"
                        . "</td>"
                        . "<td  style='border:0;'>Số buổi vắng : " . count($v) . "</td>"
                            . "<td  style='border:0;'>Ngày vắng: $ngay_vang</td>"
                            . "<td  style='border:0;'></td>"
                            . "<td  style='border:0;'></td>"
                            . "</tr>";
                    }
                }
                echo $string;

            } else {
                $ds_sinhvien_vipham = ViPhams::all()->toArray();
                $stt = 0;
                $string = '';
                $result = [];
                foreach ($ds_sinhvien_vipham as $key => $value) {
                    $flag = false;
                    foreach ($value['mamh'] as $item => $i) {
                        if (count($i) >= $so_ngay_vang) {
                            $flag = true;
                        }
                    }
                    if($flag){
                        $result[] = $ds_sinhvien_vipham[$key];
                    } 
                }
                foreach ($result as $key => $value) {
                    $stt++;
                    $string .= "<tr class='toggle_chitiet_sv_vipham' data-masv='" . $value['masv'] . "' >"
                        . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>$stt</td>"
                        . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['masv'] . "</td>"
                        . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['hosv'] . "</td>"
                        . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['tensv'] . "</td>"
                        . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['sdt'] . "</td>"
                        . "</tr>";
                    foreach ($value['mamh'] as $k => $v) {
                        $ngay_vang = "";
                        foreach ($v as $ngay) {
                            $ngay_vang .= $ngay . " , ";
                        }
                        $string .= "<tr class='toogle toogle_chitiet_" . $value['masv'] . "' style='background:rgba(243, 224, 224, 0.68);display:none;'>"
                        . "<td style='border:0;'>"
                        . "Môn học: $k"
                        . "</td>"
                        . "<td  style='border:0;'>Số buổi vắng : " . count($v) . "</td>"
                            . "<td  style='border:0;'>Ngày vắng: $ngay_vang</td>"
                            . "<td  style='border:0;'></td>"
                            . "<td  style='border:0;'></td>"
                            . "</tr>";
                    }
                }
                echo $string;
            }
        }
    }
}

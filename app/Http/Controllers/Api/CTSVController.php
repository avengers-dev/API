<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lops;
use App\Models\Monhocs;
use App\Models\Viphams;
use Illuminate\Http\Request;

class CTSVController extends Controller
{
    public function index()
    {
        $ds_sinhvien_vipham = ViPhams::orderBy('tensv')->get();
        $lops = Lops::all();
        $monhocs = Monhocs::all();
        session()->put('chon_lop_hoc', "");
        return view('ctsv', compact('ds_sinhvien_vipham', 'lops', 'monhocs'));
    }

    public function searchDanhSachSinhVienViPhamTheoMalop($malop)
    {
        session()->put('chon_lop_hoc', $malop);
        $ds_sinhvien_vipham =  ViPhams::orderBy('tensv')->get()->toArray();
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
        $string .= "<table class='table display table-bordered table-hover main-table dataTable'>"
            . "<thead>"
            . " <tr>"
            . " <th style='width:20%;'>Số Thứ Tự</th>"
            . " <th style='width:20%;'>Mã Số Sinh Viên</th>"
            . " <th style='width:30%;'>Họ Sinh Viên</th>"
            . "<th style='width:15%;'>Tên Sinh Viên</th>"
            . " <th style='width:15%;'>Số Điện Thoại</th>"
            . " </tr>"
            . "</thead>"
            . "<tbody id='danhsach_sinhvien_vipham'>";
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
                $ngay_vang = "<br>";
                $i = 1;
                foreach ($v as $ngay) {
                    $ngay_vang .= "$i. " . $ngay . " <br> ";
                    $i += 1;
                }
                $string .= "<tr class='toogle toogle_chitiet_" . $value['masv'] . "' style='background:";
                if (count($v) >= 3) {
                    $string .=  'rgba(255,48,48);
                                        font-weight:bold;
                                        color:#f1f1f1';
                } else {
                    $string .=  'rgba(127,196,249,0.3)';
                }
                $string .= ";display:none;'>"
                    . "<td style='border:0;'>"
                    . "Môn học: $k"
                    . "</td>"
                    . "<td  style='border:0;'>Số buổi vắng : " . count($v) . "</td>"
                    . "<td  style='border:0;'>Ngày vắng:$ngay_vang</td>"
                    . "<td  style='border:0;'></td>"
                    . "<td  style='border:0;'></td>"
                    . "</tr>";
            }
        }
        $string .= "</tbody></table>";

        $string .= "<table class='table display table-bordered table-hover testt dataTable'>"
            . "<thead style='display: none'>"
            . " <tr>"
            . " <th style='width:20%;'>Số Thứ Tự</th>"
            . " <th style='width:20%;'>Mã Số Sinh Viên</th>"
            . " <th style='width:30%;'>Họ Sinh Viên</th>"
            . "<th style='width:15%;'>Tên Sinh Viên</th>"
            . " <th style='width:15%;'>Số Điện Thoại</th>"
            . " </tr>"
            . "</thead>"
            . "<tbody style='display: none' id='danhsach_sinhvien_vipham'>";
        $stt = 0;
        foreach ($data as $key => $value) {
            $stt++;
            $string .= "<tr class='toggle_chitiet_sv_vipham' data-masv='" . $value['masv'] . "' >"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>$stt</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['masv'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['hosv'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['tensv'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['sdt'] . "</td>"
                . "</tr>";
        }
        $string .= "</tbody></table>";
        echo $string;
    }
    public function searchDanhSachSinhVienViPhamTheoMssv(Request $request)
    {
        $mssv = $request->mssv;
        if (session()->has('chon_lop_hoc')) {
            if (session()->get('chon_lop_hoc') != '') {
                $ds_sinhvien_vipham = ViPhams::where('masv', 'like', '%' . $mssv . '%')->orderBy('tensv')->get()->toArray();
                if ($mssv == '')
                    $ds_sinhvien_vipham = ViPhams::orderBy('tensv')->get()->toArray();
                //   $monhocs = Monhocs::all()->toArray();
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
                        $ngay_vang = "<br>";
                        $i = 1;
                        foreach ($v as $ngay) {
                            $ngay_vang .= "$i. " . $ngay . " <br> ";
                            $i += 1;
                        }
                        $string .= "<tr class='toogle toogle_chitiet_" . $value['masv'] . "' style='background:";
                        if (count($v) >= 3) {
                            $string .=  'rgba(255,48,48);
                                  font-weight:bold;
                                  color:#f1f1f1';
                        } else {
                            $string .=  'rgba(127,196,249,0.3)';
                        }
                        $string .= ";display:none;'>"
                            . "<td style='border:0;'>"
                            . "Môn học: $k"
                            . "</td>"
                            . "<td  style='border:0;'>Số buổi vắng : " . count($v) . "</td>"
                            . "<td  style='border:0;'>Ngày vắng:$ngay_vang</td>"
                            . "<td  style='border:0;'></td>"
                            . "<td  style='border:0;'></td>"
                            . "</tr>";
                    }
                }
                echo $string;
            } else {
                $ds_sinhvien_vipham = ViPhams::where('masv', 'like', '%' . $mssv . '%')->orderBy('tensv')->get()->toArray();
                if ($mssv == '')
                    $ds_sinhvien_vipham =  ViPhams::orderBy('tensv')->get()->toArray();
                $stt = 0;
                $string = '';
                foreach ($ds_sinhvien_vipham as $key => $value) {
                    $stt++;
                    $string .= "<tr class='toggle_chitiet_sv_vipham' data-masv='" . $value['masv'] . "' >"
                        . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>$stt</td>"
                        . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['masv'] . "</td>"
                        . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['hosv'] . "</td>"
                        . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['tensv'] . "</td>"
                        . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['sdt'] . "</td>"
                        . "</tr>";
                    foreach ($value['mamh'] as $k => $v) {
                        $ngay_vang = "<br>";
                        $i = 1;
                        foreach ($v as $ngay) {
                            $ngay_vang .= "$i. " . $ngay . " <br> ";
                            $i += 1;
                        }
                        $string .= "<tr class='toogle toogle_chitiet_" . $value['masv'] . "' style='background:";
                        if (count($v) >= 3) {
                            $string .=  'rgba(255,48,48);
                                  font-weight:bold;
                                  color:#f1f1f1';
                        } else {
                            $string .=  'rgba(127,196,249,0.3)';
                        }
                        $string .= ";display:none;'>"
                            . "<td style='border:0;'>"
                            . "Môn học: $k"
                            . "</td>"
                            . "<td  style='border:0;'>Số buổi vắng : " . count($v) . "</td>"
                            . "<td  style='border:0;'>Ngày vắng:$ngay_vang</td>"
                            . "<td  style='border:0;'></td>"
                            . "<td  style='border:0;'></td>"
                            . "</tr>";
                    }
                }
                echo $string;
            }
        }
    }
    public function searchDanhSachSinhVienViPhamTheoSoNgayVang($so_ngay_vang)
    {
        if (session()->has('chon_lop_hoc')) {
            if (session('chon_lop_hoc') != '') {
                $ds_sinhvien_vipham =  ViPhams::orderBy('tensv')->get()->toArray();
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
                    if ($flag) {
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
                        $ngay_vang = "<br>";
                        $i = 1;
                        foreach ($v as $ngay) {
                            $ngay_vang .= "$i. " . $ngay . " <br> ";
                            $i += 1;
                        }
                        $string .= "<tr class='toogle toogle_chitiet_" . $value['masv'] . "' style='background:";
                        if (count($v) >= 3) {
                            $string .=  'rgba(255,48,48);
                                        font-weight:bold;
                                        color:#f1f1f1';
                        } else {
                            $string .=  'rgba(127,196,249,0.3)';
                        }
                        $string .= ";display:none;'>"
                            . "<td style='border:0;'>"
                            . "Môn học: $k"
                            . "</td>"
                            . "<td  style='border:0;'>Số buổi vắng : " . count($v) . "</td>"
                            . "<td  style='border:0;'>Ngày vắng:$ngay_vang</td>"
                            . "<td  style='border:0;'></td>"
                            . "<td  style='border:0;'></td>"
                            . "</tr>";
                    }
                }
                echo $string;
            } else {
                $ds_sinhvien_vipham =  ViPhams::orderBy('tensv')->get()->toArray();
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
                    if ($flag) {
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
                        $ngay_vang = "<br>";
                        $i = 1;
                        foreach ($v as $ngay) {
                            $ngay_vang .= "$i. " . $ngay . " <br> ";
                            $i += 1;
                        }
                        $string .= "<tr class='toogle toogle_chitiet_" . $value['masv'] . "' style='background:";
                        if (count($v) >= 3) {
                            $string .=  'rgba(255,48,48);
                                        font-weight:bold;
                                        color:#f1f1f1';
                        } else {
                            $string .=  'rgba(127,196,249,0.3)';
                        }
                        $string .= ";display:none;'>"
                            . "<td style='border:0;'>"
                            . "Môn học: $k"
                            . "</td>"
                            . "<td  style='border:0;'>Số buổi vắng : " . count($v) . "</td>"
                            . "<td  style='border:0;'>Ngày vắng:$ngay_vang</td>"
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

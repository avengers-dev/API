<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GiangViens;
use App\Models\Lops;
use App\Models\MonHocs;
use App\Models\SinhViens;
use DB;

class DTController extends Controller
{
    public function index()
    {
        $ds_giangvien = GiangViens::orderBy('tengv')->get();
        $lops = Lops::all();
        $monhocs = Monhocs::all();
        session()->put('chon_lop_hoc', "");
        return view('dt', compact('ds_giangvien', 'lops', 'monhocs'));
    }
    public function searchDanhSachSinhVienTheoMalop($malop)
    {
        session()->put('chon_lop_hoc', $malop);
        $ds_sinhvien =  SinhViens::orderBy('tensv')->get()->toArray();
        $data = [];
        foreach ($ds_sinhvien as $key => $value) {
            foreach ($value['malop'] as $k) {
                if ($malop == $k) {
                    $data[] = $ds_sinhvien[$key];
                }
            }
        }
        $stt = 0;
        $string = '';
        $string .= "<table class='table display table-bordered table-hover main3-table dataTable'>"
            . "<thead>"
            . " <tr>"
            . " <th style='width:20%;'>STT</th>"
            . " <th style='width:20%;'>Mã</th>"
            . " <th style='width:30%;'>Họ</th>"
            . "<th style='width:15%;'>Tên</th>"
            . " <th style='width:15%;'>Ngày Sinh</th>"
            . " <th style='width:15%;'>SĐT</th>"
            . " </tr>"
            . "</thead>"
            . "<tbody id='danhsach_quanli'>";
        foreach ($data as $key => $value) {
            $stt++;
            $string .= "<tr>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>$stt</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['masv'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['hosv'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['tensv'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . date($value['ngaysinh']) . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['sdt'] . "</td>"
                . "</tr>";
        }
        $string .= "</tbody></table>";
        echo $string;
    }
    public function loaddanhsachmonhoc()
    {
        $ds_monhoc =  MonHocs::orderBy('tenmh')->get()->toArray();
        $data = [];
        foreach ($ds_monhoc as $key => $value) {
            $data[] = $ds_monhoc[$key];
        }
        $stt = 0;
        $string = '';
        $string .= "<table class='table display table-bordered table-hover main4-table dataTable'>"
            . "<thead>"
            . " <tr>"
            . " <th style='width:20%;'>STT</th>"
            . " <th style='width:20%;'>Mã</th>"
            . " <th style='width:30%;'>Tên</th>"
            . " </tr>"
            . "</thead>"
            . "<tbody id='danhsach_quanli'>";
        foreach ($data as $key => $value) {
            $stt++;
            $string .= "<tr>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>$stt</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['mamh'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['tenmh'] . "</td>"
                . "</tr>";
        }
        $string .= "</tbody></table>";
        echo $string;
    }
    public function addGV(Request $request)
    {
        $matkhau = $request->tengv[0] . $request->magv;
        $temp = 'qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM';
        $token = "";
        for ($i = 0; $i < 10; $i++) {
            $token.=$temp[rand(0,strlen($temp))];
        }
        GiangViens::insert(
            [
                'magv' => $request->magv,
                'hogv' => $request->hogv,
                'tengv' => $request->tengv,
                'email' => $request->email,
                'matkhau' => $matkhau,
                'sdt' => $request->sdt,
                'token' => $token,
                'monday' => ''
            ]
        );
        $ds_giangvien = GiangViens::orderBy('tengv')->get();
        $lops = Lops::all();
        $monhocs = Monhocs::all();
        session()->put('chon_lop_hoc', "");
        return view('dt', compact('ds_giangvien', 'lops', 'monhocs'));
    }
    public function deleteGV($magv)
    {
        GiangViens::where('magv', $magv)->delete();
        $ds_gv =  GiangViens::orderBy('tengv', 'desc')->get()->toArray();
        $data = [];
        foreach ($ds_gv as $key => $value) {
            $data[] = $ds_gv[$key];
        }
        $stt = 0;
        $string = '';
        $string .= "<table class='table display table-bordered table-hover main2-table dataTable'>"
            . "<thead>"
            . " <tr>"
            . " <th style='width:20%;'>STTT</th>"
            . " <th style='width:20%;'>Mã</th>"
            . " <th style='width:30%;'>Họ</th>"
            . "<th style='width:15%;'>Tên</th>"
            . " <th style='width:15%;'>Email</th>"
            . " <th style='width:15%;'>SĐT</th>"
            . " <th style='width:15%;'>Lịch</th>"
            . " <th style='width:15%;'>Quản lí</th>"
            . " </tr>"
            . "</thead>"
            . "<tbody id='danhsach_quanli'>";
        foreach ($data as $key => $value) {
            // $ma_giang_vien = $value['magv'];
            $stt++;
            $string .= "<tr>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>$stt</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['magv'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['hogv'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['tengv'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['email'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['sdt'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>";
            foreach ($value['monday'] as $t => $p) {
                $string .= "<b>Thứ " . ($t + 1) . " :</b> <br>";
                $st = 0;
                foreach ($p as $k => $v) {
                    $string .= "<b>" . ($st += 1) . ". " . $k . "</b>" . " :<br>";
                    foreach ($v as $i => $x) {
                        $string .= "&diams; Ca " . $i . " :<br>";
                        foreach ($x as $y) {
                            $string .= "&rsaquo; " . $y . "<br>";
                        }
                    }
                }
            }
            $string .= "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>
                <a data-magv=\"" . $value['magv'] . "\" class=\"edit-gv\"><i class=\"material-icons\">edit</i></a>
                <a data-magv='" . $value['magv'] . "' class='delete-gv'><i class='material-icons'>delete</i></a>
                </td>"
                . "</tr>";
        }
        $string .= "</tbody></table>";
        echo $string;
    }
    public function editGV($magv)
    {
        $giangvien = GiangViens::where('magv', $magv)->first();
        $string = "";
        $string .= "<div class='container-fluid'>
        <div class='row clearfix'>
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class='card'>
                <div class='header'>
                    <h2 id='ten_lophoc_search'>
                        Thay Đổi Thông Tin Giảng Viên
                        <button style='float:right' data-magv='" . $giangvien['magv'] . "' class='reset-pass-gv btn btn-primary waves-effect'>Đặt lại mật khẩu</button>
                    </h2>
                </div>
                <div class='body'>
                    <div class='table-responsive get_data_sinhvien'>
                    <form action='" . route('save-gv') . "' id='form_validation' method='POST'>
                    <div class='form-group form-float'>
                            <div class='form-line'>
                                <input class='form-control' value='"
            . $giangvien['magv'] . "' name='magv' required>
                            </div>
                        </div>
                        <div class='form-group form-float'>
                            <div class='form-line'>
                                <input type='text' class='form-control' value='"
            . $giangvien['hogv'] . "' name='hogv' required>
                            </div>
                        </div>
                        <div class='form-group form-float'>
                            <div class='form-line'>
                                <input type='text' class='form-control' value='"
            . $giangvien['tengv'] . "'name='tengv' required>
                            </div>
                        </div>
                        <div class='form-group form-float'>
                            <div class='form-line'>
                                <input type='email' class='form-control' value='"
            . $giangvien['email'] . "'name='email' required>
                            </div>
                        </div>
                        <div class='form-group form-float'>
                            <div class='form-line'>
                                <input type='number' class='form-control' value='"
            . $giangvien['sdt'] . "'name='sdt' required>
                            </div>
                        </div>
                        <button class='btn btn-primary waves-effect' type='submit'>Lưu</button>
                    </form>
                   </div>
                 </div>
             </div>
          </div>
       </div>
       </div>";
        echo $string;
    }
    public function saveGV(Request $request)
    {
        GiangViens::where('magv', $request->magv)->update([
            'hogv' => $request->hogv,
            'tengv' => $request->tengv,
            'email' => $request->email,
            'sdt' => $request->sdt,
        ]);
        $ds_giangvien = GiangViens::orderBy('tengv')->get();
        $lops = Lops::all();
        $monhocs = Monhocs::all();
        session()->put('chon_lop_hoc', "");
        return view('dt', compact('ds_giangvien', 'lops', 'monhocs'));
    }
    public function resetPassGV($magv)
    {
        $giangvien = GiangViens::where('magv', $magv)->first();
        $pass = $giangvien->tengv[0] . $giangvien->magv;
        GiangViens::where('magv', $magv)->update([
            'matkhau' => $pass
        ]);
    }
}

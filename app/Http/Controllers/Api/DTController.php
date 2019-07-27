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
            if($value['malop']!=""){
                foreach ($value['malop'] as $k) {
                    if ($malop == $k) {
                        $data[] = $ds_sinhvien[$key];
                    }
                }
            }
        }
        $stt = 0;
        $string = '';
        $string .= "<table class='table display table-bordered table-hover main3-table dataTable'>"
            . "<thead>"
            . " <tr>"
            . " <th>STT</th>"
            . " <th>Mã</th>"
            . " <th>Họ</th>"
            . " <th>Tên</th>"
            . " <th>Ngày Sinh</th>"
            . " <th>SĐT</th>"
            . " <th></th>"
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
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>
                <a data-malop='" . $malop . "' data-masv='" . $value['masv'] . "' class='delete-sv'><i class='material-icons'>delete</i></a>
                </td>"
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
            . " <th>STT</th>"
            . " <th>Mã</th>"
            . " <th>Tên</th>"
            . " <th></th>"
            . " </tr>"
            . "</thead>"
            . "<tbody id='danhsach_quanli'>";
        foreach ($data as $key => $value) {
            $stt++;
            $string .= "<tr>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>$stt</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['mamh'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['tenmh'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>
                <a data-mamh='" . $value['mamh'] . "' class='delete-mh'><i class='material-icons'>delete</i></a>
                </td>"
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
            $token .= $temp[rand(0, strlen($temp)-1)];
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
        return redirect()->route('dt');
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
            . " <th style='width:20%;'>STT</th>"
            . " <th style='width:20%;'>Mã</th>"
            . " <th style='width:30%;'>Họ</th>"
            . "<th style='width:15%;'>Tên</th>"
            . " <th style='width:15%;'>Email</th>"
            . " <th style='width:15%;'>SĐT</th>"
            . " <th style='width:15%;'>Lịch</th>"
            . " <th style='width:15%;'></th>"
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
                if($value['monday']!=""){
                    foreach ($value['monday'] as $thu => $p) {
                        $string .= "<b>Thứ " . ($thu + 1) . " :</b> <br>";
                        $st = 0;
                        foreach ($p as $tenmon => $v) {
                            $string .= "<b>" . ($st += 1) . ". " . $tenmon . "</b>" . " :<br>";
                            foreach ($v as $ca => $x) {
                                $string .= "&diams; Ca " . $ca . " :<br>";
                                foreach ($x as $tenlop) {
                                    $string .= "&rsaquo; " . $tenlop . "<br>";
                                }
                            }
                        }
                    }
                }
            $string .= "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>
                <a data-hogv=\"".$value['hogv']."\" data-tengv=\"" .$value['tengv']. "\" data-magv=\"" . $value['magv'] . "\" class=\"edit-gv\"><i class=\"material-icons\">edit</i></a>
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
                        <div class=\"container-fluid\">
                            <h4>
                              Danh Sách Môn Dạy Giảng Viên: <h3>" . $giangvien['hogv'] . " " . $giangvien['tengv'] ."</h3>
                            </h4>
                            <table class=\"table display table-bordered table-hover main5-table dataTable\">
                                <thead>
                                    <tr>
                                        <th>Thứ</th>";
                                for ($i = 1; $i <= 5; $i++) {
                                    $string .= "<th>Ca $i</th>";
                                }
                                $string .= "<th></th>
                                    </tr>
                                </thead>
                                <tbody id=\"danhsach_quanli\">
                                    ";
                                        if ($giangvien['monday'] != "") {
                                            foreach ($giangvien->monday as $thuday => $value) {
                                                $thuday+=1;
                                                $string.= "<tr><td style=\"border:0.1px solid rgba(0,0,0,0.1);\"><b>$thuday</b></td>";
                                                for($ca = 1 ; $ca <= 5 ; $ca++){
                                                $flag=false;
                                                    foreach ($value as $tenmon => $v) {
                                                        foreach ($v as $caday => $x) {
                                                            if($caday==$ca){
                                                                $flag=true;
                                                                $string.= "<td style=\"border:0.1px solid rgba(0,0,0,0.1);\">
                                                                <b> $tenmon  </b>:<br>";
                                                                foreach ($x as $lopday) {
                                                                    $string.= "&rsaquo; $lopday <br>";
                                                                }
                                                                $string.= "</td>";
                                                            }
                                                        }
                                                    } 
                                                    if(!$flag){
                                                        $string.= "<td style=\"border:0.1px solid rgba(0,0,0,0.1);\"> </td>";
                                                    }
                                                }
                                            $string.= "<td style=\"text-align: center;border:0.1px solid rgba(0,0,0,0.1);\">
                                            <a class=\"delete-buoiday\"><i class=\"material-icons\">delete</i></a>
                                            </td></tr>";
                                            }
                                        }
                                $string.="
                                </tbody>
                            </table>
                        </div>
                        <button class='btn btn-primary waves-effect' type='submit'>Lưu</button>
                        <button onclick=\"window.location.href='".route('dt')."'\" class='btn btn-danger waves-effect' type='button'>Hủy</button>
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
        return redirect()->route('dt');
    }
    public function resetPassGV($magv)
    {
        $giangvien = GiangViens::where('magv', $magv)->first();
        $pass = $giangvien->tengv[0] . $giangvien->magv;
        GiangViens::where('magv', $magv)->update([
            'matkhau' => $pass
        ]);
    }
    public function deleteSV($malop,$masv)
    {
        $sv = SinhViens::where('masv',$masv)->first();
        $ds_lop = [];
        foreach($sv['malop'] as $key => $value){
            if($value!=$malop){
                $ds_lop[] = $value;
            }
        }
        SinhViens::where('masv',$masv)->update(['malop'=>$ds_lop]);
        $ds_sinhvien =  SinhViens::orderBy('tensv')->get()->toArray();
        $data = [];
        foreach ($ds_sinhvien as $key => $value) {
            if($value['malop']!=""){
                foreach ($value['malop'] as $k) {
                    if ($malop == $k) {
                        $data[] = $ds_sinhvien[$key];
                    }
                }
            }
        }
        $stt = 0;
        $string = '';
        $string .= "<table class='table display table-bordered table-hover main3-table dataTable'>"
            . "<thead>"
            . " <tr>"
            . " <th>STT</th>"
            . " <th>Mã</th>"
            . " <th>Họ</th>"
            . " <th>Tên</th>"
            . " <th>Ngày Sinh</th>"
            . " <th>SĐT</th>"
            . " <th></th>"
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
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>
                <a data-malop='" . $malop . "' data-masv='" . $value['masv'] . "' class='delete-sv'><i class='material-icons'>delete</i></a>
                </td>"
                . "</tr>";
        }
        $string .= "</tbody></table>";
        echo $string;
    }
    public function deleteMonHoc($mamh)
    {
        MonHocs::where('mamh',$mamh)->delete();
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
            . " <th>STT</th>"
            . " <th>Mã</th>"
            . " <th>Tên</th>"
            . " <th></th>"
            . " </tr>"
            . "</thead>"
            . "<tbody id='danhsach_quanli'>";
        foreach ($data as $key => $value) {
            $stt++;
            $string .= "<tr>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>$stt</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['mamh'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['tenmh'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>
                <a data-mamh='" . $value['mamh'] . "' class='delete-mh'><i class='material-icons'>delete</i></a>
                </td>"
                . "</tr>";
        }
        $string .= "</tbody></table>";
        echo $string;
    }
}

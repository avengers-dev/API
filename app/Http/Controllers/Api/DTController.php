<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GiangViens;
use App\Models\Lops;
use App\Models\MonHocs;
use App\Models\SinhViens;
use DB;
use App\Models\Admins;

class DTController extends Controller
{
    public function index()
    {
        $ds_giangvien = GiangViens::orderBy('tengv')->get();
        $lops = Lops::orderBy('tenlop')->get();
        $monhocs = Monhocs::orderBy('tenmh')->get();
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
                . "<td style='text-align: center;border:0.1px solid rgba(0,0,0,0.1);'>
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
                . "<td style='text-align: center;border:0.1px solid rgba(0,0,0,0.1);'>
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
        $ds_gv =  GiangViens::orderBy('tengv')->get()->toArray();
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
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>
                <a data-hogv=\"".$value['hogv']."\" data-tengv=\"" .$value['tengv']. "\" data-magv=\"" . $value['magv'] . "\" class=\"edit-gv\"><i class=\"material-icons\">edit</i></a>
                <a data-magv='" . $value['magv'] . "' class='delete-gv'><i class='material-icons'>delete</i></a>
                <br>
                <a data-hogv=\"".$value['hogv']."\" data-tengv=\"" .$value['tengv']. "\" data-magv=\"" . $value['magv'] . "\" class=\"add-mon-day\"><i class=\"material-icons\">playlist_add</i> <span class=\"icon-name\"></span></a>
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
                        <button onclick=\"window.location.href='".route('dt')."'\" class='btn btn-danger waves-effect' type='button'>Hủy</button>
                    </form>
                    <br>
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
                . "<td style='text-align: center;border:0.1px solid rgba(0,0,0,0.1);'>
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
                . "<td style='text-align: center;border:0.1px solid rgba(0,0,0,0.1);'>
                    <a data-mamh='" . $value['mamh'] . "' class='delete-mh'><i class='material-icons'>delete</i></a>
                </td>"
                . "</tr>";
        }
        $string .= "</tbody></table>";
        echo $string;
    }
    public function addMH(Request $request)
    {
        MonHocs::insert(
            [
                'mamh' => $request->mamh,
                'tenmh' => $request->tenmh
            ]
        );
        return redirect()->route('dt');
    }
    public function deleteBuoiDay($magv, $buoiday )
    {
        $buoiday-=1;
        $danh_sach_mon_day = GiangViens::where('magv',$magv)->first();
        $data = [];
        foreach($danh_sach_mon_day->monday as $key => $value){
            if($key!=$buoiday){
                $data[$key]=$value;
            }
        }
        GiangViens::where('magv', $magv)->update([
            'monday' => $data
        ]);
        $string = "";
        $giangvien = GiangViens::where('magv',$magv)->first();
        $string.="<h3>
        Lịch dạy -  " . $giangvien['hogv'] . " " . $giangvien['tengv'] ." - ". $giangvien['magv'] ."
        </h3>
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
            <tbody class=\"lich-day-giang-vien\">
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
                        <a data-ma-gv='".$giangvien['magv']."' data-buoi-day='".$thuday."' class=\"delete-buoiday\"><i class=\"material-icons\">delete</i></a>
                        </td></tr>";
                        }
                    }
            $string.="
            </tbody>
        </table>";
        echo $string;
    }
    public function addMonDay($magv){
        $giangvien = GiangViens::where('magv',$magv)->first();
        $string = "";
        $string.=
        "
            <div class='container-fluid'>
            <div class='row clearfix'>
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <div class='card'>
                        <div class='header'>
                            <h2 id='ten_lophoc_search'>
                                Thêm Môn Dạy
                            </h2>
                        </div>
                        <div class='body'>
                            <div class='table-responsive get_data_sinhvien'>
                                <form id='form_validation'>
                                <div class=\"container-fluid lich-day-giang-vien\">
                                        <h3>
                                        Lịch dạy -  " . $giangvien['hogv'] . " " . $giangvien['tengv'] ." - ". $giangvien['magv'] ."
                                        </h3>
                                        <table class=\"table display table-bordered table-hover main5-table dataTable\">
                                            <thead>
                                                <tr>
                                                    <th>Thứ</th>";
                                            for ($i = 1; $i <= 5; $i++) {
                                                $string .= "<th>Ca $i</th>";
                                            }
                                            $string .= "
                                                </tr>
                                            </thead>
                                            <tbody>
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
                                                        // $string.= "<td style=\"text-align: center;border:0.1px solid rgba(0,0,0,0.1);\">
                                                        // <a data-tengv='".$giangvien['tengv']."' data-hogv='".$giangvien['hogv']."' data-ma-gv='".$giangvien['magv']."' data-buoi-day='".$thuday."' class=\"delete-buoiday\"><i class=\"material-icons\">delete</i></a>
                                                        // </td></tr>";
                                                        }
                                                    }
                                            $string.="
                                            </tbody>
                                        </table>
                                    </div>
                                </form>";
                                $danh_sach_mon = MonHocs::orderBy('tenmh')->get();
                                $danh_sach_lop = Lops::orderBy('tenlop')->get();
                                $string.="<form action='" . route('save-mon-day') . "'   method='POST'>
                                        <div class='form-group form-float'>
                                        <div class='form-line'>
                                            <input value='"
                                            . $giangvien['magv'] . "' type='hidden' class='form-control' name='magv' required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for='sel1'>Thứ :</label>
                                        <select multiple class='form-control' id='sel2' name='chonthu'>";
                                            for($i=2; $i<=7; $i++){
                                                $string.="<option>".$i."</option>";
                                            }
                                        $string.="</select>
                                    </div>
                                    <br>
                                    <div>
                                        <label for='sel1'>Ca :</label>
                                        <select multiple class='form-control' id='sel2' name='chonca'>";
                                            for($i=1; $i<=5; $i++){
                                                $string.="<option>".$i."</option>";
                                            }
                                        $string.="</select>
                                    </div>
                                    <br>
                                    <div>
                                        <label for='sel1'>Môn :</label>
                                        <select multiple class='form-control' id='sel2' name='chonmon'>";
                                            foreach($danh_sach_mon as $k => $v){
                                                $string.="<option>".$v['mamh']."</option>";
                                            }
                                        $string.="</select>
                                    </div>
                                    <br>
                                    <div class=\"alert alert-info\">
                                        <h5> * Giữ phím Ctrl (Windows) / Command (Mac) để chọn nhiều lớp </h5>
                                    </div>
                                    <div>
                                        <label for='sel1'>Lớp :</label>
                                        <select name='chonlop[]' id='chonlop' multiple>";
                                        foreach($danh_sach_lop as $k => $v){
                                            $string.="<option>".$v['malop']."</option>";
                                        }
                                        $string.="</select>
                                    </div>
                                    <br>
                                    <button class='btn btn-primary waves-effect' type='submit'>Thêm</button>
                                    <button onclick=\"window.location.href='".route('dt')."'\" class='btn btn-danger waves-effect' type='button'>Hủy</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        ";
        echo $string;
    } 
    public function saveMonDay(Request $request){
        if($request->chonthu != ""){
            $chonlop = $request->input('chonlop');
            $buoiday = $request->chonthu - 1;
            $danh_sach_mon_day = GiangViens::where('magv',$request->magv)->first();
            $data = [];
            if($request->chonca != ""){ 
                if($request->chonmon != ""){ 
                    if($request->chonlop != ""){ 
                        foreach($danh_sach_mon_day->monday as $key => $value){
                            if($key == $buoiday){
                                foreach($value as $x => $y){
                                    foreach($y as $i => $j){
                                        if($i != $request->chonca){
                                            $data[$key][$x][$i]=$j;
                                        }
                                    }
                                }
                            }
                            else{
                                $data[$key]=$value;
                            }
                        }
                        foreach($chonlop as $k => $v){
                            $data[$buoiday][$request->chonmon][$request->chonca][]=$v;
                        }
                    }
                    else{   //Ko add
                        return redirect()->route('dt');
                    }
                }
                else{   //Xóa ca
                    foreach($danh_sach_mon_day->monday as $key => $value){
                        if($key == $buoiday){
                            foreach($value as $x => $y){
                                foreach($y as $i => $j){
                                    if($i != $request->chonca){
                                        $data[$key][$x][$i]=$j;
                                    }
                                }
                            }
                        }
                        else{
                            $data[$key]=$value;
                        }
                    }
                }
            }
            else{   //Xóa thứ
                foreach($danh_sach_mon_day->monday as $key => $value){
                    if($key!=$buoiday){
                        $data[$key]=$value;
                    }
                }
            }
            // echo "<pre>";
            // print_r($data);
            GiangViens::where('magv', $request->magv)->update([
                'monday' => $data
            ]);
        }
        return redirect()->route('dt');
    }
    public function loadQuanTri()
    {
        $ds_quantri =  Admins::orderBy('tengv')->get()->toArray();
        $data = [];
        foreach ($ds_quantri as $key => $value) {
            $data[] = $ds_quantri[$key];
        }
        $stt = 0;
        $string = '';
        $string .= "<table class='table display table-bordered table-hover main6-table dataTable'>"
            . "<thead>"
            . " <tr>"
            . " <th>STT</th>"
            . " <th>Họ</th>"
            . " <th>Tên</th>"
            . " <th>Tài khoản</th>"
            . " <th>Mật khẩu</th>"
            . " <th>Chức vụ</th>"
            . " <th></th>"
            . " </tr>"
            . "</thead>"
            . "<tbody id='danhsach_quanli'>";
        foreach ($data as $key => $value) {
            $stt++;
            $string .= "<tr>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>$stt</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['hogv'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['tengv'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['taikhoan'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['matkhau'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['chucvu'] . "</td>"
                . "<td style='text-align: center;border:0.1px solid rgba(0,0,0,0.1);'>
                    <a data-taikhoan='" . $value['taikhoan'] . "' class='delete-taikhoan'><i class='material-icons'>delete</i></a>
                </td>"
                . "</tr>";
        }
        $string .= "</tbody></table>";
        echo $string;
    }
    public function addQTV(Request $request){
        $temp = 'qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM';
        $token = "";
        for ($i = 0; $i < 10; $i++) {
            $token .= $temp[rand(0, strlen($temp)-1)];
        }
        Admins::insert([
            'hogv' => $request->hogv,
            'tengv' => $request->tengv,
            'token' => $token,
            'taikhoan' => $request->taikhoan,
            'matkhau' => $request->matkhau,
            'chucvu' => $request->chonchucvu,
        ]);
        return redirect()->route('dt');
    }
    public function deleteQuanTri($taikhoan){
        Admins::where('taikhoan',$taikhoan)->delete();
        return redirect()->route('load-quan-tri');
    }
}

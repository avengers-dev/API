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
use Excel;
use ImportExcel;

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
    public function loadDanhSachMonHoc()
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
    public function getAddGV()
    {
        $string = "";
        $string .="
        <form action='".route('addGV')."' id='form_validation' method='POST'>
        <div class=\"alert alert-info\">
            <h4> Mật khẩu được khởi tạo mặc định !</h4>
            * Ví dụ :<br>
            - Tên giảng viên: ABC <br>
            - Mã giảng viên: 123 <br>
            <h5> => Mật khẩu: A123 </h5>
        </div>
        <div class='form-group form-float'>
            <div class='form-line'>
                <input type='hidden' class='form-control' name='magv' required>
            </div>
        </div>
        <div class='form-group form-float'>
            <div class='form-line'>
                <label>Mã</label>
                <input type='text' class='form-control' name='magv' required>
            </div>
        </div>
        <div class='form-group form-float'>
            <div class='form-line'>
                <label>Họ</label>
                <input type='text' class='form-control' name='hogv' required>
            </div>
        </div>
        <div class='form-group form-float'>
            <div class='form-line'>
                <label>Tên</label>
                <input type='text' class='form-control' name='tengv' required>
            </div>
        </div>
        <div class='form-group form-float'>
            <div class='form-line'>
                <label>Email</label>
                <input type='email' class='form-control' name='email' required>
            </div>
        </div>
        <div class='form-group form-float'>
            <div class='form-line'>
                <label>Số điện thoại</label>
                <input type='number' class='form-control' name='sdt' required>
            </div>
        </div>
        <button class='btn btn-primary waves-effect' type='submit'>Thêm</button>
        <button onclick=\"window.location.href='".route('dt')."'\" class='btn btn-danger waves-effect' type='button'>Hủy</button>
    </form>
        ";
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
            . " <th>STT</th>"
            . " <th>Mã</th>"
            . " <th>Họ</th>"
            . " <th>Tên</th>"
            . " <th>Email</th>"
            . " <th>SĐT</th>"
            . " <th></th>"
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
                . "<td style='text-align: center;border:0.1px solid rgba(0,0,0,0.1);'>
                <a data-hogv=\"".$value['hogv']."\" data-tengv=\"" .$value['tengv']. "\" data-magv=\"" . $value['magv'] . "\" class=\"edit-gv\"><i class=\"material-icons\">edit</i></a>
                <br>
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
        $string .= "
                    <form action='" . route('save-gv') . "' id='form_validation' method='POST'>
                    <div class='form-group form-float'>
                            <div class='form-line'>
                                <input type='hidden' class='form-control' value='"
            . $giangvien['magv'] . "' name='magv' required>
                            </div>
                        </div>
                        <div class='form-group form-float'>
                            <div class='form-line'>
                            <label>Họ</label>
                                <input type='text' class='form-control' value='"
            . $giangvien['hogv'] . "' name='hogv' required>
                            </div>
                        </div>
                        <div class='form-group form-float'>
                            <div class='form-line'>
                            <label>Tên</label>
                                <input type='text' class='form-control' value='"
            . $giangvien['tengv'] . "'name='tengv' required>
                            </div>
                        </div>
                        <div class='form-group form-float'>
                            <div class='form-line'>
                            <label>Email</label>
                                <input type='email' class='form-control' value='"
            . $giangvien['email'] . "'name='email' required>
                            </div>
                        </div>
                        <div class='form-group form-float'>
                            <div class='form-line'>
                            <label>Số điện thoại</label>
                                <input type='number' class='form-control' value='"
            . $giangvien['sdt'] . "'name='sdt' required>
                            </div>
                        </div>
                        <button class='btn btn-primary waves-effect' type='submit'>Lưu</button>
                        <button onclick=\"window.location.href='".route('dt')."'\" class='btn btn-danger waves-effect' type='button'>Hủy</button>
                    </form>";
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
            if(count($value['malop'])){
                foreach ($value['malop'] as $k) {
                    if ($malop == $k) {
                        $data[] = $ds_sinhvien[$key];
                    }
                }
            }
            else{
                SinhViens::where('masv',$value['masv'])->delete();
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
    public function getAddMH()
    {
        $string="
            <form action='".route('addMH')."' id='form_validation' method='POST'>
            <div class='form-group form-float'>
                <div class='form-line'>
                    <input type='hidden' class='form-control' name='mamh' required>
                </div>
            </div>
            <div class='form-group form-float'>
                <div class='form-line'>
                    <label>Mã</label>
                    <input type='text' class='form-control' name='mamh' required>
                </div>
            </div>
            <div class='form-group form-float'>
                <div class='form-line'>
                    <label>Tên</label>
                    <input type='text' class='form-control' name='tenmh' required>
                </div>
            </div>
            <button class='btn btn-primary waves-effect' type='submit'>Thêm</button>
            <button onclick=\"window.location.href='".route('dt')."'\" class='btn btn-danger waves-effect' type='button'>Hủy</button>
        </form>
        ";
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
    public function addMonDay($magv){
        $giangvien = GiangViens::where('magv',$magv)->first();
        $string = "";
        $string.=
        "
            <form id='form_validation'>
            <div class=\"container-fluid lich-day-giang-vien\">
                    <h3>
                    Lịch dạy -  " . $giangvien['hogv'] . " " . $giangvien['tengv'] ." - ". $giangvien['magv'] ."
                    </h3>
                    <table class=\"table display table-bordered table-hover main5-table dataTable\">
                        <thead>
                            <tr>
                                <th>Thứ</th>
                                <th>Ca 1 ( 07:00 - 09:15 )</th>
                                <th>Ca 2 ( 09:30 - 11:45 )</th>
                                <th>Ca 3 ( 13:00 - 15:15 )</th>
                                <th>Ca 4 ( 15:30 - 17:45 )</th>
                                <th>Ca 5 ( 18:00 - 21:00 )</th>
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
                <label for='sel1'>Lớp :</label>
                <div>
                    <select name='chonlop[]' id='chonlop' multiple>";
                    foreach($danh_sach_lop as $k => $v){
                        $string.="<option>".$v['malop']."</option>";
                    }
                    $string.="</select>
                </div>
                <br>
                <button class='btn btn-primary waves-effect' type='submit'>Lưu</button>
                <button onclick=\"window.location.href='".route('dt')."'\" class='btn btn-danger waves-effect' type='button'>Hủy</button>
            </form>
        
        ";
        echo $string;
    } 
    public function saveMonDay(Request $request){
        if($request->chonthu != ""){
            $chonlop = $request->input('chonlop');
            $buoiday = $request->chonthu - 1;
            $danh_sach_mon_day = GiangViens::where('magv',$request->magv)->first();
            $data = [];
            if($danh_sach_mon_day->monday != ""){
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
            }
            else{
                foreach($chonlop as $k => $v){
                    $data[$buoiday][$request->chonmon][$request->chonca][]=$v;
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
            . " <th>Mã</th>"
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
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['magv'] . "</td>"
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
    public function getAddQTV(){
        $string = "
                <form action='".route('addQTV')."' method='POST'>
                <div style='margin-bottom:15px;'>
                <select class='form-control' name='chonchucvu'>
                    <option disabled selected>- - Chọn chức vụ - -</option>
                    <option>AD</option>
                    <option>DT</option>
                    <option>CTSV</option>
                </select>
                </div>
                <div class='form-group form-float'>
                <div class='form-line'>
                    <label>Mã</label>
                    <input type='text' class='form-control' name='magv' required>
                </div>
                </div>
                <div class='form-group form-float'>
                <div class='form-line'>
                    <label>Họ</label>
                    <input type='text' class='form-control' name='hogv' required>
                </div>
                </div>
                <div class='form-group form-float'>
                <div class='form-line'>
                    <label>Tên</label>
                    <input type='text' class='form-control' name='tengv' required>
                </div>
                </div>
                <div class='form-group form-float'>
                <div class='form-line'>
                    <label>Tài khoản</label>
                    <input type='text' class='form-control' name='taikhoan' required>
                </div>
                </div>
                <div class='form-group form-float'>
                <div class='form-line'>
                    <label>Mật khẩu</label>
                    <input type='password' class='form-control' name='matkhau' required>
                </div>
                </div>
                <button class='btn btn-primary waves-effect' type='submit'>Thêm</button>
                <button onclick=\"window.location.href='".route('dt')."'\" class='btn btn-danger waves-effect' type='button'>Hủy</button>
            </form>
        ";
        echo $string;
    }
    public function addQTV(Request $request){
        $temp = 'qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM';
        $token = "";
        for ($i = 0; $i < 10; $i++) {
            $token .= $temp[rand(0, strlen($temp)-1)];
        }
        Admins::insert([
            'magv' => $request->magv,
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
    public function getAddLop(){
        $string = "
            <form action='".route('addLop')."' id='form_validation' method='POST'>
            <div>
                <select class='form-control' id='sel2' name='chontinhtrang'>';
                    <option selected disabled>--Chọn tình trạng-</option>
                    <option value='TC'>Theo tín chỉ</option>
                    <option value='HL'>Học lại</option>
                </select>
            </div>
            <br>
            <div class='form-group form-float'>
                <div class='form-line'>
                <label>Mã</label>
                    <input type='text' class='form-control' name='malop' required>
                </div>
            </div>
            <div class='form-group form-float'>
                <div class='form-line'>
                <label>Tên</label>
                    <input type='text' class='form-control' name='tenlop' required>
                </div>
            </div>
            <button class='btn btn-primary waves-effect' type='submit'>Thêm</button>
            <button onclick=\"window.location.href='".route('dt')."'\" class='btn btn-danger waves-effect' type='button'>Hủy</button>
        </form>
        ";
        echo $string;
    }
    public function addLop(Request $request){
        Lops::insert([
            'malop' => $request->malop,
            'tenlop' => $request->tenlop,
            'tinhtrang' => $request->chontinhtrang,
        ]);
        return redirect()->route('dt');
    }
    public function loadDanhSachCacLop()
    {
        $ds_lop =  Lops::orderBy('tenlop')->get()->toArray();
        $data = [];
        foreach ($ds_lop as $key => $value) {
            $data[] = $ds_lop[$key];
        }
        $stt = 0;
        $string = '';
        $string .= "<table class='table display table-bordered table-hover main7-table dataTable'>"
            . "<thead>"
            . " <tr>"
            . " <th>STT</th>"
            . " <th>Mã</th>"
            . " <th>Tên</th>"
            . " <th>Tình trạng</th>"
            . " <th></th>"
            . " </tr>"
            . "</thead>"
            . "<tbody id='danhsach_quanli'>";
        foreach ($data as $key => $value) {
            $stt++;
            $string .= "<tr>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>$stt</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['malop'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['tenlop'] . "</td>"
                . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['tinhtrang'] . "</td>"
                . "<td style='text-align: center;border:0.1px solid rgba(0,0,0,0.1);'>
                    <a data-malop='" . $value['malop'] . "' class='delete-lop'><i class='material-icons'>delete</i></a>
                </td>"
                . "</tr>";
        }
        $string .= "</tbody></table>";
        echo $string;
    }
    public function deleteLop($malop)
    {
        Lops::where('malop',$malop)->delete();
        $ds_lop =  Lops::orderBy('tenlop')->get()->toArray();
        $data = [];
        foreach ($ds_lop as $key => $value) {
            $data[] = $ds_lop[$key];
        }
        $sv = SinhViens::get()->toArray();
        foreach($sv as $key => $value){
            if(count($value['malop'])){  
                $data_sv = [];
                foreach($value['malop'] as $k =>$v){
                    if($v != $malop)
                    {
                        $data_sv[] = $v;
                    }
                }
                SinhViens::where('masv',$value['masv'])->update([
                    'malop' => $data_sv,
                ]);
            }
            else{
                SinhViens::where('masv',$value['masv'])->delete();
            }
        }
        $stt = 0;
        $string = '';
        $string .= "<table class='table display table-bordered table-hover main7-table dataTable'>"
        . "<thead>"
        . " <tr>"
        . " <th>STT</th>"
        . " <th>Mã</th>"
        . " <th>Tên</th>"
        . " <th>Tình trạng</th>"
        . " <th></th>"
        . " </tr>"
        . "</thead>"
        . "<tbody id='danhsach_quanli'>";
    foreach ($data as $key => $value) {
        $stt++;
        $string .= "<tr>"
            . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>$stt</td>"
            . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['malop'] . "</td>"
            . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['tenlop'] . "</td>"
            . "<td style='border:0.1px solid rgba(0,0,0,0.1);'>" . $value['tinhtrang'] . "</td>"
            . "<td style='text-align: center;border:0.1px solid rgba(0,0,0,0.1);'>
                <a data-malop='" . $value['malop'] . "' class='delete-lop'><i class='material-icons'>delete</i></a>
            </td>"
            . "</tr>";
    }
    $string .= "</tbody></table>";
    echo $string;
    }
    public function importExcel(Request $request){
        if($request->hasFile('file')){
            $data = $request->file('file');
            $reader = ImportExcel::createReader('Xlsx');
            $spreadSheet = $reader->load($data);
            $workSheet = $spreadSheet->getActiveSheet();
            // echo "<pre>";
            // print_r($workSheet->toArray());
            $flag = 0;
            foreach ($workSheet->toArray() as $key => $value) {
                if($flag > 0){
                    $masv = $value[1]."";
                    $sv = SinhViens::where('masv',$masv)->get()->toArray();
                    $check = true;
                    if(count($sv)){
                        $data = [];
                        foreach($sv as $key => $value){
                            if(count($value['malop'])){
                                foreach($value['malop'] as $k =>$v){
                                    if($v == session()->get('chon_lop_hoc'))
                                    {
                                        $check = false;
                                    }
                                    $data[] = $v;
                                }
                            }
                            else{
                                SinhViens::where('masv',$value['masv'])->delete();
                            }
                        }
                        if($check){
                            $data[] = session()->get('chon_lop_hoc');
                        }
                        SinhViens::where('masv',$masv)->update([
                            'malop' => $data,
                        ]);
                    }
                    else{
                        SinhViens::insert([
                            'masv' => $value[1]."",
                            'hosv' => $value[2],
                            'tensv' => $value[3],
                            'sdt' => $value[5]."",
                            'ngaysinh' => $value[4],
                            'malop' => [session()->get('chon_lop_hoc')],
                        ]);
                    }
                }
                $flag++;
            }
        }
    }
}

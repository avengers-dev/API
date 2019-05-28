<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Viphams;
use App\Models\Lops;
use App\Models\Monhocs;
class AdminController extends Controller
{
    public function index(){
        $ds_sinhvien_vipham = ViPhams::all();
        $lops = Lops::all();
        $monhocs = Monhocs::all();
        // echo "<pre>";
        // print_r($monhocs->toArray());
        return view('index',compact('ds_sinhvien_vipham','lops','monhocs'));
    }
    public function searchDanhSachSinhVienViPhamTheoMalop($malop){
        $ds_sinhvien_vipham = ViPhams::all()->toArray();
        $monhocs = Monhocs::all()->toArray();
        $data = [];
        foreach($ds_sinhvien_vipham as $key => $value){
            foreach($value['malop'] as $k){
                if($malop == $k){
                    $data[] = $ds_sinhvien_vipham[$key]; 
                }
            }
        }
        $string = '';
        foreach($data as $key => $value){
            $monhoc = '';
            foreach($monhocs as $k => $v){
                if($value['mamh'] == $v['mamh']){
                    $monhoc = $v['tenmh'];
                }
            }
            if(count($value['ngay_cup_hoc']) > 2){
                $string.=   "<tr class='vi_pham_lan_3'>".
                                "<td>".$value['masv']."</td>".
                                "<td>".$value['tensv']."</td>".
                                "<td>".$monhoc."</td>".
                                "<td style='color:red'>".count($value['ngay_cup_hoc'])."</td>".
                            "</tr>";
            }
            else{
                $string.=   "<tr>".
                                "<td>".$value['masv']."</td>".
                                "<td>".$value['tensv']."</td>".
                                "<td>".$monhoc."</td>".
                                "<td>".count($value['ngay_cup_hoc'])."</td>".
                            "</tr>";
            }
                    
        }
        return response()->json($string);
    }
}

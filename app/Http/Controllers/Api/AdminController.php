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
}

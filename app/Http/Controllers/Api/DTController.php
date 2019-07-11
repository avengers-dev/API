<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DTController extends Controller
{
    public function index()
    {
        $ds_sinhvien_vipham = ViPhams::orderBy('tensv')->get();
        $lops = Lops::all();
        $monhocs = Monhocs::all();
        session()->put('chon_lop_hoc', "");
        return view('ctsv', compact('ds_sinhvien_vipham', 'lops', 'monhocs'));
    }
}

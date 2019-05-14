<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SinhViens;

class SinhVienController extends Controller
{
    public function getDanhSachSinhVien(Request $request){
        if($request->input('ca')){
            $token = $request->input('token');
            $ca = $request->input('ca');
            $data = SinhViens::getDanhSachSinhVien($token,$ca);
            if(count($data)){
                return $this->responses($data,200,trans('messages.api_success'));
            }
            return $this->responses([],404,trans('messages.api_fail'));
        }
        return $this->responses([],404,trans('messages.api_not_enough_params'));
    }
}

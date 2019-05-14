<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Monhocs;
class MonHocController extends Controller
{
    public function getMonHoc(Request $request)
    {
        if ($request->input('mamonhoc')) {
            $ma_mon_hoc = $request->input('mamonhoc');
            $data = Monhocs::getMonHoc($ma_mon_hoc);
            if(count($data)){
                return $this->responses($data[0]->tenmh,200,trans('messages.api_success'));
            }
            return $this->responses([],404,trans('messages.api_fail'));
        }
        return $this->responses([],404,trans('messages.api_not_enough_params'));
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GiangViens;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->input('email') && $request->input('matkhau')) {
            $email = $request->input('email');
            $mat_khau = $request->input('matkhau');
            $data = GiangViens::login($email,$mat_khau);
            if(count($data)){
                return $this->responses($data,200,trans('messages.api_success'));
            }
            return $this->responses([],404,trans('messages.api_fail'));
        }
        return $this->responses([],404,trans('messages.api_not_enough_params'));
    }
}

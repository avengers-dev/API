<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiangViens;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->input('email') && $request->input('matkhau')) {
            $email = $request->input('email');
            $matkhau = $request->input('matkhau');
            $data = GiangViens::login($email,$matkhau);
            if(count($data)){
                return $this->responses($data,200,trans('messages.api_success'));
            }
            return $this->responses([],404,trans('messages.api_fail'));
        }
        return $this->responses([],404,trans('messages.api_not_enough_params'));
    }
}

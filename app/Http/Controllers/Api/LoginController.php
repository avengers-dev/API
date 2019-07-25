<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GiangViens;
use DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->input('email') && $request->input('matkhau')) {
            $email = $request->input('email');
            $mat_khau = $request->input('matkhau');
            $data = GiangViens::login($email, $mat_khau);
            if (count($data)) {
                return $this->responses($data, 200, trans('messages.api_success'));
            }
            return $this->responses([], 404, trans('messages.api_fail'));
        }
        return $this->responses([], 404, trans('messages.api_not_enough_params'));
    }
    public function post_login_admin(Request $request)
    {
        $taikhoan = DB::table('admins')->where(['taikhoan' => $request->email, 'matkhau' => $request->matkhau])->get();
           
        if (count($taikhoan)) {
            
            session()->put('taikhoan', $taikhoan[0]);
            // dd(session()->get('taikhoan'));
            if ($taikhoan[0]['chucvu'] == 'CTSV')
                return redirect()->route('ctsv');
            else
                return redirect()->route('dt');
        }
        return view('index');
    }
    public function post_logout_admin()
    {
        session()->forget('taikhoan');
        return view('index');
    }
}

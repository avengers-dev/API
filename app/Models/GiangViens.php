<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class GiangViens extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'giangviens';

    public static function validateToken($token){
        if ($token != "") {
            $flag = GiangViens::where('token', $token)->count();
            if ($flag) {
                return true;
            }
        }
        return false;
    }

    public static function login($email, $mat_khau){
        $query = GiangViens::where([
            ['email', $email],
            ['matkhau', $mat_khau]
        ])->get();
        return $query;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class GiangViens extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'giangviens';
    public static function login($email, $matkhau)
    {
        $query = GiangViens::where([
            ['email', $email],
            ['matkhau', $matkhau]
        ]);
        return $query->get();
    }
}

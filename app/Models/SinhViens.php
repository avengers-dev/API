<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class SinhViens extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'sinhviens';
    public $timestamps = false;

    public static function getDanhSachSinhVien($token,$ca){
        $query = SinhViens::whereIn('malop',$ca)->get();
        return $query;
    }
}

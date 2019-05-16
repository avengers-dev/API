<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class MonHocs extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'monhocs';
    
    public static function getAllMonHoc(){
        $query = Monhocs::all();
        return $query;
    }
}

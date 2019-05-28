<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Lops extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'lops';
    
}

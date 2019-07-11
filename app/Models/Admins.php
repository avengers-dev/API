<?php

namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Middleware\Authenticate;

class Admins extends Authenticate
{
    protected $connection = 'mongodb';
    protected $collection = 'admin';
   
}

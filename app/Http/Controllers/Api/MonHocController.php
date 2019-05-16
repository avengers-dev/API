<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Monhocs;
class MonHocController extends Controller
{
    public function getAllMonHoc()
    {
        $data = Monhocs::getAllMonHoc();
        return $this->responses($data,200,trans('messages.api_success'));
    }
}

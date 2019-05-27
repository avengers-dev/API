<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ViPhams extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'viphams';
    public $timestamps = false;

    public static function updateOrInsertDanhSachViPham($ngay_diem_danh, $ma_mh, $danh_sach_sinh_vien)
    {
        foreach ($danh_sach_sinh_vien as $key => $value) {
            if ($value['check'] == 0) {
                $sv = ViPhams::where([
                    [
                        'masv', $value['masv']
                    ],
                    [
                        'mamh', $ma_mh
                    ]
                ])->get();
                if (count($sv)) {
                    $flag = false;
                    foreach($sv[0]['ngay_cup_hoc'] as $k => $v){
                        if($ngay_diem_danh == $v){
                            $flag = true;
                        }
                    }
                    if($flag){
                        $arr = $sv[0]['ngay_cup_hoc'];
                        array_push($arr, $ngay_diem_danh);
                        Viphams::where([
                            [
                                'masv', $danh_sach_sinh_vien[$key]['masv']
                            ],
                            [
                                'mamh', $ma_mh
                            ]
                        ])->update(['ngay_cup_hoc' => $arr]);
                    }
                } else {
                    ViPhams::insert([
                        [
                            'mamh' => $ma_mh,
                            'tensv' => $value['tensv'],
                            'masv' => $value['masv'],
                            'ngay_cup_hoc' => [
                                $ngay_diem_danh
                            ],
                        ],
                    ]);
                }
            } else {
                $sv = ViPhams::where([
                    [
                        'masv', $value['masv']
                    ],
                    [
                        'mamh', $ma_mh
                    ]
                ])->get();
                if (count($sv)) {
                    if (array_key_exists($ngay_diem_danh, $sv[0]['ngay_cup_hoc'])){
                        foreach($sv[0]['ngay_cup_hoc'] as $k => $v){
                            if($v == $ngay_diem_danh){
                                unset($sv[0]['ngay_cup_hoc'][$k]);
                            }
                        }
                    }
                }
            }
        }
    }
}

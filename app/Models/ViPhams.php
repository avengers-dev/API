<?php

namespace App\Models;

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
                        'masv', $value['masv'],
                    ],
                ])->get();
                if (count($sv)) {
                    $flag = false;
                    foreach ($sv[0]['mamh'] as $k => $v) {
                        if ($ma_mh == $k) {
                            $flag = true;
                        }
                    }
                    if ($flag) {
                        $arr = $sv[0]['mamh'];
                        array_push($arr[$ma_mh], $ngay_diem_danh);
                        Viphams::where([
                            [
                                'masv', $danh_sach_sinh_vien[$key]['masv'],
                            ],
                        ])->update(['mamh' => $arr]);
                    }
                    else{
                        $arr = $sv[0]['mamh'];
                        $arr[$ma_mh] = [];
                        array_push($arr[$ma_mh], $ngay_diem_danh);
                        Viphams::where([
                            [
                                'masv', $danh_sach_sinh_vien[$key]['masv'],
                            ],
                        ])->update(['mamh' => $arr]);
                    }
                } else {
                    ViPhams::insert([
                        [
                            'mamh'          => [ 
                                $ma_mh => [
                                    $ngay_diem_danh
                                ]
                            ],
                            'hosv'          => $value['hosv'],
                            'tensv'         => $value['tensv'],
                            'masv'          => $value['masv'],
                            'sdt'           => $value['sdt'],
                            'malop'         => $value['malop'],
                        ],
                    ]);
                }
            } else {
                $sv = ViPhams::where([
                    [
                        'masv', $value['masv'],
                    ],
                ])->get();
                if (count($sv)) {
                    $data = $sv[0]['mamh'];
                    foreach ($data as $k => $v) {
                        if ($ma_mh == $k) {
                            foreach($data[$k] as $key => $value){
                                if($ngay_diem_danh == $value){
                                    if(count($data[$k])==1){
                                        unset($data[$ma_mh]);
                                    }
                                    else{
                                        unset($data[$k][$key]);
                                    }
                                }
                            }
                            $arr = $data;
                            Viphams::where([
                                [
                                    'masv', $sv[0]['masv'],
                                ],
                            ])->update(['mamh' => $arr]);
                        }
                    }
                    if (count($data) == 0) {
                        Viphams::where([
                            [
                                'masv', $sv[0]['masv'],
                            ]
                        ])->delete();
                    }
                }
            }
        }
    }
}

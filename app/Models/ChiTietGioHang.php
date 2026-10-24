<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietGioHang extends Model
{
    protected $table = 'chitiet_giohang';

    protected $primaryKey = 'id_chitiet';

    public $timestamps = false;

    protected $fillable = [
        'id_giohang',
        'ma_sanpham',
        'so_luong_mua',
    ];

    public function gioHang()
    {
        return $this->belongsTo(
            GioHang::class,
            'id_giohang',
            'id_giohang'
        );
    }

    public function sanPham()
    {
        return $this->belongsTo(
            SanPham::class,
            'ma_sanpham',
            'ma_sanpham'
        );
    }
}
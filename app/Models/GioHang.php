<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    protected $table = 'giohang';

    protected $primaryKey = 'id_giohang';

    public $timestamps = false;

    protected $fillable = [
        'ma_khachhang',
        'trang_thai',
    ];

    public function khachHang()
    {
        return $this->belongsTo(
            KhachHang::class,
            'ma_khachhang',
            'ma_khachhang'
        );
    }

    public function chiTiet()
    {
        return $this->hasMany(
            ChiTietGioHang::class,
            'id_giohang',
            'id_giohang'
        );
    }
}
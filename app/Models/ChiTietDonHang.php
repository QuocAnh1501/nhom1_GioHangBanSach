<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    protected $table = 'chitiet_donhang';

    protected $primaryKey = 'ma_chitiet';

    public $timestamps = false;

    protected $fillable = [
        'ma_donhang',
        'ma_sanpham',
        'so_luong',
        'don_gia',
        'thanh_tien',
    ];

    public function donHang()
    {
        return $this->belongsTo(
            DonHang::class,
            'ma_donhang',
            'ma_donhang'
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
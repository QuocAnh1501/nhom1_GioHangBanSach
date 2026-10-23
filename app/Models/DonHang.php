<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $table = 'donhang';

    protected $primaryKey = 'ma_donhang';

    public $timestamps = false;

    protected $fillable = [
        'ma_khachhang',
        'ngay_dat',
        'tong_tien',
        'ma_trangthai',
        'ghi_chu',
        'phuong_thuc_thanh_toan',
    ];

    public function khachHang()
    {
        return $this->belongsTo(
            KhachHang::class,
            'ma_khachhang',
            'ma_khachhang'
        );
    }

    public function trangThai()
    {
        return $this->belongsTo(
            TrangThaiDonHang::class,
            'ma_trangthai',
            'ma_trangthai'
        );
    }

    public function chiTiet()
    {
        return $this->hasMany(
            ChiTietDonHang::class,
            'ma_donhang',
            'ma_donhang'
        );
    }
}
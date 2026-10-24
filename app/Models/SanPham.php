<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'sanpham';

    protected $primaryKey = 'ma_sanpham';

    public $timestamps = false;

    protected $fillable = [
        'ma_danhmuc',
        'ten_san_pham',
        'tac_gia',
        'nha_xuat_ban',
        'nam_xuat_ban',
        'isbn',
        'mo_ta',
        'gia_ban',
        'so_luong_ton',
        'hinh_anh',
        'trang_thai',
    ];

    public function danhMuc()
    {
        return $this->belongsTo(
            DanhMuc::class,
            'ma_danhmuc',
            'ma_danhmuc'
        );
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrangThaiDonHang extends Model
{
    protected $table = 'trang_thai_donhang';

    protected $primaryKey = 'ma_trangthai';

    public $timestamps = false;

    protected $fillable = [
        'ten_trangthai',
        'mo_ta',
    ];
}
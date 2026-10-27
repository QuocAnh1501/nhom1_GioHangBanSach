<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class KhachHang extends Authenticatable
{
    use Notifiable;

    protected $table = 'khachhang';
    protected $primaryKey = 'ma_khachhang';
    public $timestamps = false;

    protected $fillable = [
        'ho_ten',
        'email',
        'so_dien_thoai',
        'dia_chi',
        'mat_khau',
        'ngay_dang_ky',
        'trang_thai',
    ];

    protected $hidden = [
        'mat_khau',
    ];

    // Khai báo cột chứa mật khẩu cho hệ thống Auth của Laravel
    public function getAuthPassword()
    {
        return $this->mat_khau;
    }
}
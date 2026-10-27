<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class KhachHang extends Authenticatable
{
    use Notifiable;

    // Khai báo tên bảng trong CSDL
    protected $table = 'khachhang';

    // Khai báo khóa chính
    protected $primaryKey = 'ma_khachhang';

    // Tắt timestamps (vì bảng không dùng created_at và updated_at)
    public $timestamps = false;

    // Các cột cho phép chèn dữ liệu
    protected $fillable = [
        'ho_ten',
        'email',
        'so_dien_thoai',
        'dia_chi',
        'mat_khau',
        'ngay_dang_ky',
        'trang_thai',
    ];

    // Cột ẩn khi trả về dữ liệu
    protected $hidden = [
        'mat_khau',
    ];

    /**
     * Chỉ định cho Laravel Auth biết cột 'mat_khau' 
     * dùng làm password để xác thực đăng nhập.
     */
    public function getAuthPassword()
    {
        return $this->mat_khau;
    }
}
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class KhachHang extends Model
{
    protected $table = 'khachhang';
    protected $primaryKey = 'ma_khachhang';
    public $timestamps = false;
    protected $fillable = [
        'ho_ten',
        'email',
        'so_dien_thoai',
        'dia_chi',
        'mat_khau',
        'trang_thai',
    ];
}
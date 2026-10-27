<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    protected $table = 'danh_muc';

    protected $primaryKey = 'ma_danhmuc';

    public $timestamps = false;

    protected $fillable = [
        'ten_danh_muc',
        'mo_ta',
    ];

    /**
     * Lấy danh sách sản phẩm thuộc danh mục.
     */
    public function sanPhams()
    {
        return $this->hasMany(
            SanPham::class,
            'ma_danhmuc',
            'ma_danhmuc'
        );
    }
}

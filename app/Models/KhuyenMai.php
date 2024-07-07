<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhuyenMai extends Model
{
    use HasFactory;
    protected $table = 'khuyenmai';
    protected $fillable = [
        'maKhuyenMai',
        'tenKhuyenMai',
        'gia',
        'thoiGianBatDau',
        'thoiGianKetThuc',
        'moTa',
        'trangThai',
        'maNguoiDang',
        'dieuKienGia',
    ];
    protected $primaryKey = 'maKhuyenMai';
    public $incrementing = false;
    public $timestamps = false;
}

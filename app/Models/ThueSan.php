<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThueSan extends Model
{
    use HasFactory;
    protected $table = 'thuesan';
    protected $fillable = [
        'maNguoiDung',
        'maVatPham',
        'soLuong',
        'maSan',
        'hinhThucDat',
        'thoiGianBatDau',
        'thoiGianKetThuc',
        'trangThai',
        'thu',
        'ngay',
        'created_at',
        'updated_at',
    ];
    protected $primaryKey = 'id';
}

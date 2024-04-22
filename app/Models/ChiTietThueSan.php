<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietThueSan extends Model
{
    use HasFactory;
    protected $table = 'chitietthuesan';
    protected $fillable = [
        'maVe',
        'maVatPham',
        'maSan',
        'soLuong',
        'gia',
        'maHinhThuc',
        'thoiGianBatDau',
        'thoiGianKetThuc',
    ];
    protected $primaryKey = 'maCTTS';
}

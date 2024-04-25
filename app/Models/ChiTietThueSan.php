<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChiTietThueSan extends Model
{
    use HasFactory, SoftDeletes;
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
    public function ve()
    {
        return $this->belongsTo(Ve::class, 'maVe', 'id');
    }
}

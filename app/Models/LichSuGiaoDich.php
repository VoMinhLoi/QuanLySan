<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichSuGiaoDich extends Model
{
    use HasFactory;
    protected $table = 'lichsugiaodich';
    protected $fillable = [
        'maNguoiDung',
        'ndck',
        'transID',
        'soTien',
        'thoiGian',
        'trangThai',
        'loaiGD',
    ];
    protected $primaryKey = 'id';
}

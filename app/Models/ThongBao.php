<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongBao extends Model
{
    use HasFactory;
    protected $table = 'thongbao';
    protected $fillable = [
        'maNguoiDung',
        'loaiTB',
        'tieuDe',
        'noiDung',
        'daXem',
        'thoiGian',
        'updated_at',
        'created_at',
    ];
    protected $primaryKey = 'id';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    use HasFactory;
    protected $table = 'tintuc';
    protected $fillable = [
        'maNguoiDang',
        'tieuDe',
        'moTa',
        'lienKetNgoai',
        'hinhAnh',
        'thoiGian',
        'created_at',
        'updated_at',
    ];
    protected $primaryKey = 'id';
}

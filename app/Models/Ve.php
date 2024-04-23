<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ve extends Model
{
    use HasFactory;
    protected $table = 've';
    protected $fillable = [
        'maNguoiDung',
        'diaChi',
        'maPX',
        'SDT',
        'tongTien',
        'daThanhToan',
        'trangThai',
        'hoTen',

    ];
    protected $primaryKey = 'id';
}

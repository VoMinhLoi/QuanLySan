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
        'taiKhoan'
    ];
    protected $primaryKey = 'id';
    public function chiTietThueSans()
    {
        return $this->hasMany(ChiTietThueSan::class, 'maVe', 'id');
    }
}

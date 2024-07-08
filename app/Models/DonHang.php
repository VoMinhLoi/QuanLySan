<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;
    protected $table = "donhang";
    protected $fillable = [
        'id',
        'maNguoiDung',
        'tongTien',
        'daThanhToan',
        'phuongThucThanhToan',
        'maPX',
        'diaChi',
        'sdt',
        'hoTen',
        'ngayDatHang',
        'ngayNhanHang',
        'giamGia',
        'ghiChu',
    ];
    protected $primaryKey = 'id';
    public $timestamps = false;
}

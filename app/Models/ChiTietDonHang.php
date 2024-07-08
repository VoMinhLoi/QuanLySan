<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    use HasFactory;
    protected $table = "chitietdonhang";
    protected $fillable = [
        'id',
        'maDonHang',
        'maDungCu',
        'soLuong',
        'tongTien'
    ];
    protected $primaryKey = 'id';
    public $timestamps = false;
}

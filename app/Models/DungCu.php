<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DungCu extends Model
{
    use HasFactory;
    protected $table = 'dungcu';
    protected $primaryKey = 'maDungCu';
    public $incrementing = false;
    protected $fillable = [
        'maLoaiDC',
        'tenDungCu',
        'soLuongCon',
        'soLuongChoThue',
        'trangThai',
        'moTa',
        'hinhAnh1',
        'donGiaGoc',
        'donGiaThue',
        'created_at',
        'updated_at',
    ];
}

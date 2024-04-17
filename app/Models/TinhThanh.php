<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinhThanh extends Model
{
    use HasFactory;
    protected $table = 'tinhthanh';
    protected $primaryKey = 'maTinhThanh';
    public $incrementing = false;
    public function quanhuyen()
    {
        return $this->hasMany('App\Models\QuanHuyen');
    }
}

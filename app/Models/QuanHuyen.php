<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuanHuyen extends Model
{
    use HasFactory;
    protected $table = 'quanhuyen';
    protected $primaryKey = 'maQuanHuyen';
    public $incrementing = false;
    public function phuongxa()
    {
        return $this->hasMany('App\Models\PhuongXa');
    }
}

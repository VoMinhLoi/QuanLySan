<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoSo extends Model
{
    protected $table = 'coso';
    protected $primaryKey = 'maCoSo';
    public $incrementing = false;
    public function sanbong()
    {
        return $this->hasMany('App\Models\SanBong');
    }
}

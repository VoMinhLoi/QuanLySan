<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhuongXa extends Model
{
    use HasFactory;
    protected $table = 'phuongxa';
    protected $primaryKey = 'maPhuongXa';
    public $incrementing = false;
}

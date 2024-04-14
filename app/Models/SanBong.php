<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanBong extends Model
{
    protected $table = 'sanbong';
    protected $primaryKey = 'maSan';
    public $incrementing = false;
    use HasFactory;
}

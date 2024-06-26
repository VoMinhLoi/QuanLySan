<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'nguoidung';
    protected $primaryKey = "maNguoiDung";
    public $incrementing = true;
    protected $fillable = [
        'ho',
        'ten',
        'ngaySinh',
        'password',
        'gioiTinh',
        'cccd',
        'diaChi',
        'SDT',
        'taiKhoan',
        'password',
        'soDuTaiKhoan',
        'trangThai',
        'google_id',
        'google_token',
        'maXN',
        'maPX',
        'maQuyen',
        'hinhDaiDien'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

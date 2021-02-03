<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Users extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    // 取消 timestamps 自动生成。
    public $timestamps = false;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        "user_id",
        'username',
        'password',
        'qq_email',
    ];

    protected $hidden = [
        'password',
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}

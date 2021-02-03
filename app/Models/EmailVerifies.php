<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerifies extends Model
{
    use HasFactory;

    // 取消 timestamps 自动生成。
    public $timestamps = false;

    protected $fillable = [
        "qq_email",
        'code',
    ];
}

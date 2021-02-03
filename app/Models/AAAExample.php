<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AAAExample extends Model
{
    use HasFactory;

    /// 默认主键为 id 字段, 可以自定义主键字段
    protected $primaryKey = '';

    // 取消 timestamps 自动生成。
    public $timestamps = false;

    // 批量赋值时可执行赋值的字段
    protected $fillable = [];

    // 不可进行序列化的字段, 可以防止服务器端意外的响应隐私字段
    protected $hidden = [];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AAAExample extends Model
{
    // 可以用来数据库数据填充
    use HasFactory;

    // Model 默认所调用的主键名为 "id" , 而mysql 仍然配置的是自定义字符, 该 $primaryKey 字段可以配置 Model 所调用主键名;
    // 若没有主键，设为 null 即可。
    protected $primaryKey = null;

    // 取消 timestamps 自动生成。
    public $timestamps = false;

    // 批量赋值时可执行赋值的字段
    protected $fillable = [];

    // 将字段隐藏, 可以防止服务器端意外的响应隐私字段
    protected $hidden = [];
}

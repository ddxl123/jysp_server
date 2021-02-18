<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;;

use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use  HasFactory, HasApiTokens;

    public $timestamps = false;

    protected $primaryKey = 'user_id';


    // 生成 token：
    // 密码授权需要使用 username 和 password 两个字段值进行 token 的生成，
    // 相对于 User 表的字段是 user_id 和 password，可修改密码授权对应的 User 表字段，修改的方式看源码。

    // 验证 token ：
    // 先会自动解析请求头中的 Bearer Token 字段，再根据【密码授权中的username】字段从数据库中查询对应的 user_id 是否存在。

    //  默认对应查询的是 email 字段。
    public function findForPassport($username)
    {
        return $this->where('user_id', $username)->first();
    }

    // 以什么方式对 password 进行加密，默认是使用 Hash 算法，最后会把【加密后的 password + user_id】 加密成 token。
    public function validateForPassportPasswordGrant($password)
    {
        return $password;
    }
}

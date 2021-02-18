<?php

namespace App\Http\Controllers\RegisterAndLogin;

use App\Http\Controllers\Controller;
use App\Models\EmailVerify;
use App\Models\User;
use Custom\CustomCatchResponse;
use Custom\CustomToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;


class ByEmailController extends Controller
{

    // TODO: 1 POST api/register_and_login/by_email/send_email, request: email
    public function send_email(Request $request)
    {
        if ($mail_format_vail = $this->mail_format_vail($request, 1)) {
            return $mail_format_vail;
        }

        try {
            // 随机验证码
            $random =  rand(1000, 9999);

            // 发送 mail
            Mail::raw('验证码：' . $random, function ($message) use ($request) {
                $message->subject('登陆/注册验证码');
                $message->to($request->email);
            });
        } catch (\Throwable $th) {
            // TODO: code:100, data:null, ps:邮箱发送异常
            return CustomCatchResponse::catch_response(100, null, $th);
        }

        // 邮箱发送成功
        // 发送成功则将code存入数据库，若存在该email，则修改其code，若不存在则新建一个。
        try {
            EmailVerify::query()->updateOrCreate(
                [
                    "email" => $request->email,
                ],
                [
                    "code" => $random,
                ]
            );

            // 验证码存储成功，响应给客户端成功消息
            // TODO: code:102, data:null, ps:邮箱发送流程完全成功
            return response(
                [
                    "code" => 102,
                    "data" => null,
                ]
            );
        } catch (\Throwable $th) {
            // TODO: code:101, data:null, ps:验证码存储异常
            return CustomCatchResponse::catch_response(101, null, $th);
        }
    }

    // TODO: 2 POST api/register_and_login/by_email/verify_email, request: email, code
    public function verify_email(Request $request)
    {
        if ($mail_format_vail = $this->mail_format_vail($request, 2)) {
            return $mail_format_vail;
        };

        try {
            // 数据库中找到对应的邮箱验证码，删除并返回删除数量（未找到则返回0）
            $count =  EmailVerify::query()->where(
                [
                    "email" => $request->email,
                    "code" => $request->code,
                ],
            )->delete();
            if ($count == 0) {
                // TODO: code:200, data:null, ps:邮箱验证码错误
                return response(
                    [
                        "code" => 200,
                        "data" => null,
                    ]
                );
            } else {
                // 验证码正确
                if ($register_or_Login = $this->register_or_Login($request)) {
                    return $register_or_Login;
                }
            }
        } catch (\Throwable $th) {
            // TODO: code:201, data:null, ps:邮箱验证异常
            return CustomCatchResponse::catch_response(201, null, $th);
        }
    }

    // TODO: 1 2
    public function mail_format_vail(Request $request, $num)
    {
        // 防止请求数据为null或乱码。
        // 验证传递过来的邮箱格式是否正确
        try {
            $val = Validator::make(
                [
                    "email" => $request->email,
                ],
                [
                    "email" => "email",
                ],
            );
            // 邮箱格式错误
            if (!$val->errors()->isEmpty()) {
                // TODO: code:103, data:null, ps:邮箱格式错误
                // TODO: code:202, data:null, ps:邮箱格式错误
                $code = $num == 1 ? 103 : 202;
                return response(
                    [
                        "code" => $code,
                        "data" => null,
                    ]
                );
            }
        } catch (\Throwable $th) {
            // TODO: code:104, data:null, ps:邮箱格式检测异常
            // TODO: code:203, data:null, ps:邮箱格式检测异常
            $code = $num == 1 ? 104 : 203;
            return CustomCatchResponse::catch_response($code, null, $th);
        }
    }

    // TODO: 2
    // 邮箱验证码正确
    // 判断是否已经注册，若已注册则直接登陆，若未注册则先注册后直接登陆，最后生成并响应 token
    public function register_or_Login(Request $request)
    {
        // 查询数据库中是否存在该用户
        try {
            $users = User::query()->where(
                [
                    "email" => $request->email,
                ]
            )->get();
            $count = $users->count();
        } catch (\Throwable $th) {
            // TODO: code:204, data:null, ps:数据库查找该 email 异常
            return CustomCatchResponse::catch_response(204, null, $th);
        }

        // 若不存在，则创建一个新用户，并只响应 token
        if ($count == 0) {
            // 创建新用户
            try {
                $new_user = new User;
                $new_user->username = "还没有起名字";
                $new_user->password = (string)Uuid::uuid4();
                $new_user->email = $request->email;
                $new_user->save();
            } catch (\Throwable $th) {
                // TODO: code:205, data:null, ps:数据库创建新用户异常
                return CustomCatchResponse::catch_response(205, null, $th);
            }

            // 生成 token
            try {
                $tokenBody = CustomToken::create_token($new_user->user_id, $new_user->password);
                // TODO: code:206, data:{"access_token":string,"refresh_token":string}, ps:用户注册成功并只响应 token
                return response(
                    [
                        "code" => 206,
                        "data" => [
                            "access_token" => $tokenBody["access_token"],
                            "refresh_token" => $tokenBody["refresh_token"],
                        ],
                    ],
                );
            } catch (\Throwable $th) {
                // TODO: code:207, data:null, ps:生成 token 异常
                return CustomCatchResponse::catch_response(207, null, $th);
            }
        }

        // 若存在，则只响应 token
        // 不存在存在一个以上，因为 email 被限制唯一了
        else {
            try {
                // 获取那一个
                $old_user = $users[0];
                // 生成 token
                $tokenBody = CustomToken::create_token($old_user->user_id, $old_user->password);
                // TODO: code:208, data:{"access_token":string,"refresh_token":string}, ps:用户登陆成功并只响应 token
                return response(
                    [
                        "code" => 208,
                        "data" => [
                            "access_token" => $tokenBody["access_token"],
                            "refresh_token" => $tokenBody["refresh_token"],
                        ],
                    ],
                );
            } catch (\Throwable $th) {
                // TODO: code:209, data:null, ps:生成 token 异常
                return CustomCatchResponse::catch_response(209, null, $th);
            }
        }
    }
}

<?php

namespace App\Http\Controllers\RegisterAndLogin;

use App\Http\Controllers\Controller;
use App\Models\EmailVerifies;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ByEmailController extends Controller
{
    // TODO: api/register_and_login/by_email/send_email, response: qq_email
    public function send_email(Request $request)
    {
        try {
            // 防止请求数据为null或乱码。
            // 验证传递过来的邮箱格式是否正确
            $val = Validator::make(
                [
                    "qq_email" => $request->qq_email,
                ],
                [
                    "qq_email" => "email",
                ],
            );

            // 邮箱格式错误
            if (!$val->errors()->isEmpty()) {
                // TODO: code:103, data:邮箱格式错误
                return response(
                    [
                        "code" => 103,
                        "data" => null,
                    ]
                );
            }

            // 该用户是否已被注册
            $registereds = DB::table(Users::getModel()->getTable())->where("qq_email", $request->qq_email)->get();
            $registeredsCount = $registereds->count();

            // 数据库存在多个该邮箱
            if ($registeredsCount > 1) {
                // TODO: code:104, data:null, 备注:数据库存在多个该邮箱
                return response([
                    "code" => 104,
                    "data" => null,
                ]);
            }


            // 未被注册
            else if ($registeredsCount == 0) {
                DB::table(Users::getModel()->getTable())->insertGetId(
                    [
                        "username" => "还没有起名",
                        "password" => null,
                        "qq_email" => $request->qq_email,
                    ]
                );
            }


            // 随机验证码
            $random =  rand(1000, 9999);

            // 发送 mail，返回值为 void
            Mail::raw('验证码：' . $random, function ($message) use ($request) {
                $message->subject('登陆/注册验证码');
                $message->to($request->qq_email);
            });
            // 发送成功则将code存入数据库，若存在该user_id，则修改其code，若不存在则新建一个。
            DB::table(EmailVerifies::getModel()->getTable())->updateOrInsert(
                [
                    "qq_email" => $request->qq_email,
                ],
                [
                    "code" => $random,
                ]
            );

            // 响应客户端成功消息
            // TODO: code:100, data:null, 备注:邮箱已发送
            return response(
                [
                    "code" => 100,
                    "data" => null,
                ]
            );
        }

        // 异常处理
        catch (\Throwable $th) {
            return $th;
            // TODO: code:101, data:异常数据, 备注:邮箱发送异常
            return response(
                [
                    "code" => 101,
                    "data" => null,
                ]
            );;
        }
    }

    // TODO: api/register_and_login/by_email/verify_email, response: qq_email, code
    public function verify_email(Request $request)
    {
        try {
            // 防止请求数据为null或乱码。
            // 验证传递过来的邮箱格式是否正确
            $val = Validator::make(
                [
                    "qq_email" => $request->qq_email,
                ],
                [
                    "qq_email" => "email",
                ],
            );

            // 邮箱格式错误
            if (!$val->errors()->isEmpty()) {
                // TODO: code:108, data:邮箱格式错误
                return response(
                    [
                        "code" => 108,
                        "data" => null,
                    ]
                );
            }

            // 数据库中找到该user_id对应的邮箱验证码
            $isExists =  DB::table(EmailVerifies::getModel()->getTable())->where(
                [
                    "qq_email" => $request->qq_email,
                    "code" => $request->code,
                ],
            )->exists();

            if ($isExists) {
                // TODO: code:105, data:null, 备注:邮箱验证码正确
                return response(
                    [
                        "code" => 105,
                        "data" => null,
                    ]
                );
            } else {
                // TODO: code:106, data:null, 备注:邮箱验证码错误
                return response(
                    [
                        "code" => 106,
                        "data" => null,
                    ]
                );
            }
        }

        // 异常处理
        catch (\Throwable $th) {
            return $th;
            // TODO: code:107, data:null, 备注:邮箱验证异常
            return response(
                [
                    "code" => 107,
                    "data" => null,
                ]
            );
        }
    }
}

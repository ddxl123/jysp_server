<?php

namespace App\Http\Controllers\RegisterAndLogin;

use App\Http\Controllers\Controller;
use Custom\CustomCatchResponse;
use Custom\CustomToken;
use Illuminate\Http\Request;

class RefreshTokenController extends Controller
{
    public function refresh_token(Request $request)
    {
        try {
            $body = CustomToken::refresh_token($request->bearerToken());
            // TODO: code:-2, data:$body, ps:刷新 token 成功
            return response(
                [
                    "code" => -2,
                    "data" => $body,
                ]
            );
        } catch (\Throwable $th) {
            // TODO: code:-3, data:null, ps:刷新 token 失败
            return CustomCatchResponse::catch_response(-3, null, $th);
        }
    }
}

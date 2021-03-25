<?php

namespace App\Http\Middleware;

use Closure;
use Custom\CustomCatchResponse;
use Custom\CustomToken;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        // 验证 access_token
        try {
            // 若验证成功，$request->user() 值便不为 null
            $this->authenticate($request, $guards);

            // 验证 access_token 成功
            return $next($request);
        } catch (\Throwable $th) {
            // TODO: code:-1, data:null, ps:验证 access_token 失败
            return CustomCatchResponse::catch_response(-1, null, $th);
        }
    }
}

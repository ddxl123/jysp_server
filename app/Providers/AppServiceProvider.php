<?php

namespace App\Providers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 监听查询构造器
        DB::listen(function ($query) {
            Log::info("-");
            Log::info("sql语句:", [$query->sql, $query->bindings]);
            Log::info("耗时(ms):", [$query->time]);
            Log::info("数据库:", [$query->connection->getName()]);
            Log::info((new Exception())->getTraceAsString()); // 获取被调用的全部函数
            Log::info("-");
        });
    }
}

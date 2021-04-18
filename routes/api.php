<?php

use App\Http\Controllers\Auth\FragmentPoolNodesController;
use App\Http\Controllers\Auth\InitDownloadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterAndLogin\ByEmailController;
use App\Http\Controllers\RegisterAndLogin\RefreshTokenController;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/test', [TestController::class, "test"]);

// 获取 token
Route::post('/register_and_login/by_email/send_email', [ByEmailController::class, "send_email"]);
Route::post('/register_and_login/by_email/verify_email', [ByEmailController::class, "verify_email"]);

// 刷新 token
Route::get('/refresh_token', [RefreshTokenController::class, "refresh_token"]);


Route::get('/init_download/get_user_info', [InitDownloadController::class, "get_user_info"])->middleware("auth:api");
Route::get('/init_download/get_pending_pool_nodes', [InitDownloadController::class, "get_pending_pool_nodes"])->middleware("auth:api");
Route::get('/init_download/get_memory_pool_nodes', [InitDownloadController::class, "get_memory_pool_nodes"])->middleware("auth:api");
Route::get('/init_download/get_complete_pool_nodes', [InitDownloadController::class, "get_complete_pool_nodes"])->middleware("auth:api");
Route::get('/init_download/get_rule_pool_nodes', [InitDownloadController::class, "get_rule_pool_nodes"])->middleware("auth:api");
Route::get('/init_download/get_pending_pool_node_fragments', [InitDownloadController::class, "get_pending_pool_node_fragments"])->middleware("auth:api");
Route::get('/init_download/get_memory_pool_node_fragments', [InitDownloadController::class, "get_memory_pool_node_fragments"])->middleware("auth:api");
Route::get('/init_download/get_complete_pool_node_fragments', [InitDownloadController::class, "get_complete_pool_node_fragments"])->middleware("auth:api");
Route::get('/init_download/get_rule_pool_node_fragments', [InitDownloadController::class, "get_rule_pool_node_fragments"])->middleware("auth:api");

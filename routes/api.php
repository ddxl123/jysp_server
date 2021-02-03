<?php

use App\Http\Controllers\FragmentPoolNodesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterAndLogin\ByEmailController;
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

Route::post('/test', [TestController::class, "test"]);
Route::post('/register_and_login/by_email/send_email', [ByEmailController::class, "send_email"]);
Route::post('/register_and_login/by_email/verify_email', [ByEmailController::class, "verify_email"]);
Route::get('/fragment_pool_nodes', [FragmentPoolNodesController::class, "fragment_pool_nodes"]);

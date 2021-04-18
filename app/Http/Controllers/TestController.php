<?php

namespace App\Http\Controllers;

use App\Models\Rs;
use App\Models\TestModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function test(Request $request)
    {
        try {
            $all = TestModel::query()->get();
            return response()->json($all, 200, ["content-length" => strlen($all)]);
        } catch (\Throwable $th) {
            return response($th);
        }
    }
}

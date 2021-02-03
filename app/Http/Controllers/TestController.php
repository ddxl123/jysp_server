<?php

namespace App\Http\Controllers;

use App\Models\EmailVerifies;
use App\Models\Users;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request)
    {
        $ucre = Users::create([
            "username" => "呵呵呵",
            "password" => "sssssss",
        ]);
        $newu =  new Users;
        $newu->username = "哈哈哈";
        $newu->password = "ppppppp";
        $newu->save();
        return [
            $ucre,
            $newu
        ];
    }
}

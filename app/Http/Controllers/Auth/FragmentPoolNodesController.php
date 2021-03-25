<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\FragmentPoolNode;
use App\Models\User;
use Custom\CustomCatchResponse;
use Illuminate\Http\Request;

class FragmentPoolNodesController extends Controller
{
    // TODO: 3 GET api/get_fragment_pool_nodes
    public function get_fragment_pool_nodes(Request $request)
    {
        try {
            $pool_type = $request->query("pool_type");

            if ($pool_type == null) {
                // TODO: code:300, data:null, ps:缺少 pool_type 参数
                return response(
                    [
                        "code" => 300,
                        "data" => null,
                    ]
                );
            }

            $user_id = $request->user()->user_id;
            // 获取的结果不需要 user_id
            $nodes =  FragmentPoolNode::query()->where([["user_id", "=", $user_id], ["pool_type", "=", $pool_type]])->get()->makeHidden("user_id");
            // TODO: code:301, data:$nodes, ps:获取当前碎片池节点成功
            return response(
                [
                    "code" => 301,
                    "data" => $nodes,
                ]
            );
        } catch (\Throwable $th) {
            // TODO: code:302, data:null, ps:获取当前碎片池节点异常
            return CustomCatchResponse::catch_response(302, null, $th);
        }
    }
}

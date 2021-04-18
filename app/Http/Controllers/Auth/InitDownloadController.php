<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\FragmentOwnerAboutCompletePoolNode;
use App\Models\FragmentOwnerAboutMemoryPoolNode;
use App\Models\FragmentOwnerAboutPendingPoolNode;
use App\Models\PnCompletePoolNode;
use App\Models\PnMemoryPoolNode;
use App\Models\PnPendingPoolNode;
use App\Models\PnRulePoolNode;
use App\Models\RuleOwner;
use Custom\CustomCatchResponse;
use Illuminate\Http\Request;

class InitDownloadController extends Controller
{
    public function get_user_info(Request $request)
    {
        try {
            // 隐藏了 password
            $user = $request->user();
            // TODO: code:300, data:user_info, ps:
            return response()->json(
                [
                    "code" => 300,
                    "data" => $user
                ]
            );
        } catch (\Throwable $th) {
            // TODO: code:301, data:null, ps:
            return  CustomCatchResponse::catch_response(301, $th);
        }
    }

    public function get_pending_pool_nodes(Request $request)
    {
        try {
            $user = $request->user();
            $queryResult = PnPendingPoolNode::query()->where("user_id", "=", $user->id)->get()->makeHidden("user_id")->all();

            // TODO: code:302, data:pending_pool_nodes, ps:
            return response()->json(
                [
                    "code" => 302,
                    "data" => $queryResult,
                ]
            );
        } catch (\Throwable $th) {
            // TODO: code:303, data:null, ps:
            return  CustomCatchResponse::catch_response(303, $th);
        }
    }

    public function get_memory_pool_nodes(Request $request)
    {
        try {
            $user = $request->user();
            $queryResult = PnMemoryPoolNode::query()->where("user_id", "=", $user->id)->get()->makeHidden("user_id")->all();

            // TODO: code:304, data:memory_pool_nodes, ps:
            return response()->json(
                [
                    "code" => 304,
                    "data" => $queryResult,
                ]
            );
        } catch (\Throwable $th) {
            // TODO: code:305, data:null, ps:
            return  CustomCatchResponse::catch_response(305, $th);
        }
    }

    public function get_complete_pool_nodes(Request $request)
    {
        try {
            $user = $request->user();
            $queryResult = PnCompletePoolNode::query()->where("user_id", "=", $user->id)->get()->makeHidden("user_id")->all();
            // TODO: code:306, data:complete_pool_nodes, ps:
            return response()->json(
                [
                    "code" => 306,
                    "data" => $queryResult,
                ]
            );
        } catch (\Throwable $th) {
            // TODO: code:307, data:null, ps:
            return  CustomCatchResponse::catch_response(307, $th);
        }
    }

    public function get_rule_pool_nodes(Request $request)
    {
        try {
            $user = $request->user();
            $queryResult = PnRulePoolNode::query()->where("user_id", "=", $user->id)->get()->makeHidden("user_id")->all();
            // TODO: code:308, data:rule_pool_nodes, ps:
            return response()->json(
                [
                    "code" => 308,
                    "data" => $queryResult,
                ]
            );
        } catch (\Throwable $th) {
            // TODO: code:309, data:null, ps:
            return  CustomCatchResponse::catch_response(309, $th);
        }
    }

    public function get_pending_pool_node_fragments(Request $request)
    {
        try {
            $user = $request->user();
            $queryResult = FragmentOwnerAboutPendingPoolNode::with("belongs_to_raw_fragment:id,title")->where("user_id", "=", $user->id)->get()->makeHidden(["user_id"])->all();

            // TODO: code:310, data:pending_pool_node_fragments, ps:
            return response()->json(
                [
                    "code" => 310,
                    "data" => $queryResult,
                ]
            );
        } catch (\Throwable $th) {
            // TODO: code:311, data:null, ps:
            return  CustomCatchResponse::catch_response(311, $th);
        }
    }

    public function get_memory_pool_node_fragments(Request $request)
    {
        try {
            $user = $request->user();
            $queryResult = FragmentOwnerAboutMemoryPoolNode::query()->where("user_id", "=", $user->id)->get()->makeHidden(["user_id"])->all();

            // TODO: code:312, data:memory_pool_node_fragments, ps:
            return response()->json(
                [
                    "code" => 312,
                    "data" => $queryResult,
                ]
            );
        } catch (\Throwable $th) {
            // TODO: code:313, data:null, ps:
            return  CustomCatchResponse::catch_response(313, $th);
        }
    }

    public function get_complete_pool_node_fragments(Request $request)
    {
        try {
            $user = $request->user();
            $queryResult = FragmentOwnerAboutCompletePoolNode::query()->where("user_id", "=", $user->id)->get()->makeHidden(["user_id"])->all();

            // TODO: code:313, data:complete_pool_node_fragments, ps:
            return response()->json(
                [
                    "code" => 313,
                    "data" => $queryResult,
                ]
            );
        } catch (\Throwable $th) {
            // TODO: code:314, data:null, ps:
            return  CustomCatchResponse::catch_response(314, $th);
        }
    }

    public function get_rule_pool_node_fragments(Request $request)
    {
        try {
            $user = $request->user();
            $queryResult = RuleOwner::with("belongs_to_raw_rule:id")->where("user_id", "=", $user->id)->get()->makeHidden(["user_id"])->all();

            // TODO: code:315, data:rule_pool_node_fragments, ps:
            return response()->json(
                [
                    "code" => 315,
                    "data" => $queryResult,
                ]
            );
        } catch (\Throwable $th) {
            // TODO: code:316, data:null, ps:
            return  CustomCatchResponse::catch_response(316, $th);
        }
    }
}

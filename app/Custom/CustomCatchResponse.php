<?php

// 重新加载命令：composer dumpautoload -o
namespace Custom;

class CustomCatchResponse
{
    /**
     * @return array $response
     */
    public static function catch_response($code, $data, $th)
    {
        // return response(
        //     [
        //         "code" => $code,
        //         "data" => $data,
        //     ]
        // );
        // var_dump($code);
        return response(
            [
                "code" => $code,
                "data" => $data,
            ]
        );
    }
}

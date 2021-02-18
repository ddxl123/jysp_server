<?php

// 重新加载命令：composer dumpautoload -o
namespace Custom;

use GuzzleHttp\Client;

class CustomToken
{
    /**
     * @return array $body
     */
    public static function create_token($username, $password)
    {
        $http = new Client();
        $result = $http->post(config("app")['url'] . "/oauth/token", [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => config("passport")["password_id"],
                'client_secret' => (string)config("passport")["password_secret"],
                'username' => $username,
                'password' => $password,
                'scope' => '*',
            ],
        ]);
        return json_decode((string)$result->getBody(), true);
    }

    /**
     * @return array $body
     */
    public static function refresh_token($refresh_token)
    {
        $http = new Client();
        $result = $http->post(config("app")['url'] . "/oauth/token", [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refresh_token,
                'client_id' => config("passport")["password_id"],
                'client_secret' => (string)config("passport")["password_secret"],
                'scope' => '*',
            ],
        ]);
        return json_decode((string)$result->getBody(), true);
    }
}

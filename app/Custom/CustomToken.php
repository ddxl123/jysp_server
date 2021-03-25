<?php

namespace Custom;

use GuzzleHttp\Client;
use Laravel\Passport\Client as PassportClient;

class CustomToken
{
    /**
     * @return array $body
     * @see \Custom\CustomCatchResponse
     */
    public static function create_token($username, $password)
    {
        $http = new Client();
        $result = $http->post(config("app")['url'] . "oauth/token", [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => 2,
                'client_secret' => static::getSecret(),
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
        $result = $http->post(config("app")['url'] . "oauth/token", [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refresh_token,
                'client_id' => 2,
                'client_secret' => static::getSecret(),
                'scope' => '*',
            ],
        ]);
        return json_decode((string)$result->getBody(), true);
    }

    /**
     * @return string Client secret
     */
    public static function getSecret()
    {
        try {
            return PassportClient::query()->find(2)->secret;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

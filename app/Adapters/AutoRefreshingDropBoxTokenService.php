<?php

namespace App\Adapters;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class AutoRefreshingDropBoxTokenService
{
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    public function getToken($appKey, $appSecret, $refreshToken)
    {
        $cacheKey = 'dropbox_access_token';

        // Check if the token is in cache
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // Token is not in cache, refresh it
        $response = $this->httpClient->post('https://api.dropbox.com/oauth2/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
                'client_id' => $appKey,
                'client_secret' => $appSecret,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        $accessToken = $data['access_token'];

        // Cache the token with the expiration time minus a buffer (e.g., 5 minutes)
        Cache::put($cacheKey, $accessToken, now()->addSeconds($data['expires_in'] - 300));

        return $accessToken;
    }
}

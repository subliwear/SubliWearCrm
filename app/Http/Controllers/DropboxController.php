<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DropboxController extends Controller
{
    public function redirectToDropbox()
    {
        $appKey = env('DROPBOX_APP_KEY');
        $redirectUri = route('dropbox.callback');
        $authorizationUrl = "https://www.dropbox.com/oauth2/authorize?client_id={$appKey}&response_type=code&token_access_type=offline&redirect_uri={$redirectUri}";

        return redirect($authorizationUrl);
    }

    public function handleDropboxCallback(Request $request)
    {
        $appKey = env('DROPBOX_APP_KEY');
        $appSecret = env('DROPBOX_APP_SECRET');
        $redirectUri = route('dropbox.callback');
        $authorizationCode = $request->get('code'); // Capture le code d'autorisation

        $client = new Client();
        $response = $client->post('https://api.dropbox.com/oauth2/token', [
            'form_params' => [
                'code' => $authorizationCode,
                'grant_type' => 'authorization_code',
                'client_id' => $appKey,
                'client_secret' => $appSecret,
                'redirect_uri' => $redirectUri,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        // Stockez l'access token et le refresh token
        $accessToken = $data['access_token'];
        $refreshToken = $data['refresh_token'];

        // Vous pouvez maintenant enregistrer ces tokens dans la base de données ou dans une session
        // ...

        return redirect()->route('dashboard'); // Redirige vers le tableau de bord ou une autre route
    }
}

<?php

namespace App\Providers;

use Storage;
use Illuminate\Support\ServiceProvider;
use Spatie\Dropbox\Client as DropboxClient;
use Spatie\FlysystemDropbox\DropboxAdapter;
use League\Flysystem\Filesystem;
use App\Adapters\AutoRefreshingDropBoxTokenService;

class DropboxServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Storage::extend('dropbox', function ($app, $config) {
            $tokenService = new AutoRefreshingDropBoxTokenService();
            $accessToken = $tokenService->getToken(
                config('dropbox.appKey'),
                config('dropbox.appSecret'),
                config('dropbox.refreshToken')
            );
            $client = new DropboxClient($accessToken);

            $adapter = new DropboxAdapter($client);
            return new Filesystem($adapter);
        });
    }
}

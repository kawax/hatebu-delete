<?php

declare(strict_types=1);

namespace Revolution\Hatena\Providers;

use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Revolution\Hatena\Socialite\HatenaProvider;
use Revolution\Hatena\Socialite\HatenaServer;

class HatenaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Socialite::extend('hatena', function ($app) {
            $setting = $app['config']['services.hatena'];
            $config = array_merge([
                'identifier' => $setting['client_id'],
                'secret' => $setting['client_secret'],
                'callback_uri' => $setting['redirect'],
            ], $setting);

            return new HatenaProvider($app['request'], new HatenaServer($config));
        });

        Http::macro('hatena', fn (array $config): PendingRequest => $this->withMiddleware(new Oauth1($config))->withOptions(['auth' => 'oauth']));
    }
}

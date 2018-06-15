<?php

namespace Revolution\Hatena\Providers;

use Revolution\Hatena\Socialite\HatenaProvider;
use Revolution\Hatena\Socialite\HatenaServer;
use Illuminate\Support\ServiceProvider;

use Laravel\Socialite\Facades\Socialite;

class HatenaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Socialite::extend('hatena', function ($app) {
            $setting = $app['config']['services.hatena'];
            $config = array_merge([
                'identifier'   => $setting['client_id'],
                'secret'       => $setting['client_secret'],
                'callback_uri' => $setting['redirect'],
            ], $setting);

            return new HatenaProvider($app['request'], new HatenaServer($config));
        });
    }
}

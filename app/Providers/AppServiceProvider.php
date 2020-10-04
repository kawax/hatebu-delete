<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Revolution\Hatena\Bookmark\Bookmark;

class AppServiceProvider extends ServiceProvider
{
    /**
     * 登録する必要のある全コンテナシングルトン.
     *
     * @var array
     */
    public $singletons = [
        Bookmark::class => Bookmark::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Revolution\Hatena\Bookmark\Bookmark;

class AppServiceProvider extends ServiceProvider
{
    public array $singletons = [
        Bookmark::class => Bookmark::class,
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}

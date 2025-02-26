<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Revolution\Hatena\Bookmark\Bookmark;
use TallStackUi\Facades\TallStackUi;

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
        TallStackUi::personalize()
            ->card()
            ->block('wrapper.second', 'dark:bg-dark-700 flex w-full flex-col bg-white shadow-md')
            ->block('header.wrapper.base', 'dark:border-b-dark-600 flex items-center justify-between border-b border-b-gray-100 p-4
 bg-indigo-500')
            ->block('header.text.color', 'text-md text-white dark:text-dark-300');
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Revolution\Hatena\Bookmark\Bookmark;

class AppServiceProvider extends ServiceProvider
{
    /**
     * 登録する必要のある全コンテナシングルトン
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
        view()->composer('home.notifications', function ($view) {
            //古い通知は削除
            request()->user()
                     ->readNotifications()
                     ->where('created_at', '<', now()->subDays(config('hatena.delete_days')))
                     ->delete();

            $notifications = request()->user()->notifications;
            $notifications->markAsRead();

            $notifications = $notifications->take(20);

            $view->with(compact('notifications'));
        });
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

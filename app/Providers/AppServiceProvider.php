<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('home.notifications', function ($view) {
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

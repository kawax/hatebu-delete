<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\FeedJob;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $feed = FeedJob::dispatchNow($request->user());

//        dump($feed);

        $request->user()
                ->readNotifications()
                ->whereDate('created_at', '<', today()->subDays(config('hatena.delete_days')))
                ->delete();

        $notifications = $request->user()->notifications;
        $notifications->markAsRead();

        $notifications = $notifications->take(20);

        return view('home')->with(compact('feed', 'notifications'));
    }
}

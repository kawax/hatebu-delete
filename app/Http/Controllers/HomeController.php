<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\FeedJob;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        /**
         * SimpleXMLElementなのでキャッシュ不可
         *
         * @var \SimpleXMLElement $feed
         */
        $feed = FeedJob::dispatchNow($request->user());

        //dump($feed);

        //notificationsはAppServiceProviderのViewComposerで。

        return view('home')->with(compact('feed'));
    }
}

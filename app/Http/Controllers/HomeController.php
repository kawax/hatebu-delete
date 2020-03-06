<?php

namespace App\Http\Controllers;

use App\Jobs\FeedJob;
use Illuminate\Http\Request;

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
         * SimpleXMLElementなのでキャッシュ不可.
         *
         * @var \SimpleXMLElement $feed
         */
        $feed = FeedJob::dispatchNow($request->user());

        //notificationsはAppServiceProviderのViewComposerで。

        return view('home')->with(compact('feed'));
    }
}

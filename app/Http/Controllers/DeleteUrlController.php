<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Revolution\Hatena\Bookmark\Bookmark;
use App\Notifications\DeleteNotification;

class DeleteUrlController extends Controller
{
    /**
     * 個別削除
     *
     * @param Request  $request
     * @param Bookmark $bookmark
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, Bookmark $bookmark)
    {
        $config = [
            'consumer_key'    => config('services.hatena.client_id'),
            'consumer_secret' => config('services.hatena.client_secret'),
            'token'           => $request->user()->access_token,
            'token_secret'    => $request->user()->token_secret,
        ];

        $url = $request->input('url');

        $status = $bookmark->setAuth($config)->delete($url);

        if ($status === 204) {
            $request->user()->notify(new DeleteNotification($url, $url));
        }

        return back();
    }
}

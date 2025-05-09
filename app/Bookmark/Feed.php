<?php

namespace App\Bookmark;

use App\Models\User;
use SimpleXMLElement;

class Feed
{
    /**
     * Atom APIが使えなくなるのでRSSから取得。
     * 非公開だと取得できないし、キャッシュされてるので更新が遅い。
     *
     * @see http://developer.hatena.ne.jp/ja/documents/bookmark/misc/feed
     */
    public function get(User $user): SimpleXMLElement
    {
        $url = 'https://b.hatena.ne.jp/'.$user->name.'/bookmark.rss';

        return simplexml_load_file($url);
    }
}

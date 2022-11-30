<?php

namespace Revolution\Hatena\Bookmark;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Revolution\Hatena\WithHatena;

class Bookmark
{
    use WithHatena;

    /**
     * @see http://developer.hatena.ne.jp/ja/documents/bookmark/apis/rest/bookmark#delete_my_bookmark
     *
     * @param  string  $url
     * @param  string  $endpoint
     * @return Response
     */
    public function delete(
        string $url,
        string $endpoint = 'https://bookmark.hatenaapis.com/rest/1/my/bookmark'
    ): Response {
        return Http::hatena($this->config)
                   ->asForm()
                   ->delete($endpoint, ['url' => $url]);
    }
}

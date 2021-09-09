<?php

namespace Revolution\Hatena\Bookmark;

use Revolution\Hatena\HatenaClient;

class My
{
    use HatenaClient;

    /**
     * @see http://developer.hatena.ne.jp/ja/documents/bookmark/apis/rest/my#get_my
     *
     * @param  string  $endpoint
     *
     * @return string
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function my(string $endpoint = 'https://bookmark.hatenaapis.com/rest/1/my'): string
    {
        $res = $this->request($endpoint);

        return (string) $res->getBody();
    }
}

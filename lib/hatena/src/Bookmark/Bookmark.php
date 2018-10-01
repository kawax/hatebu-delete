<?php

namespace Revolution\Hatena\Bookmark;

use Revolution\Hatena\HatenaClient;

class Bookmark
{
    use HatenaClient;

    const NO_CONTENT = 204;

    /**
     * @see http://developer.hatena.ne.jp/ja/documents/bookmark/misc/feed
     *
     * @param string $user
     *
     * @return string
     */
    public function feed(string $user): string
    {
        $endpoint = 'http://b.hatena.ne.jp/' . $user . '/rss';

        $res = $this->request($endpoint);

        return (string)$res->getBody();
    }

    /**
     * @see http://developer.hatena.ne.jp/ja/documents/bookmark/apis/rest/bookmark#delete_my_bookmark
     *
     * @param string $url
     * @param string $endpoint
     *
     * @return int
     */
    public function delete(string $url, string $endpoint = 'http://api.b.hatena.ne.jp/1/my/bookmark'): int
    {
        $res = $this->request($endpoint, [
            'query' => ['url' => $url],
        ], 'DELETE');

        return $res->getStatusCode();
    }
}

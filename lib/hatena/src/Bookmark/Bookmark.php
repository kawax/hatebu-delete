<?php

namespace Revolution\Hatena\Bookmark;

use Revolution\Hatena\HatenaClient;

class Bookmark
{
    use HatenaClient;

    /**
     * @param string $endpoint
     *
     * @return string
     */
    public function feed(string $endpoint = 'https://b.hatena.ne.jp/atom/feed'): string
    {
        $res = $this->request($endpoint);

        return (string)$res->getBody();
    }

    /**
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

<?php

namespace Revolution\Hatena\Bookmark;

use Revolution\Hatena\HatenaClient;

/**
 * Class Entry.
 */
class Entry
{
    use HatenaClient;

    /**
     * @see http://developer.hatena.ne.jp/ja/documents/bookmark/apis/getinfo
     *
     * @param string $url
     * @param string $endpoint ノーマル版を使うなら"http://b.hatena.ne.jp/entry/json/"
     *
     * @return string
     */
    public function info($url, $endpoint = 'http://b.hatena.ne.jp/entry/jsonlite/')
    {
        $res = $this->request($endpoint, [
            'query' => ['url' => $url],
        ]);

        $body = (string)$res->getBody();

        if ($res->getStatusCode() === 200 and $body != 'null') {
            return $body;
        } else {
            return '';
        }
    }

    /**
     * @see http://developer.hatena.ne.jp/ja/documents/bookmark/apis/getcount
     *
     * @param string $url
     * @param string $endpoint
     *
     * @return bool|string
     */
    public function count($url, $endpoint = 'http://api.b.st-hatena.com/entry.count')
    {
        $res = $this->request($endpoint, [
            'query' => ['url' => $url],
        ]);

        return (string)$res->getBody();
    }

    /**
     * @param array  $urls
     * @param string $endpoint
     *
     * @return string
     */
    public function counts($urls, $endpoint = 'http://api.b.st-hatena.com/entry.counts')
    {
        //一度に指定できるurlは50まで
        if (count($urls) > 50) {
            $urls = array_chunk($urls, 50)[0];
        }

        $query = '';

        foreach ($urls as $url) {
            $query .= 'url=' . rawurlencode($url) . '&';
        }

        $res = $this->request($endpoint . '?' . $query);

        return (string)$res->getBody();
    }

    /**
     * @see http://developer.hatena.ne.jp/ja/documents/bookmark/apis/getcount
     *
     * @param string $url
     * @param string $endpoint
     *
     * @return bool|string
     */
    public function totalCount($url, $endpoint = 'http://api.b.st-hatena.com/entry.total_count')
    {
        $res = $this->request($endpoint, [
            'query' => ['url' => $url],
        ]);

        return (string)$res->getBody();
    }
}

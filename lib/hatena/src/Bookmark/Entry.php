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
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function info(string $url, string $endpoint = 'http://b.hatena.ne.jp/entry/jsonlite/'): string
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
     * @return string
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function count(string $url, string $endpoint = 'http://api.b.st-hatena.com/entry.count'): string
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
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function counts(array $urls, string $endpoint = 'http://api.b.st-hatena.com/entry.counts'): string
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
     * @return string
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function totalCount(string $url, string $endpoint = 'http://api.b.st-hatena.com/entry.total_count'): string
    {
        $res = $this->request($endpoint, [
            'query' => ['url' => $url],
        ]);

        return (string)$res->getBody();
    }
}

<?php

namespace Revolution\Hatena;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Psr\Http\Message\ResponseInterface;

trait HatenaClient
{
    /**
     * @var ClientInterface
     */
    protected ClientInterface $client;

    /**
     * @param  ClientInterface  $client
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        $this->client ??= new Client();

        return $this->client;
    }

    /**
     * @param  array  $auth  ['consumer_key', 'consumer_secret', 'token', 'token_secret']
     * @return $this
     */
    public function setAuth(array $auth): static
    {
        $stack = HandlerStack::create();

        $middleware = new Oauth1($auth);
        $stack->push($middleware);

        $this->client = new Client([
            'handler' => $stack,
            'auth'    => 'oauth',
        ]);

        return $this;
    }

    /**
     * @param  string  $url
     * @param  array  $options
     * @param  string  $method
     * @return ResponseInterface
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $url, array $options = [], $method = 'GET'): ResponseInterface
    {
        return $this->getClient()->request($method, $url, $options);
    }
}

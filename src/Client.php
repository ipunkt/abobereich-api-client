<?php

namespace Abobereich\ApiClient;

use Abobereich\ApiClient\Contexts\Accounts;
use Abobereich\ApiClient\Contexts\Tenants;

/**
 * Class Client
 *
 * @package Abobereich\ApiClient
 */
class Client
{

    private $client;

    /**
     * instantiate api client
     *
     * @param string $uri
     * @param string $key
     * @param string $secret
     * @param array $config
     */
    public function __construct($uri, $key, $secret, array $config = [])
    {
        $this->client = new \GuzzleHttp\Client(array_merge($config, [
            'base_uri' => $uri,
            'headers' => [
                'Accept' => 'application/vnd.abobereich.v1+json',
                'Cache-Control' => 'no-cache',
                'X-API-KEY' => $key,
                'X-API-SECRET' => $secret,
            ],
        ]));
    }

    /**
     * returns the accounts context
     *
     * @return Accounts
     */
    public function accounts()
    {
        return new Accounts($this->client);
    }

    /**
     * returns the tenants context
     *
     * @return Tenants
     */
    public function tenants()
    {
        return new Tenants($this->client);
    }
}
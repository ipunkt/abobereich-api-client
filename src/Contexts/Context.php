<?php

namespace Abobereich\ApiClient\Contexts;

use Abobereich\ApiClient\Transformers\Transformer;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Context
 *
 * @package Abobereich\ApiClient\Contexts
 */
abstract class Context
{
    /**
     * pre-configured client for the context
     *
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * returns a transformer
     *
     * @return Transformer
     */
    abstract protected function transformer();

    /**
     * makes a get request
     *
     * @param string $uri
     * @param string $indexOfResponse
     *
     * @return mixed
     */
    protected function get($uri, $indexOfResponse = 'data')
    {
        $result = $this->request($uri);

        if (array_key_exists($indexOfResponse, $result)) {
            return $this->transformer()->transform($result[$indexOfResponse]);
        }

        throw new \InvalidArgumentException('No ' . $indexOfResponse . ' index found in response');
    }

    /**
     * index route call
     *
     * @param string $uri
     * @param string $indexOfResponse
     *
     * @return array
     */
    protected function index($uri, $indexOfResponse = 'data')
    {
        $result = $this->request($uri);

        if (array_key_exists($indexOfResponse, $result)) {
            return $this->transformer()->transformCollection($result[$indexOfResponse]);
        }

        throw new \InvalidArgumentException('No ' . $indexOfResponse . ' index found in response');
    }

    /**
     * make a request
     *
     * @param string $uri
     *
     * @return array
     */
    protected function request($uri)
    {
        try {
            $response = $this->client->get($uri);

            return $this->toArray($response);
        } catch (RequestException $e) {
            echo $e->getMessage() . PHP_EOL;
            echo $e->getRequest()->getUri() . PHP_EOL;
            if ($e->hasResponse()) {
                echo $e->getResponse()->getBody() . PHP_EOL;
            }
        }
    }

    /**
     * returns an array from response stream
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array
     */
    protected function toArray(ResponseInterface $response)
    {
        return json_decode((string)$response->getBody(), true);
    }
}
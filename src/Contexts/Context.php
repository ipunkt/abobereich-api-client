<?php

namespace Abobereich\ApiClient\Contexts;

use Abobereich\ApiClient\Exceptions\InvalidRequestDataException;
use Abobereich\ApiClient\Exceptions\ModelNotCreatedException;
use Abobereich\ApiClient\Exceptions\RequestNotSuccessfulException;
use Abobereich\ApiClient\Models\Account;
use Abobereich\ApiClient\Models\Model;
use Abobereich\ApiClient\Transformers\Transformer;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
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
     * @return Model
     */
    protected function get($uri, $indexOfResponse = 'data')
    {
        $response = $this->getRequest($uri);
        $result = $this->toArray($response);

        if (null !== $result && array_key_exists($indexOfResponse, $result)) {
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
     * @return array|Model[]
     */
    protected function index($uri, $indexOfResponse = 'data')
    {
        $response = $this->getRequest($uri);
        $result = $this->toArray($response);

        if (null !== $result && array_key_exists($indexOfResponse, $result)) {
            return $this->transformer()->transformCollection($result[$indexOfResponse]);
        }

        throw new \InvalidArgumentException('No ' . $indexOfResponse . ' index found in response');
    }

    /**
     * creates a model via api
     *
     * @param string $uri
     * @param \Abobereich\ApiClient\Models\Model $model
     * @param string $indexOfResponse
     *
     * @return Account|null
     */
    protected function create($uri, Model $model, $indexOfResponse = 'data')
    {
        /**
         * reset id, created_at and updated_at to null, because a new model does not have any valid values there
         */
        $model->setId(null)->setCreatedAt(null)->setUpdatedAt(null);

        $response = $this->postRequest($uri, $model);
        $result = $this->toArray($response);

        if (null !== $result && array_key_exists($indexOfResponse, $result)) {
            return $this->transformer()->transform($result[$indexOfResponse]);
        }

        return null;
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

    /**
     * get a request
     *
     * @param string $uri
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \Abobereich\ApiClient\Exceptions\RequestNotSuccessfulException
     */
    private function getRequest($uri)
    {
        try {
            $request = new Request('GET', $uri);
            $response = $this->client->send($request);

            return $response;
        } catch (\Exception $e) {
            $message = 'Request not successful';
            if ($e->hasResponse()) {
                $result = json_decode($e->getResponse()->getBody(), true);
                if (array_key_exists('message', $result)) {
                    $message = $result['message'];
                }
            }

            throw new RequestNotSuccessfulException($message, $e->getCode(), $e);
        }
    }

    /**
     * post a request
     *
     * @param string $uri
     * @param Model $data
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     *
     * @throws \Abobereich\ApiClient\Exceptions\InvalidRequestDataException
     * @throws \Abobereich\ApiClient\Exceptions\ModelNotCreatedException
     */
    private function postRequest($uri, $data)
    {
        try {
            $request = new Request('POST', $uri, ['content-type' => 'application/json'], json_encode($data));
            $response = $this->client->send($request);

            return $response;
        } catch (ClientException $e) {
            $message = 'Model could not be created';

            if ($e->getResponse()->getStatusCode() === 422) {
                if ($e->hasResponse()) {
                    $result = json_decode($e->getResponse()->getBody(), true);
                    throw new InvalidRequestDataException($result, 'Invalid request data', $e->getCode(), $e);
                }
            } elseif ($e->hasResponse()) {
                $result = json_decode($e->getResponse()->getBody(), true);
                if (array_key_exists('message', $result)) {
                    $message = $result['message'];
                }
            }

            throw new ModelNotCreatedException($data, $message, $e->getCode(), $e);
        }
    }
}
<?php

namespace Abobereich\ApiClient\Contexts;

use Abobereich\ApiClient\Exceptions\InvalidRequestDataException;
use Abobereich\ApiClient\Exceptions\ModelNotCreatedException;
use Abobereich\ApiClient\Exceptions\ModelNotUpdatedException;
use Abobereich\ApiClient\Exceptions\RequestNotSuccessfulException;
use Abobereich\ApiClient\Models\Account;
use Abobereich\ApiClient\Models\Model;
use Abobereich\ApiClient\Transformers\Transformer;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
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
     * @return Model|null
     */
    protected function get($uri, $indexOfResponse = 'data')
    {
        $response = $this->getRequest($uri);
        $result = $this->toArray($response);

        if (null !== $result && array_key_exists($indexOfResponse, $result)) {
            return $this->transformer()->transform($result[$indexOfResponse]);
        }

        return null;
    }

    /**
     * index route call
     *
     * @param string $uri
     * @param string|null $indexOfResponse
     *
     * @return array|Model[]
     */
    protected function index($uri, $indexOfResponse = 'data')
    {
        $response = $this->getRequest($uri);
        $result = $this->toArray($response);

        if (null !== $indexOfResponse) {
            if (null !== $result && array_key_exists($indexOfResponse, $result)) {
                return $this->transformer()->transformCollection($result[$indexOfResponse]);
            }
        } else {
            return $result;
        }

        return [];
    }

    /**
     * creates a model via api
     *
     * @param string $uri
     * @param \Abobereich\ApiClient\Models\Model|array $model
     * @param string $indexOfResponse
     *
     * @return Account|null
     */
    protected function post($uri, $model, $indexOfResponse = 'data')
    {
        /**
         * reset id, created_at and updated_at to null, because a new model does not have any valid values there
         */
        if ($model instanceof Model) {
            $model->setId(null);
        }

        $response = $this->postRequest($uri, $model);
        $result = $this->toArray($response);

        if (null !== $result && array_key_exists($indexOfResponse, $result)) {
            return $this->transformer()->transform($result[$indexOfResponse]);
        }

        return null;
    }

    /**
     * updates a model via api
     *
     * @param string $uri
     * @param \Abobereich\ApiClient\Models\Model $model
     * @param string $indexOfResponse
     *
     * @return Account|null
     */
    protected function put($uri, Model $model, $indexOfResponse = 'data')
    {
        $response = $this->putRequest($uri, $model);
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
        } catch (ServerException $e) {
            throw new RequestNotSuccessfulException($e->getMessage(), $e->getCode(), $e);
        } catch (ClientException $e) {
            $message = 'Request not successful';
            $code = $e->getCode();

            if ($e->hasResponse() && $e->getResponse()->hasHeader('Content-Type') && in_array('application/json', $e->getResponse()->getHeader('Content-Type'))) {
                $responseData = json_decode($e->getResponse()->getBody(), true);
                $message = array_key_exists('message', $responseData) ? $responseData['message'] : '';
                $code = array_key_exists('status_code', $responseData) ? $responseData['status_code'] : $e->getCode();
            }

            if ($e->hasResponse() && $e->getResponse()->getStatusCode() === 422) {
                $result = json_decode($e->getResponse()->getBody(), true);
                throw new InvalidRequestDataException($result, 'Invalid request data', $e->getCode(), $e);
            }

            throw new RequestNotSuccessfulException($message, $code, $e);
        } catch (\Exception $e) {
            throw new RequestNotSuccessfulException('Request not successful', $e->getCode(), $e);
        }
    }

    /**
     * post a request
     *
     * @param string $uri
     * @param Model|array $data
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \Abobereich\ApiClient\Exceptions\InvalidRequestDataException
     * @throws \Abobereich\ApiClient\Exceptions\ModelNotCreatedException
     * @throws \Abobereich\ApiClient\Exceptions\RequestNotSuccessfulException
     */
    private function postRequest($uri, $data)
    {
        try {
            $request = new Request('POST', $uri, ['content-type' => 'application/json'], json_encode($data));
            $response = $this->client->send($request);

            return $response;
        } catch (ServerException $e) {
            throw new RequestNotSuccessfulException($e->getMessage(), $e->getCode(), $e);
        } catch (ClientException $e) {
            $message = 'Model could not be created';
            $code = $e->getCode();

            if ($e->hasResponse() && $e->getResponse()->hasHeader('Content-Type') && in_array('application/json', $e->getResponse()->getHeader('Content-Type'))) {
                $responseData = json_decode($e->getResponse()->getBody(), true);
                $message = array_key_exists('message', $responseData) ? $responseData['message'] : '';
                $code = array_key_exists('status_code', $responseData) ? $responseData['status_code'] : $e->getCode();
            }

            if ($e->hasResponse() && $e->getResponse()->getStatusCode() === 422) {
                $result = json_decode($e->getResponse()->getBody(), true);
                throw new InvalidRequestDataException($result, 'Invalid request data', $e->getCode(), $e);
            }

            throw new ModelNotCreatedException($data, $message, $code, $e);
        } catch (\Exception $e) {
            throw new RequestNotSuccessfulException('Model could not be created', $e->getCode(), $e);
        }
    }

    /**
     * put a request
     *
     * @param string $uri
     * @param Model $data
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \Abobereich\ApiClient\Exceptions\InvalidRequestDataException
     * @throws \Abobereich\ApiClient\Exceptions\ModelNotUpdatedException
     * @throws \Abobereich\ApiClient\Exceptions\RequestNotSuccessfulException
     */
    private function putRequest($uri, $data)
    {
        try {
            $request = new Request('PUT', $uri, ['content-type' => 'application/json'], json_encode($data));
            $response = $this->client->send($request);

            return $response;
        } catch (ServerException $e) {
            throw new RequestNotSuccessfulException($e->getMessage(), $e->getCode(), $e);
        } catch (ClientException $e) {
            $message = 'Model could not be updated';
            $code = $e->getCode();

            if ($e->hasResponse() && $e->getResponse()->hasHeader('Content-Type') && in_array('application/json', $e->getResponse()->getHeader('Content-Type'))) {
                $responseData = json_decode($e->getResponse()->getBody(), true);
                $message = array_key_exists('message', $responseData) ? $responseData['message'] : '';
                $code = array_key_exists('status_code', $responseData) ? $responseData['status_code'] : $e->getCode();
            }

            if ($e->hasResponse() && $e->getResponse()->getStatusCode() === 422) {
                $result = json_decode($e->getResponse()->getBody(), true);
                throw new InvalidRequestDataException($result, 'Invalid request data', $e->getCode(), $e);
            }

            throw new ModelNotUpdatedException($data, $message, $code, $e);
        } catch (\Exception $e) {
            throw new RequestNotSuccessfulException('Model could not be updated', $e->getCode(), $e);
        }
    }
}
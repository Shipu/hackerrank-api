<?php

namespace Shipu\HackerRank\Api;

use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use Shipu\HackerRank\HttpManager\RequestHandler;
use Shipu\HackerRank\HttpManager\Response;

abstract class AbstractApi
{
    protected $client;
    protected $apiKey;
    protected $parameters = [];
    protected $config;
    private $requestMethods = [
        'GET',
        'POST',
        'PUT',
        'DELETE',
        'HEAD',
        'OPTIONS',
        'PATCH',
    ];

    public function __construct()
    {
        $this->apiKey = $this->config['api_key'];
        $this->client = new RequestHandler();
    }

    public function __call($func, $params)
    {
        $method = strtoupper($func);

        if (in_array($method, $this->requestMethods)) {
            $parameters[] = $method;
            $parameters[] = $params[0];

            if (isset($params[1])) {
                $this->formParams($params[1]);
            }

            return call_user_func_array([$this, 'makeMethodRequest'], $parameters);
        }
    }

    public function formParams($params = [])
    {
        if (is_array($params)) {
            $this->parameters['form_params'] = $params;
            $this->parameters['form_params']['api_key'] = $this->apiKey;

            return $this;
        }

        return false;
    }

    public function headers($params = [])
    {
        if (is_array($params)) {
            $this->parameters['headers'] = $params;

            return $this;
        }

        return false;
    }

    public function query($params = [])
    {
        if (is_array($params)) {
            $this->parameters['query'] = $params;

            return $this;
        }

        return false;
    }

    public function makeMethodRequest($method, $uri)
    {
        $this->parameters['timeout'] = 60;
        $defaultHeaders = [
            'User-Agent' => $_SERVER['HTTP_USER_AGENT'],
        ];

        if ($method == 'GET') {
            if (isset($this->parameters['headers'])) {
                $this->parameters['headers'] = array_merge($defaultHeaders, $this->parameters['headers']);
            } else {
                $this->parameters['headers'] = $defaultHeaders;
            }
        }

        try {
            return $response = new Response($this->client->http->request($method, $uri, $this->parameters));
        } catch (RequestException $e) {
            return $e;
        } catch (ClientException $e) {
            return $e->getResponse();
        } catch (BadResponseException $e) {
            return $e;
        } catch (ServerException $e) {
            return $e;
        }
    }
}

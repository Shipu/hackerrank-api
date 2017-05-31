<?php

namespace Shipu\HackerRank\HttpManager;

use GuzzleHttp\Client;


class RequestHandler
{

    const BASE_URL = 'http://api.hackerrank.com';

    public $http;


    /**
     * RequestHandler constructor.
     */
    function __construct()
    {
        $this->http = new Client([ 'base_uri' => self::BASE_URL, 'timeout' => 2.0 ]);
    }

}
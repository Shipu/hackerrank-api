<?php 

namespace Shipu\HackerRank\HttpManager;

class Response
{
    protected $response;

    public $data = [];

    /**
     * Response constructor.
     *
     * @param $response
     */
    function __construct($response)
    {
        $this->response = $response;
        $this->data = $this->getData();
    }

    /**
     * It's Magic
     *
     * @param $method
     * @param $args
     * @return bool|mixed
     */
    function __call($method, $args)
    {
        if (method_exists($this->response, $method)) {
            return call_user_func_array([$this->response, $method], $args);
        }
        return false;
    }

    /**
     * Getting Data
     *
     * @return bool|mixed
     */
    protected function getData()
    {
        $header = explode(';',$this->response->getHeader('Content-Type')[0]);
        $contentType = $header[0];

        if ($contentType == 'application/json') {
            $contents = $this->response->getBody()->getContents();
            $data = json_decode($contents);

            if (json_last_error() == JSON_ERROR_NONE) {
                return $data;
            }

            return $contents;
        }

        return false;
    }
}
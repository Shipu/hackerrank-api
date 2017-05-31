<?php

namespace Shipu\HackerRank;

use Shipu\HackerRank\Api\Checker;

class HackerRank
{
    protected $config;
    protected $auth;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function __call($method, $args)
    {
        $arguments = array_merge([$method], $args);

        return call_user_func_array([$this, 'api'], $arguments);
    }

    public function api()
    {
        $args = func_get_args();
        $api = '';
        if (count($args) > 0) {
            $api = array_shift($args);
        }

        if (count($args) == 0) {
            $args = null;
        }

        $api = strtolower($api);

        switch ($api) {
            case 'check':
            case 'checker':
                return new Checker($this->config);
        }
    }
}

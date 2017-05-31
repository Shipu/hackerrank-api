<?php

namespace Shipu\HackerRank\Api;

use Shipu\HackerRank\HttpManager\Response;

class Checker extends AbstractApi
{
    /**
     * Checker constructor.
     * @param $config
     */
    function __construct($config)
    {
        $this->config = $config;
        parent::__construct();
    }

    /**
     * Submit Code with test cases
     *
     * @param $lang
     * @param $source
     * @param array $testcases
     * @param string $format
     * @param bool $wait
     * @param string $callback_url
     *
     * @return Response
     */
    public function submission($lang, $source, $testcases = [ "1" ], $format = 'json', $wait = true, $callback_url = '')
    {
        if (!is_numeric($lang)) {
            $allLang = $this->languages();
            if (isset($allLang->data->languages->codes->{$lang})) {
                $lang = $allLang->data->languages->codes->{$lang};
            }
        }

        $data = [
            'lang'         => $lang,
            'testcases'    => json_encode($testcases),
            "source"       => $source,
            "format"       => $format,
            "wait"         => $wait,
            "callback_url" => $callback_url,
        ];

        return $this->post('checker/submission.json', $data);
    }

    /**
     * List of all languages
     *
     * @return Response
     */
    public function languages()
    {
        return $this->get('checker/languages.json');
    }

}

<?php

namespace Shipu\HackerRank\Facades;

use Illuminate\Support\Facades\Facade;

class HackerRank extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'hackerrank';
    }
}

<?php

namespace Shipu\Themevel\Tests;

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use Shipu\HackerRank\HackerRankServiceProvider;

/**
 * This is the abstract test case class.
 */
abstract class TestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return HackerRankServiceProvider::class;
    }
}

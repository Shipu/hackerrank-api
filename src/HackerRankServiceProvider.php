<?php

namespace Shipu\HackerRank;

use Illuminate\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

class HackerRankServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/hackerrank.php');
        // Check if the application is a Laravel OR Lumen instance to properly merge the configuration file.
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('hackerrank.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('hackerrank');
        }
        $this->mergeConfigFrom($source, 'hackerrank');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->registerHackerRank();
    }

    /**
     * Register HackerRank class.
     */
    protected function registerHackerRank()
    {
        $this->app->singleton('hackerrank', function (Container $app) {
            return new HackerRank($app['config']->get('hackerrank'));
        });
        $this->app->alias('hackerrank', HackerRank::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'hackerrank',
        ];
    }
}

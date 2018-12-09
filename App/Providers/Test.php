<?php

namespace App\Providers;

use \Pimple\ServiceProviderInterface;
use \Pimple\Container;

class Test implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['service1'] = function () {
            echo 'service1'. PHP_EOL;
            return [1, 3 , 4];
        };

        $app['service2'] = function () {
            echo 'service2'. PHP_EOL;
            return 'nnnnn';
        };
    }
}


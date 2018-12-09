<?php

namespace App\Providers;

use \Pimple\ServiceProviderInterface;
use \Pimple\Container;

class Config implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['config'] = function () {
            return parse_ini_file(__DIR__ . "/../../config.ini", true);
        };
    }
}


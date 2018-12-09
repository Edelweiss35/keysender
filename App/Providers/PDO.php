<?php

namespace App\Providers;

use \Pimple\ServiceProviderInterface;
use \Pimple\Container;

class PDO implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['pdo'] = function () use ($app) {
            $config = $app['config']['database'];
            $dsn = "mysql:dbname={$config['dbname']};host={$config['host']}";
            return new \PDO($dsn, $config['username'], $config['password']);
        };
    }
}

